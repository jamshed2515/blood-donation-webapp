<?php
include 'conn.php';
include 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Query</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    #sidebar {
      position: relative;
      margin-top: -20px;
    }

    #content {
      position: relative;
      margin-left: 210px;
    }

    @media screen and (max-width: 600px) {
      #content {
        margin-left: auto;
        margin-right: auto;
      }
    }

    #he {
      font-size: 14px;
      font-weight: 600;
      text-transform: uppercase;
      padding: 3px 7px;
      color: #fff;
      text-decoration: none;
      border-radius: 3px;
      text-align: center;
    }

    .alert-fixed {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
    }
  </style>
</head>

<body style="color:black">
  <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
    <div id="header">
      <?php include 'header.php'; ?>
    </div>

    <div id="sidebar">
      <?php $active = "query"; include 'sidebar.php'; ?>
    </div>

    <div id="content">
      <div class="content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 lg-12 sm-12">
              <h1 class="page-title">User Query</h1>
            </div>
          </div>
          <hr>

          <?php
          if (isset($_GET['id'])) {
            $que_id = $_GET['id'];
            $sql1 = "UPDATE contact_query SET query_status='1' WHERE query_id={$que_id}";
            $result = mysqli_query($conn, $sql1);
            if ($result) {
              echo '<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><b>Pending Request marked as "Read".</b></div>';
            } else {
              echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><b>Error updating status!</b></div>';
            }
          }

          $limit = 10;
          $page = isset($_GET['page']) ? $_GET['page'] : 1;
          $offset = ($page - 1) * $limit;
          $count = $offset + 1;

          $sql = "SELECT * FROM contact_query LIMIT {$offset}, {$limit}";
          $result = mysqli_query($conn, $sql);
          ?>

          <div class="table-responsive">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th>S.no</th>
                  <th>Name</th>
                  <th>Email Id</th>
                  <th>Mobile Number</th>
                  <th>Message</th>
                  <th>Posting Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                  <tr id="row-<?php echo $row['query_id']; ?>">
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $row['query_name']; ?></td>
                    <td><?php echo $row['query_mail']; ?></td>
                    <td><?php echo $row['query_number']; ?></td>
                    <td><?php echo $row['query_message']; ?></td>
                    <td><?php echo $row['query_date']; ?></td>
                    <td>
                      <?php if ($row['query_status'] == 1) {
                        echo "Read";
                      } else { ?>
                        <a href="query.php?id=<?php echo $row['query_id']; ?>"><b>Pending</b></a>
                      <?php } ?>
                    </td>
                    <td>
                      <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $row['query_id']; ?>">Delete</button>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>

          <div class="text-center">
            <?php
            $sql1 = "SELECT * FROM contact_query";
            $result1 = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($result1) > 0) {
              $total_records = mysqli_num_rows($result1);
              $total_page = ceil($total_records / $limit);
              echo '<ul class="pagination admin-pagination">';
              if ($page > 1) {
                echo '<li><a href="query.php?page=' . ($page - 1) . '">Prev</a></li>';
              }
              for ($i = 1; $i <= $total_page; $i++) {
                $active = ($i == $page) ? "active" : "";
                echo '<li class="' . $active . '"><a href="query.php?page=' . $i . '">' . $i . '</a></li>';
              }
              if ($total_page > $page) {
                echo '<li><a href="query.php?page=' . ($page + 1) . '">Next</a></li>';
              }
              echo '</ul>';
            }
            ?>
          </div>

        </div>
      </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header"><h4 class="modal-title">Confirm Deletion</h4></div>
          <div class="modal-body"><p>Are you sure you want to delete this query?</p></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Success Alert -->
    <div class="alert alert-success alert-fixed fade" id="successAlert">
      <strong>Success!</strong> Query deleted.
    </div>

    <script>
      var deleteId = null;

      $(document).on('click', '.delete-btn', function () {
        deleteId = $(this).data('id');
        $('#deleteModal').modal('show');
      });

      $('#confirmDelete').click(function () {
        $.ajax({
          url: 'delete_query.php',
          method: 'GET',
          data: { id: deleteId },
          success: function (response) {
            if (response.trim() === 'success') {
              $('#row-' + deleteId).fadeOut();
              $('#deleteModal').modal('hide');
              $('#successAlert').addClass('in').show();
              setTimeout(() => {
                $('#successAlert').removeClass('in').hide();
              }, 2000);
            } else {
              alert('Deletion failed.');
            }
          }
        });
      });
    </script>

  <?php } else { ?>
    <div class="alert alert-danger"><b>Please Login First To Access Admin Portal.</b></div>
    <form method="post" action="login.php" class="form-horizontal">
      <div class="form-group">
        <div class="col-sm-8 col-sm-offset-4" style="float:left">
          <button class="btn btn-primary" name="submit" type="submit">Go to Login Page</button>
        </div>
      </div>
    </form>
  <?php } ?>
</body>

</html>
