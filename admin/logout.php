<?php
include("essential.php");
session_start();
session_destroy();
redirect("index.php");
?>