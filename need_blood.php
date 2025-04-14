<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Merriweather:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .bg-purple {
      background-color: #6f42c1 !important;
    }

    .blood-card {
      transition: all 0.2s ease-in-out;
      transform: translateY(0);
      height: 340px;
      margin-bottom: 20px;
    }

    .blood-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .blood-group {
      width: 64px;
      height: 64px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 20px;
      font-weight: bold;
      color: white;
    }

    .blood-card-header {
      position: relative;
      height: 48%;
      background: rgba(255, 0, 0, 0.1);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .blood-card-body {
      padding: 16px;
      font-size: 14px;
      color: #4A4A4A;
    }

    .contact-button {
      width: 100%;
      font-weight: bold;
      border: 1px solid #e53946;
      color: #e53946;
      border-radius: 4px;
      padding: 12px;
      transition: 0.3s;
    }

    .contact-button:hover {
      background-color: #e53946;
      color: white;
    }

    .text-center {
      text-align: center;
    }
    
    /* Adjust icons to smaller size */
    .card-icon {
      width: 20px;
      height: 20px;
      margin-right: 8px;
    }
  </style>
</head>

<body>
  <?php 
  $active = 'need';
  include('head.php');
  ?>

  <div id="page-container" style="margin-top:50px; position: relative; min-height: 84vh;">
    <div class="container">
      <div id="content-wrap" style="padding-bottom:50px;">

        <div class="row">
          <div class="col-lg-6">
            <h1 class="mt-4 mb-3">Need Blood</h1>
          </div>
        </div>

        <form name="needblood" action="" method="post">
          <div class="row">
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Blood Group<span style="color:red">*</span></div>
              <div><select name="blood" class="form-control" required>
                <option value="" selected disabled>Select</option>
                <?php
                  include 'conn.php';
                  $sql = "select * from blood";
                  $result = mysqli_query($conn, $sql) or die("query unsuccessful.");
                while($row = mysqli_fetch_assoc($result)) {
                ?>
                <option value="<?php echo $row['blood_id']; ?>"><?php echo $row['blood_group']; ?></option>

                <?php } ?>
              </select></div>
            </div>

            <div class="col-lg-4 mb-4">
              <div class="font-italic">Reason, why do you need blood?<span style="color:red">*</span></div>
              <div><textarea class="form-control" name="address" required></textarea></div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4 mb-4">
              <div><input type="submit" name="search" class="btn btn-primary" value="Search" style="cursor:pointer"></div>
            </div>
          </div>
        </form>

        <div class="row">
          <?php 
          if (isset($_POST['search'])) {
            $bg = $_POST['blood'];
            $sql = "SELECT * FROM donor_details 
                    JOIN blood ON donor_details.donor_blood = blood.blood_id 
                    WHERE donor_blood = '{$bg}' 
                    ORDER BY RAND() 
                    LIMIT 5";
            $result = mysqli_query($conn, $sql) or die("Query unsuccessful.");

            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $bloodGroup = $row['blood_group'];
                $bgColor = 'bg-red-500'; // default red
                if (strpos($bloodGroup, 'AB') !== false) $bgColor = 'bg-purple-500';
                else if (strpos($bloodGroup, 'A') !== false) $bgColor = 'bg-blue-500';
                else if (strpos($bloodGroup, 'B') !== false) $bgColor = 'bg-green-500';
          ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="group blood-card">
              <div class="rounded-lg overflow-hidden bg-white/80 backdrop-blur-sm shadow-sm hover:shadow-md transition-all transform hover:-translate-y-1 duration-200 h-[340px] flex flex-col justify-between">
                
                <div class="blood-card-header">
                  <div class="absolute w-16 h-16 rounded-full flex items-center justify-center text-xl font-bold text-white <?php echo $bgColor; ?>">
                    <?php echo $bloodGroup; ?>
                  </div>
                  <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent px-4 py-3">
                    <h3 class="text-lg font-semibold text-white"><?php echo $row['donor_name']; ?></h3>
                  </div>
                </div>

                <div class="blood-card-body">
                  <div class="flex items-center gap-2">
                    <svg class="card-icon text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.684l1.5 4.493a1 1 0 01-.5 1.21l-2.26 1.13a11.042 11.042 0 005.52 5.516l1.13-2.257a1 1 0 011.21-.502l4.49 1.5a1 1 0 01.69.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <?php echo $row['donor_number']; ?>
                  </div>

                  <div class="flex items-center gap-2">
                    <svg class="card-icon text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <?php echo $row['donor_gender']; ?>, <?php echo $row['donor_age']; ?> years
                  </div>

                  <div class="flex items-center gap-2">
                    <svg class="card-icon text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <?php echo $row['donor_address']; ?>
                  </div>
                </div>

                <div class="px-2 pb-2">
                  <a href="tel:<?php echo $row['donor_number']; ?>" class="contact-button text-center d-block text-decoration-none">
                    Contact Donor
                  </a>

                </div>
              </div>
            </div>
          </div>
          <?php 
              }
            } else {
              echo '<div class="col-12"><div class="alert alert-danger">No Donor Found For your searched Blood Group</div></div>';
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer Section -->
  <?php include('footer.php'); ?>

</body>

</html>