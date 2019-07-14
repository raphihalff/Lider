<?php
  $size = array("2.4em","2.2em","2em","1.8em","1.6em");
  $color = array("--main-gray", "--main-green", "--main-yellow", "--main-red", "--main-turq", "--main-turq", "--main-orange");
  $font = array("tamy", "frank", "vilna", "simple", "hadasim");
  $title_yid = "איבערזעצונגען פֿון אַ מאָטיװ";
  $title_eng = "Translations of a Theme"
?>
<header>
  <div class="hdr-wrapper">
    <a class="homepage" href="/">
    	<h1 class="homepage yid" dir="rtl">
        <?php
        $chars = str_split($title_yid);
        foreach ($chars as $letter) {
          echo '<div class="hdr-letter" style="color: var(' . $color[rand(0,count($color)-1)] . '); font-family: ' . $font[rand(0,count($font)-1)] . '; font-size: ' . $size[rand(0,count($size)-1)] . ';">' . $letter . '</div>';
        }
        ?>
      </h1>
    </a>
  </div>
</header>
