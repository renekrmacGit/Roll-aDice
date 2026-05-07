<?php
// Start the session (mandatory requirement)
session_start();

// 1. Process form submission and save to session
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['start_game'])) {
    
    $users = []; // 2D array for users
    
    // Loop 3 times to get data for all 3 players
    for ($i = 0; $i < 3; $i++) {
        $users[] = [
            'name' => htmlspecialchars($_POST['name'][$i]),
            'surname' => htmlspecialchars($_POST['surname'][$i]),
            'address' => htmlspecialchars($_POST['address'][$i])
        ];
    }
    
    // Save the 2D array into the session
    $_SESSION['users'] = $users;
}

// Security check: if session doesn't exist, redirect to index
if (!isset($_SESSION['users'])) {
    header("Location: ../index.html");
    exit;
}

$users = $_SESSION['users'];
$results = []; // 1D array to store the sum of dice for each user
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dice Game - Results</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Game Results</h1>
        
        <?php
        // 2. Loop through users, generate dice, and calculate sums
        foreach ($users as $index => $user) {
            echo "<div class='user-block'>";
            echo "<h3>Player " . ($index + 1) . ": {$user['name']} {$user['surname']}</h3>";
            echo "<p><strong>Address:</strong> {$user['address']}</p>";
            
            $sum = 0;
            echo "<p><strong>Rolled dice:</strong><br><br>";
            
            // Generate 3 random dice for the current user
            for ($j = 0; $j < 3; $j++) {
                $dice = rand(1, 6);
                $sum += $dice;
                
                // Display the dice image (going one folder up into dice folder)
                echo "<img src='../dice/{$dice}.png' alt='Dice {$dice}' class='dice-img' onerror=\"this.src='../dice/{$dice}.gif'\">";
            }
            echo "</p>";
            echo "<p><strong>Total Sum: {$sum}</strong></p>";
            echo "</div>";

            // Store the final sum in the 1D array
            $results[$index] = $sum;
        }

        // 3. Determine the winner(s)
        $max_score = max($results);
        $winners = [];

        foreach ($results as $index => $score) {
            if ($score == $max_score) {
                $winners[] = $users[$index]['name'] . " " . $users[$index]['surname'];
            }
        }

        // Display the winner(s)
        echo "<div class='winner-text'>";
        echo "WINNER(S) with {$max_score} points:<br>";
        foreach ($winners as $winner) {
            echo "<strong>" . $winner . "</strong><br>";
        }
        echo "</div>";
        
        echo "<p style='text-align:center; color:#555; margin-top:20px;'>Redirecting back to start in 10 seconds...</p>";

        // Destroy session so the next game starts fresh
        session_destroy();
        ?>

        <script>
            setTimeout(function() {
                // Path to redirect back to main index.html
                window.location.href = '../index.html';
            }, 10000);
        </script>
    </div>
</body>
</html>