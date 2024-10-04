<?php
session_start();
if (isset($_SESSION['user'])) {
    echo 'logged_in';
} else {
    echo 'not_logged_in';
}
?>
