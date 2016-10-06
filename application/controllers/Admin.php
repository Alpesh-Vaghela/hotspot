<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth'));
        
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

		$this->user_id = $this->ion_auth->get_user_id();
		$this->is_admin = $this->ion_auth->is_admin();
		$this->user_group = $this->ion_auth->get_users_groups($this->user_id)->result();

        // if($this->user_group[0]->name == 'members') {
        //     redirect('admin/hotspot_users')
        // }


		if($this->user_group[0]->name == 'administrator' || $this->user_group[0]->name == 'members') {
			$this->nas = $this->db
								->from('nas a')
								->join('genelayarlar b', 'b.nas_id = a.id')
								->where('b.user_id', $this->user_id)
								->get()
								->row();
		}
	}

	public function index() {
		$this->template->content->view('admin/index', array());
		$this->template->publish();
	}
	
	public function plans() {
		$this->db
					->select('p.*, u.last_name, u.first_name')
					->from('plan_limits as p')
					->join('users as u', "u.id = p.user_id", 'left', true);
		
		if(!$this->is_admin)
			$this->db
				 ->where('u.id = '.$this->user_id);
				 
		$data = $this->db->get()
				    ->result_array();
		
		$users = $this->db
			->select()
			->from('users')
			->get()
			->result_array();
			
		$this->template->content->view('admin/plans', array('plans' => $data, 'form_data' => array(), 'users' => $users, 'is_admin' => $this->is_admin));
		$this->template->publish();
    }
	
	public function get_plan_by_id() {
		exit(json_encode($data = $this->db
					->select()
					->from('plan_limits')
					->where('id = '.intval($_POST["id"]))
					->get()
				    ->row_array()));
    }
	
	public function get_commerical_by_id() {			
		$form_data = $this->db
					->select()
					->from('nas_commerical')
					->where('id = '.intval($_POST["id"]))
					->get()
					->row_array();
		$data = json_decode($form_data['data']);
		
		$form_data['data'] = ($form_data['type'] == 0 ? '<img width="400" src="/'.$data->path.'">' : '<video width="320" height="240" controls>
								<source src="/'.$data->path.'" type="'.$data->file_type.'">
							</video>');
							
		exit(json_encode($form_data));
    }
	
	public function nas() {
		$this->db
			->select('nas.id as id2,nas.*,limit.*')
			->from('nas as nas')
			->join('genelayarlar as limit', "nas.id = limit.nas_id", 'left', true);
		
		if(!$this->is_admin)
			$this->db
				 ->where('limit.user_id = '.$this->user_id);
		
		$data = $this->db
					 ->get()
					 ->result_array();
					
		$nas_ids = array();
		$new_nas = array();
		
		foreach($data as $nas){
			$nas_ids[] = $nas['id'] = $nas['id2'];
			$new_nas[$nas['id']] = $nas;
			$new_nas[$nas['id']]['limits'] = array();
		}
				
		$limits = $this->db
			->select()
			->from('plan_limits')
			->get()
			->result_array();
			
		$users = $this->db
			->select()
			->from('users')
			->get()
			->result_array();

		$this->template->content->view('admin/nas', array('nas' => $new_nas,'limits'=>$limits, 'users' => $users, 'is_admin' => $this->is_admin));
		$this->template->publish();
    }
	
	public function nas_commerical() {
		$this->db
			->select('nas_commerical.*, nas.nasname')
			->from('nas_commerical')
			->join('nas', "nas.id = nas_commerical.nas_id", 'left', true)
			->join('genelayarlar as limit', "nas.id = limit.nas_id", 'left', true);
		
		if(!$this->is_admin)
			$this->db
				 ->where('limit.user_id = '.$this->user_id);
				 
		$data = $this->db->get()
			    ->result_array();
					
		$nas_ids = array();
		$new_nas = array();
		foreach($data as $nas){
			$new_nas[$nas['id']] = $nas;
		}
		
		$this->db
				->select('nas.id, nas.nasname')
				->from('nas')
				->join('genelayarlar as limit', "nas.id = limit.nas_id", 'left', true);
		
		if(!$this->is_admin)
			$this->db
				 ->where('limit.user_id = '.$this->user_id);
				 
		$nas = $this->db->get()
				->result_array();

		$this->template->content->view('admin/nas_commerical', array('nas_commerical' => $new_nas, 'nas' => $nas, 'form_data' => array(), 'is_admin' => $this->is_admin));
		$this->template->publish();
    }
	
	public function nasAjaxChange(){
		header('Content-Type: application/json');

		if($this->is_admin)
			$columns = array('user_id', 'free', 'sms', 'social', 'paid');
		else
			$columns = array('free', 'sms', 'social', 'paid');

		if(!preg_match_all('/[0-9]+$/', $_POST['id']))
			$this->ajaxHalt();
		
		if(!preg_match_all('/[0-9]+$/', $_POST['value']))
			$this->ajaxHalt();
		
		if(!in_array($_POST['name'], $columns))
			$this->ajaxHalt();

		$response = array_merge(array('status'=>true),$_POST);

		$data = $this->db->select()
			->from('genelayarlar')
			->where('nas_id = '.$response['id'])
			->get()
			->result_array();

		$db_node = array('nas_id'=>$response['id'],$response['name']=>$response['value']);

		if(!$data){
			$this->db->insert('genelayarlar', $db_node);
		}else{
			$this->db->update('genelayarlar', $db_node , array('id' => $data[0]['id']));
		}

		$response = array_merge(array('status'=>true),$data);
		$this->ajaxResponse($response);
	}
	
	function ajaxResponse($array){
		header('Content-Type: application/json');
		exit(json_encode($array));
	}
	
	function ajaxHalt(){
		header('Content-Type: application/json');
		exit(json_encode(array('status'=>false)));
	}
	
	public function addplan(){
		$id = intval($_POST["id"]);

		$this->load->library('form_validation');

		if(!$this->is_admin)
			$_POST['user_id'] = $this->user_id;
		
		$input_data = array(
			'user_id' => $this->input->post('user_id', true), 
			'plan_adi' => $this->input->post('plan_adi', true), 
			'limit_type' => $this->input->post('limit_type', true), 
			'time_limit' => $this->input->post('time_limit', true), 
			'time_unit' => $this->input->post('time_unit', true), 
			'data_limit' => $this->input->post('data_limit', true), 
			'max_up' => $this->input->post('max_up', true), 
			'max_down' => $this->input->post('max_down', true), 
			'data_unit' => $this->input->post('data_unit', true), 
		);

		$this->form_validation->set_data($input_data);
		$this->form_validation->set_rules('user_id', 'Admin name', 'trim|required|integer|greater_than[0]');
		$this->form_validation->set_rules('plan_adi', 'Plan adi', 'trim|required');
		$this->form_validation->set_rules('limit_type', 'Limit type', 'trim|required|integer|less_than[2]');
		$this->form_validation->set_rules('time_limit', 'Time limit', 'trim|required|integer|greater_than[0]');
		$this->form_validation->set_rules('time_unit', 'Time unit', 'trim|required');
		$this->form_validation->set_rules('data_limit', 'Data limit', 'trim|required|integer|greater_than[0]');
		$this->form_validation->set_rules('max_up', 'Max up', 'trim|required|integer|greater_than[0]');
		$this->form_validation->set_rules('max_down', '	Max down', 'trim|required|integer|greater_than[0]');
		$this->form_validation->set_rules('data_unit', 'Data unit', 'trim|required');

		if ($this->form_validation->run() == FALSE)
			exit(json_encode(array(0, validation_errors())));
		else
		{
			if($id){
				$result = $this->db->update('plan_limits', $input_data , array('id' => $id));
				$plan = $this->db
					->where('id', $id)
					->get('plan_limits')
					->row_array();
				$groupname_values = $this->db
					->where('groupname', $plan['rgp_groupname'])
					->get('radgroupreply')
					->result_array();
				foreach ($groupname_values as $key => $value) {
					$id = array('id' => $value['id']);
					switch ($value['attribute']) {
						case 'WISPr-Bandwidth-Max-Down':
							$this->db->update('radgroupreply', array('value' => $input_data['max_down']), $id);
							break;
						case 'WISPr-Bandwidth-Max-Up':
							$this->db->update('radgroupreply', array('value' => $input_data['max_up']), $id);
							break;
						case 'Session-Timeout':
							$session_timeout = $this->time_to_sec($input_data['time_limit'], $input_data['time_unit']);
							$this->db->update('radgroupreply', array('value' => $session_timeout), $id);
							break;
						default:
							break;
					}
				}
			} else {
				$input_data['rgp_groupname'] = $this->generate_string();
				$result = $this->db->insert('plan_limits', $input_data);
				
				$group_data = array(
					array(
						'groupname' => $input_data['rgp_groupname'],
						'attribute' => 'WISPr-Bandwidth-Max-Down',
						'op' => ':=',
						'value' => $input_data['max_up']
					),
					array(
						'groupname' => $input_data['rgp_groupname'],
						'attribute' => 'WISPr-Bandwidth-Max-Up',
						'op' => ':=',
						'value' => $input_data['max_down']
					),
					array(
						'groupname' => $input_data['rgp_groupname'],
						'attribute' => 'Session-Timeout',
						'op' => ':=',
						'value' => $this->time_to_sec($input_data['time_limit'], $input_data['time_unit'])
					),
				);
				$this->db->insert_batch('radgroupreply', $group_data);
			}
			exit(json_encode(array(1)));
		}
    }
	
	public function addcommerical() {
		$id = intval($_POST["id"]);
		
		$this->load->library('form_validation');
		
		$nas = $this->db
				->select('id, nasname')
				->from('nas')
				->get()
				->result_array();

		$input_data = array(
			'nas_id' => $this->input->post('nas_id', true), 
			'type_page' => $this->input->post('type_page', true), 
			'type' => $this->input->post('type', true), 
			'title' => $this->input->post('title', true), 
			'description' => $this->input->post('description', true), 
		);
		
		$this->form_validation->set_data($input_data);
		$this->form_validation->set_rules('nas_id', 'Choose Location', 'trim|required|integer');
		$this->form_validation->set_rules('type_page', 'Ads Placement', 'trim|required|integer');
		$this->form_validation->set_rules('type', 'Type', 'trim|required|integer');
		$this->form_validation->set_rules('title', 'Campaign Name', 'trim|required');
		$this->form_validation->set_rules('description', 'Campaign Desctiption', 'trim|required');

		if ($this->form_validation->run() == FALSE)
			exit(json_encode(array(0, validation_errors())));
		else
		{
			if($id !== null){
				$select_nas = $this->db
						->select()
						->from('nas_commerical')
						->where(array('id' => $id))
						->get()
						->row_array();

				if(($select_nas["type"] != $input_data["type"]) || $_FILES)
					$this->uploadFiles($input_data, $nas, $id);
				else{
					$this->db->update('nas_commerical', array('nas_id' => $input_data["nas_id"], 'type_page' => $input_data["type_page"], 'type' => $input_data["type"], 'title' => $input_data["title"], 'description' => $input_data["description"]), array('id' => $id));
				}
			} else
				$this->uploadFiles($input_data, $nas);
		}

		exit(json_encode(array(1)));
    }
	
	public function deleteplan($id = null) {
		$result = $this->db->delete('plan_limits', array('id' => $id));
		
		redirect('admin/plans', 'refresh');
	}

	public function deletecommerical($id = null) {
		$result = $this->db->delete('nas_commerical', array('id' => $id));
		
		redirect('admin/nas_commerical', 'refresh');
	}

	protected function generate_string($length = 8)
	{
		$chars = '0123456789abcdefghijklmnopqrstuvwxyz';
		$numChars = strlen($chars);
		$string = '';
		
		for ($i = 0; $i < $length; $i++) 
			$string .= substr($chars, rand(1, $numChars) - 1, 1);

		return $string;
	}
	
	protected function time_to_sec($time = 0, $unit = 'Mins') {
		switch ($unit){
			case 'Mins':
				$time *= 60;
			break;
			case 'Hrs':
				$time *= 60 * 60;
			break;
		}
		
		return $time;
	}
	
	protected function uploadFiles($input_data, $nas, $id = 0) {
		$config['max_size'] = '10240';
		$config['encrypt_name'] = TRUE;
		$config['upload_path']   = APPPATH.'../assets/fileuploads'; 
		
		switch($input_data['type']){
			case 0:
				$config['allowed_types'] = 'gif|jpg|jpeg|png'; 
			break;
			case 1:
				$config['allowed_types'] = 'mp4|mpeg|mpe|mpg|avi';
			break;
		}

		$this->load->library('upload', $config);
		
		if(!$this->upload->do_upload('file'))
			exit(json_encode(array(0, $this->upload->display_errors())));
		else {
			$file_info = $this->upload->data();

			$length = 0; 
			
			if($input_data['type'] == 1){
				require_once(APPPATH."libraries/getid3/getid3.php");
				$getID3 = new getID3;
				$file = $getID3->analyze("assets/fileuploads/".$file_info["file_name"]);
				$length = $file['playtime_string'];
			}
			
			if($id)
				$this->db->update('nas_commerical', array('nas_id' => $input_data["nas_id"], 'type_page' => $input_data["type_page"], 'title' => $input_data["title"], 'description' => $input_data["description"], 'data' => json_encode(array("path" => "assets/fileuploads/".$file_info["file_name"], "size" => $file_info["file_size"], "file_type" => $file_info["file_type"], "length" => $length)), 'type' => $input_data["type"]), array('id' => $id));
			else
				$this->db->insert('nas_commerical', array('nas_id' => $input_data["nas_id"], 'type_page' => $input_data["type_page"], 'title' => $input_data["title"], 'description' => $input_data["description"], 'data' => json_encode(array("path" => "assets/fileuploads/".$file_info["file_name"], "size" => $file_info["file_size"], "file_type" => $file_info["file_type"], "length" => $length)), 'type' => $input_data["type"]));
		}
		
		return true;
	}

	function hotspot_users() {
		$this->load->model('default_model', 'users');
		$this->load->model('default_model', 'plan_limits');
		$this->plan_limits->table 	= 'plan_limits';
		$this->users->table 		= 'user_accounts';
		$data = [];

		if($this->is_admin) {
			$data['users'] = $this->users->query('SELECT a.*, b.groupname FROM user_accounts a JOIN radusergroup b ON a.uname = b.username WHERE a.admin_created = 1 GROUP BY a.id ORDER BY a.id DESC');
			$data['plans'] = $this->plan_limits->getAll();
		}
		elseif(!empty($this->nas)) {
			$data['plans'] = $this->plan_limits->get(['user_id' => $this->user_id]);
			// $data['users'] = $this->users->get(['product_id' => $this->nas->service_id]);

			$data['users'] = $this->users->query('SELECT a.*, b.groupname FROM user_accounts a JOIN radusergroup b ON a.uname = b.username WHERE a.product_id = '.$this->nas->service_id.' && a.admin_created = 1 GROUP BY a.id ORDER BY a.id DESC');
 			// $data['users'] = $this->users->get();
		}
        $this->template->content->view('users/index', $data);
		$this->template->publish();
	}

	function hotspot_users_delete($id) {
		if(!$this->is_admin && empty($this->nas))
			redirect('admin/hotspot_users');
		$this->load->model('default_model', 'users');
		$this->load->model('default_model', 'radcheck');
		$this->load->model('default_model', 'radusergroup');
		$this->users->table = 'user_accounts';
		$this->radcheck->table = 'radcheck';
		$this->radusergroup->table = 'radusergroup';
		$user = $this->users->get(['id' => $id])[0];
		if($this->is_admin) {
			$this->users->delete(['id' => $id]);
			$this->radcheck->delete(['username' => $user['uname']]);
			$this->radusergroup->delete(['username' => $user['uname']]);
		}
		elseif(!empty($this->nas)) {
			$this->users->delete(['id' => $id, 'product_id' => $this->nas->service_id]);
			$this->radcheck->delete(['username' => $user['uname']]);
			$this->radusergroup->delete(['username' => $user['uname']]);
		}
		redirect('admin/hotspot_users');
	}

	function hotspot_users_set() {
		if(!$this->is_admin && empty($this->nas))
			redirect('admin/hotspot_users');

		$data 			= $this->input->post();
		$plan_id 		= $data['plan_id'];

		unset($data['plan_id']);

		$this->load->model('default_model', 'users');
		$this->load->model('default_model', 'radcheck');
		$this->load->model('default_model', 'plan_limits');
		$this->users->table = 'user_accounts';
		$this->radcheck->table = 'radcheck';
		$this->plan_limits->table = 'plan_limits';
		$plan_limits = $this->plan_limits->get(['id' => $plan_id])[0];
		if(isset($data['id']) && !empty($data)) {
			
			$data['uname'] 	= (int)$data['gsmno'];
			$id 			= ['id' => $data['id']];
	
			unset($data['id']);
			$user = $this->users->get($id)[0];
			$this->users->set($data, $id);

			$red_check_pass = $this->radcheck->get(['username' => $user['uname'], 'attribute' => 'User-Password'])[0];
			$red_check_daily = $this->radcheck->get(['username' => $user['uname'], 'attribute' => 'Max-Daily-Session'])[0];
			

			$rad_data[0] = [
				'username' 	=> $data['uname'],
				'attribute' => 'User-Password',
				'op'		=> '==',
				'service_id'=> $this->is_admin?73:$this->nas->service_id,
			];

			if($data['clear_pword'] !== '')
				$rad_data[0]['value'] = $data['clear_pword'];

			$rad_data[1] = [
				'username' 	=> $data['uname'],
				'attribute' => 'Max-Daily-Session',
				'op'		=> ':=',
				'value'		=> $plan_limits['time_unit'] == 'Mins'?$plan_limits['time_limit']*60:$plan_limits['time_limit']*3600,
				'service_id'=> $this->is_admin?73:$this->nas->service_id,
			];

			$this->radcheck->set($rad_data[0], $red_check_pass?['id' => $red_check_pass['id']]:[]);
			$this->radcheck->set($rad_data[1], $red_check_daily?['id' => $red_check_daily['id']]:[]);

			$this->radcheck->table = 'plan_limits';
			$plan = $this->radcheck->get(['id' => $plan_id])[0];
			$this->radcheck->table = 'radusergroup';
			$radusergroup = $this->radcheck->get(['username' => $data['uname']])[0];
			$this->radcheck->set(['groupname' => $plan['rgp_groupname'], 'username' => $data['uname']], ['username' => $user['uname']]);
		}
		else {

			$data['durum'] 			= 1;
			$data['users_type'] 	= 4;
			$data['created_at'] 	= date('Y-m-d H:i:s', time());
			$data['product_id'] 	= $this->is_admin?73:$this->nas->service_id;
			$data['uname'] 			= $data['gsmno'];
			$data['service_type'] 	= 0;
			$data['tckimlik']		= '';
			$data['tweetok'] 		= '';
			$data['facebook_liked'] = '';

			$id = $this->users->set($data);

			$rad_data = [
				'username' 	=> $data['gsmno'],
				'attribute' => 'User-Password',
				'op'		=> '==',
				'value'		=> $data['clear_pword'],
				'service_id'=> $this->is_admin?73:$this->nas->service_id,
			];

			$this->radcheck->set($rad_data);

			$rad_data = [
				'username' 	=> $data['gsmno'],
				'attribute' => 'Max-Daily-Session',
				'op'		=> ':=',
				'value'		=> $plan_limits['time_unit'] == 'Mins'?$plan_limits['time_limit']*60:$plan_limits['time_limit']*3600,
				'service_id'=> $this->is_admin?73:$this->nas->service_id,
			];

			$this->radcheck->set($rad_data);

			$this->radcheck->table = 'plan_limits';
			$plan = $this->radcheck->get(['id' => $plan_id])[0];
			$this->radcheck->table = 'radusergroup';
			$radusergroup = $this->radcheck->get(['username' => $data['uname']])[0];
			$this->radcheck->set(['groupname' => $plan['rgp_groupname'], 'username' => $data['uname']]);
		}
		redirect('admin/hotspot_users');
	}

}