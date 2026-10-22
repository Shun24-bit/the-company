<?php
  session_start();

  include "../classes/User.php";

  $user_obj = new User;

  $all_users = $user_obj->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer">

  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <nav class="navbar navbar-expand navbar-dark bg-dark" style="margin-bottom: 80px">
    <div class="container">
      <a href="dashabord.php" class="navbar-brand">
        <h1 class="h3">The Company</h1>
      </a>
      <div class="navbar-nav">
        <span class="navbar-text"> <?= $_SESSION['full_name'] ?> </span>
        <form action="../actions/logout.php" method="post" class="d-flex ms-2">
          <button type="submit" class="text-danger bg-transparent border-0">Log Out</button>
        </form>
      </div>
    </div>
  </nav>

  <main class="row justify-content-center gx-0">
    <div class="col-6">
      <h2 class="text-center">USER LIST</h2>

      <table class="table table-hover align-middle">
        <thead>
            <tr>
              <th> <!-- for photo --> </th>
              <th>ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Username</th>
              <th><!-- action buttons --></th>
            </tr>
        </thead>
        <tbody>
          <?php
          foreach($all_users as $user){
          ?>
          <tr>
            <td>
              <?php
              if($user['photo']){
              ?>
              <img src="../assets/images/<?= $user['photo']?>" alt="<?= $user['photo'] ?>" class="d-block mx-auto dashboard-photo">
              <?php
              } else {
              ?>
                <i class="fas fa-user text-secondary d-block text-center dashboard-icon mx-auto"></i>
              <?php  
              }
              ?>
            </td>
            <td><?= $user['id'] ?></td>
            <td><?= $user['first_name'] ?></td>
            <td><?= $user['last_name'] ?></td>
            <td><?= $user['username'] ?></td>
            <td>
              <?php
              if($_SESSION['id'] == $user['id']){
              ?>
                <a href="edit-user.php" class="btn btn-outline-warning" title="Edit">
                  <i class="far fa-pen-to-square"></i>
                </a>
                <a href="delete-user.php" class="btn btn-outline-danger" title="Delete">
                  <i class="far fa-trash-can"></i>
                </a>
              <?php
              }
              ?>
            </td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </main>
  
</body>
</html>