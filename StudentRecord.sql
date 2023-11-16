CREATE DATABASE StudentRecord;

USE StudentRecord;

CREATE TABLE Student (
StudentID int PRIMARY KEY,
FirstName varchar(255),
LastName varchar(255),
DateOfBirth date,
Email varchar(255),
Phone int
);

CREATE TABLE Course (
CourseID int PRIMARY KEY,
CourseName varchar(255),
Credits int
);

CREATE TABLE Enrollment (
EnrollmentID int PRIMARY KEY,
StudentID int,
CourseID int,
FOREIGN KEY (StudentID) REFERENCES Student(StudentID),
FOREIGN KEY (CourseID) REFERENCES Course(CourseID),
EnrollmentDate date,
Grade int
);

CREATE TABLE Instructor (
InstructorID int PRIMARY KEY,
FirstName varchar(255),
LastName varchar(255),
Email varchar(255),
Phone int
);

INSERT INTO Student(studentID, firstname, lastname, dateofbirth, email, phone)
VALUES (1, "Christian", "Samson", "2000-12-23", "yahoo123@gmail.com", "09812345671"),
(2, "Michael", "Adriano", "2000-01-23", "yahoo456@gmail.com", "09128455234"),
(3, "Glenn", "Ford", "2000-11-11", "whatwhat@gmail.com", "09812345271"),
(4, "Sugar", "Sumasuma", "2000-03-21", "heyhey@gmail.com", "09128353234"),
(5, "Ally", "Madison", "2000-05-15", "wqwer@gmail.com", "09128453734");

INSERT INTO Course(CourseID, CourseName, Credits)
VALUES (1, "CIT1", 9),
(2, "CIT2", 9),
(3, "CIT3", 9),
(4, "CIT4", 9),
(5, "CIT5", 9);

INSERT INTO Instructor(InstructorID, firstname, lastname, email, phone)
VALUES (1, "Cristy", "Jackson", "yahoo123@gmail.com", "09812345971"),
(2, "Samuel", "Jackson", "jackson@gmail.com", "09168455234"),
(3, "Harison", "Ford", "instructyou@gmail.com", "09212345271"),
(4, "Jeff", "Goblum", "teacher4heyhey@gmail.com", "09428353234"),
(5, "Channing", "Tatum", "teacher5@gmail.com", "09178453734");

INSERT INTO Enrollment (EnrollmentID,StudentID,CourseID,EnrollmentDate,Grade)
VALUES (1,1,1,"2023-11-15", 99),
(2,1,2,"2023-11-15", 99),
(3,1,3,"2023-11-15", 99),
(4,2,3,"2023-11-21", 99),
(5,2,4,"2023-11-21", 99),
(6,2,5,"2023-11-21", 99),
(7,3,1,"2023-11-23", 99),
(8,3,3,"2023-11-23", 99),
(9,3,5,"2023-11-23", 99),
(10,4,2,"2023-11-21", 99),
(11,4,4,"2023-11-21", 99),
(12,4,5,"2023-11-21", 99),
(13,5,1,"2023-11-15", 99),
(14,5,2,"2023-11-15", 99),
(15,5,3,"2023-11-15", 99);