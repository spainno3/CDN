<?php

require_once ('config.php');

function deletePerson($id) {
    $sql = "DELETE FROM `persons` WHERE id = $id";
    if (db_execute($sql)) {
        return header('Location: index.php');
    }
    return header('Location: index.php?error=' . $id);
}
