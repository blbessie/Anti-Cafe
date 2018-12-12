<!DOCTYPE html>
<?php 
    // server should keep session data for AT LEAST 1 hour
    ini_set('session.gc_maxlifetime', 3600);

    // each client should remember their session id for EXACTLY 1 hour
    session_set_cookie_params(3600);

    // Start the session
    session_start();

    // Set the session variable
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false){
        header("location: ../index.html");
    }

    include 'db_connection.php';
    include 'db_basicoperation.php';

    $connection = ConnectDB();

    $query = "SELECT fname, lname,email,points FROM WebsiteUsers where username='{$_SESSION["username"]}'";
    $result = mysqli_query($connection,$query);
    $numResults = mysqli_num_rows($result);

    if($numResults==1){

    $row = mysqli_fetch_assoc($result);
    $_SESSION["fname"] = $row['fname'];
    $_SESSION["lname"] = $row['lname'];
    $_SESSION["email"] = $row['email'];
    $_SESSION["points"] = $row['points'];

  }
?>

<html lang="en">
<head>
  <title>Main anti-cafe page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="menu_style.css">

  <script>
      $(document).ready(function(){
        // day time picker
        //$("#date").datetimepicker;

        // Add smooth scrolling to all links in navbar + footer link
        $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
      
         // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
      
          // Prevent default anchor click behavior
          event.preventDefault();
      
          // Store hash
          var hash = this.hash;
      
          // Using jQuery's animate() method to add smooth page scroll
          // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
          $('html, body').animate({
            scrollTop: $(hash).offset().top-50
          }, 900, function(){
      
            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash-100;
            });
          } // End if
        });
      })
      </script>

      <script>
        //javascript
        function UpdateValue(val){
            document.getElementById("duration").innerHTML = val;
        }

        function ShowTables(str, dur, num) {
         
          var xhttp; 
          if (str == "" || dur == "") {
            //return
            return;
          }
          
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //change images
              document.getElementById("tableseats").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "CheckAvailability.php?time="+str+"&dur="+dur+"&number="+num, true);
          xhttp.send();
        }

        function ReserveSeat() {
          var CreditsToTake = $('#dur').val() * 5;
          var username = <?php echo json_encode($_SESSION['username']); ?>;
          
          //ajax update credits
          if ($(".radiocheck:checked").length === 1) {
            $.ajax({
                url: "../AdminPage/admin.php",
                type: "POST",
                data: { 'username': username, 'amount': CreditsToTake, 'button': 'remove' },                   
                success: function(data)
                {
                    if(data == "PointLimit") {
                        alert("You don't have enough points in order to complete the action.....");
                    } else { 
                      alert("You spent " + CreditsToTake + " credits for this reservation.");
                      var seat = $(".radiocheck:checked").val(); 
                          number =  $('#num').val();
                          duration = $('#dur').val();
                          time = $('#time').val();
                      $.ajax({
                        url: "Reserve.php",
                        type: "POST",
                        data: { 'seat': seat, 'number': number, 'duration': duration, 'time': time },                   
                        success: function(data)
                        {
                          alert(data);
                        }
                      });
                    }
                  }
              });
            }
          }
        
      </script>

    <style>
      #title {
          padding-top: 100px;
        }

        #reserve, #order {
          margin-top: 120px;
        }

        #foodChoice {
          margin-top: 70px;
        }

        #cafeGui {
          position: absolute;
          left: 30%;
          width: 100%;
          height: auto;
          
        }

        .seatSelector {
          position: absolute;
          z-index: 2;      
        }

        #table1 {
          top: 50%;
          left: 28%;
          width: 80px;
          height: 80px;
          opacity: 0.6;
        }

        #table2 {
          top: 50%;
          left: 40%;
          width: 80px;
          height: 80px;
          opacity: 0.6;
        } 

        #contact {
          margin-top: 100px;
          padding: 20px;
        } 

        .footerHeader {
          margin-bottom: 5px;
          padding-bottom: 20px;
        }
      </style>
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
      
          <a class="navbar-brand" href="#">Logo</a>
          <!-- Toggler/collapsibe Button -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>

        <div class="collapse navbar-collapse justify-content-end" id="myNavbar">
          <ul class="navbar-nav">
            <li class="nav-item "><a class="nav-link" href="#reserve">RESERVE</a></li>
            <li class="nav-item "><a class="nav-link" href="#menu">MENU</a></li>
            <li class="nav-item"><a class="nav-link" href="../FlavourSurvey/survey.html">QUIZ</a></li>
            <li class="nav-item"><a class="nav-link" href="../MiniGame/minigame.php">GAME</a></li>
            <li class="nav-item"><a class="nav-link" href="#contact">CONTACT</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="navbardrop" data-toggle="dropdown">
                <i class="far fa-user"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myProfile">Profile</a>
                <a class="dropdown-item" href="../logout.php">Log out</a>
              </div>
            </li>
          </ul>
          </div>
    </nav>

    <!-- The Modal -->
    <div class="modal fade" id="myProfile">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
      
           <!-- Modal Header -->
          <div class="modal-header">    
            <h4 class="modal-title">Profile</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
        
          <!-- Modal body -->
          <div class="modal-body">    
              <p>Username: <?php echo $_SESSION["username"] ?></p>
              <p>Name: <?php echo $_SESSION["fname"]. " " .$_SESSION["lname"] ?></p>
              <p>Email: <?php echo $_SESSION["email"] ?></p>
              <p>Points: <?php echo $_SESSION["points"] ?></p>
          </div>
        
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        
        </div>
      </div>
    </div>

    <div class="jumbotron container-fluid mb-0" id="title">
        <h1>Anti-cafe main page</h1>      
        <p>you can reserve the seat here.</p>
    </div>

    <div id="myCarousel" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ul>
      
        <!-- The slideshow -->
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="/img/coffee.jpg" alt="Los Angeles">
          </div>
          <div class="carousel-item">
            <img src="/img/coffee.jpg" alt="Chicago">
          </div>
          <div class="carousel-item">
            <img src="/img/coffee.jpg" alt="New York">
          </div>
        </div>
      
        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>
      
      </div>

    

    <div class="container" id="reserve">
        <div class="p-5 text-center bg-dark mb-0">
            <h2 style="color: white">SELECT TIME AND DATE FOR YOUR RESERVATION</h2>
            <h4 style="color: white">5 Points per Hour</h2>
        </div>
          <form method="POST" action="">
            <div class="bg-secondary text-white pb-1 pt-6">
            
              <div class="d-flex p-3">
                  <div class="p-2 flex-fill text-center">
                    <h5>Start Time</h5>
              
                    <select name="time" id="time" class="rounded custom-select" required>
                      <option selected>Select Start Time</option>
                      <option value="09:00">9:00</option>
                      <option value="10:00">10:00</option>
                      <option value="11:00">11:00</option>
                      <option value="12:00">12:00</option>
                      <option value="13:00">13:00</option>
                      <option value="14:00">14:00</option>
                      <option value="15:00">15:00</option>
                      <option value="16:00">16:00</option>
                      
                    </select>
                                      
                  </div>
                  <div class="p-2 flex-fill text-center">
                      <h5>Duration</h5>
                      <p id="duration">1</p>
                      
                      <input type="range" name="duration" id='dur' min="0" max="4" value="1" class="rounded" onchange="UpdateValue(this.value)" required>
                             
                  </div>
                  <div class="p-2 flex-fill text-center">
                      <h5>People</h5>
                      <input type="number" name="number" id="num" class="rounded" required>            
                  </div>
                  <div class="d-flex m-3 justify-content-end">
                      <input type="button" value="Check Availablity" class="btn btn-info" onclick="ShowTables(document.getElementById('time').value, document.getElementById('dur').value, document.getElementById('num').value)">
                  </div>
              </div>

                <div class="row">
                  <div class="col">
                    <img src='../img/cafemap.jpg' d="cafeGUI" class='img.fluid img-thumbnail mx-auto d-block'>

                    <div class='form-check seatSelector' id='table1'>
                        <img src='seat1.png' style='width: 80px; height: 80px; pacity: 0.6;'>
                    </div>

                    <div class='form-check seatSelector' id='table2'>  
                        <img src='seat1.png' style='width: 80px; height: 80px; pacity: 0.6;'>
                    </div>
                    
                    <div id="tableseats" style='margin=30px;'></div>
                    
                  </div>
                </div>

                <div class="d-flex m-5 justify-content-end">
                    <input id="reservesubmit" type="submit" value="Reserve" class="btn btn-success" onclick="ReserveSeat()">
                </div> 
            </div> 
        </form> 
    </div>
    
    
    <section id="menu" class="module">
		<div class="container">

			<div class="row">
				<div class="col">
					<div class="module-header mx-auto d-block" >
						<h2 class="module-title">Popular Dishes</h2>
						<h3 class="module-subtitle">Our most popular menu</h3>
					</div>
				</div>
			</div>

			<div class="row">

				<div class="col-sm-6">

					<div class="menu">
						<div class="row">
							<div class="col-sm-8">
								<h4 class="menu-title">Chocolate Volcano Cake</h4>
								<div class="menu-detail">Mentos / Butter Cream / Milk / Chocolate Powder / Egg</div>
							</div>
							<div class="col-sm-4 menu-price-detail">
								<h4 class="menu-price">$7.5</h4>
							</div>
						</div>
					</div>

					<div class="menu">
						<div class="row">
							<div class="col-sm-8">
								<h4 class="menu-title">Lemon and Garlic Green Beans</h4>
								<div class="menu-detail">Lemon / Garlic / Beans</div>
							</div>
							<div class="col-sm-4 menu-price-detail">
								<h4 class="menu-price">$4.5</h4>
								<div class="menu-label">New</div>
							</div>
						</div>
					</div>

					<div class="menu">
						<div class="row">
							<div class="col-sm-8">
								<h4 class="menu-title">Hot Breakfast Sandwich</h4>
								<div class="menu-detail">Seasoned Egg / Cheese / Bacon</div>
							</div>
							<div class="col-sm-4 menu-price-detail">
								<h4 class="menu-price">$7.5</h4>
							</div>
						</div>
					</div>

					<div class="menu">
						<div class="row">
							<div class="col-sm-8">
								<h4 class="menu-title">Homestyle Oatmeal</h4>
								<div class="menu-detail">Oatmeal / Apple / Mixed Berries</div>
							</div>
							<div class="col-sm-4 menu-price-detail">
								<h4 class="menu-price">$5.9</h4>
							</div>
						</div>
					</div>

					<div class="menu">
						<div class="row">
							<div class="col-sm-8">
								<h4 class="menu-title">Rainbow Macaron</h4>
								<div class="menu-detail">Almond / Egg / Oats</div>
							</div>
							<div class="col-sm-4 menu-price-detail">
								<h4 class="menu-price">$3.0</h4>
							</div>
						</div>
					</div>

				</div>

				<div class="col-sm-6">

					<div class="menu">
						<div class="row">
							<div class="col-sm-8">
								<h4 class="menu-title">Spicy Pumpkin Chili</h4>
								<div class="menu-detail">Ground Beef / Red Pepper / Pumpkin Pie / Tomatoes</div>
							</div>
							<div class="col-sm-4 menu-price-detail">
								<h4 class="menu-price">$14.5</h4>
							</div>
						</div>
					</div>

					<div class="menu">
						<div class="row">
							<div class="col-sm-8">
								<h4 class="menu-title">Perfect Cappuccino</h4>
								<div class="menu-detail">Fresh Milk / Hot Brewed Coffee Beans</div>
							</div>
							<div class="col-sm-4 menu-price-detail">
								<h4 class="menu-price">$4.5</h4>
							</div>
						</div>
					</div>

					<div class="menu">
						<div class="row">
							<div class="col-sm-8">
								<h4 class="menu-title">Banana Protein Bomb Smoothie</h4>
								<div class="menu-detail">Banada / Yoghurt / Oats / Organic Vegan Protein</div>
							</div>
							<div class="col-sm-4 menu-price-detail">
								<h4 class="menu-price">$8.5</h4>
								<div class="menu-label">Recommended</div>
							</div>
						</div>
					</div>

					<div class="menu">
						<div class="row">
							<div class="col-sm-8">
								<h4 class="menu-title">Real Mojito</h4>
								<div class="menu-detail">Mint leaves / Lime / Aqua</div>
							</div>
							<div class="col-sm-4 menu-price-detail">
								<h4 class="menu-price">$3.0</h4>
							</div>
						</div>
					</div>

					<div class="menu">
						<div class="row">
							<div class="col-sm-8">
								<h4 class="menu-title">Dark Roast Coffee</h4>
								<div class="menu-detail">Arabica beans</div>
							</div>
							<div class="col-sm-4 menu-price-detail">
								<h4 class="menu-price">$4.5</h4>
							</div>
						</div>
					</div>

				</div>

			</div>

			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<div class="devider">
					</div>
				</div>
			</div>

		</div><!-- .container -->
  </section>



    <!--Footer section-->
    <footer id="contact" class="container-fluid" style="background-color:bisque">
      <div class="text-center">
      <a  href="#myPage" title="To Top">
        <span class=""><i class="fas fa-angle-up fa-3x" style="color: #51cf66;"></i></span>
      </a>
      </div>
      
      <div class="row text-center mt-5">
        <div class="col-md-4 col-sm-4">
          <h3 class="footerHeader">Contact Us</h3>
          <p>phone number: 111-222-333</p>
          <p>Address</p>
          <p>Montreal QC Canada</p>
        </div>
        <div class="col-md-4 col-sm-4">
          <h3 class="footerHeader">Open Hour</h3>
          <p>Monday-Friday  9AM-5PM</p>
          <p>Saturday  9AM-5PM</p>
          <p>Sunday  9AM-5PM</p>
        </div>
        <div class="col-md-4 col-sm-4">
          <h3 class="footerHeader">Follow Us</h3>
          <div style="padding-top: 5px">
              <span><i href="#" class="fab fa-facebook fa-2x"></i></span>
              <span><i href="#" class="fab fa-twitter fa-2x"></i></span>
              <span><i href="#" class="fab fa-behance fa-2x"></i></span>
              <span><i href="#" class="fab fa-dribbble fa-2x"></i></span>
              <span><i href="#" class="fab fa-github fa-2x"></i></span>
        </div>
        </div>
      </div>
  </footer>    
</body>