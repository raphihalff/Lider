<?php
  include $_SERVER['DOCUMENT_ROOT'] . '/exhibits/togyidish_var.php';
  $kval_shprakh = get_lang();
  $iberzets_eyn = get_lang(array($kval_shprakh));
  $iberzets_tsvey = get_lang(array($kval_shprakh, $iberzets_eyn));
  $author = get_author();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset = "utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=.5, maximum-scale=.5">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel='shortcut icon' href='favicon.png' type='image/x-icon' />
    <title><?php echo $title[$kval_shprakh]; ?></title>
  </head>
  <body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
    <div class="secondary-shtik">
      <h1 class="title"><?php echo $title[$iberzets_eyn]; ?></h1>
      <h4 class="author"><?php echo $by[$iberzets_eyn] . " " . $author[0][$iberzets_eyn] . " " . $author[1][$iberzets_eyn] . " " . $author[2][$iberzets_eyn]; ?></h4>
      <h4 class="trans"><?php echo get_trans($kval_shprakh, $iberzets_eyn); ?></h4>
      <div class="text"><?php echo $text[$iberzets_eyn]; ?></div>
    </div>
    <div id="main-shtik">
      <h1 class="title"><?php echo $title[$kval_shprakh]; ?></h1>
      <h4 class="author"><?php echo $by[$kval_shprakh] . " " . $author[0][$kval_shprakh] . " " . $author[1][$kval_shprakh] . " " . $author[2][$kval_shprakh]; ?></h4>
      <div class="text"><?php echo $text[$kval_shprakh]; ?></div>
    </div>
    <div class="secondary-shtik">
      <h1 class="title"><?php echo $title[$iberzets_tsvey]; ?></h1>
      <h4 class="author"><?php echo $by[$iberzets_tsvey] . " " . $author[0][$iberzets_tsvey] . " " . $author[1][$iberzets_tsvey] . " " . $author[2][$iberzets_tsvey]; ?></h4>
      <h4 class="trans"><?php echo get_trans($kval_shprakh, $iberzets_tsvey); ?></h4>
      <div class="text"><?php echo $text[$iberzets_tsvey]; ?></div>
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
