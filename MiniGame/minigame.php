<!DOCTYPE html>
<?php

    // server should keep session data for AT LEAST 1 hour
    ini_set('session.gc_maxlifetime', 3600);

    // each client should remember their session id for EXACTLY 1 hour
    session_set_cookie_params(3600);

    //start the session
    session_start();
?>

<html lang=en>
    <header>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="minigame.js"></script>
        <style type="text/css">
            html {
                background-color: black;
            }
            #myCanvas {   
                margin: -8px;
                background-color: white;
                
                border-left: 5px solid cornflowerblue;
                border-right: 5px solid cornflowerblue;			
            }
            #intro{
                position: absolute;
                margin-left: 20px;
                top: 400px;
                
                font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                color:white;
                display:inline-block;
            }
            #leaderboard{
                position: absolute;
                margin-left: 20px;
                font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                display:inline-block;
            }
            
            
        </style>
    </header>

    <body>
        <div id="currentUser" style="display: none;"><?php echo $_SESSION["username"];?></div>
        <canvas id="myCanvas"></canvas>
            <div id="leaderboard"></div>  
            <div id="intro">
                    <h2>Simple Jump</h2>
                    <h3>Try to get the highest score!</h3>
                    <p>Use A, D to move left and right</p>
                    <p>Press space to jump, you can jump in the air too! (don't overuse it)</p>
                    <p>Dont't fall to the bottom!</p>
                    
            </div>  
            
    </body>
</html>