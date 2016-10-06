<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('payment_model');
    }

    public function index() {
        /*
          $this->where('shortname', $locationid);
          $data = $this->db->get('nas')->result()[0];
          var_dump($data);
         */
        //$this->load->view('hata');
    }

    public function logout() {
        $this->load->library('HybridAuthLib');
        $this->hybridauthlib->authenticate('Facebook')->logout();
    }

    public function testsocial() {
        $this->load->view('hauth/home');
    }

    public function getlokasyon($locationid = null) {
        if ($locationid != null) {
            //$locationid = $this->db->escape($locationid);
            $this->db->where('shortname', $locationid);
            $data = $this->db->get('nas')->row();
            if ($data) {
                if ($data->durum == 1) {
                    
                    $user_id = $this->session->userdata('user_id');
                    if($user_id) {
                        $this->db->where('id', $user_id);
                        $user_data = $this->db->get('user_accounts')->row();
                        
                        if($user_data){
                            $available_time = $this->get_user_available_time($user_data->uname);
                            if($available_time <= 0) {
                                redirect('welcome/expired');
                                exit;
                            }
                        }
                    }

                    $login_comm = $this->db
                                        ->where('nas_id', $data->id)
                                        ->where('type', 0)
                                        ->where('type_page', 0)
                                        ->get('nas_commerical')->result_array();
                    if (is_array($login_comm) && count($login_comm)){
                        $numb = rand(0,count($login_comm)-1);
                    }

                    $serviceid = $data->service_id;
                    if (isset($serviceid)) {

                        $this->db->where('nas_id', $serviceid);
                        $this->db->where('durum', 'Aktif');
                        $this->db->order_by('id', 'random');
                        $kampanya = $this->db->get('linefi_campaign')->row();
                        if(isset($numb)) {
                            $file_data = (array)json_decode($login_comm[$numb]['data']);
                            $kampanya->image = $file_data['path'];
                            $kampanya->title = $login_comm[$numb]['title'];
                            $kampanya->description = $login_comm[$numb]['description'];
                        }
                    }
                    $this->db->where('service_id', $serviceid);
                    $cihazdata = $this->db->get('hslinefi_hotspot-db.nas')->row();

                    $locaction_plans = $this->payment_model->get_plans_for_location($locationid);
                    
                    $sms_timer = 0;
                    $last_sms_sended = $this->session->userdata('last_sms_sended');
                    if($last_sms_sended) {
                        $sms_timer = 120 - (time() - $last_sms_sended);
                        if($sms_timer < 0) {
                            $sms_timer = 0;
                            $this->session->unset_userdata('last_sms_sended');
                        }
                    }
                    //if ($cihazdata->cihaztipi == "Mikrotik") {
                    //  $data = array(
                    //      'nasbilgi' => $data, 
                    //      'kampanya' => $kampanya, 
                    //      'tip' => $cihazdata,
                    //      'sms_timer' => $sms_timer
                    //  );
                    //    $this->load->view('mikrotik', $data);
                    //}
                    //if ($cihazdata->cihaztipi == "Pfsense") {
                        $this->load->library('session');
                        if (!empty($_POST['action']))
                            $this->session->set_userdata('action', $_POST['action']);
                        else {
                            $_POST['action'] = $this->session->userdata('action');
                        }

                        // if (!empty($_GET['redirurl'])){
                        // $_POST['redirurl'] = urldecode($_GET['redirurl']);
                        // }
                        $_POST['redirurl'] = 'http://hotspot.linefi.net/welcome/status/' . $data->shortname;
                        $data = array(
                            'nasbilgi' => $data, 
                            'kampanya' => $kampanya, 
                            'tip' => $cihazdata,
                            'locaction_plans' => $locaction_plans,
                            'sms_timer' => $sms_timer,
                            'device' => $cihazdata->cihaztipi
                        );
                        $this->load->view('pfsense', $data);
                    //}
                } else {
                    $this->load->view('hata');
                }
            } else {
                $this->load->view('hata');
            }
        } else {
            $this->load->view('hata');
        }
    }

    public function sms() {
        $this->load->library('Sms');
        $sms_gonder = new Sms();
        $sms_gonder->set_Title('LineFi');
        $sms_gonder->set_numaralar(array('05534187744'));
        $sms_gonder->sendmessage("emin abi bana uçak bileti alırmısın");
    }

    public function status($locationid) {

        if ($locationid != null) {
            //$locationid = $this->db->escape($locationid);
            $userid = $this->input->get('user');

            $this->db->where('uname', $userid);
            $userdata = $this->db->get('user_accounts')->row();

            $this->db->where('identifier', $userid);
            $socialdata = $this->db->get('social_profiles')->row();


            $this->db->where('shortname', $locationid);
            $data = $this->db->get('nas')->row();
            $this->db->where('hslinefi_hotspot-db.nas.service_id', $data->service_id);
            $nas_whmcs = $this->db->get('hslinefi_hotspot-db.nas')->row();


            if ($data) {
                if ($data->durum == 1) {
                    $serviceid = $data->service_id;
                    if (isset($serviceid)) {

                        $this->db->where('nas_id', $serviceid);
                        $this->db->where('durum', 'Aktif');
                        $this->db->order_by('id', 'random');
                        $kampanya = $this->db->get('linefi_campaign')->row();
                    }


                    switch ($data->tip) {
                        case 0:
                            $this->load->view('status', array('status' => $data, 'kampanya' => $kampanya, 'userdata' => $userdata, 'socialdata' => $socialdata, 'ssdid' => $nas_whmcs));

                            break;
                        case 1:
                            $this->load->view('status', array('status' => $data, 'kampanya' => $kampanya, 'userdata' => $userdata, 'socialdata' => $socialdata, 'ssdid' => $nas_whmcs));
                            break;
                    }
                } else {
                    $this->load->view('hata');
                }
            } else {
                $this->load->view('hata');
            }
        } else {
            $this->load->view('hata');
        }
    }

    public function getstatus($locationid = null) {


        if ($locationid != null) {
            //$locationid = $this->db->escape($locationid);

            $this->db->where('shortname', $locationid);
            $data = $this->db->get('nas')->row();


            if ($data) {
                if ($data->durum == 1) {
                    $serviceid = $data->service_id;
                    if (isset($serviceid)) {

                        $this->db->where('nas_id', $serviceid);
                        $this->db->where('durum', 'Aktif');
                        $this->db->order_by('id', 'random');
                        $kampanya = $this->db->get('linefi_campaign')->row();
                    }


                    switch ($data->tip) {
                        case 0:
                            $this->load->view('mikrotik', array('nasbilgi' => $data, 'kampanya' => $kampanya));

                            break;
                        case 1:
                            $this->load->view('mikrotik', array('nasbilgi' => $data, 'kampanya' => $kampanya));
                            break;
                    }
                } else {
                    $this->load->view('hata');
                }
            } else {
                $this->load->view('hata');
            }
        } else {
            $this->load->view('hata');
        }
    }

    public function get_plan_data() {

        $plan_id = trim($this->input->post('plan_id', true));
        if (empty($plan_id)) {
            exit(json_encode(array('status' => 0, 'message' => 'Plan id is not send')));
        }

        $plan = $this->payment_model->get_plan_by_id($plan_id);

        if ($plan) {
            $this->session->set_userdata('selected_plan', $plan_id);

            exit(json_encode(array('status' => 1, 'plan' => $plan)));
        } else {
            exit(json_encode(array('status' => 0, 'message' => 'Plan not found')));
        }
    }



    public function test() {
        echo "<pre>";
        var_dump($params);
        echo "</pre>";
        exit;
    }

    public function expired() {
        // $this->session->set_userdata('nas_shortname','i84llil5');//DEBUG ONLY
        $nas_shortname = $this->session->userdata('nas_shortname');

        if (!$nas_shortname){
            redirect('http://google.com/', 302);
            exit;
        }
        
        $videos = $this->db
                ->select('nas_commerical.*, nas.nasname')
                ->where('type_page', 1)
                ->from('nas_commerical')
                ->join('nas', "nas.id = nas_commerical.nas_id", 'left', true)
                ->where('nas.shortname', $nas_shortname)
                ->get()
                ->result_array();

        if (count($videos)){
            
            $numb = rand(0,count($videos)-1);
            $video = $videos[$numb];
            $video = json_decode($video['data']);
            if ($video->file_type == 'video/mp4'){
                
                $video->length = explode(':',$video->length);           
                $video->length = round(((int)$video->length[0]*60)+$video->length[1]);
        
            }
            
            $this->load->view('expired', array('video' => $video) );
        }
        else{           
            redirect('/hauth/reset',302);
            exit;
        }
        
            
        
    }
    
    protected function get_user_available_time($username) {
        $query_str = "SELECT GREATEST(radcheck.value - SUM(radacct.acctsessiontime), 0) as total FROM radacct LEFT JOIN radcheck ON radacct.username = radcheck.username WHERE radacct.username = '{$username}' AND radcheck.attribute = 'Max-Daily-Session' GROUP BY radacct.username;";
        $resuslt = $this->db->query($query_str)->row_array();
        if($resuslt['total'] === NULL) {
            return 1;
        }
        return $resuslt['total'];
    }


    public function success() {
       $this->load->view('stripe_success_temp'); //Show stripe_success_temp if card accepted
    }

    public function failed() {
       $this->load->view('stripe_failed_temp'); //Show stripe_success_temp if card accepted
    }



    public function stripe_charge($packageID, $nasID) {
        $phone =$this->input->post('phone');
        $token = $this->input->post('stripeToken');
        if($phone == "" || $token == "") {
            $this->session->set_flashdata('striperror', 'All Fields Required');
            redirect('/welcome/failed');
            exit();
        }
        $plan = $this->db->get_where('nas_plans', array('nas_id' => intval($nasID), 'id' => $packageID))->row();
        if (!$plan) {
            $this->session->set_flashdata('striperror', 'Something Went Wrong');
            redirect('/welcome/failed');
            exit();
        } 
        $amount = $plan->price;
        $currency = "USD";
        $description = $plan->title;
        $invoiceno = substr(str_shuffle(MD5(microtime())), 8, 12);
        $pendings = array(
                'invoice_no' => $invoiceno,
                'amount' => $amount,
                'status' => '0'
            );
            $this->db->insert('stripe_pendings', $pendings);
            $pendingid = $this->db->insert_id();
        require_once(APPPATH.'libraries/stripe/Stripe.php');
        Stripe::setApiKey('sk_live_QX5La65ZGl8kRCDNByeSovr1'); // set stripe api key here
        try {
            Stripe_Charge::create(array(
                "amount" => number_format($amount,2,".","")*100,
                "currency" => $currency,
                "card" => $token,
                "description" => $description,
                "metadata" => array("packageid" => $packageID, "nas_id" => $nasID, "phone" => $phone, "invoice_no" => $invoiceno, "pendingid" => $pendingid)
                ));
            $this->session->set_flashdata('stripsuccess', 'Your Card Has Been Accepted. You will receive a sms with login credentials. Don’t forget to check your phone. This may take 1 to 5 min.');
            redirect('/welcome/getlokasyon/3598l5ef?show_login_form=1');
            exit();
        }
        catch(Exception $e){
                        $return_msg = $e->getMessage();
                        $error = $return_msg;
                        $this->session->set_flashdata('striperror', $error);
                        redirect('/welcome/failed');
                        exit();
                    }

    } // stripe_charge end
    public function stripe_success() {
        $body = @file_get_contents('php://input');
        $ev = json_decode($body);
        if($ev->type=='charge.succeeded') {
            $amountincents = $ev->data->object->amount;
            $amount = $amountincents / 100;
            $packageid = $ev->data->object->metadata->packageid;
            $nas_id = $ev->data->object->metadata->nas_id;
            $phone = $ev->data->object->metadata->phone;
            $invoice_no = $ev->data->object->metadata->invoice_no;
            $pendingid = $ev->data->object->metadata->pendingid;
            $pendindrow = $this->db->get_where('stripe_pendings', array('id' => $pendingid))->row();
            if(!$pendindrow) {
                echo "Pending Is Mismatch";
                exit();
            }
            if($pendindrow->invoice_no != $invoice_no) {
                echo "Invoice No Mismatch";
                exit();
            }
            if($pendindrow->amount != $amount) {
                echo "Amount Mismatch";
                exit();
            } 
            if($pendindrow->status == 1) {
                echo "Status: Already Processed";
                exit();
            }
             $this->load->library('Radius');
            $radius = new Radius();
            $plan_id = $packageid;
            $username = substr($phone, 1);
            $nasbilgi = $radius->getnasinfo($nas_id);
                $password = $radius->randomthing(6);
            $plan = $this->db->get_where('nas_plans', array('nas_id' => intval($nas_id), 'id' => $plan_id))->row();
            if ($plan && $nasbilgi) {
                $usercheck = $this->db->get_where('user_accounts', array('uname' => $username))->row();
                if(!$usercheck) { //if user didnt exisw.

                    $user_insert = array( 'uname' => $username,'clear_pword' => $password,'fname' => $username,'lname' => $username,'durum' => '1','users_type' => '4','product_id' => $nasbilgi['service_id']);
                    $this->db->insert('user_accounts', $user_insert);
                    $mid = $this->db->insert_id();

                    $rad_insert = array('username' => $username, 'attribute' => 'User-Password', 'op' => '==', '`value`' => $password, 'service_id' => $nasbilgi['service_id'], 'mid' => $mid, 'volume' => $plan->quota);
                    $this->db->insert('radcheck', $rad_insert);
                    $rad_insert_max = array(
                      'username' => $username ,
                      'attribute' => 'Max-Daily-Session' ,
                      'op' => ':=',
                      '`value`' => $plan->time ,
                      'service_id' => $nasbilgi['service_id']
                      ); 
                    $this->db->insert('radcheck', $rad_insert_max);
                $radug_insert = array('username' => $username, 'groupname' => $plan->rgp_groupname, 'priority' => '1');
                $this->db->insert('radusergroup', $radug_insert);

                } else { // user already exist
                    if($usercheck->product_id != $nasbilgi['service_id']) { //if user already exist but product_id id is defferent. then enter new record of user
                       $user_insert = array( 'uname' => $username,'clear_pword' => $password,'fname' => $username,'lname' => $username,'durum' => '1','users_type' => '4','product_id' => $nasbilgi['service_id']);
                       $this->db->insert('user_accounts', $user_insert);
                       $mid = $this->db->insert_id();


                       $rad_insert = array('username' => $username, 'attribute' => 'User-Password', 'op' => '==', '`value`' => $password, 'service_id' => $nasbilgi['service_id'], 'mid' => $mid, 'volume' => $plan->quota);
                    $this->db->insert('radcheck', $rad_insert);
                    $rad_insert_max = array(
                      'username' => $username ,
                      'attribute' => 'Max-Daily-Session' ,
                      'op' => ':=',
                      '`value`' => $plan->time ,
                      'service_id' => $nasbilgi['service_id']
                      ); 
                    $this->db->insert('radcheck', $rad_insert_max);
                       $radug_insert = array('username' => $username, 'groupname' => $plan->rgp_groupname, 'priority' => '1');
                       $this->db->insert('radusergroup', $radug_insert);
                    } else  { // if product id is same than update all records again
                        $mid = $usercheck->id;
                        $user_insert = array('clear_pword' => $password,'durum' => '1','users_type' => '4');
                        $this->db->where('uname', $username);  
                        $this->db->update('user_accounts', $user_insert);

                        $rad_insert = array('attribute' => 'User-Password', 'op' => '==', '`value`' => $password,'volume' => $plan->quota);
                        $array = array('username' => $username, 'mid' => $mid);
                        $this->db->where($array);
                        $this->db->update('radcheck', $rad_insert);


                        $rad_insert_max = array('attribute' => 'Max-Daily-Session', 'op' => ':=', '`value`' => $plan->time, 'service_id' => $nasbilgi['service_id']);
                        $array = array('username' => $username, 'mid' => 0);
                        $this->db->where($array);
                        $this->db->update('radcheck', $rad_insert_max);

                        $radug_insert = array('groupname' => $plan->rgp_groupname, 'priority' => '1');
                        $this->db->where('username', $username);
                        $this->db->update('radusergroup', $radug_insert);
                    }
                } // user already exist- condition end here
                $data = array(  
                    'status' => 1 
                    );  
                $this->db->where('id', $pendingid);  
                $this->db->update('stripe_pendings', $data); 


                $wdb = $this->load->database('default', TRUE);

                $wdb->where('service_id', $nasbilgi['service_id']);
                $cihazdata = $wdb->get('nas')->row();
                if(substr($phone, 0, 3) == "+90") {
                    $this->load->library('Sms');
                 $sms_gonder = new Sms();
                 $sms_gonder->set_Title('LineFi');
                 $sms_gonder->set_numaralar(array($phone));
                 $sms_gonder->sendmessage("Username:" . $username . " Password:" . $password . " Thank you for purchasing LineFi Premium! Amount Charged: ".$amount." USD");
                 echo "Sms Send From Local</br>";
                }
                else {
                $mesaj = "Username:". $username ." Password:". $password ." Thank you for purchasing LineFi Premium! Amount Charged: ".$amount." USD";
                    require( APPPATH . 'third_party/twilio/Services/Twilio.php');
                    $this->load->config('twilio_config', TRUE);
                    $config = $this->config->item('twilio_config');
                    $client = new Services_Twilio($config['sid'], $config['token']);
                    $message = $client->account->messages->sendMessage(
                      '+12034906451', 
                      $phone, 
                      $mesaj
                      );
                    echo "Sms Sent From Twilio</br>";
                }
                echo "Status:200";
            } // if plans an nasbilgi
    } // $ev->type=='charge.succeeded' end
    } // stripe_success End


}
