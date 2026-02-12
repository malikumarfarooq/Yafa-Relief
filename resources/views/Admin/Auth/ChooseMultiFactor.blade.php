<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">

    <title>Multi Factor Auth - Developer Dashboard Kit</title>
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
            <p class="auth-screen-label highlight-text mt-5">Multi Factor Auth</p>
            <div class="greeting-text mb-5">Choose to proceed</div>
            <div class="">
                <div class="custom-checkbox-card d-flex align-items-center" for="emailCheck">
                    <input type="radio" id="emailCheck" name="ma-method" value="ma-with-email" class="form-check-input mt-0 pt-0">
                    <label for="emailCheck">Using Email</label>
                </div>

                <div class="custom-checkbox-card d-flex align-items-center" for="authenticatorCheck">
                    <input type="radio" id="authenticatorCheck" name="ma-method" value="ma-with-authenticator" class="form-check-input mt-0 pt-0">
                    <label for="authenticatorCheck">Using Authenticator</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>

            <p class="signup-link text-start mt-4">Want to go back? <a href="login.html">Login</a></p>
        </form>
    </div>
    <div class="agency-stamp">Developera’s Designed and Developed</div>
        <script src="/admin-assets/js/auth.js"></script>
</body>

</html>