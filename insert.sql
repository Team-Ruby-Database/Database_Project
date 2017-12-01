/*TEAM RUBY: Yin Song, Victoria Cummings, Michelle Kim, Xiao Jiang
Purpose: insert sample data into Professors,Classes,Courses,Skills,Questions,Students tables
How to use: source insert.sql
*/

Use HackerTracker;

/*
insert 2 professors into the professor table
*/
INSERT INTO Professors
VALUES
    (1,'Thomas', 'Allen','thomas.allen@centre.edu','pw0')
    ,(2,'Michael','Bradshaw','michael.bradshaw@centre.edu','pw1')
    ,(3,'Dave','Toth','david.toth@centre.edu','pw2');

/*
insert 2 courses into the courses table
*/
INSERT INTO Courses(
         Course_Name
        ,Department
        ,Course_Code
        ,Course_Status)
VALUES
    ('Introduction to CSC','CSC',117,'active')
    ,('Data Structure','CSC',223,'active');

/*
insert 2 classes into the courses table
*/
INSERT INTO Classes(
         Section
        ,Semester
        ,Year
        ,Professor_ID
        ,Course_ID)
VALUES
    ('a','FA',2016,1,1)
    ,('b','FA',2016,3,1)
    ,('a','SP',2017,1,1)
    ,('a','FA',2017,1,2);

/*
insert 3 skills into the skill table
*/
INSERT INTO Skills
    (Skill_Name,Course_ID)
VALUES
    ('Linux Command',1)
    ,('For Loops',1)
    ,('Data Type',1)
    ,('Array',2);

/*
insert 3 students into the student table
*/
INSERT INTO Students
VALUES
	(1,'John','Smith','john.smith@centre.edu','pwj')
	,(2,'Kate','Young','kate.young@centre.edu','pwk')
	,(3,'Yin','Song','yin.song@centre.edu','pwy');

/*
insert a resource into the resources table
*/
INSERT INTO Resources(
		Reference
       ,Skill_ID)
VALUES 
	('www.forloop.com',2)
	,('www.datatype.com',3)
	,('Linux: From Start To Give Up',1)
	,('Data Structure for Beginners',4);

/*
insert a question into the question table
*/
INSERT INTO Questions
		(Question
       	,Answer
      	,Skill_ID)
VALUES 
	('What is the command to display all the files in the working directory?','ls',1)
	,('What is the command to remove a file?','rm',1)
	,('What is the output of the following code? <br> int t=0; <br> for(int x=0;x<4;x++)<br>    {t+=x;}<br>System.out.println(t);','6',2);
	
INSERT INTO Student_Classes
	VALUES(1,1)
	,(1,4)
	,(2,1)
	,(3,1)
	,(3,4);
	
	
INSERT INTO Student_Questions
VALUES 
	(1,1,'',CURDATE(),CURTIME())
	,(1,2,'',CURDATE(),CURTIME())
	,(2,1,'',CURDATE(),CURTIME())
	,(2,2,'',CURDATE(),CURTIME())
	,(3,1,'',CURDATE(),CURTIME())
	,(3,2,'',CURDATE(),CURTIME())
	,(1,3,'',CURDATE(),CURTIME())
	,(2,3,'',CURDATE(),CURTIME())
	,(3,3,'',CURDATE(),CURTIME())
	;
