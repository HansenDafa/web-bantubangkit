<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Manage Data</title>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<?php

//Check apakah tombol tambah ditekan
if (isset($_POST['adduser'])){
    if (create_user($_POST) > 0) {
        echo "<script> alert('Data User Berhasil Ditambahkan');
        </script>";
    } else {
        echo "<script> alert('Data User Gagal Ditambahkan');
        </script>";

    }
}

//check jika tombol update ditekan
if (isset($_POST['updateuser'])) {
    if (update_user($_POST) > 0) {
        echo "<script> alert('Data User Berhasil Diubah');
        </script>";
    } else {
        echo "<script> alert('Data User Gagal Diubah');
        </script>";
    }
}

//check jika tombol delete ditekan
if (isset($_POST['deleteuser'])){
    $id = (int)$_POST['user_id'];
    if (delete_user($id) > 0) {
        echo "<script>
                alert('Data User Berhasil Dihapus');
              </script>";
    } else {
        echo "<script>
                alert('Data User Gagal Dihapus');
              </script>";
    }
}

//Check apakah tombol tambah ditekan
if (isset($_POST['addcampaign'])){
    if (create_campaign($_POST) > 0) {
        echo "<script> alert('Data Campaign Berhasil Ditambahkan');
        </script>";
    } else {
        echo "<script> alert('Data Campaign Gagal Ditambahkan');
        </script>";

    }
}

//check jika tombol update ditekan
if (isset($_POST['updatecampaign'])) {
    if (update_campaign($_POST) > 0) {
        echo "<script> alert('Data User Berhasil Diubah');
        </script>";
    } else {
        echo "<script> alert('Data User Gagal Diubah');
        </script>";
    }
}

// Check if the delete campaign button is pressed
if (isset($_POST['deletecampaign'])) {
    $id_campaign = (int)$_POST['campaign_id']; // Corrected variable name
    if (delete_campaign($id_campaign) > 0) {
        echo "<script>
                alert('Data Campaign Berhasil Dihapus');
              </script>";
    } else {
        echo "<script>
                alert('Data Campaign Gagal Dihapus');
              </script>";
    }
}

//Check apakah tombol tambah ditekan
if (isset($_POST['addpembayaran'])){
    if (create_campaign($_POST) > 0) {
        echo "<script> alert('Pembayaran Berhasil');
        </script>";
    } else {
        echo "<script> alert('Pembayaran Gagal');
        </script>";

    }
}

//Check if the add button is pressed
if (isset($_POST['addkategori'])) {
    if (create_kategori($_POST) > 0) {
        echo "<script> alert('Data Kategori Berhasil Ditambahkan');
        </script>";
    } else {
        echo "<script> alert('Data Kategori Gagal Ditambahkan');
        </script>";
    }
}

//Check if the update button is pressed
if (isset($_POST['updatekategori'])) {
    if (update_kategori($_POST) > 0) {
        echo "<script> alert('Data Kategori Berhasil Diubah');
        </script>";
    } else {
        echo "<script> alert('Data Kategori Gagal Diubah');
        </script>";
    }
}

//Check if the delete button is pressed
if (isset($_POST['deletekategori'])) {
    $id_kategori = (int)$_POST['id_kategori'];
    if (delete_kategori($id_kategori) > 0) {
        echo "<script>
                alert('Data Kategori Berhasil Dihapus');
              </script>";
    } else {
        echo "<script>
                alert('Data Kategori Gagal Dihapus');
              </script>";
    }
}

//Check if the add button is pressed
if (isset($_POST['addpembayaran'])) {
    if (create_pembayaran($_POST) > 0) {
        echo "<script> alert('Data Pembayaran Berhasil Ditambahkan');
        </script>";
    } else {
        echo "<script> alert('Data Pembayaran Gagal Ditambahkan');
        </script>";
    }
}

//Check if the update button is pressed
if (isset($_POST['updatepembayaran'])) {
    if (update_pembayaran($_POST) > 0) {
        echo "<script> alert('Data Pembayaran Berhasil Diubah');
        </script>";
    } else {
        echo "<script> alert('Data Pembayaran Gagal Diubah');
        </script>";
    }
}

//Check if the delete button is pressed
if (isset($_POST['deletepembayaran'])) {
    $id_pembayaran = (int)$_POST['id_pembayaran'];
    if (delete_pembayaran($id_pembayaran) > 0) {
        echo "<script>
                alert('Data Pembayaran Berhasil Dihapus');
              </script>";
    } else {
        echo "<script>
                alert('Data Pembayaran Gagal Dihapus');
              </script>";
    }
}

//Check if the add button is pressed
if (isset($_POST['addmetode'])) {
    if (create_metode_pembayaran($_POST) > 0) {
        echo "<script> alert('Data Metode Pembayaran Berhasil Ditambahkan');
        </script>";
    } else {
        echo "<script> alert('Data Metode Pembayaran Gagal Ditambahkan');
        </script>";
    }
}

//Check if the update button is pressed
if (isset($_POST['updatemetode'])) {
    if (update_metode_pembayaran($_POST) > 0) {
        echo "<script> alert('Data Metode Pembayaran Berhasil Diubah');
        </script>";
    } else {
        echo "<script> alert('Data Metode Pembayaran Gagal Diubah');
        </script>";
    }
}

//Check if the delete button is pressed
if (isset($_POST['deletemetode'])) {
    $id_metode = (int)$_POST['id_metode'];
    if (delete_metode_pembayaran($id_metode) > 0) {
        echo "<script>
                alert('Data Metode Pembayaran Berhasil Dihapus');
              </script>";
    } else {
        echo "<script>
                alert('Data Metode Pembayaran Gagal Dihapus');
              </script>";
    }
}

//Check if the add button is pressed
if (isset($_POST['addprovinsi'])) {
    if (create_provinsi($_POST) > 0) {
        echo "<script> alert('Data Provinsi Berhasil Ditambahkan');
        </script>";
    } else {
        echo "<script> alert('Data Provinsi Gagal Ditambahkan');
        </script>";
    }
}

//Check if the update button is pressed
if (isset($_POST['updateprovinsi'])) {
    if (update_provinsi($_POST) > 0) {
        echo "<script> alert('Data Provinsi Berhasil Diubah');
        </script>";
    } else {
        echo "<script> alert('Data Provinsi Gagal Diubah');
        </script>";
    }
}

//Check if the delete button is pressed
if (isset($_POST['deleteprovinsi'])) {
    $id_provinsi = (int)$_POST['id_provinsi'];
    if (delete_provinsi($id_provinsi) > 0) {
        echo "<script>
                alert('Data Provinsi Berhasil Dihapus');
              </script>";
    } else {
        echo "<script>
                alert('Data Provinsi Gagal Dihapus');
              </script>";
    }
}