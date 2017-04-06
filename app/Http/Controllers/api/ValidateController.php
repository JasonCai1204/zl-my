<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Code;
use App\SMS\SendTemplateSMS;
use App\SMS\M3Result;

class ValidateController extends Controller
{
    public function sendSMS(Request $request)
    {

        $m3_result = new M3Result;

        $phone = $request->phone_number;

        if ($phone == ''){
            $m3_result->status = -1;
            $m3_result->msg = '手机不能为空';
            return $m3_result->toJson();
        }

        if (!preg_match("/^1[34578]\d{9}$/", $phone)){

            $m3_result->status = -1;
            $m3_result->msg = '手机格式不正确';
            return $m3_result->toJson();
        }

        $sendTemplateSMS = new SendTemplateSMS;
        $code = '';
        $charset = '1234567890';
        $_len = strlen($charset) - 1;
        for ($i = 0;$i < 4;++$i) {
            $code .= $charset[mt_rand(0, $_len)];
        }

        $m3_result = $sendTemplateSMS->sendTemplateSMS($phone, array($code, 2), 162978);

        if ($m3_result->status == 0){

            if (count(Code::where('phone_number',$phone)->get())>0){

                $tempphone = Code::where('phone_number',$phone)->first();

                $tempphone->code = $code;

                $tempphone->save();
            }else {
                $tempphone = new Code();

                $tempphone->phone_number = $phone;

                $tempphone->code = $code;

                $tempphone->save();
            }

        }

        return $m3_result->toJson();

    }
}
