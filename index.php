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
            <form method="GET" action="" class="form-horizontal">
                <div class="form-group">
                    <label for="id" class="control-label col-sm-2">ID: 5 OR 1=1</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="form_click" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <?php echo isset($_GET['error']) ? 'Error: ' . $_GET['error'] : '' ?>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php
//         db_createTables();

            if (!empty($_GET['id'])) {
                $sql = "SELECT * FROM persons WHERE id = " . $_GET['id'] . "";

                //use PDO
//                        $dsn = "mysql:host=localhost;dbname=my_db;charset=utf8";
//                        $pdo = new PDO($dsn, "root", "123456");
//                        $stmt = $pdo->prepare("SELECT * FROM persons WHERE id = :id");
//                        $stmt->execute([':id' => $_GET['id']]);
//                        
//                        var_dump($result = $stmt->fetch());die;
            } else {
                $sql = "SELECT * FROM persons";
            }
            // sqlInject
            echo $sql;

            if ($results = db_get_list($sql)) {
                echo "<table class='table table-bordered' style='margin-top:30px'>";
                echo "<tr>";
                echo "<th>Id</th>";
                echo "<th>Name</th>";
                echo "<th>Email</th>";
                echo "<th>Password</th>";
                echo "<th>Action</th>";
                echo "</tr>";
                foreach ($results as $result) {
                    echo "<tr>";
                    echo "<td>" . $result['id'] . "</td>";
                    echo "<td>" . $result['name'] . "</td>";
                    echo "<td>" . htmlspecialchars($result['email']) . "</td>";
                    echo "<td>" . $result['password'] . "</td>";
                    echo "<td><a href='edit.php?id=" . $result['id'] . "'>Edit</a><br><a onclick='confirmDelete(" . $result['id'] . ")' href='delete.php?id=" . $result['id'] . "'>Delete</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "ERROR: Could not able to execute $sql. ";
            }

            // Close connection
            db_close();
            ?>
        </div>
    </div>
</div>
<script>
    function confirmDelete(id) {
        if (confirm("Are You Sure?")) {
            window.location.href = "delete.php?id=" + id;
        } else {
            location.reload();
        }
    }
</script>
<?php require_once ('views/footer.php'); ?>