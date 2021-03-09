<!DOCTYPE html>
<html lang="en">
<head>
  <title>Kitab Muslim</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://i.ibb.co/6WBbZzd/d258b606-23d5-4d4b-b97c-f7c6992f989c.png" rel="icon">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://indrijunanda.github.io/RuangAdmin/vendor/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body id="page-top">
<div class="container">
  <img src="https://cdn.qurancdn.com/assets/logo-lg-w-10a76950b6fdf68f9bf6abdde65eec2553f6f6d97837b65d8836d1a0c39a01c9.png" alt="Al-Quran" style="display: block; margin: auto; width: 200px; height: 100px;"/>
  <hr>
  <?php
  error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
  include("config.php");
  include("simple_html_dom.php");
  
  if(empty($_GET["q"])){
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
  }
  
  $str = $_GET["q"];
  $urll = str_replace("+"," ",$str);
  $pertama = [" ", "'"];
  $kedua   = ["-", ""];
  $potong  = str_replace($pertama, $kedua, $urll);
  $kecil = strtolower($potong);
  $amb = strval($search["$kecil"]);
  
  if($amb == ""){
    die('<center><h5>PENULUSURAN ANDA TIDAK ADA DI DAFTAR SURAT</h5></center><br><br><a href="index.php"><h1><center><i class="fas fa-backward"></i> BACK</center></h1></a>');
  }
  
  $ayt = array();
  $bca = array();
  $art = array();
  
  $html = str_get_html(file_get_contents($surah[$amb]));
  foreach ($html->find("article[class=surat]") as $a){
    foreach ($a->find("h1") as $title){
      ?>
      <center><h6 class="title"><?= $title; ?></h6></center>
      <?php
    }
  }
  ?>
  <center><audio src="<?= $embed[$amb]; ?>" controls></audio></center>
  <center><h6>Klik Play Untuk Mendengarkan Bacaan Surahnya</h6></center><hr>
  <?php
  foreach ($a->find("span[class=ayat]") as $ayat){
    array_push($ayt,trim($ayat->plaintext));
  }
  foreach ($a->find("span[class=bacaan]") as $baca){
    array_push($bca,trim($baca->plaintext));
  }
  foreach ($a->find("span[class=arti]") as $arti){
    array_push($art,trim($arti->plaintext));
  }
  
  $no = 0;
  $oprek = array_map(null,$ayt,$bca,$art);
  foreach ($oprek as $z){
    $ez = $no += 1;
    ?>
    <div class="card-arab">
      <h1 class="angka"><?= $ez; ?></h1>
      <h3 class="arab"><?= $z[0]; ?></h3>
      <hr>
      <h5 class="latin"><?= $z[1]; ?></h5>
      <hr>
      <h6 class="arti"><?= $z[2]; ?></h6>
    </div>
    <?php
  }
  ?>
</div>
<button id="tombolScrollTop" onclick="scrolltotop()"><i class="fas fa-arrow-circle-up"></i></button>
<script>
$(document).ready(function(){
    $(window).scroll(function(){
        if ($(window).scrollTop() > 100) {
            $('#tombolScrollTop').fadeIn();
        } else {
            $('#tombolScrollTop').fadeOut();
        }
    });
});

function scrolltotop()
{
    $('html, body').animate({scrollTop : 0},500);
}
</script>
<footer>
  <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
    <b><a href="https://github.com/hekelpro/" target="_blank">hekelpro</a></b>
  </span>
</footer>
</body>
</html>
