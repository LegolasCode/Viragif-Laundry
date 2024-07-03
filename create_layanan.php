<!DOCTYPE html>
<html>
<head>
    <title>Data Layanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_layanan=input($_POST["id_layanan"]);
        $jenis_layanan=input($_POST["jenis_layanan"]);
        $berat=input($_POST["berat"]);
        $harga=input($_POST["harga"]);

        //Query input menginput data kedalam tabel anggota
        $sql="insert into layanan (id_layanan,jenis_layanan,berat,harga) values
		('$id_layanan','$jenis_layanan','$berat','$harga')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:layanan.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <h2>Input Data Layanan</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Id Layanan:</label>
            <input type="text" name="id_layanan" class="form-control" placeholder="Masukan Id Layanan" required />
        </div>
        <div class="form-group">
            <label>Jenis Layanan:</label>
            <input type="" name="jenis_layanan" class="form-control" placeholder="Masukan Jenis Layanan" required/>
        </div>
       <div class="form-group">
            <label>Berat:</label>
            <input type="text" name="berat" class="form-control" placeholder="Masukan Berat" required/>
        </div>
        <div class="form-group">
            <label>Harga:</label>
            <input type="text" name="harga" class="form-control" placeholder="Masukan Harga" required/>
        </div>
 
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>