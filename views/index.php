<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body class="bg-light">
  <div style="height:100vh">
    <div class="row h-100 m-0">
      <div class="card w-25 my-auto mx-auto">
        <div class="card-header bg-white border-0 py-3">
          <h1 class="text-center">LOGIN</h1>
        </div>
        <dic class="card-body">
          <form action="../actions/login.php" method="post">
            <input type="text" name="username" placeholder="USERNAME" class="form-control mb-2" required autofocus>
            <input type="password" name="password" id="password" placeholder="PASSWORD" class="form-control mb-5">
            <button type="submit" class="btn btn-primary w-100">Log in</button>
          </form>

          <p class="text-center mt-3 small">
            <a href="register.php">Create Account</a>
          </p>
        </dic>
      </div>
    </div>
  </div>
  
</body>
</html>