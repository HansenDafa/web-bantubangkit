<?php 
include 'layout/header.php';
include 'config/sessionstrict_admin.php';
include 'config/sessiontimeout.php';


$data_metode = select("SELECT * FROM metode_pembayaran");
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
                        <a class="nav-link" href="admin_pembayaranpage.php">Pembayaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin_metodepembayaranpage.php">Metode Pembayaran</a>
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
    <h1 style="color: #FFF;">Metode Pembayaran Information</h1>
    <hr style="color: #FFF;">

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#addModal">
        Add
    </button>

    <!-- Add Metode Pembayaran Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel" style="color: black;">Add Metode Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama_metode" class="form-label" style="color: black;">Nama Metode Pembayaran</label>
                            <input type="text" class="form-control" id="nama_metode" name="nama_metode" placeholder="Nama Metode Pembayaran" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addmetode" id="addmetode">Add Metode Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-dark table-striped" id="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Metode Pembayaran</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $id_metode = 1; ?>
            <?php foreach ($data_metode as $metode) : ?>
                <tr>
                    <td><?= $id_metode++; ?></td>
                    <td><?= $metode['nama_metode']; ?></td>
                    <td width=20% class="text-center">
                        <!-- View Button -->
                        <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#viewModal<?= $metode['id_metode'] ?>">
                            View
                        </button>

                        <!-- View Modal -->
                        <div class="modal fade" id="viewModal<?= $metode['id_metode'] ?>" tabindex="-1" aria-labelledby="viewModalLabel<?= $metode['id_metode'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel<?= $metode['id_metode'] ?> " style="color:black; text-align: left;">View Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="color:black; text-align: left;">
                                        <p><strong>Nama Metode Pembayaran: </strong><?= $metode['nama_metode'] ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Button -->
                        <button type="button" class="btn btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $metode['id_metode']; ?>">
                            Edit
                        </button>

                        <!-- Edit Metode Pembayaran Modal -->
                        <div class="modal fade" id="editModal<?= $metode['id_metode']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $metode['id_metode']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel<?= $metode['id_metode']; ?>" style="color:black;">Edit Metode Pembayaran</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" >
                                        <form action="" method="POST"  style="text-align: left;">
                                            <input type="hidden" name="id_metode" value="<?= $metode['id_metode']; ?>">
                                            <div class="mb-3">
                                                <label for="nama_metode" class="form-label" style="color: black;">Nama Metode Pembayaran</label>
                                                <input type="text" class="form-control" id="nama_metode" name="nama_metode" value="<?= $metode['nama_metode']; ?>" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" style="color: white;" class="btn btn-warning" name="updatemetode">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Edit Metode Pembayaran Modal -->

                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $metode['id_metode']; ?>">
                            Soft Delete
                        </button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal<?= $metode['id_metode']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $metode['id_metode']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel<?= $metode['id_metode']; ?>" style="color: black;">Delete Metode Pembayaran</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="color: black;">
                                        <p style="text-align: left;">Are you sure you want to delete the metode pembayaran "<?= $metode['nama_metode']; ?>"?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="" method="POST">
                                            <input type="hidden" name="id_metode" value="<?= $metode['id_metode']; ?>">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger" name="deletemetode">Delete</button>
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
