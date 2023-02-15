<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Backups extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->Global_model->is_logged_in();
        $this->Global_model->is_admin();
        header("X-XSS-Protection: 1; mode=block");
    }

    /*public function backup_db(){
        $this->load->dbutil();

        $db_name = 'backup-db-'.$this->db->database.'-on-'.date('Y-m-d-H-i-s').'.sql';

        $prefs = array(
            'format'                => 'zip',
            'filename'              => $db_name,
            'add_insert'            => TRUE,
            'foreign_key_checks'    => FALSE,
        );

        $backup = $this->dbutil->backup($prefs);

        $save = $db_name;
        write_file($save, $backup);

        $this->load->helper('download');
        force_download($db_name, $backup);
    }*/
}

?>