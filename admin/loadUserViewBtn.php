<?php
session_start();

require "../connection.php";

$active_rs = Database::search("SELECT * FROM `users` WHERE `ban`='0'");
$active_n = $active_rs->num_rows;

$blocked_rs = Database::search("SELECT * FROM `users` WHERE `ban`='1'");
$blocked_n = $blocked_rs->num_rows;

?>

<button id="activeusersbtn" type="button" class="btn btn-dark" onclick="changeUserView();">Active Users ( <?php echo ($active_n); ?> )</button>
<button id="blockedusersbtn" type="button" class="btn btn-danger" onclick="changeBlockedView();">Blocked Users ( <?php echo ($blocked_n); ?> )</button>