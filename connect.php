<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "studentrecord";

$conn = new mysqli($servername, $username, $password, $dbName);

echo "<html>";
echo '
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
';
echo "<body>";

echo "<a class='btn btn-primary m-2' href='/lessons/student-table.php'>Student</a>";
echo "<a class='btn btn-primary m-2' href='/lessons/course-table.php'>Course</a>";
echo "<a class='btn btn-primary m-2' href='/lessons/instructor-table.php'>Instructor</a>";
echo "<a class='btn btn-primary m-2' href='/lessons/enrollment-table.php'>Enrollment</a>";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['addStudent'])) {
    $newStudentID = $_POST['newStudentID'];
    $newStudentFirstName = $_POST['newStudentFirstName'];
    $newStudentLastName = $_POST['newStudentLastName'];
    $newStudentDateOfBirth = $_POST['newStudentDateOfBirth'];
    $newStudentEmail = $_POST['newStudentEmail'];
    $newStudentPhone = $_POST['newStudentPhone'];

    $insertStudent = "INSERT INTO student (StudentID,FirstName, LastName, DateOfBirth, Email, Phone)
                      VALUES ('$newStudentID','$newStudentFirstName', '$newStudentLastName', '$newStudentDateOfBirth', '$newStudentEmail', '$newStudentPhone')";

    if ($conn->query($insertStudent) === TRUE) {
        echo "New student record created successfully";
    } else {
        echo "Error: " . $insertStudent . "<br>" . $conn->error;
    }
}

$selectStudent = "SELECT * FROM student";
$studentResults = $conn->query($selectStudent);

if ($studentResults) {

    echo "
    <table class='table'>
    <tr>
        <th>Student ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date of Birth</th>
        <th>Email</th>
        <th>Phone</th>
        <th></th>
        <th></th>
    </tr>";

    while ($row = $studentResults->fetch_assoc()) {
        echo "
    <tr>
        <td>" . $row["StudentID"] . "</td>
        <td>" . $row["FirstName"] . "</td>
        <td>" . $row["LastName"] . "</td>
        <td>" . $row["DateOfBirth"] . "</td>
        <td>" . $row["Email"] . "</td>
        <td>" . $row["Phone"] . "</td>
        <td> <button class='btn btn-primary' >Edit</button> </td>
        <td> <button class='btn btn-danger' >Delete</button> </td>
    </tr>";
    }

    echo "
    <tr>
        <form method='post'>
            <td> <input type='text' name='newStudentID' placeholder='Student ID'></td>
            <td> <input type='text' name='newStudentFirstName' placeholder='First Name'></td>
            <td> <input type='text' name='newStudentLastName' placeholder='Last Name'></td>
            <td> <input type='text' name='newStudentDateOfBirth' placeholder='Date of Birth'></td>
            <td> <input type='text' name='newStudentEmail' placeholder='Email'></td>
            <td> <input type='text' name='newStudentPhone' placeholder='Phone'></td>
            <td> <button class='btn btn-primary' name='addStudent'>Add</button> </td>
        </form>
    </tr>";

    echo "
    </table>";
} else {
    echo "Error: " . $selectStudent . "<br>" . $conn->error;
}



echo "<hr>";

$selectCourse = "SELECT * FROM course";
$courseResults = $conn->query($selectCourse);

if ($courseResults) {
    echo "
    <table class='table'>
    <tr>
        <th>Course ID</th>
        <th>Course Name</th>
        <th>Credits</th>
    </tr>";

    while ($row = $courseResults->fetch_assoc()) {
        echo "
    <tr>
        <td>" . $row["CourseID"] . "</td>
        <td>" . $row["CourseName"] . "</td>
        <td>" . $row["Credits"] . "</td>
    </tr>";
    }

    echo "
    </table>";
} else {
    echo "Error: " . $selectCourse . "<br>" . $conn->error;
}

echo "<hr>";

$selectInstructor = "SELECT * FROM instructor";
$instructorResults = $conn->query($selectInstructor);

if ($instructorResults) {
    echo "
    <table class='table'>
    <tr>
        <th>Instructor ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
    </tr>";

    while ($row = $instructorResults->fetch_assoc()) {
        echo "
    <tr>
        <td>" . $row["InstructorID"] . "</td>
        <td>" . $row["FirstName"] . "</td>
        <td>" . $row["LastName"] . "</td>
        <td>" . $row["Email"] . "</td>
        <td>" . $row["Phone"] . "</td>
    </tr>";
    }

    echo "
    </table>";
} else {
    echo "Error: " . $selectInstructor . "<br>" . $conn->error;
}


echo "<hr>";

$selectEnrollment = "SELECT * FROM enrollment";
$enrollmentResults = $conn->query($selectEnrollment);

if ($enrollmentResults) {
    echo "
    <table class='table'>
    <tr>
        <th>Enrollment ID</th>
        <th>Student ID</th>
        <th>Course ID</th>
        <th>Enrollment Date</th>
        <th>Grade</th>
    </tr>";

    while ($row = $enrollmentResults->fetch_assoc()) {
        echo "
    <tr>
        <td>" . $row["EnrollmentID"] . "</td>
        <td>" . $row["StudentID"] . "</td>
        <td>" . $row["CourseID"] . "</td>
        <td>" . $row["EnrollmentDate"] . "</td>
        <td>" . $row["Grade"] . "</td>
    </tr>";
    }

    echo "
    </table>";
} else {
    echo "Error: " . $selectEnrollment . "<br>" . $conn->error;
}
echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>';
echo "</body>";
echo "</html>";
