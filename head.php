<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LiForce - Blood Communication Platform</title>

  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f4f4;
      color: #333;
    }

    .header {
      background-color: #333;
      color: #fff;
      padding: 14px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .branding {
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
    }

    .logo-icon {
      width: 36px;
      height: 36px;
      animation: pulse 1.5s infinite ease-in-out;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.15); }
    }

    .webapp-title {
      display: flex;
      flex-direction: column;
    }

    .webapp-name {
      font-size: 26px;
      font-weight: 700;
      color: #FF0404;
      text-transform: uppercase;
      letter-spacing: 1.5px;
    }

    .webapp-subtitle {
      font-size: 13px;
      color: #aaa;
      text-transform: none;
      font-weight: 400;
      margin-top: -2px;
    }

    .header-right {
      display: flex;
      gap: 18px;
      align-items: center;
      flex-wrap: wrap;
    }

    .header a {
      color: #fff;
      text-decoration: none;
      font-size: 15px;
      padding: 10px 16px;
      border-radius: 30px;
      transition: all 0.3s ease;
    }

    .header a:not(.branding):hover {
      background-color: #FF0404;
      color: #fff;
      transform: scale(1.05);
    }

    a.act {
      background: linear-gradient(to right, #fd746c 0%, #ff9068 100%);
      color: #fff;
    }

    .login-btn {
      background-color: #FF0404;
      padding: 10px 18px;
      font-weight: bold;
    }

    .login-btn:hover {
      background-color: #fff;
      color: #FF0404;
    }

    @media screen and (max-width: 768px) {
      .header {
        flex-direction: column;
        align-items: flex-start;
      }

      .header-right {
        flex-direction: column;
        width: 100%;
        margin-top: 10px;
      }

      .header a {
        width: 100%;
        text-align: left;
      }

      .webapp-title {
        text-align: left;
      }
    }
  </style>
</head>

<body>
  <div class="header">
    <a href="home.php" class="branding" <?php if($active == 'home') echo "style='color:#fff;'"; ?>>
      <svg class="logo-icon" viewBox="0 0 24 24" fill="#FF0404" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 2C12 2 5 9 5 14C5 17.87 8.13 21 12 21C15.87 21 19 17.87 19 14C19 9 12 2 12 2Z"/>
      </svg>
      <span class="webapp-title">
        <span class="webapp-name">LiForce</span>
        <span class="webapp-subtitle">Blood Donor & Bank Communication</span>
      </span>
    </a>

    <div class="header-right">
      <a href="about_us.php" class="<?php if($active == 'about') echo "act"; ?>">About Us</a>
      <a href="why_donate_blood.php" class="<?php if($active == 'why') echo "act"; ?>">Why Donate</a>
      <a href="donate_blood.php" class="<?php if($active == 'donate') echo "act"; ?>">Become A Donor</a>
      <a href="need_blood.php" class="<?php if($active == 'need') echo "act"; ?>">Need Blood</a>
      <a href="contact_us.php" class="<?php if($active == 'contact') echo "act"; ?>">Contact</a>
      <a href="admin/login.php" class="login-btn">Admin Login</a>
    </div>
  </div>
</body>

</html>
