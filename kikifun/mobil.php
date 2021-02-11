<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD barang</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-grid.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-grid.min.css">

<script>
function kembali() {
  location.replace("halaman.php")
}
</script>
<button type="submit" class="btn btn-info" onclick="kembali()"><b>Kembali</b></button>

</head>
<body>
<?php

$koneksi = mysqli_connect("localhost","root","","rental_mobil");

function tambah($koneksi){
    if(isset($_POST['btn_simpan'])){
        $id_mobil = time();
        $id_jenis_mobil = $_POST['id_jenis_mobil'];
        $merk_mobil = $_POST['merk_mobil'];
        $tahun_mobil = $_POST['tahun_mobil'];
        $harga_mobil = $_POST['harga_mobil'];

        if(!empty($id_jenis_mobil) && !empty($tahun_mobil) && !empty($merk_mobil) && !empty($tahun_mobil) && !empty($harga_mobil)){
            $sql = "INSERT INTO mobil (id_mobil, id_jenis_mobil, merk_mobil, tahun_mobil, harga_mobil) VALUES ('$id_mobil','$id_jenis_mobil','$merk_mobil','$tahun_mobil','$harga_mobil')";
            $simpan = mysqli_query($koneksi, $sql);
            if($simpan && isset($_GET['aksi']) ){
                if($_GET['aksi'] == 'create'){
                    header('Location: mobil.php');
                }
            }
        }else{
            $pesan = "<p style='color: red'>Tidak dapat menyimpan atau data belum lengkap!</p>";
        }
    }

?>
<form action="" method="post" class="form-group">
<h3 style="margin-top:10px;  ">Tambah Data</h3>
    <table border="0">
    <tr>
        <input type="hidden" name="id_mobil">
    </tr>
    <tr>
        <td> ID Jenis Mobil </td>
        <td><input type="text" name="id_jenis_mobil"></td>
    </tr>
    <tr>
        <td> Merk Mobil </td>
        <td><input type="text" name="merk_mobil"></td>
    </tr>
    <tr>
        <td> Tahun Mobil </td>
        <td><input type="text" name="tahun_mobil"></td>
    </tr>
    <tr>
        <td> Harga Mobil </td>
        <td><input type="text" name="harga_mobil"></td>
    </tr>
    <tr>
    <td colspan='2'>
        <button type="submit" name="btn_simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" class="btn btn-danger"><i class="fa fa-reply-all"></i> Bersihkan</button>
    </tr>
    <hr>
    </table>
    <p><?php echo isset($pesan) ? $pesan : "" ?></p>
</form>
<br><br>
<?php 

}


function tampil_data($koneksi){
    $sql = "SELECT * FROM mobil";
    $query = mysqli_query($koneksi, $sql);

    echo"<legend><h3 style='margin-top:0px;'>Data Mobil</h3></legend>";
    echo "<table border='1' cellpadding='5' class='table table-striped table-dark'>";
    echo"<tr>
    <hr></hr>
        <th>ID Mobil</th>
        <th>ID Jenis Mobil</th>
        <th>Merk Mobil</th>
        <th>Tahun Mobil</th>
        <th>Harga Mobil</th>
        <th><center>Opsi</th></center>
        </tr>";
    $id_mobil = 1;
    while($data = mysqli_fetch_array($query)){
        ?>
        <tr>
            <td><?php echo $id_mobil++; ?></td>
            <td><?php echo $data['id_jenis_mobil']; ?></td>
            <td><?php echo $data['merk_mobil']; ?></td>
            <td><?php echo $data['tahun_mobil']; ?></td>
            <td><?php echo $data['harga_mobil']; ?></td>
            <td>
                <a href="mobil.php?aksi=update&id_mobil=<?= $data['id_mobil']; ?>&id_jenis_mobil=<?= $data['id_jenis_mobil']; ?>&merk_mobil=<?= $data['merk_mobil']; ?>&tahun_mobil=<?= $data['tahun_mobil']; ?>&harga_mobil=<?= $data['harga_mobil']; ?>" class="btn btn-warning"><i class="fa fa-edit">Edit</i></a>
                <a href="mobil.php?aksi=delete&id_mobil=<?= $data['id_mobil']; ?>" class="btn btn-danger"><i class="fa fa-trash-o">Hapus</i></a>
            </td>
        </tr>
<?php
}
"</table>";
}


