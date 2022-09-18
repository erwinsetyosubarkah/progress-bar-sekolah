<?php 



class M_Siswa extends CI_Model{

    public function getData()
    {
        $sql = "SELECT * FROM siswa";
        
       return $this->db->query($sql)->result();
    }

    public function simpanData()
    {
        $sql = "INSERT INTO siswa (nama,kelas,alamat) VALUES('Panjul','XI RPL 2', 'Bekasi')";
        
       $this->db->query($sql);

       return 'berhasil';
    }



}