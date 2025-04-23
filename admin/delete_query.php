<?php 
include 'conn.php';

if (isset($_GET['id'])) {
  $que_id = $_GET['id'];
  $sql = "DELETE FROM contact_query WHERE query_id={$que_id}";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    echo "success";
  } else {
    echo "error";
  }

  mysqli_close($conn);
}
?>
