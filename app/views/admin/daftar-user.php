<h3 class="mb-3 text-center">Form Tambah User</h3>
<div class="card shadow">
    <div class="card-body">
        <form action="<?= BASEURL ?>/admin/tambah-barang" method="post">
            <div class="row">
                <div class="col-sm-6">

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" name="username" id="username" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="text" name="password" id="password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input class="form-control" type="text" name="role" id="role" required>
                    </div>
                    
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input class="form-control" type="text" name="nama" id="nama" required>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit" name="submit">Tambah User</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </form>
        




        <hr>
        <h3>Data User</h3>
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

        <table id="tbl-daftar-user" class="table dt-responsive nowrap" style="width: 100%;">
            <thead class="thead-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data['users'] != []) : ?>
                    <?php $i = 1; ?>
                    <?php foreach ($data['users'] as $brg) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $brg['username'] ?></td>
                            <td><?= $brg['password'] ?></td>
                            <td><?= $brg['role'] ?></td>
                            <td><?= $brg['nama'] ?></td>
                            <td class="text-center">
                                <a class="badge badge-info" href="<?= BASEURL ?>/admin/detail-barang/<?= $brg['id'] ?>">Detail ></a>
                                <a class="badge badge-warning" href="<?= BASEURL ?>/admin/ubah-barang/<?= $brg['id'] ?>">Ubah</a>
                                <a class="badge badge-danger" href="<?= BASEURL ?>/admin/hapus-barang/<?= $brg['id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5"><strong>Tidak ada data user</strong></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>