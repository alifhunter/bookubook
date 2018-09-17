<?php
session_start();
require_once('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
  <title><?php echo $title; ?></title>
  <link href="css/main.css" rel="stylesheet"/>

  
</head>

<body>

<!-- Side Navigation -->
<div id="side-navigation">
    <div class="logo"><a href="index.php"></a></div>

    <!-- Stats Widget -->
    <div class="bar-controller">
        <ul>
            <li>Ebooks:</li>
            <li>
            <?php 
            $sql = $connect->query("select * from `ebook`");
            $row = mysqli_num_rows($sql);
              echo $row;
            ?>
            </li>
        </ul>
    </div>
    
    <div class="sidebar-separator"></div>
    
    <!-- Left navigation -->
    <ul id="menu" class="nav">
        <li class="dash"><a href="index.php" title="" class=""><span>Dashboard</span></a></li>
        <li class="forms"><a href="post-ebook.php" title="" class=""><span>Post New Ebook</span></a>
        <li class="widgets"><a href="categories.php" title="" class="active"><span>Category</span></a>
        </li>
    </ul>
</div>


<!-- Content Wrapper -->
<div id="content-wrapper">

    <!-- Top Bar Navigation -->
    <div class="top-navigation">
        <div class="wrapper">
            <div class="welcome"><a href="#" title=""><img src="images/user_header.png" alt="" /></a><span>Welcome <?php echo $username; ?>!</span></div>
            <div class="user-navigation">
                <ul>
                    <li><a href="#" title=""><img src="images/icons/topnav/settings.png" alt="" /><span>Settings</span></a></li>
                    <li><a href="keluar.php" title=""><span>Logout</span></a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <!-- Responsive header -->
    <div class="resp">
        <div class="responsive-header">
            <a href="index.php" title=""><img src="images/logo_dark.png" alt="" /></a>
        </div>
        
        
        
        
    </div>
    
  
    <!-- Main content wrapper -->
    <div class="wrapper">
        <div class="clear"></div>
            <br>
        
     <br/>
     
     <form name="new-cat" action="?new?category" method="post" class="form">
      <fieldset>
      <div class="widget">
        <div class="title"><img src="images/icons/light/list.png" alt="" class="title-icon" /><h6>Add Category</h6></div>
     <?php
     if(isset($_POST['newcat'])){
     

     //set var
     $catname = $_POST['catname'];
     //pembatas aja
     $sql = $connect->query("SELECT * FROM `categories` WHERE cat_name='$catname'");
     $row = mysqli_num_rows($sql);
      if($row == 1){
       echo 'Kategorinya sudah ada!';
      } else {
     $result = $connect->query("INSERT INTO categories(cat_name) VALUES('".$catname."')");
    } echo 'Kategori berhasil di buat!';
    
     } 
     ?>
     <div class="form-row">
      <label>Category Name</label>
      <div class="form-right"><input type="text" name="catname" value="" placeholder="Category Name"></div>
      <div class="clear"></div>
      </div> 
    <div class="form-row">
       <div class="form-right"> <input type="submit" name="newcat" class="button small" value="Submit"></div>
       <div class="clear"></div>
       </div>
        </div>   
      </fieldset>
     </form>
    
        </div>
    
    </div>
    
    <!-- Footer line -->
    <div id="footer">
        <div class="wrapper">DapurCP 2013. <a href="http://www.hartrey.org/" title="">Hartrey.org</a></div>
    </div>

</div>

<div class="clear"></div>
<!-- Load Template Main Required Scripts -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/spinner/ui.spinner.js"></script>
        <script type="text/javascript" src="js/plugins/spinner/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
        
        <!-- Load Charts Elements Scripts -->
        <script type="text/javascript" src="js/plugins/charts/excanvas.min.js"></script>
        <script type="text/javascript" src="js/plugins/charts/jquery.flot.js"></script>
        <script type="text/javascript" src="js/plugins/charts/jquery.flot.orderBars.js"></script>
        <script type="text/javascript" src="js/plugins/charts/jquery.flot.pie.js"></script>
        <script type="text/javascript" src="js/plugins/charts/jquery.flot.resize.js"></script>
        <script type="text/javascript" src="js/plugins/charts/jquery.sparkline.min.js"></script>
        <script type="text/javascript" src="js/charts/updating.js"></script>
        <!-- Load Forms Scripts -->
        <script type="text/javascript" src="js/plugins/forms/uniform.js"></script>
        <script type="text/javascript" src="js/plugins/forms/jquery.maskedinput.min.js"></script>
        <script type="text/javascript" src="js/plugins/forms/jquery.tagsinput.min.js"></script>
        <script type="text/javascript" src="js/plugins/forms/jquery.dualListBox.js"></script>
        <script type="text/javascript" src="js/plugins/forms/jquery.validationEngine-en.js"></script>
        <script type="text/javascript" src="js/plugins/forms/jquery.inputlimiter.min.js"></script>
        <script type="text/javascript" src="js/plugins/wizard/jquery.form.js"></script>
        <script type="text/javascript" src="js/plugins/forms/chosen.jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/forms/jquery.cleditor.js"></script>
        <script type="text/javascript" src="js/plugins/wizard/jquery.form.wizard.js"></script>
        <script type="text/javascript" src="js/plugins/forms/jquery.validationEngine.js"></script>
        <script type="text/javascript" src="js/plugins/wizard/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/plugins/forms/autogrowtextarea.js"></script>
        
        <!-- Load Upload Scripts -->
        <script type="text/javascript" src="js/plugins/uploader/plupload.js"></script>
        <script type="text/javascript" src="js/plugins/uploader/plupload.html5.js"></script>
        <script type="text/javascript" src="js/plugins/uploader/plupload.html4.js"></script>
        <script type="text/javascript" src="js/plugins/uploader/jquery.plupload.queue.js"></script>
        
        <!-- Load Table Scripts -->
        <script type="text/javascript" src="js/plugins/tables/datatable.js"></script>
        <script type="text/javascript" src="js/plugins/tables/tablesort.min.js"></script>
        <script type="text/javascript" src="js/plugins/tables/resizable.min.js"></script>
        
        <!-- Load Misc Scripts -->
        <script type="text/javascript" src="js/plugins/calendar.min.js"></script>
        <script type="text/javascript" src="js/plugins/ui/jquery.jgrowl.js"></script>
        <script type="text/javascript" src="js/plugins/ui/jquery.colorpicker.js"></script>
        <script type="text/javascript" src="js/plugins/ui/jquery.progress.js"></script>
        <script type="text/javascript" src="js/plugins/ui/jquery.breadcrumbs.js"></script>
        <script type="text/javascript" src="js/plugins/ui/jquery.tipsy.js"></script>
        <script type="text/javascript" src="js/plugins/ui/jquery.prettyPhoto.js"></script>
        <script type="text/javascript" src="js/plugins/ui/jquery.timeentry.min.js"></script>
        <script type="text/javascript" src="js/plugins/ui/jquery.collapsible.min.js"></script>
        <script type="text/javascript" src="js/plugins/elfinder.min.js"></script>
        <script type="text/javascript" src="js/plugins/ui/jquery.sourcerer.js"></script>
        
        <!-- Scripts Handlers -->
        <script type="text/javascript" src="js/custom.js"></script>
</body>
</html>
