/*TEAM RUBY
Yin Song, Victoria Cummings, Michelle Kim, Xiao Jiang
Purpose: create a database hackertracker and initial all the tables
How to use: source initialTables.sql
*/
DROP DATABASE if EXISTS HackerTracker;
Create DATABASE HackerTracker;
Use HackerTracker;

/* #1 Create Table for Professors */
Create Table Professors(
        Professor_ID INT NOT NULL
       ,Professor_First_Name VARCHAR(80) NOT NULL
       ,Professor_Last_Name VARCHAR(80) NOT NULL
       ,Professor_Email VARCHAR(200) NOT NULL
       ,Professor_Password VARCHAR(30) NOT NULL
       ,PRIMARY KEY(Professor_ID)
);

/* #2 Create Table for Courses */
Create Table Courses(
	 Course_ID INT NOT NULL AUTO_INCREMENT
        ,Course_Name VARCHAR(30) NOT NULL
        ,Department CHAR(3) NOT NULL
        ,Course_Code INT NOT NULL
        ,Course_Status CHAR(10) NOT NULL
        ,PRIMARY KEY (Course_ID)
);

/* #3 Create Table for Classes */
Create Table Classes(
         Class_ID INT NOT NULL AUTO_INCREMENT
        ,Section CHAR(1) NOT NULL
        ,Semester CHAR(2) NOT NULL
        ,Year INT NOT NULL
        ,Professor_ID INT NOT NULL
        ,Course_ID INT NOT NULL
        ,PRIMARY KEY (Class_ID)
        ,FOREIGN KEY (Professor_ID) references Professors(Professor_ID)
        ,FOREIGN KEY (Course_ID) references Courses(Course_ID)
); 

/* #4 Create Table for Skills */
Create Table Skills(
       Skill_ID INT NOT NULL AUTO_INCREMENT
       ,Skill_Name VARCHAR(20) NOT NULL
       ,Course_ID INT NOT NULL
       ,PRIMARY KEY (SKill_ID)
       ,FOREIGN KEY (Course_ID) references Courses(Course_ID)
    ON DELETE CASCADE
);

/* #5 Create Table for Students */
Create Table Students(
       Student_ID INT NOT NULL
       ,Student_First_Name VARCHAR(80) NOT NULL
       ,Student_Last_Name VARCHAR(80) NOT NULL
       ,Student_Email VARCHAR(200) NOT NULL
       ,Student_Password VARCHAR(30) NOT NULL
       ,PRIMARY KEY (Student_ID)
);


/* #6 Create Table for Resources */
Create Table Resources(
       Resources_ID INT NOT NULL AUTO_INCREMENT
       ,Reference VARCHAR(255) NOT NULL
       ,Skill_ID INT NOT NULL
       ,PRIMARY KEY(Resources_ID)
       ,FOREIGN KEY(Skill_ID) references Skills(Skill_ID)
              ON DELETE CASCADE
);

/* #7 Create Table for Questions */
Create Table Questions(
       Question_ID INT NOT NULL AUTO_INCREMENT
       ,Question VARCHAR(255) NOT NULL
       ,Answer VARCHAR(255) NOT NULL
       ,Student_Answer VARCHAR(255)
       ,Skill_ID INT NOT NULL
       ,PRIMARY KEY(Question_ID)
       ,FOREIGN KEY(Skill_ID) references Skills(Skill_ID)
    ON DELETE CASCADE
);

/* #8 Create Table for Student_Classes */
Create Table Student_Classes(
        Student_ID INT NOT NULL
       ,Class_ID INT NOT NULL
       ,FOREIGN KEY(Student_ID) references Students (Student_ID)
       ,FOREIGN KEY(Class_ID) references Classes(Class_ID)
);

/* #9 Create Table for Student_Questions */
Create Table Student_Questions(
       Student_ID INT NOT NULL
       ,Question_ID INT NOT NULL
       ,Student_Answer VARCHAR(255)
       ,Date DATE
       ,Time TIME
       ,FOREIGN KEY(Student_ID) references Students(Student_ID)
       ,FOREIGN KEY(Question_ID) references Questions(Question_ID)
);
