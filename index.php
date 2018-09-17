<!DOCTYPE html>
<?php 
//
//author : Febrian Alif P a.k.a Nyammug
//date : 051013
//theme name : bookubook
//ver : 1.0.0.3
//sec ver : 0.3
//responsive : half yet
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
  <li><a href="index.php">Home</a></li>
  <li><a href="#">About</a></li>
  <li><a href="#">Contact</a></li>
  <li></li>
 </ul>
 </div>
 <div class="fullbody">
  <div class="insidebody">
  <p><big><?php $judul="List"; echo $judul; ?></big></p> <hr/>
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
  if($numrow == 0){
    echo 'There is nothing in the Database!';
  }  else {
                         $sql = "SELECT * from `ebook` order by created DESC LIMIT $offset, $perpage "; 
                         $result = $connect->query($sql) or die (mysqli_error()); 
                         $nomor = 1;
                         while($row = mysqli_fetch_array($result))
                         {
       
                         echo "<div class='listing'>";
                         echo "<p>";
                         echo "" . $row['title'] . " <small> " . $row['author'] . " | Category: ". $row['kategori'] ." | Date ". $row['created'] ."</small> <a href=" . $row['link'] . ">  <input type='button' class='dlbutton' value='Download'></a>"; 
                         echo "</p>";
                         echo "</div>";   
                         } 
          }

  // menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
  $jumPage = ceil($semua/$perpage);
  echo "<hr>";
  echo "<div class='paginasi'>";
  // menampilkan link previous
  echo "Pages (".$jumPage.") : ";
  if ($noPage > 1) echo  "<a href='?page=".($noPage-1)."'>&lt;&lt; Prev</a>";
  
  // memunculkan nomor halaman dan linknya
  $showPage=0;
  for($page = 1; $page <= $jumPage; $page++)
  {
    if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
    {   
      if (($showPage == 1) && ($page != 2))
        echo "..."; 
        
      if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
        echo "...";
        
      if ($page == $noPage)
        echo " <b>".$page."</b> ";
      else 
        echo " <a class='paginasi' href='?page=".$page."'>".$page."</a> ";
      $showPage = $page;          
    }
  }
  
  // menampilkan link next
  if ($noPage < $jumPage) echo "<a class='page' href='?page=".($noPage+1)."'>Next &gt;&gt;</a>";
  echo "</div>";
  ?>
  </div>
 </div>
 <div class="fullside fullpost">
 <form action="search.php">
 <input class="search" name="keywords" type="text" placeholder="write your keywords and enter!"> 
 </form>
 </div>
 <div class="fullside fullpost">
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
 ?>  in our database.
 </p>
 </div>
 <footer>
 <small>© Copyleft Bookubook by Nyammug version 0.3 </small><br/>
 <small><a href="#top">back to top</a></small>
 </footer>
</div>

</body>
</html>