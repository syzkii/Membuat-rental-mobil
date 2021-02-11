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
        $jenis_mobil = $_POST['jenis_mobil'];
        
        if(!empty($jenis_mobil)){
            $sql = "INSERT INTO jenis_mobil (jenis_mobil) VALUES('".$jenis_mobil."')";
            $simpan = mysqli_query($koneksi, $sql);
            if($simpan && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'create'){
                    header('location: jenismobil.php');
                }
            }
        }
    }
    ?> 
<form action="" method="POST">
    <td>
         <h2>Tambah data</h2>
         <br>
                <h5><font face="comic sans ms">Jenis Mobil <input type="text" class="form-control" name="jenis_mobil" /></h5> <br></font>
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
    $sql = "SELECT * FROM jenis_mobil";
    $query = mysqli_query($koneksi, $sql);
    
    echo "<h2>Jenis Mobil</h2>";
    echo "<table border='1' cellpadding='5' class='table table-striped table-dark'>";
    echo "<tr>
    <hr>
    <br>      
            <th>Id Jenis Mobil</th>
            <th>Jenis Mobil</th>
            <th>Action</th>
          </tr>";
    $id_jenis_mobil=0;
    while($data = mysqli_fetch_array($query)){
        $id_jenis_mobil++;
        ?>
                <td><?php echo $id_jenis_mobil;?></td>
                <td><?php echo $data['jenis_mobil']; ?></td>
                <td>
                    <a href="jenismobil.php?aksi=update&id_jenis_mobil=<?php echo $data['id_jenis_mobil']; ?>&jenis_mobil=<?php echo $data['jenis_mobil']; ?>" class="btn btn-warning">Ubah</a> |
                    <a href="jenismobil.php?aksi=delete&id_jenis_mobil=<?php echo $data['id_jenis_mobil']; ?>" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
        <?php
    }
    echo "</table>";
    echo "</fieldset>";
}
	function ubah($koneksi){
		if(isset($_POST['btn_ubah'])){
			$id_jenis_mobil = $_POST['id_jenis_mobil'];
			$jenis_mobil = $_POST['jenis_mobil'];
		
			if(!empty($jenis_mobil)){
				$perubahan = "jenis_mobil='".$jenis_mobil."'";
				$sql_update = "UPDATE jenis_mobil SET ".$perubahan." WHERE id_jenis_mobil=$id_jenis_mobil";
				$update = mysqli_query($koneksi, $sql_update);
				if($update && isset($_GET['aksi'])){
					if($_GET['aksi'] == 'update'){
						header('location: jenismobil.php');
                }
            }
        }
    }
    if(isset($_GET['id_jenis_mobil'])){
        ?>
            <a href="jenismobil.php"> &laquo; Kembali</a> |
            <a href="jenismobil.php?aksi=create">Tambah Data</a>
            <hr>
            <form action="" method="POST">
            <fieldset>
                <h2>Ubah data</h2>
                <hr>
                <input type="hidden" name="id_jenis_mobil" value="<?php echo $_GET['id_jenis_mobil'] ?>"/>
                <h5><font face="comic sans ms">Jenis Mobil <input type="text" class="form-control" name="jenis_mobil" value="<?php echo $_GET['jenis_mobil'] ?>"/></h5></font>
                <br>
                <label>
                    <input type="submit" class="btn btn-success" name="btn_ubah" value="Simpan"/> atau <a href="jenismobil.php?aksi=delete&id_jenis_mobil=<?php echo $_GET['id_jenis_mobil'] ?>" class="btn btn-danger">Hapus ?</a>
                </label>
                <br>
                <p><?php echo isset($pesan) ? $pesan : "" ?></p>
            </fieldset>
            </form>
        <?php
    }
    
}
function hapus($koneksi){
    if(isset($_GET['id_jenis_mobil']) && isset($_GET['aksi'])){
        $id_jenis_mobil = $_GET['id_jenis_mobil'];
        $sql_hapus = "DELETE FROM jenis_mobil WHERE id_jenis_mobil=" . $id_jenis_mobil;
        $hapus = mysqli_query($koneksi, $sql_hapus);
        
        if($hapus){
            if($_GET['aksi'] == 'delete'){
                header('location: jenismobil.php');
            }
        }
    }
    
}
if (isset($_GET['aksi'])){
    switch($_GET['aksi']){
        case "create":
            echo '<a href="jenismobil.php"> &laquo; Home</a>';
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
            echo "<h3>Aksi <i>".$_GET['aksi']."</i> jenis Mobil ada!</h3>";
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