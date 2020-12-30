<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_barang extends CI_Model {
    
    public function findBarang() {
        $this->db->select('name,detailName,barangId,barangName,barangCode,barangType,isProduction,satuan,description,mutu,angkaMutu,slump,a.createdBy,a.createdAt,a.updatedBy,a.updatedAt');
        $this->db->from('barang a');
        $this->db->join('jenisbarang b', 'b.jenisId=a.barangType', 'left');
        $this->db->join('jenisbarangdetail c', 'c.detailId=a.barangName', 'left');
        $this->db->order_by('barangId', 'ASC');
        $exec = $this->db->get();
        if($exec->num_rows() > 0 ){
            $data = $exec->result();
        } else {
            $data = null;
        }
        return $data;
	}

    public function getBarang($barangId) {
        $this->db->select('*');
        $this->db->from('barang a');
        $this->db->join('jenisbarang b', 'b.jenisId=a.barangType', 'left');
        $this->db->join('jenisbarangdetail c', 'c.detailId=a.barangName', 'left');
        $this->db->where('barangId', decrypt($barangId));
        $exec = $this->db->get();
        if($exec->num_rows() > 0 ){
            $dataBarang = $exec->result();
            $data = $dataBarang[0];
        } else {
            $data = null;
        }
        return $data;
    }

    public function checkBarang($barangId,$barangName) {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('barangId', decrypt($barangId));
        $exec = $this->db->get();
        if($exec->num_rows() > 0 ){
            $dataBarang = $exec->result();
            $data = $dataBarang[0];
        } else {
            $data = null;
        }
        return $data;
    }

    public function addBarang($params) {
        
        $check = 0;
        $query = $this->db->query("select * from barang where barangCode=?", strtoupper($params['barangCode']));
        if ($query->num_rows()>0) {
            $check = 1;
            echo "barangCode Sudah Ada!";
        }
        if($params['barangType']=='6'){
            $isProduction = '1';
        }else{
            $isProduction = '0';
        }

        if ($check == 0) {
            $mutu1 = $params['mutu1'];
            $mutu2 = $params['mutu2'];
            $mutu = $mutu1.'-'.$mutu2;
            $saveParam = array(
                            'barangName'   => strtoupper($params['barangName']),
                            'barangCode' =>  strtoupper($params['barangCode']),
                            'barangType'  => strtoupper($params['barangType']),
                            'satuan'  => strtoupper($params['satuan']),
                            'description'  => strtoupper($params['description']),
                            'isProduction'  => strtoupper($isProduction),
                            'mutu' => strtoupper($mutu),
                            'angkaMutu'  => strtoupper($params['angkaMutu']),
                            'slump'  => strtoupper($params['slump']),
                            'createdBy' => getSession('user'),
                            'createdAt' => date('Y-m-d H:I:s'),
                        );
            if ( $this->db->insert('barang', $saveParam) ) {
                // $this->session->set_flashdata('flash_msg',succ_msg('Barang '.strtoupper($params['nama']).' berhasil di Simpan'));
                // redirect('barang');
                echo "TAMBAH DATA SUCCESS";
            } else {
                // $this->session->set_flashdata('flash_msg',err_msg('Gagal di simpan. Ulangi lagi !'));
                // redirect('barang/addBarang');
                echo $this->db->error();
            }
        }
    }

    public function editBarang($params) {
        $mutu1 = $params['mutu1'];
        $mutu2 = $params['mutu2'];
        $mutu = $mutu1.'-'.$mutu2;
        $saveParam = array(
            
                            'barangName'   => strtoupper($params['barangName']),
                            'barangCode' =>  strtoupper($params['barangCode']),
                            'barangType'  => strtoupper($params['barangType']),
                            'satuan'  => strtoupper($params['satuan']),
                            'description'  => strtoupper($params['description']),
                            'mutu' => strtoupper($mutu),
                            'angkaMutu'  => strtoupper($params['angkaMutu']),
                            'slump'  => strtoupper($params['slump']),
                            'updatedBy' => getSession('user'),
                            'updatedAt' => date('Y-m-d H:I:s'),
                    );
        
        if ( $this->db->update('barang', $saveParam, array('barangId' => $params['barangId']) ) ) {
            // $this->session->set_flashdata('flash_msg',succ_msg('Barang '.strtoupper($params['nama']).' berhasil di Simpan'));
            // redirect('barang');
            echo "SUCCESS";
        } else {
            // $this->session->set_flashdata('flash_msg',err_msg('Gagal di simpan. Ulangi lagi !'));
            // redirect('barang/addBarang');
            echo $this->db->error();
        }
    }

    public function getSatuan(){
        $query = $this->db->query("SELECT * FROM satuan ORDER BY satuanName ASC");
        return $query->result();
    }

    public function getJenisbarang(){
        $query = $this->db->query("SELECT * FROM jenisbarang ORDER BY name ASC");
        return $query->result();
    }


    public function getDetailBarang($jenis){
        $this->db->select('*');
        $this->db->from('jenisBarangDetail');
        $this->db->where('jenisId', $jenis);
        $this->db->order_by('detailName', 'ASC');
        $exec = $this->db->get();
        if($exec->num_rows() > 0 ){
            $data = $exec->result();
        } else {
            $data = null;
        }
        return $data;
    }

 
    public function GetCodeBarang($barangName) {
        $data = null;
        $query = $this->db->query("select * from jenisBarangDetail where detailId=?", $barangName);
        foreach ($query->result() as $key => $row) {
            $barangCode = $row->kode;
        }
    
        $query = $this->db->query("select max(barangCode) as maxCode from barang where barangName=? order by barangCode", $barangName);
        foreach ($query->result() as $key => $row) {
            $data = $row->maxCode;
        }
    
        if ($data!=null) {            
            $maxNumber = substr($data, 3,4);
            $newCode = $barangCode.str_pad($maxNumber + 1, 4, "0", STR_PAD_LEFT);
        } else {
            $newCode = $barangCode.'0001';                
        }                                
        return $newCode;
        //echo $newCode;
    }
    
    
}