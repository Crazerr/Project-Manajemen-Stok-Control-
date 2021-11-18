<?php

session_start();

//membuat koneksi ke database
$conn = mysqli_connect("localhost","root","","stockbarang");

//menambah barang baru
if(isset($_POST['tambahbarang'])){
	$namabarang = $_POST['nama'];
	$deskripsi = $_POST['deskripsi'];
	$hargabarang = $_POST['harga'];
	$jumlahbarang = $_POST['jumlah'];
	
	$addtotable = mysqli_query($conn, "insert into barang (namabarang, deskripsi, harga, jumlah) values('$namabarang','$deskripsi','$hargabarang','$jumlahbarang')");
	if($addtotable){
		header('location:index.php');
	}else{
		echo 'Gagal';
		header('location:index.php');
	}
}

//menambah barang masuk
if(isset($_POST['tambahbarangmasuk'])){
	$barangnya = $_POST['barangnya'];
	$keterangan = $_POST['iduser'];
	$jumlah = $_POST['jumlahmasuk'];
	
	$cekstocksekarang = mysqli_query($conn, "select * from barang where idbarang='$barangnya'");
	$ambildatanya = mysqli_fetch_array($cekstocksekarang);
	
	$cekstocksekarang = $ambildatanya['jumlah'];
	$tambahstock = $cekstocksekarang+$jumlah;
	
	$addtomasuk = mysqli_query($conn, "insert into masuk (idbarang,keterangan,jumlahmasuk) values('$barangnya','$keterangan','$jumlah')");
	
	$updatestokmasuk = mysqli_query($conn, "update barang set jumlah='$tambahstock = $cekstocksekarang+$jumlah'
	where idbarang='$barangnya'");
	if($addtomasuk && $updatestokmasuk){
		header('location:masuk.php');
	}else{
		echo 'Gagal';
		header('location:masuk.php');
	}
}


//menambah barang keluar
if(isset($_POST['barangkeluar'])){
	$barangnya = $_POST['barangnya'];
	$penerima = $_POST['penerima'];
	$jumlah = $_POST['jumlahkeluar'];
	
	$cekstocksekarang = mysqli_query($conn, "select * from barang where idbarang='$barangnya'");
	$ambildatanya = mysqli_fetch_array($cekstocksekarang);
	
	$cekstocksekarang = $ambildatanya['jumlah'];
	
	if($cekstocksekarang >= $jumlah){
		//kalau barangnya cukup
		$tambahstock = $cekstocksekarang-$jumlah;

		$addtomasuk = mysqli_query($conn, "insert into keluar (idbarang,penerima,jumlahkeluar) values('$barangnya','$penerima','$jumlah')");

		$updatestokmasuk = mysqli_query($conn, "update barang set jumlah='$tambahstock = $cekstocksekarang-$jumlah'
		where idbarang='$barangnya'");
		if($addtomasuk && $updatestokmasuk){
			header('location:keluar.php');
		}else{
			echo 'Gagal';
			header('location:keluar.php');
		}
	}else{
		//kalau barangnya gak cukup
		echo '
		<script>
			alert("Stock saat ini tidak mencukupi");
			window.location.href="keluar.php";
		</script>
		';
	}
}

//update info barang
if(isset($_POST['updatebarang'])){
	$idb = $_POST['idb'];
	$namabarang = $_POST['nama'];
	$deskripsi = $_POST['deskripsi'];
	$hargabarang = $_POST['harga'];
	
	$update = mysqli_query($conn, "update barang set namabarang ='$namabarang', deskripsi ='$deskripsi', harga ='$hargabarang' where idbarang = '$idb'");
	if($update){
		header('location:index.php');
	}else{
		echo 'Gagal';
		header('location:index.php');
	}
	
}

//hapus barang
if(isset($_POST['hapusbarang'])){
	$idb = $_POST['idb'];

	$hapus=mysqli_query($conn, "delete from barang where idbarang='$idb'");
	if($hapus){
		header('location:index.php');
	}else{
		echo 'Gagal';
		header('location:index.php');
	}
}

//mengedit data barang masuk
if(isset($_POST['updatebarangmasuk'])){
	$idb = $_POST['idb'];
	$idm = $_POST['idm'];
	$keterangan = $_POST['iduser'];
	$jumlah = $_POST['jumlahmasuk'];
	
	$lihatstock = mysqli_query($conn, "select * from barang where idbarang='$idb'");
	$stocknya = mysqli_fetch_array($lihatstock);
	$stockskrg = $stocknya['jumlah'];
	
	$jumlahskrg = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
	$jumlahnya = mysqli_fetch_array($jumlahskrg);
	$jumlahskrg = $jumlahnya['jumlahmasuk'];
	
	if($jumlah>$jumlahskrg){
		$selisih = $jumlah-$jumlahskrg;
		$kurangi = $selisih+$stockskrg;
		$kurangistocknya = mysqli_query($conn,"update barang set jumlah = '$kurangi' where idbarang='$idb'");
		$updatenya = mysqli_query($conn,"update masuk set jumlahmasuk = '$jumlah',keterangan ='$keterangan' where idmasuk = '$idm'");
	
	if($kurangistocknya&&$updatenya){
		header('location:masuk.php');
	}else{
		echo 'Gagal';
		header('location:masuk.php');
	}
		
	}else{
		$selisih = $jumlahskrg-$jumlah;
		$kurangi = $stockskrg-$selisih;
		$kurangistocknya = mysqli_query($conn,"update barang set jumlah = '$kurangi'where idbarang='$idb'");
		$updatenya = mysqli_query($conn,"update masuk set jumlahmasuk = '$jumlah',keterangan ='$keterangan' where idmasuk = '$idm'");
	
	if($kurangistocknya&&$updatenya){
		header('location:masuk.php');
	}else{
		echo 'Gagal';
		header('location:masuk.php');
	}
}
}

//menghapus barang masuk

if(isset($_POST['hapusbarangmasuk'])){
	$idb = $_POST['idb'];
	$jumlah = $_POST['kty'];
	$idm = $_POST['idm'];
	
	$getdatastock = mysqli_query($conn, "select * from barang where idbarang='$idb'");
	$data = mysqli_fetch_array($getdatastock);
	$stok = $data["jumlah"];
	
	$selisih = $stok-$jumlah;
	
	$update = mysqli_query($conn, "update barang set jumlah = '$selisih' where idbarang= '$idb'");
	$hapusdata = mysqli_query($conn, "delete from masuk where idmasuk= '$idm'");
	
	if($update&&$hapusdata){
		header('location:masuk.php');
	}else{
		echo 'Gagal';
		header('location:masuk.php');
	}
	}

//mengedit data barang keluar
if(isset($_POST['updatebarangkeluar'])){
	$idb = $_POST['idb'];
	$idk = $_POST['idk'];
	$penerima = $_POST['penerima'];
	$jumlah = $_POST['jumlahkeluar'];
	
	$lihatstock = mysqli_query($conn, "select * from barang where idbarang='$idb'");
	$stocknya = mysqli_fetch_array($lihatstock);
	$stockskrg = $stocknya['jumlah'];
	
	$jumlahskrg = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
	$jumlahnya = mysqli_fetch_array($jumlahskrg);
	$jumlahskrg = $jumlahnya['jumlahkeluar'];
	
	if($jumlah>$jumlahskrg){
		$selisih = $jumlah-$jumlahskrg;
		$kurangi = $stockskrg-$selisih;
		$kurangistocknya = mysqli_query($conn,"update barang set jumlah = '$kurangi' where idbarang='$idb'");
		$updatenya = mysqli_query($conn,"update keluar set jumlahkeluar = '$jumlah',penerima ='$penerima' where idkeluar = '$idk'");
	
	if($kurangistocknya&&$updatenya){
		header('location:keluar.php');
	}else{
		echo 'Gagal';
		header('location:keluar.php');
	}
		
	}else{
		$selisih = $jumlahskrg-$jumlah;
		$kurangi = $stockskrg+$selisih;
		$kurangistocknya = mysqli_query($conn,"update barang set jumlah = '$kurangi'where idbarang='$idb'");
		$updatenya = mysqli_query($conn,"update keluar set jumlahkeluar = '$jumlah',penerima ='$penerima' where idkeluar = '$idk'");
	
	if($kurangistocknya&&$updatenya){
		header('location:keluar.php');
	}else{
		echo 'Gagal';
		header('location:keluar.php');
	}
}
}

//menghapus barang keluar

if(isset($_POST['hapusbarangkeluar'])){
	$idb = $_POST['idb'];
	$idk = $_POST['idk'];
	$penerima = $_POST['penerima'];
	$jumlah = $_POST['kty'];
	
	
	$getdatastock = mysqli_query($conn, "select * from barang where idbarang='$idb'");
	$data = mysqli_fetch_array($getdatastock);
	$stok = $data["jumlah"];
	
	$selisih = $stok-$jumlah;
	
	$update = mysqli_query($conn, "update barang set jumlah = '$selisih' where idbarang= '$idb'");
	$hapusdata = mysqli_query($conn, "delete from keluar where idkeluar= '$idk'");
	
	if($update&&$hapusdata){
		header('location:keluar.php');
	}else{
		echo 'Gagal';
		header('location:keluar.php');
	}
}

//menambah admin baru
if(isset($_POST['adusername'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$queryinsert = mysqli_query($conn, "insert into login (username, password) values('$username','$password')");
	
	if($queryinsert){
		header('location:admin.php');
	}else{
		header('location:admin.php');
	}
	
}
//edit admin
if(isset($_POST['updateadmin'])){
	$usernamebaru = $_POST['usernameadmin'];
	$passwordbaru = $_POST['passwordbaru'];
	$idnya = $_POST['id'];
	
	$queryupdate = mysqli_query($conn, "update login set username='$usernamebaru', password='$passwordbaru' where iduser='$idnya'");
	
	if($queryupdate){
		header('location:admin.php');
	}else{
		header('location:admin.php');
	}
	
}

//Hapus admin
if(isset($_POST['hapusadmin'])){
	$id = $_POST['id'];
	
	$querydelete = mysqli_query($conn, "delete from login where iduser='$id'");
	
	if($querydelete){
		header('location:admin.php');
	}else{
		header('location:admin.php');
	}
	
}

?>
