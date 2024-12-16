<?php
session_start();

// Update the session variable when modal is closed
if (isset($_POST['modal_hidden']) && $_POST['modal_hidden'] == true) {
    $_SESSION['modal_shown'] = true; // Set to true after modal is closed
}
?>
