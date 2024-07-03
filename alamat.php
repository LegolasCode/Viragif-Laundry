<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="style_alamat.css">
</head>
<title>
    Viragif Laundry</title>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">DATABASE VIRAGIF LAUNDRY</span>
        <ul>
                <li><a href="customer.php">Customer</a></li>
                <li><a href="layanan.php">Layanan</a></li>
                <li><a href="pakaian.php">Pakaian</a></li>
                <li><a href="index.php">Nota</a></li>
                <li><a href="alamat.php">Alamat</a></li>
                <li><a href="karyawan.php">Karyawan</a></li>
            </ul>
    </nav>
    <div class="container">
        <br>

        <?php

        include "koneksi.php";

        //Cek apakah ada kiriman form dari method post
        if (isset($_GET['no_nota'])) {
            $no_nota = htmlspecialchars($_GET["no_nota"]);

            $sql = "delete from alamat where no_nota='$no_nota' ";
            $hasil = mysqli_query($kon, $sql);

            //Kondisi apakah berhasil atau tidak
            if ($hasil) {
                header("Location:alamat.php");

            } else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";

            }
        }
        ?>


        <tr class="table-danger">
            <br>
            <thead>
                <tr>
                    <table class="my-3 table table-bordered bg-white">
                        <tr class="table-primary">
                            <th>No</th>
                            <th>No Nota</th>
                            <th>Id Customer</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th colspan='2'>Aksi</th>
                        </tr>
            </thead>

            <?php
            include "koneksi.php";
            $sql = "select * from alamat order by no_nota desc";

            $hasil = mysqli_query($kon, $sql);
            $no = 0;
            while ($data = mysqli_fetch_array($hasil)) {
                $no++;

                ?>
                <tbody>
                    <tr>
                        <td>
                            <?php echo $no; ?>
                        </td>
                        <td>
                            <?php echo $data["no_nota"]; ?>
                        </td>
                        <td>
                            <?php echo $data["id_customer"]; ?>
                        </td>
                        <td>
                            <?php echo $data["telepon"]; ?>
                        </td>
                        <td>
                            <?php echo $data["alamat"]; ?>
                        </td>
                        <td>
                            <a href="update_alamat.php?no_nota=<?php echo htmlspecialchars($data['no_nota']); ?>"
                                class="btn btn-warning" role="button">Update</a>
                            <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?no_nota=<?php echo $data['no_nota']; ?>"
                                class="btn btn-danger" role="button">Delete</a>
                        </td>
                    </tr>
                </tbody>
                <?php
            }
            ?>
            </table>
            <style>
            td{
                    text-align: center;
                }
                th{
                    text-align: center;
                }
            </style>
            <a href="create_alamat.php" class="btn btn-primary" role="button">Tambah Data</a>
    </div>
