<?php defined('BASEPATH') OR exit('No direct script access allowed');

// class Cron extends CI_Controller {

//     public function __construct() {
//         parent::__construct();
//         $this->load->database();
//     }

//     public function redirect_to_url() {
//         $sql_get_connect_users = "SELECT a.`username`, SUM(a.`acctinputoctets`) AS acctinputoctets, SUM(a.`acctoutputoctets`) AS acctoutputoctets, SUM(a.`acctsessiontime`) AS acctsessiontime, b.`groupname` FROM `user_accounts` AS c JOIN `radacct` AS a ON c.`uname` = a.`username` JOIN `radusergroup` AS b  ON a.`username` = b.`username` WHERE a.`acctstoptime` IS NULL GROUP BY a.`username`";
//         $connect_users = $this->db->query($sql_get_connect_users)->result_array();
//         $user_limits = array();
//         foreach ($connect_users as $k => $connect_user) {
//             $sql_get_user_plan = "SELECT * FROM `radgroupreply` WHERE `groupname` = '".$connect_user['groupname']."'";
//             $user_plan = $this->db->query($sql_get_user_plan)->result_array();
//             foreach ($user_plan as $key => $value) {
//                 $user_limits[$value['attribute']] = $value['value'];
//             }
//             $connect_users[$k] += $user_limits;
//         }

//         foreach ($connect_users as $key => $value) {
//             $downloads = $value['acctinputoctets'] >= $value['WISPr-Bandwidth-Max-Down'];
//             $uploads = $value['acctoutputoctets'] >= $value['WISPr-Bandwidth-Max-Up'];
//             $times = $value['acctsessiontime'] >= $value['Session-Timeout'];
//             if($downloads || $uploads || $times) {
//                 $sql_disabled_user = "UPDATE `user_accounts` SET `disabled` = 1 WHERE `uname` = '".$value['username']."'";
//                 $sql_disabled_user_radcheck = "UPDATE `radcheck` SET `username` = '".$value['username']."', `attribute` = 'WISPr-Redirection-URL', `op` = ':=', `value` = '".$_SERVER['SERVER_ADDR'].":".$_SERVER['SERVER_PORT']."/welcome/expired', `service_id` = 73, `mid` = 0, `volume` = 0 WHERE `username` = '".$value['username']."'";
//                 $this->db->query($sql_disabled_user);
//                 $this->db->query($sql_disabled_user_radcheck);
//             }
//         }
//     }
// }

class Cron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function redirect_to_url() {
        echo "<pre>";
        // $sql_get_connect_users = "SELECT a.`username`, SUM(a.`acctinputoctets`) AS acctinputoctets, SUM(a.`acctoutputoctets`) AS acctoutputoctets, SUM(a.`acctsessiontime`) AS acctsessiontime, b.`groupname` FROM `user_accounts` AS c JOIN `radacct` AS a ON c.`uname` = a.`username` JOIN `radusergroup` AS b  ON a.`username` = b.`username` WHERE a.`acctstoptime` IS NULL GROUP BY a.`username`";
        $sql_get_connect_users = "SELECT `username` FROM `radacct` WHERE `acctstoptime` IS NULL";
        $connect_users = $this->db->query($sql_get_connect_users)->result_array();
        // var_dump($connect_users);
        $user_limits = array();
        $limits = array();
        foreach ($connect_users as $key => $connect_user) {
            $sql_get_user_values = "SELECT a.`username`, SUM(a.`acctinputoctets`) AS acctinputoctets, SUM(a.`acctoutputoctets`) AS acctoutputoctets, SUM(a.`acctsessiontime`) AS acctsessiontime, b.`groupname` FROM `user_accounts` AS c JOIN `radacct` AS a ON c.`uname` = a.`username` JOIN `radusergroup` AS b  ON a.`username` = b.`username` WHERE c.`uname` = '".$connect_user['username']."' GROUP BY a.`username`";
            $user_limits = $this->db->query($sql_get_user_values)->result_array();
            foreach ($user_limits as $k => $v) {
                $limits[$key] = [
                    'username' => $v['username'], 
                    'acctinputoctets' => $v['acctinputoctets'], 
                    'acctoutputoctets' => $v['acctoutputoctets'],
                    'acctsessiontime' => $v['acctsessiontime'],
                    'groupname' => $v['groupname']
                ];
            }
            
        }
        var_dump($limits);
        // $arr = array();
        // foreach ($user_limits as $k => $value) {
        //     var_dump($value);
        //     // $sql_get_user_plan = "SELECT * FROM `radgroupreply` WHERE `groupname` = '".$value['groupname']."'";
        //     // $user_plan = $this->db->query($sql_get_user_plan)->result_array();
        //     // foreach ($user_plan as $key => $plan) {
        //     //     $arr[$plan['attribute']] = $plan['value'];
        //     // }
        //     // $user_limits[$k] += $arr;
        // }
        // var_dump($user_limits);
        echo "</pre>";
        // $user_limits = array();
        // foreach ($connect_users as $k => $connect_user) {
        //     $sql_get_user_plan = "SELECT * FROM `radgroupreply` WHERE `groupname` = '".$connect_user['groupname']."'";
        //     $user_plan = $this->db->query($sql_get_user_plan)->result_array();
        //     foreach ($user_plan as $key => $value) {
        //         $user_limits[$value['attribute']] = $value['value'];
        //     }
        //     $connect_users[$k] += $user_limits;
        // }

        // foreach ($connect_users as $key => $value) {
        //     $downloads = $value['acctinputoctets'] >= $value['WISPr-Bandwidth-Max-Down'];
        //     $uploads = $value['acctoutputoctets'] >= $value['WISPr-Bandwidth-Max-Up'];
        //     $times = $value['acctsessiontime'] >= $value['Session-Timeout'];
        //     if($downloads || $uploads || $times) {
        //         $sql_disabled_user = "UPDATE `user_accounts` SET `disabled` = 1 WHERE `uname` = '".$value['username']."'";
        //         $sql_disabled_user_radcheck = "UPDATE `radcheck` SET `username` = '".$value['username']."', `attribute` = 'WISPr-Redirection-URL', `op` = ':=', `value` = '".$_SERVER['SERVER_ADDR'].":".$_SERVER['SERVER_PORT']."/welcome/expired', `service_id` = 73, `mid` = 0, `volume` = 0 WHERE `username` = '".$value['username']."'";
        //         $this->db->query($sql_disabled_user);
        //         $this->db->query($sql_disabled_user_radcheck);
        //     }
        // }
    }
}