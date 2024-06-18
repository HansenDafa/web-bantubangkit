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
      <h2>Campaign Berdasarkan Kategori!</h2>

      <p>
        Kategori dibuat untuk membantu kalian dalam melaukan donasi! untuk memeriksa isi dari tiap kategori silahkan Login terlebih dahulu!
    </p>


      
        <div class="row">
    <?php foreach ($data_kategori as $kategori) : ?>
        <div class="col-md-4 mb-4">

            <div class="card h-100" style="color: black;">
                <div class="card-body">
                    <img src="img/gambar_kategori/<?= $kategori['foto_kategori']; ?>" class="card-img-top img-fluid" alt="<?= $kategori['nama_kategori']; ?>" style="height: 200px; object-fit: cover;">
                    <h5 class="card-title"><?= $kategori['nama_kategori']; ?></h5>
                    <a href="user_spesifikkategoripage.php?id_kategori=<?= $kategori['id_kategori']; ?>" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


    </section>



    <script>
      feather.replace();
    </script>

<?php

include 'layout/footer.php';
?>


    <!-- My Javasript-->
    <script src="js/script.js"></script>
  </body>
</html>