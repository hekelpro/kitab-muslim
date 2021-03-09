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
  <br>
  <form method="get" class="example" action="next.php">
    <input id="search" name="q" type="text" placeholder="Cari Surat ..." name="search">
    <button type="submit">CARI</button>
  </form>
  <hr>
  <?php
  $no = 0;
  include("simple_html_dom.php");
  
  $html = str_get_html(file_get_contents("https://m.merdeka.com/quran"));
  foreach ($html->find("ul[class=quran_surat]") as $b){
    foreach ($b->find("a") as $c){
      foreach ($c->find("p") as $d){
        foreach ($c->find("span") as $e){
          $sub = $no += 1;
          $cut = str_replace($sub.". ", "", $d->plaintext);
          ?>
          <div class="card">
            <a href="next.php?q=<?= $sub; ?>">
                <h1 class="angka"><?= $sub; ?></h1>
                <h2 class="surat"><?= strtoupper($cut); ?></h2>
                <hr>
                <h4 class="arti-surat"><?= $e->plaintext; ?></h4>
            </a>
          </div>
          <?php
        }
      }
    }
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
