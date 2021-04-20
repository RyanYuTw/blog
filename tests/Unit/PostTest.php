<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

use App\Http\Controllers\MailController;
use Illuminate\Http\Request;

// ./vendor/bin/phpunit tests/Unit --bootstrap=./vendor/autoload.php --filter=SendMail

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testSendMail()
    {
        $data = [
            "service_code" => "BE",
            "from"         => "cecyu.tw@gmail.com",
            "to"           => "cecyu.tw@gmail.com",
            "subject"      => "UnitTest API test-1",
            "body"         => "UnitTest API test body-1",
            "csrf"         => "0e4f525b3e900e87595b5639a51df021",
        ];

        $req = new Request($data);
        $appKey = $this->getAppKey();
        $key = base64_encode(sha1($appKey));

        $req->headers->set('Authorization', $key);

        $mailController = new MailController;
        $response = $mailController->send($req);

        $rs = json_decode($response->content(), true);

        $this->assertTrue($rs['status']);
        $this->assertSame(200, $rs['code']);
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

}
