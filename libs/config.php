<?php

require_once ('libs/session.php');
$conn = null;

/**
 * Function connect db
 * @param null
 * @return db connect 
 */
function db_connect() {
    global $conn;
    if (!$conn) {
        $conn = mysqli_connect("localhost", "root", "123456", "my_db");
        if ($conn === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        mysqli_set_charset($conn, 'UTF-8');
    }
}

/**
 * Function close connect
 * @param null
 * @return close connect 
 */
function db_close() {
    global $conn;
    if ($conn) {
        mysqli_close($conn);
    }
}

/**
 * Function get list data
 * @param string $sql
 * @return array $data 
 */
function db_get_list($sql) {
    db_connect();
    global $conn;
    $data = array();
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

/**
 * Function get detail data
 * @param string $sql
 * @return object $data 
 */
function db_get_row($sql) {
    db_connect();
    global $conn;
    $result = mysqli_query($conn, $sql);
    $row = array();
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }
    return $row;
}

/**
 * Function execute sql
 * @param string $sql
 * @return execute sql
 */
function db_execute($sql) {
    db_connect();
    global $conn;
    return mysqli_query($conn, $sql);
}

/**
 * Function created db
 */
function db_createTables() {
    $sqlPersons = "CREATE TABLE `persons` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    db_execute($sqlPersons);

    $sqlFileUpload = "CREATE TABLE `file_upload` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `src` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    db_execute($sqlFileUpload);

    $sqlInsertPersons = "INSERT INTO `persons` (`name`, `email`, `password`, `created`, `updated`) VALUES
    ('Tuan','spainno3@gmail.com', '123456', '2018-04-25 10:37:17', '2018-04-25 10:37:17'),
    ('Anh', 'thuyanh@gmail.com', '123456', '2018-04-25 10:37:33', '2018-04-25 10:37:33'),
    ('Kien', 'kienchu@gmail.com', '123456', '2018-04-25 10:42:43', '2018-04-25 10:42:43'),
    ('Anh', '<script>alert(1)</script>', '123456', '2018-04-25 10:37:33', '2018-04-25 10:37:33'),
    ('Anh', '<meta http-equiv=refresh content=1; url=http://example.com/>', '123456', '2018-04-25 10:37:33', '2018-04-25 10:37:33')";
    db_execute($sqlInsertPersons);
}
