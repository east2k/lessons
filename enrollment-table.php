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

if (isset($_POST['addEnrollment'])) {
    $newEnrollmentID = $_POST['newEnrollmentID'];
    $newStudentID = $_POST['newStudentID'];
    $newCourseID = $_POST['newCourseID'];
    $newEnrollmentDate = $_POST['newEnrollmentDate'];
    $newGrade = $_POST['newGrade'];

    $insertEnrollment = "INSERT INTO enrollment (EnrollmentID, StudentID, CourseID, EnrollmentDate, Grade)
                         VALUES ('$newEnrollmentID', '$newStudentID', '$newCourseID', '$newEnrollmentDate', '$newGrade')";

    if ($conn->query($insertEnrollment) === TRUE) {
        echo "New enrollment record created successfully";
    } else {
        echo "Error: " . $insertEnrollment . "<br>" . $conn->error;
    }
}

if (isset($_POST['updateEnrollment'])) {
    $updateEnrollmentID = $_POST['updateEnrollmentID'];
    $updateStudentID = $_POST['updateStudentID'];
    $updateCourseID = $_POST['updateCourseID'];
    $updateEnrollmentDate = $_POST['updateEnrollmentDate'];
    $updateGrade = $_POST['updateGrade'];

    $updateEnrollment = "UPDATE enrollment 
                         SET StudentID='$updateStudentID', CourseID='$updateCourseID', 
                             EnrollmentDate='$updateEnrollmentDate', Grade='$updateGrade' 
                         WHERE EnrollmentID='$updateEnrollmentID'";

    if ($conn->query($updateEnrollment) === TRUE) {
        echo "Enrollment record updated successfully";
    } else {
        echo "Error: " . $updateEnrollment . "<br>" . $conn->error;
    }
}

if (isset($_POST['deleteEnrollment'])) {
    $deleteEnrollmentID = $_POST['deleteEnrollmentID'];

    // Now, delete the enrollment record
    $deleteEnrollment = "DELETE FROM enrollment WHERE EnrollmentID='$deleteEnrollmentID'";

    if ($conn->query($deleteEnrollment) === TRUE) {
        echo "Enrollment record deleted successfully";
    } else {
        echo "Error: " . $deleteEnrollment . "<br>" . $conn->error;
    }
}

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
        <th></th>
        <th></th>
    </tr>";

    while ($row = $enrollmentResults->fetch_assoc()) {
        echo "
        <tr id='row{$row["EnrollmentID"]}'>
            <td>" . $row["EnrollmentID"] . "</td>
            <td>" . $row["StudentID"] . "</td>
            <td>" . $row["CourseID"] . "</td>
            <td>" . $row["EnrollmentDate"] . "</td>
            <td>" . $row["Grade"] . "</td>
            <td> <button class='btn btn-primary' onclick='editRow({$row["EnrollmentID"]})'>Edit</button> </td>
            <td> 
                <form method='post'>
                    <input type='hidden' name='deleteEnrollmentID' value='{$row["EnrollmentID"]}'>
                    <button class='btn btn-danger' name='deleteEnrollment'>Delete</button> 
                </form>
            </td>
        </tr>
        <tr id='editForm{$row["EnrollmentID"]}' style='display: none;'>
            <form method='post'>
                <td> <input type='text' name='updateEnrollmentID' value='{$row["EnrollmentID"]}' readonly></td>
                <td> <input type='text' name='updateStudentID' value='{$row["StudentID"]}'></td>
                <td> <input type='text' name='updateCourseID' value='{$row["CourseID"]}'></td>
                <td> <input type='text' name='updateEnrollmentDate' value='{$row["EnrollmentDate"]}'></td>
                <td> <input type='text' name='updateGrade' value='{$row["Grade"]}'></td>
                <td> <button class='btn btn-success' name='updateEnrollment'>Update</button> </td>
            </form>
            <td></td>
        </tr>";
    }

    echo "
    <tr>
        <form method='post'>
            <td> <input type='text' name='newEnrollmentID' placeholder='Enrollment ID'></td>
            <td> <input type='text' name='newStudentID' placeholder='Student ID'></td>
            <td> <input type='text' name='newCourseID' placeholder='Course ID'></td>
            <td> <input type='text' name='newEnrollmentDate' placeholder='Enrollment Date'></td>
            <td> <input type='text' name='newGrade' placeholder='Grade'></td>
            <td> <button class='btn btn-primary' name='addEnrollment'>Add</button> </td>
        </form>
    </tr>";

    echo "</table>";
} else {
    echo "Error: " . $selectEnrollment . "<br>" . $conn->error;
}

echo '
<script>
    function editRow(enrollmentID) {
        document.getElementById("row" + enrollmentID).style.display = "none";
        document.getElementById("editForm" + enrollmentID).style.display = "table-row";
    }
</script>
';

echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>';
echo "</body>";
echo "</html>";
?>