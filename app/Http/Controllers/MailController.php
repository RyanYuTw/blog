<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use App\Models\Mail as MailModel;
use App\Mail\SendMail;

use App\Services\JwtService;

use DateTimeImmutable;
use Lcobucci\Clock\FrozenClock;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\Validation\Constraint;
use Lcobucci\JWT\Validation\Constraint\IdentifiedBy;
use Lcobucci\JWT\Validation\Constraint\IssuedBy;
use Lcobucci\JWT\Validation\Constraint\LooseValidAt;
use Lcobucci\JWT\Validation\Constraint\PermittedFor;
use Lcobucci\JWT\Validation\ConstraintViolation;
use Lcobucci\JWT\Validation\RequiredConstraintsViolated;

use Exception;

class MailController extends Controller
{
    public function __contruct()
    {
    }

    const MAIL_SEND_SUCCESS = 1;
    const MAIL_SEND_FAIL    = -1;

    /**
     * 電子郵件發送
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function send(Request $request)
    {
        try {
            //驗證 Header
            $auth = $request->header('Authorization');
            if (!$auth || !$this->validateHeader($auth)) {
                throw new Exception("Access Denies!", 403);
            }

            //驗證參數
            $service_code = $request->input("service_code") ?? null;
            $from         = $request->input("from") ?? null;
            $from_name    = $request->input("from_name") ?? null;
            $to           = $request->input("to") ?? null;
            $to_name      = $request->input("to_name") ?? null;
            $subject      = $request->input("subject") ?? null;
            $body         = $request->input("body") ?? null;
            $csrf         = $request->input("csrf") ?? null;

            $inputData = $request->all();

            $validate = $this->validateData($inputData);
            if (!$validate) {
                throw new Exception("Request parameters error!", 400);
            }

            //驗證 token
            if (!$this->validateToken($service_code, $csrf)) {
                throw new Exception("Token error!", 400);
            }

            //驗證 mail_code
            $mailCode = MailModel::where('service_code', $service_code)->first();
            if (empty($mailCode)) {
                throw new Exception("Mail Code not found!", 400);
            }

            // 測試機與正式機主旨標註, 避免混崤
            if (env('APP_ENV') != 'production') {
                $subject = "測試-" . $subject;
            }

            $mailLog = MailModel::create([
                'service_code' => $service_code,
                'from_name'    => $from_name,
                'from_mail'    => $from ?? null,
                'to_name'      => $to_name,
                'to_mail'      => $to ?? null,
                'subject'      => $subject,
                'body'         => $body,
            ]);

            $result = $this->sendMail($mailLog);
            $mailLog->send_status = ($result) ? self::MAIL_SEND_SUCCESS : self::MAIL_SEND_FAIL;
            $mailLog->save();

            return response()->json(['code' => 200, 'status' => true, 'message' => 'Mail Send Finished!', 'response' => null], 200, [], JSON_PRETTY_PRINT);
        } catch (Exception $e) {

            $errCode = ($e->getCode() == 0) ? 500 : $e->getCode();
            $errMsg  = $e->getMessage();

            $errLog = sprintf(
                'Msg:[%s], Code:[%s], Line:[%s], File:[%s]',
                $errMsg,
                $errCode,
                $e->getLine(),
                $e->getFile()
            );

            $log = sprintf("%s %s Fail Info: [%s]", __CLASS__, __FUNCTION__, $errLog);
            $this->log($log, "info");

            $log = sprintf("%s %s Fail End", __CLASS__, __FUNCTION__);
            $this->log($log, "info");

            return response()->json(['code' => 400, 'status' => false, 'message' => $e->getMessage(), 'response' => "Error at " . $e->getLine() . " line!"], 400, [], JSON_PRETTY_PRINT);
        }
    }


    /**
     * 驗證 Header
     * @param $auth = header
     * @return bool
     */
    protected function validateHeader($auth)
    {
        $appKey = $this->getAppKey();
        $appKey = base64_encode(sha1($appKey));

        return $auth == $appKey ? true : false;
    }

    /**
     * 取得 APP KEY
     * @return bool|string
     */
    protected function getAppKey()
    {
        $appKey = env('APP_KEY');
        $arrAppKey = explode('base64:', $appKey);
        return (is_array($arrAppKey) && count($arrAppKey) == 2) ? $arrAppKey[1] : false;
    }

    /**
     * 驗證參數資料
     * @param $inputData    = 請求參數陣列
     * @return bool
     */
    protected function validateData($inputData)
    {
        //驗證規則
        $rules = [
            'service_code' => 'required | string | max:10',
            'from_name'    => 'nullable | string | max:255',
            'from'         => 'required | string | max:255',
            'to_name'      => 'nullable | string | max:255',
            'to'           => 'required | string | max:255',
            'subject'      => 'nullable | string | max:255',
            'body'         => 'nullable',
            'csrf'         => 'required | alpha_num'
        ];

        $validator = Validator::make($inputData, $rules);
        if ($validator->fails()) {
            return false;
        }

        return true;
    }


    /**
     * 驗證 token
     * @param $string
     * @param $token
     * @return bool
     */
    protected function validateToken($string, $token)
    {
        $appKey = $this->getAppKey();

        $log = sprintf("APP KEY: [%s]", $appKey);
        $this->log($log, 'debug');

        $stringToken = md5(sha1($string . $appKey));

        $log = sprintf("Token: [%s]", $stringToken);
        $this->log($log, 'debug');

        return $stringToken == $token ? true : false;
    }


    /**
     * SMTP Send Mail
     *
     * @param [type] $mail
     * @return void
     */
    protected function sendMail($options)
    {
        $mailAddress = env('MAIL_FROM_ADDRESS');
        Mail::to($mailAddress)->send(new SendMail($options));

        return true;
    }


    /**
     * 驗證電子郵件格式
     * @param $str
     * @return bool
     */
    function isEmail($str)
    {
        if (preg_match("/^[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[@]{1}[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[.]{1}[A-Za-z]{2,5}$/", $str)) {
            return true;    // valid
        } else {
            return false;   // invalid
        }
    }


    /**
     * 寫入Laravel Log檔
     * @param $string
     * @param string $type
     */
    protected function log($string, $type = "debug")
    {
        static $seq = 0;
        $seq++;
        $prefix = "[MailController Send] PID: [" . getmypid() . "] (" . ($seq) . ") ";
        $string = $prefix . $string . "\n";
        switch ($type) {
            case "emergency":
                Log::emergency($string);
                break;
            case "alert":
                Log::alert($string);
                break;
            case "critical":
                Log::critical($string);
                break;
            case "error":
                Log::error($string);
                break;
            case "warning":
                Log::warning($string);
                break;
            case "notice":
                Log::notice($string);
                break;
            case "info":
                Log::info($string);
                break;
            default:
                Log::debug($string);
                break;
        }
    }
}
