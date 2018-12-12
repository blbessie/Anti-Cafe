	
	/* LIST OF VARIABLES */	
	
	var questionState = 0;	//Keeps track of users place in quiz
	var quizActive = true;	//True until last question is answered
		
	var userStats =	[
						0,	//cute
						0, 	//spooky
						0, 	//lame 
						0, 	//nerdy 
						0, 	//silly 
						0 	//cool 
					];
	
	var tempStats = userStats; //Holds stat increases relating to user selection
	
	/* QUIZ BUILDING VARIABLES */
	
	//The following array contains all question text elements
	
	var questionText =	[															
							"How did you spend your time in the late 90s/early 00s?", 	//q1
							"It's snack time. What are you eating?", 					//q2
							"What TV show did you most look forward to after school?", 	//q3
							"What toy could you not put down growing up?", 				//q4
							"What did you listen to in the 90s/early 00s?", 			//q5
							"What was your go to computer program at school?" 			//q6
						];
	
	//The following array contains all answer text elements for each question
	
	var answerText =	[		//question 1 answers													
							[	"Playing Neopets", 				
								"Playing Kingdom of Loathing", 
								"Trolling chatrooms",
								"Playing Quake or Doom",
								"I didn't have the internet",
								"Watching flash videos"],							
								
								//question 2 answers
							[	"Yowie", 							
								"Curly Wurlys and Chomps",
								"Mamee Noodles",
								"Fruit",
								"Sunnyboys",
								"Fruit rollups"],
								
								//question 3 answers
							[	"Round the Twist", 
								"Rugrats",
								"Neighbours",
								"Are You Afraid of the Dark?",
								"Rocko's Modern Life",
								"Art Attack"],
								
								//question 4 answers
							[	"Cabbage Patch Doll", 
								"Rubix Cube",
								"Slime",
								"Hot Wheels",
								"Mighty Max/Polly Pocket",
								"Tamagotchi"],
								
								//question 5 answers
							[	"Spice Girls",
							 	"I didn't listen to music", 
								"rage",
								"Backstreet Boys",
							 	"The sweet sound of dial up",
								"So Fresh CDs"],		

								//question 6 answers								
							[	"Kid Pix", 
								"Minesweeper",
								"Lemmings",
								"Zoombinis",
								"Microsoft Paint",
								"Pinball"]
						]
	
	//The following array contains all personality stat increments for each answer of every question
	
	var answerValues =	[		//question 1 answer values
							[	[3,0,1,0,2,0], 		
								[0,0,0,1,2,3],		
								[0,3,0,2,1,0],
								[0,2,0,3,0,1],
								[2,1,3,0,0,0],
								[1,0,2,0,3,0] 
							],	
						
								//question 2 answer values
							[	[0,3,0,2,0,1], 
								[2,0,0,0,3,1],
								[0,2,0,0,1,3],
							 	[2,0,3,1,0,0],
								[1,0,0,3,2,0],
								[3,0,1,0,2,0] 
							],

								//question 3 answer values
							[	[0,1,0,0,3,2], 
								[3,0,2,0,1,0],
								[1,0,3,0,2,0],
							 	[0,3,0,1,2,0],
								[0,0,0,2,1,3],
								[0,0,0,3,1,2] 
							],
								
								//question 4 answer values
							[	[2,0,3,0,1,0], 
								[0,1,0,3,0,2],
								[0,3,2,0,0,1],
							 	[0,0,0,2,1,3],
								[2,0,0,0,3,1],
								[3,0,0,2,1,0] 
							],
								
								//question 5 answer values
							[	[3,0,0,0,2,1], 
								[0,2,3,1,0,0],
								[0,0,0,2,1,3],
							 	[1,3,0,0,0,2],
								[0,0,0,3,2,1],
								[1,0,2,0,3,0] 
							],
								
								//question 6 answer values
							[	[1,0,0,3,2,0], 
								[0,3,0,2,0,1],
								[3,1,0,0,0,2],
							 	[1,0,0,2,3,0],
								[0,0,3,2,1,0],
								[0,0,1,2,0,3] 
							]
						]

	var results = document.getElementById("results");
	var quiz = document.getElementById("quiz");
	var body = document.body.style;
	var printResult = document.getElementById("topScore");
	var buttonElement = document.getElementById("button");
	
	/* QUIZ FUNCTIONALITY */
	
	buttonElement.addEventListener("click", changeState);	//Add click event listener to main button
	
	/* This function progresses the user through the quiz */
	
	function changeState() {								
		
		updatePersonality(); 	//Adds the values of the tempStats to the userStats										
		
		if (quizActive) {	
			
			/*True while the user has not reached the end of the quiz */
			
			initText(questionState);	//sets up next question based on user's progress through quiz
			questionState++;			//advances progress through quiz
			
			buttonElement.disabled = true; //disables button until user chooses next answer
			buttonElement.innerHTML = "Please select an answer";			
			buttonElement.style.opacity = 0.7;
			
		} else {
			
			/*All questions answered*/
			
			setCustomPage(); //runs set up for result page
		}
	}
	
	/* This function determines the question and answer content based on user progress through the quiz */

	function initText(question) {							
		
		var answerSelection = ""; //text varialbe containting HTML code for the radio buttons' content
		
		/* Creates radio buttons based on user progress through the quiz - current 'id' generation is not w3c compliant*/
		
		for (i = 0; i < answerText[question].length; i++) {		
			
			answerSelection += "<li><input type='radio' name='question" +
			(question+1) + "' onClick='setAnswer("+i+")' id='" + answerText[question][i] + "'><label for='" + answerText[question][i] + "'>" + answerText[question][i] + "</label></li>";
		}
		
		document.getElementById("questions").innerHTML = questionText[question];	//set question text
		document.getElementById("answers").innerHTML = answerSelection;				//set answer text
	}
	
	/* This function is called when a user selects an answer, NOT when answer is submitted */
	
	function setAnswer(input) {
				
		clearTempStats();									//clear tempStats in case user reselects their answer
		
		tempStats = answerValues[questionState-1][input];	//selects personality values based on user selection 
				
		if (questionState < questionText.length) {
			
			/*True while the user has not reached the end of the quiz */
			
			buttonElement.innerHTML = "Continue";
			buttonElement.disabled = false;
			buttonElement.style.opacity = 1;
					
		} else {
			
			/*All questions answered - QUESTION TIME IS OVER!*/
			
			quizActive = false;
			buttonElement.innerHTML = "Display your custom dish"
			buttonElement.disabled = false;
			buttonElement.style.opacity = 1;
		}
	}
	
	/* This function sets tempStats to 0 */
	
	function clearTempStats() {
		
		tempStats = [0,0,0,0,0,0];	
	}
	
	/*This function adds the values of the tempStats to the userStats based on user selection */
	
	function updatePersonality() {
		
		for (i = 0; i < userStats.length ; i++) {
			userStats[i] += tempStats[i];
		}
	}
	
	/* This function determines the highest personality value */
	
	function setCustomPage() {
		
		var highestStatPosition = 0;	//highest stat defaults as 'cute'
		
		/* This statement loops through all personality stats and updates highestStatPosition based on a highest stat */
		
		for (i = 1 ; i < userStats.length; i++) {
			
			if (userStats[i] > userStats[highestStatPosition]) {
				highestStatPosition = i;
			}
		}
		
		displayCustomPage(highestStatPosition); //passes the index value of the highest stat discovered
		
		/* Hides the quiz content, shows results content */
		quiz.style.display = "none";		
	}
	
	
	/* The following code manipulates the CSS based on the personality results */
			
	function displayCustomPage(personality) {
		switch (personality) {
			
			case 0:	//cute code
				document.getElementById("show_results").innerHTML = '<h1> Rainbow Macaron </h1><div id="quiz"><div id="questions">You\'re a cute person. We recommad you to\
																try out our rainbow color macarons\
																</div></div><br><br>\
																<p id="quiz">Made with Almond, Egg, Oats, Sugar</p><br><br>';
				break;
				
			case 1:		//spooky
				document.getElementById("show_results").innerHTML = '<h1> Spicy Pumpkin Chili </h1><div id="quiz"><div id="questions">You\'re a spooky person. We recommad you to\
															try out our halloween special dish</div></div>\
															<br><br>\
															<p id="quiz">Made with Ground Beef, Red Pepper, Pumpkin Pie, Tomatoes</p><br><br>';
				break;
				
			case 2:		//lame
				document.getElementById("show_results").innerHTML = '<h1> Perfect Cappuccino </h1><div id="quiz"><div id="questions">You\'re a lame person. We recommad you to\
																take a sip of our perfect coffee</div></div>\
																<br><br>\
																<p id="quiz">Made with Fresh Milk, Hot Brewed Coffee Beans</p><br><br>';
				break;
				
			case 3:		//nerdy
				results.style.display = "inline-block";
				document.getElementById("show_results").innerHTML = '<h1> Banana Protein Bomb Smoothie </h1><div id="quiz"><div id="questions">You\'re a nerdy person. We recommad you to\
																have a sip of our signature smoothie\
																</div></div><br><br>\
																<p id="quiz">Made with Banada, Coconut Yoghurt, Oats, Organic Vegan Protein, Cinnamon.</p><br><br>';
				break;
				
			case 4:		//silly
				results.style.display = "inline-block";
				document.getElementById("show_results").innerHTML = '<h1> Chocolate Volcano Cake </h1><div id="quiz"><div id="questions">You\'re a silly person. We recommad you to\
																try our volcano cake\
																</div></div><br><br>\
																<p id="quiz">Made with Mentos, Butter Cream, Milk, Chocolate Powder, Egg.</p><br><br>';
				break;
				
			case 5:		//cool
				document.getElementById("show_results").innerHTML = '<h1> Real Mojito </h1><div id="quiz"><div id="questions">You\'re a cool person. We recommad you to\
																try our signature mojito drink\
																</div></div><br><br>\
																<p id="quiz">Made with Mint leaves, Lime, Water.</p><br><br>';
				break;
				
			default: 
				document.getElementById("show_results").innerHTML = '<h1> Hot Breakfast Sandwich </h1><div id="quiz"><div id="questions">You\'re a mystery person. We recommad you to\
																try out our special Sandwich\
																</div></div><br><br>\
																<p id="quiz">Made with Seasoned Egg, Chesse, Bacon</p><br><br>';
				break;

		}
	}

	function goBack() {
		document.location.href = '../main.php';
	}