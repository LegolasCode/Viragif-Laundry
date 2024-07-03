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
        $id_layanan = input($_GET["id_layanan"]);
        $sql = "SELECT * FROM layanan WHERE id_layanan='$id_layanan'";
        $hasil = mysqli_query($kon, $sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    // Cek apakah ada kiriman form dari method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_layanan = input($_POST["id_layanan"]);
        $jenis_layanan = input($_POST["jenis_layanan"]);
        $berat = input($_POST["berat"]);
        $harga = input($_POST["harga"]);

        // Query update data pada tabel header
        $sql = "UPDATE layanan SET
                id_layanan='$id_layanan',
                jenis_layanan='$jenis_layanan',
                berat='$berat',
                harga='$harga'
                WHERE id_layanan='$id_layanan'";

        // Mengeksekusi atau menjalankan query di atas
        $hasil = mysqli_query($kon, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location:layanan.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan. " . mysqli_error($kon) . "</div>";
            echo "<div class='alert alert-danger'> Query: " . $sql . "</div>"; // Print the query for debugging
        }
    }
    ?>
    <h2>Update Data Layanan</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Id_Layanan:</label>
            <input type="text" name="id_layanan" class="form-control" value="<?php echo isset($data['id_layanan']) ? $data['id_layanan'] : ''; ?>" required />
        </div>
        <div class="form-group">
            <label>Jenis Layanan:</label>
            <input type="text" name="jenis_layanan" class="form-control" value="<?php echo isset($data['jenis_layanan']) ? $data['jenis_layanan'] : ''; ?>" required />
        </div>
        <div class="form-group">
            <label>Berat</label>
            <input type="text" name="berat" class="form-control" value="<?php echo isset($data['berat']) ? $data['berat'] : ''; ?>" required />
        </div>
        <div class="form-group">
            <label>Harga:</label>
            <input type="text" name="harga" class="form-control" value="<?php echo isset($data['harga']) ? $data['harga'] : ''; ?>" required />
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>

