<?php
// adapted from Mr. Hrishabh Sharma's work at TechnologyMantraBlog.com

require_once("functions.php");


function loadVideo($category = null)
{
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
    if (is_array($category)) {
        foreach ($category as $cat) {
            loadVideo($cat);
            return;
        }
    }

    $response = file_get_contents("https://www.googleapis.com/youtube/v3/search?part=snippet&videoCategoryId=$category&safeSearch=none&publishedAfter=" . urlencode(getPublishAfterDate()) . "&publishedBefore=" . urlencode(getPublishBeforeDate()) . "&maxResults=48&order=viewCount&type=video&key=xyz");

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
    
    $response = file_get_contents("https://www.googleapis.com/youtube/v3/search?part=snippet&videoCategoryId=$category&safeSearch=none&publishedAfter=" . urlencode(getPublishAfterDate()) . "&publishedBefore=" . urlencode(getPublishBeforeDate()) . "&maxResults=48&order=viewCount&type=video&key=xyz&pageToken={$nextPage}");

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



if (!isset($_GET['nextPage'])) {

    $category = @$_GET['category'] != '' ? $_GET['category'] : null;

     loadVideo($category);

}

if (isset($_GET['nextPage'])) {
    
    $category = @$_GET['category'] != '' ? $_GET['category'] : null;

       loadNextVideo($category);
} ?>

