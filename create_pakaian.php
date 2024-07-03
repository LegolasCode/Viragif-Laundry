<!DOCTYPE html>
<html>
<head>
    <title>Data Pakaian</title>
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

        $kode_pakaian=input($_POST["kode_pakaian"]);
        $jenis_pakaian=input($_POST["jenis_pakaian"]);
        $jumlah_pakaian=input($_POST["jumlah_pakaian"]);

        //Query input menginput data kedalam tabel anggota
        $sql="insert into pakaian (kode_pakaian,jenis_pakaian,jumlah_pakaian) values
		('$kode_pakaian','$jenis_pakaian','$jumlah_pakaian')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:pakaian.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <h2>Input Data Pakaian</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Kode Pakaian:</label>
            <input type="text" name="kode_pakaian" class="form-control" placeholder="Masukan Kode Pakaian" required />
        </div>
        <div class="form-group">
            <label>Jenis Pakaian:</label>
            <input type="" name="jenis_pakaian" class="form-control" placeholder="Masukan Jenis Pakaian" required/>
        </div>
       <div class="form-group">
            <label>Jumlah Pakaian:</label>
            <input type="text" name="jumlah_pakaian" class="form-control" placeholder="Masukan Jumlah Pakaian" required/>
        </div>
 
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>