<!DOCTYPE html>
<?php 
//
//author : Febrian Alif P a.k.a alifhunter/hartrey
//date : 051013
//theme name : bookubook
//ver : 1.0.0.3
//sec ver : 0.3
//responsive : yes
//--> 
session_start();
require_once('dapur/includes/config.php');
?>
<html lang="en">
<head>
 <title>Bookubook</title>
 <meta charset="utf-8">
 <meta name="description" content="free ebook">
 <meta name="robots" content="index,nofollow">
 <meta name="author" content="alifhunter">
 <meta name="viewport" content="width=device-width, initial-scale=1" />
 <!-- Core style -->
 <link rel="stylesheet" href="style.css">
 <!-- Mencoba scripting javascript -->
</head>
<body>

<div class="wrapper">
 <div class="header">
 <a name="#top"></a>
 <p>Bookubook<small> download ebook</small></p> 
 </div>
 <div class="mr-menu">
 <ul>
  <li><a href="#">Home</a></li>
  <li><a href="#">About</a></li>
  <li><a href="#">Contact</a></li>
  <li></li>
 </ul>
 </div>
 <div class="fullbody">
  <div class="insidebody">
  <p><big>Search Results...</big></p><hr/>
  <?php
  //paging script
  $perpage = 7;
  //apabila $_GET['page'] sudah di definisikan gunakan nomornya
  //apabila belum nomor halamannya 1
  if(isset($_GET['page'])){
    $noPage = $_GET['page']; 
  } else {
    $noPage = 1;
  }
  //perhitungan offset
  $offset = ($noPage - 1) * $perpage;
  //mencari jumlah data dalam tabel ebook
  $query = "SELECT COUNT(*) as semua FROM `ebook`";
  $hasil = $connect->query($query);
  $data = mysqli_fetch_array($hasil);
  $semua = $data['semua'];
  //query SQL untuk menampilkan data perhalaman sesuai offset
  $query2 = "SELECT `id` FROM `ebook`";
  $hasil2 = $connect->query($query2);
  $numrow = mysqli_num_rows($hasil2);
  ?>

  <?php 
  if($numrow == 1){
    
  } elseif(isset($_GET['keywords'])){
    $keywords = $_GET['keywords'];
    $querynya = "SELECT * FROM `ebook` WHERE id like '%$keywords%' or title like '%$keywords%' or kategori like '%$keywords%' or author like '%$keywords%' or link like '%$keywords%' ";
    $searchsql = $connect->query($querynya);
    $jumlahnya = mysqli_num_rows($searchsql);
    echo "<p>There are: ". $jumlahnya ." keywords based on our database.";
    while($data = mysqli_fetch_array($searchsql)){
      $id_ebook = $data['id'];
      $title_ebook = $data['title'];
      $kategori_ebook = $data['kategori'];
      $author_ebook = $data['author'];
      $link_ebook = $data['link'];
      echo "<div class='listing'>";
      echo "<p>";
      echo "" . $data['title'] . " <small> " . $data['author'] . " | Category: ". $data['kategori'] ."</small> <a href=" . $data['link'] . ">  <input type='button' class='dlbutton' value='Download'></a>"; 
      echo "</p>";
      echo "</div>";   
    }
  }else {
              echo 'There is nothing in the Database!';           
          }

  ?>
  </div>
 </div>
  <div class="fullside">
 <form action="search.php">
 <input class="search" name="keywords" type="text" placeholder="write your keywords and enter!"> 
 </form>
 </div>
 <div class="fullside">
 <p><big id="big">Categories</big></p><hr/> 
 <?php
 $sqlll = $connect->query("SELECT * FROM `categories`");
 while($wor = mysqli_fetch_array($sqlll)){
 echo "<p><a href='search.php?keywords=" . $wor['cat_name'] . "'>".$wor['cat_name']."</a></p>";
 }
 ?>
 <p><big id="big">Statistic</big></p><hr/>
 <p>Currently there are 
 <?php
 $con = $connect->query("SELECT `id` from `ebook`");
 $rowws = mysqli_num_rows($con);
 echo $rowws;
 if($rowws==1){
  echo ' ebook';
 } else {
  echo ' ebooks';
 }
 ?>  in our database.</p>
 </div>
 <footer>
 <small>© Copyleft Bookubook by Hartrey.org version 0.3 </small><br/>
 <small><a href="#top">back to top</a></small>
 </footer>
</div>

</body>
</html>