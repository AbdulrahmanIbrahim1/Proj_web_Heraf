<?php
include("code.php");
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
    <!-- Main Template CSS File (stylesheet) -->
    <link rel="stylesheet" href="CSSFiles/prof.css">

  <title>Hreaf Profile</title>
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
        <a href="#" id="loginLink">
		    <i class="fa-solid fa-right-from-bracket"></i>
		</a>

		<script>
    // Function to open login.php
    function openLoginPage() {
        window.location.href = 'login.php';
    }

    // Attach the function to the click event of the link
    document.getElementById('loginLink').addEventListener('click', openLoginPage);
</script>

      </div>
    </div>
  </header>
  <!-- end header -->

    <!-- strat section 1  -->
    <section class="sec1">
      <div class="container">
        <!-- part left => text -->
        <div class="left">
          <p>Hi there</p>
          <h3><?php echo $emp1['first_name'] . " " . $emp1['last_name']; ?></h3>
          <p><?php if (isset($emp1['elherfa'])) {echo $emp1['elherfa']; 
            echo "<ul>";
			for ($i = 0; $i < sizeof($skil); $i++) {
				echo "<li>" . $skil[$i]['skill'] . "</li>";
			}
            echo "</ul>";
			
echo "</p>";}
			?>
			<?php if (isset($emp1['elherfa'])) {
            echo "<button class=\"btn-skill\">
              Add skill 
            </button>
            <div class=\"Newskill\" style=\"display: none;\">
              <label for=\"Nskill\"  >Write your skill : </label>
              <input type=\"text\" name=\"Nskill\" id=\"Nskill\" class=\"Nskill\"  >
              <button add=\"add\">Add</button>
            </div>";}?>
            <!-- script to add new skill -->
            <script>
              let btnSkill=document.getElementsByClassName("btn-skill")[0]
              let Newskill=document.querySelector('[class="Newskill"]')
              console.log(Newskill)
              btnSkill.onclick=()=>{
                lay.style.display="block";
                Newskill.style.display="block"
              }
              let btnAddSkill = document.querySelector('[add="add"]')
              let inputSkill=document.querySelector('[id="Nskill"]')
              btnAddSkill.onclick= ()=>{
                if(!inputSkill.value==""){
                  let ul = document.querySelector('[class="ulSkill"]')
                  let liValue=document.createElement("li")
                  liValue.innerHTML=inputSkill.value
                  ul.appendChild(liValue)
                  lay.style.display="none";
                  Newskill.style.display="none"
                }
                else{
                  //window.alert("add skill")
                  lay.style.display="none";
                  Newskill.style.display="none"
                }
              }
            </script>
            <br>
			<?php if (isset($emp1['elherfa'])) {
			
echo $emp1['about'] . "</p>";}
			?>
            <p><span>My phone : </span><?php echo $emp1['phone'] ?></p>
            <?php if (isset($emp1['elherfa'])) {
			echo "<p>Total Reviews :</p>
            <i class=\"fa-solid fa-star one\"></i>
            <i class=\"fa-solid fa-star two\"></i>
            <i class=\"fa-solid fa-star three\"></i>
            <i class=\"fa-solid fa-star four\"></i>
            <i class=\"fa-solid fa-star five\"></i>
          </div>"
		  ;}?>
        <!-- part right => photo -->
        <div class="right">
          <div class="photo">
            <img src="images/<?php echo $emp1['photo'] ?>" alt="">
          </div>
        </div>
      </div>
    </section>
    <!-- end section 1  -->

	<?php if (isset($emp1['elherfa'])) {
		echo "<!-- start section 2 -->
		<div class=\"projects\">";
		 if (sizeof($proj) > 0) {echo "<h2>Some of my works :</h2>";}
		  echo "<div class=\"container\">
	
			<!-- start card -->";
			 for ($i = 0; $i < sizeof($proj); $i++) echo " <div class=\"card\">
			  <!-- left => img -->
			  <div class=\"left\">
				<div class=\"img-proj\">
				  <img src=\"images/" . $proj[$i]['photo'] . "\" alt=\"\">
				</div>
			  </div>
			  <!-- right => text  -->
			  <div class=\"right\">
				<h4>" . $proj[$i]['project_name'] . "</h4>
				<p>" . $proj[$i]['details'] . "</p>
				</div>
			  </div>";}?>
        <!-- end card -->


		<?php if (isset($emp1['elherfa'])) {
        echo "<div class=\"lay addlay\"></div>
        <form class=\"addForm\">
          <label for=\"photoProj\">image of new project : </label>
          <input type=\"file\" name=\"photoProj\" required>

          <label for=\"projName\">Name of your new project : </label>
          <input type=\"text\" name=\"projName\" required>

          <label for=\"info\">information of your new project :</label>
          <textarea id=\"info\" name=\"infoproj\" rows=\"4\" cols=\"50\" required></textarea>

          <input type=\"submit\" class=\"sub\" value=\"add my new project\" >
        </form>

        <div class=\"add\">
          <p>Add new project</p>
          <i class=\"fa-solid fa-plus\"></i>
        </div>";}?>

        
      </div>
    </div>
    <!-- script to add new project -->
    <script>
      let projects = document.getElementsByClassName("projects")[0];
      let addform =document.getElementsByClassName("addForm")[0];
      let lay = document.getElementsByClassName("addlay")[0];
      let projImge = document.querySelector('[name="photoProj"]');
      let projName= document.querySelector('[name="projName"]');
      let projInfo = document.querySelector('[name="infoproj"]');
      let sub = document.querySelector('[class="sub"]');

      let add= document.getElementsByClassName("fa-plus")[0];
      add.onclick = function(){
        lay.style.display ="block";
        addform.style.display="grid";
      }

      lay.onclick = ()=>{
        lay.style.display = "none";
        addform.style.display = "none";
//new skill
        Newskill.style.display = "none"
      }
      
      addform.onsubmit= (e)=>{
        e.preventDefault();
        lay.style.display = "none";
        addform.style.display = "none";
        //create new card
        let card = document.createElement("div")
        card.className="card";
        //create left
        let left =document.createElement("div")
        let imgProj = document.createElement("div")
        imgProj.className="img-proj";
        let img = document.createElement("img")
        img.src=projImge.value;
        //append left
        imgProj.appendChild(img);
        left.appendChild(imgProj);
        card.appendChild(left)

        //create right
        let right = document.createElement("div")
        right.className="right";
        //create h4
        let h4=document.createElement("h4");
        h4.innerHTML= projName.value;
        //create p
        let p=document.createElement("p");
        p.innerHTML=projInfo.value;
        //append right
        right.appendChild(h4)
        right.appendChild(p)
        card.appendChild(right)
        //add to container to page
        projects.lastElementChild.prepend(card);
      }

    </script>
    <!-- end section 2 -->
    
    <!-- start comments -->
	<?php  if (isset($emp1['elherfa'])) {
    echo "<div class=\"comments\">
      <h2>Ratings : </h2>
      <div class=\"container contComnt\">
        
         
        <!-- ======== -->
        <div class=\"card\">
          <div class=\"person\">
          <img src=\"images/skills-02.jpg\" alt=\"\">
          <div class=\"name\">Omar Elsayed</div>
          
        </div>
        <div class=\"cmnt\">
          
          
          <p class=\"mycmnt\">COMMENT</p>
          
        </div>
      </div>
        <!-- ==== -->
    </div>
    
  </div>";}?>
    <!-- script to add new comment -->
    <script>
      
      let cmnt = document.querySelector('[placeholder="Write your comment here"]');
      let subcmnt = document.querySelector('[class="addcmnt"]');
      subcmnt.onclick = comment;
      
      function comment() {
        let mycmnt = document.querySelector('[class="mycmnt"]')
      mycmnt.innerHTML = cmnt.value;
      cmnt.style.display = "none"
      subcmnt.style.display = "none"
      //for ratings
      removeNot()
      removeAtrr()
    }
    //=============
      let comments = document.querySelector('[class="container contComnt"]')

        let addnew= document.querySelector('[class="fa-solid fa-plus addmycmnt"]');
        addnew.onclick=()=>{
          let card =document.createElement("div")
          card.className="card";
          let person=document.createElement("div")
          person.className="person";
          let img=document.createElement("img");
          img.src="images/skills-02.jpg"
          img.alt="";
          // ناقص السورس هيبقي من الداتا بيز و الاسم 
          let name=document.createElement("div")
          name.className="name";
          name.innerHTML="abdo"
          
          person.appendChild(img)
          person.appendChild(name)
          card.appendChild(person)
          
          let com=document.createElement("div")
          com.className="cmnt";
          let textarea=document.createElement("textarea")
          textarea.cols="30"
          textarea.rows = "10"
          textarea.placeholder="Write your comment here"
          textarea.style = "min-width: 260px height: 66px;";
          let btn=document.createElement("button");
          btn.className="addcmnt";
          btn.innerHTML="add comment";
          let p= document.createElement("p");
          p.className="mycmnt";

          let NewDivRate=document.createElement("div")
          NewDivRate.className="rating not"
          let NewStar=[];
          for(let i=0 ;i<5;i++){
            NewStar[i]=document.createElement("i");
            NewStar[i].className="fa-solid fa-star star";
            NewStar[i].setAttribute("onclick", `rate(${i+1})`)
            NewStar[i].setAttribute("onmouseover", `highlight(${i+1})`)
            NewStar[i].setAttribute("onmouseout", "resetStars()")
          }
          
          for(let i=0;i<5;i++){
            NewDivRate.appendChild(NewStar[i]);
          }


          com.appendChild(textarea);
          com.appendChild(btn);
          com.appendChild(NewDivRate)
          com.appendChild(p);
          
          card.appendChild(com)
          
          comments.append(card)
          
          
          btn.onclick= function(){
            p.innerHTML=textarea.value
            textarea.style.display="none"
            btn.style.display="none"
            //
            removeNot()
            removeAtrr()
            CountAveRating()
          }
          CountAveRating()
        }
        //========
        //script for ratings
        let rats=document.querySelector('[class="rating not"]')
        
        let selectedRating = 0;

        function highlight(starNumber) {
          for (let i = 1; i <= starNumber; i++) {
            document.querySelector(`.rating.not .star:nth-child(${i})`).style.color = 'red';
              }
        }

        function resetStars() {
          for (let i = 1; i <= 5; i++) {
            document.querySelector(`.rating.not .star:nth-child(${i})`).style.color = (i <= selectedRating) ? 'var(--mainColor)' : 'black';
          }
        }

        function rate(rating) {
          selectedRating = rating;
          resetStars();
          console.log(`Rated: ${rating} stars`);

        }

        function removeAtrr(){
          let star = document.querySelectorAll(".star")
          for(let i=0;i<star.length;i++){
            if(!star[i].parentElement.classList.contains("not")){
            star[i].removeAttribute("onclick")
            star[i].removeAttribute("onmouseover");
            star[i].removeAttribute("onmouseout");
          }
        }
      }
        removeAtrr() 

        function removeNot(){
          let star = document.querySelectorAll(".star")
          for (let i = 0; i < star.length; i++) {
            if (star[i].parentElement.classList.contains("not")) {
              star[i].parentElement.classList.remove("not")
            }
          }
        }


        function CountAveRating(){
          let star = document.querySelectorAll(".star")
          let CountOf5 = 0
          let CountOfColor=0
          for (let i = 0; i < star.length; i++) {
            if(i%5==0){
              CountOf5++
            }
            if(star[i].style.color=="var(--mainColor)"){
              CountOfColor++;
            }
          }
          console.log(`count of stars has color: ${CountOfColor}`)
          console.log(`count of group stars : ${CountOf5}`)

          let average=CountOfColor/CountOf5;
          console.log(`Average of ratings : ${average}`)
          console.log(`##################################`)
        }
        CountAveRating()
      </script>
      <!-- end comments -->
      
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
            <div id="sur" class="card">
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


    window.addEventListener("resize" ,function(){
    if(window.innerHeight<=768){
      links.style.display = "none"
      BtnList.onclick = () => {
        links.style.cssText = "display: flex; flex-direction: column; position:absolute; top:100%; left:0; width: 100%;background-color: #00000075; "
      }
      links.onmouseleave = () => {
        links.style.display = "none"
      }
    }
    if(window.innerWidth>768){
      links.style.cssText ="display: flex; position: relative; "
      links.onmouseleave = () => {
        links.style.display = "display: flex; position: relative; "
      }
    }
  })
  </script> 
  </html>