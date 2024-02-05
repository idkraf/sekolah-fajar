<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penggajian_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
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
    function get_gaji($params = array())
    {
        if (isset($params['id'])) {
            $this->db->where('employee_id', $params['id']);
        }
        $res = $this->db->get('gaji');
        if (isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }
    function get_potongan($params = array())
    {
        if (isset($params['id'])) {
            $this->db->where('employee_id', $params['id']);
        }
        $res = $this->db->get('potongan');
        if (isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }
    

    function add($data = array())
    {
        if (isset($data['gaji_id'])) {
            $this->db->set('gaji_id', $data['gaji_id']);
        }
        
        if (isset($data['employee_id'])) {
            $this->db->set('employee_id', $data['employee_id']);
        }

        if (isset($data['gaji_pokok'])) {
            $this->db->set('gaji_pokok', $data['gaji_pokok']);
        }
        
        if (isset($data['tunjangan_fungsional'])) {
            $this->db->set('tunjangan_fungsional', $data['tunjangan_fungsional']);
        }

        if (isset($data['tunjangan_struktural'])) {
            $this->db->set('tunjangan_struktural', $data['tunjangan_struktural']);
        }

        if (isset($data['tunjangan_kesra'])) {
            $this->db->set('tunjangan_kesra', $data['tunjangan_kesra']);
        }

        if (isset($data['tunjangan_khusus'])) {
            $this->db->set('tunjangan_khusus', $data['tunjangan_khusus']);
        }

        if (isset($data['tunjangan_prestasi'])) {
            $this->db->set('tunjangan_prestasi', $data['tunjangan_prestasi']);
            }

        if (isset($data['poin'])) {
            $this->db->set('poin', $data['poin']);
        }
        
        if (isset($data['tunjangan_jabatan'])) {
            $this->db->set('tunjangan_jabatan', $data['tunjangan_jabatan']);
        }
        if (isset($data['tunjangan_profesi'])) {
            $this->db->set('tunjangan_profesi', $data['tunjangan_profesi']);
        }
        if (isset($data['tunjangan_transport'])) {
            $this->db->set('tunjangan_transport', $data['tunjangan_transport']);
        }
        if (isset($data['uang_makan'])) {
            $this->db->set('uang_makan', $data['uang_makan']);
        }
        if (isset($data['tunjangan_umum'])) {
            $this->db->set('tunjangan_umum', $data['tunjangan_umum']);
        }
        if (isset($data['tunjangan_guru_tetap'])) {
            $this->db->set('tunjangan_guru_tetap', $data['tunjangan_guru_tetap']);
        }
        
        if (isset($data['gaji_id'])) {
            $this->db->where('gaji_id', $data['gaji_id']);
            $this->db->update('gaji');
            $id = $data['gaji_id'];
        } else {
            $this->db->insert('gaji');
            $id = $this->db->insert_id();
        }
        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    function add_potongan($data = array())
    {
        if (isset($data['potongan_id'])) {
            $this->db->set('potongan_id', $data['potongan_id']);
        }
        if (isset($data['employee_id'])) {
            $this->db->set('employee_id', $data['employee_id']);
        }

        if (isset($data['pinjaman_bank'])) {
            $this->db->set('pinjaman_bank', $data['pinjaman_bank']);
        }
        
        if (isset($data['organisasi'])) {
            $this->db->set('organisasi', $data['organisasi']);
        }

        if (isset($data['koperasi'])) {
            $this->db->set('koperasi', $data['koperasi']);
        }

        if (isset($data['program_bahasa'])) {
            $this->db->set('program_bahasa', $data['program_bahasa']);
        }

        if (isset($data['majalah'])) {
            $this->db->set('majalah', $data['majalah']);
        }

        if (isset($data['adm_bank'])) {
            $this->db->set('adm_bank', $data['adm_bank']);
            }

        if (isset($data['infaq_dakwah'])) {
            $this->db->set('infaq_dakwah', $data['infaq_dakwah']);
        }
        
        if (isset($data['bpjs'])) {
            $this->db->set('bpjs', $data['bpjs']);
        }
        if (isset($data['telemarket'])) {
            $this->db->set('telemarket', $data['telemarket']);
        }
        if (isset($data['lainnya'])) {
            $this->db->set('lainnya', $data['lainnya']);
        }
        
        if (isset($data['absensi'])) {
            $this->db->set('absensi', $data['absensi']);
        }
        if (isset($data['iuran_jht'])) {
            $this->db->set('iuran_jht', $data['iuran_jht']);
        }
        if (isset($data['jaminan_pensiun'])) {
            $this->db->set('jaminan_pensiun', $data['jaminan_pensiun']);
        }
        if (isset($data['potongan_id'])) {
            $this->db->where('potongan_id', $data['potongan_id']);
            $this->db->update('potongan');
            $id = $data['potongan_id'];
        } else {
            $this->db->insert('potongan');
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
}