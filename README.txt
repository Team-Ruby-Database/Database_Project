 -------------------------
| Team Ruby		 |
 -------------------------
--Victoria Cummings,Yin Song, Michelle Kim, Xiao Jiang
--This is the README for our database application and will provide a brief 
--overview of the files and what they do.

Right now, the login page doesn't work. Xiao is working on it. 


 -------------------------
| How to use the database |
 -------------------------
1. modify 3 variables in 'db_connection.php'
---$dbhost = "localhost";
---$dbuser = "root";
---$dbpass = "";

2. Use 'initialTables.sql' to initial empty tables

3. Use 'insert.sql' to insert sample data into the database



 -----------------------
|	Files		|
 -----------------------
initialTables.sql
	This is the sql file that we use to set up our database. It creates all tables, and drops the database initially if it 	exists already. 

insert.sql
	This is what initially populates our tables. 

db_connection.php
	included in all files.
	This file builds a connection to the database HackerTracker. Include it in every file connected to this database. 

studentClasses.php
	Previous: main_login.php
	Links to: skillDashboard.php
	This file gets the student information from the login page, passed through SESSION. It takes that information and uses it to query the 	database, returning the classes that the student is in, on the condition that those classes are active. It connects directly to skillDashboard, passing what class was clicked through the link.

skillDashboard.php
	Previous: studentClasses.php	
	Links to: question.php
	This file takes whichever class was clicked and displays all skills related to that class. It passes to the next file what skill was clicked.

question.php
	Previous: studentClasses.php
	Links to: feedback.php
	This takes whichever skill was clicked on the last page and displays all the skills linked to that question. If there are no questions, it displays a message telling you so.

feedback.php
	Previous: studentClasses.php
	Links to: question.php
	Depending on whether or not you answered all questions correctly, feedback.php can do different things. If all were correct, it'll show you message about the number of questions, and a congratulations for answering 	them all correctly. If you got one or more wrong, it'll show you what question you missed, and it'll redirect you to the question page if you wanted to retry.

professorClasses.php
	Previous: main_login.php
	Links to: classDashboard.php
	This file displays a list of classes that are currently taught by the professor. When you click a class, it will pass class and course information on to the following page.

classDashboard.php
	Previous: professorClasses.php
	Links to: skillEditor.php, professorClasses.php
	This page shows an overview of student progress and buttons for each student that lead to individual views of the student's progress. It also has a "manage skills" button that leads to the skillEditor.php. A back button leads back to professorClasses.php 

skill_editor.php
	Previous: classDashboard.php
	Links to: question_editor.php, classDashboard.php
	This page allows you to add or delete skills. There is also a back button that links to classDashboard.php

question_editor.php
	Previous: skill_editor.php
	Links to: nothing 
	Allows you to enter a question and an answer and it will add them to the database. Deleting is still in the process of being fixed.

grade.php
	A series of useful functions that are used throughout our database. They do various things, including tracking the progress of students in a course. Check the file for individual comments.

added_skill.php
	includes a function that inserts a skill into the database

add_questions.html
	This is supposed to be the page that displays a message when you successfully add a question in the question_editor.php, but for now it is hardcoded.
