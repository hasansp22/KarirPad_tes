<?php

namespace App\Models;

use CodeIgniter\Model;

class Models extends Model
{
    protected $table      = 'barang';
    protected $primaryKey = 'ID_BRG';
    protected $allowedFields = ['ID_BRG, NAMA_BRG, KATEGORI_BRG, HARGA_BRG, DISKON_BRG, FOTO_BRG'];
}
