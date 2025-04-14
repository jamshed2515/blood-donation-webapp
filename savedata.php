<?php
session_start();  


$name = $_POST['fullname'];
$number = $_POST['mobileno'];
$email = $_POST['emailid'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$blood_group = $_POST['blood'];
$address = $_POST['address'];

$conn = mysqli_connect("localhost", "root", "", "blood_bank") or die("Connection error");

$sql = "INSERT INTO donor_details(donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address) 
        VALUES ('{$name}', '{$number}', '{$email}', '{$age}', '{$gender}', '{$blood_group}', '{$address}')";

if (mysqli_query($conn, $sql)) {
    $_SESSION['success_message'] = "Your donation details have been successfully submitted!";
} else {
    $_SESSION['error_message'] = "There was an error submitting your details. Please try again.";
}

mysqli_close($conn);

header("Location: http://localhost/LiForceCopy/donate_blood.php");
exit();
?>
