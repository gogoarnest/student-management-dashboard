<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Management Dashboard</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="app">
    <header>
      <h1>Student Management Dashboard</h1>
      <p>Add students, display marks, calculate grades, and export to Excel.</p>
    </header>

    <!-- Add Student -->
    <section class="card">
      <h2>Add New Student</h2>

      <form id="studentForm">
        <div class="form-row">
          <label for="studentId">Student ID</label>
          <input type="text" id="studentId" required placeholder="e.g. 2025001" />
        </div>

        <div class="form-row">
          <label for="studentName">Name</label>
          <input type="text" id="studentName" required placeholder="e.g. Sarah Ahmed" />
        </div>

        <div class="form-row">
          <label for="studentCourse">Course</label>
          <input type="text" id="studentCourse" required placeholder="e.g. Math" />
        </div>

        <div class="form-row">
          <label for="studentMark">Mark</label>
          <input type="number" id="studentMark" required min="0" max="100" placeholder="0 - 100" />
        </div>

        <button type="submit" class="btn primary">Add Student</button>
      </form>
    </section>

    <!-- Student List -->
    <section class="card">
      <div class="card-header">
        <h2>Students List</h2>

        <div class="actions">
          <button id="exportBtn" class="btn">Export to Excel</button>
          <button id="clearBtn" class="btn danger">Clear All</button>
        </div>
      </div>

      <div class="table-wrapper">
        <table id="studentsTable">
          <thead>
            <tr>
              <th>#</th>
              <th>Student ID</th>
              <th>Name</th>
              <th>Course</th>
              <th>Mark</th>
              <th>Grade</th>
            </tr>
          </thead>

          <tbody>
            <!-- JS will add rows -->
          </tbody>
        </table>
      </div>
    </section>

  </div>

  <script src="app.js"></script>
  
</a>

</body>
</html>
