<?php
session_start();
session_destroy();

header("Location: ../view/dashboard.php");
exit;
