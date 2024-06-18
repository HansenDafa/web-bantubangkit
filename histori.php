<?php
include 'layout/header.php'; // Pastikan file ini memuat tag HTML dan elemen head
include 'config/sessionsctrict_user.php'; // Pastikan file ini mengatur session untuk pengguna
include 'config/sessiontimeout.php'; // Pastikan file ini memuat aturan timeout sesi


// Query untuk mendapatkan data pembayaran berdasarkan user_name
$user_name = $_SESSION['user_name'];
$query_pembayaran = "SELECT * FROM pembayaran WHERE name = ?";
$stmt_pembayaran = $conn->prepare($query_pembayaran);
$stmt_pembayaran->bind_param("s", $user_name);
$stmt_pembayaran->execute();
$result_pembayaran = $stmt_pembayaran->get_result();
$data_pembayaran = $result_pembayaran->fetch_all(MYSQLI_ASSOC);
$stmt_pembayaran->close();

// Query untuk mendapatkan data campaign berdasarkan username
$query_campaign = "SELECT * FROM campaign WHERE username = ?";
$stmt_campaign = $conn->prepare($query_campaign);
$stmt_campaign->bind_param("s", $user_name);
$stmt_campaign->execute();
$result_campaign = $stmt_campaign->get_result();
$data_campaign = $result_campaign->fetch_all(MYSQLI_ASSOC);
$stmt_campaign->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
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
                        <a class="nav-link active" href="histori.php">Histori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_campaignpage.php">Campaign</a>
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
                <th>Nama Campaign</th>
                <th>Donatur</th>
                <th>Tanggal Pembayaran</th>
                <th>Nominal Pembayaran</th>
                <th>Status Pembayaran</th>    
                <th>Pesan Pembayaran</th>
                <th>Metode Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_pembayaran as $pembayaran) : ?>
                <tr>
                    <td><?= $pembayaran['id_pembayaran']; ?></td>
                    <td><?= $pembayaran['nama_campaign']; ?></td>
                    <td><?= $pembayaran['name']; ?></td>
                    <td><?= $pembayaran['tanggal_pembayaran']; ?></td>
                    <td>Rp<?= number_format($pembayaran['nominal_pembayaran'],0,',','.'); ?></td>
                    <td><?= $pembayaran['status_pembayaran']; ?></td>
                    <td><?= $pembayaran['pesan_pembayaran']; ?></td>
                    <td><?= $pembayaran['metode_pembayaran']; ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h1 style="color: #FFF;">Campaign Information</h1>
    <hr style="color: #FFF;">

    <table class="table table-bordered table-dark table-striped" id="table">
        <thead>
            <tr>
                <th>ID Campaign</th>
                <th>Nama Campaign</th>
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
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_campaign as $campaign) : ?>
                <tr>
                    <td><?= $campaign['id_campaign']; ?></td>
                    <td><?= $campaign['nama_campaign']; ?></td>
                    <td><?= $campaign['deskripsi_campaign']; ?></td>
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

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php include 'layout/footer.php'; ?>
