<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . 'exhibits/togyidish_var.php';
  $kval_shprakh = get_lang();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset = "utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=.5, maximum-scale=.5">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel='shortcut icon' href='favicon.png' type='image/x-icon' />
    <title></title>
  </head>
  <body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
    <div class="secondary-shtik">
      <h1 class="title"></h1>
      <h4 class="author"></h4>
      <h4 class="trans"></h4>
      <div class="text"></div>
    </div>
    <div id="main-shtik">
      <h1 class="title"><?php echo $title[$kval_shprakh]; ?></h1>
      <h4 class="author"></h4>
      <div class="text"></div>
    </div>
    <div class="secondary-shtik">
      <h1 class="title"></h1>
      <h4 class="author"></h4>
      <h4 class="trans"></h4>
      <div class="text"></div>
    </div>

  </body>
  <style>
    body {
      width:100%;
    }
    #main-shtik {
      width:38%;
      margin: auto;
      padding: 1%;

    }
    .secondary-shtik {
      width: 30%
    }
    .text {
      border: solid red;
    }
  </style>
</html>
