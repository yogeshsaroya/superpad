<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class DataComponent extends Component {
    public $components = array('Session');

    
    public function fetch($url) {
        if(function_exists('curl_exec')) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36');
            $response = curl_exec($ch);
        }
        if(empty($response)) {
            $response = file_get_contents($url);
        }
        return $response;
    }
    
    public function get_settings() {
        $tbl = TableRegistry::get('Settings');
        try {
            return $data = $tbl->find('all')->where(['Settings.id'=>1])->first()->toArray();
        } catch (\Throwable $th) {
            return false;
        }
        
    }
    
  
}
?>