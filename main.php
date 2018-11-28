<!DOCTYPE html>
<?php 
    // Start the session
    session_start();
?>

<!-- <?php
    //set the cookies
    $cookie_name = "user";
    $cookie_value = "Lancer";
    setcookie($cookie_name, $cookie_value); 
?> -->

<?php
      // Set the session variable
      $_SESSION["username"] = "lancer";
      $_SESSION["email"] = "jfijfi@jjjj.com";
      $_SESSION["expiredate"] = date("Y/m/d");
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
            scrollTop: $(hash).offset().top-100
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

        window.onload = function(){
            var myCanvas = document.getElementById('cafeGUI'),
                context = myCanvas.getContext("2d"),
                width = myCanvas.width;
                height = myCanvas.height;

            var img = new Image();
            img.onload = function () {
              context.drawImage(img, 60, 30, width, height);
            }
            
            img.src = "img/cafemap.jpg";
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

        /* HIDE RADIO */
        [type=radio] { 
          position: absolute;
          opacity: 0;
          width: 0;
          height: 0;
        }

        /* IMAGE STYLES */
        [type=radio] + img {
          cursor: pointer;
          width: 80px;
          height: 80px;
          opacity: 0.6;
        }

        /* IMAGE STYLES */
        [type=radio] + img:hover {
          cursor: pointer;
          width: 80px;
          height: 80px;
          opacity: 0.6;
          -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
          filter: grayscale(50%);
        }

        /* CHECKED STYLES */
        [type=radio]:checked + img {
          outline: 2px solid #f00;
        }

        #table1 {
          top: 280px;
          left: 280px;
        }

        #table2 {
          top: 280px;
          left: 500px;
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

    <!-- <?php
        if (!isset($_COOKIE[$cookie_name]))
        {
            echo "Cookie names '" . $cookie_name . "' is not set!";
        }
        else
        {
            echo "Cookie '" . $cookie_name . "' is set! <br>";
            echo "Value is: " . $_COOKIE[$cookie_name] . "' <br>";
        }
    ?> -->

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
      
          <a class="navbar-brand" href="#">Logo</a>
          <!-- Toggler/collapsibe Button -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>

        <div class="collapse navbar-collapse justify-content-end" id="myNavbar">
          <ul class="navbar-nav">
            <li class="nav-item "><a class="nav-link" href="#reserve">RESERVE</a></li>
            <li class="nav-item"><a class="nav-link" href="#order">ORDER</a></li>
            <li class="nav-item"><a class="nav-link" href="minigame.php">GAME</a></li>
            <li class="nav-item"><a class="nav-link" href="#contact">CONTACT</a></li>
            <li class="nav-item">
              <a class="nav-link dropdown-toggle" href="#more">MORE</a> 
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="navbardrop" data-toggle="dropdown">
                <i class="far fa-user"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myProfile">Profile</a>
                <a class="dropdown-item" href="#">My Order</a>
                <a class="dropdown-item" href="#">Log out</a>
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
            <h4 class="modal-title">Modal Header</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
        
          <!-- Modal body -->
          <div class="modal-body">    
              <p>Name: <?php echo $_SESSION["username"] ?></p>
              <p>Email: <?php echo $_SESSION["email"] ?></p>
              <p>Expire: <?php echo $_SESSION["expiredate"] ?></p>
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
          </div>
          <form method="POST" action="Reserve.php">
            <div class="bg-secondary text-white pb-1 pt-6">
            
              <div class="d-flex p-3">
                  <div class="p-2 flex-fill text-center">
                    <h5>Start Time</h5>
                    
                    <input type="datetime-local" name="time" class="rounded">
                                      
                  </div>
                  <div class="p-2 flex-fill text-center">
                      <h5>Duration</h5>
                      <p id="duration">1</p>
                      
                      <input type="range" name="duration" min="0" max="4" value="1" step="0.5" class="rounded" onchange=UpdateValue(this.value)>
                             
                  </div>
                  <div class="p-2 flex-fill text-center">
                      <h5>People</h5>
                      <input type="number" name="number" class="rounded" >            
                  </div>
                  <div class="d-flex m-3 justify-content-end">
                      <form><input type="button" value="Check Availablity" class="btn btn-info"></form>
                  </div>
              </div>

                <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <canvas id="cafeGUI" width="1030" height="500"></canvas>

                    <div class="form-check seatSelector" id="table1">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="seat" value="1">
                          <img src="seat1.png">
                        </label>
                    </div>
                    
                    <div class="form-check seatSelector" id="table2">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="seat" value="2">
                          <img src="seat1.png">
                        </label>
                    </div>
                  </div>
                </div>

                <div class="d-flex m-5 justify-content-end">
                    <input type="submit" value="Reserve" class="btn btn-success">
                </div> 
            </div> 
        </form> 
    </div>

    <div class="container" id="order">
      <h2 class="text-center m-3">Discover latest coffee choice</h4>
    </div>
    <div class="container" id="foodChoice">
    <div class="row" id="main">
      
      <div class="col-sm-4">
        <div class="card">
        <img class="card-img-top" src="img_avatar1.png" alt="Card image">
        <div class="card-body">
          <h4 class="card-title">coffee choice 1</h4>
          <p class="card-text">description</p>
          <a href="#" class="btn btn-primary float-right">More info</a>
        </div>
        </div>
      </div>
      <div class="col-sm-4">
          <div class="card">
              <img class="card-img-top" src="img_avatar1.png" alt="Card image">
              <div class="card-body">
                <h4 class="card-title">coffee choice 1</h4>
                <p class="card-text">description</p>
                <a href="#" class="btn btn-primary float-right">More info</a>
              </div>
              </div>
      </div>
      <div class="col-sm-4">
          <div class="card">
              <img class="card-img-top" src="img_avatar1.png" alt="Card image">
              <div class="card-body">
                <h4 class="card-title">coffee choice 1</h4>
                <p class="card-text">description</p>
                <a href="#" class="btn btn-primary float-right">More info</a>
              </div>
              </div>
      </div>
    </div>
  </div>



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
          <p>Monday-Friday  9AM-9PM</p>
          <p>Saturday  9AM-6PM</p>
          <p>Sunday  9AM-6PM</p>
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