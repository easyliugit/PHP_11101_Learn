<?php
session_start();

if ($_SESSION['ans']==$_GET['ans']) {
    # code...
    echo 1;
} else {
    # code...
    echo 0;
}

?>