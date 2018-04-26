<?php
require_once ('config.php');
function deletePerson($id){
    $sql = "DELETE FROM `persons` WHERE id = $id";
    if(db_execute($sql)){
        header('Location: index.php');
    }else{
        header('Location: index.php?error='.$id);
    }
}