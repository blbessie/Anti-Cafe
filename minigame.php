<!DOCTYPE html>
<?php
    //start the session
    session_start();
?>

<?php
     
?>

<html lang=en>
    <header>
        <script src="gamescript.js"></script>
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
            #intro {
                position: absolute;
                margin-left: 20px;
                font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                color:white;
                display:inline-block;
            }
            
        </style>
    </header>

    <body>
        <canvas id="myCanvas"></canvas>
            <div id="intro">
                    <h2>Simple Jump</h2>
                    <h3>Try to get the highest score!</h3>
                    <p>Use A, D to move left and right</p>
                    <p>Press space to jump, you can jump in the air too! (don't overuse it)</p>
                    <p>Dont't fall to the bottom!</p>
            </div>        
    </body>
</html>