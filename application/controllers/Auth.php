<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	protected $field = [];
    
    function __construct(){
        parent::__construct();
		$this->load->model('Login_Model');		
        header("X-XSS-Protection: 1; mode=block");	
		$this->load->library('user_agent');
    }	

	public function index()
	{
        $this->Global_model->not_logged_in();
		return view('users.front.login');
	}

	public function verify(){                
		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[55]', [
			'required' => '%s tidak boleh kosong'
		]);	
		$this->form_validation->set_rules('email', 'Email address', 'trim|required|valid_email|valid_emails|max_length[55]', [
			'required' => '%s tidak boleh kosong'
		]);					
		
		if($this->form_validation->run() === TRUE){
            $redirect_url                   = $this->input->get('redirect_url', true);
			$this->field['email_address'] 	= trim(htmlspecialchars($this->input->post('email', true), ENT_QUOTES));
			$this->field['password']		= trim(htmlspecialchars($this->input->post('password', true), ENT_QUOTES));
			
			$user = $this->Login_Model->cek_login($this->field['email_address'], sha1(md5($this->field['password'])));		
            if ($this->agent->is_browser()) {
				$agent = $this->agent->browser().' '.$this->agent->version();
			} elseif ($this->agent->is_robot()) {
				$agent = $this->agent->robot();
			} elseif ($this->agent->is_mobile()) {
				$agent = $this->agent->mobile();
			} else {
				$agent = 'Unidentified User Agent';
			}

			if($user){
				
				$stored_session = [
					'nik' 			=> encrypt($user->nik),
					'nama_lengkap' 	=> $user->nama_lengkap,
					'email' 		=> $user->email,	
					'foto'			=> $user->foto,
					'kode_jabatan'	=> $user->kode_tingkatan,
					'kode_unit'		=> $user->kode_unit,
					'nama_unit'		=> $user->nama_unit,
					'jabatan'		=> $user->keterangan_tingkatan,
					'singkatan_unit'=> $user->singkatan_unit,
					'is_login'		=> true,
					'server'		=> [
						'ip_address' 	=> $_SERVER['REMOTE_ADDR'],
						'user_agent'	=> $this->input->user_agent()
					],
					'last_access'	=> time()
				];

				/*$this->db->insert('logs_login', [
					'ip_address' 	=> get_client_ip(),
					'platform'		=> $this->agent->platform(),
					'browser'		=> $agent,
					'year'			=> date('Y'),
					'user_id'		=> $user->nik,
					'status'		=> 'success'
				]);*/

				$this->session->set_userdata('user_sessions', $stored_session);				
				$this->session->set_flashdata('alert', [
					'message' => 'Selamat datang, ' . $user->nama_lengkap . '!',
					'type'    => 'info',	
					'title'   => 'Login Sukses'
				]);
                
                $ex_redirect_url = explode('/', $redirect_url);
                array_splice($ex_redirect_url, 0, 2);
                $f_redirect_url = implode('/', $ex_redirect_url);
                
                if(empty($redirect_url)){
                    return redirect(base_url('app/menu'));
                } else {
                    return redirect(base_url($f_redirect_url));
                }

			} else {

                /*$this->db->insert('logs_login', [
					'ip_address' 	=> get_client_ip(),
					'platform'		=> $this->agent->platform(),
					'browser'		=> $agent,
					'user_id'		=> empty($user->nik) ? $this->input->post('email', true) : $user->nik,
					'year'			=> date('Y'),
					'status'		=> 'failed'
				]);*/

				$this->session->set_flashdata('alert', [
					'message' => 'Email atau password salah',
					'type'    => 'error',	
					'title'   => ''
				]);
				return redirect(base_url());

			}

		} else {			

			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect(base_url());

		}		
	}
}
