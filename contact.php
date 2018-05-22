<?php
if ($_POST['submit']) {
    if(!$_POST['name']){
        $error="<br/>- Please enter your name";
    }
    if(!$_POST['email']){
        $error.="<br/>- Please enter your email";
    }
    if(!$_POST['message']){
        $error.="<br/>- Please enter your message";
    }
    if(!$_POST['check']){
        $error.="<br/>- Please confirm you are human";
    }
    if ($error) {
        $result='<div class="alert alert-danger" role="alert"> Some of the fields are not filled. Please correct the following: '.$error.'</div>';
    } else {
        mail("fenerli_70@live.nl", "Contact Form", "Name: ".$_POST['name'].
            "Email: ".$_POST['email'].
            "Message: ".$_POST['message']);
        {
            $result='<div class="alert alert-success" role="alert"> Thank you for contacting us, you will get a respond soon. </div>';
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">

    <title>Contact</title>
</head>

<body>

<!--Background begin -->
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
    include "navigation.php";
    ?>
    <!--Einde menu bar -->

    <!-- Contact form -->
    <section id="contact">
        <div class="container">
            <div class="jumbotron">
                <div class="col-sm-10" style="margin-left: 250px; margin-top: -50px;>
        <div class="row">
                <div class="col-md-8 col-md-offset-3" >
                    <h1 class="text-center"> Contact Form</h1>

                    <?php echo $result;?>
                    <form method="post" role="form">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Please enter your name..." value="<?php echo $_POST['name']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Please enter your email..." value="<?php echo $_POST['email']; ?>">
                        </div>
                        <div class="form-group">
                            <textarea name="message" rows="3" class="form-control" placeholder="Please enter your message..." value="<?php echo $_POST['message']; ?>"></textarea>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="check"> I am human
                            </label>
                        </div>
                        <div align="center">
                            <input type="submit" name="submit" class="btn btn-danger btn btn-outline-danger" value="Send message"/>
                        </div>
                </div>
            </div>
        </div>
</div>
</div>
<!-- Einde contact form -->
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>