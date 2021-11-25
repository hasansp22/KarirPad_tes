<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Admin</title>
</head>

<body>
    <?= $this->include('Nav/Nav'); ?>

    <div class="container">
        <?php if (session()->getFlashdata('pesan_update')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo session()->getFlashdata('pesan_update'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('pesan_insert')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo session()->getFlashdata('pesan_insert'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('pesan_hapus')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo session()->getFlashdata('pesan_hapus'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="float-right my-2">
            <form action="/C_Barang_Page/Logout" method="POST">
                <button id="btn-logout" type="submit" class="btn btn-primary btn-sm">Log Out</button>
            </form>
        </div>
        <br>
        <h2>Data Barang</h2>
        <!-- tambah Modal -->
        <form action="/C_Admin/insert_brg" method="POST" enctype="multipart/form-data">
            <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" id="dokumen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control nama_brg" name="nama_brg" id="nama_brg">
                            </div>

                            <div class="form-group">
                                <label>Kategori Barang</label>
                                <input type="text" class="form-control kategori_brg" name="kategori_brg" id="kategori_brg">
                            </div>

                            <div class="form-group">
                                <label>Harga Barang</label>
                                <input type="number" min="500" class="form-control harga_brg" name="harga_brg" id="harga_brg">
                            </div>

                            <div class="form-group">
                                <label>Foto Barang</label>
                                <br>
                                <input type="file" class="form-control-file <?= ($validation->hasError('foto_brg')) ? 'is-invalid' : ''; ?>" id="foto_brg" name="foto_brg" required>

                                <div class="invalid-feedback">
                                    <?= $validation->getError('foto_brg'); ?>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <table class="table table-striped my-4">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Foto Barang</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Diskon</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($view_brg->getResultArray() as $O) : ?>
                    <tr>
                        <td> <?php echo $i ?>. </td>
                        <td> <?php echo "<img src='assets/img/foto_brg/$O[FOTO_BRG]' width='80' height='100'>" ?> </td>
                        <td><?= $O['NAMA_BRG']; ?></td>
                        <td><?= $O['KATEGORI_BRG']; ?></td>
                        <td>Rp. <?= $O['HARGA_BRG']; ?></td>
                        <td>Rp. <?= $O['DISKON_BRG']; ?></td>
                        <td>
                            <button data-toggle="modal" type="button" data-target="#editModal" class="btn btn-sm btn-outline-primary btn-edit" data-idbrg="<?= $O['ID_BRG']; ?>" data-namabrg="<?= $O['NAMA_BRG']; ?>" data-kategoribrg="<?= $O['KATEGORI_BRG']; ?>" data-hargabrg="<?= $O['HARGA_BRG']; ?>">Edit</button>

                            <button data-toggle="modal" type="button" data-target="#hapusModal" class="btn btn-sm ml-1 btn-outline-danger btn-delete" data-hapusid="<?= $O['ID_BRG']; ?>" data-hapusnama="<?= $O['NAMA_BRG']; ?>">Hapus</button>
                        </td>
                    </tr>
                    <?php $i++ ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="float-right">
            <button data-toggle="modal" id="btn-edit" data-target="#tambahModal" type="button" class="btn btn-primary">Tambah Data</button>
        </div>

        <!-- hapus Modal -->
        <form action="/adm/hapusBarang">
            <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Yakin menghapus barang ini?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group" hidden>
                                <input type="text" class="form-control hapus_id" name="hapus_id" id="hapus_id">
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" class="form-control hapus_nama" name="hapus_nama" id="hapus_nama" readonly>
                                </div>

                                <!-- <div class="form-group">
                                    <label>Kategori Barang</label>
                                    <input type="text" class="form-control edit_kategori" name="edit_kategori" id="edit_kategori">
                                </div>

                                <div class="form-group">
                                    <label>Harga Barang</label>
                                    <input type="number" min="500" class="form-control edit_harga" name="edit_harga" id="edit_harga">
                                </div>

                                <div class="form-group">
                                    <label>Foto Barang</label>
                                    <br>
                                    <input type="file" class="edit_foto" name="edit_foto" id="edit_foto">
                                </div> -->

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Ya</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- edit Modal -->
        <form action="/adm/editBarang">
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" id="dokumen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group" hidden>
                                <input type="text" class="form-control edit_id" name="edit_id" id="edit_id">
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" class="form-control edit_nama" name="edit_nama" id="edit_nama">
                                </div>

                                <div class="form-group">
                                    <label>Kategori Barang</label>
                                    <input type="text" class="form-control edit_kategori" name="edit_kategori" id="edit_kategori">
                                </div>

                                <div class="form-group">
                                    <label>Harga Barang</label>
                                    <input type="number" min="500" class="form-control edit_harga" name="edit_harga" id="edit_harga">
                                </div>

                                <div class="form-group">
                                    <label>Foto Barang</label>
                                    <br>
                                    <input type="file" class="edit_foto" name="edit_foto" id="edit_foto">
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        $('#dokumen').ready(function() {
            //get Edit Product
            $('.btn-edit').on('click', function() {
                // get data from button edit
                const jidbrg = $(this).data('idbrg');
                const jnamabrg = $(this).data('namabrg');
                const jkategoribrg = $(this).data('kategoribrg');
                const jhargabrg = $(this).data('hargabrg');

                // Set data to Form Edit
                $('.edit_id').val(jidbrg);
                $('.edit_nama').val(jnamabrg);
                $('.edit_kategori').val(jkategoribrg);
                $('.edit_harga').val(jhargabrg).trigger('change');
                // Call Modal Edit
                $('#editModal').modal('show');
            });

            // get Delete Product
            $('.btn-delete').on('click', function() {

                const jidbrg = $(this).data('hapusid');
                const jnamabrg = $(this).data('hapusnama');
                // Set data to Form Edit
                $('.hapus_id').val(jidbrg);
                $('.hapus_nama').val(jnamabrg);
                // Call Modal Edit
                $('#hapusModal').modal('show');
            });
        });
    </script>

</body>

</html>