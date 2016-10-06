<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class HAuth extends CI_Controller {

    public function index() {
        $this->load->view('hauth/home');
    }

    public function sms() {
        require( APPPATH . 'third_party/twilio/Services/Twilio.php');
        $this->load->config('twilio_config', TRUE);

        $location_shortname = $this->input->get('nasbilgi', TRUE);
        $this->load->library('Radius');
        $radius = new Radius();
        $nas_id = $this->input->post('nasid');

        $nasbilgi = $radius->getnasinfo($nas_id);
        $plans = $radius->getplans($nas_id);
        $plan_data = $radius->getplan($plans['sms']);
        
        $bwsocial = $plans['bwsocial'];
        $srvsocial = $plans['swsocial'];
        $gsmno = trim($this->input->post('intl_number', true));
        $username = str_replace("+", "", $gsmno);
        $firsname = $radius->strtoupperTR($this->input->post('kimlik_ad', true));
        $lastname = $radius->strtoupperTR($this->input->post('kimlik_soyad', true));
        $country = $this->input->post('country', true);
        $dialcode = $this->input->post('dialcode', true);
        $number_is_valid = $this->input->post('number_is_valid', true);
        
        $this->db->where('uname', $username);
        $this->db->where('product_id', $nasbilgi['service_id']);
        $data = $this->db->get('user_accounts')->row();

        if (!$data) {
            if($nasbilgi['service_id'] == 72) {
                $password = $radius->randomthing(4);
            }
            else {
                $password = $radius->randomthing(6);
            }
            $user_insert = array('uname' => $username, 'clear_pword' => $password, 'fname' => $firsname, 'lname' => $lastname, 'gsmno' => $gsmno, 'durum' => '1', 'users_type' => '4', 'service_type' => $srvsocial, 'product_id' => $nasbilgi['service_id']);
            $this->db->insert('user_accounts', $user_insert);
            $mid = $this->db->insert_id();
            $this->session->set_userdata('user_id', $mid);
            $this->session->set_userdata('nas_shortname', $nasbilgi['shortname']);
            
            $rad_insert = array('username' => $username, 'attribute' => 'User-Password', 'op' => '==', '`value`' => $password, 'service_id' => $nasbilgi['service_id'], 'mid' => $mid, 'volume' => $plan_data['data_limit']);
            $this->db->insert('radcheck', $rad_insert);
            $rad_insert2 = array('username' => $username, 'attribute' => 'Max-Daily-Session', 'op' => ':=', '`value`' => $plan_data['time_limit']*60, 'service_id' => $nasbilgi['service_id']);
            $this->db->insert('radcheck', $rad_insert2);
            $radug_insert = array('username' => $username, 'groupname' => $plan_data['rgp_groupname'], 'priority' => '1');
            $this->db->insert('radusergroup', $radug_insert);
            $radius->planupdate($username, $bwsocial, $srvsocial, $nasbilgi['service_id'], $mid);


            $sociallogin['username'] = $username;
            $sociallogin['password'] = $password;
            $sociallogin['nas_ip'] = $nasbilgi['nas_ip'];
            
            $mesaj = "Username: " . $username . " Password: " . $password;
            
            if($country == 'tr') {
                $this->load->library('Sms');
                
                $sms_gonder = new Sms();
                $sms_gonder->set_Title('LineFi');
                $sms_gonder->set_numaralar(array($gsmno));
                $sms_gonder->sendmessage($mesaj);
            } else {
                $this->load->config('twilio_config', TRUE);
                $config = $this->config->item('twilio_config');
                
                $client = new Services_Twilio($config['sid'], $config['token']);
                $message = $client->account->messages->sendMessage(
                  '+12034906451', 
                  $gsmno, 
                  $mesaj
                );
            }
            
        } else {
            $this->session->set_userdata('user_id', $data->id);
            $this->session->set_userdata('nas_shortname', $nasbilgi['shortname']);

            $available_time = $this->get_user_available_time($data->uname);

            if($available_time <= 0) {
                redirect('welcome/expired');
                exit;
            }
            
            $this->db->update('radusergroup', array('groupname' => $plan_data['rgp_groupname']), array('username' => $data->uname));
            
            $username = $data->uname;
            $password = $data->clear_pword;
            $ad = $data->fname;
            $soyad = $data->lname;
            $sociallogin['nas_ip'] = $nasbilgi['nas_ip'];
            $mesaj = "Username: " . $username . " Password: " . $password;
            
            if($country == 'tr') {
                $this->load->library('Sms');
                
                $sms_gonder = new Sms();
                $sms_gonder->set_Title('LineFi');
                $sms_gonder->set_numaralar(array($gsmno));
                $sms_gonder->sendmessage($mesaj);
            } else {
                $this->load->config('twilio_config', TRUE);
                $config = $this->config->item('twilio_config');
                
                $client = new Services_Twilio($config['sid'], $config['token']);
                $message = $client->account->messages->sendMessage(
                  '+12034906451', 
                  $gsmno, 
                  $mesaj
                );
            }
            
        }

        $service_id = $nasbilgi['service_id'];
        if (isset($service_id)) {

            $this->db->where('nas_id', $service_id);
            $this->db->where('durum', 'Aktif');
            $this->db->order_by('id', 'random');
            $kampanya = $this->db->get('linefi_campaign')->row();
        }

        $this->db->where('service_id', $nasbilgi['service_id']);
        $cihazdata = $this->db->get('hslinefi_hotspot-db.nas')->row(); //incorrect db
        $sociallogin['cihaztipi'] = $cihazdata;
        if ($location_shortname) {
            $this->session->set_userdata('last_sms_sended', time());
            redirect('/welcome/getlokasyon/' . $location_shortname . '?show_login_form=1');
        }
        $cihazdata->nas_ip = $nasbilgi['nas_ip']; // correction ip
        if ($cihazdata->cihaztipi == "Mikrotik") {

            $this->load->view('loginsms', array('kampanya' => $kampanya, 'nasbilgi' => $nasbilgi));
        }
        if ($cihazdata->cihaztipi == "Pfsense") {

            $this->load->view('loginsmspfsense', array('kampanya' => $kampanya, 'nasbilgi' => $nasbilgi, 'cihaztipi' => $cihazdata, 'pfsense' => true));
        }
    }
    
    public function smslogin() {
        $auth_user = trim($this->input->post('auth_user', true));
        $auth_pass = trim($this->input->post('auth_pass', true));
        $nas_id = trim($this->input->post('nasid'));

        $this->load->library('Radius');
        $radius = new Radius();
        $nasbilgi = $radius->getnasinfo($nas_id);
        
        $this->db->where('uname', $auth_user);
        $this->db->where('product_id', $nasbilgi['service_id']);
        $user_data = $this->db->get('user_accounts')->row();
        
        if($user_data) {
            $this->session->set_userdata('user_id', $user_data->id);
            $this->session->set_userdata('nas_shortname', $nasbilgi['shortname']);

            
            $available_time = $this->get_user_available_time($user_data->uname);
            if($available_time <= 0) {
                redirect('welcome/expired');
                exit;
            }
        }
        
        $wdb = $this->load->database('default', TRUE);
        $wdb->where('service_id', $nasbilgi['service_id']);
        $cihazdata = $wdb->get('nas')->row();
                    
        $data = array(
            'auth_user' => $auth_user,
            'auth_pass' => $auth_pass,
            'nas_ip' => $nasbilgi['nas_ip'],
            'location_name' => $cihazdata->location_name,
            'base_url' => $this->config->base_url(),
            'device' => $cihazdata->cihaztipi
        );

        $this->load->view('hauth/dosms', $data);
    }
    
    
    public function paypal_callback($nas_id) {
        $this->load->library('Radius');
        $radius = new Radius();
        $plan_id = $this->session->userdata('selected_plan');
        $nasbilgi = $radius->getnasinfo($nas_id);
        $plan = $this->db->get_where('nas_plans', array('nas_id' => intval($nas_id), 'id' => $plan_id))->row();
        if ($plan && $nasbilgi) {
            $bwsocial = $plan->bw;
            $srvsocial = $plan->sw;
            $username = $radius->randomthing(15);
            $password = $radius->randomthing(6);
            $user_insert = array('uname' => $username, 'clear_pword' => $password, 'fname' => $username,
                'lname' => $username, 'durum' => '1', 'users_type' => '4',
                'plan_type' => $bwsocial, 'service_type' => $srvsocial, 'product_id' => $nasbilgi['service_id']);
            $this->db->insert('user_accounts', $user_insert);
            $mid = $this->db->insert_id();
            $rad_insert = array('username' => $username, 'attribute' => 'User-Password', 'op' => '==', '`value`' => $password, 'service_id' => $nasbilgi['service_id'], 'mid' => $mid);
            $this->db->insert('radcheck', $rad_insert);
            $rad_insert2 = array('username' => $username, 'attribute' => 'Max-Daily-Session', 'op' => ':=', '`value`' => '60', 'service_id' => $nasbilgi['service_id']);
            $this->db->insert('radcheck', $rad_insert2);
            $radius->planupdate($username, $bwsocial, $srvsocial, $nasbilgi['service_id'], $mid);


            $this->db->where('service_id', $nasbilgi['service_id']);
            $cihazdata = $this->db->get('hslinefi_hotspot-db.nas')->row();
            $paymentlogin['cihaztipi'] = $cihazdata;
            $paymentlogin['shortname'] = $nasbilgi['shortname'];
            $paymentlogin['username'] = $username;
            $paymentlogin['password'] = $password;
            $paymentlogin['nas_ip'] = $nasbilgi['nas_ip'];
            if ($cihazdata->cihaztipi == "Mikrotik") {
                $this->load->view('payment/done', $paymentlogin);
            }
            if ($cihazdata->cihaztipi == "Pfsense") {
                $this->load->view('payment/donepfsense', $paymentlogin);
            }
        } else {
            $this->redirect('/');
        }
    }

    public function tckimlik() {
        $this->load->library('Radius');
        $radius = new Radius();
        $nas_id = $this->input->post('nasid');

        $nasbilgi = $radius->getnasinfo($nas_id);
        $plans = $radius->getplans($nasbilgi['service_id']);
        $bwsocial = $plans['bwsocial'];
        $srvsocial = $plans['swsocial'];
        $username = "TC" . $this->input->post('kimlik_no');
        $tckimlik = $this->input->post('kimlik_no');
        $firsname = $radius->strtoupperTR($this->input->post('kimlik_ad'));
        $lastname = $radius->strtoupperTR($this->input->post('kimlik_soyad'));
        $dogumyili = (int) $this->input->post('kimlik_dogumtarihi');


        $bilgiler = array('tcno' => $tckimlik, 'isim' => $firsname, 'soyisim' => $lastname, 'dogumyili' => $dogumyili);
        $result = $radius->tcno_dogrula($bilgiler);
        $this->db->delete('radcheck', array('username' => $username));

        if ($result) {
            $this->db->where('uname', $username);
            $this->db->where('product_id', $nasbilgi['service_id']);
            $data = $this->db->get('user_accounts')->row();
            if (!$data) {
                if(!$data->disabled) {
                    $password = $radius->randomthing(20);


                    $user_insert = array('uname' => $username, 'clear_pword' => $password, 'fname' => $firsname, 'lname' => $lastname, 'tckimlik' => $tckimlik, 'durum' => '1', 'users_type' => '4', 'plan_type' => $bwsocial, 'service_type' => $srvsocial, 'product_id' => $nasbilgi['service_id']);
                    $this->db->insert('user_accounts', $user_insert);
                    $mid = $this->db->insert_id();
                    $rad_insert = array('username' => $username, 'attribute' => 'User-Password', 'op' => '==', '`value`' => $password, 'service_id' => $nasbilgi['service_id'], 'mid' => $mid);
                    $this->db->insert('radcheck', $rad_insert);
                    $rad_insert2 = array('username' => $username, 'attribute' => 'Max-Daily-Session', 'op' => ':=', '`value`' => '60', 'service_id' => $nasbilgi['service_id']);
                    $this->db->insert('radcheck', $rad_insert2);
                    $radius->planupdate($username, $bwsocial, $srvsocial, $nasbilgi['service_id'], $mid);
                    $sociallogin['username'] = $username;
                    $sociallogin['password'] = $password;
                    $sociallogin['nas_ip'] = $nasbilgi['nas_ip'];
                }
                else{
                    redirect('welcome/expired');
                }
            } else {
                $sociallogin['username'] = $data->uname;
                $sociallogin['password'] = $data->clear_pword;
                $sociallogin['nas_ip'] = $nasbilgi['nas_ip'];
            }
            $this->db->where('service_id', $nasbilgi['service_id']);
            $cihazdata = $this->db->get('hslinefi_hotspot-db.nas')->row();
            $sociallogin['cihaztipi'] = $cihazdata;


            if ($cihazdata->cihaztipi == "mikrotik") {
                $this->load->view('hauth/done', $sociallogin);
            }
            if ($cihazdata->cihaztipi == "Pfsense") {


                $this->load->view('hauth/donepfsense', $sociallogin);
            }
        } else {
            $this->redirect('/');
        }
    }

    public function login($provider) {
        log_message('debug', "controllers.HAuth.login($provider) called");

        $nas_id = $this->input->get('nasid');
        $action = $this->input->get('action');
        try {
            log_message('debug', 'controllers.HAuth.login: loading HybridAuthLib');
            $this->load->library('HybridAuthLib');

            if ($this->hybridauthlib->providerEnabled($provider)) {
                log_message('debug', "controllers.HAuth.login: service $provider enabled, trying to authenticate.");
                $service = $this->hybridauthlib->authenticate($provider);

                if ($service->isUserConnected()) {
                    log_message('debug', 'controller.HAuth.login: user authenticated.');

                    $user_profile = $service->getUserProfile();
                    $oAuth = $service->getAccessToken();
                    $consumer = $service->getConfigById($provider);
                    log_message('info', 'controllers.HAuth.login: user profile:' . PHP_EOL . print_r($user_profile, TRUE));
                    $data['user_profile'] = $user_profile;

                    $profiles = array();
                    foreach ($user_profile as $item => $value) {
                        $profiles[$item] = $value;
                    }
                    $profiles['network'] = $provider;

                    $this->load->library('Radius');
                    $radius = new Radius();

                    $nasbilgi = $radius->getnasinfo($nas_id);
                    $plans = $radius->getplans($nas_id);
                    $plan_data = $radius->getplan($plans['social']);
                    $bwsocial = $plans['bwsocial'];
                    $srvsocial = $plans['swsocial'];
                    
                    $username = $profiles['identifier'];
                    $this->db->where('uname', $username);
                    $this->db->where('product_id', $nasbilgi['service_id']);
                    $data = $this->db->get('user_accounts')->row();


                    if (!isset($data)) {
                        $this->db->insert('social_profiles', $profiles);
                        $password = $radius->randomthing(20);
                        $firsname = $profiles['firstName'];
                        $lastname = $profiles['lastName'];
                        $email = $profiles['email'];
                        $user_insert2 = array(
                            'uname' => $username,
                            'clear_pword' => $password,
                            'fname' => $firsname,
                            'lname' => $lastname,
                            'email' => $email,
                            'durum' => '1',
                            'users_type' => '4',
                            'service_type' => $srvsocial,
                            'product_id' => $nasbilgi['service_id']
                        );
                        $this->db->insert('user_accounts', $user_insert2);
                        $mid = $this->db->insert_id();
                        $this->session->set_userdata('user_id', $mid);
                        $this->session->set_userdata('nas_shortname', $nasbilgi['shortname']);

                        
                        $rad_insert = array('username' => $username, 'attribute' => 'User-Password', 'op' => '==', '`value`' => $password, 'service_id' => $nasbilgi['service_id'], 'mid' => $mid, 'volume' => $plan_data['data_limit']);
                        $this->db->insert('radcheck', $rad_insert);
                        $rad_insert2 = array('username' => $username, 'attribute' => 'Max-Daily-Session', 'op' => ':=', '`value`' => $plan_data['time_limit']*60, 'service_id' => $nasbilgi['service_id']);
                        $this->db->insert('radcheck', $rad_insert2);
                        $radug_insert = array('username' => $username, 'groupname' => $plan_data['rgp_groupname'], 'priority' => '1');
                        $this->db->insert('radusergroup', $radug_insert);
                        //$radius->planupdate($username, $bwsocial, $srvsocial, $nasbilgi['service_id'], $mid);
                        $sociallogin['username'] = $username;
                        $sociallogin['password'] = $password;
                        $sociallogin['nas_ip'] = $nasbilgi['nas_ip'];
                    } else {
                        $this->session->set_userdata('user_id', $data->id);
                        $this->session->set_userdata('nas_shortname', $nasbilgi['shortname']);

                        $available_time = $this->get_user_available_time($data->uname);
                        
                        if($available_time <= 0) {
                            redirect('welcome/expired');
                            exit;
                        }
                    
                        
                        $this->db->update('radusergroup', array('groupname' => $plan_data['rgp_groupname']), array('username' => $data->uname));
                        $sociallogin['username'] = $data->uname;
                        $sociallogin['password'] = $data->clear_pword;
                        $sociallogin['nas_ip'] = $nasbilgi['nas_ip'];
                    }
                    
                    $wdb = $this->load->database('default', TRUE);

                    $wdb->where('service_id', $nasbilgi['service_id']);
                    $cihazdata = $wdb->get('nas')->row();

                    $sociallogin['cihaztipi'] = $cihazdata;
                    $sociallogin['network'] = $profiles['network'];
                    $sociallogin['displayName'] = $profiles['displayName'];
                    $sociallogin['shortname'] = $nasbilgi['shortname'];
                    $sociallogin['og_url'] = $nasbilgi['og_url'];
                    $sociallogin['twitter_follow_user'] = $nasbilgi['twitter_follow_user'];

                    $sociallogin['access_token'] = '';
                    $sociallogin['access_token_secret'] = '';
                    $sociallogin['consumerKey'] = '';
                    $sociallogin['consumerSecret'] = '';
                    
                    $sociallogin['action'] = $action;
                    if ($provider == 'Twitter') {
                        $sociallogin['access_token'] = $oAuth['access_token'];
                        $sociallogin['access_token_secret'] = $oAuth['access_token_secret'];

                        $sociallogin['consumerKey'] = $consumer["keys"]['key'];
                        $sociallogin['consumerSecret'] = $consumer["keys"]['secret'];
                        
                        
                    } elseif ($provider == 'Facebook') {
                        $sociallogin['consumerID'] = $consumer["keys"]['id'];
                        $sociallogin['consumerSecret'] = $consumer["keys"]['secret'];
                        $sociallogin['access_token'] = $oAuth['access_token'];
                        // $service->api()->api("/me/feed", "post", array(
                        // "message" => "test",
                        // "link"    => "http://hotspot.linefi.net/welcome/getlokasyon/".$sociallogin['shortname'],
                        // ));
                    }
                    
                    //if ($cihazdata->cihaztipi == "Mikrotik") {
                    //    $this->load->view('hauth/done', $sociallogin);
                    //}
                    //if ($cihazdata->cihaztipi == "Pfsense") {
                  //  echo $available_time;
                        $this->load->view('hauth/donepfsense', $sociallogin);
                    //}
                } else { // Cannot authenticate user
                    show_error('Cannot authenticate user');
                }
            } else { // This service is not enabled.
                echo 2;
                exit;
                log_message('error', 'controllers.HAuth.login: This provider is not enabled (' . $provider . ')');
                show_404($_SERVER['REQUEST_URI']);
            }
        } catch (Exception $e) {
            $error = 'Unexpected error';
            switch ($e->getCode()) {
                case 0 :
                    $error = 'Unspecified error.';
                    break;
                case 1 :
                    $error = 'Hybriauth configuration error.';
                    break;
                case 2 :
                    $error = 'Provider not properly configured.';
                    break;
                case 3 :
                    $error = 'Unknown or disabled provider.';
                    break;
                case 4 :
                    $error = 'Missing provider application credentials.';
                    break;
                case 5 :
                    log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
                    //redirect();
                    if (isset($service)) {
                        log_message('debug', 'controllers.HAuth.login: logging out from service.');
                        $service->logout();
                    }
                    show_error('User has cancelled the authentication or the provider refused the connection.');
                    break;
                case 6 :
                    $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
                    break;
                case 7 :
                    $error = 'User not connected to the provider.';
                    break;
            }

            if (isset($service)) {
                $service->logout();
            }

            log_message('error', 'controllers.HAuth.login: ' . $error);
            show_error('Error authenticating user.');
        }
    }
    
    public function payment() {
        require APPPATH . '/third_party/paypal/autoload.php';
        //var_dump($this->input->post());

        $apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                'AadXQBPLdFcvje0Zp44ixda0ctiagA1uKug3OX4KUmEQNE-wxWJvC3iw4Alu072EFvFXeyxcu_RNC5TE', // ClientID
                'ED2Ep5a8oIwVA7HMdNof-0Sb7xEHUZSK_vypLWLFOrCbsf-k85SSynJgIVN_GPn5u7KKlxgpkkxNcFRU'      // ClientSecret
                )
        );

        $card = new \PayPal\Api\CreditCard();
        $card->setType("visa")
                ->setNumber("4148529247832259")
                ->setExpireMonth("11")
                ->setExpireYear("2019")
                ->setCvv2("012")
                ->setFirstName("Joe")
                ->setLastName("Shopper");

        $fi = new \PayPal\Api\FundingInstrument();
        $fi->setCreditCard($card);

        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod("credit_card")
                ->setFundingInstruments(array($fi));

        $item = new \PayPal\Api\Item();
        $item->setName('wifi')
                ->setCurrency('EUR')
                ->setQuantity(1)
                ->setPrice(10);

        $itemList = new \PayPal\Api\ItemList();
        $itemList->setItems(array($item));

        $amount = new \PayPal\Api\Amount();
        $amount->setCurrency('EUR')
                ->setTotal(10);

        $id = $this->generateRandomString();

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription('Payment description')
                ->setInvoiceNumber($id);


        $payment = new \PayPal\Api\Payment();
        $payment->setIntent("sale")
                ->setPayer($payer)
                ->setTransactions(array($transaction));

        var_dump($payment->create($apiContext));
    }

    public function endpoint() {

        log_message('debug', 'controllers.HAuth.endpoint called.');
        log_message('info', 'controllers.HAuth.endpoint: $_REQUEST: ' . print_r($_REQUEST, TRUE));

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            log_message('debug', 'controllers.HAuth.endpoint: the request method is GET, copying REQUEST array into GET array.');
            $_GET = $_REQUEST;
        }

        log_message('debug', 'controllers.HAuth.endpoint: loading the original HybridAuth endpoint script.');
        require_once APPPATH . '/third_party/hybridauth/index.php';
    }

    public function reset() {
        $user_id = $this->session->userdata('user_id');

        if($user_id) {
            $this->db->where('id', $user_id);
            $user_data = $this->db->get('user_accounts')->row();
            
            if($user_data){
                $nasbilgi = $this->db
                    ->where('shortname', $this->session->nas_shortname)
                    ->get('nas')
                    ->row();

                // $radius = new Radius();
                // $nasbilgi = $radius->getnasinfo($nas_id);

                $wdb = $this->load->database('default', TRUE);
                $wdb->where('service_id', $nasbilgi->service_id);
                $cihazdata = $wdb->get('nas')->row();

                $data = array(
                    'auth_user' => $user_data->uname,
                    'auth_pass' => $user_data->clear_pword,
                    'nas_ip' => $nasbilgi->nas_ip,
                    'location_name' => $this->session->nas_shortname,
                    'device' => $cihazdata->cihaztipi
                );
                
                $this->db->delete('radacct', array('username' => $user_data->uname));
                $this->load->view('hauth/dosms', $data);                
            }
        }

        // redirect('welcome/getlokasyon/'.$this->session->nas_shortname, true);
    }
    
    protected function generateRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 20; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
        
        protected function get_user_available_time($username) {
        $query_str = "SELECT GREATEST(radcheck.value - SUM(radacct.acctsessiontime), 0) as total FROM radacct LEFT JOIN radcheck ON radacct.username = radcheck.username WHERE radacct.username = '{$username}' AND radcheck.attribute = 'Max-Daily-Session' GROUP BY radacct.username;";
        $resuslt = $this->db->query($query_str)->row_array();
        if($resuslt['total'] === NULL) {
            return 1;
        }
        return (int)$resuslt['total'];
    }
    
       /*
        protected function get_user_available_time($username) {
        $query_str = "SELECT * FROM radacct WHERE username='{$username}'";
        $resuslt = $this->db->query($query_str)->row_array();
        if(!isset($result)) {
            return 1;
        }
        date_default_timezone_set('UTC');
        $starttime = strtotime($resuslt['acctstarttime']);
        $query_str2 = "SELECT * FROM radcheck WHERE username='{$username}' AND attribute='Max-Daily-Session'";
        $resuslt2 = $this->db->query($query_str2)->row_array();
        $value_limit = $resuslt2['value'];
        $startPLUSvalue = $starttime + $value_limit;
        $currenttime = time();
        $currenttime = $currenttime + 10800; //added 10800 to add 3 hours coz timezone in our daabase is gmt+3 and we care comparing this time with that.
        $availble_time = $startPLUSvalue - $currenttime;
   //     return "Start time =".$starttime." And Userlimit =".$value_limit." Time Now =".$currenttime ." Available time = ".$availble_time;
        return $availble_time;

        
        $query_str = "SELECT GREATEST(radcheck.value - SUM(radacct.acctsessiontime), 0) as total FROM radacct LEFT JOIN radcheck ON radacct.username = radcheck.username WHERE radacct.username = '{$username}' AND radcheck.attribute = 'Max-Daily-Session' GROUP BY radacct.username;";
        $resuslt = $this->db->query($query_str)->row_array();
        if($resuslt['total'] === NULL) {
            return 1;
        }
        return (int)$resuslt['total'];
        
        }*/
    
