<?php
include 'conn.php';
include 'session.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Donor List</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    #sidebar { position: relative; margin-top: -20px }
    #content { position: relative; margin-left: 210px }
    @media screen and (max-width: 600px) {
      #content { margin-left: auto; margin-right: auto; }
    }
    #he {
      font-size: 14px;
      font-weight: 600;
      text-transform: uppercase;
      padding: 3px 7px;
      color: #fff;
      text-decoration: none;
      border-radius: 3px;
    }
  </style>

  <script>
    function confirmDelete() {
      return confirm("Are you sure you want to delete this donor?");
    }
  </script>
</head>

<body style="color:black">

<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>

<div id="header">
  <?php include 'header.php'; ?>
</div>

<div id="sidebar">
  <?php $active = "list"; include 'sidebar.php'; ?>
</div>

<div id="content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 lg-12 sm-12">
          <h1 class="page-title">Donor List</h1>
        </div>
      </div>
      <hr>

      <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'success') { ?>
        <div class="alert alert-success alert-dismissible fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          Donor deleted successfully.
        </div>
      <?php } ?>

      <?php
        $limit = 10;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        $count = $offset + 1;

        $sql = "SELECT * FROM donor_details JOIN blood ON donor_details.donor_blood = blood.blood_id LIMIT {$offset}, {$limit}";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
      ?>

      <div class="table-responsive">
        <table class="table table-bordered text-center">
          <thead>
            <tr>
              <th>S.no</th>
              <th>Name</th>
              <th>Mobile Number</th>
              <th>Email Id</th>
              <th>Age</th>
              <th>Gender</th>
              <th>Blood Group</th>
              <th>Address</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $row['donor_name']; ?></td>
                <td><?php echo $row['donor_number']; ?></td>
                <td><?php echo $row['donor_mail']; ?></td>
                <td><?php echo $row['donor_age']; ?></td>
                <td><?php echo $row['donor_gender']; ?></td>
                <td><?php echo $row['blood_group']; ?></td>
                <td><?php echo $row['donor_address']; ?></td>
                <td id="he">
                  <a style="background-color:aqua" class="btn btn-sm" href="delete.php?id=<?php echo $row['donor_id']; ?>" onclick="return confirmDelete()">Delete</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <?php } ?>

      <div class="text-center">
        <?php
          $sql1 = "SELECT * FROM donor_details";
          $result1 = mysqli_query($conn, $sql1);
          if (mysqli_num_rows($result1) > 0) {
            $total_records = mysqli_num_rows($result1);
            $total_pages = ceil($total_records / $limit);

            echo '<ul class="pagination">';
            if ($page > 1) {
              echo '<li><a href="donor_list.php?page=' . ($page - 1) . '">Prev</a></li>';
            }
            for ($i = 1; $i <= $total_pages; $i++) {
              $active = ($i == $page) ? 'active' : '';
              echo '<li class="' . $active . '"><a href="donor_list.php?page=' . $i . '">' . $i . '</a></li>';
            }
            if ($total_pages > $page) {
              echo '<li><a href="donor_list.php?page=' . ($page + 1) . '">Next</a></li>';
            }
            echo '</ul>';
          }
        ?>
      </div>

    </div>
  </div>
</div>

<?php } else { ?>
  <div class="alert alert-danger"><b>Please Login First To Access Admin Portal.</b></div>
  <form method="post" action="login.php" class="form-horizontal">
    <div class="form-group">
      <div class="col-sm-8 col-sm-offset-4">
        <button class="btn btn-primary" name="submit" type="submit">Go to Login Page</button>
      </div>
    </div>
  </form>
<?php } ?>

</body>
</html>
