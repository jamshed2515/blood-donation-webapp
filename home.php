<?php
$active = "home";
include('head.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LifeShare - Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .carousel-slide {
            transition: transform 1s ease-in-out;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-b from-red-50 to-white text-gray-800">

<!-- Hero Carousel -->
<div class="relative w-full h-[400px] overflow-hidden rounded-b-3xl shadow-xl">
    <div class="absolute inset-0 bg-black/30 z-10 flex items-center justify-center">
        <div class="text-center px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg">
                <span class="text-red-500">Life</span>Share
            </h1>
            <p class="text-base md:text-lg text-white max-w-3xl mx-auto drop-shadow-md">
                Connecting donors with those in need, one drop at a time.
            </p>
            <button onclick="window.location.href='donate_blood.php';"
                class="mt-6 !bg-red-600 hover:!bg-red-700 text-white px-6 py-2 text-sm rounded-full shadow-lg transition duration-300 hover:scale-105">
                Become a Donor Today
            </button>
        </div>
    </div>

    <!-- Carousel Container -->
    <div id="carousel" class="relative w-full h-full flex transition-all duration-500 ease-in-out">
        <img src="https://images.unsplash.com/photo-1615461066841-6116e61058f4?auto=format&fit=crop&w=1674&q=80" class="w-full h-full object-cover flex-shrink-0" />
        <img src="https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=1470&q=80" class="w-full h-full object-cover flex-shrink-0" />
    </div>

    <!-- Navigation Dots -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 z-20 flex space-x-2">
        <button onclick="setSlide(0)" class="w-3 h-3 rounded-full bg-white scale-125" id="dot0"></button>
        <button onclick="setSlide(1)" class="w-3 h-3 rounded-full bg-white/50" id="dot1"></button>
    </div>
</div>


<script>
  let currentIndex = 0;
  const slides = document.querySelectorAll('#carousel img');
  const dots = document.querySelectorAll('.absolute button');

  function setSlide(index) {
    currentIndex = index;
    const carousel = document.getElementById('carousel');
    carousel.style.transform = `translateX(-${100 * currentIndex}%)`;

    // Update dots
    dots.forEach((dot, idx) => {
      if (idx === currentIndex) {
        dot.classList.add('bg-white');
        dot.classList.remove('bg-white/50');
      } else {
        dot.classList.add('bg-white/50');
        dot.classList.remove('bg-white');
      }
    });
  }

  // Set initial slide
  setSlide(0);
</script>


<!-- Info Cards Section -->
<div class="w-full px-6 py-16">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10">
        <?php
        $cards = [
            [
                "title" => "The Need for Blood",
                "desc" => "Every two seconds, someone in the world needs blood. Blood is essential for surgeries, cancer treatment, chronic illnesses, and traumatic injuries. One donation can save up to three lives, yet less than 10% of eligible people donate blood yearly. Your contribution is vital to maintaining a healthy and reliable blood supply.",
                "color" => "from-red-600 to-red-500"
            ],
            [
                "title" => "Blood Donation Tips",
                "desc" => "Before donating: Get a good night's sleep, eat a healthy meal, and drink extra water. Bring ID and list of medications you're taking. During donation: Relax, squeeze a stress ball, and notify staff of any discomfort. After donating: Rest for 15 minutes, have a snack, drink extra fluids, and avoid strenuous activities for 24 hours.",
                "color" => "from-red-500 to-red-400"
            ],
            [
                "title" => "Who You Could Help",
                "desc" => "Your blood donation can help accident victims, surgery patients, cancer patients, children with severe anemia, women with complications during childbirth, and people with blood disorders. Each component of your donation—red cells, platelets, and plasma—can be used for different medical treatments, maximizing the impact of your generosity.",
                "color" => "from-red-400 to-red-300"
            ]
        ];

        foreach ($cards as $card) {
            echo "
            <div class='bg-white/80 backdrop-blur-sm rounded-lg shadow-lg hover:shadow-xl transition-all overflow-hidden'>
                <div class='bg-gradient-to-r {$card['color']} text-white p-4'>
                    <h3 class='text-xl font-semibold'>{$card['title']}</h3>
                </div>
                <div class='p-4 h-[120px] overflow-auto text-gray-700 text-sm'>
                    {$card['desc']}
                </div>
            </div>
            ";
        }
        ?>
    </div>
</div>

<!-- Hero Donors Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 mt-[-4rem]">
<h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">
  <span class="border-b-4 border-red-500 pb-1">Our Hero Donors</span>
</h2>


  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php
    include 'conn.php';
    $sql = "SELECT * FROM donor_details JOIN blood ON donor_details.donor_blood = blood.blood_id ORDER BY RAND() LIMIT 6";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while ($donor = mysqli_fetch_assoc($result)) {
        $bloodGroup = $donor['blood_group'];
        $bg = "bg-red-500";
        if (strpos($bloodGroup, 'AB') !== false) $bg = "bg-purple-500";
        else if (strpos($bloodGroup, 'A') !== false) $bg = "bg-blue-500";
        else if (strpos($bloodGroup, 'B') !== false) $bg = "bg-green-500";
    ?>
        <div class="group">
          <div class="rounded-lg overflow-hidden bg-white/80 backdrop-blur-sm shadow-sm hover:shadow-md transition-all transform hover:-translate-y-1 duration-200 h-[340px] flex flex-col justify-between">
            
            <!-- Increased top section height -->
            <div class="relative h-48 bg-red-100 flex items-center justify-center">
              <div class="absolute w-16 h-16 rounded-full flex items-center justify-center text-xl font-bold text-white <?php echo $bg; ?>">
                <?php echo $bloodGroup; ?>
              </div>
              <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent px-4 py-3">
                <h3 class="text-lg font-semibold text-white"><?php echo $donor['donor_name']; ?></h3>
              </div>
            </div>

            <!-- Bottom details -->
            <div class="px-4 py-2 text-sm text-gray-700 space-y-1">
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.684l1.5 4.493a1 1 0 01-.5 1.21l-2.26 1.13a11.042 11.042 0 005.52 5.516l1.13-2.257a1 1 0 011.21-.502l4.49 1.5a1 1 0 01.69.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <?php echo $donor['donor_number']; ?>
              </div>

              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <?php echo $donor['donor_gender']; ?>, <?php echo $donor['donor_age']; ?> years
              </div>

              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <?php echo $donor['donor_address']; ?>
              </div>
            </div>

            <div class="px-4 pb-4">
              <a href="https://wa.me/91<?php echo $donor['donor_number']; ?>?text=<?php echo urlencode('Hi, I found your profile on the LiForce Blood Bank website. I would like to connect with you regarding a blood donation.'); ?>" target="_blank">
                  <button class="w-full text-sm font-semibold border border-red-500 text-red-500 rounded-md py-2 hover:bg-red-500 hover:text-white transition duration-200">
                      Contact Donor
                  </button>
              </a>


            </div>
          </div>
        </div>
    <?php }
    } ?>
  </div>
