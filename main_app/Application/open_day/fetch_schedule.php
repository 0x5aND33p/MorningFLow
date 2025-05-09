<?php
    session_start();
    $user_id = $_SESSION['user_id'] ?? null;
    include ("db_connection.php");

    $conn = db_connections($password);

    if (isset($_POST['subject'])) {
        $selectedSubject = $_POST['subject'];

        if ($selectedSubject === 'my-schedule' && $user_id !== null) {
            $stmt = $conn->prepare("SELECT day, time, subject, activity, location FROM user_schedule WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
        } else if ($selectedSubject !== 'my-schedule' && $selectedSubject !== '') {
            $stmt = $conn->prepare("SELECT day, time, subject, activity, location FROM course_schedule WHERE course_name = ?");
            $stmt->bind_param("s", $selectedSubject);
        } else {
            // Handle cases where no valid subject is selected
            echo '<p>Please select a schedule.</p>';
            exit();
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $scheduleHTML = '<div class="row p-3">';
            while ($row = $result->fetch_assoc()) {
                $scheduleHTML .= '<div class="col-md-4">';
                $scheduleHTML .= '<div class="card text-bg-info mb-3">'; // You might want to vary the color based on the day or subject
                $scheduleHTML .= '<div class="card-header">' . htmlspecialchars($row['day']) . '</div>';
                $scheduleHTML .= '<div class="card-body">';
                $scheduleHTML .= '<h5 class="card-title">' . htmlspecialchars($row['time']) . ' - ' . htmlspecialchars($row['subject']) . '</h5>';
                $scheduleHTML .= '<p class="card-text">' . htmlspecialchars($row['activity']) . ' at ' . htmlspecialchars($row['location']) . '</p>';
                $scheduleHTML .= '</div>';
                $scheduleHTML .= '</div>';
                $scheduleHTML .= '</div>';
            }
            $scheduleHTML .= '</div>';
            echo $scheduleHTML;
        } else {
            echo '<p>No schedule found for ' . htmlspecialchars($selectedSubject) . '.</p>';
        }

        $stmt->close();
        $conn->close();
    } else {
        echo '<p>Invalid request.</p>';
    }
?>