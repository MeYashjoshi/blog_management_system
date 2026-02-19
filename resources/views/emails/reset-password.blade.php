<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
</head>

<body>
    <h1>Reset Your Password</h1>
    <p>You satisfy receiving this email because we received a password reset request for your account.</p>
    <p>Click the button below to reset your password:</p>
    <a href="{{ route('reset-password.page', ['token' => $token, 'email' => $email]) }}"
        style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Reset
        Password</a>
    <p>If you did not request a password reset, no further action is required.</p>
</body>

</html>