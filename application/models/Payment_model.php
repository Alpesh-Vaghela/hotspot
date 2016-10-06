<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {

    public function get_plans_for_location($locationId = null) {

        $result = $this->db->select('plan.id, plan.title, plan.price')
                ->from('nas_plans as plan')
                ->join('nas', "nas.shortname = '{$locationId}'", 'left', true)
                ->where('nas.id = plan.nas_id')
                ->get()
                ->result();

        return $result;
    }

    public function get_plan_by_id($plan_id) {

        $result = $this->db->select('plan.id, plan.title, plan.price, limit.max_down, limit.max_down_unit, limit.max_up, limit.max_up_unit')
                ->from('nas_plans as plan')
                ->join('bw_policies as limit', "plan.bw = limit.id", 'left', true)
                ->where(array('plan.id' => $plan_id))
                ->get()
                ->row();

        return $result;
    }

    public function test() {
        return 'test';
    }

}
