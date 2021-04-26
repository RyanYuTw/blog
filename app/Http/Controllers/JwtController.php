<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

use DateTimeImmutable;
use Lcobucci\Clock\FrozenClock;
use Lcobucci\JWT\Validation\Constraint\LooseValidAt;
// use Lcobucci\JWT\Configuration;
// use Lcobucci\JWT\Token;
// use Lcobucci\JWT\Validation\Constraint;
// use Lcobucci\JWT\Validation\Constraint\IdentifiedBy;
// use Lcobucci\JWT\Validation\Constraint\IssuedBy;
// use Lcobucci\JWT\Validation\Constraint\PermittedFor;
// use Lcobucci\JWT\Validation\ConstraintViolation;
// use Lcobucci\JWT\Validation\RequiredConstraintsViolated;

use App\Services\JwtService;

class JwtController extends Controller
{
    const HTTP_ERROR_CODE   = 400;
    const HTTP_SUCCESS_CODE = 200;

    // 生成 Jwt Token (測試用)
    public function getToken(Request $request)
    {
        try {
            //驗證參數
            $payload   = $request->input("payload") ?? null;
            $expiredAt = $request->input("expired_at") ?? null;

            $inputData = $request->all();

            $validate = $this->validateData($inputData);
            if (!$validate) {
                throw new Exception("Request parameters error!", 400);
            }

            // 產生 Jwt Token
            $token = JwtService::getInstance()->generate($payload, $expiredAt);
            return $token->toString();

        } catch (Exception $e) {

            return response()->json([
                'code' => self::HTTP_ERROR_CODE,
                'status' => false,
                'message' => $e->getMessage(),
                'response' => "Error at " . $e->getLine() . " line!"
            ], self::HTTP_ERROR_CODE, [], JSON_PRETTY_PRINT);
        }

    }


    /**
     * 驗證 Jwt Token (測試用)
     *
     * @param Request $request
     * @return void
     */
    public function validateToken(Request $request)
    {
        try {
            // 取得標頭
            $header = $request->header('authorization') ?? null;

            $now = strtotime(date("Y-m-d H:i:s"));

            // 驗證 Token
            $clock = new FrozenClock(new DateTimeImmutable('@' . $now));

            // Jwt Token 驗證限制
            $constraints = [
                // new IdentifiedBy('1'),
                // new PermittedFor('http://client.abc.com'),
                // new IssuedBy('http://issuer.abc.com', 'http://api.abc.com'),
                new LooseValidAt($clock),
            ];

            // 生成 Jwt Token 組態
            $config = JwtService::getInstance()->configInit();
            $parseToken = $config->parser()->parse($header);

            if (! $config->validator()->validate($parseToken, ...$constraints)) {
                throw new Exception('No way!');
            }

            return response()->json([
                'code'     => self::HTTP_SUCCESS_CODE,
                'status'   => true,
                'message'  => 'Jwt Token is validated successfully!',
                'response' => null
            ], self::HTTP_SUCCESS_CODE, [], JSON_PRETTY_PRINT);


        } catch (Exception $e) {

            return response()->json([
                'code' => self::HTTP_ERROR_CODE,
                'status' => false,
                'message' => $e->getMessage(),
                'response' => "Error at " . $e->getLine() . " line!"
            ], self::HTTP_ERROR_CODE, [], JSON_PRETTY_PRINT);
        }

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
            'payload'   => 'nullable | array',
            'expiredAt' => 'nullable | string | max:50',
        ];

        $validator = Validator::make($inputData, $rules);
        if ($validator->fails()) {
            return false;
        }

        return true;
    }

}
