
<?php require_once ('libs/config.php'); ?>
<?php
if (!isset($_SESSION['userId'])) {
    header('Location: login.php');
}
?>
<?php require_once ('views/header.php'); ?>
<?php require_once ('views/nav.php'); ?>

<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <form method="POST" action="" class="form-inline" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="fileSelect">Filename:</label>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary" value="Upload">Upload Image</button>
                </form>
            </div>
            <div class="row">
                <?php
                if (isset($_POST["submit"])) {
                    $target_dir = "uploads/";
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    // Check if image file is a actual image or fake image
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if ($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                    // Check if file already exists
                    //                            if (file_exists($target_file)) {
                    //                                echo "Sorry, file already exists.";
                    //                                $uploadOk = 0;
                    //                            }
                    // Check file size
                    //                            if ($_FILES["fileToUpload"]["size"] > 500000) {
                    //                                echo "Sorry, your file is too large.";
                    //                                $uploadOk = 0;
                    //                            }
                    // Allow certain file formats
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                    } else {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            $sql = "INSERT INTO file_upload (src) VALUES ('" . $target_file . "')";
                            if (db_execute($sql)) {
                                echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                            } else {
                                echo 'Error';
                            }
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }

                    // Close connection
                    db_close();
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php require_once ('views/footer.php'); ?>
