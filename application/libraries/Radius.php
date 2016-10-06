<?php

/**
 * Created by PhpStorm.
 * User: suleymantarikogut
 * Date: 11.03.2016
 * Time: 21:47
 */
class Radius {

    public function __get($var) {
        return get_instance()->$var;
    }

    public function __construct() {
        $this->ci = & get_instance();
    }

    public function getConnection() {

        $conn = new PDO('mysql:host=127.0.0.1;dbname=hslinefi_hotspot-db', 'hslinefi_admin', 'F^%i(rWwB+TE', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));


        return $conn;
    }

    private $ci;

    public function createsms_user($username, $password, $ad, $soyad, $nasid, $gsmno) {
        $this->load->library('sms');
    }

    public function randomthing($size) {
        $characters = "0123456789";
        $str = "";
        while (strlen($str) < $size) {
            $str .= substr($characters, (rand() % strlen($characters)), 1);
        }
        return ($str);
    }

    public function getnasinfo($nas_id) {
        $db = $this->getConnection();
        $stmt = $db->prepare("select * from nas where id = :id");
        $stmt->execute(array('id' => $nas_id));

        return $stmt->fetch();
    }

    public function getplan($service_id) {
        $Query = $this->db->select('*')->get_where('plan_limits', array('id' => $service_id))->result_array();
        return $Query[0];
    }

    public function getplans($service_id) {
        $Query = $this->db->select('*')->get_where('genelayarlar', array('nas_id' => $service_id))->result_array();
        return $Query[0];
    }

    public function strtoupperTR($str) {
        $str = str_replace(array('i', 'ı', 'ü', 'ğ', 'ş', 'ö', 'ç'), array('İ', 'I', 'Ü', 'Ğ', 'Ş', 'Ö', 'Ç'), $str);
        return strtoupper($str);
    }

    public function tcno_dogrula($bilgiler) {

        $gonder = '<?xml version="1.0" encoding="utf-8"?>
		<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
		<soap:Body>
		<TCKimlikNoDogrula xmlns="http://tckimlik.nvi.gov.tr/WS">
		<TCKimlikNo>' . $bilgiler["tcno"] . '</TCKimlikNo>
		<Ad>' . $bilgiler["isim"] . '</Ad>
		<Soyad>' . $bilgiler["soyisim"] . '</Soyad>
		<DogumYili>' . $bilgiler["dogumyili"] . '</DogumYili>
		</TCKimlikNoDogrula>
		</soap:Body>
		</soap:Envelope>';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $gonder);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'POST /Service/KPSPublic.asmx HTTP/1.1',
            'Host: tckimlik.nvi.gov.tr',
            'Content-Type: text/xml; charset=utf-8',
            'SOAPAction: "http://tckimlik.nvi.gov.tr/WS/TCKimlikNoDogrula"',
            'Content-Length: ' . strlen($gonder)
        ));
        $gelen = curl_exec($ch);
        curl_close($ch);

        return strip_tags($gelen);
    }

    public function mbithesapla($deger, $tip) {

        if ($tip == 'Mbps') {
            $return = $deger * 1000000;
            return $return;
        }
        if ($tip == 'Kbps') {
            $return = $deger * 1000;
            return $return;
        }
    }

    public function mbytehesapla($deger, $tip) {
        if ($tip == "MB") {
            $return = $deger * 1024 * 1024;
            return $return;
        }
        if ($tip == "GB") {
            $return = $deger * 1024 * 1024 * 1024;
            return $return;
        }
    }

    public function zamanlimit($deger, $tip) {


        if ($tip == "Hrs") {
            $date = new DateTime('now', new DateTimeZone('Europe/Istanbul'));
            $f = "PT" . $deger . "H";
            $date->add(new DateInterval($f));

            $tarih = $date->format('Y-m-d');
            $saat = $date->format('H:i:s');

            $return = $tarih . 'T' . $saat . "TZD";
        } else {
            $d = "PT" . $deger . "M";

            $date = new DateTime('now', new DateTimeZone('Europe/Istanbul'));

            $date->add(new DateInterval($d));

            $tarih = $date->format('Y-m-d');
            $saat = $date->format('H:i:s');

            $return = $tarih . 'T' . $saat . "TZD";
        }

        return $return;
    }

    public function planupdate($username, $bwtype, $service_type, $nas_id, $mid) {

        $db = $this->getConnection();

        $db->exec("delete from radreply where nas_id='$nas_id' and username='$username'");


        $plan = $db->prepare("select * from plan_limits where id = :id limit 1");
        $plan->execute(array('id' => $service_type));
        $plandata = $plan->fetch();
        $limittype = $plandata['limit_type'];

        switch ($limittype) {
            case 0:
                break;

            case 1:
                $time_limit = $plandata['time_limit'];
                $time_unit = $plandata['time_unit'];
                $data_limit = $plandata['data_limit'];
                $data_unit = $plandata['data_unit'];
                $kotalimit = $this->mbytehesapla($data_limit, $data_unit);
                $zamanlimit = $this->zamanlimit($time_limit, $time_unit);
                $db->exec("insert into radreply(username,attribute,op,`value`,nas_id,mid) VALUES ('$username','WISPr-Session-Terminate-Time','=','$zamanlimit','$nas_id','$mid')");
                $db->exec("insert into radreply(username,attribute,op,`value`,nas_id,mid) VALUES ('$username','Mikrotik-Xmit-Limit','=','$kotalimit','$nas_id','$mid')");
                $db->exec("insert into radreply(username,attribute,op,`value`,nas_id,mid) VALUES ('$username','Acct-Input-Octets','=','$kotalimit','$nas_id','$mid')");
                $db->exec("insert into radreply(username,attribute,op,`value`,nas_id,mid) VALUES ('$username','Acct-Output-Octets','=','$kotalimit','$nas_id','$mid')");
//Mikrotik-Xmit-Limit
                break;
            case 2:
                $time_limit = $plandata['time_limit'];
                $time_unit = $plandata['time_unit'];
                $data_limit = $plandata['data_limit'];
                $data_unit = $plandata['data_unit'];

                $zamanlimit = $this->zamanlimit($time_limit, $time_unit);
                $db->exec("insert into radreply(username,attribute,op,`value`,nas_id,mid) VALUES ('$username','WISPr-Session-Terminate-Time','=','$zamanlimit','$nas_id','$mid')");

                break;
            case 3:
                $time_limit = $plandata['time_limit'];
                $time_unit = $plandata['time_unit'];
                $data_limit = $plandata['data_limit'];
                $data_unit = $plandata['data_unit'];
                $kotalimit = $this->mbytehesapla($data_limit, $data_unit);

                $db->exec("insert into radreply(username,attribute,op,`value`,nas_id,mid) VALUES ('$username','Mikrotik-Xmit-Limit','=','$kotalimit','$nas_id','$mid')");
                $db->exec("insert into radreply(username,attribute,op,`value`,nas_id,mid) VALUES ('$username','Acct-Input-Octets','=','$kotalimit','$nas_id','$mid')");
                $db->exec("insert into radreply(username,attribute,op,`value`,nas_id,mid) VALUES ('$username','Acct-Output-Octets','=','$kotalimit','$nas_id','$mid')");

                break;
        }


        $service = $db->prepare("select * from bw_policies where id = :id");
        $service->execute(array('id' => $bwtype));
        $servicedata = $service->fetch();
        $max_down = $servicedata['max_down'];
        $max_down_unit = $servicedata['max_down_unit'];
        $max_up = $servicedata['max_up'];
        $max_up_unit = $servicedata['max_up_unit'];


        //download limiti tanımlaması
        $uploadlimit = $this->mbithesapla($max_up, $max_up_unit);
        $downloadlimit = $this->mbithesapla($max_down, $max_down_unit);
        $db->exec("insert into radreply(username,attribute,op,`value`,nas_id,mid) VALUES ('$username','WISPr-Bandwidth-Max-Up','=','$uploadlimit','$nas_id','$mid'),('$username','WISPr-Bandwidth-Max-Down','=','$downloadlimit','$nas_id','$mid')");
    }

}
