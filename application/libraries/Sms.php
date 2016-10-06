<?php

/**
 * Created by PhpStorm.
 * User: suleymantarikogut
 * Date: 11.03.2016
 * Time: 21:09
 */
class Sms {

    private $username;
    private $password;
    private $orginator;
    private $_config;
    private $numaralar;
    private $url;

    public function __get($var) {
        return get_instance()->$var;
    }

    public function __construct() {

        $this->load->config('sms_config', TRUE);
        $this->_config = $this->config->item('sms_config');

        $this->username = $this->_config['username'];
        $this->password = $this->_config['password'];
        $this->orginator = $this->_config['orginator'];
        $this->url = $this->_config['api_url'];
    }

    public function getApiKey() {
        $packet = array('username' => $this->username, 'password' => $this->password);
        $jsonpacket = json_encode($packet);
        $request = $this->sendapi('/core/loginUser', $jsonpacket);
        return json_decode($request);
    }

    public function sendmessage($mesaj) {
        $tz = 'Europe/Istanbul';
		$timestamp = time();
		$dt = new DateTime("now", new DateTimeZone($tz));
		$dt->setTimestamp($timestamp);
		
        $array = array(
            'mesajmetni' => $mesaj,
            'numaralar' => $this->numaralar,
            'gonderimzamani' => $dt->format('Y-m-d H:i:s'),
            'dil' => 'tr',
            'flashsms' => 0,
            'apikey' => $this->getApiKey()->token,
            'type' => 'single', 
            'orjin' => $this->orginator
        );
        
        $request = $this->sendapi('/sms/sendsms', json_encode($array));
        
        return $request;
        
    }

    public function set_numaralar($numaralar) {
        $this->numaralar = $numaralar;
    }

    public function set_Title($baslik) {
        $this->orginator = $baslik;
    }

    public function sendapi($coreurl, $jsondata) {
        //echo $jsondata;
        $curl = curl_init();
        $url = $this->url . $coreurl;
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsondata);
        curl_setopt($curl, CURLOPT_ENCODING, 'UTF-8');
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

}
