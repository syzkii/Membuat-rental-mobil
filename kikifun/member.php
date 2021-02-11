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
        $id_member = time();
        $id_jenis_member = $_POST['id_jenis_member'];
        $ktp = $_POST['ktp'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $pekerjaan = $_POST['pekerjaan'];


        if(!empty($id_jenis_member) && !empty($ktp) && !empty($nama) && !empty($alamat) && !empty($pekerjaan)){
            $sql = "INSERT INTO member (id_member, id_jenis_member, ktp, nama, alamat, pekerjaan) VALUES ('$id_member','$id_jenis_member','$ktp','$nama','$alamat','$pekerjaan')";
            $simpan = mysqli_query($koneksi, $sql);
            if($simpan && isset($_GET['aksi']) ){
                if($_GET['aksi'] == 'create'){
                    header('Location: member.php');
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
        <input type="hidden" name="id_member">
    </tr>
    <tr>
        <td> ID Jenis Member </td>
        <td><input type="text" name="id_jenis_member"></td>
    </tr>
    <tr>
        <td> KTP </td>
        <td><input type="text" name="ktp"></td>
    </tr>
    <tr>
        <td> Nama </td>
        <td><input type="text" name="nama"></td>
    </tr>
    <tr>
        <td> Alamat </td>
        <td><input type="text" name="alamat"></td>
    </tr>
    <tr>
        <td> Pekerjaan </td>
        <td><input type="text" name="pekerjaan"></td>
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
    $sql = "SELECT * FROM member";
    $query = mysqli_query($koneksi, $sql);

    echo"<legend><h3 style='margin-top:0px;'>Data Member</h3></legend>";
    echo "<table border='1' cellpadding='5' class='table table-striped table-dark'>";
    echo"<tr>
    <hr></hr>
        <th>ID Member</th>
        <th>ID Jenis Member</th>
        <th>KTP</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Pekerjaan</th>
        <th><center>Opsi</th></center>
        </tr>";
    $id_member = 1;
    while($data = mysqli_fetch_array($query)){
        ?>
        <tr>
            <td><?php echo $id_member++; ?></td>
            <td><?php echo $data['id_jenis_member']; ?></td>
            <td><?php echo $data['ktp']; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['alamat']; ?></td>
            <td><?php echo $data['pekerjaan']; ?></td>

            <td>
                <a href="member.php?aksi=update&id_member=<?= $data['id_member']; ?>&id_jenis_member=<?= $data['id_jenis_member']; ?>&ktp=<?= $data['ktp']; ?>&nama=<?= $data['nama']; ?>&alamat=<?= $data['alamat']; ?>&pekerjaan=<?= $data['pekerjaan']; ?>" class="btn btn-warning"><i class="fa fa-edit">Edit</i></a>
                <a href="member.php?aksi=delete&id_member=<?= $data['id_member']; ?>" class="btn btn-danger"><i class="fa fa-trash-o">Hapus</i></a>
            </td>
        </tr>
<?php
}
"</table>";
}


function ubah($koneksi){
    if(isset($_POST['btn_ubah'])){
        $id_member = $_POST['id_member'];
        $id_jenis_member = $_POST['id_jenis_member'];
        $ktp = $_POST['ktp'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $pekerjaan = $_POST['pekerjaan'];

        if(!empty($id_jenis_member) && !empty($ktp) && !empty($nama) && !empty($alamat) && !empty($pekerjaan)){
            $sql_update = "UPDATE member SET id_jenis_member='$id_jenis_member', ktp='$ktp', nama='$nama', alamat='$alamat', pekerjaan='$pekerjaan' WHERE id_member=$id_member";
            $update = mysqli_query($koneksi, $sql_update);
            if($update && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'update'){
                    header('Location: member.php');
                }
            }
        }else{
            $pesan = "Data Tidak Lengkap!";
        }
    }
    if(isset($_GET['id_member'])){
        ?>


        <a href="member.php" class="btn btn-info"><i class="fa fa-home"></i> Home</a> &nbsp;
            <a href="member.php?aksi=create" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <form action="" method="POST">
            <h2>Ubah data</h2>
            <table>
            <tr>
                <input type="hidden" name="id_member" value="<?php echo $_GET['id_member'] ?>"/>
            </tr>
                <tr>
                     <td>ID Jenis Member </td>
                     <td><input type="text" name="id_jenis_member" value="<?php echo $_GET['id_jenis_member'] ?>"/></td>
                </tr>
                <tr>
                     <td>KTP </td>
                     <td><input type="text" name="ktp" value="<?php echo $_GET['ktp'] ?>"/></td>
                </tr>
                <tr>
                     <td>Nama </td>
                     <td><input type="text" name="nama" value="<?php echo $_GET['nama'] ?>"/></td>
                </tr>
                <tr>
                     <td>Alamat </td>
                     <td><input type="text" name="alamat" value="<?php echo $_GET['alamat'] ?>"/></td>
                </tr>
                <tr>
                     <td>Pekerjaan </td>
                     <td><input type="text" name="pekerjaan" value="<?php echo $_GET['pekerjaan'] ?>"/></td>
                </tr>
              
                <tr>
                <td>
                    <button type="submit" name="btn_ubah" class="btn btn-success"><i class="fa fa-save"></i> Simpan </button>
                </td>
                <td>
                <a href="member.php?aksi=delete&id_member=<?php echo $_GET['id_member'] ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i>HAPUSS</a>
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
    if(isset($_GET['id_member']) && isset($_GET['aksi'])){
        $id_member = $_GET['id_member'];
        $sql_hapus = "DELETE FROM member WHERE id_member=" . $id_member;
        $hapus = mysqli_query($koneksi, $sql_hapus);
       
        if($hapus){
            if($_GET['aksi'] == 'delete'){
                header('Location: member.php');
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
            echo '<a href="member.php" class="btn btn-info"> &laquo; Home</a>';
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