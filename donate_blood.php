<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Donate Blood</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Merriweather:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f8f9fa;
    }
    h1 {
      font-family: 'Merriweather', serif;
      color: #dc3545;
    }
    .form-section {
      background: #ffffff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    .form-group label {
      font-weight: 500;
    }
    .btn-primary {
      background-color: #dc3545;
      border-color: #dc3545;
    }
    .btn-primary:hover {
      background-color: #c82333;
      border-color: #bd2130;
    }
  </style>
</head>

<body>
<?php
session_start();
$active = 'donate';
include('head.php');

if (isset($_SESSION['success_message'])) {
  echo '<div class="alert alert-success text-center">' . $_SESSION['success_message'] . '</div>';
  unset($_SESSION['success_message']);
}
if (isset($_SESSION['error_message'])) {
  echo '<div class="alert alert-danger text-center">' . $_SESSION['error_message'] . '</div>';
  unset($_SESSION['error_message']);
}
?>

<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="form-section">
        <h1 class="mb-4">Donate Blood</h1>
        <form name="donor" action="savedata.php" method="post">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>Full Name <span class="text-danger">*</span></label>
              <input type="text" name="fullname" class="form-control" required>
            </div>
            <div class="form-group col-md-4">
              <label>Mobile Number <span class="text-danger">*</span></label>
              <input type="text" name="mobileno" class="form-control" required>
            </div>
            <div class="form-group col-md-4">
              <label>Email Id</label>
              <input type="email" name="emailid" class="form-control">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>Age <span class="text-danger">*</span></label>
              <input type="text" name="age" class="form-control" required>
            </div>
            <div class="form-group col-md-4">
              <label>Gender <span class="text-danger">*</span></label>
              <select name="gender" class="form-control" required>
                <option value="">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label>Blood Group <span class="text-danger">*</span></label>
              <select name="blood" class="form-control" required>
                <option value="" disabled selected>Select</option>
                <?php
                include 'conn.php';
                $sql = "SELECT * FROM blood";
                $result = mysqli_query($conn, $sql) or die("Query unsuccessful.");
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row['blood_id'] . '">' . $row['blood_group'] . '</option>';
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Address <span class="text-danger">*</span></label>
            <textarea name="address" class="form-control" rows="3" required></textarea>
          </div>
          <div class="text-right">
            <input type="submit" name="submit" class="btn btn-primary px-4" value="Submit">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>