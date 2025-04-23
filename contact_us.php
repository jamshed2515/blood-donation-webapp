<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Get in touch with us">
  <title>Contact Us</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Merriweather:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f1f5f9;
      color: #1f2937;
    }
    h1, h2, h3 {
      font-family: 'Merriweather', serif;
      color: #111827;
    }
    h1.text-center {
      font-size: 2.8rem;
      font-weight: bold;
      padding-bottom: 10px;
      border-bottom: 3px solid #1f2937;
      width: fit-content;
      margin: 0 auto 40px auto;
    }
    .form-control {
      border-radius: 12px;
      border: 1px solid #d1d5db;
      box-shadow: none;
    }
    .btn-primary {
      background-color: #111827;
      border: none;
      border-radius: 12px;
      padding: 10px 20px;
      font-size: 14px;
    }
    .btn-primary:hover {
      background-color: #1f2937;
    }
    .contact-box, .contact-details {
      background-color: #fff;
      padding: 35px;
      border-radius: 18px;
      box-shadow: 0 6px 25px rgba(0,0,0,0.08);
      height: 100%;
    }
    .contact-details {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .contact-details h3 {
      font-size: 1.5rem;
      margin-bottom: 20px;
      border-bottom: 2px solid #1f2937;
      padding-bottom: 5px;
      width: fit-content;
    }
    .contact-details p {
      margin-bottom: 15px;
      color: #4b5563;
    }
    label i {
      margin-right: 8px;
      color: #111827;
    }
    .alert-success {
      margin: 20px auto;
      width: 85%;
    }
    a {
      color: #111827;
    }
    a:hover {
      text-decoration: underline;
    }
    .contact-map {
      margin-top: 20px;
    }
    iframe {
      border: none;
      width: 100%;
      height: 250px;
      border-radius: 12px;
    }
  </style>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function() {
      $("form[name='sentMessage']").submit(function(event) {
        const name = $("#name").val();
        const phone = $("#phone").val();
        const email = $("#email").val();
        const message = $("#message").val();
        const namePattern = /^[a-zA-Z\s]+$/;
        const phonePattern = /^[6-9][0-9]{9}$/;
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (!name || !namePattern.test(name)) {
          alert("Please enter a valid name (letters and spaces only).")
          $("#name").focus();
          event.preventDefault(); return false;
        }
        if (!phonePattern.test(phone)) {
          alert("Please enter a valid 10-digit phone number.");
          $("#phone").focus(); event.preventDefault(); return false;
        }
        if (!emailPattern.test(email)) {
          alert("Please enter a valid email address.");
          $("#email").focus(); event.preventDefault(); return false;
        }
        if (!message) {
          alert("Please enter your message.");
          $("#message").focus(); event.preventDefault(); return false;
        }
      });
    });
  </script>
</head>
<body>
<?php $active ='contact'; include 'head.php'; ?>
<?php
if(isset($_POST["send"])){
  $name=$_POST['fullname'];
  $number=$_POST['contactno'];
  $email=$_POST['email'];
  $message=$_POST['message'];
  $conn=mysqli_connect("localhost","root","","blood_bank") or die("Connection error");
  $sql= "INSERT INTO contact_query (query_name,query_mail,query_number,query_message) VALUES('{$name}','{$email}','{$number}','{$message}')";
  $result=mysqli_query($conn,$sql) or die("Query unsuccessful.");
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Query Sent!</strong> We will contact you shortly.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
}
?>
<div class="container my-5">
  <h1 class="text-center">Contact Us</h1>
  <div class="row">
    <div class="col-lg-7 mb-4">
      <div class="contact-box h-100">
        <h3 class="mb-4">Send us a Message</h3>
        <form name="sentMessage" method="post">
          <div class="form-group">
            <label for="name"><i class="fas fa-user"></i> Full Name</label>
            <input type="text" class="form-control" id="name" name="fullname" required>
          </div>
          <div class="form-group">
            <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="contactno" required>
          </div>
          <div class="form-group">
            <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="message"><i class="fas fa-comment-dots"></i> Message</label>
            <textarea rows="6" class="form-control" id="message" name="message" required maxlength="999" style="resize:none;"></textarea>
          </div>
          <button type="submit" name="send" class="btn btn-primary">Send</button>
        </form>
      </div>
    </div>
    <div class="col-lg-5 mb-4">
      <div class="contact-details h-100">
        <h3>Contact Details</h3>
        <?php
        $conn=mysqli_connect("localhost","root","","blood_bank") or die("Connection error");
        $sql= "SELECT * FROM contact_info";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0) {
          while($row = mysqli_fetch_assoc($result)) {
        ?>
        <p><i class="fas fa-map-marker-alt"></i> <strong>Address:</strong><br> <?php echo $row['contact_address']; ?></p>
        <p><i class="fas fa-envelope"></i> <strong>Email:</strong><br> <a href="mailto:<?php echo $row['contact_mail']; ?>"><?php echo $row['contact_mail']; ?></a></p>
        <p><i class="fas fa-phone-alt"></i> <strong>Contact Number:</strong><br> <?php echo $row['contact_phone']; ?></p>
        <div class="contact-map">
          <iframe src="https://maps.google.com/maps?q=<?php echo urlencode($row['contact_address']); ?>&output=embed"></iframe>
        </div>
        <?php }} ?>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php' ?>
</body>
</html>