<?php
// Include header and any necessary functions
include 'layout/header.php';
include 'config/sessionstrict_admin.php';
include 'config/sessiontimeout.php';



// Retrieve payment data from the database
$data_pembayaran = select("SELECT * FROM pembayaran");
$data_campaign = select("SELECT * FROM campaign");
// assume $id_campaign is already defined

if (isset($_POST['updatex'])) {
    if (update_pembayaran($_POST) > 0) {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Data Campaign Berhasil Diupdate'
        });
        </script>";
        $id_campaign = $_POST['id_campaign'];

        // get nama_campaign from campaign table
        $query = "SELECT nama_campaign FROM campaign WHERE id_campaign = '$id_campaign'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $nama_campaign = $row['nama_campaign'];

        // get total nominal_pembayaran from pembayaran table where nama_campaign matches
        $query = "SELECT SUM(nominal_pembayaran) AS total_pembayaran FROM pembayaran WHERE nama_campaign = '$nama_campaign'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $total_pembayaran = $row['total_pembayaran'];

        // update dana_terkumpul_campaign in campaign table
        $query_update = "UPDATE campaign SET dana_terkumpul_campaign = dana_terkumpul_campaign + $total_pembayaran WHERE id_campaign = '$id_campaign'";
        mysqli_query($conn, $query_update);

    }
    
} 

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
                        <a class="nav-link" href="admin_campaignpage.php">Campaign</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_kategoripage.php">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin_pembayaranpage.php">Pembayaran</a>
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
    <h1 style="color: #FFF;">Pembayaran Information</h1>
    <hr style="color: #FFF;">

    <table class="table table-bordered table-dark table-striped" id="table">
        <thead>
            <tr>
                <th>ID Pembayaran</th>
                <th>ID Campaign</th>
                <th>Nama Campaign</th>
                <th>Donatur</th>
                <th>Tanggal Pembayaran</th>
                <th>Nominal Pembayaran</th>
                <th>Status Pembayaran</th>    
                <th>Pesan Pembayaran</th>
                <th>Metode Pembayaran</th>
                <th>Bukti Pembayaran</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_pembayaran as $pembayaran) : ?>
                <tr>
                    <td><?= $pembayaran['id_pembayaran']; ?></td>
                    <td><?= $pembayaran['id_campaign']; ?></td>
                    <td><?= $pembayaran['nama_campaign']; ?></td>
                    <td><?= $pembayaran['name']; ?></td>
                    <td><?= $pembayaran['tanggal_pembayaran']; ?></td>
                    <td>Rp<?= number_format($pembayaran['nominal_pembayaran'],0,',','.'); ?></td>
                    <td><?= $pembayaran['status_pembayaran']; ?></td>
                    <td><?= $pembayaran['pesan_pembayaran']; ?></td>
                    <td><?= $pembayaran['metode_pembayaran']; ?></td>
                    <td><a href="img/bukti_pembayaran/<?= $pembayaran['foto_pembayaran']; ?>" target="_blank">View Bukti Pembayaran</a></td>
                    <td width=20% class="text-center">


                        <!--  -->
                        <!-- View Button -->
                        <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#viewModal<?= $pembayaran['id_pembayaran']; ?>">
                            View
                        </button>

                        <!-- View Modal -->
                        <div class="modal fade" id="viewModal<?= $pembayaran['id_pembayaran']; ?>" tabindex="-1" aria-labelledby="viewModalLabel<?= $pembayaran['id_pembayaran']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel<?= $pembayaran['id_pembayaran']; ?>" style="color:black; text-align: left;">View Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="color:black; text-align: left;">
                                        <p><strong>Nama Campaign</strong> <?= $pembayaran['nama_campaign']; ?></p>
                                        <p><strong>Donatur:</strong> <?= $pembayaran['name']; ?></p>
                                        <p><strong>Tanggal Pembayaran:</strong> <?= $pembayaran['tanggal_pembayaran']; ?></p>
                                        <p><strong>Nominal Pembayaran:</strong> Rp<?= number_format($pembayaran['nominal_pembayaran'],0,',','.'); ?></p>
                                        <p><strong>Status Pembayaran:</strong> <?= $pembayaran['status_pembayaran']; ?></p>
                                        <p><strong>Pesan Pembayaran:</strong> <?= $pembayaran['pesan_pembayaran']; ?></p>
                                        <p><strong>Metode Pembayaran:</strong> <?= $pembayaran['metode_pembayaran']; ?></p>
                                        <img src="img/bukti_pembayaran/<?= $pembayaran['foto_pembayaran']; ?>" class="img-fluid" alt="<?= $pembayaran['foto_pembayaran']; ?>" style="border-radius: 1rem;">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Button -->
                        <button type="button" class="btn btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $pembayaran['id_pembayaran']; ?>">
                            Edit
                        </button>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal<?= $pembayaran['id_pembayaran']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $pembayaran['id_pembayaran']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="color: black; " id="editModalLabel<?= $pembayaran['id_pembayaran']; ?>">Edit Pembayaran</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form for editing pembayaran -->
                                        <form action="" method="POST">
                                            <input type="hidden" name="id_pembayaran" value="<?= $pembayaran['id_pembayaran']; ?>">
                                            <div class="mb-3">
                                                <label for="nama_campaign" class="form-label" style="color: black; ">Nama Campaign</label>
                                                <input type="text" class="form-control" id="nama_campaign" name="nama_campaign" value="<?= $pembayaran['nama_campaign']; ?>" disabled readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label" style="color: black; ">Donatur</label>
                                                <input type="text" class="form-control" id="name" name="name" value="<?= $pembayaran["name"]; ?>" disabled readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_pembayaran" class="form-label" style="color: black;">Tanggal Pembayaran</label>
                                                <input type="date" class="form-control" id="tanggal_pembayaran" name="tanggal_pembayaran" value="<?= $pembayaran['tanggal_pembayaran']; ?>" disabled readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="metode_pembayaran" class="form-label" style="color: black;">Metode Pembayaran</label>
                                                <input type="text" class="form-control" id="metode_pembayaran" name="metode_pembayaran" value="<?= $pembayaran['metode_pembayaran']; ?>" disabled readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nominal_pembayaran" class="form-label" style="color: black;">Nominal Pembayaran</label>
                                                <input type="text" class="form-control" id="nominal_pembayaran" name="nominal_pembayaran" value="<?= $pembayaran['nominal_pembayaran']; ?>" disabled readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="pesan_pembayaran" class="form-label" style="color: black;">Pesan Pembayaran</label>
                                                <input type="text" class="form-control" id="pesan_pembayaran" name="pesan_pembayaran" value="<?= $pembayaran['pesan_pembayaran']; ?>" disabled readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="foto_pembayaran" class="form-label" style="color: black;">Foto Pembayaran</label>
                                                <input type="text" class="form-control" id="foto_pembayaran" name="foto_pembayaran" value="<?= $pembayaran['foto_pembayaran']; ?>" disabled readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status_pembayaran" class="form-label" style="color: black;">Status Pembayaran</label>
                                                <select class="form-select" id="status_pembayaran" name="status_pembayaran">
                                                    <option value="Verified" <?= ($pembayaran['status_pembayaran'] == 'Verified') ? 'selected' : ''; ?>>Verified</option>
                                                    <option value="Not Verified" <?= ($pembayaran['status_pembayaran'] == 'Not Verified') ? 'selected' : ''; ?>>Not Verified</option>
                                                </select>
                                            </div>
                                            <input type="hidden" name="id_campaign" value="<?= $pembayaran['id_campaign'] ?>">

                                            <button type="submit" class="btn btn-primary" id="updatex" name="updatex">Update Pembayaran</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Edit Modal -->

                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $pembayaran['id_pembayaran']; ?>">
                             Soft Delete
                        </button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal<?= $pembayaran['id_pembayaran']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $pembayaran['id_pembayaran']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel<?= $pembayaran['id_pembayaran']; ?>" style="color: black;">Delete Pembayaran</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="color: black;">
                                        <p style="text-align: left;">Are you sure you want to delete the payment with ID <?= $pembayaran['id_pembayaran']; ?>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="" method="POST">
                                            <!-- Hidden input to store the payment ID -->
                                            <input type="hidden" name="id_pembayaran" value="<?= $pembayaran['id_pembayaran']; ?>">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <!-- Change the button type to submit the form -->
                                            <button type="submit" class="btn btn-danger" name="deletepembayaran">Delete</button>
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
