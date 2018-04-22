<?php
if(!$_SESSION['id'] && $authorisation){
  $error = 'log eerst in';
  die($error);
}
?>
