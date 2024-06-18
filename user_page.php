<?php
include 'layout/header.php';
include 'config/sessionsctrict_user.php';
include 'config/sessiontimeout.php';
include 'config/db.php'; // Pastikan untuk menyertakan file yang menginisialisasi koneksi database

if (isset($_POST['updateProfile'])) {
    // Sanitize inputs
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : (isset($_SESSION['user_password']) ? $_SESSION['user_password'] : '');

    // Handle file upload
    $foto_user = isset($_FILES['foto_user']['name']) ? $_FILES['foto_user']['name'] : '';
    if ($foto_user) {
        $target_dir = "uploads/";

        // Check if the directory exists, if not create it
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $target_file = $target_dir . basename($foto_user);

        // Check file type and size
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["foto_user"]["tmp_name"]);
        if ($check === false) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'File is not an image.'
                });
            </script>";
            exit();
        }
        if ($_FILES["foto_user"]["size"] > 5000000) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'File size exceeds limit.'
                });
            </script>";
            exit();
        }
        if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Only JPG, JPEG, PNG & GIF files are allowed.'
                });
            </script>";
            exit();
        }

        if (!move_uploaded_file($_FILES["foto_user"]["tmp_name"], $target_file)) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to upload file.'
                });
            </script>";
            exit();
        }
    } else {
        $target_file = isset($_SESSION['user_foto']) ? $_SESSION['user_foto'] : '';
    }

    // Update user information in the database using prepared statements
    $stmt = $conn->prepare("UPDATE user_form SET name=?, email=?, password=?, foto_user=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $email, $password, $target_file, $_SESSION['user_id']);

    if ($stmt->execute()) {
        // Update session variables
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_foto'] = $target_file;

        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Profile updated successfully'
            }).then(function() {
                window.location = 'user_page.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to update profile'
            }).then(function() {
                window.location = 'user_page.php';
            });
        </script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>

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
                        <a class="nav-link active" aria-current="page" href="user_page.php">User Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="histori.php">Histori</a>
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

<div class="profile-page" style="color: black;">
  <div class="content">
    <div class="content__cover">
      <div class="content__avatar"></div>
      <div class="content__bull"><span></span><span></span><span></span><span></span><span></span></div>
    </div>
    <div class="content__title">
      <h1><strong><?php echo htmlspecialchars(isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''); ?></strong></h1><span>User</span>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">
      Edit Profile
    </button>
  </div>
  <div class="bg">
    <div><span></span><span></span><span></span><span></span><span></span><span></span></div>
  </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" style="z-index: 99999;" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editProfileForm" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars(isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''); ?>" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars(isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''); ?>" required>
          </div>
          <div class="form-group">
            <label for="foto_user">Profile Picture</label>
            <input type="file" class="form-control" id="foto_user" name="foto_user">
          </div>
          <div class="form-group">
            <label for="password">Change Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="updateProfile">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php include 'layout/footer.php'; ?>
