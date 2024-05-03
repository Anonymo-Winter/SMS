<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
  <title>Document</title>
</head>
<body>
  <p id="count">0</p>  
  <button id="inc" value="inc">increment</button>
  <button id="reset" value="reset">reset</button>
  <button id="dec" value="dec">decrement</button> -->
<!-- <script>
  target = document.getElementById("count");
  inc = document.getElementById("inc");
  reset = document.getElementById("reset");
  dec = document.getElementById("dec");
  inc.onclick = function(){
    target.innerHTML = parseInt(target.innerHTML)+1;
  }
  dec.onclick = function(){
    target.innerHTML = parseInt(target.innerHTML)-1;
  }
  reset.onclick = function(){
    target.innerHTML = 0;
  }
</script> -->
<!-- <script>
  var target = $("#count");
  $("#inc").click(function(){
    target.html(parseInt(target.html())+1);
  });
  $("#reset").click(function(){
    target.html(0);
  });
  $("#dec").click(function(){
    target.html(parseInt(target.html())-1);
  });
</script>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Web Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Bootstrap Page</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Jumbotron -->
  <div class="jumbotron">
    <h1 class="display-4">Hello, world!</h1>
    <p class="lead">This is a simple Bootstrap web page.</p>
    <hr class="my-4">
    <p>It uses common Bootstrap components like navbar, jumbotron, and buttons.</p>
    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
  </div>

  <!-- Container -->
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h2>Feature 1</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget ultricies eros.</p>
      </div>
      <div class="col-md-4">
        <h2>Feature 2</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget ultricies eros.</p>
      </div>
      <div class="col-md-4">
        <h2>Feature 3</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget ultricies eros.</p>
      </div>
    </div>
  </div>

  <footer class="footer bg-dark text-white text-center py-3">
    <div class="container">
      <span>&copy; 2024 Bootstrap Page</span>
    </div>
  </footer>

  <!-- Bootstrap JS (optional) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