function ubah($koneksi){
    if(isset($_POST['btn_ubah'])){
        $id_mobil = $_POST['id_mobil'];
        $id_jenis_mobil = $_POST['id_jenis_mobil'];
        $merk_mobil = $_POST['merk_mobil'];
        $tahun_mobil = $_POST['tahun_mobil'];
        $harga_mobil = $_POST['harga_mobil'];

        if(!empty($id_jenis_mobil) && !empty($merk_mobil) && !empty($tahun_mobil) && !empty($harga_mobil)){
            $sql_update = "UPDATE mobil SET id_jenis_mobil='$id_jenis_mobil', merk_mobil='$merk_mobil', tahun_mobil='$tahun_mobil', harga_mobil='$harga_mobil' WHERE id_mobil=$id_mobil";
            $update = mysqli_query($koneksi, $sql_update);
            if($update && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'update'){
                    header('Location: mobil.php');
                }
            }
        }else{
            $pesan = "Data Tidak Lengkap!";
        }
    }
    if(isset($_GET['id_mobil'])){
        ?>


        <a href="mobil.php" class="btn btn-info"><i class="fa fa-home"></i> Home</a> &nbsp;
            <a href="mobil.php?aksi=create" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <form action="" method="POST">
            <h2>Ubah data</h2>
            <table>
            <tr>
                <input type="hidden" name="id_mobil" value="<?php echo $_GET['id_mobil'] ?>"/>
            </tr>
                <tr>
                     <td>ID Jenis Mobil </td>
                     <td><input type="text" name="id_jenis_mobil" value="<?php echo $_GET['id_jenis_mobil'] ?>"/></td>
                </tr>
                <tr>
                     <td>Merk Mobil </td>
                     <td><input type="text" name="merk_mobil" value="<?php echo $_GET['merk_mobil'] ?>"/></td>
                </tr>
                <tr>
                     <td>Tahun Mobil </td>
                     <td><input type="text" name="tahun_mobil" value="<?php echo $_GET['tahun_mobil'] ?>"/></td>
                </tr>
                <tr>
                     <td>Harga Mobil </td>
                     <td><input type="text" name="harga_mobil" value="<?php echo $_GET['harga_mobil'] ?>"/></td>
                </tr>
                <tr>
                <td>
                    <button type="submit" name="btn_ubah" class="btn btn-success"><i class="fa fa-save"></i> Simpan </button>
                </td>
                <td>
                <a href="mobil.php?aksi=delete&id_mobil=<?php echo $_GET['id_mobil'] ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i>HAPUSS</a>
                </td>
                </tr>
                </table>
                <p><?php echo isset($pesan) ? $pesan : "" ?></p>
               
            </form>
        <?php
    }
   
}
// --- Tutup Fungsi Update
// --- Fungsi Delete
function hapus($koneksi){
    if(isset($_GET['id_mobil']) && isset($_GET['aksi'])){
        $id_mobil = $_GET['id_mobil'];
        $sql_hapus = "DELETE FROM mobil WHERE id_mobil=" . $id_mobil;
        $hapus = mysqli_query($koneksi, $sql_hapus);
       
        if($hapus){
            if($_GET['aksi'] == 'delete'){
                header('Location: mobil.php');
            }
        }
    }
   
}
// --- Tutup Fungsi Hapus
// ===================================================================
// Dari semua elemen
if (isset($_GET['aksi'])){
    switch($_GET['aksi']){
        case "create":
            echo '<a href="mobil.php" class="btn btn-info"> &laquo; Home</a>';
            tambah($koneksi);
            break;
        case "read":
            tampil_data($koneksi);
            break;
        case "update":
            ubah($koneksi);
            tampil_data($koneksi);
            break;
        case "delete":
            hapus($koneksi);
            break;
        default:
            echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidak ada!</h3>";
            tambah($koneksi);
            tampil_data($koneksi);
    }
} else {
    tambah($koneksi);
    tampil_data($koneksi);
}
?>
</body>
</html>