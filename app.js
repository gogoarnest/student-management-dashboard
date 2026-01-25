// تحميل الطلاب عند فتح الصفحة
window.onload = loadStudents;

// ====================== جلب الطلاب من الباك ======================
async function loadStudents() {
    const res = await fetch("students_api.php");
    const students = await res.json();
    window.currentStudents = students; // تخزينهم لاستخدامهم في Export
    renderTable(students);
}

// ====================== عرض الجدول ======================
function renderTable(students) {
    const tableBody = document.querySelector("#studentsTable tbody");
    tableBody.innerHTML = "";

    students.forEach((s, i) => {
        const tr = document.createElement("tr");

        // Pass / Fail Colors
        tr.style.backgroundColor = s.mark >= 50 ? "#e9ffe9" : "#ffe5e5";

        tr.innerHTML = `
            <td>${i + 1}</td>
            <td>${s.student_id}</td>
            <td>${s.name}</td>
            <td>${s.course}</td>
            <td>${s.mark}</td>
            <td>${s.grade}</td>
        `;

        tableBody.appendChild(tr);
    });
}

// ====================== إضافة طالب جديد ======================
document.getElementById("studentForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    const student = {
        student_id: studentId.value,
        name: studentName.value,
        course: studentCourse.value,
        mark: studentMark.value
    };

    await fetch("students_api.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(student)
    });

    loadStudents(); // تحديث الجدول بعد الإضافة
    this.reset();
});

// ====================== Clear All ======================
document.getElementById("clearBtn").addEventListener("click", async () => {
    if (!confirm("Are you sure you want to clear all students?")) return;

    await fetch("students_api.php?action=clear", { method: "GET" });

    loadStudents(); // تحديث الجدول
});

// ====================== Export to Excel ======================
document.getElementById("exportBtn").addEventListener("click", () => {
    if (!window.currentStudents || window.currentStudents.length === 0) {
        return alert("No data to export.");
    }

    const header = ["#", "ID", "Name", "Course", "Mark", "Grade"];
    const rows = window.currentStudents.map((s, i) => [
        i + 1,
        s.student_id,
        s.name,
        s.course,
        s.mark,
        s.grade
    ]);

    const csv = [header, ...rows]
        .map(r => r.join(","))
        .join("\n");

    const blob = new Blob([csv], { type: "text/csv" });
    const url = URL.createObjectURL(blob);

    const a = document.createElement("a");
    a.href = url;
    a.download = "students.csv";
    a.click();

    URL.revokeObjectURL(url);
});
