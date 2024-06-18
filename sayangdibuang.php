<div class="container-log">

   <div class="content">
      <h3>hi, <span>user</span></h3>
      <h1>welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
      <a href="user_campaignpage.php" class="btn">Campaign Information</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="myForm">
                        <div class="mb-3">
                            <label for="nama" class="form-label" style="color: black;">Username</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Username" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label" style="color: black;">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                        </div>

                        <div class="mb-3">
                            <label for="user_role" class="form-label" style="color: black;">User role</label>
                            <select class="form-select" id="user_type" name="user_type" aria-label="Default select example" required>
                                <option selected>Open this select menu</option>
                                <option value="admin">admin</option>
                                <option value="user">user</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="user_status" class="form-label" style="color: black;">User Status</label>
                            <select class="form-select" id="user_status" name="user_status" aria-label="Default select example" required>
                                <option selected>Open this select menu</option>
                                <option value="Active">Active</option>
                                <option value="Not-Active">Not-Active</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="adduser" name="adduser" onclick="document.forms[0].submit()">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

                           <!-- Edit Button -->
                           <button type="button" style="color: white;" class="btn btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $user['id'] ?>">
                            Edit
                        </button>
                        
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal<?= $user['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $user['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 style="color: black;" class="modal-title" id="editModalLabel<?= $user['id'] ?>">Edit Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" id="editForm<?= $user['id'] ?>" style="text-align: left;">
                                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                            <div class=" mb-3">
                                                <label for="name" class="form-label" style="color: black;">Username</label>
                                                <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>" placeholder="Username">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label" style="color: black;">Email Address</label>
                                                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" placeholder="name@example.com">
                                            </div>
                                            <div class="mb-3">
                                                <label for="user_type" class="form-label" style="color: black;">User role</label>
                                                <select class="form-select" id="user_type" name="user_type" aria-label="Default select example">
                                                    <option value="admin" <?= ($user['user_type'] == 'admin') ? 'selected' : '' ?>>admin</option>
                                                    <option value="user" <?= ($user['user_type'] == 'user') ? 'selected' : '' ?>>user</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="user_status" class="form-label" style="color: black;">User Status</label>
                                                <select class="form-select" id="user_status" name="user_status" aria-label="Default select example">
                                                    <option value="Active" <?= ($user['user_status'] == 'Active') ? 'selected' : '' ?>>Active</option>
                                                    <option value="Not-Active" <?= ($user['user_status'] == 'Not-Active') ? 'selected' : '' ?>>Not-Active</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" style="color: white;" class="btn btn-warning" name="updateuser" id="updateuser" onclick="document.forms['editForm<?= $user['id'] ?>'].submit()">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $user['id'] ?>">
                            Delete
                        </button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal<?= $user['id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $user['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel<?= $user['id'] ?>" style="color: black;">Delete User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="color: black;">
                                        <p style="text-align: left;">Are you sure you want to delete <?=$user['user_type'] ?> "<?= $user['name'] ?>"</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST">
                                            <!-- Hidden input to store the user ID -->
                                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                             <!-- Change the button type to submit the form -->
                                            <button type="submit" class="btn btn-danger" name="deleteuser">Delete</button>
                                        </form>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <!-- End Delete Modal -->