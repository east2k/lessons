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

if (isset($_POST['updateStudent'])) {
    $updateStudentID = $_POST['updateStudentID'];
    $updateFirstName = $_POST['updateFirstName'];
    $updateLastName = $_POST['updateLastName'];
    $updateDateOfBirth = $_POST['updateDateOfBirth'];
    $updateEmail = $_POST['updateEmail'];
    $updatePhone = $_POST['updatePhone'];

    $updateStudent = "UPDATE student 
                      SET FirstName='$updateFirstName', LastName='$updateLastName', 
                          DateOfBirth='$updateDateOfBirth', Email='$updateEmail', 
                          Phone='$updatePhone' 
                      WHERE StudentID='$updateStudentID'";

    if ($conn->query($updateStudent) === TRUE) {
        echo "Student record updated successfully";
    } else {
        echo "Error: " . $updateStudent . "<br>" . $conn->error;
    }
}

if (isset($_POST['deleteStudent'])) {
    $deleteStudentID = $_POST['deleteStudentID'];

    // Delete corresponding records from the Enrollment table
    $deleteEnrollment = "DELETE FROM Enrollment WHERE StudentID='$deleteStudentID'";
    if ($conn->query($deleteEnrollment) === TRUE) {
        echo "Enrollment records deleted successfully";
    } else {
        echo "Error: " . $deleteEnrollment . "<br>" . $conn->error;
    }

    // Now, delete the student record
    $deleteStudent = "DELETE FROM student WHERE StudentID='$deleteStudentID'";

    if ($conn->query($deleteStudent) === TRUE) {
        echo "Student record deleted successfully";
    } else {
        echo "Error: " . $deleteStudent . "<br>" . $conn->error;
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
        <tr id='row{$row["StudentID"]}'>
            <td>" . $row["StudentID"] . "</td>
            <td>" . $row["FirstName"] . "</td>
            <td>" . $row["LastName"] . "</td>
            <td>" . $row["DateOfBirth"] . "</td>
            <td>" . $row["Email"] . "</td>
            <td>" . $row["Phone"] . "</td>
            <td> <button class='btn btn-primary' onclick='editRow({$row["StudentID"]})'>Edit</button> </td>
            <td> 
                <form method='post'>
                    <input type='hidden' name='deleteStudentID' value='{$row["StudentID"]}'>
                    <button class='btn btn-danger' name='deleteStudent'>Delete</button> 
                </form>
            </td>
        </tr>
        <tr id='editForm{$row["StudentID"]}' style='display: none;'>
            <form method='post'>
                <td> <input type='text' name='updateStudentID' value='{$row["StudentID"]}' readonly></td>
                <td> <input type='text' name='updateFirstName' value='{$row["FirstName"]}'></td>
                <td> <input type='text' name='updateLastName' value='{$row["LastName"]}'></td>
                <td> <input type='text' name='updateDateOfBirth' value='{$row["DateOfBirth"]}'></td>
                <td> <input type='text' name='updateEmail' value='{$row["Email"]}'></td>
                <td> <input type='text' name='updatePhone' value='{$row["Phone"]}'></td>
                <td> <button class='btn btn-success' name='updateStudent'>Update</button> </td>
            </form>
            <td></td>
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

    echo "</table>";
} else {
    echo "Error: " . $selectStudent . "<br>" . $conn->error;
}

echo '
<script>
    function editRow(studentID) {
        document.getElementById("row" + studentID).style.display = "none";
        document.getElementById("editForm" + studentID).style.display = "table-row";
    }
</script>
';

echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>';
echo "</body>";
echo "</html>";
