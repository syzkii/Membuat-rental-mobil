<head>
<title> kee</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-grid.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-grid.min.css">
<script>
function rental() {
  location.replace("jenismember.php")
}
function member() {
  location.replace("member.php")
}
function mobil() {
  location.replace("mobil.php")
}
function jenbi() {
  location.replace("jenismobil.php")
}
function trans() {
  location.replace("transaksi.php")

}
</script>
<style>
body {
  background-image: linear-gradient(to top, #fad0c4 0%, #ffd1ff 100%);
}
</style>
</head>
<body>
<h2>MENU</h2>
<h4> You can find what you want sir :)</h4>
<hr style="height:1px;border-width:0;color:gray;background-color:grey">
      <h2>⮟</h2>
  <td>
      <button type="submit" onclick="rental()" class="btn btn-info active"><font color='cyan' size='5'><b>Jenis member</b></button></font>
  </td>
        <h2>⮟</h2>
<td>
<button type="submit" onclick="member()" class="btn btn-info active"><font color='cyan' size='5'><b>Member</b></button></font>
</td>
<h2>⮟</h2>
<button type="submit"  onclick="jenbi()"class="btn btn-primary"><font color='cyan'size='5'><b>Jenis Mobil</b></button></font>
<h2>⮟</h2>
<button type="submit" onclick="mobil()" class="btn btn-primary"><font color='cyan' size='5'><b>MOBIL</b></button></font>
<h2>⮟</h2>
<button type="submit" onclick="trans()" class="btn btn-warning"><font color='purple' size='5'><b>Transaksi</b></button></font>
</body>
