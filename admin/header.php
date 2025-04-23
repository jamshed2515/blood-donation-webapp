<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Navbar styling */
    .navbar {
      background-color: #333333 !important; /* Set background color to #333333 with !important */
      border: none; /* Ensure no border is applied */
      padding: 12px 15px;
    }

    .navbar a {
      color: white; /* Ensure links are white */
      text-align: center;
      padding: 12px;
      text-decoration: none;
      font-size: 18px;
      line-height: 25px;
    }

    .navbar-brand {
      font-size: 26px;
      font-weight: bold;
      color: #bdc3c7; /* Light gray for the brand name */
      letter-spacing: 2px; /* Add some space between letters for a sleek look */
    }

    /* Dropdown menu */
    .dropdown-menu {
      background-color: #ecf0f1; /* Light gray for the dropdown background */
      border: none;
      min-width: 200px; /* Set minimum width for the dropdown */
    }

    .dropdown-menu li {
      padding: 10px 15px;
      list-style: none;
    }

    .dropdown-menu a {
      color: #2c3e50; /* Dark color for the dropdown items */
      font-size: 16px;
      text-decoration: none;
    }

    .dropdown-menu a:hover {
      color: #e74c3c; /* Coral color on hover */
      background-color: #bdc3c7; /* Subtle gray background on hover */
    }

    /* Dropdown caret color */
    .dropdown-toggle .caret {
      border-top: 5px solid #e74c3c; /* Coral color for the caret */
    }

    /* Ensuring good spacing for mobile responsiveness */
    @media (max-width: 768px) {
      .navbar-nav {
        float: none;
        text-align: center;
      }

      .navbar-nav li {
        display: inline-block;
        margin: 10px 0;
      }

      .navbar-header {
        text-align: center;
      }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" id="qq" href="dashboard.php">Liforce Blood Bank Admin Panel</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a class="dropdown-toggle" id="qw" data-toggle="dropdown" href="#" style="font-weight: bold;">
          <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;
          <?php
          include 'conn.php';
          $username = $_SESSION['username'];
          $sql = "SELECT * FROM admin_info WHERE admin_username='$username'";
          $result = mysqli_query($conn, $sql) or die("Query failed.");
          $row = mysqli_fetch_assoc($result);
          echo $row['admin_name'];
          ?>
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="change_password.php">Change Password</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>

</body>
</html>
