<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Application</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Product management</h1>
        <div id="login-form" class="mt-3">
            <h2>session start</h2>
            <form id="form-login">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $('#form-login').submit(function(event) {
            event.preventDefault();
            var name = $('#name').val();
            var password = $('#password').val();

            $.ajax({
                url: "/api/login",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    name: name,
                    password: password
                }),
                success: function(response) {
                    localStorage.setItem('token', response.token);
                    window.location.href = "/products";
                },
                error: function(error) {
                    alert("Login failed, please check your credentials and try again.");
                },
            });
        });
    </script>
</body>

</html>
