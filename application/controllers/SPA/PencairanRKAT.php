<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PencairanRKAT extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->Global_model->is_logged_in();
        header("X-XSS-Protection: 1; mode=block");
        $this->load->model('SPA/RKAT_model', 'm_rkat');
    }

    public function get_uraian_by_nik(){
        $method                 = $this->input->method();
        if ($method == "post") {
            $nik = decrypt($_SESSION['user_sessions']['nik']);
            $kode_rkat_master   = $this->input->post('kode-rkat', true);
            $periode            = $this->input->post('periode', true);
            header('Content-Type: application/json');
            echo $this->m_rkat->get_where_pic_rkat($kode_rkat_master, $periode, ['a1.pic' => $nik]);
        } else return show_404();
    }

    public function get_actbud_by_nik(){
        $method                 = $this->input->method();
        if ($method == "post") {            
            $pic                = $this->input->post('pic', true);
            $jenis              = $this->input->post('jenis', true);
            header('Content-Type: application/json');
            echo $this->m_rkat->get_data_actbud_where_pic($pic, $jenis);
        } else return show_404();
    }

    public function v_input_actbud(){
        $session = $this->session->userdata('user_sessions');
        $data['karyawan'] = $this->m_rkat->get_master_data_karyawan(array('kode_unit' => $session['kode_unit']));
        $data['rkat_master'] = $this->m_rkat->get_rkat_master(array('unit' => $session['kode_unit']))->row_array();
        $data['kode_rkat_master'] = $data['rkat_master']['kode_rkat_master'];
        $data['periode'] = 0;
        if ($data['rkat_master']['periode'] == "Ganjil") {
            $data['periode'] = '1';
        } else if ($data['rkat_master']['periode'] == "Genap") {
            $data['periode'] = '2';
        }
        
        return view('spa.pencairan_rkat.actbud.v_input_actbud', $data);
    }

    public function v_proses_input_actbud(int $id){
        $method = $this->input->method();
        $session = $this->session->userdata('user_sessions');
        $nik = decrypt($session['nik']);
        $data['karyawan'] = $this->m_rkat->get_master_data_karyawan(array('kode_unit' => $session['kode_unit']));
        $data['rkat_master'] = $this->m_rkat->get_rkat_master(array('unit' => $session['kode_unit']))->row_array();
        $data['kode_rkat_master'] = $data['rkat_master']['kode_rkat_master'];
        $data['periode'] = 0;
        if ($data['rkat_master']['periode'] == "Ganjil") {
            $data['periode'] = '1';
        } else if ($data['rkat_master']['periode'] == "Genap") {
            $data['periode'] = '2';
        }

        $data['data'] = $this->m_rkat->get_detail_uraian($data['kode_rkat_master'], $data['periode'], ['a1.pic' => $nik, 'a1.kode_uraian' => $id]);
        if(empty($data['data'])) return show_404();        
        $data['id'] = $id;

        if($method === "post"){
            return $this->save_input_actbud($id, $data['data'], 'actbud');
        }
        
        return view('spa.pencairan_rkat.actbud.v_proses_input_actbud', $data);
    }

    private function save_input_actbud(int $id, array $data, string $jns_aju_agr){
        $this->form_validation->set_rules('deskripsi_kegiatan', 'Deskripsi Kegiatan', 'trim|required|max_length[255]', [
            'required' => '%s tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('pelaksana_kegiatan', 'Pelaksana Kegiatan', 'trim|required|max_length[35]|min_length[32]', [
            'required' => '%s tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'trim|required|max_length[35]', [
            'required' => '%s tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('tgl_selesai', 'Tanggal Selesai', 'trim|required|max_length[35]', [
            'required' => '%s tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $error = [
                'form_error' => validation_errors_array()
            ];
            $this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER']);
        } else {
            $deskripsi_kegiatan = $this->input->post('deskripsi_kegiatan', true);
            $tgl_mulai = $this->input->post('tgl_mulai', true);
            $tgl_selesai = $this->input->post('tgl_selesai', true);
            $pelaksana_kegiatan = $this->input->post('pelaksana_kegiatan', true);
            $decrypt_pelaksana_kegiatan = !decrypt($pelaksana_kegiatan) ? show_404() : decrypt($pelaksana_kegiatan);
            
            if($data['sisa_anggaran'] == 0){
                $this->session->set_flashdata('alert', [
                    'message' => 'Maaf anggaran sudah habis',
                    'type'    => 'error',
                    'title'   => ''
                ]);

                return redirect($_SERVER['HTTP_REFERER']);
            }
            
            $insert_data = [
                'kode_uraian' => $data['kode_uraian'],
                'kode_pencairan' => $data['kode_pencairan'],
                'kode_unit' => $data['kode_unit'],
                'nama_kegiatan' => $data['uraian'],
                'no_borang' => ($data['no_borang'] == null || $data['no_borang'] == "") ? "-" : $data['no_borang'],
                'pic' => $data['pic'],
                'tahun' => date('Y'),
                'tanggal_pembuatan' => date('Y-m-d H:i:s'),
                'periode' => ($data['periode'] == "Ganjil") ? "ganjil" : "genap",
                'deskrip_keg' => $deskripsi_kegiatan,
                'pelaksana' => $decrypt_pelaksana_kegiatan,
                'jns_aju_agr' => $jns_aju_agr,
                'kpi' => $data['kpi'],
                'agr' => $data['sisa_anggaran'],
                'fnl_agr' => $data['sisa_anggaran'],
                'status_act' => null,
                'st_kabag' => 'Submit',
                'tgl_m' => $tgl_mulai,
                'tgl_s' => $tgl_selesai
            ];
            
            $insert = $this->db->insert('tbl_actbud', $insert_data);

            if($insert === true){
                $this->session->set_flashdata('alert', [
                    'message' => 'Berhasil membuat ' . $jns_aju_agr,
                    'type'    => 'success',
                    'title'   => ''
                ]);

                $insert_id = $this->db->insert_id();

                if($jns_aju_agr == 'actbud') {
                    return redirect(base_url('app/sim-spa/pencairan-rkat/actbud/input-actbud/' . $id . '/' . $insert_id));
                } else if($jns_aju_agr == 'petty cash'){
                    return redirect(base_url('app/sim-spa/pencairan-rkat/petty-cash/input-petty-cash/' . $id . '/' . $insert_id));
                }
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Gagal membuat ' . $jns_aju_agr,
                    'type'    => 'error',
                    'title'   => ''
                ]);

                return redirect($_SERVER['HTTP_REFERER']);
            }
        }   
    }

    public function v_detail_actbud(int $id_uraian, int $id_actbud){
        $method = $this->input->method();
        $session = $this->session->userdata('user_sessions');
        $nik = decrypt($session['nik']);
        
        $data['karyawan'] = $this->m_rkat->get_master_data_karyawan(array('kode_unit' => $session['kode_unit']));
        $data['rkat_master'] = $this->m_rkat->get_rkat_master(array('unit' => $session['kode_unit']))->row_array();
        $data['kode_rkat_master'] = $data['rkat_master']['kode_rkat_master'];
        $data['periode'] = 0;
        if ($data['rkat_master']['periode'] == "Ganjil") {
            $data['periode'] = '1';
        } else if ($data['rkat_master']['periode'] == "Genap") {
            $data['periode'] = '2';
        }

        $data['data'] = $this->m_rkat->get_detail_uraian($data['kode_rkat_master'], $data['periode'], ['a1.pic' => $nik, 'a1.kode_uraian' => $id_uraian]);
        if (empty($data['data'])) return show_404();
        // if($data['data']['kd_act'] != $id_actbud) return show_404();
        
        $data['id_uraian'] = $id_uraian;
        $data['id_actbud'] = $id_actbud;
        $data['dokumen_pendukung'] = $this->m_rkat->get_act_dokumen_pendukung($id_actbud);
        $data['rincian_kegiatan'] = $this->m_rkat->get_tjb_act($id_actbud);
        $data['messages'] = $this->m_rkat->get_data_chat_actbud($id_actbud);
        // pr($data['rincian_kegiatan'])
        if($method == "post"){
            $act = $this->input->post('act', true);
            
            switch ($act) {
                case 'buat_rincian_kegiatan':
                    return $this->buat_rincian_kegiatan($id_uraian, $id_actbud, $data['data']);
                    break;
                case 'delete_rincian_kegiatan':
                    return $this->delete_rincian_kegiatan($id_uraian, $id_actbud, $data['data']);
                    break;
                case 'send_message':
                    return $this->buat_pesan($id_uraian, $id_actbud, $data['data']);
                    break;
                case 'hapus_pesan':
                    return $this->hapus_pesan($id_uraian, $id_actbud, $data['data']);
                    break;
                case 'hapus_pesan_reply':
                    return $this->hapus_pesan_reply($id_uraian, $id_actbud, $data['data']);
                    break;
                case 'submit_rkat':
                    return $this->submit_rkat($id_uraian, $id_actbud, $data['data']);
                    break;
                default:
                    return show_error("Bad Request", 400, "400 - Error");
                    break;
            }
        }
        return view('spa.pencairan_rkat.detail.v_detail_actbud_petty_cash', $data);
    }

    private function submit_rkat($id_uraian, $id_actbud, array $arr_data = null){
        $pre_approval = $this->input->post('pre_approval', true);

        $this->form_validation->set_rules('signature', 'Tanda Tangan', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);

        if ($_REQUEST['pre_approval'] != "") {
            $this->form_validation->set_rules('pre_approval', 'Pre-Approval', 'trim|required|numeric', [
                'required' => '%s tidak boleh kosong.'
            ]);
        }

        if ($this->form_validation->run() === TRUE) {
            // ttd
            $signature = $this->input->post('signature');

            if (check_base64_image($signature) === false) {
                return show_error("Tanda tangan invalid!");
            }

            $signature = str_replace('data:image/png;base64,', '', $signature);
            $signature = str_replace(' ', '+', $signature);

            $this->db->where('kd_act', $id_actbud);
            $update = $this->db->update('tbl_actbud', [
                'status_act' => 'send',
                'ttd_pic' => $signature
            ]);

            if ($update === true) {
                $this->session->set_flashdata('alert', [
                    'message' => 'Berhasil submit kegiatan',
                    'type'    => 'success',
                    'title'   => ''
                ]);

                return redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Gagal submit kegiatan',
                    'type'    => 'error',
                    'title'   => ''
                ]);

                return redirect($_SERVER['HTTP_REFERER']);
            }

        } else {
            $error = [
                'form_error' => validation_errors_array()
            ];
            $this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    private function hapus_pesan_reply($id_uraian, $id_actbud, array $arr_data = null){
        $id = decrypt($this->input->post('id', true));
        $this->form_validation->set_rules('id', 'ID', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() === TRUE) {

            $file_name = $this->input->post('attachment', true);

            if ($file_name != "") {
                unlink(FCPATH . 'app-data/chat-attachment/' . $file_name);
            }

            $this->db->where('id_chat', $id);
            $this->db->delete('tbl_chat_reply');

            $this->session->set_flashdata('alert', [
                'message' => 'Pesan berhasil dihapus.',
                'type'    => 'success',
                'title'   => ''
            ]);
            return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
        } else {
            $error = [
                'form_error' => validation_errors_array()
            ];
            $this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
        }
    }

    private function hapus_pesan($id_uraian, $id_actbud, array $arr_data = null){
        $id = decrypt($this->input->post('id', true));
        $this->form_validation->set_rules('id', 'ID', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() === TRUE) {

            $file_name = $this->input->post('attachment', true);

            if ($file_name != "") {
                unlink(FCPATH . 'app-data/chat-attachment/' . $file_name);
            }

            $this->db->where('id_chat', $id);
            $this->db->delete('tbl_chat');

            $this->db->where('id_chat', $id);
            $this->db->delete('tbl_chat_reply');

            $this->session->set_flashdata('alert', [
                'message' => 'Pesan berhasil dihapus.',
                'type'    => 'success',
                'title'   => ''
            ]);
            return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
        } else {
            $error = [
                    'form_error' => validation_errors_array()
                ];
            $this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
        }
    }

    public function buat_pesan($id_uraian, $id_actbud, array $arr_data = null){
        $pic = decrypt($_SESSION['user_sessions']['nik']);
        $pesan = $this->input->post('pesan', true);

        if (isset($_POST['reply_pesan'])) {
            $this->form_validation->set_rules('reply_id', 'ID', 'trim|required', [
                'required' => '%s tidak boleh kosong.'
            ]);
            $this->form_validation->set_rules('reply_pesan', 'Pesan', 'trim|required', [
                'required' => '%s tidak boleh kosong.'
            ]);

            if ($this->form_validation->run() === TRUE) {
                $reply_id = decrypt($this->input->post('reply_id', true));
                $reply_pesan = $this->input->post('reply_pesan', true);
                if (!empty($_FILES['reply_attachment']['name'])) {

                    $path = FCPATH . 'app-data/chat-attachment';
                    $config['upload_path']      = $path;
                    $config['allowed_types']    = 'jpg|jpeg|png|docx|xlsx|pptx|vsdx|pdf';
                    $config['file_name']        = uniqid() . time() . '_' . $_FILES['reply_attachment']['name'];
                    $config['max_size']         = 10000;
                    $config['max_width']        = 2048;
                    $config['max_height']       = 1024;
                    $config['encrypt_name']     = false;
                    $config['detect_mime']      = true;
                    $config['remove_spaces']    = true;
                    $config['mod_mime_fix']     = true;
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('reply_attachment')) {
                        return show_error($this->upload->display_errors(), 402, "Error");
                    } else {
                        $upload_data = $this->upload->data();
                        $file_size = $_FILES['reply_attachment']['size'];

                        $data = [
                            'id_chat' => $reply_id,
                            'nik' => $pic,
                            'pesan' => $reply_pesan,
                            'attachment' => $upload_data['file_name'],
                            'attachment_size' => $file_size
                        ];

                        $insert = $this->db->insert('tbl_chat_reply', $data);

                        if($insert === true){
                            $this->session->set_flashdata('alert', [
                                'message' => 'Pesan berhasil terkirim.',
                                'type'    => 'success',
                                'title'   => ''
                            ]);
    
                            return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
                        } else {
                            $this->session->set_flashdata('alert', [
                                'message' => 'Pesan gagal terkirim.',
                                'type'    => 'error',
                                'title'   => ''
                            ]);

                            return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
                        }
                    }
                } else {
                    $insert = $this->db->insert('tbl_chat_reply', [
                        'id_chat' => $reply_id,
                        'nik' => $pic,
                        'pesan' => $reply_pesan,
                    ]);

                    if($insert === true) {
                        $this->session->set_flashdata('alert', [
                            'message' => 'Pesan berhasil terkirim.',
                            'type'    => 'success',
                            'title'   => ''
                        ]);
    
                        return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
                    } else {
                        $this->session->set_flashdata('alert', [
                            'message' => 'Pesan gagal terkirim.',
                            'type'    => 'error',
                            'title'   => ''
                        ]);

                        return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
                    }

                }
            } else {
                $error = [
                    'form_error' => validation_errors_array()
                ];
                $this->session->set_flashdata('error_validation', $error);
                return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
            }
        } else {

            $this->form_validation->set_rules('pesan', 'Pesan', 'trim|required', [
                'required' => '%s tidak boleh kosong.'
            ]);

            if ($this->form_validation->run() === TRUE) {

                if (!empty($_FILES['attachment']['name'])) {

                    $path = FCPATH . 'app-data/chat-attachment';
                    $config['upload_path']       = $path;
                    $config['allowed_types']     = 'jpg|jpeg|png|docx|xlsx|pptx|vsdx|pdf';
                    $config['file_name']         = uniqid() . time() . '_' . $_FILES['attachment']['name'];
                    $config['max_size']          = 10000;
                    $config['max_width']         = 2048;
                    $config['max_height']        = 1024;
                    $config['encrypt_name']      = false;
                    $config['detect_mime']       = true;
                    $config['remove_spaces']     = true;
                    $config['mod_mime_fix']      = true;
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('attachment')) {
                        return show_error($this->upload->display_errors(), 402, "Error");
                    } else {
                        $upload_data = $this->upload->data();
                        $file_size = $_FILES['attachment']['size'];

                        $data = [
                            'kd_act' => $id_actbud,
                            'nik' => $pic,
                            'pesan' => $pesan,
                            'attachment' => $upload_data['file_name'],
                            'attachment_size' => $file_size
                        ];

                        $insert = $this->db->insert('tbl_chat', $data);

                        if($insert === true){
                            $this->session->set_flashdata('alert', [
                                'message' => 'Pesan berhasil terkirim.',
                                'type'    => 'success',
                                'title'   => ''
                            ]);

                            return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
                        } else {
                            $this->session->set_flashdata('alert', [
                                'message' => 'Pesan gagal terkirim.',
                                'type'    => 'error',
                                'title'   => ''
                            ]);

                            return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
                        }
                    }
                } else {

                    $insert = $this->db->insert('tbl_chat', [
                        'kd_act' => $id_actbud,
                        'nik' => $pic,
                        'pesan' => $pesan
                    ]);
                    
                    if($insert === true){
                        $this->session->set_flashdata('alert', [
                            'message' => 'Pesan berhasil terkirim.',
                            'type'    => 'success',
                            'title'   => ''
                        ]);
    
                        return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
                    } else {
                        $this->session->set_flashdata('alert', [
                            'message' => 'Pesan gagal terkirim.',
                            'type'    => 'error',
                            'title'   => ''
                        ]);

                        return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
                    }
                }
            } else {
                $error = [
                    'form_error' => validation_errors_array()
                ];
                $this->session->set_flashdata('error_validation', $error);
                return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
            }
        }
    }

    private function delete_rincian_kegiatan(int $id_uraian = null, int $id_actbud = null, array $data = null){
        $this->form_validation->set_rules('id', 'ID', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() === TRUE) {

            $id = decrypt($this->input->post('id', true));
            $this->db->where('id', $id);
            $delete = $this->db->delete('t_j_b_act');

            if($delete === true){                
                $this->session->set_flashdata('alert', [
                    'message' => 'Berhasil menghapus kegiatan',
                    'type'    => 'success',
                    'title'   => ''
                ]);
                return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Gagal menghapus kegiatan',
                    'type'    => 'success',
                    'title'   => ''
                ]);
                return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');
            }
        } else {
            $error = [
                    'form_error' => validation_errors_array()
                ];
            $this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    private function buat_rincian_kegiatan(int $id_uraian, int $id_actbud, array $data = null){
        $this->form_validation->set_rules('nama_kegiatan', 'Nama kegiatan', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('total_anggaran', 'Total Anggaran', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() === TRUE) {
            $total_anggaran = $this->input->post('total_anggaran', true);
            $replace_total_anggaran = str_ireplace('.', '', $total_anggaran);
            $nama_kegiatan = $this->input->post('nama_kegiatan', true);
            $keterangan = $this->input->post('keterangan', true);
            if(!is_numeric($replace_total_anggaran) || (is_numeric($replace_total_anggaran) && $replace_total_anggaran < 0)) return show_404();
            $tersisa = ($data['t_act_agr'] - $data['s_tjb_act_agr']);
            
            if($replace_total_anggaran > $tersisa){
                if($tersisa == 0){
                    $this->session->set_flashdata('alert', [
                        'message' => 'Maaf anggaran anda sudah habis',
                        'type'    => 'error',
                        'title'   => ''
                    ]);
                    return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');
                } else {
                    $this->session->set_flashdata('alert', [
                        'message' => 'Maaf anggaran tidak tersedia, anggaran anda tersisa ' . rupiah_1($tersisa),
                        'type'    => 'error',
                        'title'   => ''
                    ]);
                    return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');
                }                
            }

            $insert_data = [
                'kd_act' => $id_actbud,
                'jns_b' => $nama_kegiatan,
                'ket' => $keterangan,
                'pra_pyn' => $replace_total_anggaran,
                'aju_agr' => $replace_total_anggaran,
                'tgl_buat' => date('Y-m-d H:i:s'),
                'status_penyesuaian' => null,
            ];
            
            $insert = $this->db->insert('t_j_b_act', $insert_data);

            if ($insert === true) {
                $this->session->set_flashdata('alert', [
                    'message' => 'Berhasil membuat kegiatan',
                    'type'    => 'success',
                    'title'   => ''
                ]);
                return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Gagal membuat kegiatan',
                    'type'    => 'success',
                    'title'   => ''
                ]);
                return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');
            }
        } else {
            $error = [
                'form_error' => validation_errors_array()
            ];
            $this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    // public function v_view_actbud()
    // {
    //     return view('spa.pencairan_rkat.actbud.v_view_actbud');
    // }

    public function v_status_actbud()
    {
        $session = $this->session->userdata('user_sessions');
        $nik = decrypt($session['nik']);
        $data['data_actbud'] = $this->m_rkat->get_data_actbud_where_pic($nik, 'actbud');
        
        return view('spa.pencairan_rkat.actbud.v_status_actbud', $data);
    }

    public function v_input_pettycash()
    {
        $session = $this->session->userdata('user_sessions');
        $data['karyawan'] = $this->m_rkat->get_master_data_karyawan(array('kode_unit' => $session['kode_unit']));
        $data['rkat_master'] = $this->m_rkat->get_rkat_master(array('unit' => $session['kode_unit']))->row_array();
        $data['kode_rkat_master'] = $data['rkat_master']['kode_rkat_master'];
        $data['periode'] = 0;
        if ($data['rkat_master']['periode'] == "Ganjil") {
            $data['periode'] = '1';
        } else if ($data['rkat_master']['periode'] == "Genap") {
            $data['periode'] = '2';
        }

        return view('spa.pencairan_rkat.petty_cash.v_input_pettycash', $data);
    }

    // public function v_view_pettycash()
    // {
    //     return view('spa.pencairan_rkat.petty_cash.v_view_pettycash');
    // }

    public function v_status_pettycash()
    {
        $session = $this->session->userdata('user_sessions');
        $nik = decrypt($session['nik']);
        $data['data_actbud'] = $this->m_rkat->get_data_actbud_where_pic($nik, 'petty cash');

        return view('spa.pencairan_rkat.petty_cash.v_status_pettycash', $data);
    }

    public function v_proses_input_petty_cash(int $id){
        $method = $this->input->method();
        $session = $this->session->userdata('user_sessions');
        $nik = decrypt($session['nik']);
        $data['karyawan'] = $this->m_rkat->get_master_data_karyawan(array('kode_unit' => $session['kode_unit']));
        $data['rkat_master'] = $this->m_rkat->get_rkat_master(array('unit' => $session['kode_unit']))->row_array();
        $data['kode_rkat_master'] = $data['rkat_master']['kode_rkat_master'];
        $data['periode'] = 0;
        if ($data['rkat_master']['periode'] == "Ganjil") {
            $data['periode'] = '1';
        } else if ($data['rkat_master']['periode'] == "Genap") {
            $data['periode'] = '2';
        }

        $data['data'] = $this->m_rkat->get_detail_uraian($data['kode_rkat_master'], $data['periode'], ['a1.pic' => $nik, 'a1.kode_uraian' => $id]);
        if (empty($data['data'])) return show_404();
        $data['id'] = $id;

        if ($method === "post") {
            return $this->save_input_actbud($id, $data['data'], 'petty cash');
        }

        return view('spa.pencairan_rkat.petty_cash.v_proses_input_petty_cash', $data);
    }

    public function upload_dokumen_pendukung(int $id_uraian, int $id_actbud){
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);

        if (empty($_FILES['dokumen']['name'])) {
            $this->form_validation->set_rules('dokumen', 'Dokumen', 'trim|required', [
                'required' => '%s tidak boleh kosong.'
            ]);
        }

        if ($this->form_validation->run() === TRUE) {            
            $pic = decrypt($_SESSION['user_sessions']['nik']);

            $path = FCPATH . 'app-data/dokumen-pendukung';
            $config['upload_path']      = $path;
            $config['allowed_types']    = 'jpg|jpeg|png|docx|xlsx|pptx|vsdx|pdf';
            $config['file_name']        = uniqid() . time() . '_' . $_FILES['dokumen']['name'];
            $config['max_size']         = 10000;
            $config['max_width']        = 2048;
            $config['max_height']       = 1024;
            $config['encrypt_name']     = false;
            $config['detect_mime']      = true;
            $config['remove_spaces']    = true;
            $config['mod_mime_fix']     = true;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('dokumen')) {
                return show_error($this->upload->display_errors(), 402, "Error");
            } else {
                $upload_data = $this->upload->data();
                $file_size = $_FILES['dokumen']['size'];

                $data = [
                        'kd_act' => $id_actbud,
                        'nama_file' => $upload_data['file_name'],
                        'ukuran_file' => $file_size,
                        'deskripsi' => $this->input->post('deskripsi', true),
                        'user_created' => $pic,
                        'file' => 'app-data/dokumen-pendukung/' . $upload_data['file_name']
                    ];

                $insert = $this->db->insert('tbl_upload_act', $data);
                
                if($insert === true){
                    $this->session->set_flashdata('alert', [
                        'message' => 'Selamat anda berhasil membuat dokumen pendukung.',
                        'type'    => 'success',
                        'title'   => ''
                    ]);

                    return redirect($_SERVER['HTTP_REFERER'] . '#card-dokumen-pendukung');
                } else {
                    $this->session->set_flashdata('alert', [
                        'message' => 'Anda gagal membuat dokumen pendukung.',
                        'type'    => 'error',
                        'title'   => ''
                    ]);

                    return redirect($_SERVER['HTTP_REFERER'] . '#card-dokumen-pendukung');
                }                
            }
        } else {
            $error = [
                    'form_error' => validation_errors_array()
                ];
            $this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function hapus_dokumen_pendukung(int $id_uraian, int $id_actbud){
        $this->form_validation->set_rules('id', 'ID', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('file_name', 'File', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() === TRUE) {
            $id = decrypt($this->input->post('id', true));
            $file_name = $this->input->post('file_name', true);

            if ($file_name != "") {
                unlink(FCPATH . 'app-data/dokumen-pendukung/' . $file_name);
            }

            $this->db->where('id', $id);
            $delete = $this->db->delete('tbl_upload_act');

            if ($delete) {
                $this->session->set_flashdata('alert', [
                    'message' => 'Dokumen pendukung berhasil dihapus.',
                    'type'    => 'success',
                    'title'   => ''
                ]);
                return redirect($_SERVER['HTTP_REFERER'] . '#card-dokumen-pendukung');
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Dokumen pendukung gagal dihapus.',
                    'type'    => 'success',
                    'title'   => ''
                ]);
                return redirect($_SERVER['HTTP_REFERER'] . '#card-dokumen-pendukung');
            }
        } else {
            $error = [
                    'form_error' => validation_errors_array()
                ];
            $this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
