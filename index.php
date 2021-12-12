<?php  

// === SESSION === // 
session_start();

// === REQUIRE FUNCTION === //
require 'db/function.php';
$db = new Databasedx();

// === QUERY TRACK === //

$allTrack = $db->getAllTrack();
$getThirdTrack = $db->getThirdTrack();


// === QUERY USERS === //
if( isset($_POST["signup"])) {
  if( !empty($_POST["name"])&&
      !empty($_POST["email"])&&
      !empty($_POST["password"])&&
      !empty($_POST["password2"])) {

        if($_POST["password"] == $_POST["password2"]) {
            $db->signUp(
            $_POST["name"], 
            $_POST["email"],  
            $_POST["password"]);
        } else {
            echo "<script>alert('Password Not Same!');</script>";
        }

  } else {
    echo "<script>alert('Try Again Next Time!');</script>";
  }
}

if( isset($_POST["signin"])) {
  if( !empty($_POST["email"])&&
      !empty($_POST["password"])) {

      if( $db->signIn($_POST["email"], $_POST["password"]) > 1) {
          $_SESSION["signIn"] = true;
          $_SESSION["data"] = $db->signIn($_POST["email"], $_POST["password"]);
          header("Location: dashboard.php");

      } else {
          echo "<script>alert('Try Again Next Time!');</script>";
        }
  }
}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/animate.css">
    <script src="https://kit.fontawesome.com/6dab888157.js" crossorigin="anonymous"></script>
    <title>GetzMusic | Pemutar Musik</title>
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="./assets/images/bulat.png"
    />
  </head>
  <body>

    <nav class="navbar navbar-expand-lg p-3">
      <div class="container">
        <a class="navbar-brand wow bounceInDown" href="index.php"><img src="./assets/images/logo-t.png" alt="logo.png" width="200px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link active wow bounceInDown" href="index.php" data-wow-duration="0.5s" data-wow-delay="0.2s">Home</a>
        
            <a class="nav-item nav-link enjoy-now btn btn-primary wow bounceInDown" href="dashboard.php" data-wow-duration="2.5s" data-wow-delay="0.2s">Dashboard</a>
          </div>
        </div>
      </div>
    </nav>

    <!-- ================================================================ -->

    <section>
      <div class="container headup mb-5">
        <div class="row">
          <div class="col-md-5">
            <h1 class="mb-2 wow fadeInLeft">Listen and enjoy to your favorite music now.</h1>
            <p class="mb-4 wow fadeInLeft">
              Hello World! Let's join to become loyal music listeners,
              you also can be an artist and grow your audience here.
            </p>
            <?php if (isset($_SESSION["signIn"])) : ?>
              <a class="enjoy-now btn btn-primary wow fadeInLeft" href="dashboard.php">Go to Dashboard</a>
            <?php else: ?>
              <a class="enjoy-now btn btn-primary wow fadeInLeft text-uppercase" href="" data-toggle="modal" data-target="#signUp">Sign up</a>
              <a class="enjoy-now btn btn-primary wow fadeInLeft text-uppercase" href="" data-toggle="modal" data-target="#signIn">Sign in</a>
            <?php endif ?>

          </div>
          <div class="col-md-7 mt-3">
            <img src="assets/svg/undraw_walk_in_the_city_1ma6.svg" class="wow fadeInRight">
          </div>
        </div>
      </div>
    </section>


    <!-- ================================================================ -->

    <section style="background-image: url(./assets/images/feature-bg-1.png); background-size: cover;">
      <div class="container trends">
        <div class="row">
          <div class="col-lg title">
            <hr>
            <h5>Trending</h5>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5 wow bounceInLeft"><img src="assets/images/dancing.png" width="375px"></div>
          <div class="col-md-7">
            <?php foreach ($getThirdTrack as $thirdTrack) : ?>
              <div class="carded wow bounceInRight">
                <i class="fas fa-play-circle iCon border-0 btnPp" data-name="<?= $thirdTrack['track_name']; ?>"></i>
                <b class="" style="position: relative; top: -2px;"><?= $thirdTrack['track_artist']; ?></b>
                <p class=""><?= $thirdTrack['track_title']; ?></p>
                <small class=""><?= date('d M Y', $thirdTrack['track_release']); ?></small>
              </div>
            <?php endforeach ?>
          </div>
        </div>
        
      </div>
    </section>


    <!-- ================================================================ -->

    <section class="pb-5" style="background-image: url(http://localhost/getzmusic/assets/images/awesome-feat-bg-1.png); background-size: cover;">
      <div class="container allsearch">
        <div class="row justify-content-center text-center">
          <div class="col-md-10">
            <hr>
            <p style="color: black;">Copyright 2021 <a href="index.php">GetzMusic</a> &copy; All Rights Reserved</p>
          </div>
        </div>
    
      </div>
    </section>



    <!-- ================================================================ -->


    <!-- <footer>
      <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-12 pt-0">
                <p style="color: black;">Copyright 2021 <a href="index.php">GetzMusic</a> &copy; All Rights Reserved</p>
            </div>
            <div class="col-lg-2 col-md-12 socmed">
              <h3>
                  <a href=""><i class="fab fa-facebook-square"></i></a>
                  <a href=""><i class="fab fa-instagram"></i></a>
                  <a href=""><i class="fab fa-google-plus"></i></a>
                  <a href=""><i class="fab fa-telegram"></i></a>
               </h3>
            </div>
        </div>
      </div>
    </footer> -->


    <!-- Modal -->
    <div class="modal fade" id="signUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sign up.</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Your Name..." name="name">
              </div>
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email Address..." name="email">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password..." name="password">
              </div>
              <div class="form-group">
                <label for="password2">Confirmation Password</label>
                <input type="password" class="form-control" id="password2" placeholder="Confirmation Password..." name="password2">
              </div>
              <button type="submit" class="btn btn-primary" name="signup">Sign up</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="signIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sign in.</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="">
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email Address..." name="email">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password..." name="password">
              </div>
              <button type="submit" class="btn btn-primary" name="signin">Sign in</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="assets/js/wow.js"></script>
    <script>
    const music = new Audio();
    $('.btnPp').on('click', function(e) {
      const track = $(this).data('name');

      if(music.paused) {
        e.target.classList.replace('fa-play-circle', 'fa-pause-circle');
        music.src = 'assets/tracks/' + track;
        music.play();
        console.log(e.target);
      } else {
        e.target.classList.replace('fa-pause-circle', 'fa-play-circle');
        music.pause();
      }
    });
  </script>
    <script>
    new WOW().init();
    </script>
  </body>
</html>