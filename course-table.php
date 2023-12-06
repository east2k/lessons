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
  <title>Course Table</title>
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

if (isset($_POST['addCourse'])) {
    $newCourseID = $_POST['newCourseID'];
    $newCourseName = $_POST['newCourseName'];
    $newCourseCredits = $_POST['newCourseCredits'];

    $insertCourse = "INSERT INTO course (CourseID, CourseName, Credits)
                     VALUES ('$newCourseID', '$newCourseName', '$newCourseCredits')";

    if ($conn->query($insertCourse) === TRUE) {
        echo "New course record created successfully";
    } else {
        echo "Error: " . $insertCourse . "<br>" . $conn->error;
    }
}

if (isset($_POST['updateCourse'])) {
    $updateCourseID = $_POST['updateCourseID'];
    $updateCourseName = $_POST['updateCourseName'];
    $updateCourseCredits = $_POST['updateCourseCredits'];

    $updateCourse = "UPDATE course 
                     SET CourseName='$updateCourseName', Credits='$updateCourseCredits' 
                     WHERE CourseID='$updateCourseID'";

    if ($conn->query($updateCourse) === TRUE) {
        echo "Course record updated successfully";
    } else {
        echo "Error: " . $updateCourse . "<br>" . $conn->error;
    }
}

if (isset($_POST['deleteCourse'])) {
    $deleteCourseID = $_POST['deleteCourseID'];

    // Delete corresponding records from the Enrollment table
    $deleteEnrollment = "DELETE FROM Enrollment WHERE CourseID='$deleteCourseID'";
    if ($conn->query($deleteEnrollment) === TRUE) {
        echo "Enrollment records deleted successfully";
    } else {
        echo "Error: " . $deleteEnrollment . "<br>" . $conn->error;
    }

    // Now, delete the course record
    $deleteCourse = "DELETE FROM course WHERE CourseID='$deleteCourseID'";

    if ($conn->query($deleteCourse) === TRUE) {
        echo "Course record deleted successfully";
    } else {
        echo "Error: " . $deleteCourse . "<br>" . $conn->error;
    }
}

$selectCourse = "SELECT * FROM course";
$courseResults = $conn->query($selectCourse);

if ($courseResults) {

    echo "
    <table class='table'>
    <tr>
        <th>Course ID</th>
        <th>Course Name</th>
        <th>Credits</th>
        <th></th>
        <th></th>
    </tr>";

    while ($row = $courseResults->fetch_assoc()) {
        echo "
        <tr id='row{$row["CourseID"]}'>
            <td>" . $row["CourseID"] . "</td>
            <td>" . $row["CourseName"] . "</td>
            <td>" . $row["Credits"] . "</td>
            <td> <button class='btn btn-primary' onclick='editRow({$row["CourseID"]})'>Edit</button> </td>
            <td> 
                <form method='post'>
                    <input type='hidden' name='deleteCourseID' value='{$row["CourseID"]}'>
                    <button class='btn btn-danger' name='deleteCourse'>Delete</button> 
                </form>
            </td>
        </tr>
        <tr id='editForm{$row["CourseID"]}' style='display: none;'>
            <form method='post'>
                <td> <input type='text' name='updateCourseID' value='{$row["CourseID"]}' readonly></td>
                <td> <input type='text' name='updateCourseName' value='{$row["CourseName"]}'></td>
                <td> <input type='text' name='updateCourseCredits' value='{$row["Credits"]}'></td>
                <td> <button class='btn btn-success' name='updateCourse'>Update</button> </td>
            </form>
            <td></td>
        </tr>";
    }

    echo "
    <tr>
        <form method='post'>
            <td> <input type='text' name='newCourseID' placeholder='Course ID'></td>
            <td> <input type='text' name='newCourseName' placeholder='Course Name'></td>
            <td> <input type='text' name='newCourseCredits' placeholder='Credits'></td>
            <td> <button class='btn btn-primary' name='addCourse'>Add</button> </td>
        </form>
    </tr>";

    echo "</table>";
} else {
    echo "Error: " . $selectCourse . "<br>" . $conn->error;
}

echo '
<script>
    function editRow(courseID) {
        document.getElementById("row" + courseID).style.display = "none";
        document.getElementById("editForm" + courseID).style.display = "table-row";
    }
</script>
';

echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>';
echo "</body>";
echo "</html>";
?>