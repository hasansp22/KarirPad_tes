<?php

namespace App\Controllers;

class C_Karyawan extends BaseController
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
        return view('V_Karyawan', $data);
    }

    //--------------------------------------------------------------------

}
