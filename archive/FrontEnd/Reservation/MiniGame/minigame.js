//window.addEventListener("load", Start(), false);
//update = setTimeout(Update(), 1);
//clearTimeout(update);

window.onload = function(){
    
    var start = Date.now(),
        canvas = document.getElementById("myCanvas"),
	    context = canvas.getContext("2d"),
	    width = canvas.width = window.innerWidth / 2,
        height = canvas.height = window.innerHeight,
        score = 0,
        posx = 10,
        posy = 10,
        speedx = 0,
        speedy = 0,
        gravity = 0.2,
        move = false,
        gameStage=0, //0-menu, 1-main, 2-gameover
        cubeWidth = 50,
        lastJumpTime = start,
        steps = [],
        buttons = [],
        dead = false,
        deathSound = new Audio("aud/death.wav"),
        jumpSound = new Audio("aud/jump.mp3"),
        scoreSound = new Audio("aud/score.wav"),
        startSound = new Audio("aud/start.wav"),
        username = document.getElementById("currentUser").innerText;
        playerSpawned = false;
        inCollision = false;

    

    GameSetUp();
    Menu();

    //MainGame(); 
        
    Update();

    
    function GameSetUp(){
        deathSound.volume = 1;
        jumpSound.volume = 0.5;
        scoreSound.volume = 0.4;
        startSound.volume = 1;

        setInterval(function(){if (gameStage === 1)GenerateSteps();}, 1700);
        setInterval(function(){if (gameStage === 1 && playerSpawned === true)UpdateScore();}, 3000);
        
        document.addEventListener("keydown", function(event){ 
            console.debug(posx + ", " + posy);      
            if (event.which == 65) //go left
            {      
                console.debug("left");
                speedx = -5;
                move = true;
            }
            else if (event.which == 68) //go right
            {
                console.debug("right");
                speedx = 5;
                move = true;
            }
        });

        document.addEventListener("keyup", function(event){ 
            console.debug(posx + ", " + posy);      
            if (event.which == 65 || event.which == 68) //go left
            {    
                move = false;
            }  
        });

        document.addEventListener("keydown", function(event){
            if ((event.which == 32 && Date.now() - lastJumpTime > 1345 && isGrounded) || inCollision) //jump up
            {
                jumpSound.play();
                lastJumpTime = Date.now();
                speedy = -8.5;
            }
        });
    }

    function MainGame (){
        buttons.pop;
        gameStage = 1;
        score = 0;
        dead = false;
        setTimeout(function(){SpawnPlayer();}, 3000); 
    }

    function Menu(){
        //create a butotn and render
        buttons.push({
            x: width/2-50,
            y: height/2+25,
            w: 100,
            h: 50
        },
        {
            x: width/2-50,
            y: height/2+100,
            w: 100,
            h: 50
        });

        //request for data
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var myObj = this.responseText;
                document.getElementById("leaderboard").innerHTML = myObj;
                
            }
        };
        xmlhttp.open("GET", "/BackEnd/Reservation/MiniGame/FetchGameRecord.php", true);
        xmlhttp.send();

        canvas.addEventListener("click", function(event) {
            console.debug(event.x + " " + event.y);
            // Control that click event occurred within position of button
            // NOTE: This assumes canvas is positioned at top left corner 
            if (gameStage === 0){
                if (
                    event.x > buttons[0].x && 
                    event.x < buttons[0].x + buttons[0].w &&
                    event.y > buttons[0].y && 
                    event.y < buttons[0].y + buttons[0].h
                ) {
                    // Executes if button was clicked!
                    //alert('Button was clicked!');
                    startSound.play();
                    MainGame();
                    context.restore();              
                }
                else if (
                    event.x > buttons[1].x && 
                    event.x < buttons[1].x + buttons[1].w &&
                    event.y > buttons[1].y && 
                    event.y < buttons[1].y + buttons[1].h
                ) {
                    window.location.replace("../main.php");
                }
            }
        });   
    }  

    function GameOver(){
        
        //save score in json format
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        var credit = ((score)/100);
        //var x = JSON.stringify({Username: username, Score: score, Time: today});

        //ajax update database score
        $.ajax({
            url: "/BackEnd/Reservation/MiniGame/updateScore.php",
            type: "POST",
            data: { 'Username': username, 'Score': score, 'Time': today.toDateString(), 'Credits': (score/10) },                   
            success: function(data)
                        { 
                            alert("Good game! Your score is "+score+" and you won "+credit+" points!");                                    
                        }
        }); 
        
        //ajax update credits
        $.ajax({
            url: "/BackEnd/Admin/admin.php",
            type: "POST",
            data: { 'username': username, 'amount': credit, 'button': 'add' },                   
            success: function(data)
            {
                if(data == false) {
                    alert("Error: not able to respond to the request.");
                } else { 
                    
                }
            }
        });

        console.debug("game over");
        //clearInterval(1);
        //clearInterval(2);
        gameStage = 0;
        context.clearRect(0, 0, width, height);  
        document.location.reload(true);    
        //Menu();
    }

    function isGrounded(){
        if (posy >= height - 150){
            return true;
        }
        else {
            return false;
        }
    }

    function SpawnPlayer(){
        posx = Math.floor((Math.random() * 100) + 1) + 50;
        posy = 100;
        speedy = 0;
        speedx = 0;
        playerSpawned = true;
    }

    function GenerateSteps(){
        
        var x = Math.floor((Math.random() * 3) + 1);
        for (i=0; i<x; i++){
            steps.push({
                length: Math.floor((Math.random() * 70) + 1) + 30,
                height: 10,
                originx: Math.floor((Math.random() * 270/x) + 1) + 130 * i,
                originy: -5
                
            });
        }  
    }   

    function DetectCollision(){
        for (i=0; i<steps.length; i++){
            //issue for horizontal move
            if(posy > steps[i].originy-cubeWidth && posy < steps[i].originy+steps[i].height){
                inCollision = true;
                //left approach
                if (posx + cubeWidth > steps[i].originx && posx + cubeWidth - speedx <= steps[i].originx){
                    //speedx = 0;
                    posx = steps[i].originx - cubeWidth;
                }
                //right approach
                else if (posx < steps[i].originx + steps[i].length && posx - speedx >= steps[i].originx + steps[i].length){
                    //speedx = 0;
                    posx = steps[i].originx + steps[i].length;
                }
            }
            
            //check if it's within the steps
            if (posx > steps[i].originx-cubeWidth && posx < steps[i].originx+steps[i].length){  
                inCollision = true;         
                if (posy + cubeWidth > steps[i].originy && posy + cubeWidth - speedy <= steps[i].originy + steps[i].height){
                    speedy = 0;
                    posy = steps[i].originy - cubeWidth;
                }
                else if (posy < steps[i].originy + steps[i].height && posy - speedy >= steps[i].originy){
                    speedy += gravity;
                    posy = steps[i].originy + 10;
                }
            }
       
        }  
        inCollision = false; 
    }

    function MoveSteps(){
        for (i=0; i<steps.length; i++){
            //move steps
            steps[i].originy += Math.floor((Math.random() * 3)) + 1;
        }
    }

    function UpdateScore(){
        score += 100;

        //play some sound
        scoreSound.play();
    }

    function ApplyGravity(){
        speedy += gravity; 
        
    }

    function UpdateCube(){
        if (move){
            posx += speedx;
        }
    }

    function Render(){
        context.clearRect(0, 0, width, height);

        if (gameStage === 0){
            //render the menu
            
            //render the start button
            context.fillStyle = "black";
            context.lineWidth = 1;
            context.beginPath();
            context.rect(buttons[0].x, buttons[0].y, buttons[0].w, buttons[0].h);
            context.stroke();

            context.font="30px Verdana";
            context.textAlign="center"; 
            // Create gradient
            var gradient=context.createLinearGradient(0, 0, canvas.width, canvas.height);
            gradient.addColorStop("0","blue");
            gradient.addColorStop("0.5","green");
            gradient.addColorStop("1.0","red");
            // Fill with gradient
            context.fillStyle=gradient;
            context.fillText("Start",buttons[0].x+buttons[0].w/2,buttons[0].y+buttons[0].h*(2/3));

            //render the back button
            context.fillStyle = "black";
            context.lineWidth = 1;
            context.beginPath();
            context.rect(buttons[1].x, buttons[1].y, buttons[1].w, buttons[1].h);
            context.stroke();

            context.font="30px Verdana";
            context.textAlign="center"; 
            // Create gradient
            var gradient=context.createLinearGradient(0, 0, canvas.width, canvas.height);
            gradient.addColorStop("0","blue");
            gradient.addColorStop("0.5","green");
            gradient.addColorStop("1.0","red");
            // Fill with gradient
            context.fillStyle=gradient;
            context.fillText("Quit",buttons[1].x+buttons[1].w/2,buttons[1].y+buttons[1].h*(2/3));
        }
        else if (gameStage === 1){
            //render the cube
            if (playerSpawned === true){
                context.strokeStyle="black";
                context.fillStyle="black";
                context.beginPath();
                context.rect(posx, posy, cubeWidth, cubeWidth);
                //context.arc(posx, posy, 2, 0, Math.PI * 2);
                context.fill();  
                context.strokeStyle="red";
                context.lineWidth=10;
                context.beginPath();
                context.moveTo(posx+15, posy+20);
                context.lineTo(posx+20, posy+20);
                context.moveTo(posx+30, posy+20);
                context.lineTo(posx+35, posy+20);
                context.stroke();
            }

            //render the steps
            for (i=0; i<steps.length; i++){
                context.strokeStyle="gray";
                context.lineWidth=10;
                context.beginPath();
                context.rect(steps[i].originx, steps[i].originy, steps[i].length, steps[i].height);
                context.fill();
            }

            //render the scoreboard
            context.font="10px Verdana";
            context.fillStyle="black";
            context.fillText("Score: " + score, width-50, 30);
        }

        context.restore();

    }

    function Update(){
        
        MoveSteps();
        if (gameStage === 1 && playerSpawned === true){
            if (dead === false)
                DetectCollision();

            CheckBound(posx, posy);   
        }
        
        Render();
        requestAnimationFrame(Update);
    }

    function CheckBound(x, y){
        if (x + speedx <= 0){
            speedx = 0;
            posx = 0;
        }
        else if (x + speedx >= width-cubeWidth){
            speedx = 0;
            posx = width - cubeWidth;
        }
        else {
            UpdateCube();
        }

        if (y - speedy < 0){
            posy = 0.1;
        }
        else if (y >= height - cubeWidth && !dead){
            deathSound.play();
            speedy = -5;
            dead = true;
        }
        else {
            ApplyGravity();
        }  

        if (y >= height){
            GameOver();
        }
        
        posy += speedy;
    }
};

