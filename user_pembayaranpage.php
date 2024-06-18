<?php

// Include header and any necessary functions
include 'layout/header.php';
include 'config/sessionsctrict_user.php';
include 'config/sessiontimeout.php';
$id_campaign = $_GET['id_campaign'];

$data_metode_pembayaran = select("SELECT * FROM metode_pembayaran");
$query = "SELECT nama_campaign FROM campaign WHERE id_campaign = '$id_campaign'";
$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result)) {
    $nama_campaign = $row['nama_campaign'];
}

// Atur zona waktu ke Waktu Indonesia Barat (GMT+7)
date_default_timezone_set('Asia/Jakarta');

// Mendapatkan tanggal saat ini
$current_date = date('Y-m-d H:i:s');
?>


<div class="container mt-4">
    <h1>Donate to Campaign: <?= $nama_campaign ?></h1>
    <hr>

    <!-- Donation Form -->
    <form action="" method="POST" enctype="multipart/form-data">
        <!-- Hidden input to store the current date -->
        <input type="hidden" name="tanggal_pembayaran" value="<?= $current_date; ?>">
        <input type="hidden" name="nama_campaign" value="<?= $nama_campaign ?>">
        <input type="hidden" name="id_campaign" value="<?= $id_campaign ?>">
        <input type="hidden" id="name" name="name" value="<?php echo $_SESSION['user_name']; ?>">



        <div class="mb-3">
            <label for="nominal_pembayaran" class="form-label">Nominal Pembayaran</label>
            <input type="number" class="form-control" id="nominal_pembayaran" name="nominal_pembayaran" placeholder="Enter donation amount" required>
        </div>
        <div class="mb-3">
            <label for="pesan_pembayaran" class="form-label">Pesan Pembayaran</label>
            <textarea class="form-control" id="pesan_pembayaran" name="pesan_pembayaran" rows="3" placeholder="Enter any message (optional)"></textarea>
        </div>
        <div class="mb-3">
            <label for="metode_pembayaran" class="form-label" style="color: black;">Metode Pembayaran</label>
            <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" required>
                <option value="" selected disabled>Select Metode Pembayaran</option>
                <?php foreach ($data_metode_pembayaran as $metode) : ?>
                    <option value="<?= $metode['nama_metode']; ?>"><?= $metode['nama_metode']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
            <input type="file" class="form-control" id="foto_pembayaran" name="foto_pembayaran" accept="image/*,application/pdf" required>
        </div>
        <!-- Hidden input to store the campaign ID -->
        <input type="hidden" name="status_pembayaran" value="Not Verified">

        <a type="" href="user_campaignpage.php" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-primary" name="addpembayaran" id="addpembayaran">Donate Now</button>
    </form>
    
</div>

<?php include 'layout/footer.php';?>
