<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">

    <title>Multi Factor Auth - Code - Developer Dashboard Kit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/admin-assets/css/auth.css">
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />




</head>

<body>
    <div class="auth-container">
        <form action="#" method="POST">
<a href="" class="brand-name mt-3"><img src="/admin-assets/images/logo.png" alt="Brand Logo" class="logo-img"> DeveloperaCRM</a>
            <p class="auth-screen-label highlight-text mt-5">Multi Factor Auth - Code</p>
            <div class="greeting-text mb-4">Enter the code and Access</div>
            <p class="screen-message mb-4">A code has been sent to the <strong
                    style="color: black;">salam@developera.io</strong>, please check your email.</p>
            <p>Enter 6-Didgets Code</p>
            <div class="d-flex align-items-center justify-content-between mb-3">
                <input type="text" class="form-control text-center otp-input" maxlength="1" required>
                <input type="text" class="form-control text-center otp-input" maxlength="1" required>
                <input type="text" class="form-control text-center otp-input" maxlength="1" required>
                <input type="text" class="form-control text-center otp-input" maxlength="1" required>
                <input type="text" class="form-control text-center otp-input" maxlength="1" required>
                <input type="text" class="form-control text-center otp-input" maxlength="1" required>
            </div>
            <div class="d-flex algin-items-center justify-content-between mb-4">
                <p class="screen-message mb-4">Have not received the code? </p>
                <p><a href="/resend-otp" class="highlight-text fw-bold text-decoration-none">Request Again</a> in 1:59 s</p>

            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>

            <p class="signup-link text-start mt-4">Want to go back? <a href="login.html">Login</a></p>
        </form>
    </div>
    <div class="agency-stamp">Developera’s Designed and Developed</div>
    <script src="/admin-assets/js/auth.js"></script>
</body>

</html>