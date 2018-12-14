TEAM :
- Michela Karen Rakotondralambo
  250607514
	MySQL database (2 points)
	Security - Server Side (2 points)

- Lancer Guo
  260728557 
	Canvas (1 point)
	Bootstrap (1 point)
	Localhost - XAMPP Apache(2 points)

- Bessie Luo 
  260708568
	Security - Packet Encryption (2 points)
	JSON (1 point)
	PHP (1 point)

Everyone:
- HTML5/CSS (2 points)
- JavaScript/DOM (2points)


DESCRIPTION OF HOW TO RUN YOUR SITE

SET UP
1 - Copy paste index.html and both BackEnd and FrontEnd folders to the htdocs folder of XAMPP
2 - Install the database and create a database called "myDB"
3 - In the new database, execute the files included under /BackEnd/DatabaseSetupFile
4 - Start XAMPP and start both database and website servers
5 - Open index.html for the home page
6 - Create the user with username "admin" to represent the café admin account
7 - Create a user to represent a client 


ADMIN
Login with username "admin" to get to the admin page where you are able to access the database. To display a client information, juste write their username and click 'display'. To add/delete membership points, write the username of the client and the amount you would like to "add/remove". 

RESERVATION
Once logged into the main page, there are six options for the users to select at the top menu panel, user may also explore the page by scrolling the page:

1. Reserve
By clicking the Reserve button, the main page will direct user to the Reservation section. User may select the time slot for that day, how long he is planning to stay and how many people is coming. 

Afterwards, he needs to click CheckAvailability button to see if the current slot and duration is reserved or not. If any table is open then options will show up at the bottom, near the Reserve button, or a message will show up if no table is available.

After selecting a table successfully, by clicking the Reserve button, a reservation will be sent to the backend server with all the information user entered, corresponding credits will be deducted and the reservation will be recorded into the database table called Reservations and information in the table called TimeTable will be updated as well. At the same time, a success message will pop up on user’s side. 

2. Menu
By clicking the Menu button, the main page will direct user to the menu section, where all the orders are listed. 

3. Survey
By clicking the Survey button, User will enter another page to finish his survey, where he will need to make different choice to get a recommendation on the menu. At the end, he may be able to choose to go back to main page.

4. Game
One of the feature of this website is that user may be able to challenge themselves to win credits by trying the game. In the game page, on the left there is the main canvas for the game, and on the right, there is the leaderboard and rules. The leaderboard records the first five highest score and this will be updated every time a user beat one of the score. At the end of each game, a message will tell user how much score he got and how much credits is won by this. User can click quit button on the menu to go back to main page any time.

5. Contact
By clicking the Survey button, user will be directed to the bottom of the page where contact info and open hours are listed. By clicking the green arrow sign at the footer, it will direct user to the top of the page.
6. Personal information
In personal information section, user may click the profile button to check his login info and personal info. User may also choose to log out by clicking the logout button which will redirect user to the login page.