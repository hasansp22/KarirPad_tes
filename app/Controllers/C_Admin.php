<?php

namespace App\Controllers;

class C_Admin extends BaseController
{
    public function index()
    {
        $Model = new \App\Models\Models();
        $view_brg = $Model->query(
            "SELECT * FROM barang"
        );

        $data = [
            'view_brg' => $view_brg,
            'validation' => \Config\Services::validation(),

        ];
        return view('V_Admin', $data);
    }


    public function insert_brg()
    {
        if (!$this->validate([
            'foto_brg' => [
                'rules' => [
                    'max_size[foto_brg,1024]',
                    'uploaded[foto_brg]',
                    'is_image[foto_brg]'

                ],
                'errors' => [
                    'uploaded' => 'pilih file foto terlebih dahulu',
                    'max_size' => 'ukuran foto terlalu besar (max 1Mb)',
                    'is_image' => 'hanya bisa upload file format gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/adm/kry/add')->withInput()->with('validation', $validation);
            return redirect()->to('/adm')->withInput();
        }

        $Model = new \App\Models\Models();

        $nama_brg = $this->request->getVar('nama_brg');
        $kategori_brg = $this->request->getVar('kategori_brg');
        $harga_brg = $this->request->getVar('harga_brg');

        $foto_brg = $this->request->getFile('foto_brg');
        $foto_brg->move('assets/img/foto_brg', "$nama_brg.jpg");


        if ($harga_brg > 40000) {
            $diskon = $harga_brg * 0.1;
        } elseif ($harga_brg < 40000 and $harga_brg > 20000) {
            $diskon = $harga_brg * 0.05;
        } else {
            $diskon = 0;
        }

        $Model->query(
            "INSERT INTO barang (ID_BRG, NAMA_BRG, KATEGORI_BRG, HARGA_BRG, DISKON_BRG, FOTO_BRG)
            VALUES ('', '$nama_brg', '$kategori_brg', '$harga_brg', '$diskon', '$nama_brg.jpg')"
        );
        session()->setFlashdata('pesan_insert', 'Data berhasil disimpan.');
        return redirect()->to("/adm");
    }

    public function edit_brg()
    {
        $Model = new \App\Models\Models();

        $edit_id = $this->request->getVar('edit_id');
        $nama_brg = $this->request->getVar('edit_nama');
        $kategori_brg = $this->request->getVar('edit_kategori');
        $harga_brg = $this->request->getVar('edit_harga');
        $foto_brg = $this->request->getVar('edit_foto');

        if ($harga_brg > 40000) {
            $diskon = $harga_brg * 0.1;
        } elseif ($harga_brg < 40000 and $harga_brg > 20000) {
            $diskon = $harga_brg * 0.05;
        } else {
            $diskon = 0;
        }

        $Model->query(
            "UPDATE barang SET NAMA_BRG = '$nama_brg', KATEGORI_BRG = '$kategori_brg', HARGA_BRG = '$harga_brg', FOTO_BRG = '$foto_brg', DISKON_BRG = '$diskon' 
            where ID_BRG = '$edit_id';"
        );

        session()->setFlashdata('pesan_update', 'Data berhasil diubah.');
        return redirect()->to("/adm");
    }

    public function hapus_brg()
    {
        $Model = new \App\Models\Models();

        $edit_id = $this->request->getVar('hapus_id');

        $Model->query(
            "DELETE from barang where ID_BRG = '$edit_id';"
        );

        session()->setFlashdata('pesan_hapus', 'Data berhasil dihapus.');
        return redirect()->to("/adm");
    }

    //--------------------------------------------------------------------

}
