<!DOCTYPE html>
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

    .card-icon {
      width: 20px;
      height: 20px;
      margin-right: 8px;
    }

    /* Updated styles */
    .btn-search {
      background-color: #007bff;
      color: white;
      font-weight: bold;
      border-radius: 4px;
      padding: 12px;
      border: none;
      transition: background-color 0.3s ease;
    }

    .btn-search:hover {
      background-color: #0056b3;
    }

    /* Updated form styling */
    .form-container {
      background-color: #f8f9fa;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-container .form-group {
      margin-bottom: 15px;
    }

    .form-container select, .form-container textarea {
      border-radius: 5px;
      padding: 12px;
      border: 1px solid #ced4da;
      width: 100%;
    }

    .form-container label {
      font-weight: 500;
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

      <div class="flex justify-center items-center h-24 mt-1">
        <h1 class="text-lg sm:text-4xl md:text-5xl font-semibold text-#333 text-center leading-tight">
          Need Blood
        </h1>
      </div>





        <form name="needblood" action="" method="post">
          <div class="row justify-content-center">
            <div class="col-lg-6 mb-4">
              <div class="form-container">
                <div class="form-group">
                  <label for="blood">Blood Group <span style="color:red">*</span></label>
                  <select name="blood" id="blood" required>
                    <option value="" selected disabled>Select Blood Group</option>
                    <?php
                      include 'conn.php';
                      $sql = "SELECT * FROM blood";
                      $result = mysqli_query($conn, $sql) or die("query unsuccessful.");
                      while($row = mysqli_fetch_assoc($result)) {
                    ?>
                      <option value="<?php echo $row['blood_id']; ?>"><?php echo $row['blood_group']; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="address">Reason (Why do you need blood?) <span style="color:red">*</span></label>
                  <textarea class="form-control" name="address" id="address" required></textarea>
                </div>

                <div class="form-group text-center">
                  <input type="submit" name="search" class="btn-search w-100" value="Search" style="cursor:pointer">
                </div>
              </div>
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
                  $bgColor = 'bg-red-500';
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
                    <svg class="card-icon text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.684l1.5 4.493a1 1 0 01-.5 1.21l-2.26 1.13a11.042 11.042 0 005.52 5.516l1.13-2.257a1 1 0 011.21-.502l4.49 1.5a1 1 0 01.69.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <?php echo $row['donor_number']; ?>
                  </div>

                  <div class="flex items-center gap-2">
                    <svg class="card-icon text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <?php echo $row['donor_gender']; ?>, <?php echo $row['donor_age']; ?> years
                  </div>

                  <div class="flex items-center gap-2">
                    <svg class="card-icon text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <?php echo $row['donor_address']; ?>
                  </div>
                </div>

                <div class="px-4 pb-4">
                  <a href="https://wa.me/91<?php echo $row['donor_number']; ?>?text=<?php echo urlencode('Hi, I found your profile on the LiForce Blood Bank website. I would like to connect with you regarding a blood donation.'); ?>" target="_blank">
                    <button class="w-full text-sm font-semibold border border-red-500 text-red-500 rounded-md py-2 hover:bg-red-500 hover:text-white transition duration-200">
                      Contact Donor
                    </button>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <?php 
                }
              } else {
                echo '<div class="col-12 flex justify-center items-center mt-4">
        <p class="text-center text-gray-600 text-lg font-medium">
            No donors available for the selected blood group.
        </p>
      </div>';

              }
            }
          ?>
        </div>
      </div>
    </div>
  </div>

  <?php include('footer.php'); ?>
</body>

</html>
