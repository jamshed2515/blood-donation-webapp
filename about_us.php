<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="About Liforce Blood Bank and Donor Management System">
    <meta name="author" content="Liforce">
    <title>About Us | Liforce Blood Bank</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Merriweather:wght@700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gray-100 font-roboto">

<?php 
$active = 'about';
include('head.php');
?>

<!-- About Us Section -->
<div class="pt-20 pb-20">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-stretch shadow-lg rounded-xl overflow-hidden bg-white">
            <!-- Text Section -->
            <div class="lg:w-1/2 p-10">
                <h1 class="text-3xl font-merriweather text-gray-800 mb-4">About Liforce Blood Bank</h1>
                <p class="text-lg text-gray-700 mb-4">Liforce Blood Bank is dedicated to saving lives by providing a steady and reliable supply of blood to hospitals in need. We believe in the power of community and the importance of selfless donation in the fight against medical emergencies, surgeries, and blood-related illnesses.</p>

                <p class="text-lg text-gray-700 mb-4">We are committed to making blood donation accessible to everyone. Through our platform, blood donors can easily connect with our blood bank and contribute to life-saving efforts in their community.</p>

                <h2 class="text-xl font-merriweather text-gray-800 mt-6 mb-4">Our Mission</h2>
                <p class="text-lg text-gray-700 mb-4">Our mission is to ensure the availability of blood for every patient in need, whenever and wherever required. By working with volunteers, healthcare providers, and donors, we aim to create a world where no one suffers due to a lack of blood.</p>

                <h2 class="text-xl font-merriweather text-gray-800 mt-6 mb-4">Our Vision</h2>
                <p class="text-lg text-gray-700 mb-4">We envision a world with a safe and sustainable blood supply that saves lives every day. Our goal is to educate and inspire individuals to donate blood regularly, ensuring that we can provide a constant supply to those who need it most.</p>

                <h2 class="text-xl font-merriweather text-gray-800 mt-6 mb-4">Why Donate Blood?</h2>
                <ul class="list-disc list-inside text-lg text-gray-700">
                    <li><strong>Save Lives:</strong> Each donation can save up to three lives.</li>
                    <li><strong>Low Risk:</strong> Blood donation is a safe and simple procedure.</li>
                    <li><strong>Health Benefits:</strong> Regular donation helps improve your overall health and well-being.</li>
                </ul>
            </div>

            <!-- Image Section -->
            <div class="lg:w-1/2 h-auto">
                <img class="w-full h-full object-cover object-center" src="image/aboutUs.jpg" alt="Blood Donation">
            </div>
        </div>
    </div>
</div>

<!-- Team Section -->
<div class="bg-gray-200 py-16">
    <div class="max-w-screen-xl mx-auto px-4">
        <h2 class="text-3xl font-merriweather text-center text-gray-800 mb-12">Meet Our Team</h2>
        <div class="flex flex-wrap justify-evenly">
            <!-- Team Member 1 -->
            <div class="w-1/4 mb-8 text-center">
                <div class="team-member">
                    <img class="rounded-full w-32 h-32 mx-auto mb-4" src="https://www.w3schools.com/w3images/avatar2.png" alt="Team Member">
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Sheikh Jamshed</h4>
                    <p class="text-gray-600">Blood Donation Coordinator</p>
                </div>
            </div>
            <!-- Team Member 2 -->
            <div class="w-1/4 mb-8 text-center">
                <div class="team-member">
                    <img class="rounded-full w-32 h-32 mx-auto mb-4" src="https://www.w3schools.com/w3images/avatar3.png" alt="Team Member">
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Bhavishya Kumar</h4>
                    <p class="text-gray-600">Community Outreach Specialist</p>
                </div>
            </div>
            <!-- Team Member 3 -->
            <div class="w-1/4 mb-8 text-center">
                <div class="team-member">
                    <img class="rounded-full w-32 h-32 mx-auto mb-4" src="https://www.w3schools.com/w3images/avatar3.png" alt="Team Member">
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Tanish Sood</h4>
                    <p class="text-gray-600">Medical Support Officer</p>
                </div>
            </div>
            <!-- Team Member 4 -->
            <div class="w-1/4 mb-8 text-center">
                <div class="team-member">
                    <img class="rounded-full w-32 h-32 mx-auto mb-4" src="https://www.w3schools.com/w3images/avatar2.png" alt="Team Member">
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Aditya Singh</h4>
                    <p class="text-gray-600">Operations Manager</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include('footer.php'); ?>

</body>
</html>
