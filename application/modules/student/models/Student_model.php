<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    var $table = 'student';
    var $order = array('student_id' => 'desc');
    var $column_search = array('student_full_name');

    private function _get_datatables_query($params = null) {
        $this->db->select('student.*');
        $this->db->select('class_class_id, class.class_name');
        $this->db->select('majors_majors_id, majors.majors_name, majors_short_name');

        $this->db->join('class', 'class.class_id = student.class_class_id', 'left');
        $this->db->join('majors', 'majors.majors_id = student.majors_majors_id', 'left');
        $this->db->from($this->table);
        $i = 0;

        if (isset($params['status']) && $params['status'] != "0") {
            $this->db->where('student.student_status', $params['status']);
        }
        
        if (isset($params['class_id'])) {
            if($params['class_id'] != "0"){
            $this->db->where('class_class_id', $params['class_id']);
            }
        }

        if (isset($params['majors_id'])) {
            if($params['majors_id'] != "0"){
            $this->db->where('majors_majors_id', $params['majors_id']);
            }
        }

        foreach ($this->column_search as $item) { // loop column
            if (isset($this->input->post('search')['value'])) { // if datatable send POST for search
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

    public function getx($table, $data = null, $where = null)
    {
       //if ($data != null) {
       //     return $this->db->get_where($table, $data)->row_array();
       // } else {
       //     return $this->db->get_where($table, $where)->result_array();
       // }
        $this->db->from($table);
        if ($where != null) {
            $this->db->where($where);
        }
        $query = $this->db->get();

        return $query->result();
    }

    function get_datatables($st,$us,$pr) {
        $params = array();
        $params['class_id'] = $pr;
        $params['majors_id'] = $us;
        $params['status'] = $st;
        $this->_get_datatables_query($params);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }
    
    public function getAllData()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->result();
        //$res = $this->db->get('student');
        //return $res->result_array();
    }
    function countAllfiltered() {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->select('student.student_id');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // Get From Databases
    function get($params = array()) {

        if (isset($params['id'])) {
            $this->db->where('student.student_id', $params['id']);
        }
        if (isset($params['student_id'])) {
            $this->db->where('student.student_id', $params['student_id']);
        }

        if (isset($params['multiple_id'])) {
            $this->db->where_in('student.student_id', $params['multiple_id']);
        }

        if(isset($params['student_search']))
        {
            $this->db->where('student_nis', $params['student_search']);
            $this->db->or_like('student_full_name', $params['student_search']);
        }

        if (isset($params['student_nis'])) {
            $this->db->where('student.student_nis', $params['student_nis']);
        }

        if (isset($params['nis'])) {
            $this->db->like('student_nis', $params['nis']);
        }

        if (isset($params['password'])) {
            $this->db->like('student_password', $params['password']);
        }

        if (isset($params['student_full_name'])) {
            $this->db->where('student.student_full_name', $params['student_full_name']);
        }

        if (isset($params['status'])) {
            $this->db->where('student.student_status', $params['status']);
        }
        
        if (isset($params['date'])) {
            $this->db->where('student_input_date', $params['date']);
        }

        if (isset($params['class_id'])) {
            if($params['class_id'] != "all"){
            $this->db->where('class_class_id', $params['class_id']);
            }
        }

        if (isset($params['majors_id'])) {
            if($params['majors_id'] != "all"){
            $this->db->where('majors_majors_id', $params['majors_id']);
            }
        }

        if (isset($params['class_name'])) {
          
                $this->db->like('class_name', $params['class_name']);
          
        }

        if(isset($params['group']))
        {

            $this->db->group_by('student.class_class_id'); 

        }


        if (isset($params['limit'])) {
            if (!isset($params['offset'])) {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if (isset($params['order_by'])) {
            $this->db->order_by($params['order_by'], 'desc');
        } else {
            $this->db->order_by('student_last_update', 'desc');
        }

        $this->db->select('student.student_id, student_nis, student_nisn, student_password, student_gender, student_phone, student_hobby, student_address, student_parent_phone, student_full_name, student_born_place, student_born_date, student_img, student_status, student_name_of_mother, student_name_of_father, student_input_date, student_last_update');
        $this->db->select('student.*');
        $this->db->select('class_class_id, class.class_name');
        $this->db->select('majors_majors_id, majors.majors_name, majors_short_name');

        $this->db->join('class', 'class.class_id = student.class_class_id', 'left');
        $this->db->join('majors', 'majors.majors_id = student.majors_majors_id', 'left');

        $res = $this->db->get('student');

        

        if (isset($params['id'])) {
            return $res->row_array();
        } else if (isset($params['student_nis'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }

    }

    function get_class($params = array())
    {
        if(isset($params['id']))
        {
            $this->db->where('class_id', $params['id']);
        }

        if(isset($params['class_name']))
        {
            $this->db->where('class_name', $params['class_name']);
        }

        if (isset($params['majors_id'])) {
            if($params['majors_id'] != "all"){
            $this->db->where('majors_id', $params['majors_id']);
            }
        }


        if(isset($params['limit']))
        {
            if(!isset($params['offset']))
            {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }
        if(isset($params['order_by']))
        {
            $this->db->order_by($params['order_by'], 'desc');
        }
        else
        {
            $this->db->order_by('class_id', 'asc');
        }

        $this->db->select('class_id, majors_id, class_name');
        $res = $this->db->get('class');

        if(isset($params['id']))
        {
            return $res->row_array();
        } else if (isset($params['class_name'])) {
            return $res->row_array();
        }
        else
        {
            return $res->result_array();
        }
    }


    function get_majors($params = array())
    {
        if(isset($params['id']))
        {
            $this->db->where('majors_id', $params['id']);
        }

        if(isset($params['majors_name']))
        {
            $this->db->where('majors_name', $params['majors_name']);
        }

        if(isset($params['majors_short_name']))
        {
            $this->db->where('majors_short_name', $params['majors_short_name']);
        }


        if(isset($params['limit']))
        {
            if(!isset($params['offset']))
            {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }
        if(isset($params['order_by']))
        {
            $this->db->order_by($params['order_by'], 'desc');
        }
        else
        {
            $this->db->order_by('majors_id', 'asc');
        }

        $this->db->select('majors_id, majors_name, majors_short_name');
        $res = $this->db->get('majors');

        if(isset($params['id'])) {
            return $res->row_array();
        } else if (isset($params['majors_name'])) {
            return $res->row_array();
        }
        else
        {
            return $res->result_array();
        }
    }

    

    function add($data = array()) {

        if (isset($data['student_id'])) {
            $this->db->set('student_id', $data['student_id']);
        }

        if (isset($data['student_nis'])) {
            $this->db->set('student_nis', $data['student_nis']);
        }

        if (isset($data['student_nisn'])) {
            $this->db->set('student_nisn', $data['student_nisn']);
        }

        if (isset($data['student_password'])) {
            $this->db->set('student_password', $data['student_password']);
        }

        if (isset($data['student_gender'])) {
            $this->db->set('student_gender', $data['student_gender']);
        }

        if (isset($data['student_phone'])) {
            $this->db->set('student_phone', $data['student_phone']);
        }

        if (isset($data['student_parent_phone'])) {
            $this->db->set('student_parent_phone', $data['student_parent_phone']);
        }

        if (isset($data['student_hobby'])) {
            $this->db->set('student_hobby', $data['student_hobby']);
        }

        if (isset($data['student_address'])) {
            $this->db->set('student_address', $data['student_address']);
        }

        if (isset($data['student_name_of_father'])) {
            $this->db->set('student_name_of_father', $data['student_name_of_father']);
        }

        if (isset($data['student_full_name'])) {
            $this->db->set('student_full_name', $data['student_full_name']);
        }

        if (isset($data['student_img'])) {
            $this->db->set('student_img', $data['student_img']);
        }

        if (isset($data['student_born_place'])) {
            $this->db->set('student_born_place', $data['student_born_place']);
        }

        if (isset($data['student_born_date']) && $data['student_born_date']!="") {
            $this->db->set('student_born_date', $data['student_born_date']);
        }

        if (isset($data['student_name_of_mother'])) {
            $this->db->set('student_name_of_mother', $data['student_name_of_mother']);
        }

        if (isset($data['class_class_id'])) {
            $this->db->set('class_class_id', $data['class_class_id']);
        }

        if (isset($data['majors_majors_id'])) {
            $this->db->set('majors_majors_id', $data['majors_majors_id']);
        }

        if (isset($data['student_status'])) {
            $this->db->set('student_status', $data['student_status']);
        }

        if (isset($data['student_input_date'])) {
            $this->db->set('student_input_date', $data['student_input_date']);
        }

        if (isset($data['student_last_update'])) {
            $this->db->set('student_last_update', $data['student_last_update']);
        }
        

        if (isset($data['student_no'])) {
            $this->db->set('student_no', $data['student_no']);
        }

        if (isset($data['student_nik'])) {
            $this->db->set('student_nik', $data['student_nik']);
        }

        if (isset($data['student_nomor_virtual_bank'])) {
            $this->db->set('student_nomor_virtual_bank', $data['student_nomor_virtual_bank']);
        }

        if (isset($data['student_nama_panggilan'])) {
            $this->db->set('student_nama_panggilan', $data['student_nama_panggilan']);
        }

        if (isset($data['student_jurusan'])) {
            $this->db->set('student_jurusan', $data['student_jurusan']);
        }

        if (isset($data['student_tingkatan'])) {
            $this->db->set('student_tingkatan', $data['student_tingkatan']);
        }

        if (isset($data['student_email'])) {        
            $this->db->set('student_email', $data['student_email']);    
        }

        if (isset($data['student_agama'])) {
            $this->db->set('student_agama', $data['student_agama']);
        }

        if (isset($data['student_pelajaran_agama'])) {
            $this->db->set('student_pelajaran_agama', $data['student_pelajaran_agama']);
        }

        if (isset($data['student_kewarganegaraan'])) {
            $this->db->set('student_kewarganegaraan', $data['student_kewarganegaraan']);
        }

        if (isset($data['student_anak_ke'])) {
            $this->db->set('student_anak_ke', $data['student_anak_ke']);
        }

        if (isset($data['student_jumlah_saudara'])) {
            $this->db->set('student_jumlah_saudara', $data['student_jumlah_saudara']);
        }

        if (isset($data['student_status_dalam_keluarga'])) {
            $this->db->set('student_status_dalam_keluarga', $data['student_status_dalam_keluarga']);
        }

        if (isset($data['student_tinggi'])) {
            $this->db->set('student_tinggi', $data['student_tinggi']);
        }

        if (isset($data['student_berat'])) {
            $this->db->set('student_berat', $data['student_berat']);
        }

        if (isset($data['student_imunisasi'])) {
            $this->db->set('student_imunisasi', $data['student_imunisasi']);
        }

        if (isset($data['student_penyakit_yang_pernah_diderita'])) {
            $this->db->set('student_penyakit_yang_pernah_diderita', $data['student_penyakit_yang_pernah_diderita']);
        }

        if (isset($data['student_golongan_darah'])) {
            $this->db->set('student_golongan_darah', $data['student_golongan_darah']);
        }

        if (isset($data['student_bahasa_rumah'])) {
            $this->db->set('student_bahasa_rumah', $data['student_bahasa_rumah']);
        }

        if (isset($data['student_alergi_makanan'])) {
            $this->db->set('student_alergi_makanan', $data['student_alergi_makanan']);
        }

        if (isset($data['student_kelurahan'])) {
      
            $this->db->set('student_kelurahan', $data['student_kelurahan']);
        }

        if (isset($data['student_kecamatan'])) {
            $this->db->set('student_kecamatan', $data['student_kecamatan']);
        }

        if (isset($data['student_provinsi'])) {
            $this->db->set('student_provinsi', $data['student_provinsi']);
        }

        if (isset($data['student_sekolah_asal'])) {        
            $this->db->set('student_sekolah_asal', $data['student_sekolah_asal']);
        }

        if (isset($data['student_alumni'])) {
            $this->db->set('student_alumni', $data['student_alumni']);
        }

        if (isset($data['student_tanggal_masuk']) && $data['student_tanggal_masuk'] != "") {
            $this->db->set('student_tanggal_masuk', $data['student_tanggal_masuk']);
        }

        if (isset($data['student_tanggal_keluar']) && $data['student_tanggal_keluar'] != "") {
            $this->db->set('student_tanggal_keluar', $data['student_tanggal_keluar']);
        }

        if (isset($data['student_pindah_ke_sekolah'])) {
            $this->db->set('student_pindah_ke_sekolah', $data['student_pindah_ke_sekolah']);
        }

        if (isset($data['student_alasan_pindah'])) {
            $this->db->set('student_alasan_pindah', $data['student_alasan_pindah']);
        }

        if (isset($data['student_telp_ayah'])) {      
            $this->db->set('student_telp_ayah', $data['student_telp_ayah']);
        }

        if (isset($data['student_pekerjaan_ayah'])) {
            $this->db->set('student_pekerjaan_ayah', $data['student_pekerjaan_ayah']);
        }

        if (isset($data['student_alamat_ayah'])) {
            $this->db->set('student_alamat_ayah', $data['student_alamat_ayah']);
        }

        if (isset($data['student_email_ayah'])) {
            $this->db->set('student_email_ayah', $data['student_email_ayah']);
        }

        if (isset($data['student_agama_ayah'])) {
            $this->db->set('student_agama_ayah', $data['student_agama_ayah']);
        }

        if (isset($data['student_tempat_lahir_ayah'])) {
            $this->db->set('student_tempat_lahir_ayah', $data['student_tempat_lahir_ayah']);
        }

        if (isset($data['student_tanggal_lahir_ayah']) && $data['student_tanggal_lahir_ayah'] != "" ) {
            $this->db->set('student_tanggal_lahir_ayah', $data['student_tanggal_lahir_ayah']);
        }

        if (isset($data['student_kewarganegaraan_ayah'])) {
            $this->db->set('student_kewarganegaraan_ayah', $data['student_kewarganegaraan_ayah']);
        }

        if (isset($data['student_pendidikan_terakhir_ayah'])) {
            $this->db->set('student_pendidikan_terakhir_ayah', $data['student_pendidikan_terakhir_ayah']);
        }

        if (isset($data['student_telp_ibu'])) {        
            $this->db->set('student_telp_ibu', $data['student_telp_ibu']);
        }

        if (isset($data['student_pekerjaan_ibu'])) {
            $this->db->set('student_pekerjaan_ibu', $data['student_pekerjaan_ibu']);
        }

        if (isset($data['student_alamat_ibu'])) {
            $this->db->set('student_alamat_ibu', $data['student_alamat_ibu']);
        }

        if (isset($data['student_email_ibu'])) {
            $this->db->set('student_email_ibu', $data['student_email_ibu']);
        }

        if (isset($data['student_agama_ibu'])) {
            $this->db->set('student_agama_ibu', $data['student_agama_ibu']);
        }

        if (isset($data['student_tempat_lahir_ibu'])) {
            $this->db->set('student_tempat_lahir_ibu', $data['student_tempat_lahir_ibu']);
        }

        if (isset($data['student_tanggal_lahir_ibu']) && $data['student_tanggal_lahir_ibu'] != "") {
            $this->db->set('student_tanggal_lahir_ibu', $data['student_tanggal_lahir_ibu']);
        }

        if (isset($data['student_kewarganegaraan_ibu'])) {
            $this->db->set('student_kewarganegaraan_ibu', $data['student_kewarganegaraan_ibu']);
        }

        if (isset($data['student_pendidikan_terakhir_ibu'])) {
            $this->db->set('student_pendidikan_terakhir_ibu', $data['student_pendidikan_terakhir_ibu']);
        }

        if (isset($data['student_nama_wali'])) {      
            $this->db->set('student_nama_wali', $data['student_nama_wali']);
        }

        if (isset($data['student_telp_wali'])) {
            $this->db->set('student_telp_wali', $data['student_telp_wali']);
        }

        if (isset($data['student_pekerjaan_wali'])) {
            $this->db->set('student_pekerjaan_wali', $data['student_pekerjaan_wali']);
        }

        if (isset($data['student_alamat_wali'])) {
            $this->db->set('student_alamat_wali', $data['student_alamat_wali']);
        }

        if (isset($data['student_email_wali'])) {
            $this->db->set('student_email_wali', $data['student_email_wali']);
        }

        if (isset($data['student_id'])) {
            $this->db->where('student_id', $data['student_id']);
            $this->db->update('student');
            $id = $data['student_id'];
        } else {
            $this->db->insert('student');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    function add_class($data = array()) {

        if (isset($data['class_id'])) {
            $this->db->set('class_id', $data['class_id']);
        }
        if (isset($data['majors_id'])) {
            $this->db->set('majors_id', $data['majors_id']);
        }

        if (isset($data['class_name'])) {
            $this->db->set('class_name', $data['class_name']);
        }

        if (isset($data['class_id'])) {
            $this->db->where('class_id', $data['class_id']);
            $this->db->update('class');
            $id = $data['class_id'];
        } else {
            $this->db->insert('class');
            $id = $this->db->insert_id(); 
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    function add_majors($data = array()) {

        if (isset($data['majors_id'])) {
            $this->db->set('majors_id', $data['majors_id']);
        }

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

    function delete($id) {
        $this->db->where('student_id', $id);
        $this->db->delete('student');
    }

    function delete_class($id) {
        $this->db->where('class_id', $id);
        $this->db->delete('class');
    }

    function delete_majors($id) {
        $this->db->where('majors_id', $id);
        $this->db->delete('majors');
    }

    public function is_exist($field, $value)
    {
        $this->db->where($field, $value);        

        return $this->db->count_all_results('student') > 0 ? TRUE : FALSE;
    }

    function change_password($id, $params) {
        $this->db->where('student_id', $id);
        $this->db->update('student', $params);
    }


    public function _getAllData($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }
}
