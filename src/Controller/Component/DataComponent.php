<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use PhpParser\Node\Stmt\TryCatch;

class DataComponent extends Component
{
    public $components = array('Session');


    public function fetch($url)
    {
        if (function_exists('curl_exec')) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36');
            $response = curl_exec($ch);
        }
        if (empty($response)) {
            $response = file_get_contents($url);
        }
        return $response;
    }

    public function get_settings()
    {
        $tbl = TableRegistry::get('Settings');
        try {
            return $data = $tbl->find('all')->where(['Settings.id' => 1])->first()->toArray();
        } catch (\Throwable $th) {
            return false;
        }
    }



    public function getTemplateSkeleton($s = null)
    {
        $t = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <meta name="format-detection" content="telephone=no"> <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"/> <meta name="viewport" content="width=device-width"> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> <title>' . WEBTITLE . '</title></head><body> <div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family: Verdana, Helvetica, Arial, serif; line-height:28px; height:100%; width: 100%; color: #514d6a;"> <div style="max-width: 700px; padding:50px 0; margin: 0px auto; font-size: 14px"> <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px"> <tbody> <tr> <td style="vertical-align: top; padding-bottom:30px;" align="center"> <a href="' . SITEURL . '" target="_blank"> <img src="' . SITEURL . 'images/logo.png" alt="" style="border:none;width: 200px;"></a> </td></tr></tbody> </table> <div style="padding: 40px; background: #fff;"> <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;"> <tbody> <tr> <td> [TEMPLATE_TEXT]</td></tr></tbody> </table> </div></div></div><div style="display: none; white-space: nowrap; font: 15px courier; color: #ffffff;">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</div></body></html>';
        $t = str_replace('[TEMPLATE_TEXT]', $s, $t);
        return $t;
    }

    public function AppMail($to, $type, $parameters = array())
    {
        $msg = 0;
        $tbl = TableRegistry::get('EmailTemplates');
        $emailformat = $tbl->find('all')->where(['EmailTemplates.id' => $type, 'EmailTemplates.status' => 1])->first();
        if (!empty($emailformat)) {
            $sub = $emailformat->subject;
            foreach ($parameters as $param_name => $param_value) {
                $sub = str_replace('[' . $param_name . ']', $param_value, $sub);
            }
            $body = $emailformat->message;
            foreach ($parameters as $param_name => $param_value) {
                $body = str_replace('[' . $param_name . ']', $param_value, $body);
            }
            foreach ($parameters as $param_name => $param_value) {
                $body = str_replace('[' . $param_name . ']', $param_value, $body);
            }
            $msg = $this->EmailServers($to, $sub, $body);
        }
        return $msg;
    }

    public function EmailServers($to = null, $sub = null, $body = null)
    {
        $msg = 0;

        if (!empty($to) && !empty($sub) && !empty($body)) {
            $tbl = TableRegistry::get('EmailServers');
            $body = $this->getTemplateSkeleton($body);
            $body = str_replace('[EMAIL_TITLE]', $sub, $body);
            $tbl_data = ['id'=>null,'email_to'=>$to,'subject'=>$sub,'message'=>$body,'status'=>0];
            $newEnt = $tbl->newEmptyEntity();
            $entity = $tbl->patchEntity($newEnt, $tbl_data);
            try {
                $tbl->save($entity);
                $msg = 1;
            } catch (\Throwable $th) {
                ec($th);die;    
                $msg = 0;
            }
        }
        return $msg;
    }
}
