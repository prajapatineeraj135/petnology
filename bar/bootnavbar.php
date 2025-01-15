<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">

  <div class="container-fluid">

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">

    <img src="../media/images/logo1.png" width="100px" alt="logo" id="logo">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        

        <?php if (isset($_SESSION['user_id'])): ?>
          <!-- User is logged in, show My Account and Log Out -->
        <li class="nav-item">
          <a class="nav-link" href="http://localhost:3000/petnology/pages/my_account.php">My Account</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="http://localhost:3000/petnology/pages/tracking.php">Track</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="http://localhost:3000/petnology/auth/logout_code.php">Log Out</a>
        </li>
        
        <?php else: ?>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://localhost:3000/petnology">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://localhost:3000/petnology/pages/tracking.php">Track</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://localhost:3000/petnology/pages/login.php">Login</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://localhost:3000/petnology/pages/signup.php">Signup</a>
        </li>

        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>