</div>



<!-- Blood Type Info Section -->
<section class="flex items-center justify-between p-10 bg-[#fff7f6] rounded-lg m-8">
  <div class="flex-1 pr-10">
    <h2 class="text-3xl font-bold text-[#121212] mb-2">
      <span class="border-b-4 border-red-500">Blood Groups</span>
    </h2>
    <p class="text-base leading-6 text-[#333] mb-8">
      There are four main blood groups (types of blood) – A, B, AB, and O. Your blood group is determined by the genes you inherit from your parents. Each group can be either RhD positive or RhD negative, which means in total there are eight main blood groups.
    </p>
    <div class="grid grid-cols-4 gap-4">
      <button class="py-4 font-bold text-lg border-none rounded-xl bg-white text-[#356af4] shadow-md transition-transform duration-200 hover:scale-105">A+</button>
      <button class="py-4 font-bold text-lg border-none rounded-xl bg-white text-[#356af4] shadow-md transition-transform duration-200 hover:scale-105">A-</button>
      <button class="py-4 font-bold text-lg border-none rounded-xl bg-white text-green-500 shadow-md transition-transform duration-200 hover:scale-105">B+</button>
      <button class="py-4 font-bold text-lg border-none rounded-xl bg-white text-green-500 shadow-md transition-transform duration-200 hover:scale-105">B-</button>
      <button class="py-4 font-bold text-lg border-none rounded-xl bg-white text-[#356af4] shadow-md transition-transform duration-200 hover:scale-105">AB+</button>
      <button class="py-4 font-bold text-lg border-none rounded-xl bg-white text-[#356af4] shadow-md transition-transform duration-200 hover:scale-105">AB-</button>
      <button class="py-4 font-bold text-lg border-none rounded-xl bg-white text-red-500 shadow-md transition-transform duration-200 hover:scale-105">O+</button>
      <button class="py-4 font-bold text-lg border-none rounded-xl bg-white text-red-500 shadow-md transition-transform duration-200 hover:scale-105">O-</button>
    </div>
  </div>
  <div class="flex-1">
    <img src="//images.unsplash.com/photo-1614574762522-6ac2fbba2208?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
 alt="Man with sunset background" class="w-full h-auto rounded-lg">
  </div>
