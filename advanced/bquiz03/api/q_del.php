<?php

include_once "../base.php";

$del[$_POST['type']]=$_POST['target'];
$Order->del($del);