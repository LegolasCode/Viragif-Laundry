<!DOCTYPE html>
<html>
<head>
    <title>Data Nota</title>
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

        $no_nota=input($_POST["no_nota"]);
        $tgl_terima=input($_POST["tgl_terima"]);
        $tgl_selesai=input($_POST["tgl_selesai"]);
        $id_layanan=input($_POST["id_layanan"]);
        $kode_pakaian=input($_POST["kode_pakaian"]);

        //Query input menginput data kedalam tabel anggota
        $sql="insert into header (no_nota,tgl_terima,tgl_selesai,id_layanan,kode_pakaian) values
		('$no_nota','$tgl_terima','$tgl_selesai','$id_layanan','$kode_pakaian')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <h2>Input Data Nota</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>No Nota:</label>
            <input type="text" name="no_nota" class="form-control" placeholder="Masukan No Nota" required />
        </div>
        <div class="form-group">
            <label>Tanggal Terima:</label>
            <input type="date" name="tgl_terima" class="form-control" placeholder="Masukan Tanggal Terima" required/>
        </div>
        <div class="form-group">
            <label>Tanggal Selesai:</label>
            <input type="date" name="tgl_selesai" class="form-control" placeholder="Masukan Tanggal Selesai" required/>
        </div>
       <div class="form-group">
            <label>Id Layanan :</label>
            <input type="text" name="id_layanan" class="form-control" placeholder="Masukan Id Layanan" required/>
        </div>
                </p>
        <div class="form-group">
            <label>Kode Pakaian:</label>
            <input type="text" name="kode_pakaian" class="form-control" placeholder="Masukan Kode Pakaian" required/>
        </div>     

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>