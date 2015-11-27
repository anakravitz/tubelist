<?php session_start();
// adapted from Mr. Hrishabh Sharma's work at TechnologyMantraBlog.com

require_once("TMB/functions.php");
?>

 <?php $title = 'Most Viewed YouTube Videos | Popular Videos | List View | TubeList'; include("header.php"); ?>

   <?php require_once("navbar.php");?>


  <div class="container">

   <?php require_once("filters.php");?>
            
            <div class="row">             

               <div class="col-md-8">
                    <ol id="myO2">
                              <div class = "listButton">             
                                    <ul class="dropdown">
                                      <a href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">List View<span class="caret"></span></a>
                                      <ul class="dropdown-menu">
                                         <!-- <li><a href=# onclick="location.href='list.php'+window.location.search">List</a></li> -->
                                         <li><a href=# onclick="location.href='index.php'+window.location.search">Thumbnail View</a></li>
                                      </ul>
                                    </ul>             
                              </div>

                              <div class="searchBox">                       
                                <div class="videoText" id="videoText"></div>
                              </div> <!--searchBox-->
                    </ol>   
                </div> <!--col md 8-->
       
                <div class="col-md-4">
                    <div id="playerContainer">
                        <div id="player"></div>
                        <br>
                    </div><!-- player container-->                
                </div><!--col md 4-->
                
            </div><!--row-->

  </div><!--container-->
  
  <?php require_once("footer.php");?>
  
  <script>
    getVideoText2('videos');

var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    var player;


    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            height: '263',
            width: '350',
             videoId: '9bZkp7q19f0',
            
            playerVars: {
                'controls': 1,
                'disablekb': 1
            },
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }
    function onPlayerReady(event) {
       
    }

    function onPlayerStateChange(event) {

          }

  </script>


</body>
</html>