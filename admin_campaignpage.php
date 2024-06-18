<?php 
include 'layout/header.php';
include 'config/sessionstrict_admin.php';
include 'config/sessiontimeout.php';

$data_campaign = select("SELECT * FROM campaign");
$data_kategori = select("SELECT * FROM kategori");
$data_provinsi = select("SELECT * FROM provinsi");


// check if the dana_terkumpul_campaign exceeds the dana_target_campaign or if the current date exceeds the tanggal_tutup_campaign
// assuming you have a connection to your database
$conn = mysqli_connect('localhost', 'root', '', 'bantubangkit_db');
// check every row in the table and update the status_campaign based on the conditions
$query = "SELECT * FROM campaign";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $dana_terkumpul_campaign = $row['dana_terkumpul_campaign'];
    $dana_target_campaign = $row['dana_target_campaign'];
    $tanggal_tutup_campaign = $row['tanggal_tutup_campaign'];
    $current_date = date('Y-m-d');

    if ($dana_terkumpul_campaign >= $dana_target_campaign || $current_date > $tanggal_tutup_campaign) {
        // update the status_campaign to Tidak Berjalan
        $update_query = "UPDATE campaign SET status_campaign = 'Tidak Berjalan' WHERE id_campaign = '". $row['id_campaign']. "'";
        mysqli_query($conn, $update_query);
    }
}

mysqli_close($conn);





?>

<div class="navbar-dashboard">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">BantuBangkit</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_page.php">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="admin_userpage.php">User Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin_campaignpage.php">Campaign</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_kategoripage.php">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_pembayaranpage.php">Pembayaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_metodepembayaranpage.php">Metode Pembayaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_provinsipage.php">Provinsi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>


