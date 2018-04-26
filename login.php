<?php require_once ('libs/config.php'); ?>
<?php if(isset($_SESSION['userId'])){
    header('Location: index.php');
} ?>
<?php require_once ('views/header.php'); ?>
<?php require_once ('views/nav.php'); ?>


<div class="container" style="margin-top:30px">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Login Error</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Login Success</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <form method="POST" action="" class="form-horizontal">
                <div class="form-group">
                    <label for="email_error" class="control-label col-sm-2">Email: = " or ""="</label>
                    <div class="col-sm-10">
                        <input type="" class="form-control" id="email_error" name="email_error" value="<?php echo isset($_POST['email_error']) ? $_POST['email_error'] : '' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_error" class="control-label col-sm-2">Password: = " or ""="</label>
                    <div class="col-sm-10">
                        <input type="" class="form-control" id="password_error" name="password_error" value="<?php echo isset($_POST['password_error']) ? $_POST['password_error'] : '' ?>">
                    </div>
                </div>
                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="form_click_error" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </form>
            <?php 
                if (isset($_POST['form_click_error'])) {
                    $email = $_POST['email_error'];
                    $password = $_POST['password_error'];
                    $sql = 'SELECT * FROM persons WHERE email ="' . $email . '" AND password ="' . $password . '"';
                    if ($result = db_execute($sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            $row=mysqli_fetch_array($result);
                            // session_regenerate_id();
                            $_SESSION['userId'] = $row['id'];
                            $_SESSION['name'] = $row['name'];
                            echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Login thành công:  '. $sql .'</strong>
                                        </div>';
                        } else {
                            echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Sai: '. $sql .'</strong>
                                        </div>';
                        }
                    } else {
                        echo "ERROR: Could not able to execute $sql. ";
                    }
                    // Close connection
                    db_close();
                    header("Refresh:3; url=index.php");
                }
            ?>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form method="POST" action="" class="form-horizontal">
                <div class="form-group">
                    <label for="email" class="control-label col-sm-2">Email: = " or ""="</label>
                    <div class="col-sm-10">
                        <input type="" class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label col-sm-2">Password: = " or ""="</label>
                    <div class="col-sm-10">
                        <input type="" class="form-control" id="password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>">
                    </div>
                </div>
                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="form_click_success" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </form>    
            <?php 
            if (isset($_POST['form_click_success'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $sql = 'SELECT * FROM persons WHERE email ="' . addslashes($email) . '" AND password ="' .  addslashes($password) . '"';
                if ($result = db_execute($sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        $row=mysqli_fetch_array($result);
                        // session_regenerate_id();
                        $_SESSION['userId'] = $row['id'];
                        $_SESSION['name'] = $row['name'];
                        echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Login thành công:  '. $sql .'</strong>
                                    </div>';
                    } else {
                        echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Sai: '. $sql .'</strong>
                                    </div>';
                    }
                } else {
                    echo "ERROR: Could not able to execute $sql. ";
                }
                // Close connection
                db_close();
            }
            ?>
        </div>
    </div>
    <div class="col-sm-12">
        <?php

        class Demo {

            public function deleteFileOfuser() {
                $idFile = (int) $data['id'];

                if (checkPermission($userId)) {
                    doDeleteFile($idFile);
                    return SUCCESS;
                }
                return ERROR;
            }

            public function doDeleteFile() {
                
            }

            public function checkLogin(string $email, string $password) {

                if (!empty($user) && !equals($user)) {
                    return 'User khong ton tai';
                }

                if (!empty($password) && !equals($password)) {
                    return 'Sai password';
                }

                return 'Success';
            }

        }


        ?>
    </div>
</div>

<?php require_once ('views/footer.php'); ?>
