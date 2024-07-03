<!DOCTYPE html>
<html>
<head>
    <title>Data Karyawan</title>
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

        $id_karyawan=input($_POST["id_karyawan"]);
        $karyawan=input($_POST["karyawan"]);
        $job=input($_POST["job"]);

        //Query input menginput data kedalam tabel anggota
        $sql="insert into karyawan (id_karyawan,karyawan,job) values
		('$id_karyawan','$karyawan','$job')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:karyawan.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <h2>Input Data Karyawan</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Id Karyawan:</label>
            <input type="text" name="id_karyawan" class="form-control" placeholder="Masukan Id Karyawan" required />
        </div>
        <div class="form-group">
            <label>Karyawan:</label>
            <input type="" name="karyawan" class="form-control" placeholder="Masukan Nama Karyawan" required/>
        </div>
       <div class="form-group">
            <label>Job:</label>
            <input type="text" name="job" class="form-control" placeholder="Masukan Job Karyawan" required/>
        </div>
 
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>