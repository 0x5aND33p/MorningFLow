<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Open Day</title>
    <link rel="icon"  href="images/unifavicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php
        session_start();
        $user_id = $_SESSION['user_id'] ?? null;
        include ("navbar.html");
        include ("db_connection.php");

        $conn = db_connections($password);

        $stmt = $conn->prepare("SELECT day,time,subject,activity, location FROM user_schedule
                                WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
    ?>
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
          <div class="carousel-item active">
          <img src="download.jpeg" class="d-block w-100" alt="...">
          </div>  
          <div class="carousel-item">
          <img src="download(1).jpeg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
          <img src="download(2).jpeg" class="d-block w-100" alt="...">
          </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
      </button>
    </div>

    <!-- DropDown -->
    <div class="container mt-3">
      <div class="row">
          <div class="col-md-12">
              <select class="form-select" id="courseDropdown">
                  <option selected disabled>Schedule</option>
                  <option value="computer-science">My Schedule</option>
                  <option value="computer-science">BSc Computer Science</option>
                  <option value="mechanical-engineering">BEng Mechanical Engineering</option>
                  <option value="biomedical-science">BSc Biomedical Science</option>
                  <option value="business-management">BSc Business Management</option>
                  <option value="english-literature">BA English Literature</option>
              </select>
          </div>
      </div>
    </div>




    <!-- Schedule -->
    <div class="container">
    <div class="row p-3">
        <div class="col-md-4">
            <div class="card text-bg-info mb-3">
                <div class="card-header">Monday</div>
                <div class="card-body">
                    <h5 class="card-title">9:00 AM - Math</h5>
                    <p class="card-text">Lecture at Room 101</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-header">Tuesday</div>
                <div class="card-body">
                    <h5 class="card-title">10:00 AM - Physics</h5>
                    <p class="card-text">Lab session</p>
                </div>
            </div>
        </div>
    </div>
</div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const courseDropdown = document.getElementById('courseDropdown');
            const scheduleContainer = document.querySelector('.container:last-child'); // Assuming the schedule is in the last container

            courseDropdown.addEventListener('change', function() {
                const selectedSubject = this.value;

                if (selectedSubject === 'Schedule' || selectedSubject === '') {
                    // Optionally clear the schedule or display a default message
                    scheduleContainer.innerHTML = '';
                    return;
                }

                // Make an AJAX request to the server
                fetch('fetch_schedule.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'subject=' + encodeURIComponent(selectedSubject)
                })
                .then(response => response.text())
                .then(data => {
                    scheduleContainer.innerHTML = data; // Update the schedule container with the received data
                })
                .catch(error => {
                    console.error('Error fetching schedule:', error);
                    scheduleContainer.innerHTML = '<p>Error loading schedule.</p>';
                });
            });
        });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>