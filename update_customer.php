<!DOCTYPE html>
<html>
<head>
    <title>Input Data Customer</title>
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
    if (isset($_GET['id_customer'])) {
        $id_customer = input($_GET["id_customer"]);
        $sql = "SELECT * FROM customer WHERE id_customer='$id_customer'";
        $hasil = mysqli_query($kon, $sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    // Cek apakah ada kiriman form dari method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_customer = input($_POST["id_customer"]);
        $telepon = input($_POST["telepon"]);
        $nama = input($_POST["nama"]);

        // Query update data pada tabel header
        $sql = "UPDATE customer SET
                id_customer='$id_customer',
                telepon='$telepon',
                nama='$nama'
                WHERE id_customer='$id_customer'";

        // Mengeksekusi atau menjalankan query di atas
        $hasil = mysqli_query($kon, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location:customer.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan. " . mysqli_error($kon) . "</div>";
            echo "<div class='alert alert-danger'> Query: " . $sql . "</div>"; // Print the query for debugging
        }
    }
    ?>
    <h2>Update Data Customer</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Id Customer:</label>
            <input type="text" name="id_customer" class="form-control" value="<?php echo isset($data['id_customer']) ? $data['id_customer'] : ''; ?>" required />
        </div>
        <div class="form-group">
            <label>Telepon:</label>
            <input type="text" name="telepon" class="form-control" value="<?php echo isset($data['telepon']) ? $data['telepon'] : ''; ?>" required />
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?php echo isset($data['nama']) ? $data['nama'] : ''; ?>" required />
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>

