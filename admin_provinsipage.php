<?php 
include 'layout/header.php';
include 'config/sessionstrict_admin.php';
include 'config/sessiontimeout.php';


$data_provinsi = select("SELECT * FROM provinsi");

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
                        <a class="nav-link" href="admin_metodepembayaranpage.php">Metode Pembayaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin_provinsipage.php">Provinsi</a>
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
    <h1 style="color: #FFF;">Provinsi Information</h1>
    <hr style="color: #FFF;">

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#addModal">
        Add
    </button>

    <!-- Add Provinsi Modal -->
    <div style="z-index: 99999;" class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <!-- Modal content for adding provinsi -->
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel" style="color: black;">Add Provinsi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding provinsi -->
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="nama_provinsi" class="form-label" style="color: black;">Nama Provinsi</label>
                            <input type="text" class="form-control" id="nama_provinsi" name="nama_provinsi" placeholder="Nama Provinsi" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="addprovinsi">Add Provinsi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-dark table-striped" id="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Provinsi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_provinsi as $provinsi) : ?>
                <tr>
                    <td><?= $provinsi['id_provinsi']; ?></td>
                    <td><?= $provinsi['nama_provinsi']; ?></td>
                    <td width=20% class="text-center">
                        <!-- View Button -->
                        <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#viewModal<?= $provinsi['id_provinsi'] ?>">
                            View
                        </button>

                        <!-- View Modal -->
                        <div class="modal fade" style="z-index: 99999;" id="viewModal<?= $provinsi['id_provinsi'] ?>" tabindex="-1" aria-labelledby="viewModalLabel<?= $provinsi['id_provinsi'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel<?= $provinsi['id_provinsi'] ?> " style="color:black; text-align: left;">View Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="color:black; text-align: left;">
                                        <p><strong>Nama Provinsi: </strong><?= $provinsi['nama_provinsi'] ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Button -->
                        <button type="button" class="btn btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $provinsi['id_provinsi']; ?>">
                            Edit
                        </button>

                        <!-- Edit Provinsi Modal -->
                        <div class="modal fade" style="z-index: 99999;" id="editModal<?= $provinsi['id_provinsi']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $provinsi['id_provinsi']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel<?= $provinsi['id_provinsi']; ?>" style="color:black;">Edit Provinsi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" >
                                        <!-- Form for editing provinsi -->
                                        <form action="" method="POST"  style="text-align: left;">
                                            <input type="hidden" name="id_provinsi" value="<?= $provinsi['id_provinsi']; ?>">
                                            <div class="mb-3">
                                                <label for="nama_provinsi" class="form-label" style="color: black;">Nama Provinsi</label>
                                                <input type="text" class="form-control" id="nama_provinsi" name="nama_provinsi" value="<?= $provinsi['nama_provinsi']; ?>" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" style="color: white;" class="btn btn-warning" name="updateprovinsi">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Edit Provinsi Modal -->

                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $provinsi['id_provinsi']; ?>">
                            Soft Delete
                        </button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal<?= $provinsi['id_provinsi']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $provinsi['id_provinsi']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel<?= $provinsi['id_provinsi']; ?>" style="color: black;">Delete Provinsi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="color: black;">
                                        <p style="text-align: left;">Are you sure you want to delete the provinsi "<?= $provinsi['nama_provinsi']; ?>"?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="" method="POST">
                                            <!-- Hidden input to store the provinsi ID -->
                                            <input type="hidden" name="id_provinsi" value="<?= $provinsi['id_provinsi']; ?>">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <!-- Change the button type to submit the form -->
                                            <button type="submit" class="btn btn-danger" name="deleteprovinsi">Delete</button>
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
