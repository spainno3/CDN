<?php require_once ('libs/config.php'); ?>
<?php if(!isset($_SESSION['userId'])){
    header('Location: login.php');
} ?>
<?php require_once ('views/header.php'); ?>
<?php require_once ('views/nav.php'); ?>
<?php
    $sql = "SELECT * FROM persons WHERE id = " . $_GET['id'] . "";
    $result = db_get_row($sql);
?>
<div class="container" style="margin-top:30px">
    <div class="col-sm-12">
        <form method="POST" action="" class="form-horizontal">
            <div class="form-group">
                <label for="name" class="control-label col-sm-2">Full Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($result['name']) ? $result['name'] : '' ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="control-label col-sm-2">Email:</label>
                <div class="col-sm-10">
                    <input type="" class="form-control" id="email" name="email" value="<?php echo isset($result['email']) ? $result['email'] : '' ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="control-label col-sm-2">Password:</label>
                <div class="col-sm-10">
                    <input type="" class="form-control" id="password" name="password" value="<?php echo isset($result['password']) ? $result['password'] : '' ?>">
                </div>
            </div>
            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="form_click" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-sm-12">
        <?php
        if (isset($_POST['form_click'])) {
            // Attempt update query execution
            $sql = "UPDATE persons set name='". $_POST['name'] ."', email='". $_POST['email'] ."', password='". $_POST['password'] ."' WHERE id='". $_GET['id']."'";
            if (db_execute($sql)) {
                echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Success: '.$sql.'</strong>
                                    </div>';
            } else {
                echo "<div class='alert alert-danger alert-dismissible'><strong>ERROR: Could not able to execute $sql. " . mysqli_error($link) . '</strong></div>';
            }
            // Close connection
            db_close();
            header("Refresh:3; url=index.php");
        }
        ?>
    </div>
</div>

<?php require_once ('views/footer.php'); ?>
