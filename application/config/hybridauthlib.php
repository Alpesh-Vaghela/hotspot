<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

$config =
    array(
        // set on "base_url" the relative url that point to HybridAuth Endpoint
        'base_url' => '/hauth/endpoint',

        "providers" => array(
            // openid providers
            "OpenID" => array(
                "enabled" => false
            ),

            "Yahoo" => array(
                "enabled" => false,
                "keys" => array("id" => "", "secret" => ""),
            ),

            "AOL" => array(
                "enabled" => false
            ),

            "Google" => array(
                "enabled" => false,
                "keys" => array("id" => "", "secret" => ""),
            ),

            "Facebook" => array(
                "enabled" => true,
                "keys" => array("id" => "1827944970769899", "secret" => "af5bb01cde79cf92f15a8b1fa407683d"),
				"scope"   => "email, user_about_me"
            ),

            "Twitter" => array(
                "enabled" => true,
                "keys" => array("key" => "3Pkej7TkaOP7EOGc1goXnilY3", "secret" => "e3X0RdRaNEdtF4tDiPQctVs4NCUQEymz3g1POGbanU2r4wHPKF")
            ),
            "Instagram" => array(
                "enabled" => true,
                'keys' =>
                    array(
                        'id' => 'c7691b67d4e843c88101ef72c80ba29d',
                        'secret' => '4ffe4dcf22e743bea564ae8974e1a632',
                    )
            ),

            // windows live
            "Live" => array(
                "enabled" => false,
                "keys" => array("id" => "", "secret" => "")
            ),

            "MySpace" => array(
                "enabled" => false,
                "keys" => array("key" => "", "secret" => "")
            ),

            "LinkedIn" => array(
                "enabled" => false,
                "keys" => array("key" => "", "secret" => "")
            ),

            "Foursquare" => array(
                "enabled" => false,
                "keys" => array("id" => "", "secret" => "")
            ),
        ),

        // if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
        "debug_mode" => (ENVIRONMENT == 'development'),

        "debug_file" => APPPATH . '/logs/hybridlogs.log',
    );


/* End of file hybridauthlib.php */
/* Location: ./application/config/hybridauthlib.php */