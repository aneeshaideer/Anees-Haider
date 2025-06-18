<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form id="loginForm">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
        <div id="responseMessage"></div>
    </div>

    <script>
    $(document).ready(function() {
        $('#loginForm').submit(function(e) {
            e.preventDefault();
            
            $.ajax({
                url: 'api/login.php',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#responseMessage').html('<div class="success">' + response.message + '</div>');
                        setTimeout(() => {
                            window.location.href = 'index.php';
                        }, 1500);
                    } else {
                        $('#responseMessage').html('<div class="error">' + response.message + '</div>');
                    }
                },
                error: function() {
                    $('#responseMessage').html('<div class="error">An error occurred. Please try again.</div>');
                }
            });
        });
    });
    </script>
</body>
</html>