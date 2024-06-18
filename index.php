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

    <!-- Barba.js and GSAP -->
    <script src="https://unpkg.com/@barba/core"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
  </head>

  <body>
    <div id="barba-wrapper">
      <div class="barba-container">

      </div>
    </div>

  
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

    <!-- Hero Section Start-->
    <section class="hero" id="home">
      <main class="content">
        <h1>Selalu Ada Ruang Bagi Mereka Yang Berjuang</h1>
        <p>
          Kuatkan Niat, Ulurkan Tangan, Sesama Manusia Saling Menguatkan
        </p>
        <a href="#campaign" class="cta">Bantu Sekarang!</a>
      </main>
    </section>
    <!-- Hero Section End-->

    <!-- About Section Start-->
    <section class="about" id="about-us">
      <h2>About Us</h2>
      <div class="row">
        <div class="about-img">
          <img src="img/about-us.jpg" alt="About Us" />
        </div>
        <div class="content">
          <h3>Apa itu BantuBangkit?</h3>
          <p>
            BantuBangkit adalah ruang berjuang bagi mereka yang yang berjuang. BantuBangkit adalah aplikasi sekaligus website donasi yang mengkoneksikan donatur dam mereka yang membutuhkan. BantuBangkit hadir membawa harapan bagi mereka yang tidak kenal menyerah. Hadir dengan fitur yang mudah, cepat, dan transparan membawa BantuBangkit sebagai aplikasi donasi paling unggul se-Indonesia tahun 2024 ini. 
          </p>
        </div>
      </div>
    </section>
    <!-- About Section End-->

    <!-- Feature Section Start-->
    <section class="features" id="features">
      <h2>Features</h2>
 

      <div class="row" style="text-align: justify";>
        <div class="section">
          <i class="icon-features" data-feather="smile"></i>
          <h3>Campaign</h3>
          <p>
            Bantuan yang bisa diberikan dibuat dengan istilah "Campaign". Campaign sendiri adalah fitur yang bisa ditambahkan oleh user. Campaign akan dibagi sesuai dengan provinsi dan juga kategorinya. Di dalam campaign terdapat fungsi berdonasi.

          </p>
        </div>

        <div class="section">
          <i class="icon-features" data-feather="star"></i>
          <h3>Testimonials</h3>
          <p>
            Testimoni yang bukan hanya diberikan oleh filantropi, tetapi juga mereka yang merasa dibantu. Hal ini memberikan pandangan yang lebih luas terkait dengan fungsi BantuBangkit itu sendiri. Di dalam testimoni juga memiliki kata-kata Web Developer dan Mobile Developernya.
          </p>
        </div>

        <div class="section">
          <i class="icon-features" data-feather="users"></i>
          <h3>Connection</h3>
          <p>
            BantuBangkit menawarkan koneksi yang lebih kuat antara sesama manusia. Bukan hanya antara sesama yang mebutuhkan, tetapi BantuBangkit memungkinkan menguatkan koneksi antara Filantropi dan yang membutuhkan. Selain itu di dalamnya mereka bisa bercerita pengalaman mereka selama berkontribusi di BantuBangkit.
          </p>
        </div>
      </div>
    </section>

    <!-- Feature Section End-->

    <!-- Campaign Section Start-->
    <section class="campaign" id="campaign">
      <h2>Campaign Yang Sedang Berjalan!</h2>
      
      <div class="row">
    <?php 
    $counter = 0; // Initialize counter variable
    foreach ($data_campaign as $campaign) : ?>
        <?php if ($counter < 3 && $campaign['verifikasi_campaign'] === 'Verified' && $campaign['status_campaign'] === 'Berjalan') : ?>
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
            <?php 
            $counter++; // Increment counter
            endif; 
        ?>
    <?php endforeach; ?>
    <button type="button" class="btn btn-primary float-end"><a style="color: white" href="index_campaign.php">More</a></button>

</div>


    </section>


    <!-- Campaign Section End-->

    <!-- Testimonials Section Start-->
    <section class="testimonials" id="testimonials">
      <h2>Testimonials</h2>
      <div class="container mt-5 mb-5">
    
    <div class="row g-2">
        <div class="col-md-4">
            <div class="card p-3 text-center px-4">
                
                <div class="user-image">
                    
            <img src="img/default_profile.jpg" class="rounded-circle" width="80"
                    >
                    
                </div>
                
                <div class="user-content" style="color: black;">
                    
                    <h5 class="mb-0">Hansen Dafa</h5>
                    <span>Web Developer</span>
                    <p>Saya dengan bangga mempresentasikan hasil kerja kami yaitu website BantuBangkit yang menjadi platform untuk berkontribusi dan bermakna bagi masyarakat. Website dibuat dengan prinsip kemudahan, kecepatan, dan transparansi yang baik.</p>
                    
                </div>
                
                
            </div>
        </div>
        
        <div class="col-md-4">
            
            <div class="card p-3 text-center px-4" >
                
                <div class="user-image">
                    
            <img src="img/default_profile.jpg" class="rounded-circle" width="80"
                    >
                    
                </div>
                
                <div class="user-content" style="color: black;">
                    
                    <h5 class="mb-0">Rizal Ahmad Doni</h5>
                    <span>Mobile Developer</span>
                    <p>Saya berharap aplikasi yang kami develop dapat berguna bagi mereka yang membutuhkan. Aplikasi kami buat semudah dicerna mungkin sehingga memudahkan kita untuk bekontribusi untuk saudara kita. Mari bantu lewat BantuBangkit.</p>
                    
                </div>
                
            </div>
            
        </div>
        
        <div class="col-md-4">
            
            <div class="card p-3 text-center px-4">
                
                <div class="user-image">
                    
            <img src="img/default_profile.jpg" class="rounded-circle" width="80"
                    >
                    
                </div>
                
                <div class="user-content" style="color: black;">
                    
                    <h5 class="mb-0">Dwiky Astomo</h5>
                    <span>Filantropi</span>
                    <p>Membantu sesama manusia adalah amanah yang diberikan Tuhan kepada kita. Saya nbersyukur masih diberikan kesempatan untuk hidup dan memberikan kontribusi kepada yang membutuhkan. Mari jadi bermakna untuk kita semua manusia.</p>
                    
                </div>
                
            </div>
            
        </div>
        
        
    </div>
    
</div>


  



    </section>


    <!--  Testimonials Section End -->

    <!-- Footer Section Start-->
    <section class="footer">
      <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
          <p class="col-md-4 mb-0 text-body-secondary">© 2024 BantuBangkit Inc</p>

          <a style="color: white;" href="index.php" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
          BantuBangkit<i data-feather="trending-up"></i>
          </a>

          <ul class="nav col-md-4 justify-content-end" style="font-size:  0.8rem;">
            <li class="nav-item"><a href="#home" class="nav-link px-2 text-body-secondary">Home</a></li>
            <li class="nav-item"><a href="#about-us" class="nav-link px-2 text-body-secondary">About Us</a></li>
            <li class="nav-item"><a href="#features" class="nav-link px-2 text-body-secondary">Features</a></li>
            <li class="nav-item"><a href="#campaign" class="nav-link px-2 text-body-secondary">Campaign</a></li>
            <li class="nav-item"><a href="#testimonials" class="nav-link px-2 text-body-secondary">Testimonials</a></li>
          </ul>
        </footer>
      </div>
    </section>

    <!-- Footer Section End-->
    



    <!-- Feather Icons -->
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