</section>


<!-- Universal Donors and Recipients -->
<div class="bg-red-500 p-10 rounded-lg m-8">
  <h2 class="text-3xl font-bold text-center text-white mb-4">
    <span class="border-b-4 border-white pb-1">Universal Donors & Recipients</span>
  </h2>
  <p class="text-base text-center max-w-3xl mx-auto text-white mb-6">
    People with <span class="font-semibold">O negative</span> blood are universal donors. This means they can donate red blood cells to anybody, making them crucial in emergencies. People with <span class="font-semibold">AB positive</span> blood are universal recipients, meaning they can receive red blood cells from any blood type.
  </p>

  <div class="grid sm:grid-cols-2 gap-6 text-center">
    <div class="p-6 border rounded-lg bg-red-400 shadow-sm text-white">
      <h3 class="text-lg font-semibold mb-2">Universal Donor</h3>
      <div class="text-3xl font-bold mb-2">O-</div>
      <p class="text-base">Can donate to all blood types</p>
    </div>
    <div class="p-6 border rounded-lg bg-red-400 shadow-sm text-white">
      <h3 class="text-lg font-semibold mb-2">Universal Recipient</h3>
      <div class="text-3xl font-bold mb-2">AB+</div>
      <p class="text-base">Can receive from all blood types</p>
    </div>
  </div>

  <div class="text-center mt-10">
    <a href="donate_blood.php" class="inline-block bg-white text-red-600 text-base font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 hover:shadow-lg hover:scale-105">
      Become a Donor Today
    </a>
  </div>
</div>


<!-- Donor Statistics Section -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 mb-16 px-6">
    <?php
    $stats = [
        ["value" => "4.5M", "label" => "Indians need blood yearly"],
        ["value" => "3", "label" => "Lives saved with one donation"],
        ["value" => "1", "label" => "Pint of blood per donation"],
        ["value" => "56", "label" => "Days until you can donate again"]
    ];

    foreach ($stats as $stat) {
        echo "
        <div class='bg-gradient-to-b from-red-50 to-white text-center border-none shadow-lg hover:shadow-xl transition-all duration-300 p-4 rounded-lg h-28'>
            <div class='text-4xl font-bold text-red-500 mb-2'>{$stat['value']}</div>
            <p class='text-sm text-gray-600'>{$stat['label']}</p>
        </div>
        ";
    }
    ?>
</div>



<!-- CTA Section -->
<div class="text-center space-y-3 mb-16">
  <h2 class="text-2xl font-bold text-gray-800">Ready to Save Lives?</h2>
  <p class="text-base text-gray-600 max-w-3xl mx-auto">
    Your donation can be the difference between life and death for someone in need.
    Join our community of heroes today.
  </p>
  <button onclick="window.location.href='donate_blood.php';" class="mt-4 bg-red-600 hover:bg-red-700 text-white px-6 py-2 text-base rounded-full border-2 border-red-600 shadow-md transform hover:scale-105 transition-all duration-300">
    Become a Donor now
  </button>
</div>


<script>
    let currentSlide = 0;
    function setSlide(index) {
        currentSlide = index;
        document.getElementById("carousel").style.transform = `translateX(-${index * 100}%)`;
        document.getElementById("dot0").classList.toggle("bg-white", index === 0);
        document.getElementById("dot0").classList.toggle("bg-white/50", index !== 0);
        document.getElementById("dot1").classList.toggle("bg-white", index === 1);
        document.getElementById("dot1").classList.toggle("bg-white/50", index !== 1);
    }

    setInterval(() => {
        currentSlide = (currentSlide + 1) % 2;
        setSlide(currentSlide);
    }, 5000);
</script>
<?php include('footer.php'); ?>

</body>
</html>
