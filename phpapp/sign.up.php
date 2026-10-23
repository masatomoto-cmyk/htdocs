<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Sign Up</title>
</head>
<body>
    <!-- navタグに class="nav" を指定する -->
<nav class="nav">
  <a href="http://localhost:8888/phpapp/index.php">Home</a>
  <a href="http://localhost:8888/phpapp/sign.up.php">Sign Up</a>
  <a href="http://localhost:8888/phpapp/sign.up.php">Login</a>
</nav>
    </nav>
    <div class="signup">
    <h1>Sign Up</h1>
    <form action="signup.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Sign Up">


    </form>
    </div>
    <div class="login-link">
        <p>Already have an account? <a href="login.php">Login here</a></p>
    
    <h1>Login</h1>
    <form action="login.php" method="POST">
        <label for="login_username">Username:</label>
        <input type="text" id="login_username" name="login_username" required>

        <label for="login_password">Password:</label>
        <input type="password" id="login_password" name="login_password" required>

        <input type="submit" value="Login">
    </form>
    </div>
   
    <div class="todolist">
        <h1>Todo List</h1>
        <form action="todolist.php" method="POST">
            <label for="task">Task:</label>
            <input type="text" id="task" name="task" required>
            <input type="submit" value="Add Task">
        </form>
        <ul>
            <?php
            require_once 'db.php';
            $stmt = $pdo->query("SELECT * FROM tasks");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>" . htmlspecialchars($row['task']) . "</li>";
            }
            ?>
        </ul>
    </div>


</body>
</html>