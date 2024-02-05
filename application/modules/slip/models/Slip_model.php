<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Slip_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    // Get From Databases
    function get($params = array())
    {
        if (isset($params['employee_id'])) {
            $this->db->where('pegawai.employee_id', $params['employee_id']);
        }
        if (isset($params['slip_id'])) {
            $this->db->where('slip.slip_id', $params['slip_id']);
        }
        
        if (isset($params['period_id'])) {
            $this->db->where('slip.period_id', $params['period_id']);
        }
        if (isset($params['month_id'])) {
            $this->db->where('slip.month_id', $params['month_id']);
        }
        if (isset($params['pegawai_search'])) {
            $this->db->where('employee_nip', $params['pegawai_search']);
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

        //if (isset($params['order_by'])) {
        //    $this->db->order_by($params['order_by'], 'asc');
        //} else {
        //    $this->db->order_by('employee_name', 'asc');
        //}
        
        $this->db->select('slip.*');
        $this->db->select('month.month_name');
        $this->db->select('pegawai.employee_name, pegawai.employee_nip, pegawai.employee_status');
        $this->db->select('class.class_name');
        $this->db->select('majors.majors_name');

        $this->db->join('month', 'month.month_id = slip.month_id');
        $this->db->join('pegawai', 'pegawai.employee_id = slip.employee_id');
        $this->db->join('class', 'class.class_id = pegawai.employee_position_id', 'left');
        $this->db->join('majors', 'majors.majors_id = pegawai.employee_majors_id', 'left');

        $res = $this->db->get('slip');
        if (isset($params['employee_id'])) {
            return $res->row_array();
        } else if (isset($params['slip_id'])) {
            return $res->row_array();
        } else if (isset($params['employee_nip'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }
    
    public function is_exist($params = array())
    {
        //$this->db->where($field, $value);

        if (isset($params['employee_id'])) {
            $this->db->where('employee_id', $params['employee_id']);
        }        
        if (isset($params['period_id'])) {
            $this->db->where('period_id', $params['period_id']);
        }
        if (isset($params['month_id'])) {
            $this->db->where('month_id', $params['month_id']);
        }
        return $this->db->count_all_results('slip') > 0 ? TRUE : FALSE;

    }

    function add($data = array())
    {
        if (isset($data['slip_id'])) {
            $this->db->set('slip_id', $data['slip_id']);
        }
        
        if (isset($data['employee_id'])) {
            $this->db->set('employee_id', $data['employee_id']);
        }
        if (isset($data['month_id'])) {
            $this->db->set('month_id', $data['month_id']);
        }        
        if (isset($data['period_id'])) {
            $this->db->set('period_id', $data['period_id']);
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
        
        if (isset($data['gaji'])) {
            $this->db->set('gaji', $data['gaji']);
        }     
        if (isset($data['potongan'])) {
            $this->db->set('potongan', $data['potongan']);
        }     
        if (isset($data['jumlah_gaji'])) {
            $this->db->set('jumlah_gaji', $data['jumlah_gaji']);
        }     
        if (isset($data['catatan_gaji'])) {
            $this->db->set('catatan_gaji', $data['catatan_gaji']);
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
        
        if (isset($data['absensi'])) {
            $this->db->set('absensi', $data['absensi']);
        }
        if (isset($data['iuran_jht'])) {
            $this->db->set('iuran_jht', $data['iuran_jht']);
        }
        if (isset($data['jaminan_pensiun'])) {
            $this->db->set('jaminan_pensiun', $data['jaminan_pensiun']);
        }
        
        if (isset($data['tanggal_cut_off'])) {
            $this->db->set('tanggal_cut_off', $data['tanggal_cut_off']);
        }
        if (isset($data['hari_efektif'])) {
            $this->db->set('hari_efektif', $data['hari_efektif']);
        }
        if (isset($data['hari_masuk'])) {
            $this->db->set('hari_masuk', $data['hari_masuk']);
        }
        if (isset($data['lupa_absen_masuk'])) {
            $this->db->set('lupa_absen_masuk', $data['lupa_absen_masuk']);
        }
        if (isset($data['lupa_absen_pulang'])) {
            $this->db->set('lupa_absen_pulang', $data['lupa_absen_pulang']);
        }
        if (isset($data['sakit_skd'])) {
            $this->db->set('sakit_skd', $data['sakit_skd']);
        }
        if (isset($data['sakit_non_skd'])) {
            $this->db->set('sakit_non_skd', $data['sakit_non_skd']);
        }
        if (isset($data['izin'])) {
            $this->db->set('izin', $data['izin']);
        }
        if (isset($data['keterlambatan'])) {
            $this->db->set('keterlambatan', $data['keterlambatan']);
        }
        if (isset($data['tanpa_keterangan'])) {
            $this->db->set('tanpa_keterangan', $data['tanpa_keterangan']);
        }


        if (isset($data['slip_id'])) {
            $this->db->where('slip_id', $data['slip_id']);
            $this->db->update('slip');
            $id = $data['slip_id'];
        } else {
            $this->db->insert('slip');
            $id = $this->db->insert_id();
        }
        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    function delete($id)
    {
        $this->db->where('slip_id', $id);
        $this->db->delete('slip');
    }

    
}