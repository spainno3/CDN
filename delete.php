<?php

require_once ('libs/common.php');
if (isset($_GET['id'])) {
    deletePerson($_GET['id']);
}