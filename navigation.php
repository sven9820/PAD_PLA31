<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
    <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="about.php">About</a>
                </li>
                <?php
                if ($_SESSION['id']){
                    echo "<li class=\"nav-item px-lg-4\">
                    <a class=\"nav-link text-uppercase text-expanded\" href=\"logout.php\">Logout</a>
                </li>";
                }
                else echo "<li class=\"nav-item px-lg-4\">
                    <a class=\"nav-link text-uppercase text-expanded\" href=\"login.php\">Login</a>
                </li>";
                ?>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="contact.php">Contact</a>
                </li>?>
            </ul>
        </div>
    </div>
</nav>
