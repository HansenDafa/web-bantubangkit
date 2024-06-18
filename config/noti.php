

<?php

include 'function.php';


//Check apakah tombol tambah ditekan
if (isset($_POST['adduser'])){
    if (create_user($_POST) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data User Berhasil Ditambahkan'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data User Gagal Ditambahkan'
            });
        </script>";
    }
}

// Check if the update user button is pressed
if (isset($_POST['updateuser'])) {
    if (update_user($_POST) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data User Berhasil Diubah'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data User Gagal Diubah'
            });
        </script>";
    }
}

// Check if the delete user button is pressed
if (isset($_POST['deleteuser'])){
    $id = (int)$_POST['user_id'];
    if (delete_user($id) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data User Berhasil Dihapus'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data User Gagal Dihapus'
            });
        </script>";
    }
}

// Check if the add campaign button is pressed
if (isset($_POST['addcampaign'])){
    if (create_campaign($_POST) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data Campaign Berhasil Masuk, Tunggu Verifikasi Admin'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data Campaign Gagal Ditambahkan'
            });
        </script>";
    }
}

// Check if the update campaign button is pressed
if (isset($_POST['updatecampaign'])) {
    if (update_campaign($_POST) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data Campaign Berhasil Diubah'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data Campaign Gagal Diubah'
            });
        </script>";
    }
}

// Check if the delete campaign button is pressed
if (isset($_POST['deletecampaign'])) {
    $id_campaign = (int)$_POST['campaign_id'];
    if (delete_campaign($id_campaign) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data Campaign Berhasil Dihapus'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data Campaign Gagal Dihapus'
            });
        </script>";
    }
}


// Check if the add category button is pressed
if (isset($_POST['addkategori'])) {
    if (create_kategori($_POST) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data Kategori Berhasil Ditambahkan'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data Kategori Gagal Ditambahkan'
            });
        </script>";
    }
}

// Check if the update category button is pressed
if (isset($_POST['updatekategori'])) {
    if (update_kategori($_POST) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data Kategori Berhasil Diubah'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data Kategori Gagal Diubah'
            });
        </script>";
    }
}

// Check if the delete category button is pressed
if (isset($_POST['deletekategori'])) {
    $id_kategori = (int)$_POST['id_kategori'];
    if (delete_kategori($id_kategori) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data Kategori Berhasil Dihapus'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data Kategori Gagal Dihapus'
            });
        </script>";
    }
}

// Check if the add payment button is pressed
if (isset($_POST['addpembayaran'])) {
    if (create_pembayaran($_POST) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data Pembayaran Berhasil Ditambahkan'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data Pembayaran Gagal Ditambahkan'
            });
        </script>";
    }
}

// Check if the update payment button is pressed
if (isset($_POST['updatepembayaran'])) {
    if (update_pembayaran($_POST) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'Success',
                title: 'Success',
                text: 'Data Pembayaran Berhasil Diubah'
            });
        </script>";

        $nama_campaign = $_POST['nama_campaign'];

        $query = "SELECT nominal_pembayaran FROM pembayaran WHERE nama_campaign = '$nama_campaign'";
        $result = mysqli_query($conn, $query);

        $total_pembayaran = 0; // initialize to 0

        while($row = mysqli_fetch_assoc($result)) {
            $total_pembayaran += $row['nominal_pembayaran']; // add up the payment amounts
        }

        // now you can use the $total_pembayaran variable to update the campaign funds
        $query_update = "UPDATE campaign SET dana_terkumpul_campaign = dana_terkumpul_campaign + $total_pembayaran WHERE nama_campaign = '$nama_campaign'";
        mysqli_query($conn, $query_update);
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data Pembayaran Gagal Diubah'
            });
        </script>";
    }
}

// Check if the delete payment button is pressed
if (isset($_POST['deletepembayaran'])) {
    $id_pembayaran = (int)$_POST['id_pembayaran'];
    if (delete_pembayaran($id_pembayaran) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data Pembayaran Berhasil Dihapus'
            });
        </script>";
    } 
}

// Check if the add payment method button is pressed
if (isset($_POST['addmetode'])) {
    if (create_metode_pembayaran($_POST) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data Metode Pembayaran Berhasil Ditambahkan'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data Metode Pembayaran Gagal Ditambahkan'
            });
        </script>";
    }
}

// Check if the update payment method button is pressed
if (isset($_POST['updatemetode'])) {
    if (update_metode_pembayaran($_POST) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data Metode Pembayaran Berhasil Diubah'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data Metode Pembayaran Gagal Diubah'
            });
        </script>";
    }
}

// Check if the delete payment method button is pressed
if (isset($_POST['deletemetode'])) {
    $id_metode = (int)$_POST['id_metode'];
    if (delete_metode_pembayaran($id_metode) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data Metode Pembayaran Berhasil Dihapus'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data Metode Pembayaran Gagal Dihapus'
            });
        </script>";
    }
}

// Check if the add province button is pressed
if (isset($_POST['addprovinsi'])) {
    if (create_provinsi($_POST) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data Provinsi Berhasil Ditambahkan'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data Provinsi Gagal Ditambahkan'
            });
        </script>";
    }
}

// Check if the update province button is pressed
if (isset($_POST['updateprovinsi'])) {
    if (update_provinsi($_POST) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data Provinsi Berhasil Diubah'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data Provinsi Gagal Diubah'
            });
        </script>";
    }
}

// Check if the delete province button is pressed
if (isset($_POST['deleteprovinsi'])) {
    $id_provinsi = (int)$_POST['id_provinsi'];
    if (delete_provinsi($id_provinsi) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data Provinsi Berhasil Dihapus'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data Provinsi Gagal Dihapus'
            });
        </script>";
    }
}
?>
