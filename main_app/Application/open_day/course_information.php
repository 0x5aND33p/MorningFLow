<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Information - University of Wolverhampton</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Custom Styles */
        .header {
            background: linear-gradient(90deg, #007BFF, #0056b3);
            color: white;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
        }

        .course-card {
            color: white;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .course-card:hover {
            transform: scale(1.03);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .STEM { background: linear-gradient(135deg, #007BFF, #0047A3); }
        .Business { background: linear-gradient(135deg, #28a745, #1E7D31); }
        .Humanities { background: linear-gradient(135deg, #9b59b6, #6A2E91); }
    </style>
</head>
<body>

    <?php include("navbar.html"); ?>

    <div class="header">Course Information</div>

    <div class="container mt-4">
        <div class="row g-3 align-items-center">
            <div class="col-md-6">
                <input type="text" class="form-control" id="searchBar" placeholder="Search for a course..." onkeyup="filterCourses()">
            </div>
            <div class="col-md-6">
                <select class="form-select" id="filterCategory" onchange="filterCourses()">
                    <option value="all">All Categories</option>
                    <option value="STEM">STEM</option>
                    <option value="Business">Business</option>
                    <option value="Humanities">Humanities</option>
                </select>
            </div>
        </div>

        <div class="row mt-4" id="courseList"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="modalCategory"></p>
                    <p id="modalDescription"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const courses = [
            { title: "BSc Computer Science", category: "STEM", description: "Learn programming, AI, and cybersecurity." },
            { title: "BEng Mechanical Engineering", category: "STEM", description: "Explore mechanics, materials, and robotics." },
            { title: "BSc Biomedical Science", category: "STEM", description: "Investigate human biology and medical research." },
            { title: "BSc Business Management", category: "Business", description: "Develop leadership and strategic skills." },
            { title: "BA English Literature", category: "Humanities", description: "Analyze literature, poetry, and modern writing." }
        ];

        function displayCourses(filteredCourses = courses) {
            document.getElementById('courseList').innerHTML = filteredCourses.map((course, index) => `
                <div class="col-md-4">
                    <div class="card course-card ${course.category} p-3" onclick="openModal(${index})">
                        <h5>${course.title}</h5>
                        <button class="btn btn-light btn-sm mt-2">More Info</button>
                    </div>
                </div>
            `).join('');
        }

        function filterCourses() {
            const searchValue = document.getElementById("searchBar").value.toLowerCase();
            const selectedCategory = document.getElementById("filterCategory").value;
            const filteredCourses = courses.filter(course =>
                (selectedCategory === "all" || course.category === selectedCategory) &&
                course.title.toLowerCase().includes(searchValue)
            );
            displayCourses(filteredCourses);
        }

        function openModal(index) {
            const course = courses[index];
            document.getElementById("modalTitle").innerText = course.title;
            document.getElementById("modalCategory").innerText = "Category: " + course.category;
            document.getElementById("modalDescription").innerText = course.description;
            new bootstrap.Modal(document.getElementById("modal")).show();
        }

        displayCourses();
    </script>
</body>
</html>
