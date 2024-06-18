<?php 
include 'layout/header.php';
include 'config/sessionstrict_admin.php';
include 'config/sessiontimeout.php';


$data_kategori = select("SELECT * FROM kategori");
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
                        <a class="nav-link active" href="admin_kategoripage.php">Kategori</a>
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
    <h1 style="color: #FFF;">Kategori Information</h1>
    <hr style="color: #FFF;">

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#addModal">
        Add
    </button>

    <!-- Add Kategori Modal -->
    <div style="z-index: 99999;" class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <!-- Modal content for adding kategori -->
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel" style="color: black;">Add Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding kategori -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label" style="color: black;">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Nama Kategori" required>
                        </div>
                        <div class="mb-3">
                            <label for="foto_kategori" class="form-label" style="color: black;">Foto Kategori</label>
                            <input type="file" class="form-control" id="foto_kategori" name="foto_kategori">
                        </div>
                        <button type="submit" class="btn btn-primary" name="addkategori">Add Kategori</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-dark table-striped" id="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Foto Kategori</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $id_kategori = 1; ?>
            <?php foreach ($data_kategori as $kategori) : ?>
                <tr>
                    <td><?= $id_kategori++; ?></td>
                    <td><?= $kategori['nama_kategori']; ?></td>
                    <td><?= $kategori['foto_kategori']; ?></td>
                    <td width=20% class="text-center">
                        <!-- View Button -->
                        <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#viewModal<?= $kategori['id_kategori'] ?>">
                            View
                        </button>

                        <!-- View Modal -->
                        <div class="modal fade" style="z-index: 99999;" id="viewModal<?= $kategori['id_kategori'] ?>" tabindex="-1" aria-labelledby="viewModalLabel<?= $kategori['id_kategori'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel<?= $kategori['id_kategori'] ?> " style="color:black; text-align: left;">View Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="foto_kategori">
                                        <img src="img/gambar_kategori/<?= $kategori['foto_kategori']; ?>" class="img-fluid" alt="<?= $kategori['foto_kategori']; ?>" style="border-radius: 1rem;">
                                    </div>
                                    <div class="modal-body" style="color:black; text-align: left;">
                                        <p><strong>Nama Kategori: </strong><?= $kategori['nama_kategori'] ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Button -->
                        <button type="button" class="btn btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $kategori['id_kategori']; ?>">
                            Edit
                        </button>

                        <!-- Edit Kategori Modal -->
                        <div class="modal fade" style="z-index: 99999;" id="editModal<?= $kategori['id_kategori']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $kategori['id_kategori']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel<?= $kategori['id_kategori']; ?>" style="color:black;">Edit Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" >
                                        <!-- Form for editing kategori -->
                                        <form action="" method="POST"  style="text-align: left;" enctype="multipart/form-data">
                                            <input type="hidden" name="id_kategori" value="<?= $kategori['id_kategori']; ?>">
                                            <input type="hidden" name="foto_kategori_lama" value="<?= $kategori['foto_kategori']; ?>">

                                            <div class="mb-3">
                                                <label for="nama_kategori" class="form-label" style="color: black;">Nama Kategori</label>
                                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= $kategori['nama_kategori']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="foto_kategori" class="form-label" style="color: black;">Foto Kategori</label>
                                                <input type="file" class="form-control" id="foto_kategori" name="foto_kategori">
                                                <p class="mt-3" style="color: black;"><small>Gambar Sebelumnya</small></p>
                                                <img src="img/gambar_kategori/<?= $kategori['foto_kategori']; ?>" alt="foto_kategori" width="100px">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" style="color: white;" class="btn btn-warning" name="updatekategori">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Edit Kategori Modal -->

                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $kategori['id_kategori']; ?>">
                            Soft Delete
                        </button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal<?= $kategori['id_kategori']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $kategori['id_kategori']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel<?= $kategori['id_kategori']; ?>" style="color: black;">Delete Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="color: black;">
                                        <p style="text-align: left;">Are you sure you want to delete the kategori "<?= $kategori['nama_kategori']; ?>"?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="" method="POST">
                                            <!-- Hidden input to store the kategori ID -->
                                            <input type="hidden" name="id_kategori" value="<?= $kategori['id_kategori']; ?>">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <!-- Change the button type to submit the form -->
                                            <button type="submit" class="btn btn-danger" name="deletekategori">Delete</button>
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
