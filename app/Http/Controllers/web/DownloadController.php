<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

class DownloadController extends Controller
{
    public function download($id){

       if ($id == 1){

           $file= realpath(base_path('public/storage/files/news/1486436937')).'/公益活动申请表.docx';

           $headers = array(
               'Content-Type => application/vnd.openxmlformats-officedocument.wordprocessingml.document',
           );

           return response()->download($file, '公益活动申请表.docx',$headers);
       }elseif ($id == 2){
           $file= realpath(base_path('public/storage/files/news/1486436940')).'/特贫申请资助表.docx';

           $headers = array(
               'Content-Type => application/vnd.openxmlformats-officedocument.wordprocessingml.document',
           );

           return response()->download($file, '特贫申请资助表.docx',$headers);
       }elseif ($id == 3){
           $file= realpath(base_path('public/storage/files/news/1486436943')).'/委托书.docx';

           $headers = array(
               'Content-Type => application/vnd.openxmlformats-officedocument.wordprocessingml.document',
           );

           return response()->download($file, '委托书.docx',$headers);
       }


    }

}
