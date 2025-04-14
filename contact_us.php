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
  <link rel="stylesheet" href="contact_us.css">


  <script>
  $(document).ready(function() {
    $("form[name='sentMessage']").submit(function(event) {
      // Validate Full Name (Only letters and spaces allowed)
      var name = $("#name").val();
      var namePattern = /^[a-zA-Z\s]+$/;  // Accepts only letters and spaces
      if (name == "" || !namePattern.test(name)) {
        alert("Please enter a valid name (letters and spaces only).");
        $("#name").focus();
        event.preventDefault();
        return false;
      }

      // Validate Phone Number
      var phone = $("#phone").val();
      var phonePattern = /^[0-9]{10}$/; // 10 digits
      if (!phonePattern.test(phone)) {
        alert("Please enter a valid 10-digit phone number.");
        $("#phone").focus();
        event.preventDefault();
        return false;
      }

      // Validate Email
      var email = $("#email").val();
      var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        $("#email").focus();
        event.preventDefault();
        return false;
      }

      // Validate Message
      var message = $("#message").val();
      if (message == "") {
        alert("Please enter your message.");
        $("#message").focus();
        event.preventDefault();
        return false;
      }
    });
  });
</script>

  
</head>

<body>
<?php $active ='contact';
include 'head.php'; ?>
<?php
if(isset($_POST["send"])){
  $name=$_POST['fullname'];
$number=$_POST['contactno'];
$email=$_POST['email'];
$message=$_POST['message'];
$conn=mysqli_connect("localhost","root","","blood_bank") or die("Connection error");
$sql= "insert into contact_query (query_name,query_mail,query_number,query_message) values('{$name}','{$email}','{$number}','{$message}')";
$result=mysqli_query($conn,$sql) or die("query unsuccessful.");
  echo '<div class="alert alert-success alert_dismissible"><b><button type="button" class="close" data-dismiss="alert">&times;</button></b><b>Query Sent, We will contact you shortly. </b></div>';
}?>

<div id="page-container" style="margin-top:50px; position: relative;min-height: 84vh;">
  <div class="container">
  <div id="content-wrap" style="padding-bottom:50px;">
    <h1 class="mt-4 mb-3">Contact</h1>
    <div class="row">
      <div class="col-lg-8 mb-4">
        <h3>Send us a Message</h3>
        <form name="sentMessage"  method="post">
            <div class="control-group form-group">
                <div class="controls">
                    <label><i class="fas fa-user"></i> Full Name:</label>
                    <input type="text" class="form-control" id="name" name="fullname" required>
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label><i class="fas fa-phone"></i> Phone Number:</label>
                    <input type="tel" class="form-control" id="phone" name="contactno"  required >
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label><i class="fas fa-envelope"></i> Email Address:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label><i class="fas fa-comment-dots"></i> Message:</label>
                    <textarea rows="10" cols="100" class="form-control" id="message" name="message" required  maxlength="999" style="resize:none"></textarea>
                </div>
            </div>
            <button type="submit" name="send"  class="btn btn-primary">Send Message</button>
        </form>
    </div>
    <div class="col-lg-4 mb-4">
        <h2>Contact Details</h2>
        <?php
          include 'conn.php';
          $sql= "select * from contact_info";
          $result=mysqli_query($conn,$sql);
          if(mysqli_num_rows($result)>0)   {
              while($row = mysqli_fetch_assoc($result)) { ?>
        <br>
        <p><i class="fas fa-map-marker-alt"></i> <strong>Address:</strong><br> <?php echo $row['contact_address']; ?></p>
        <p><i class="fas fa-phone-alt"></i> <strong>Contact Number:</strong><br> <?php echo $row['contact_phone']; ?></p>
        <p><i class="fas fa-envelope"></i> <strong>Email:</strong><br> <a href="#"><?php echo $row['contact_mail']; ?></a></p>

        <?php }
      } ?>
    </div>
</div>


</div>
</div>
<?php include 'footer.php' ?>
</div>
</body>

</html>
