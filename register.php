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
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form id="registerForm">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
        <div id="responseMessage"></div>
    </div>

    <script>
    $(document).ready(function() {
        $('#registerForm').submit(function(e) {
            e.preventDefault();
            
            $.ajax({
                url: 'api/register.php',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#responseMessage').html('<div class="success">' + response.message + '</div>');
                        $('#registerForm')[0].reset();
                        setTimeout(() => {
                            window.location.href = 'login.php';
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