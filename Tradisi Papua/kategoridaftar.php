<section class="pcoded-main-container">
	<div class="pcoded-content">
		<!-- [ breadcrumb ] start -->
		<div class="page-header">
			<div class="page-block">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="page-header-title">
							<h5 class="m-b-10">Daftar Kategori</h5>
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
							<li class="breadcrumb-item"><a href="#!">Daftar Kategori</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<a href="index.php?halaman=kategoritambah" class="btn btn-primary btn-md"><i class="fas fa-plus"></i> Tambah Kategori</a>
		<br><br>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h5>Daftar Kategori</h5>
					</div>
					<div class="card-body table-border-style">
						<div class="table-responsive">
							<table class="table table-hover" id="tabel">
								<thead>
									<tr>
										<th>No</th>
										<th>Kategori</th>
										<th>Foto</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $nomor = 1; ?>
									<?php $ambil = $koneksi->query("SELECT * FROM kategori"); ?>
									<?php while ($data = $ambil->fetch_assoc()) { ?>
										<tr>
											<td><?php echo $nomor ?></td>
											<td><?php echo $data["namakategori"] ?></td>
											<td>
												<img src="../foto/<?php echo $data['fotokategori'] ?>" width="100px">
											</td>
											<td>
												<a href="index.php?halaman=kategoriedit&id=<?php echo $data['idkategori']; ?>" class="btn btn-warning m-1" role="button" aria-pressed="true">Ubah</a>
												<a href="index.php?halaman=kategorihapus&id=<?php echo $data['idkategori']; ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')" class="btn btn-danger m-1" role="button" aria-pressed="true">Hapus</a>
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