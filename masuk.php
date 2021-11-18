<?php
require "function.php";
require "cek.php";
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
                    <div class="input-group-append">
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
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
                        <center><h1 class="mt-4">STOCK BARANG MASUK</h1></center>
						
                        <ol class="breadcrumb mb-4">
                                Data Table Stock Barang Masuk
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
								 <div><!-- Button to Open the Modal -->
								  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
									Tambah Barang Masuk
								</button>
									 	<br>
								<div class="row mt-4">
								<div class="col">
									 	<form method="post" class="form-inline">
									 	<input type="date" name="tgl_mulai" class="form-control">
									 	<input type="date" name="tgl_selesai" class="form-control ml-3">
										<button type="submit" name="filter_tgl" class="btn btn-info ml-3">Urut Tanggal</button>
									 </form>
									</div>
								</div>
								</div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Tanggal</th>
                                                <th>Admin Penerima</th>
                                                <th>Jumlah Barang</th>
												<th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
											if(isset($_POST['filter_tgl'])){
												$mulai = $_POST['tgl_mulai'];
												$selesai = $_POST['tgl_selesai'];
												
												if($mulai!=null || $selesai=null){
													$ambilsemuadata = mysqli_query($conn, "select * from masuk m, barang b where b.idbarang = m.idbarang and tanggal BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY)");
												}else{
													$ambilsemuadata = mysqli_query($conn, "select * from masuk m, barang b where b.idbarang = m.idbarang");
												}
												
											} else{
												$ambilsemuadata = mysqli_query($conn, "SELECT masuk.idmasuk as idmasuk, masuk.idbarang as idbarang, masuk.tanggal as tanggal, masuk.jumlahmasuk as jumlahmasuk, masuk.keterangan as keterangan, barang.namabarang as namabarang, barang.deskripsi as deskripsi, login.username as keterangan FROM masuk JOIN barang ON masuk.idbarang = barang.idbarang JOIN login ON login.iduser = masuk.keterangan");
											}
											$i = 1;
											while($data=mysqli_fetch_array($ambilsemuadata)){
												$idm = $data['idmasuk'];
												$idb = $data['idbarang'];
												$namabarang = $data['namabarang'];
												$tanggal = $data['tanggal'];
												$keterangan = $data['keterangan'];
												$jumlah = $data['jumlahmasuk'];
											?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$namabarang;?></td>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$keterangan;?></td>
                                                <td><?=$jumlah;?></td>
											<td>
												<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idm;?>">
													Edit
												</button>
												<input type="hidden" name="idbaranghapus" value="<?=$idb;?>">
												<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?=$idm;?>">
													Hapus
												</button>
											</td>
                                            </tr>
											
											<!-- Edit Modal -->
											<div class="modal fade" id="edit<?=$idm;?>">
												<div class="modal-dialog">
												<div class="modal-content">

													<!-- Modal Header -->
													<div class="modal-header">
													  <center><h4 class="modal-title">Edit Barang</h4></center>
													  <button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>

													<!-- Modal body -->
													<form method="post">
													<div class="modal-body">
														<select class="custom-select" name="iduser" required>
													 <option>Pilih Penerima Barang Masuk</option>
													   <?php
													   		$queryid = mysqli_query($conn, "select * from login");
															while ($iduser = mysqli_fetch_array($queryid)) {
													   ?>
															<option value="<?php echo $iduser['iduser']; ?>"><?php echo substr($iduser['iduser'], -3) . ". " . $iduser['username']; ?></option>
															<br>
													   <?php

													}
													?>
													</select>
														<br>
														<br>
														<input type="number", name="jumlahmasuk" value="<?=$jumlah;?>" class="form-control" required>
														<input type="hidden" name="idb" value="<?=$idb;?>">
														<input type="hidden" name="idm" value="<?=$idm;?>">
														</br>
														<button type="submit" class="btn btn-primary" name="updatebarangmasuk">Edit</button>
													</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								
												<!-- Hapus Modal -->
											<div class="modal fade" id="hapus<?=$idm;?>">
												<div class="modal-dialog">
												<div class="modal-content">

													<!-- Modal Header -->
													<div class="modal-header">
													  <center><h4 class="modal-title">Hapus Barang</h4></center>
													  <button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>

													<!-- Modal body -->
													<form method="post">
													<div class="modal-body">
														Apakah anda yakin ingin menghapus <?=$namabarang;?>?
														<input type="hidden" name="idb" value="<?=$idb;?>">
														<input type="hidden" name="kty" value="<?=$jumlah;?>">
														<input type="hidden" name="idm" value="<?=$idm;?>">
														</br>
														</br>
														<button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Hapus</button>
													</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								
												<!-- Hapus Modal -->
											<div class="modal fade" id="hapus<?=$idm;?>">
												<div class="modal-dialog">
												<div class="modal-content">

													<!-- Modal Header -->
													<div class="modal-header">
													  <center><h4 class="modal-title">Hapus Barang</h4></center>
													  <button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>

													<!-- Modal body -->
													<form method="post">
													<div class="modal-body">
														Apakah anda yakin ingin menghapus <?=$namabarang;?>?
														<input type="hidden" name="idb" value="<?=$idb;?>">
														<input type="hidden" name="kty" value="<?=$jumlah;?>">
														<input type="hidden" name="idm" value="<?=$idm;?>">
														</br>
														</br>
														<button type="submit" class="btn btn-danger" name="hapusbarangkeluar">Hapus</button>
													</div>
													</form>
												</div>
											</div>
										</div>
									</div>
											
											<?php
											};
											
											?>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
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
	<!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <center><h4 class="modal-title">Barang Masuk</h4></center>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
		<form method="post">
        <div class="modal-body">
          				
          	<select name="barangnya" class="form-control">
				<?php
					$ambilsemuadata = mysqli_query($conn, "select * from barang");
					while ($fetcharray = mysqli_fetch_array($ambilsemuadata)){
						$namabarangnya = $fetcharray['namabarang'];
						$idbarangnya = $fetcharray['idbarang'];
				?>	
				
				<option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>
				
				<?php
					}
				?>
			</select>
			
			</br>
			<select class="custom-select" name="iduser" required>
			   <option>Pilih Penerima Barang Masuk</option>
			   <?php
			   $queryid = mysqli_query($conn, "select * from login");
			   while ($iduser = mysqli_fetch_array($queryid)) {
			   ?>
			   <option value="<?php echo $iduser['iduser']; ?>"><?php echo substr($iduser['iduser'], -3).". ".$iduser['username']; ?></option>
				<br>
			   <?php
				   
            }
            ?>
			</select>
			<br>
			</br>
				<input type="number", name="jumlahmasuk" placeholder="Jumlah Barang" class="form-control" required>
			</br>
         </select>
			<br>
			<br>
			<button type="submit" class="btn btn-primary" name="tambahbarangmasuk">Submit</button>
        </div>
        </form>
	</div>
</div>	
</html>
