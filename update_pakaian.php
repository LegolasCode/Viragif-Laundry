<!DOCTYPE html>
<html>
<head>
    <title>Input Data Alamat</title>
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
    if (isset($_GET['id_layanan'])) {
        $kode_pakaian = input($_GET["kode_pakaian"]);
        $sql = "SELECT * FROM pakaian WHERE kode_pakaian='$kode_pakaian'";
        $hasil = mysqli_query($kon, $sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    // Cek apakah ada kiriman form dari method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $kode_pakaian = input($_POST["kode_pakaian"]);
        $jenis_pakaian = input($_POST["jenis_pakaian"]);
        $jumlah_pakaian = input($_POST["jumlah_pakaian"]);

        // Query update data pada tabel header
        $sql = "UPDATE pakaian SET
                kode_pakaian='$kode_pakaian',
                jenis_pakaian='$jenis_pakaian',
                jumlah_pakaian='$jumlah_pakaian'
                WHERE kode_pakaian='$kode_pakaian'";

        // Mengeksekusi atau menjalankan query di atas
        $hasil = mysqli_query($kon, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location:pakaian.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan. " . mysqli_error($kon) . "</div>";
            echo "<div class='alert alert-danger'> Query: " . $sql . "</div>"; // Print the query for debugging
        }
    }
    ?>
    <h2>Update Data Pakaian</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Kode Pakaian:</label>
            <input type="text" name="kode_pakaian" class="form-control" value="<?php echo isset($data['kode_pakaian']) ? $data['kode_pakaian'] : ''; ?>" required />
        </div>
        <div class="form-group">
            <label>Jenis Pakaian:</label>
            <input type="text" name="jenis_pakaian" class="form-control" value="<?php echo isset($data['jenis_pakaian']) ? $data['jenis_pakaian'] : ''; ?>" required />
        </div>
        <div class="form-group">
            <label>Jumlah Pakaian</label>
            <input type="text" name="jenis_pakaian" class="form-control" value="<?php echo isset($data['jenis_pakaian']) ? $data['jenis_pakaian'] : ''; ?>" required />
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>

