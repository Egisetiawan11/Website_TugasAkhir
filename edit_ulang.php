<?php
include 'koneksi.php';

$no = $_GET['no'];

$q = mysqli_query($conn,"SELECT * FROM ulang WHERE no_daftar='$no'");
$d = mysqli_fetch_array($q);
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Daftar Ulang</title>
<style>
body{font-family:Times New Roman;font-size:14px}
label{display:inline-block;width:180px}
input,select{margin-bottom:5px}
</style>
</head>
<body>

<h4>Edit Daftar Ulang</h4>

<form method="post">
<label>No. Daftar</label>
<input value="<?= $d['no_daftar'] ?>" readonly><br>

<label>Nama Pemohon</label>
<input value="<?= $d['nama'] ?>" readonly><br>

<label>Hari Harus Datang</label>
<input name="hari_harus_datang" value="<?= $d['hari_harus_datang'] ?>"><br>

<label>Tgl Harus Datang</label>
<input type="date" name="tgl_harus_datang" value="<?= $d['tgl_harus_datang'] ?>"><br>

<label>Hari Datang</label>
<input name="hari_datang" value="<?= $d['hari_datang'] ?>"><br>

<label>Tgl Datang</label>
<input type="date" name="tgl_datang" value="<?= $d['tgl_datang'] ?>"><br>

<label>Berkas</label>
<input type="checkbox" name="ktp" <?= $d['ktp']=='Ada'?'checked':'' ?>>KTP
<input type="checkbox" name="kk" <?= $d['kk']=='Ada'?'checked':'' ?>>KK
<input type="checkbox" name="ijazah" <?= $d['ijazah']=='Ada'?'checked':'' ?>>Ijazah<br>

<label>Keperluan</label>
<input name="keperluan" value="<?= $d['keperluan'] ?>"><br><br>

<button name="update">Update</button>
</form>

<?php
if(isset($_POST['update'])){
    $ktp = isset($_POST['ktp']) ? 'Ada' : 'Tidak';
    $kk  = isset($_POST['kk']) ? 'Ada' : 'Tidak';
    $ij  = isset($_POST['ijazah']) ? 'Ada' : 'Tidak';

    // logika keterangan
    if($ktp=='Ada' && $kk=='Ada' && $ij=='Ada'){
        $ket = 'OK';
    }else{
        $ket = 'Tidak';
    }

    mysqli_query($conn,"UPDATE ulang SET
        hari_harus_datang='$_POST[hari_harus_datang]',
        tgl_harus_datang='$_POST[tgl_harus_datang]',
        hari_datang='$_POST[hari_datang]',
        tgl_datang='$_POST[tgl_datang]',
        ktp='$ktp',
        kk='$kk',
        ijazah='$ij',
        keperluan='$_POST[keperluan]',
        keterangan='$ket'
        WHERE no_daftar='$no'
    ");

    header("Location: daftar_ulang.php");
}
?>

</body>
</html>
