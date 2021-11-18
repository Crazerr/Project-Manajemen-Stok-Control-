<?php
require "function.php";
require "cek.php";

//dapetin id barang dari halaman sebelumnya
$idbarang = $_GET['id']; //get id barang

//get informasi barang
$get = mysqli_query($conn, "select * from barang where idbarang='$idbarang'");
$fetch = mysqli_fetch_array($get);

//set variabel
$namabarang = $fetch['namabarang'];
$deskripsi = $fetch['deskripsi'];
$stock = $fetch['jumlah'];
$harga = $fetch['harga'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Stock Kontrol-Crazer</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Crash Crazer</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stock Barang
                            </a>
							<a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Masuk
                            </a>
							<a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Keluar	
                            </a>
								<a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Kelola Admin	
                            </a>
					
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Stock Kontrol</div>
                        Crash Crazer
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <center><h1 class="mt-4">DETAIL BARANG</h1></center>
						
                        <div class="card mb-4">
                            <div class="card-header">
								 <?=$namabarang;?>
                            </div>
                            <div class="card-body">
								
								<div class="row">
									<div class="col-md-3">Deskripsi</div>
									<div class="col-md-9">: <?=$deskripsi;?></div>	
								</div>
								<div class="row">
									<div class="col-md-3">Harga</div>
									<div class="col-md-9">: <?=$harga;?></div>	
								</div>
								<div class="row">
									<div class="col-md-3">Jumlah</div>
									<div class="col-md-9">: <?=$stock;?></div>	
								</div>
								
								<br><br><hr>

								
								<h3>Barang Masuk</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="barangmasuk" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Admin Penerima</th>
                                                <th>Jumlah Barang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											
											<?php
											$ambildatamasuk = mysqli_query($conn,  "SELECT barang.harga as harga, barang.deskripsi as deskripsi, masuk.idbarang as idbarang, masuk.idmasuk as idmasuk, masuk.tanggal as tanggal, masuk.jumlahmasuk as jumlahmasuk, login.username as keterangan FROM masuk LEFT JOIN barang ON masuk.idbarang = barang.idbarang LEFT JOIN login ON login.iduser = masuk.keterangan where masuk.idbarang='$idbarang'");
											$i=1;
											while($fetch=mysqli_fetch_array($ambildatamasuk)){
												$idbarang = $fetch['idbarang'];
												$idmasuk = $fetch['idmasuk'];
												$tanggal = $fetch['tanggal'];
												$keterangan = $fetch['keterangan'];
												$quantity = $fetch['jumlahmasuk'];
											?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$tanggal;?></td>
												<td><?=$keterangan;?></td>
                                                <td><?=$quantity;?></td>
												
                                            </tr>
											
											<?php
											};
											
											?>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
							
							<br><br>
							
							<div class="col mr-5">
							<h3>Barang Keluar</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="barangkeluar" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Penerima</th>
                                                <th>Jumlah Barang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											
											<?php
											$ambildatakeluar =mysqli_query($conn, "SELECT barang.harga as harga, barang.deskripsi as deskripsi, keluar.idbarang as idbarang, keluar.idkeluar as idkeluar, keluar.tanggal as tanggal, keluar.jumlahkeluar as jumlahkeluar, keluar.penerima as penerima from keluar LEFT JOIN barang ON keluar.idbarang = barang.idbarang where keluar.idbarang='$idbarang' ORDER BY tanggal");
											$i=1;
											while($fetch=mysqli_fetch_array($ambildatakeluar)){
                                                $idbarang = $fetch['idbarang'];
                                                $idkeluar= $fetch['idkeluar'];
												$tanggal = $fetch['tanggal'];
												$penerima = $fetch['penerima'];
												$quantity = $fetch['jumlahkeluar'];
											?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$tanggal;?></td>
												<td><?=$penerima;?></td>
                                                <td><?=$quantity;?></td>
												
                                            </tr>
											
											<?php
											};
											
											?>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
							</div>
                        </div>
                    </div>
                </main>
			</div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
