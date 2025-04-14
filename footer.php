<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BloodConnect</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome CDN for Icons -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
  <footer class="bg-[#333] text-white py-12 px-4 sm:px-8 lg:px-20">
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

      <!-- Brand Info -->
      <div>
        <h2 class="text-3xl font-bold text-white">BloodConnect</h2>
        <p class="mt-4 text-sm text-gray-300">
          Your one-stop portal to donate and request blood. Let’s save lives together — one drop at a time.
        </p>
      </div>

      <!-- Navigation -->
      <div>
        <h3 class="text-xl font-semibold text-white mb-4">Quick Links</h3>
        <ul class="space-y-2 text-sm text-gray-200">
          <li><a href="home.php" class="hover:text-yellow-400 transition">Home</a></li>
          <li><a href="about_us.php" class="hover:text-yellow-400 transition">About Us</a></li>
          <li><a href="donate_blood.php" class="hover:text-yellow-400 transition">Donate</a></li>
          <li><a href="contact_us.php" class="hover:text-yellow-400 transition">Contact</a></li>
        </ul>
      </div>

      <!-- Contact Info -->
      <div>
        <h3 class="text-xl font-semibold text-white mb-4">Contact</h3>
        <ul class="space-y-3 text-sm text-gray-200">
          <li><i class="fas fa-phone-alt mr-2 text-yellow-400"></i> +91 6207638763</li>
          <li><i class="fas fa-envelope mr-2 text-yellow-400"></i> support@bloodconnect.com</li>
          <li><i class="fas fa-map-marker-alt mr-2 text-yellow-400"></i> Delhi, India</li>
        </ul>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="mt-12 border-t border-gray-600 pt-6 text-center text-sm text-gray-400">
      &copy; <?php echo date("Y"); ?> BloodConnect. All rights reserved.
      <div class="mt-2 flex justify-center gap-6 text-xl">
        <a href="home.php" class="hover:text-yellow-400"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="hover:text-yellow-400"><i class="fab fa-twitter"></i></a>
        <a href="#" class="hover:text-yellow-400"><i class="fab fa-instagram"></i></a>
        <a href="#" class="hover:text-yellow-400"><i class="fab fa-linkedin"></i></a>
      </div>
    </div>
  </footer>
</body>

</html>
