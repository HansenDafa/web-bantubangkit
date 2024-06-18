<?php
// function menambahkan data
function select($query)
{
    //Panggil koneksi database
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


//fungsi menambahkan data barang
function create_user($post)
{
    global $conn;

    $name = strip_tags($post['name']);
    $email =  strip_tags($post['email']);
    $password =  strip_tags($post['password']);
    $user_type =  strip_tags($post['user_type']);
    $user_status =  strip_tags($post['user_status']);
    $foto_user = upload_file_user();

    //check upload foto
    if (!$foto_user) {
        return false;
    }

    //Query tambah data
    $query= "INSERT INTO user_form VALUES(null, '$name', '$email', '$password', '$user_type', '$user_status', '$foto_user')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

//fungsi untuk mengupload file
function upload_file_user()
{
    $namaFile = $_FILES['foto_user']['name'];
    $ukuranFile = $_FILES['foto_user']['size'];
    $error = $_FILES['foto_user']['error'];
    $tmpName = $_FILES['foto_user']['tmp_name'];


    //Check yang diupload
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile = explode('.', $namaFile);
    $extensifile = strtolower(end($extensifile));

    //Check format atau ekstensi file
    if (!in_array($extensifile, $extensifileValid)){
        //pesan gagal

        echo "<script>
        alert('Format File Tidak Valid']
        </script>";

        die();
    }

    //Check ukuran file 2 Mb
    if ($ukuranFile > 2048000){
        //pesan gagal

        echo "<script>
        alert('Ukuran File Max 2 MB']
        </script>";
        
        die();
    }

    //Generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    //Pindahkan ke localfolder
    move_uploaded_file($tmpName, 'img/gambar_user/'. $namaFileBaru);
    return $namaFileBaru;
}


// fungsi mengubah data barang
function update_user($post)
{
    global $conn;

    $id = $post['id'];
    $name = strip_tags($post['name']);
    $email =  strip_tags($post['email']);
    $password =  strip_tags($post['password']);
    $user_type =  strip_tags($post['user_type']);
    $user_status =  strip_tags($post['user_status']);

    // query ubah data
    $query = "UPDATE user_form SET name = '$name', email = '$email', password = '$password', user_type = '$user_type', user_status = '$user_status' WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// fungsi menghapus data barang
function delete_user($id)
{
    global $conn;

    // query hapus data barang
    $query = "DELETE FROM user_form WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function create_campaign($post)
{
    global $conn;

    $nama_campaign = strip_tags($post['nama_campaign']);
    $username = strip_tags($post['username']);
    $deskripsi_campaign = strip_tags($post['deskripsi_campaign']);
    $nama_kategori = strip_tags($post['nama_kategori']);
    $nama_provinsi = strip_tags($post['nama_provinsi']);
    $dana_target_campaign = strip_tags($post['dana_target_campaign']);
    $tanggal_buka_campaign = strip_tags($post['tanggal_buka_campaign']);
    $tanggal_tutup_campaign = strip_tags($post['tanggal_tutup_campaign']);
    $rekening_campaign = strip_tags($post['rekening_campaign']);

    // Handle file upload (optional)
    $foto_campaign = upload_file_campaign();

    // If no file is uploaded, set $foto_campaign to null
    if (!$foto_campaign) {
        $foto_campaign = null;
    }

    // Prepare the SQL statement
    $query = "INSERT INTO campaign (nama_campaign, username, deskripsi_campaign, nama_kategori, nama_provinsi, dana_target_campaign, tanggal_buka_campaign, tanggal_tutup_campaign, rekening_campaign, foto_campaign) 
              VALUES ('$nama_campaign', '$username', '$deskripsi_campaign', '$nama_kategori', '$nama_provinsi', '$dana_target_campaign', '$tanggal_buka_campaign', '$tanggal_tutup_campaign', '$rekening_campaign' , '$foto_campaign')";

    // Execute the query
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// Function to handle file upload
function upload_file_campaign()
{
    if (isset($_FILES['foto_campaign']) && $_FILES['foto_campaign']['error'] === UPLOAD_ERR_OK) {
        $namaFile = $_FILES['foto_campaign']['name'];
        $ukuranFile = $_FILES['foto_campaign']['size'];
        $tmpName = $_FILES['foto_campaign']['tmp_name'];

        // Check file extension
        $extensifileValid = ['jpg', 'jpeg', 'png'];
        $extensifile = explode('.', $namaFile);
        $extensifile = strtolower(end($extensifile));

        if (!in_array($extensifile, $extensifileValid)) {
            echo "<script>alert('Format File Tidak Valid');</script>";
            return null;  // Return null if invalid file extension
        }

        // Check file size (max 2 MB)
        if ($ukuranFile > 2048000) {
            echo "<script>alert('Ukuran File Max 2 MB');</script>";
            return null;  // Return null if file size exceeds 2 MB
        }

        // Generate new file name
        $namaFileBaru = uniqid() . '.' . $extensifile;

        // Move the file to the desired location
        if (move_uploaded_file($tmpName, 'img/gambar_campaign/' . $namaFileBaru)) {
            return $namaFileBaru;  // Return the new file name if upload is successful
        } else {
            return null;  // Return null if file upload fails
        }
    } else {
        return null;  // Return null if no file is uploaded or there is an upload error
    }
}



// fungsi menambahkan data campaign
function create_campaignx($post)
{
    global $conn;

    $nama_campaign = strip_tags($post['nama_campaign']);
    $deskripsi_campaign =  strip_tags($post['deskripsi_campaign']);
    $nama_kategori = strip_tags($post['nama_kategori']);
    $nama_provinsi = strip_tags($post['nama_provinsi']);
    $dana_target_campaign =  strip_tags($post['dana_target_campaign']);
    $tanggal_buka_campaign =  strip_tags($post['tanggal_buka_campaign']);
    $tanggal_tutup_campaign =  strip_tags($post['tanggal_tutup_campaign']);
    $foto_campaign = upload_file_campaign();

    //Query tambah data campaign
    //check upload foto
    if (!$foto_campaign) {
        return false;
    }

    $query = "INSERT INTO campaign (nama_campaign, deskripsi_campaign, nama_kategori, nama_provinsi, dana_target_campaign, tanggal_buka_campaign, tanggal_tutup_campaign, foto_campaign) VALUES ('$nama_campaign', '$deskripsi_campaign', '$nama_kategori', '$nama_provinsi', '$dana_target_campaign', '$tanggal_buka_campaign', '$tanggal_tutup_campaign', '$foto_campaign')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//fungsi untuk mengupload file
function upload_file_campaignx()
{
    $namaFile = $_FILES['foto_campaign']['name'];
    $ukuranFile = $_FILES['foto_campaign']['size'];
    $error = $_FILES['foto_campaign']['error'];
    $tmpName = $_FILES['foto_campaign']['tmp_name'];


    //Check yang diupload
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile = explode('.', $namaFile);
    $extensifile = strtolower(end($extensifile));

    //Check format atau ekstensi file
    if (!in_array($extensifile, $extensifileValid)){
        //pesan gagal

        echo "<script>
        alert('Format File Tidak Valid']
        </script>";

        die();
    }

    //Check ukuran file 2 Mb
    if ($ukuranFile > 2048000){
        //pesan gagal

        echo "<script>
        alert('Ukuran File Max 2 MB']
        </script>";
        
        die();
    }

    //Generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    //Pindahkan ke localfolder
    move_uploaded_file($tmpName, 'img/gambar_campaign/'. $namaFileBaru);
    return $namaFileBaru;
}

// fungsi mengubah data campaign
function update_campaign($post)
{
    global $conn;

    $id_campaign = $post['id_campaign'];
    $status_campaign =  strip_tags($post['status_campaign']);
    $verifikasi_campaign = strip_tags($post['verifikasi_campaign']);

    // query ubah data campaign
    $query = "UPDATE campaign SET status_campaign = '$status_campaign', verifikasi_campaign = '$verifikasi_campaign'  WHERE id_campaign = $id_campaign";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// fungsi menghapus data campaign
function delete_campaign($id_campaign)
{
    global $conn;

    // query hapus data campaign
    $query = "DELETE FROM campaign WHERE id_campaign = $id_campaign";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Create function for adding kategori
function create_kategori($post)
{
    global $conn;

    $nama_kategori = strip_tags($post['nama_kategori']);
    $foto_kategori =  upload_file_kategori();

    // Query to add data kategori
    if (!$foto_kategori) {
        return false;
    }
    $query= "INSERT INTO kategori VALUES (null, '$nama_kategori', '$foto_kategori')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Update function for modifying kategori
function update_kategori($post)
{
    global $conn;

    $id_kategori = strip_tags($post['id_kategori']);
    $nama_kategori = strip_tags($post['nama_kategori']);
    $foto_kategori_lama = strip_tags($post['foto_kategori_lama']);

    // Query to update data kategori
    if (!$_FILES['foto_kategori']['error'] == 4){
        $foto_kategori = $foto_kategori_lama;
    } else {
        $foto_kategori = upload_file_kategori();
    }

    $query = "UPDATE kategori SET nama_kategori = '$nama_kategori', foto_kategori = '$foto_kategori' WHERE id_kategori = $id_kategori";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload_file_kategori()
{
    $namaFile = $_FILES['foto_kategori']['name'];
    $ukuranFile = $_FILES['foto_kategori']['size'];
    $error = $_FILES['foto_kategori']['error'];
    $tmpName = $_FILES['foto_kategori']['tmp_name'];


    //Check yang diupload
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile = explode('.', $namaFile);
    $extensifile = strtolower(end($extensifile));

    //Check format atau ekstensi file
    if (!in_array($extensifile, $extensifileValid)){
        //pesan gagal

        echo "<script>
        alert('Format File Tidak Valid']
        </script>";

        die();
    }

    //Check ukuran file 2 Mb
    if ($ukuranFile > 2048000){
        //pesan gagal

        echo "<script>
        alert('Ukuran File Max 2 MB']
        </script>";
        
        die();
    }

    //Generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    //Pindahkan ke localfolder
    move_uploaded_file($tmpName, 'img/gambar_kategori/'. $namaFileBaru);
    return $namaFileBaru;
}




// Delete function for removing kategori
function delete_kategori($id_kategori)
{
    global $conn;

    // Query to delete data kategori
    $query = "DELETE FROM kategori WHERE id_kategori = $id_kategori";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// Create function for adding pembayaran
function create_pembayaran($post)
{
    global $conn;

    $tanggal_pembayaran = strip_tags($post['tanggal_pembayaran']);
    $id_campaign = strip_tags($post['id_campaign']);
    $nama_campaign = strip_tags($post['nama_campaign']);
    $name = strip_tags($post['name']);
    $metode_pembayaran = strip_tags($post['metode_pembayaran']);
    $nominal_pembayaran = strip_tags($post['nominal_pembayaran']);
    $status_pembayaran = strip_tags($post['status_pembayaran']);
    $pesan_pembayaran = strip_tags($post['pesan_pembayaran']);
    $foto_pembayaran = upload_file_pembayaran();
        // Query to update data kategori
    if (!$foto_pembayaran) {
        return false;
    }

    // Query to add data pembayaran
    $query = "INSERT INTO pembayaran (tanggal_pembayaran, id_campaign, nama_campaign, name, metode_pembayaran, nominal_pembayaran, status_pembayaran, pesan_pembayaran, foto_pembayaran) 
    VALUES ('$tanggal_pembayaran', '$id_campaign', '$nama_campaign', '$name', '$metode_pembayaran', '$nominal_pembayaran', '$status_pembayaran', '$pesan_pembayaran', '$foto_pembayaran')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload_file_pembayaran() {
    $namaFile = $_FILES['foto_pembayaran']['name'];
    $ukuranFile = $_FILES['foto_pembayaran']['size'];
    $error = $_FILES['foto_pembayaran']['error'];
    $tmpName = $_FILES['foto_pembayaran']['tmp_name'];


    //Check yang diupload
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile = explode('.', $namaFile);
    $extensifile = strtolower(end($extensifile));

    //Check format atau ekstensi file
    if (!in_array($extensifile, $extensifileValid)){
        //pesan gagal

        echo "<script>
        alert('Format File Tidak Valid']
        </script>";

        die();
    }

    //Check ukuran file 2 Mb
    if ($ukuranFile > 2048000){
        //pesan gagal

        echo "<script>
        alert('Ukuran File Max 2 MB']
        </script>";
        
        die();
    }

    //Generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    //Pindahkan ke localfolder
    move_uploaded_file($tmpName, 'img/bukti_pembayaran/'. $namaFileBaru);
    return $namaFileBaru;

}

// Update function for modifying pembayaran
function update_pembayaran($post)
{
    global $conn;

    $id_pembayaran = $post['id_pembayaran'];
    $status_pembayaran = strip_tags($post['status_pembayaran']);


    // Query to update data pembayaran
    $query = "UPDATE pembayaran SET status_pembayaran = '$status_pembayaran' WHERE id_pembayaran = $id_pembayaran";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Delete function for removing pembayaran
function delete_pembayaran($id_pembayaran)
{
    global $conn;

    // Query to delete data pembayaran
    $query = "DELETE FROM pembayaran WHERE id_pembayaran = $id_pembayaran";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Create function for adding metode_pembayaran
function create_metode_pembayaran($post)
{
    global $conn;

    $nama_metode = strip_tags($post['nama_metode']);

    // Query to add data metode_pembayaran
    $query = "INSERT INTO metode_pembayaran VALUES(null, '$nama_metode')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Update function for modifying metode_pembayaran
function update_metode_pembayaran($post)
{
    global $conn;

    $id_metode = $post['id_metode'];
    $nama_metode = strip_tags($post['nama_metode']);

    // Query to update data metode_pembayaran
    $query = "UPDATE metode_pembayaran SET nama_metode = '$nama_metode' WHERE id_metode = $id_metode";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Delete function for removing metode_pembayaran
function delete_metode_pembayaran($id_metode)
{
    global $conn;

    // Query to delete data metode_pembayaran
    $query = "DELETE FROM metode_pembayaran WHERE id_metode = $id_metode";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}



// Create function for adding provinsi
function create_provinsi($post)
{
    global $conn;

    $nama_provinsi = strip_tags($post['nama_provinsi']);
    $foto_provinsi = upload_file_provinsi();

    // Query to add data provinsi
    if (!$foto_provinsi) {
        return false;
    }
    $query= "INSERT INTO provinsi VALUES (null, '$nama_provinsi', '$foto_provinsi')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload_file_provinsi()
{
    $namaFile = $_FILES['foto_provinsi']['name'];
    $ukuranFile = $_FILES['foto_provinsi']['size'];
    $error = $_FILES['foto_provinsi']['error'];
    $tmpName = $_FILES['foto_provinsi']['tmp_name'];


    //Check yang diupload
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile = explode('.', $namaFile);
    $extensifile = strtolower(end($extensifile));

    //Check format atau ekstensi file
    if (!in_array($extensifile, $extensifileValid)){
        //pesan gagal

        echo "<script>
        alert('Format File Tidak Valid']
        </script>";

        die();
    }

    //Check ukuran file 2 Mb
    if ($ukuranFile > 2048000){
        //pesan gagal

        echo "<script>
        alert('Ukuran File Max 2 MB']
        </script>";
        
        die();
    }

    //Generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    //Pindahkan ke localfolder
    move_uploaded_file($tmpName, 'img/gambar_provinsi/'. $namaFileBaru);
    return $namaFileBaru;
}

// Update function for modifying provinsi
function update_provinsi($post)
{
    global $conn;

    $id_provinsi = $post['id_provinsi'];
    $nama_provinsi = strip_tags($post['nama_provinsi']);

    // Query to update data provinsi
    $query = "UPDATE provinsi SET nama_provinsi = '$nama_provinsi' WHERE id_provinsi = $id_provinsi";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Delete function for removing provinsi
function delete_provinsi($id_provinsi)
{
    global $conn;

    // Query to delete data provinsi
    $query = "DELETE FROM provinsi WHERE id_provinsi = $id_provinsi";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
