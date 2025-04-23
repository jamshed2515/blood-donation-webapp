<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Reasons to donate blood">
  <meta name="author" content="">
  <title>Why Donate Blood?</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Merriweather:wght@700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f8fafc;
      color: #1f2937;
    }
    h1, h2 {
      font-family: 'Merriweather', serif;
      color: #111827;
    }
    h1 {
      font-weight: 700;
      font-size: 2.8rem;
      margin-bottom: 30px;
    }
    .content-wrapper {
      padding-top: 80px; /* Increased padding to prevent cut-off */
      padding-bottom: 60px;
    }
    .image-section img {
      width: 100%;
      max-height: 600px;
      object-fit: cover;
      border-radius: 16px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    }
    .text-section p {
      font-size: 1.1rem;
      line-height: 1.8;
      margin-bottom: 20px;
    }
    .highlight {
      background: #fff;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 6px 25px rgba(0,0,0,0.05);
    }
  </style>

  <!-- Bootstrap Scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

<?php 
$active ='why';
include('head.php');
?>

<div class="container content-wrapper">
  <div class="row align-items-center">
    <div class="col-lg-6 mb-4 text-section">
      <div class="highlight">
        <h1>Why Should I Donate Blood?</h1>
        <div>
          <?php
            include 'conn.php';
            $sql = "SELECT page_data FROM pages WHERE page_type='donor'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                echo nl2br($row['page_data']);
              }
            } else {
              echo "<p>No information available at the moment. Please check back later.</p>";
            }
          ?>
        </div>
      </div>
    </div>
    <div class="col-lg-6 image-section">
      <img src="image/08f2fccc45d2564f74ead4a6d5086871.png" alt="Why Donate Blood">
    </div>
  </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>
