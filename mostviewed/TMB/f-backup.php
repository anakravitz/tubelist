<?php
// adapted from Mr. Hrishabh Sharma's work at TechnologyMantraBlog.com

require_once("functions.php");


$NONMUSIC = ["0", "32", "31", "2", "33", "34", "36", "35", "27", "24", "37", "1", "38", "20", "39", "26", "30", "25", "29", "15", "22", "40", "28", "18", "42", "43", "17", "44", "19", "41", "21"];


function loadVideo($category = null)
{
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
    if (is_array($category)) {
        foreach ($category as $cat) {
            loadVideo($cat);
            return;
        }
    }

    $response = file_get_contents("https://www.googleapis.com/youtube/v3/search?part=snippet&videoCategoryId=$category&safeSearch=none&publishedAfter=" . urlencode(getPublishAfterDate()) . "&publishedBefore=" . urlencode(getPublishBeforeDate()) . "&maxResults=48&order=viewCount&type=video&key=AIzaSyBRxS0JS_JD_FTarF784exuKNuCgCnJIy0");

    $searchResponse = json_decode($response, true);
    foreach ($searchResponse['items'] as $searchResult) {
        $a = $searchResult['id']['videoId'];
        $b = preg_replace('/[^a-zA-Z0-9]/', '_', $searchResult['snippet']['title']);


        ?>

        <div id="<?php echo $a; ?>" draggable="true" ondragstart="drag(event)" class="videoItemContainer"
             onClick="playThis('<?php echo $a; ?>', '<?php echo $b; ?>')">
            <div class="videoItemImage">
                <img src="<?php echo $searchResult['snippet']['thumbnails']['default']['url']; ?>" alt="Youtube Video">
            </div>

            <div class="videoItemCaption">
                <?php echo $searchResult['snippet']['title']; ?>
            </div>


        </div>

        <?php       
        }
            $nextPage = $searchResponse['nextPageToken'];
        ?>

<nav>
  <ul class="pager">
    <!-- <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Older</a></li> -->
    <li onClick="nextPage('<?php echo @$keyword; ?>', '<?php echo $nextPage; ?>')" class="next"><a href="#">Next Page<span aria-hidden="true">&rarr;</span></a></li>
  </ul>
</nav>

   
    <?php
}

function loadNextVideo($category = null)
{
    $nextPage = @$_GET['nextPage'];
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
    if (is_array($category)) {
        foreach ($category as $cat) {
            loadNextVideo($cat);
            return;
        }
    }
    
    $response = file_get_contents("https://www.googleapis.com/youtube/v3/search?part=snippet&videoCategoryId=$category&safeSearch=none&publishedAfter=" . urlencode(getPublishAfterDate()) . "&publishedBefore=" . urlencode(getPublishBeforeDate()) . "&maxResults=48&order=viewCount&type=video&key=AIzaSyBRxS0JS_JD_FTarF784exuKNuCgCnJIy0&pageToken={$nextPage}");

    $searchResponse = json_decode($response, true);
    foreach ($searchResponse['items'] as $searchResult) {
        $a = $searchResult['id']['videoId'];
        $b = preg_replace('/[^a-zA-Z0-9]/', '_', $searchResult['snippet']['title']);


        ?>

        <div id="<?php echo $a; ?>" draggable="true" ondragstart="drag(event)" class="videoItemContainer"
             onClick="playThis('<?php echo $a; ?>', '<?php echo $b; ?>')">
            <div class="videoItemImage">
                <img src="<?php echo $searchResult['snippet']['thumbnails']['default']['url']; ?>" alt="Youtube Video">
            </div>

            <div class="videoItemCaption">
                <?php echo $searchResult['snippet']['title']; ?>
            </div>


        </div>

 <?php       
        }
            $nextPage = $searchResponse['nextPageToken'];
        ?>
        

<nav>
  <ul class="pager">
    <!-- <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Older</a></li> -->
    <li onClick="nextPage('<?php echo @$keyword; ?>', '<?php echo $nextPage; ?>')" class="next"><a href="#">Next Page<span aria-hidden="true">&rarr;</span></a></li>
  </ul>
</nav>
   
       <?php
}


function loadNonMusicVideo($categories = null)
{
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
    if (is_array($categories)) {
        foreach ($categories as $category) {
            $response = file_get_contents("https://www.googleapis.com/youtube/v3/search?part=snippet&videoCategoryId=$category&safeSearch=none&publishedBefore=2015-03-20T00%3A00%3A00Z&maxResults=48&order=viewCount&type=video&key=AIzaSyBRxS0JS_JD_FTarF784exuKNuCgCnJIy0");

            $searchResponse = json_decode($response, true);
            foreach ($searchResponse['items'] as $searchResult) {
                $a = $searchResult['id']['videoId'];
                $b = preg_replace('/[^a-zA-Z0-9]/', '_', $searchResult['snippet']['title']);


                ?>

                <div id="<?php echo $a; ?>" draggable="true" ondragstart="drag(event)" class="videoItemContainer"
                     onClick="playThis('<?php echo $a; ?>', '<?php echo $b; ?>')">
                    <div class="videoItemImage">
                        <img src="<?php echo $searchResult['snippet']['thumbnails']['default']['url']; ?>"
                             alt="Youtube Video">
                    </div>

                    <div class="videoItemCaption">
                        <?php echo $searchResult['snippet']['title']; ?>
                    </div>


                </div>

                <?php

            }
        }
    }


    $nextPage = @$searchResponse['nextPageToken'];
    ?>


    <nav>
  <ul class="pager">
    <li onClick="nextPage('<?php echo @$keyword; ?>', '<?php echo $nextPage; ?>')" class="next nexty"><span aria-hidden="true">&larr;</span>Next Page</a></li>
  </ul>
</nav>

    <?php
}


if (!isset($_GET['nextPage'])) {

    $category = @$_GET['category'] != '' ? $_GET['category'] : null;
    if ($category == 'non-music') {
        loadNonMusicVideo($NONMUSIC);
    } else {
        loadVideo($category);
    }
    /* echo $category;
     die();*/


    //echo $response;
    // $nextPage = $searchResponse['nextPageToken'];
}

if (isset($_GET['nextPage'])) {
    $category = @$_GET['category'] != '' ? $_GET['category'] : null;
    if ($category == 'non-music') {
        $category = $NONMUSIC;
    }

    loadNextVideo($category);
} ?>

