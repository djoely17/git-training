<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends MY_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Setting/M_barang', 'barang');
        // $this->load->model('M_department', 'department');
        // $this->load->model('M_position', 'position');
    }
    
	function index()
	{
        $data['title_small'] = 'Barang';
        $data['listBarang'] = $this->barang->findBarang();
        $this->template->display('setting/barang/barang', $data);
	}


        function GetDetailBarang()
        {
        $param = $this->input->get();
        $data = $this->barang->getDetailBarang($param['jenisId']);
        $result = "";
        $result = '<option value="">Pilih Nama Barang</option>';
        foreach ($data as $res) {
            $result.="<option value='".$res->detailId."'>".$res->detailName."</option>";
        }
        echo $result;
        }
  

        function GetCodeBarang()
        {
        $param = $this->input->get();
        $data = $this->barang->GetCodeBarang($param['barangName']);
        echo $data;
        }

    

	function AddBarang()
	{
        $data['title_small'] = 'Barang';
        $data['datasatuan'] = $this->barang->getSatuan();
        $data['datajenisbarang'] = $this->barang->getJenisbarang();
        // $data['listDept'] = $this->department->findDepartment();
        $this->template->display('setting/barang/addBarang', $data);
	}

	function AddBarangProcess()
	{
        $param = $this->input->post();
        $this->barang->addBarang($param);
	} 

	function EditBarang($barangId)
	{
        $data['title_small'] = 'Barang';
        $data['dataBarang'] = $this->barang->getBarang($barangId);
        $data['datasatuan'] = $this->barang->getSatuan();
        $data['datajenisbarang'] = $this->barang->getJenisbarang();
        // $data['listDept'] = $this->department->findDepartment();
        $this->template->display('setting/barang/editBarang', $data);
	}

        function EditBarangProcess()
        {
                $param = $this->input->post();
                $this->barang->editBarang($param);
        }

        function DetailBarang($barangId)
	{
        $data['title_small'] = 'Barang';
        $data['dataBarang'] = $this->barang->getBarang($barangId);
        // $data['listDept'] = $this->department->findDepartment();
        $this->template->display('setting/barang/detailBarang', $data);
	}

        function DetailBarangProcess()
        {
                $param = $this->input->post();
                $this->barang->detailBarang($param);
        }

        function DeleteBarang($barangId)
	{
        $data['title_small'] = 'Barang';
        $data['dataBarang'] = $this->barang->getBarang($barangId);
        // $data['listDept'] = $this->department->findDepartment();
        $this->template->display('setting/barang/deleteBarang', $data);
	}

        function DeleteBarangProcess()
        {
                $param = $this->input->post();
                $this->barang->deleteBarang($param);
        }
}
