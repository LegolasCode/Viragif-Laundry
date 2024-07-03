<!DOCTYPE html>
<html>
<head>
    <title>Input Data Karyawan</title>
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
    if (isset($_GET['id_karyawan'])) {
        $id_karyawan = input($_GET["id_karyawan"]);
        $sql = "SELECT * FROM karyawan WHERE id_karyawan='$id_karyawan'";
        $hasil = mysqli_query($kon, $sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    // Cek apakah ada kiriman form dari method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_karyawan = input($_POST["id_karyawan"]);
        $karyawan = input($_POST["karyawan"]);
        $job = input($_POST["job"]);

        // Query update data pada tabel header
        $sql = "UPDATE karyawan SET
                id_karyawan='$id_karyawan',
                karyawan='$karyawan',
                job='$job'
                WHERE id_karyawan='$id_karyawan'";

        // Mengeksekusi atau menjalankan query di atas
        $hasil = mysqli_query($kon, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location:karyawan.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan. " . mysqli_error($kon) . "</div>";
            echo "<div class='alert alert-danger'> Query: " . $sql . "</div>"; // Print the query for debugging
        }
    }
    ?>
    <h2>Update Data Karyawan</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Id Karyawan:</label>
            <input type="text" name="id_karyawan" class="form-control" value="<?php echo isset($data['id_karyawan']) ? $data['id_karyawan'] : ''; ?>" required />
        </div>
        <div class="form-group">
            <label>Karyawan:</label>
            <input type="text" name="karyawan" class="form-control" value="<?php echo isset($data['karyawan']) ? $data['karyawan'] : ''; ?>" required />
        </div>
        <div class="form-group">
            <label>Job</label>
            <input type="text" name="job" class="form-control" value="<?php echo isset($data['job']) ? $data['job'] : ''; ?>" required />
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>

