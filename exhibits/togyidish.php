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
    <div id="wrapper">
      <div id="shtik1" class="secondary-shtik" <?php if ($iberzets_eyn=="heb" || $iberzets_eyn=="yid") { echo 'dir="rtl" data-lang="' . $iberzets_eyn . '"'; } ?>>
        <h1 class="title"><?php echo $title[$iberzets_eyn]; ?></h1>
        <h4 class="author"><?php echo $by[$iberzets_eyn] . " " . $author[0][$iberzets_eyn] . " " . $author[1][$iberzets_eyn] . " " . $author[2][$iberzets_eyn]; ?></h4>
        <h4 class="trans"><?php echo get_trans($kval_shprakh, $iberzets_eyn); ?></h4>
        <div class="text"><?php echo str_replace('  ','&emsp;', nl2br($text[$iberzets_eyn])); ?></div>
      </div>
      <div id="main-shtik" <?php if ($kval_shprakh=="heb" || $kval_shprakh=="yid") { echo 'dir="rtl" data-lang="' . $kval_shprakh . '"'; } ?>>
        <h1 class="title"><?php echo $title[$kval_shprakh]; ?></h1>
        <h4 class="author"><?php echo $by[$kval_shprakh] . " " . $author[0][$kval_shprakh] . " " . $author[1][$kval_shprakh] . " " . $author[2][$kval_shprakh]; ?></h4>
        <div class="text"><?php echo str_replace('  ','&emsp;', nl2br($text[$kval_shprakh])); ?></div>
      </div>
      <div id="shtik2" class="secondary-shtik" <?php if ($iberzets_tsvey=="heb" || $iberzets_tsvey=="yid") { echo 'dir="rtl" data-lang="' . $iberzets_tsvey . '"'; } ?>>
        <h1 class="title"><?php echo $title[$iberzets_tsvey]; ?></h1>
        <h4 class="author"><?php echo $by[$iberzets_tsvey] . " " . $author[0][$iberzets_tsvey] . " " . $author[1][$iberzets_tsvey] . " " . $author[2][$iberzets_tsvey]; ?></h4>
        <h4 class="trans"><?php echo get_trans($kval_shprakh, $iberzets_tsvey); ?></h4>
        <div class="text"><?php echo str_replace('  ','&emsp;', nl2br($text[$iberzets_tsvey])); ?></div>
      </div>
    </div>
  </body>
  <style>
    #wrapper {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-gap: 10px;
      grid-auto-rows: minmax(100px, auto);
    }
    body {
      width:100%;
      background-color: #f6f3f1;
      font-family: tamy;
    }
    #main-shtik {
      margin: auto;
      padding: 1%;
      grid-column: 2;
      grid-row: 1 / 4;
      font-size: larger;
    }
    #shtik1 {
      grid-column: 1;
      grid-row: 2 / 4;
    }
    #shtik2 {
      grid-column: 3;
      grid-row: 2 / 4;
    }
    .secondary-shtik {
    }
    .text {
      border: solid var(--main-yellow);
      padding: 5%;
    }
    #main-shtik .text {
      border-color: var(--con-blue);
    }
    div[data-lang='heb'] {
      font-family: simple;
    }
    div[data-lang='yid'] {
      font-family: frank;
    }
  </style>
</html>
