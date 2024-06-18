<?php

include 'layout/header.php';

$data_campaign = select("SELECT * FROM campaign");
$data_kategori = select("SELECT * FROM kategori");
$data_provinsi = select("SELECT * FROM provinsi");
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My Styles -->
    <link rel="stylesheet" href="css/style.css" />
    <title>BantuBangkit</title>
  </head>

  <body>

  
    <!-- Navbar Start -->
    <nav class="navbar" >
      <a href="#" class="navbar-logo">
        BantuBangkit<i data-feather="trending-up"></i
      ></a>

      <div class="navbar-nav" style="flex-direction: row">
        <a href="index.php">Home</a>
        <a href="#about-us">About Us</a>
        <a href="#features">Features</a>
        <a href="#campaign">Campaign</a>
        <a href="#testimonials">Testimonials</a>
      </div>

      <div class="navbar-extra" style="color: white;">
        <button type="button" class="btn btn-secondary"><a style="color: white;" href="login_form.php" id="login">Login</a></button>
        <button type="button" class="btn btn-secondary"><a style="color: white;" href="register_form.php" id="sign-up">Register</a></button>
        
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i> </a>
      </div>
    </nav>
    <!-- Navbar End -->
    <section class="campaign" id="#campaign">
      <h2>Campaign Yang Sedang Berjalan!</h2>

      <p>
            Bantuan yang bisa diberikan dibuat dengan istilah "Campaign". Campaign sendiri bisa ditambahkan oleh user setelah melakukan login dan harus diverifikasi oleh Admin.

    </p>


      
      <div class="row">
    <?php foreach ($data_campaign as $campaign) : ?>
        <?php if ($campaign['verifikasi_campaign'] === 'Verified' && $campaign['status_campaign'] === 'Berjalan') : ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body" style="color: black;">
                        <div class="foto_campaign">
                            <img src="img/gambar_campaign/<?= $campaign['foto_campaign']; ?>" class="card-img-top img-fluid" alt="<?= $campaign['nama_campaign']; ?>" style="height: 200px; object-fit: cover;">
                        </div>
                        <p class="mt-2" style="font-size: 1.2rem;"><strong><?= $campaign['nama_campaign'] ?></strong></p>
                        <p><?= limit_words($campaign['deskripsi_campaign'], 30); ?></p>
                        <?php if (str_word_count($campaign['deskripsi_campaign']) > 30) : ?>
                            <span><a href="#" class="more-link" data-bs-toggle="modal" data-bs-target="#detailsModal<?= $campaign['id_campaign']; ?>">[click for details]</a></span>
                        <?php endif; ?>
                        <p class="mt-3"><strong>Kategori: </strong> <?= $campaign['nama_kategori']; ?></p>
                        <p><strong>Provinsi: </strong> <?= $campaign['nama_provinsi']; ?></p>
                        <p><strong>Dana Terkumpul:</strong> Rp<?= number_format($campaign['dana_terkumpul_campaign'],0,',','.'); ?></p>
                        <div class="progress mb-3">
                            <?php
                                $progress_percentage = ($campaign['dana_terkumpul_campaign'] / $campaign['dana_target_campaign']) * 100;
                            ?>
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $progress_percentage ?>%;" aria-valuenow="<?= $progress_percentage ?>" aria-valuemin="0" aria-valuemax="100"><?= $progress_percentage ?>%</div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <button type="button" class="btn btn-primary float-end"><a style="color: white" href="index_kategori.php">Lihat Kategori</a></button>
</div>


    </section>



    <script>
      feather.replace();
    </script>

<?php
// Function to limit the number of words in a string
function limit_words($string, $word_limit) {
    $words = explode(" ", $string);
    if (count($words) > $word_limit) {
        $string = implode(" ", array_splice($words, 0, $word_limit)) . " ...";
    }
    return $string;
}


include 'layout/footer.php';
?>


    <!-- My Javasript-->
    <script src="js/script.js"></script>
  </body>
</html>