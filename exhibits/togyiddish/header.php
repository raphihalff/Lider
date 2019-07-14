<?php
  $size = array("2.2em","2.1em","2em","1.9em","1.8em");
  $color = array("--main-gray", "--main-green", "--main-yellow", "--main-red", "--main-turq", "--main-turq", "--main-orange");
  $font = array("tamy", "frank", "vilna", "simple", "hadasim");
?>
<header>
  <div class="hdr-wrapper">
    <a class="homepage" href="/">
    	<h1 class="homepage yid" dir="rtl">

        <div class="hdr1" style="grid-column: 5; grid-row: <?php echo rand(1,4); ?>; color: <?php echo 'var(' . $color[rand(0,count($color)-1)] . ')'; ?>;">ד</div>
        <div class="hdr2">אָ</div>
        <div class="hdr3">ר</div>
        <div class="hdr4">ט</div>
        <div class="hdr5">ן</div>
      </h1>
    </a>
  </div>
</header>
