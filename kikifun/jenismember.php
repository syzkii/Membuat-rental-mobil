<!DOCTYPE html>
<html>

<head>
<title> kee</title>
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
<hr>
    <title>Jenis Member</title>
	
</head>
<body>

<?php
$koneksi = mysqli_connect("localhost","root","","rental_mobil");
function tambah($koneksi){
    
    if (isset($_POST['btn_simpan'])){
        $jenis_member = $_POST['jenis_member'];
        
        if(!empty($jenis_member)){
            $sql = "INSERT INTO jenis_member (jenis_member) VALUES('".$jenis_member."')";
            $simpan = mysqli_query($koneksi, $sql);
            if($simpan && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'create'){
                    header('location: jenismember.php');
                }
            }
        }
    }
    ?> 
<form action="" method="POST">
    <td>
         <h2>Tambah data</h2>
         <br>
                <h5><font face="comic sans ms">Jenis Member <input type="text" class="form-control" name="jenis_member" /></h5> <br></font>
                <label>
                    <input type="submit" class="btn btn-success" name="btn_simpan" value="Simpan"/>
                </label>
                <br>
                <p><?php echo isset($pesan) ? $pesan : "" ?></p>
            </td>
        </form>
    <?php
}
function tampil_data($koneksi){
    $sql = "SELECT * FROM jenis_member";
    $query = mysqli_query($koneksi, $sql);
    
    echo "<h2>Jenis Member</h2>";
    echo "<table border='1' cellpadding='5' class='table table-striped table-dark'>";
    echo "<tr>
    <hr>
    <br>      
            <th>Id Jenis Member</th>
            <th>Jenis Member</th>
            <th>Action</th>
          </tr>";
    $id_jenis_member=0;
    while($data = mysqli_fetch_array($query)){
        $id_jenis_member++;
        ?>
                <td><?php echo $id_jenis_member;?></td>
                <td><?php echo $data['jenis_member']; ?></td>
                <td>
                    <a href="jenismember.php?aksi=update&id_jenis_member=<?php echo $data['id_jenis_member']; ?>&jenis_member=<?php echo $data['jenis_member']; ?>" class="btn btn-warning">Ubah</a> |
                    <a href="jenismember.php?aksi=delete&id_jenis_member=<?php echo $data['id_jenis_member']; ?>" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
        <?php
    }
    echo "</table>";
    echo "</fieldset>";
}
	function ubah($koneksi){
		if(isset($_POST['btn_ubah'])){
			$id_jenis_member = $_POST['id_jenis_member'];
			$jenis_member = $_POST['jenis_member'];
		
			if(!empty($jenis_member)){
				$perubahan = "jenis_member='".$jenis_member."'";
				$sql_update = "UPDATE jenis_member SET ".$perubahan." WHERE id_jenis_member=$id_jenis_member";
				$update = mysqli_query($koneksi, $sql_update);
				if($update && isset($_GET['aksi'])){
					if($_GET['aksi'] == 'update'){
						header('location: jenismember.php');
                }
            }
        }
    }
    if(isset($_GET['id_jenis_member'])){
        ?>
            <a href="jenismember.php"> &laquo; Kembali</a> |
            <a href="jenismember.php?aksi=create">Tambah Data</a>
            <hr>
            <form action="" method="POST">
            <fieldset>
                <h2>Ubah data</h2>
                <hr>
                <input type="hidden" name="id_jenis_member" value="<?php echo $_GET['id_jenis_member'] ?>"/>
                <h5><font face="comic sans ms">Jenis Member <input type="text" class="form-control" name="jenis_member" value="<?php echo $_GET['jenis_member'] ?>"/></h5></font>
                <br>
                <label>
                    <input type="submit" class="btn btn-success" name="btn_ubah" value="Simpan"/> atau <a href="jenismember.php?aksi=delete&id_jenis_member=<?php echo $_GET['id_jenis_member'] ?>" class="btn btn-danger">Hapus ?</a>
                </label>
                <br>
                <p><?php echo isset($pesan) ? $pesan : "" ?></p>
            </fieldset>
            </form>
        <?php
    }
    
}
function hapus($koneksi){
    if(isset($_GET['id_jenis_member']) && isset($_GET['aksi'])){
        $id_jenis_member = $_GET['id_jenis_member'];
        $sql_hapus = "DELETE FROM jenis_member WHERE id_jenis_member=" . $id_jenis_member;
        $hapus = mysqli_query($koneksi, $sql_hapus);
        
        if($hapus){
            if($_GET['aksi'] == 'delete'){
                header('location: jenismember.php');
            }
        }
    }
    
}
if (isset($_GET['aksi'])){
    switch($_GET['aksi']){
        case "create":
            echo '<a href="jenismember.php"> &laquo; Home</a>';
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
            echo "<h3>Aksi <i>".$_GET['aksi']."</i> jenis member ada!</h3>";
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