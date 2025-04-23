<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM donor_details WHERE donor_id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: donor_list.php?deleted=success");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