public function ajaxvalidate() {
        $auth_user = trim($this->input->post('username', true));
        $auth_pass = trim($this->input->post('password', true));
        $nas_id = trim($this->input->post('nasid'));

        $this->load->library('Radius');
        $radius = new Radius();
        $nasbilgi = $radius->getnasinfo($nas_id);
        
        $this->db->where('uname', $auth_user);
        $this->db->where('clear_pword', $auth_pass);
        $this->db->where('product_id', $nasbilgi['service_id']);
        $user_data = $this->db->get('user_accounts')->row();
        if($user_data) {
        }
        else {
            echo "Fail";
        }     
    } 

    public function test() {
        $starttime = strtotime('2016-08-28 13:05:14');
echo "Its Converting this [2016-08-28 13:05:14] to unix:";
echo $starttime;
echo "</br>";
echo time();
echo "TIme Now";
echo date('h:i:s A', strtotime(time()));
echo "</br>";
echo "server time zone =";
echo date_default_timezone_get();

echo "</br>";
date_default_timezone_set('UTC');

$starttime = strtotime('2016-08-28 13:05:14');
echo "Its Converting this [2016-08-28 13:05:14] to unix:";
echo $starttime;
echo "</br>";
echo time();
echo "TIme Now";
echo date('h:i:s A', strtotime(time()));
echo "</br>";
echo "server time zone =";
echo date_default_timezone_get();
    }

}

/* End of file hauth.php */
/* Location: ./application/controllers/hauth.php */