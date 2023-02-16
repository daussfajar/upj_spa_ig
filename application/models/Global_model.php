<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_Model extends CI_Model {

    function __construct(){
        parent::__construct();
		$this->load->library('pagination');
        if(isset($_SESSION['user_sessions']) && !empty($_SESSION['user_sessions'])){
            if ($_SERVER['REMOTE_ADDR'] != $_SESSION['user_sessions']['server']['ip_address']){
                session_unset();
                session_destroy();
            }

            if ($_SERVER['HTTP_USER_AGENT'] != $_SESSION['user_sessions']['server']['user_agent']){
                session_unset();
                session_destroy();
            }
        }
        
    }

    public function is_logged_in(){        
        $session_exists = $this->session->userdata('user_sessions');
        if (!isset($session_exists) || $session_exists == "") {			            
			redirect(base_url() . '?redirect_url=' . $_SERVER['HTTP_HOST'] . $_SERVER['REDIRECT_URL']);
		}
    }

    public function get_all_kegiatan(){
        
    }

    public function is_admin(){
        $session = $this->session->userdata('user_sessions');
        if (!empty($session) && $session['kode_jabatan'] != 0) {
			show_404();
		}
    }

    public function not_logged_in(){        
        $session_exists = $this->session->userdata('user_sessions');
        if (!empty($session_exists)) {			
			redirect(base_url('app/sim-ig/dashboard'));			
		}
    }

    public function get_data_with_pagination($field, $table, $where, $base_url, $uri_segment, $per_page, $num_links)
	{
		$session_where = $this->session->userdata('session_where');
		$query = sprintf("SELECT %s FROM %s WHERE %s %s", $field, $table, $where, (isset($session_where['value']) ? $session_where['value'] : ''));
		$config['base_url'] = $base_url;
		$config['total_rows'] = $this->db->query($query)->num_rows();
		$config['per_page'] = $per_page;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = $num_links;
		$config['full_tag_open']   = '<ul class="pagination" style="justify-content:center;">';
		$config['full_tag_close']  = '</ul>';

		$config['first_link']      = '<span class="mdi mdi-page-first"></span>';
		$config['first_tag_open']  = '<li class="page-item page-link">';
		$config['first_tag_close'] = '</li>';

		$config['last_link']       = '<span class="mdi mdi-page-last"></span>';
		$config['last_tag_open']   = '<li class="page-item page-link">';
		$config['last_tag_close']  = '</li>';

		$config['next_link']       = '<span class="mdi mdi-chevron-right"></span> ';
		$config['next_tag_open']   = '<li class="page-item page-link">';
		$config['next_tag_close']  = '</li>';

		$config['prev_link']       = '<span class="mdi mdi-chevron-left"></span>';
		$config['prev_tag_open']   = '<li class="page-item page-link">';
		$config['prev_tag_close']  = '</li>';

		$config['cur_tag_open']    = '<li class="page-item active"><a href="javascript:void(0)" class="page-link">';
		$config['cur_tag_close']   = '</a></li>';

		$config['num_tag_open']    = '<li class="page-item page-link">';
		$config['num_tag_close']   = '</li>';
		// End style pagination
		$this->pagination->initialize($config);

		$page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
		$query .= " LIMIT " . $page . ", " . $config['per_page'];

		$data['limit'] = $config['per_page'];
		$data['total_rows'] = $config['total_rows'];
		$data['pagination'] = $this->pagination->create_links();
		$data['data'] = $this->db->query($query)->result_array();

		return $data;
	}

	// function hanya keuangan dan admin dan warek yang bisa akses
	public function is_finance(){
		$access = false;
		$session = $this->session->userdata('user_sessions');			
        if(($session['kode_unit'] == 002 && $session['kode_jabatan'] == 22) || $session['kode_jabatan'] == 0 || $session['kode_jabatan'] == 22 || $session['kode_jabatan'] == 3 || $session['kode_jabatan'] == 4 || $session['kode_jabatan'] == 6){
			$access = true;
		} else {
			$access = false;
		}
			
		if($access == false){
			$this->session->set_flashdata('alert', [
				'message' => 'Maaf anda tidak diperbolehkan mengakses modul tersebut.',
				'type'    => 'error',	
				'title'   => ''
			]);
			return redirect(base_url('app/sim-ig/dashboard'));
		}
	}

	public function upload_excel($filename)
	{
		$this->load->library('upload');

		$config['upload_path'] = './app-data/temp/';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']    = '5048';
		$config['overwrite'] = true;
		$config['file_name'] = 'temp_' . time() . '_' . uniqid() . '_' . htmlspecialchars($filename);
		$config['remove_spaces'] = FALSE;
		$config['detect_mime'] = TRUE;

		$this->upload->initialize($config);
		if ($this->upload->do_upload('file')) {
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		} else {
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}
}

?>