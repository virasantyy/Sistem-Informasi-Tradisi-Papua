<section class="pcoded-main-container">
	<div class="pcoded-content">
		<!-- [ breadcrumb ] start -->
		<div class="page-header">
			<div class="page-block">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="page-header-title">
							<h5 class="m-b-10">Daftar Informasi</h5>
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
							<li class="breadcrumb-item"><a href="#!">Daftar Informasi</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<a href="index.php?halaman=informasitambah" class="btn btn-primary btn-md"><i class="fas fa-plus"></i> Tambah Informasi</a>
		<br><br>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h5>Daftar Informasi</h5>
					</div>
					<div class="card-body table-border-style">
						<div class="table-responsive">
							<table class="table table-hover" id="tabel">
								<thead>
									<tr>
										<th>No</th>
										<th>Judul</th>
										<th>Foto</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $nomor = 1; ?>
									<?php $ambil = $koneksi->query("SELECT*FROM informasi LEFT JOIN kategori ON informasi.idkategori=kategori.idkategori"); ?>
									<?php while ($data = $ambil->fetch_assoc()) {
										$ambilfoto = $koneksi->query("SELECT * FROM informasifoto WHERE idinformasi='$data[idinformasi]' limit 1");
										$foto = $ambilfoto->fetch_assoc();
									?>
										<tr>
											<td><?php echo $nomor; ?></td>
											<td><?php echo $data['judul'] ?></td>
											<!-- <td><?php echo $data['namakategori'] ?></td> -->
											<td>
												<img src="../foto/<?php echo $foto['fotoinformasi'] ?>" width="200px">
											</td>
											<td>
												<a href="index.php?halaman=informasiedit&id=<?php echo $data['idinformasi']; ?>" class="btn btn-warning m-1">Ubah</a>
												<a href="index.php?halaman=informasihapus&id=<?php echo $data['idinformasi']; ?>" class="btn btn-danger m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
											</td>
										</tr>
										<?php $nomor++; ?>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>