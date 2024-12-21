<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Results 🎓</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to bottom right, #4facfe, #00f2fe);
            font-family: 'Arial', sans-serif;
            color: white;
            text-align: center;
            padding: 50px;
        }
        .result {
            background: white;
            color: black;
            padding: 20px;
            border-radius: 20px;
            display: inline-block;
        }
        .btn-back {
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 10px;
            margin-top: 20px;
            display: inline-block;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="result">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $grades = isset($_POST['grades']) ? $_POST['grades'] : [];

            if (empty($grades)) {
                echo "<p>No grades provided. 😢</p>";
            } else {
                $gradePoints = [
                    'A+' => 2.5,
                    'A'  => 2.0,
                    'B+' => 1.5,
                    'B'  => 1.0,
                    'C+' => 0.0,
                    'C'  => 0.0,
                    'D+' => 0.0,
                    'D'  => 0.0
                ];

                $totalPoints = 0;
                $invalidGrades = [];

                foreach ($grades as $grade) {
                    $grade = strtoupper(trim($grade));
                    if (array_key_exists($grade, $gradePoints)) {
                        $totalPoints += $gradePoints[$grade];
                    } else {
                        $invalidGrades[] = $grade;
                    }
                }

                if (!empty($invalidGrades)) {
                    echo "<p style='color: red;'>Invalid grades received: " . implode(', ', $invalidGrades) . " 😢</p>";
                }

                echo "<h2>Total Points: <strong>$totalPoints</strong> 🎉</h2>";

                if ($totalPoints >= 8) {
                    echo "<p>Congratulations, you're a Gold Star Achiever! 🌟</p>";
                } elseif ($totalPoints >= 5) {
                    echo "<p>Great work! You're on the Silver Team! ⭐</p>";
                } else {
                    echo "<p>Don't worry! Keep trying, and you'll shine! ✏️</p>";
                }
            }
        } else {
            echo "<p>Please submit grades via the form.</p>";
        }
        ?>
        <a href="index.php" class="btn-back">Back to Enter Grades</a>
    </div>
</body>
</html>
