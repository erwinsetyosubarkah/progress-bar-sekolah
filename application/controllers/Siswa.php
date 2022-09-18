<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

    public function __construct()
   	{
    	parent::__construct();

        $this->load->model('m_siswa','siswa');
   	}    


	public function index()
	{
		$this->load->view('siswa');
	}
	
    public function getData(){
        $hasil = $this->siswa->getData();
        $data = '';
        foreach ($hasil as $siswa) {
            $data .= '
                        <tr>
                            <td>'.$siswa->id.'</td>
                            <td>'.$siswa->id.'</td>
                            <td>'.$siswa->nama.'</td>
                            <td>'.$siswa->kelas.'</td>
                            <td>'.$siswa->alamat.'</td>
                        </tr>
                        ';
        }
        
        echo json_encode($data);
    }

    public function simpanData(){
        
        $hasil = $this->siswa->simpanData();
            
        
        $data = 'Berhasil';        
        
        echo json_encode($data);
    }
}

