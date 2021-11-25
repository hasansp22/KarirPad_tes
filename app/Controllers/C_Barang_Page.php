<?php

namespace App\Controllers;

class C_Barang_Page extends BaseController
{
    public function index()
    {
        return view('barang');
    }

    public function login_user()
    {
        $username = $this->request->getVar('username');
        $pass = $this->request->getVar('pass');

        $model = new \App\Models\Models();
        $dataUser = $model->query("SELECT * 
        from karyawan 
        where USERNAME_KRY = '$username' and PASS_KRY = '$pass' COLLATE utf8_bin");

        foreach ($dataUser->getResultArray() as $DataUser) {
            // Pengecekan Jabatan
            // Admin
            if (strcmp($DataUser['ID_JABATAN'], 'JB_001') == 0) {

                session()->set('username_adm', $username);
                session()->set('nm_admin', $DataUser['NAMA_KRY']);
                session()->set('jabatan', $DataUser['ID_JABATAN']);
                // session()->setFlashdata('pesan_Welcome', "Selamat Datang .");

                return redirect()->to('/adm');
            } elseif (strcmp($DataUser['ID_JABATAN'], 'JB_002') == 0) {
                session()->set('username_kry', $username);

                session()->set('nama_kry', $DataUser['NAMA_KRY']);
                session()->set('id_jabatan', $DataUser['ID_JABATAN']);
                // session()->set('NM_JAB', $DataUser['NAMA_JABATAN']);
                // session()->set('ID_SUB_KLS', $DataUser['ID_SUB_KLS']);
                // session()->set('NAMA_SUB_KELAS', $DataUser['NAMA_SUB_KELAS']);
                // $this->SetSesionWK($DataUser['ID_SUB_KLS']);

                return redirect()->to('/kry');
            } else {
                session()->setFlashdata('pesan_gagal', 'ID atau Password yang anda masukan salah.');
                return redirect()->to('/Login');
            }
        }
    }

    public function Logout()
    {
        session()->destroy();
        return redirect()->to('/Home');
    }

    //--------------------------------------------------------------------

}
