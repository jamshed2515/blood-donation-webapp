<?php
include 'conn.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE contact_query SET query_status = 1 WHERE query_id = {$id}";
    mysqli_query($conn, $sql);
}
header("Location: pending_query.php");
exit;
?>
