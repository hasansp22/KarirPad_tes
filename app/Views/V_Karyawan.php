<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Karyawan</title>
</head>

<body>
    <?= $this->include('Nav/Nav'); ?>

    <div class="container">

        <div class="float-right my-2">
            <form action="/C_Barang_Page/Logout" method="POST">
                <button id="btn-logout" type="submit" class="btn btn-primary btn-sm">Log Out</button>
            </form>
        </div>
        <br>
        <h2>Data Barang</h2>

        <table class="table table-striped my-4">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Foto Barang</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Diskon</th>
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
                    </tr>
                    <?php $i++ ?>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>