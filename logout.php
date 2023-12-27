<?php
include("admin/essential.php");
session_start();
session_destroy();
redirect("index.php");
?>