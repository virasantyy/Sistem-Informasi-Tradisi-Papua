<section class="pcoded-main-container">
    <div class="pcoded-content">

        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Daftar Posting</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Daftar Posting</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Daftar Posting</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover" id="tabel">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Caption</th>
                                        <th>Tanggal</th>
                                        <th>Foto</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $result = $koneksi->query("SELECT * FROM posting left join informasi on posting.idinformasi = informasi.idinformasi left join pengguna on posting.idpengguna = pengguna.id order by idposting desc");
                                    while ($data = $result->fetch_array()) :
                                        $ambilfoto = $koneksi->query("SELECT * FROM postingfoto WHERE idposting='$data[idposting]' limit 1");
                                        $foto = $ambilfoto->fetch_assoc();
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data['caption'] ?></td>
                                            <td><?= tanggal(date("Y-m-d", strtotime($data['waktu']))) . ' ' . date("H:i", strtotime($data['waktu'])); ?> W.I.B</td>
                                            <td>
                                                <?php
                                                $path = '../foto/' . $foto['fotoposting'];
                                                $extension = pathinfo($path, PATHINFO_EXTENSION);
                                                ?>
                                                <?php if ($extension == 'mp4') { ?>
                                                    <video width="100%" controls>
                                                        <source src="<?php echo '../foto/' . $foto['fotoposting']; ?>" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                <?php } else { ?>
                                                    <img src="../foto/<?= $foto['fotoposting'] ?>" style="border-radius:10px;width:250px;height:150px;object-fit:cover; !important" alt="">
                                                <?php } ?>
                                            </td>
                                            <td><?= $data['status'] ?></td>
                                            <td>
                                                <a class="btn btn-primary" href="index.php?halaman=postingverifikasi&id=<?php echo $data['idposting']; ?>">Verifikasi</a>
                                                <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" href="index.php?halaman=postinghapus&id=<?php echo $data['idposting']; ?>">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>