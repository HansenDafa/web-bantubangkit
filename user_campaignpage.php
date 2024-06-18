<?php 
include 'layout/header.php';
include 'config/sessionsctrict_user.php';
include 'config/sessiontimeout.php';

$data_campaign = select("SELECT * FROM campaign");
$data_kategori = select("SELECT * FROM kategori");
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
                        <a class="nav-link" aria-current="page" href="user_page.php">User Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="histori.php">Histori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="user_campaignpage.php">Campaign</a>
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
                        <input type="hidden" id="username" name="username" value="<?php echo $_SESSION['user_name']; ?>">

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
                            <label for="tanggal_buka_campaign" class="form-label" style="color: black;">Tanggal Buka Campaign</label>
                            <input type="date" class="form-control" id="tanggal_buka_campaign" name="tanggal_buka_campaign" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_tutup_campaign" class="form-label" style="color: black;">Tanggal Tutup Campaign</label>
                            <input type="date" class="form-control" id="tanggal_tutup_campaign" name="tanggal_tutup_campaign" required>
                        </div>
                        <div class="mb-3">
                            <label for="foto_campaign" class="form-label" style="color: black;">Foto Campaign</label>
                            <input type="file" class="form-control" id="foto_campaign" name="foto_campaign">
                        </div>
                        <div class="mb-3">
                            <label for="rekening_campaign" class="form-label" style="color: black;">Rekening Campaign</label>
                            <input type="text" class="form-control" id="rekening_campaign" name="rekening_campaign" placeholder="Rekening Campaign" required>
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



    <div class="row">
    <?php foreach ($data_campaign as $campaign) : ?>
        <?php if ($campaign['verifikasi_campaign'] === 'Verified' && $campaign['status_campaign'] === 'Berjalan') : ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body" style="color: black;">
                        <div class="foto_campaign">
                            <img src="img/gambar_campaign/<?= $campaign['foto_campaign']; ?>" class="img-fluid" alt="<?= $campaign['nama_campaign']; ?>" style="border-radius: 1rem;">
                        </div>
                        <p class="mt-2" style="font-size: 1.5rem;"><strong><?= $campaign['nama_campaign'] ?></strong></p>
                        <p><?= limit_words($campaign['deskripsi_campaign'], 30); ?></p>
                        <?php if (str_word_count($campaign['deskripsi_campaign']) > 30) : ?>
                            <span><a href="#" class="more-link" data-bs-toggle="modal" data-bs-target="#detailsModal<?= $campaign['id_campaign']; ?>">[click for details]</a></span>
                        <?php endif; ?>
                        <p><strong>Tanggal Tutup:</strong> <?= date('d-m-Y', strtotime($campaign['tanggal_tutup_campaign'])); ?></p>
                        <p class="mt-3"><strong>Kategori: </strong> <?= $campaign['nama_kategori']; ?></p>
                        <p><strong>Provinsi: </strong> <?= $campaign['nama_provinsi']; ?></p>
                        <p><strong>Dana Terkumpul:</strong> Rp<?= number_format($campaign['dana_terkumpul_campaign'],0,',','.'); ?></p>
                        <div class="progress mb-3">
                            <?php
                                $progress_percentage = ($campaign['dana_terkumpul_campaign'] / $campaign['dana_target_campaign']) * 100;
                            ?>
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $progress_percentage ?>%;" aria-valuenow="<?= $progress_percentage ?>" aria-valuemin="0" aria-valuemax="100"><?= $progress_percentage ?>%</div>
                        </div>
                       <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModal<?= $campaign['id_campaign']; ?>">Details</a>
                    </div>
                </div>
            </div>

            <!-- Details Modal -->
            <div style="color:black;" class="modal fade" id="detailsModal<?= $campaign['id_campaign']; ?>" tabindex="-1" aria-labelledby="detailsModalLabel<?= $campaign['id_campaign']; ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailsModalLabel<?= $campaign['id_campaign']; ?>"><?= $campaign['nama_campaign']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="img/gambar_campaign/<?= $campaign['foto_campaign']; ?>" class="img-fluid" alt="Campaign Image">
                                </div>
                                <div class="col-md-6">
                                    <p><?= $campaign['deskripsi_campaign']; ?></p>
                                    <p><strong>Diinisiasi oleh: </strong> <?= $campaign['username']; ?></p>
                                    <p><strong>Kategori: </strong> <?= $campaign['nama_kategori']; ?></p>
                                    <p><strong>Provinsi: </strong> <?= $campaign['nama_provinsi']; ?></p>
                                    <p><strong>Target:</strong> Rp<?= number_format($campaign['dana_target_campaign'], 0, ',', '.'); ?></p>
                                    <p><strong>Terkumpul:</strong> Rp<?= number_format($campaign['dana_terkumpul_campaign'], 0, ',', '.'); ?></p>
                                    <p><strong>Tanggal Buka:</strong> <?= date('d-m-Y', strtotime($campaign['tanggal_buka_campaign'])); ?></p>
                                    <p><strong>Tanggal Tutup:</strong> <?= date('d-m-Y', strtotime($campaign['tanggal_tutup_campaign'])); ?></p>
                                    <p><strong>Rekening Campaign</strong> <?= $campaign['rekening_campaign']; ?></p>
                                    <p><strong>Status:</strong> <?= $campaign['status_campaign']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="user_pembayaranpage.php?id_campaign=<?= $campaign['id_campaign']; ?>" class="btn btn-primary">Donate</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<?php
// Function to limit the number of words in a string
function limit_words($string, $word_limit) {
    $words = explode(" ", $string);
    if (count($words) > $word_limit) {
        $string = implode(" ", array_splice($words, 0, $word_limit)) . " ...";
    }
    return $string;
}
?>

<?php include 'layout/footer.php';?>
