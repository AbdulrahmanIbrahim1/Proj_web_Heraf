<?php include("code.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/x-icon" href="images/IMG_20231105_202217_434-removebg.png">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="CSSFiles/Normalize.css" />
  <!-- Font Awesome Library -->
  <link rel="stylesheet" href="CSSFiles/all.min.css" />
  <!-- Main Template CSS File (stylesheet) -->
  <link rel="stylesheet" href="CSSFiles/search.css">
  <title>Heraf / search</title>
</head>

<body>
  <!-- start header -->
  <header>
    <div class="container">
      <!-- left -->
      <div class="logo">
        <img src="images/IMG_20231105_202217_434-removebg.png" alt="Logo">
      </div>
      <i class="fas fa-bars toggle-menu"></i>
      <div class="links">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="index.php#sur">Survices</a></li>
          <li><a href="#about">About</a></li>
        </ul>
        <a href="login.php">
          <i class="fa-solid fa-user"></i>
        </a>
      </div>
    </div>
  </header>
  <!-- end header -->

  <!-- start section 1  -->
  <section>
    <div class="lay"></div>
    <div class="content center">
      <h1>Repair and
        Maintenance
        Services</h1>
      <p>A platform to help you find a suitable craftsman</p>
      <div class="search">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="search" class="center"
          placeholder="   electrician ,Computer engineer ,Mechanical ,carpenter,Broker,............................................ ">
        <button>Search</button>
      </div>
    </div>
  </section>
  <!-- end section 1  -->

  <div class="section2">
    <div class="container">
      <!-- card of account -->
      <?php
	  for ($i = 0; $i < sizeof($heraf); $i++) {
	  echo "<div class=\"Card-acount\">
        <div class=\"left\">
          <img src=\"images/" . $heraf[$i]['photo'] . "\" alt=\"account photo\">
        </div>
        <div class=\"right\">
          <h2>" . $heraf[$i]['first_name']. " " . $heraf[$i]['last_name'] . "</h2>
          <p>" . $heraf[$i]['elherfa'] . "<br>" . $heraf[$i]['country'] . ":  " . $heraf[$i]['governorate'] . "</p>
        </div>
      </div>
      <hr>";} ?>
      <!-- end of card  -->
    </div>
  </div>
  <!-- end section 2 -->

    <!-- start footer  -->
    <footer>
      <div class="container">
        <div class="content">
    
          <div class="card">
            <h3>Connect with us</h3>
            <p></p>
            <div class="ourMail">
              <i class="fa-solid fa-envelope"></i>
              <span>Heraf@gmail.com</span>
            </div>
          </div>
          <!-- =================================================================== -->
          <div class="card">
            <h3>Our service</h3>
            <p><span style="font-weight: bold;">Heraf :</span> is a platform that provides a space for artisans of all
              shapes and professions to offer their services</p>
          </div>
          <!-- =================================================================== -->
          <div id="about" class="card">
            <h3>About US</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
              Ipsa nobis magnam aperiam quis! Quae possimus repudiandae perspiciatis voluptate,
              excepturi dignissimos, harum totam ipsum, facilis deserunt ab explicabo unde vitae fugit!</p>
          </div>
          <!-- =================================================================== -->
        </div>
        <hr>
        <h2>ERROR 404 TEAM </h2>
        <p style="font-size: 0.9em;">
          <i class="fa-solid fa-copyright"></i> 2023
        </p>
      </div>
    </footer>
    <!-- end footer  -->

</body>

  <!-- script for click on fas fa-bars toggle-menu in phone screen  -->
  <script>
    let BtnList = document.getElementsByClassName("fas fa-bars toggle-menu")[0]
    let links = document.querySelector('[class="links"]')


    window.addEventListener("resize", function () {
      if (window.innerHeight <= 768) {
        links.style.display = "none"
        BtnList.onclick = () => {
          links.style.cssText = "display: flex; flex-direction: column; position:absolute; top:100%; left:0; width: 100%;background-color: #00000075; "
        }
        links.onmouseleave = () => {
          links.style.display = "none"
        }
      }
      if (window.innerWidth > 768) {
        links.style.cssText = "display: flex; position: relative; "
        links.onmouseleave = () => {
          links.style.display = "display: flex; position: relative; "
        }
      }
    })
	//onclick on account 
    let account = document.querySelectorAll('[class="Card-acount"]')
      for(let i=0;account.length;i++){
        account[i].onclick=()=>{
        window.location.href="employ.php";
      }
    }
  </script>
</html>
