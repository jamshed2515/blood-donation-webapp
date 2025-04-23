<?php
$bg = trim($_POST['blood']);

$conn = mysqli_connect("localhost", "root", "", "blood_donation") or die("Connection error");

// Ensure $bg is sanitized to avoid SQL injection
$bg = mysqli_real_escape_string($conn, $bg);

// Fetching donors who match the selected blood group
$sql = "SELECT * 
        FROM donor_details d
        JOIN blood b ON d.donor_blood = b.blood_id
        WHERE d.donor_blood = '{$bg}'
        ORDER BY RAND() LIMIT 5";  // Fetch random donors

$result = mysqli_query($conn, $sql) or die("Query unsuccessful.");

if (mysqli_num_rows($result) > 0) {
    echo '<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">
                <span class="border-b-4 border-red-500 pb-1">Available Donors</span>
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">';

    // Blood group color mapping
    $bloodGroupColors = [
        'AB' => 'bg-purple-500',
        'A' => 'bg-blue-500',
        'B' => 'bg-green-500',
        'O' => 'bg-red-500'
    ];

    while ($donor = mysqli_fetch_assoc($result)) {
        $bloodGroup = $donor['blood_group'];  // Blood group from 'blood' table
        // Choose the color dynamically based on blood group
        $bgColor = isset($bloodGroupColors[$bloodGroup]) ? $bloodGroupColors[$bloodGroup] : 'bg-red-500';

        // Correct WhatsApp link creation
        $donorNumber = $donor['donor_number'];  // Assuming this is the phone number
        $whatsappLink = "https://wa.me/91{$donorNumber}?text=" . urlencode('Hi, I found your profile on the LiForce Blood Bank website. I would like to connect with you regarding a blood donation.');

        echo "
        <div class='group'>
          <div class='rounded-lg overflow-hidden bg-white/80 backdrop-blur-sm shadow-sm hover:shadow-md transition-all transform hover:-translate-y-1 duration-200 h-[340px] flex flex-col justify-between'>
            
            <div class='relative h-48 bg-red-100 flex items-center justify-center'>
              <div class='absolute w-16 h-16 rounded-full flex items-center justify-center text-xl font-bold text-white $bgColor'>
                $bloodGroup
              </div>
              <div class='absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent px-4 py-3'>
                <h3 class='text-lg font-semibold text-white'>{$donor['donor_name']}</h3>
              </div>
            </div>

            <div class='px-4 py-2 text-sm text-gray-700 space-y-1'>
              <div class='flex items-center gap-2'>
                <svg class='w-4 h-4 text-red-500' fill='none' stroke='currentColor' stroke-width='2' viewBox='0 0 24 24'>
                  <path stroke-linecap='round' stroke-linejoin='round' d='M3 5a2 2 0 012-2h3.28a1 1 0 01.95.684l1.5 4.493a1 1 0 01-.5 1.21l-2.26 1.13a11.042 11.042 0 005.52 5.516l1.13-2.257a1 1 0 011.21-.502l4.49 1.5a1 1 0 01.69.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'/>
                </svg>
                {$donor['donor_number']}
              </div>

              <div class='flex items-center gap-2'>
                <svg class='w-4 h-4 text-red-500' fill='none' stroke='currentColor' stroke-width='2' viewBox='0 0 24 24'>
                  <path stroke-linecap='round' stroke-linejoin='round' d='M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'/>
                </svg>
                {$donor['donor_gender']}, {$donor['donor_age']} years
              </div>

              <div class='flex items-center gap-2'>
                <svg class='w-4 h-4 text-red-500' fill='none' stroke='currentColor' stroke-width='2' viewBox='0 0 24 24'>
                  <path stroke-linecap='round' stroke-linejoin='round' d='M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z'/>
                  <path stroke-linecap='round' stroke-linejoin='round' d='M15 11a3 3 0 11-6 0 3 3 0 016 0z'/>
                </svg>
                {$donor['donor_address']}
              </div>
            </div>

            <div class='px-4 pb-4'>
              <a href='{$whatsappLink}' target='_blank'>
                <button class='w-full text-sm font-semibold border border-red-500 text-red-500 rounded-md py-2 hover:bg-red-500 hover:text-white transition duration-200'>
                  Contact Donor
                </button>
              </a>
            </div>
          </div>
        </div>";
    }

    echo '</div></div>';
} else {
    echo '<div class="text-center text-red-600 font-semibold my-10">No Donor Found For your search Blood group</div>';
}
?>
