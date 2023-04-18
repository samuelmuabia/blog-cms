<?php
session_start();

session_destroy();
include('../admin/functions.php');

redirect('../index');

?>