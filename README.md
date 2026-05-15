# Roll-aDice

# 🎲 Dice Game Simulator

This is a web-based dice game simulation created with PHP, HTML, and CSS as a school project.
The application takes input for 3 players, rolls 3 dice for each, calculates the total scores, and declares the winner(s) before automatically resetting.

### 🌍 Live Application Link
The application is hosted on a virtual server and can be accessed via the following link:

👉 **[Access the Live Dice Game Here](http://localhost/Roll-aDice-main/Roll-aDice-main/index.html)**

### ⚙️ Features & Requirements Fulfilled
* **User Input:** Accepts First Name, Last Name, and Address for 3 different players via an HTML form.
* **Randomization:** Generates 3 random dice rolls (values 1-6) for each player.
* **Scoring System:** Calculates the total sum of the dice for each player and identifies the winner with the highest score (handles multiple winners in case of a tie).
* **Session Management:** Utilizes PHP `$_SESSION` to safely store and transfer user data between pages.
* **Auto-Reset:** Implements a JavaScript timeout function that automatically redirects users back to the starting form after 10 seconds.

### 🛠️ Technologies Used
* **Backend:** PHP (Session management, logic, randomization)
* **Frontend:** HTML5, CSS3, JavaScript (Redirect timeout)
* **Server:** Apache (Hosted on a Linux Virtual Machine)
