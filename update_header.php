<!DOCTYPE html>
<html>
<head>
    <title>Input Data Nota</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    // Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    // Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Cek apakah ada nilai yang dikirim menggunakan method GET dengan nama no_nota
    if (isset($_GET['no_nota'])) {
        $no_nota = input($_GET["no_nota"]);
        $sql = "SELECT * FROM header WHERE no_nota='$no_nota'";
        $hasil = mysqli_query($kon, $sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    // Cek apakah ada kiriman form dari method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $no_nota = input($_POST["no_nota"]);
        $tgl_terima = input($_POST["tgl_terima"]);
        $tgl_selesai = input($_POST["tgl_selesai"]);
        $id_layanan = input($_POST["id_layanan"]);
        $kode_pakaian = input($_POST["kode_pakaian"]);
        // Query update data pada tabel header
        $sql = "UPDATE header SET
                no_nota='$no_nota',
                tgl_terima='$tgl_terima',
                tgl_selesai='$tgl_selesai',
                id_layanan='$id_layanan',
                kode_pakaian='$kode_pakaian',
                WHERE no_nota='$no_nota'";

        // Mengeksekusi atau menjalankan query di atas
        $hasil = mysqli_query($kon, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location:index.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan. " . mysqli_error($kon) . "</div>";
            echo "<div class='alert alert-danger'> Query: " . $sql . "</div>"; // Print the query for debugging
        }
    }
    ?>
    <h2>Update Data Nota</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>No Nota:</label>
            <input type="text" name="no_nota" class="form-control" value="<?php echo isset($data['no_nota']) ? $data['no_nota'] : ''; ?>" required />
        </div>
        <div class="form-group">
            <label>Tanggal Terima:</label>
            <input type="date" name="tgl_terima" class="form-control" value="<?php echo isset($data['tgl_terima']) ? $data['tgl_terima'] : ''; ?>" required />
        </div>
        <div class="form-group">
            <label>Tanggal Selesai:</label>
            <input type="date" name="tgl_selesai" class="form-control" value="<?php echo isset($data['tgl_selesai']) ? $data['tgl_selesai'] : ''; ?>" required />
        </div>
        <div class="form-group">
            <label>Id Layanan:</label>
            <input type="text" name="id_layanan" class="form-control" value="<?php echo isset($data['id_layanan']) ? $data['id_layanan'] : ''; ?>" required />
        </div>
        <div class="form-group">
            <label>Kode Pakaian:</label>
            <input type="text" name="kode_pakaian" class="form-control" value="<?php echo isset($data['kode_pakaian']) ? $data['kode_pakaian'] : ''; ?>" required />
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>