<div class="container mt-4">
    <h1 style="color: #FFF;">Campaign Information</h1>
    <hr style="color: #FFF;">

    <!-- Button triggeAr modal -->
    <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#addModal">
        Add
    </button>

    <!-- Add Campaign Modal -->
    <div style="z-index: 99999;" class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <!-- Modal content for adding campaign -->
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel" style="color: black;">Add Campaign</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding campaign -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="username" name="username" value="<?php echo $_SESSION['admin_name']; ?>">
                        <div class="mb-3">
                            <label for="nama_campaign" class="form-label" style="color: black;">Nama Campaign</label>
                            <input type="text" class="form-control" id="nama_campaign" name="nama_campaign" placeholder="Nama Campaign" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_campaign" class="form-label" style="color: black;">Deskripsi Campaign</label>
                            <textarea class="form-control" id="deskripsi_campaign" name="deskripsi_campaign" placeholder="Deskripsi" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label" style="color: black;">Kategori</label>
                            <select class="form-select" id="nama_kategori" name="nama_kategori" required>
                                <option value="" selected disabled>Select Kategori Campaign</option>
                                <?php foreach ($data_kategori as $kategori) : ?>
                                    <option value="<?= $kategori['nama_kategori']; ?>"><?= $kategori['nama_kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama_provinsi" class="form-label" style="color: black;">Provinsi</label>
                            <select class="form-select" id="nama_provinsi" name="nama_provinsi" required>
                                <option value="" selected disabled>Select Kategori Campaign</option>
                                <?php foreach ($data_provinsi as $provinsi) : ?>
                                    <option value="<?= $provinsi['nama_provinsi']; ?>"><?= $provinsi['nama_provinsi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="dana_target_campaign" class="form-label" style="color: black;">Dana Target Campaign</label>
                            <input type="text" class="form-control" id="dana_target_campaign" name="dana_target_campaign" placeholder="Dana Target Campaign" required>
                        </div>
                        <div class="mb-3">
                            <label for="dana_terkumpul_campaign" class="form-label" style="color: black;">Dana Terkumpul Campaign</label>
                            <input type="text" class="form-control" id="dana_terkumpul_campaign" name="dana_terkumpul_campaign" placeholder="Dana Terkumpul Campaign" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_buka_campaign" class="form-label" style="color: black;">Tanggal Buka Campaign</label>
                            <input type="date" class="form-control" id="tanggal_buka_campaign" name="tanggal_buka_campaign" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_tutup_campaign" class="form-label" style="color: black;">Tanggal Tutup Campaign</label>
                            <input type="date" class="form-control" id="tanggal_tutup_campaign" name="tanggal_tutup_campaign" required>
                        </div>
                        <div class="mb-3">
                            <label for="rekening_campaign" class="form-label" style="color: black;">Rekening Campaign</label>
                            <input type="text" class="form-control" id="rekening_campaign" name="rekening_campaign" placeholder="Rekening Campaign" required>
                        </div>
                        <div class="mb-3">
                            <label for="foto_campaign" class="form-label" style="color: black;">Foto Campaign</label>
                            <input type="file" class="form-control" id="foto_campaign" name="foto_campaign">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="addcampaign" name="addcampaign">Add Campaign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-dark table-striped" id="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Inisiator</th>
                <th>Kategori</th>
                <th>Provinsi</th>
                <th>Dana Target</th>    
                <th>Dana Terkumpul</th>
                <th>Tanggal Buka</th>
                <th>Tanggal Tutup</th>
                <th>Rekening</th>
                <th>Status</th>
                <th>Verifikasi</th>
                <th>Foto Campaign</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $id_campaign = 1; ?>
            <?php foreach ($data_campaign as $campaign) : ?>
                <tr>
                    <td><?= $id_campaign++; ?></td>
                    <td><?= $campaign['nama_campaign']; ?></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-secondary mb-1" data-bs-toggle="modal" data-bs-target="#viewModal1<?= $campaign['id_campaign'] ?>">
                            Deskripsi
                        </button>

                        <!-- View Modal -->
                        <div class="modal fade" style="z-index: 99999;" id="viewModal1<?= $campaign['id_campaign'] ?>" tabindex="-1" aria-labelledby="viewModalLabel<?= $campaign['id_campaign'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel<?= $campaign['id_campaign'] ?> " style="color:black; text-align: left;">Deskripsi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="color:black; text-align: left;">
                                        <p><?= $campaign['deskripsi_campaign']; ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </td>
                    <td><?= $campaign['username']; ?></td>
                    <td><?= $campaign['nama_kategori']; ?></td>
                    <td><?= $campaign['nama_provinsi']; ?></td>
                    <td>Rp<?= number_format($campaign['dana_target_campaign'],0,',','.'); ?></td>
                    <td>Rp<?= number_format($campaign['dana_terkumpul_campaign'],0,',','.'); ?></td>
                    <td><?= date('d-m-Y', strtotime($campaign['tanggal_buka_campaign'])); ?></td>
                    <td><?= date('d-m-Y', strtotime($campaign['tanggal_tutup_campaign'])); ?></td>
                    <td><?= $campaign['rekening_campaign']; ?></td>
                    <td><?= $campaign['status_campaign']; ?></td>
                    <td><?= $campaign['verifikasi_campaign']; ?></td>
                    <td><?= $campaign['foto_campaign']; ?></td>
                    <td width=20% class="text-center">
                        <!-- View Button -->
                        <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#viewModal<?= $campaign['id_campaign'] ?>">
                            View
                        </button>

                        <!-- View Modal -->
                        <div class="modal fade" style="z-index: 99999;" id="viewModal<?= $campaign['id_campaign'] ?>" tabindex="-1" aria-labelledby="viewModalLabel<?= $campaign['id_campaign'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel<?= $campaign['id_campaign'] ?> " style="color:black; text-align: left;">View Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="color:black; text-align: left;">
                                        <div class="foto_campaign">
                                            <img src="img/gambar_campaign/<?= $campaign['foto_campaign']; ?>" class="img-fluid" alt="<?= $campaign['nama_campaign']; ?>" style="border-radius: 1rem;">
                                        </div>
                                        <p class="mt-2" style="font-size: 1.8rem";><strong> <?= $campaign['nama_campaign'] ?></strong></p>
                                        <p><?= $campaign['deskripsi_campaign']; ?></p>
                                        <p><strong>Kategori: </strong> <?= $campaign['nama_kategori']; ?></p>
                                        <p><strong>Provinsi: </strong> <?= $campaign['nama_provinsi']; ?></p>
                                        <p><strong>Dana Target</strong> Rp<?= number_format($campaign['dana_target_campaign'],0,',','.'); ?></p>
                                        <p><strong>Dana Terkumpul:</strong> Rp<?= number_format($campaign['dana_terkumpul_campaign'],0,',','.'); ?></p>
                                        <p><strong>Tanggal Buka:</strong> <?= date('d-m-Y', strtotime($campaign['tanggal_buka_campaign'])); ?></p>
                                        <p><strong>Tanggal Tutup:</strong> <?= date('d-m-Y', strtotime($campaign['tanggal_tutup_campaign'])); ?></p>
                                        <p><strong>Status:</strong> <?= $campaign['status_campaign']; ?></p>
                                        <p><strong>Verifikasi:</strong> <?= $campaign['verifikasi_campaign']; ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Button -->
                        <button type="button" style="color: white;" class="btn btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $campaign['id_campaign']; ?>">
                            Edit
                        </button>

                        <!-- Edit Campaign Modal -->
                        <div class="modal fade" style="z-index: 99999;" id="editModal<?= $campaign['id_campaign']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $campaign['id_campaign']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel<?= $campaign['id_campaign']; ?>" style="color:black;">Edit Campaign</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" >
                                        <!-- Form for editing campaign -->
                                        <form action="" method="POST"  style="text-align: left;">
                                            <input type="hidden" name="id_campaign" value="<?= $campaign['id_campaign']; ?>">
                                            <div class="mb-3">
                                                <label for="nama_campaign" class="form-label" style="color: black;">Nama Campaign</label>
                                                <input type="text" class="form-control" id="nama_campaign" name="nama_campaign" value="<?= $campaign['nama_campaign']; ?>" disabled readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="deskripsi_campaign" class="form-label" style="color: black;">Deskripsi Campaign</label>
                                                <textarea class="form-control" id="deskripsi_campaign" name="deskripsi_campaign" disabled readonly><?= $campaign['deskripsi_campaign']; ?></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="nama_kategori" class="form-label" style="color: black;">Kategori</label>
                                                <select class="form-select" id="nama_kategori" name="nama_kategori" disabled readonly>
                                                    <option value="" selected disabled>Select Kategori Campaign</option>
                                                    <?php foreach ($data_kategori as $kategori) : ?>
                                                        <option value="<?= $kategori['nama_kategori']; ?>" <?= ($kategori['nama_kategori'] == $campaign['nama_kategori']) ? 'selected' : ''; ?>>
                                                            <?= $kategori['nama_kategori']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="nama_provinsi" class="form-label" style="color: black;">Provinsi</label>
                                                <select class="form-select" id="nama_provinsi" name="nama_provinsi" disabled readonly>
                                                    <option value="" selected disabled>Select Provinsi Campaign</option>
                                                    <?php foreach ($data_provinsi as $provinsi) : ?>
                                                        <option value="<?= $provinsi['nama_provinsi']; ?>" <?= ($provinsi['nama_provinsi'] == $campaign['nama_provinsi']) ? 'selected' : ''; ?>>
                                                            <?= $provinsi['nama_provinsi']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="dana_target_campaign" class="form-label" style="color: black;">Dana Target Campaign</label>
                                                <input type="text" class="form-control" id="dana_target_campaign" name="dana_target_campaign" value="<?= $campaign['dana_target_campaign']; ?>" disabled readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="dana_terkumpul_campaign" class="form-label" style="color: black;">Dana Terkumpul Campaign</label>
                                                <input type="text" class="form-control" id="dana_terkumpul_campaign" name="dana_terkumpul_campaign" value="<?= $campaign['dana_terkumpul_campaign']; ?>" disabled readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_buka_campaign" class="form-label" style="color: black;">Tanggal Buka Campaign</label>
                                                <input type="date" class="form-control" id="tanggal_buka_campaign" name="tanggal_buka_campaign" value="<?= $campaign['tanggal_buka_campaign']; ?>" disabled readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_tutup_campaign" class="form-label" style="color: black;">Tanggal Tutup Campaign</label>
                                                <input type="date" class="form-control" id="tanggal_tutup_campaign" name="tanggal_tutup_campaign" value="<?= $campaign['tanggal_tutup_campaign']; ?>" disabled readonly>
            
                                            </div>
                                            <div class="mb-3">
                                                <label for="rekening_campaign" class="form-label" style="color: black;">Rekening Campaign</label>
                                                <input type="text" class="form-control" id="rekening_campaign" name="rekening_campaign" value="<?= $campaign['rekening_campaign']; ?>" disabled readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status_campaign" class="form-label" style="color: black;">Status Campaign</label>
                                                <select class="form-select" id="status_campaign" name="status_campaign">
                                                    <option value="Berjalan" <?= ($campaign['status_campaign'] == 'Berjalan') ? 'selected' : ''; ?>>Berjalan</option>
                                                    <option value="Tidak Berjalan" <?= ($campaign['status_campaign'] == 'Tidak Berjalan') ? 'selected' : ''; ?>>Tidak Berjalan</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="verifikasi_campaign" class="form-label" style="color: black;">Verifikasi Campaign</label>
                                                <select class="form-select" id="verifikasi_campaign" name="verifikasi_campaign">
                                                    <option value="Verified" <?= ($campaign['verifikasi_campaign'] == 'Verified') ? 'selected' : ''; ?>>Verified</option>
                                                    <option value="Not Verified" <?= ($campaign['verifikasi_campaign'] == 'Not Verified') ? 'selected' : ''; ?>>Not Verified</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" style="color: white;" class="btn btn-warning" name="updatecampaign">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $campaign['id_campaign']; ?>">
                            Soft Delete
                        </button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal<?= $campaign['id_campaign']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $campaign['id_campaign']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel<?= $campaign['id_campaign']; ?>" style="color: black;">Delete Campaign</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="color: black;">
                                        <p style="text-align: left;">Are you sure you want to delete the campaign "<?= $campaign['nama_campaign']; ?>"?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="" method="POST">
                                            <!-- Hidden input to store the campaign ID -->
                                            <input type="hidden" name="campaign_id" value="<?= $campaign['id_campaign']; ?>">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <!-- Change the button type to submit the form -->
                                            <button type="submit" class="btn btn-danger" name="deletecampaign">Delete</button>
                                        </form>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <!-- End Delete Modal -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'layout/footer.php';?>
