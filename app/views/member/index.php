<h3>Dashboard Member</h3>
<hr>

<div class="card shadow">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-lg-12">
                <h5 class="mb-0">Selamat datang, <?= $data['nama'] ?>!</h5>
                <p class="mt-4"></p>
                <h3 class="mt-3">Data Barang</h3>
                <?php if (Flasher::check()) : ?>
                    <?php $flash = Flasher::flash() ?>
                    <div class="alert alert-<?= $flash['tipe'] ?> alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <?= $flash['pesan'] ?>
                    </div>
                <?php endif; ?>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Tipe Barang</th>
                            <th>Jumlah Stok</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($data['data_barang'] != []) : ?>
                            <?php $i = 1; ?>
                            <?php foreach ($data['data_barang'] as $brg) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $brg['kode_barang'] ?></td>
                                    <td><?= $brg['nama_barang'] ?></td>
                                    <td><?= $brg['tipe_barang'] ?></td>
                                    <td><?= $brg['jmlh_stok'] ?></td>
                                    <td><?= $brg['lokasi'] ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5"><strong>Tidak ada data barang</strong></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <hr>
                <h5 class="mt-3">Daftar pinjaman terakhir</h5>
                <p>Jangan lupa untuk mengembalikan buku pinjaman ya!</p>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pinjam</th>
                            <th>Lama Pinjam</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($data['pinjaman'] as $p) : ?>
                            <?php
                            $tgl_skrg = date('Y-m-d');
                            $datediff = strtotime($tgl_skrg) - strtotime($p['tanggal_pinjam']);
                            $bedahari = abs(round($datediff / (60 * 60 * 24)));

                            if ($bedahari > $p['lama_pinjam'] && $p['tanggal_kembali'] == NULL) : ?>
                                <tr class="bg-warning">
                                    <td><?= $i++ ?></td>
                                    <td><?= date('d M Y', strtotime($p['tanggal_pinjam'])) ?></td>
                                    <td><?= $p['lama_pinjam'] ?> Hari</td>
                                    <?php if ($p['tanggal_kembali'] == NULL) : ?>
                                        <td class="text-danger">Belum Dikembalikan</td>
                                    <?php else : ?>
                                        <td class="text-success">Sudah Dikembalikan</td>
                                    <?php endif ?>
                                </tr>
                            <?php else : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= date('d M Y', strtotime($p['tanggal_pinjam'])) ?></td>
                                    <td><?= $p['lama_pinjam'] ?> Hari</td>
                                    <?php if ($p['tanggal_kembali'] == NULL) : ?>
                                        <td class="text-danger">Belum Dikembalikan</td>
                                    <?php else : ?>
                                        <td class="text-success">Sudah Dikembalikan</td>
                                    <?php endif ?>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>