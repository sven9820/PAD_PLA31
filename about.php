<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">

    <!-- Titel van tabblad -->
    <title>About</title>

  </head>

  <body>

    <!-- Background begin -->
    <div id="intro" class="view">
    <div class="full-bg-img"></div>
    <!-- Einde background -->

    <!-- Site heading begin -->
    <h1 class="site-heading text-center text-white d-none d-lg-block">
      <span class="site-heading-upper  mb-3">Project Agile Development Planet</span>
    </h1>
    <!-- Einde site heading -->

      <!-- Menu bar -->
        <?php
        session_start();//start de sessie
        include "navigation.php";
        ?>
      <!-- Einde menu bar -->


      <!-- Informatie in jumbotron -->
            <section class="page-section about-heading">
            <div class="container">
            <div class="jumbotron jumbotron-fluid" style="background:#FFE4B5;">
                <div class="about-heading-content">
                  <div class="row">
                    <div class="col-xl-9 col-lg-10 mx-auto">
                      <div class="bg-faded rounded p-5">
                      <h1 class="display-3 text-center">About Our Project</h1>
                      <font color="black">We have received an assignment from Planet to come up with a project.
                        As team 31 we decided to make a map which displays the amount of noise made in a certain area, which can be used for different purposes.
                        The noise levels will be displayed using different colors.
                        Red meaning the area has a lot of noise, while green will be a quiet area.
                        There are different uses for this data our main focus is making the map useful for law enforcement and the government.</font>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
          </section>
      <!-- Einde informatie -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
