<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pegawai_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    var $table = 'pegawai';
    var $order = array('employee_id' => 'desc');
    var $column_search = array('employee_name');

    private function _get_datatables_query($params = null) {
        
        $this->db->select('pegawai.*');
        $this->db->select('position.position_name');
        $this->db->select('majors.majors_name');

        $this->db->join('position', 'position.position_id = pegawai.employee_position_id', 'left');
        $this->db->join('majors', 'majors.majors_id = pegawai.employee_majors_id', 'left');
        $this->db->from($this->table);
        $i = 0;


        if (isset($params['position_id'])) {
            if($params['position_id'] != "0"){
            $this->db->where('employee_position_id', $params['position_id']);
            }
        }

        if (isset($params['majors_id'])) {
            if($params['majors_id'] != "0"){
            $this->db->where('employee_majors_id', $params['majors_id']);
            }
        }

        foreach ($this->column_search as $item) { // loop column
            if ($this->input->post('search')['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables($m,$j) {
        $params = array();
        $params['position_id'] = $j;
        $params['majors_id'] = $m;
        $this->_get_datatables_query($params);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }
    
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->select('pegawai.employee_id');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getRiwayat($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }
    
    public function deleteRiwayat($table, $pk, $id)
    {
        return $this->db->delete($table, [$pk => $id]);
    }

    // Get From Databases
    function get($params = array())
    {

        if (isset($params['id'])) {
            $this->db->where('pegawai.employee_id', $params['id']);
        }
        
        if (isset($params['pegawai_search'])) {
            $this->db->where('employee_nis', $params['pegawai_search']);
            $this->db->or_like('employee_name', $params['pegawai_search']);
        }

        if (isset($params['employee_name'])) {
            $this->db->where('pegawai.employee_name', $params['employee_name']);
        }

        if (isset($params['status'])) {
            $this->db->where('pegawai.employee_status', $params['status']);
        }
        

        if (isset($params['jabatan'])) {
            $this->db->where('pegawai.employee_position_id', $params['jabatan']);
        }

        if (isset($params['majors'])) {
            $this->db->where('pegawai.employee_majors_id', $params['majors']);
        }

        if (isset($params['limit'])) {
            if (!isset($params['offset'])) {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if (isset($params['order_by'])) {
            $this->db->order_by($params['order_by'], 'asc');
        } else {
            $this->db->order_by('employee_name', 'asc');
        }

        if (isset($params['nip'])) {
            $this->db->like('employee_nip', $params['nip']);
        }

        if (isset($params['password'])) {
            $this->db->like('employee_password', $params['password']);
        }
        
        $this->db->select('pegawai.*');
        $this->db->select('position.position_name');
        $this->db->select('majors.majors_name');

        $this->db->join('position', 'position.position_id = pegawai.employee_position_id', 'left');
        $this->db->join('majors', 'majors.majors_id = pegawai.employee_majors_id', 'left');

        $res = $this->db->get('pegawai');
        if (isset($params['id'])) {
            return $res->row_array();
        } else if (isset($params['employee_nip'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

    
    function get_position($params = array())
    {
        
        if (isset($params['id'])) {
            $this->db->where('position_id', $params['id']);
        }

        if (isset($params['position_name'])) {
            $this->db->where('position_name', $params['position_name']);
        }

        if (isset($params['position_code'])) {
            $this->db->where('position_code', $params['position_code']);
        }
        
        if (isset($params['majors_id'])) {
            if($params['majors_id'] != 0)
            $this->db->where('position_majors_id', $params['majors_id']);
        }

        if (isset($params['limit'])) {
            if (!isset($params['offset'])) {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }
        if (isset($params['order_by'])) {
            $this->db->order_by($params['order_by'], 'asc');
        } else {
            $this->db->order_by('position_id', 'asc');
        }

        $this->db->select('position_id, position_name, position_code');
        $res = $this->db->get('position');

        if (isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

    //function get_strata($params = array())
    //{

    //}
    
    function get_majors($params = array())
    {
        if (isset($params['id'])) {
            $this->db->where('majors_id', $params['id']);
        }

        if (isset($params['majors_name'])) {
            $this->db->where('majors_name', $params['majors_name']);
        }

        if (isset($params['majors_short_name'])) {
            $this->db->where('majors_short_name', $params['majors_short_name']);
        }


        if (isset($params['limit'])) {
            if (!isset($params['offset'])) {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }
        if (isset($params['order_by'])) {
            $this->db->order_by($params['order_by'], 'asc');
        } else {
            $this->db->order_by('majors_id', 'asc');
        }

        $this->db->select('majors_id, majors_name, majors_short_name');
        $res = $this->db->get('majors');

        if (isset($params['id'])) {
            return $res->row_array();
        } else if (isset($params['majors_name'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

    function add($data = array())
    {
        if (isset($data['employee_id'])) {
            $this->db->set('employee_id', $data['employee_id']);
        }

        if (isset($data['employee_name'])) {
            $this->db->set('employee_name', $data['employee_name']);
        }
        
        if (isset($data['employee_nip'])) {
            $this->db->set('employee_nip', $data['employee_nip']);
        }

        if (isset($data['employee_category'])) {
            $this->db->set('employee_category', $data['employee_category']);
        }

        if (isset($data['employee_position_id'])) {
            $this->db->set('employee_position_id', $data['employee_position_id']);
        }

        if (isset($data['employee_majors_id'])) {
            $this->db->set('employee_majors_id', $data['employee_majors_id']);
        }

        if (isset($data['employee_strata'])) {
            $this->db->set('employee_strata', $data['employee_strata']);
            }

        if (isset($data['employee_gender'])) {
            $this->db->set('employee_gender', $data['employee_gender']);
        }

        if (isset($data['employee_born_date'])) {
            $this->db->set('employee_born_date', $data['employee_born_date']);
            }

        if (isset($data['employee_born_place'])) {
            $this->db->set('employee_born_place', $data['employee_born_place']);
        }
            
        if (isset($data['employee_aktif'])) {
            $this->db->set('employee_aktif', $data['employee_aktif']);
        }

        if (isset($data['employee_status'])) {
            $this->db->set('employee_status', $data['employee_status']);
        }

        if (isset($data['employee_email'])) {
            $this->db->set('employee_email', $data['employee_email']);
        }

        if (isset($data['employee_address'])) {
            $this->db->set('employee_address', $data['employee_address']);
        }    

        if (isset($data['employee_phone'])) {
            $this->db->set('employee_phone', $data['employee_phone']);
        }        

        if (isset($data['employee_photo'])) {
            $this->db->set('employee_photo', $data['employee_photo']);
        }  
        

        if (isset($data['employee_password'])) {
            $this->db->set('employee_password', $data['employee_password']);
            }
            
        if (isset($data['employee_input_date'])) {
            $this->db->set('employee_input_date', $data['employee_input_date']);
        }
            
        if (isset($data['employee_last_update'])) {
            $this->db->set('employee_last_update', $data['employee_last_update']);
        }        
            
        if (isset($data['employee_nik'])) {
            $this->db->set('employee_nik', $data['employee_nik']);
        }            
        if (isset($data['employee_mulai_tugas'])) {
            $this->db->set('employee_mulai_tugas', $data['employee_mulai_tugas']);
        }            
        if (isset($data['employee_asal_sekolah'])) {
            $this->db->set('employee_asal_sekolah', $data['employee_asal_sekolah']);
        }
        if (isset($data['employee_berkas'])) {
            $this->db->set('employee_berkas', $data['employee_berkas']);
        }
        
        if (isset($data['employee_agama'])) {
            $this->db->set('employee_agama', $data['employee_agama']);
        }

        if (isset($data['employee_bpjs_kesehatan'])) {
            $this->db->set('employee_bpjs_kesehatan', $data['employee_bpjs_kesehatan']);
        }

        if (isset($data['employee_bpjs_ketenagakerjaan'])) {
            $this->db->set('employee_bpjs_ketenagakerjaan', $data['employee_bpjs_ketenagakerjaan']);
        }

        if (isset($data['employee_address_ktp'])) {
            $this->db->set('employee_address_ktp', $data['employee_address_ktp']);
        }    

        if (isset($data['employee_kodepos'])) {
            $this->db->set('employee_kodepos', $data['employee_kodepos']);
        }    
        
        if (isset($data['employee_id'])) {
            $this->db->where('employee_id', $data['employee_id']);
            $this->db->update('pegawai');
            $id = $data['employee_id'];
        } else {
            $this->db->insert('pegawai');
            $id = $this->db->insert_id();
        }
        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }
    
    function add_majors($data = array())
    {
        
        if (isset($data['majors_id'])) {
            $this->db->set('majors_id', $data['majors_id']);
        }

        if (isset($data['majors_name'])) {
            $this->db->set('majors_name', $data['majors_name']);
        }

        if (isset($data['majors_short_name'])) {
            $this->db->set('majors_short_name', $data['majors_short_name']);
        }

        if (isset($data['majors_id'])) {
            $this->db->where('majors_id', $data['majors_id']);
            $this->db->update('majors');
            $id = $data['majors_id'];
        } else {
            $this->db->insert('majors');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }
    

    function delete($id)
    {
    }

    function delete_majors($id)
    {
        $this->db->where('majors_id', $id);
        $this->db->delete('majors');
    }

    function delete_position($id)
    {
        $this->db->where('position_id', $id);
        $this->db->delete('position');
    }

    public function is_exist($field, $value)
    {
        $this->db->where($field, $value);

        return $this->db->count_all_results('pegawai') > 0 ? TRUE : FALSE;

    }

    
    function addPenghargaanPegawai($data = array())
    {
        if (isset($data['employee_id'])) {
            $this->db->set('employee_id', $data['employee_id']);
        }

        if (isset($data['achievement_year'])) {
            $this->db->set('achievement_year', $data['achievement_year']);
        }
        
        if (isset($data['achievement_name'])) {
            $this->db->set('achievement_name', $data['achievement_name']);
        }

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('penghargaan_pegawai');
            $id = $data['id'];
        } else {
            $this->db->insert('penghargaan_pegawai');
            $id = $this->db->insert_id();
        }
        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    function addRiwayatJabatan($data = array())
    {
        if (isset($data['employee_id'])) {
            $this->db->set('employee_id', $data['employee_id']);
        }

        if (isset($data['position_start'])) {
            $this->db->set('position_start', $data['position_start']);
        }
        if (isset($data['position_end'])) {
            $this->db->set('position_end', $data['position_end']);
        }
        
        if (isset($data['position_desc'])) {
            $this->db->set('position_desc', $data['position_desc']);
        }

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('riwayat_jabatan');
            $id = $data['id'];
        } else {
            $this->db->insert('riwayat_jabatan');
            $id = $this->db->insert_id();
        }
        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }
    function addRiwayatMengajar($data = array())
    {
        if (isset($data['employee_id'])) {
            $this->db->set('employee_id', $data['employee_id']);
        }

        if (isset($data['teaching_start'])) {
            $this->db->set('teaching_start', $data['teaching_start']);
        }
        if (isset($data['teaching_end'])) {
            $this->db->set('teaching_end', $data['teaching_end']);
        }
        
        if (isset($data['teaching_lesson'])) {
            $this->db->set('teaching_lesson', $data['teaching_lesson']);
        }
        if (isset($data['teaching_desc'])) {
            $this->db->set('teaching_desc', $data['teaching_desc']);
        }

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('riwayat_mengajar');
            $id = $data['id'];
        } else {
            $this->db->insert('riwayat_mengajar');
            $id = $this->db->insert_id();
        }
        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    function addRiwayatPelatihan($data = array())
    {
        if (isset($data['employee_id'])) {
            $this->db->set('employee_id', $data['employee_id']);
        }

        if (isset($data['start_date'])) {
            $this->db->set('start_date', $data['start_date']);
        }
        if (isset($data['end_date'])) {
            $this->db->set('end_date', $data['end_date']);
        }
        
        if (isset($data['penyelenggara'])) {
            $this->db->set('penyelenggara', $data['penyelenggara']);
        }
        if (isset($data['lokasi'])) {
            $this->db->set('lokasi', $data['lokasi']);
        }

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('riwayat_pelatihan');
            $id = $data['id'];
        } else {
            $this->db->insert('riwayat_pelatihan');
            $id = $this->db->insert_id();
        }
        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }
    function addRiwayatPendidikan($data = array())
    {
        if (isset($data['employee_id'])) {
            $this->db->set('employee_id', $data['employee_id']);
        }

        if (isset($data['thn_masuk'])) {
            $this->db->set('thn_masuk', $data['thn_masuk']);
        }
        if (isset($data['thn_lulus'])) {
            $this->db->set('thn_lulus', $data['thn_lulus']);
        }
        
        if (isset($data['sekolah'])) {
            $this->db->set('sekolah', $data['sekolah']);
        }
        if (isset($data['lokasi'])) {
            $this->db->set('lokasi', $data['lokasi']);
        }

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('riwayat_pendidikan_pegawai');
            $id = $data['id'];
        } else {
            $this->db->insert('riwayat_pendidikan_pegawai');
            $id = $this->db->insert_id();
        }
        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }
    function addKeluargaPegawai($data = array())
    {
        if (isset($data['employee_id'])) {
            $this->db->set('employee_id', $data['employee_id']);
        }

        if (isset($data['fam_name'])) {
            $this->db->set('fam_name', $data['fam_name']);
        }

        if (isset($data['fam_desc'])) {
            $this->db->set('fam_desc', $data['fam_desc']);
        }

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('data_keluarga_pegawai');
            $id = $data['id'];
        } else {
            $this->db->insert('data_keluarga_pegawai');
            $id = $this->db->insert_id();
        }
        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }
}