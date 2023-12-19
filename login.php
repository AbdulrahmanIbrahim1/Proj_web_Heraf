<?php
session_start();
unset($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="icon" type="image/x-icon" href="images/IMG_20231105_202217_434-removebg.png">

  <link rel="stylesheet" href="CSSFiles/Normalize.css" />
  <!-- Font Awesome Library -->
  <link rel="stylesheet" href="CSSFiles/all.min.css" />
  <link rel="stylesheet" href="CSSFiles/login.css">
  <title>HeraflOGIN</title>
</head>

<body>
  <div class="container">
    <!-- left -->
    <div class="sign-in">
      <div class="logo">
        <img src="images/IMG_20231105_202217_434-removebg.png" alt="logo">
      </div>
      <div class="text center">
        <h1>Login To Your Account</h1>
        <p>Login using social networks</p>
        <div class="links">
          <div class="face"><a href="#"><i class="fa-brands fa-facebook-f"></i> </a></div>
          <div class="google active"><a href="#"><i class="fa-brands fa-google-plus-g"></i></a></div>
          <div class="linked"><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></div>
        </div>
      </div>
      <form action="" method="post">
        <input type="email" id="email" placeholder="Email" required
          title="Enter your Email EXample : Heraf123@gmail.com" name="email"><br>
        <input type="password" id="pass" placeholder="Password" required title="Enter your password" name="password"><br>
        <input type="submit" id="sub" value="Sign In" >
		<?php include("code.php"); ?>
        <i class="fa-solid fa-eye" style="cursor:pointer;"></i>
      </form>
    </div>

    <!-- right -->
    <div class="sign-up">
      <div class="lay"></div>
      <div class="text center">
        <h1>New Here ?</h1>
        <p>Sign up and discover a great amount of new opportunities</p>
        <button>Sign Up</button>
      </div>
    </div>
  </div>

  <!-- start Java Script -->
  <script>
    //start to show pass
    let pass = document.getElementById("pass");
    let iconShow = document.getElementsByClassName("fa-solid fa-eye")[0]
    iconShow.onclick = () => {
      if (pass.type === "password") {
        pass.type = "text";
        setTimeout(() => { pass.type = "password" }, 3000)
      }
      else {
        pass.type = "password";
      }
    }
    //end to show pass
 //   let form = document.getElementsByTagName("form")[0];
   // console.log(form)
    //form.onsubmit = function() {
    //  location.href = "profile.html";
   // }

    //   let sub = document.querySelector('[type="submit"]')
    //   sub.onclick= ()=>{
    //     location.href="profile.html"
    //   }

    let btn = document.getElementsByTagName("button")[0]
    //console.log(btn)
    btn.onclick = function () {
      location.href = "newacount.php"
    }

  </script>
  <!-- End Java Script -->
</body>

</html>