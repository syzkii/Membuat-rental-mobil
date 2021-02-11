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
        $id_transaksi = time();
        $id_mobil = $_POST['id_mobil'];
        $tgl_transaksi = $_POST['tgl_transaksi'];
        $id_member = $_POST['id_member'];
        $status = $_POST['status'];

        if(!empty($id_mobil) && !empty($tgl_transaksi) && !empty($id_member) && !empty($status)){
            $sql = "INSERT INTO transaksi (id_transaksi, id_mobil, tgl_transaksi, id_member, status) VALUES ('$id_transaksi','$id_mobil','$tgl_transaksi','$id_member','$status')";
            $simpan = mysqli_query($koneksi, $sql);
            if($simpan && isset($_GET['aksi']) ){
                if($_GET['aksi'] == 'create'){
                    header('Location: transaksi.php');
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
        <input type="hidden" name="id_transaksi">
    </tr>
    <tr>
        <td> ID Mobil </td>
        <td><input type="text" name="id_mobil"></td>
    </tr>
    <tr>
        <td> Tanggal Transaksi </td>
        <td><input type="text" name="tgl_transaksi"></td>
    </tr>
    <tr>
        <td> ID Member </td>
        <td><input type="text" name="id_member"></td>
    </tr>
    <tr>
        <td> Status </td>
        <td><input type="text" name="status"></td>
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
</center>
<br><br>
<?php 

}


function tampil_data($koneksi){
    $sql = "SELECT * FROM transaksi";
    $query = mysqli_query($koneksi, $sql);

    echo"<legend><h3 style='margin-top:0px;'>Data Transaksi</h3></legend>";
    echo "<table border='1' cellpadding='5' class='table table-striped table-dark'>";
    echo"<tr>
    <hr></hr>
        <th>ID Transaksi</th>
        <th>ID Mobil</th>
        <th>Tanggal Transaksi</th>
        <th>ID Member</th>
        <th>Status</th>
        <th><center>Opsi</th></center>
        </tr>";
    $id_transaksi = 1;
    while($data = mysqli_fetch_array($query)){
        ?>
        <tr>
            <td><?php echo $id_transaksi++; ?></td>
            <td><?php echo $data['id_mobil']; ?></td>
            <td><?php echo $data['tgl_transaksi']; ?></td>
            <td><?php echo $data['id_member']; ?></td>
            <td><?php echo $data['status']; ?></td>
            <td>
                <a href="transaksi.php?aksi=update&id_transaksi=<?= $data['id_transaksi']; ?>&id_mobil=<?= $data['id_mobil']; ?>&tgl_transaksi=<?= $data['tgl_transaksi']; ?>&id_member=<?= $data['id_member']; ?>&status=<?= $data['status']; ?>" class="btn btn-warning"><i class="fa fa-edit">Edit</i></a>
                <a href="transaksi.php?aksi=delete&id_transaksi=<?= $data['id_transaksi']; ?>" class="btn btn-danger"><i class="fa fa-trash-o">Hapus</i></a>
            </td>
        </tr>
<?php
}
"</table>";
}


function ubah($koneksi){
    if(isset($_POST['btn_ubah'])){
        $id_transaksi = $_POST['id_transaksi'];
        $id_mobil = $_POST['id_mobil'];
        $tgl_transaksi = $_POST['tgl_transaksi'];
        $id_member = $_POST['id_member'];
        $status = $_POST['status'];

        if(!empty($id_mobil) && !empty($tgl_transaksi) && !empty($id_member) && !empty($status)){
            $sql_update = "UPDATE transaksi SET id_mobil='$id_mobil', tgl_transaksi='$tgl_transaksi', id_member='$id_member', status='$status' WHERE id_transaksi=$id_transaksi";
            $update = mysqli_query($koneksi, $sql_update);
            if($update && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'update'){
                    header('Location: transaksi.php');
                }
            }
        }else{
            $pesan = "Data Tidak Lengkap!";
        }
    }
    if(isset($_GET['id_transaksi'])){
        ?>


        <a href="transaksi.php" class="btn btn-info"><i class="fa fa-home"></i> Home</a> &nbsp;
            <a href="transaksi.php?aksi=create" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <form action="" method="POST">
            <h2>Ubah data</h2>
            <table>
            <tr>
                <input type="hidden" name="id_transaksi" value="<?php echo $_GET['id_transaksi'] ?>"/>
            </tr>
                <tr>
                     <td>ID Mobil </td>
                     <td><input type="text" name="id_mobil" value="<?php echo $_GET['id_mobil'] ?>"/></td>
                </tr>
                <tr>
                     <td>Tanggal Transaksi </td>
                     <td><input type="text" name="tgl_transaksi" value="<?php echo $_GET['tgl_transaksi'] ?>"/></td>
                </tr>
                <tr>
                     <td>ID Member </td>
                     <td><input type="text" name="id_member" value="<?php echo $_GET['id_member'] ?>"/></td>
                </tr>
                <tr>
                     <td>Status </td>
                     <td><input type="text" name="status" value="<?php echo $_GET['status'] ?>"/></td>
                </tr>
              
                <tr>
                <td>
                    <button type="submit" name="btn_ubah" class="btn btn-success"><i class="fa fa-save"></i> Simpan </button>
                </td>
                <td>
                <a href="transaksi.php?aksi=delete&id_transaksi=<?php echo $_GET['id_transaksi'] ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i>HAPUSS</a>
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
    if(isset($_GET['id_transaksi']) && isset($_GET['aksi'])){
        $id_transaksi = $_GET['id_transaksi'];
        $sql_hapus = "DELETE FROM transaksi WHERE id_transaksi=" . $id_transaksi;
        $hapus = mysqli_query($koneksi, $sql_hapus);
       
        if($hapus){
            if($_GET['aksi'] == 'delete'){
                header('Location: transaksi.php');
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
            echo '<a href="transaksi.php" class="btn btn-info"> &laquo; Home</a>';
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