<?php require_once("TMB/functions.php");
?>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">TubeList</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?=echoActiveClassIfRequestMatches("index")?>> <a href="index.php">Home <span class="sr-only">(current)</span></a></li>
        <li <?=echoActiveClassIfRequestMatches("about")?>> <a href="about.php">About <span class="sr-only">(current)</span></a></li>
        <li <?=echoActiveClassIfRequestMatches("contact")?>><a href="contact.php">Contact</a></li>
        
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Charts<b class="caret"></b></a>
              <div class="dropdown-menu multi-column">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="dropdown-menu">
                            <li><a href="#"><strong>Top Videos - All Time</strong></a></li>
                            <li <?=echoActiveClassIfRequestMatches("most-viewed-videos")?>><a href="most-viewed-videos.php">All Categories</a></li>
                            <li <?=echoActiveClassIfRequestMatches("most-viewed-music-videos")?>><a href="most-viewed-music-videos.php">Music Videos</a></li>
                            <li <?=echoActiveClassIfRequestMatches("most-viewed-non-music-videos")?>><a href="most-viewed-non-music-videos.php">Non-Music Videos</a></li>
                        </ul>
                    </div>
                    
                    <div class="col-md-4">
                        <ul class="dropdown-menu">
                            <li><a href="#"><strong>Top Videos - 2015</strong></a></li>
                            <li <?=echoActiveClassIfRequestMatches("2015-most-viewed-videos")?>><a href="2015-most-viewed-videos.php">All Categories</a></li>
                             <li <?=echoActiveClassIfRequestMatches("2015-most-viewed-music-videos")?>><a href="2015-most-viewed-music-videos.php">Music Videos</a></li>
                            <li <?=echoActiveClassIfRequestMatches("2015-most-viewed-non-music-videos")?>><a href="2015-most-viewed-non-music-videos.php">Non-Music Videos</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <ul class="dropdown-menu">
                            <li><a href="#"><strong>Other</strong></a></li>
                            <li <?=echoActiveClassIfRequestMatches("most-viewed-non-english-videos")?>><a href="most-viewed-non-english-videos.php">Non-English Videos</a></li>
                            <li <?=echoActiveClassIfRequestMatches("oldest-videos")?>><a href="oldest-videos.php">Oldest Videos</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </li>
      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

