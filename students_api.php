<?php
require_once "connection.php";

// =============== READ STUDENTS ===============
if ($_SERVER["REQUEST_METHOD"] == "GET" && !isset($_GET["action"])) {

    $result = mysqli_query($conn, "SELECT * FROM students ORDER BY mark DESC");

    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo json_encode($students);
    exit();
}


// =============== CLEAR ALL STUDENTS ===============
if (isset($_GET["action"]) && $_GET["action"] === "clear") {

    mysqli_query($conn, "TRUNCATE TABLE students");

    echo json_encode(["message" => "All students cleared"]);
    exit();
}


// =============== ADD NEW STUDENT ===============
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = json_decode(file_get_contents("php://input"), true);

    $studentId = $data["student_id"];
    $name      = $data["name"];
    $course    = $data["course"];
    $mark      = intval($data["mark"]);

    // ---- Calculate Grade ----
    if ($mark >= 90)      $grade = "A";
    else if ($mark >= 80) $grade = "B";
    else if ($mark >= 70) $grade = "C";
    else if ($mark >= 60) $grade = "D";
    else                  $grade = "F";

    // ---- Insert into DB ----
    $sql = "INSERT INTO students (student_id, name, course, mark, grade)
            VALUES ('$studentId', '$name', '$course', $mark, '$grade')";

    mysqli_query($conn, $sql);

    echo json_encode(["message" => "Student added successfully"]);
    exit();
}

?>
