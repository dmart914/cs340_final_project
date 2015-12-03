<?php include('/home/lucia/cs340_final_project/db.cfg.php'); ?>
<?php #include('/home/ubuntu/00_PUBLIC_HTML/cs340_final_project/db.cfg.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Grave History</title>

    <link rel="stylesheet" href="/lucia/resources/css/foundation.css" />
    <script src="/lucia/resources/js/vendor/modernizr.js"></script>
</head>
<body>

  <div class="row">
    <div class="large-12 columns">
   
       
        <nav class="top-bar" data-topbar>
          <ul class="title-area">
             
            <li class="name">
              <h1>
                <a href="/lucia/">
                  Grave History
                </a>
              </h1>
            </li>
            <li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
          </ul>
   
          <section class="top-bar-section">
            <ul class="left">
              <li><a href="/lucia/browse.php">Browse</a></li>
              <!--<li><a href="/cs340_final_project/search.php">Search</a></li>-->
              <li><a href="/lucia/submit.php">Submit</a></li>
            </ul>
   
            <ul class="right">
              <li class="search">
                <form action="/lucia/searchResults.php" method="post">
                  <input type="search" name="searchString">
              </li>
   
              <li class="has-button">
                <!-- <a class="small button" href="#">Search</a> -->
                  <input type="submit" value="Search" class="tiny button">
                </form>
              </li>
            </ul>
          </section>
        </nav>
   
       
    
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">