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

    $req_url_items =  Array(
        "https://www.googleapis.com/youtube/v3/search?part=snippet&videoCategoryId=$category&safeSearch=none&publishedAfter=",
        urlencode(getPublishAfterDate()),
        "&publishedBefore=",
        urlencode(getPublishBeforeDate()),
        "&maxResults=50&order=viewCount&type=video&",
        "key=",
        );

    $response = file_get_contents(implode('', $req_url_items));

    $searchResponse = json_decode($response, true);
    
    /*
    ** Get all ID's, fetch video statistics from youtube API in single connection, assign view and like count to $youtube_data array
    */
    $youtube_data = array();
    $video_ids = array();
    foreach ($searchResponse['items'] as $searchResult) {
			$video_ids[] = $searchResult['id']['videoId'];
		}
		
		//Make request to youtube api
		$youtube_response = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=statistics&key=AIzaSyBRxS0JS_JD_FTarF784exuKNuCgCnJIy0&id='. implode(",", $video_ids)));
		//Assign needed data to youtube_data array
    if ( isset($youtube_response->items) ) {
			foreach ($youtube_response->items as $item) {
				$video_id = $item->id;
				$youtube_data[$item->id] = array();
				$youtube_data[$item->id]['viewCount'] = isset($item->statistics->viewCount) ? $item->statistics->viewCount : 0;
				$youtube_data[$item->id]['likeCount'] = isset($item->statistics->likeCount) ? $item->statistics->likeCount : 0;
			}
    } //end if
    
    foreach ($searchResponse['items'] as $searchResult) {
        $video_id = $a = $searchResult['id']['videoId'];
        $b = preg_replace('/[^a-zA-Z0-9]/', '_', $searchResult['snippet']['title']);
	
	?>
	<div class="ytTextList">
		<li>
			<span class="textTitle" onClick="playThis('<?php echo $a; ?>', '<?php echo $b; ?>')"><?php echo $searchResult['snippet']['title']; ?></span>
			<span class='youtube_views'>&#9642; Views: <?php echo number_format((int)$youtube_data[$video_id]['viewCount']); ?> </span>
			<span class='youtube_likes'>&#9642; Likes: <?php echo number_format((int)$youtube_data[$video_id]['likeCount']); ?> </span>
			<a href="https://www.youtube.com/watch?v=<?php echo $searchResult['id']['videoId']; ?>"target="_blank">View on Youtube</a>
		</li>
	</div> 
		
		<?php		
		}
			$nextPage = $searchResponse['nextPageToken'];
		?>
		

<nav>
  <ul class="pager">
        <li onClick="nextPageText('<?php echo @$keyword; ?>', '<?php echo $nextPage; ?>') ; add2()" class="next"><a href="#">Next Page<span aria-hidden="true">&rarr;</span></a></li>
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

    $response = file_get_contents("https://www.googleapis.com/youtube/v3/search?part=snippet&videoCategoryId=$category&safeSearch=none&publishedAfter=" . urlencode(getPublishAfterDate()) . "&publishedBefore=" . urlencode(getPublishBeforeDate()) . "&maxResults=50&order=viewCount&type=video&key=xyz&pageToken={$nextPage}");

    $searchResponse = json_decode($response, true);
    
    /*
    ** Get all ID's, fetch video statistics from youtube API in single connection, assign view and like count to $youtube_data array
    */
    $youtube_data = array();
    $video_ids = array();
    foreach ($searchResponse['items'] as $searchResult) {
            $video_ids[] = $searchResult['id']['videoId'];
        }
        
        //Make request to youtube api
        $youtube_response = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=statistics&key=AIzaSyBRxS0JS_JD_FTarF784exuKNuCgCnJIy0&id='. implode(",", $video_ids)));
        //Assign needed data to youtube_data array
    if ( isset($youtube_response->items) ) {
            foreach ($youtube_response->items as $item) {
                $video_id = $item->id;
                $youtube_data[$item->id] = array();
                $youtube_data[$item->id]['viewCount'] = isset($item->statistics->viewCount) ? $item->statistics->viewCount : 0;
                $youtube_data[$item->id]['likeCount'] = isset($item->statistics->likeCount) ? $item->statistics->likeCount : 0;
            }
    } //end if
    
    foreach ($searchResponse['items'] as $searchResult) {
        $video_id = $a = $searchResult['id']['videoId'];
        $b = preg_replace('/[^a-zA-Z0-9]/', '_', $searchResult['snippet']['title']);
    
    ?>
    <div class="ytTextList">
        <li>
            <span class="textTitle" onClick="playThis('<?php echo $a; ?>', '<?php echo $b; ?>')"><?php echo $searchResult['snippet']['title']; ?></span>
            <span class='youtube_views'>&#9642; Views: <?php echo number_format((int)$youtube_data[$video_id]['viewCount']); ?> </span>
            <span class='youtube_likes'>&#9642; Likes: <?php echo number_format((int)$youtube_data[$video_id]['likeCount']); ?> </span>
            <a href="https://www.youtube.com/watch?v=<?php echo $searchResult['id']['videoId']; ?>"target="_blank">View on Youtube</a>
        </li>
    </div> 
        
        <?php       
        }
            $nextPage = $searchResponse['nextPageToken'];
        ?>
        

<nav>
  <ul class="pager">
     <li onClick="nextPageText('<?php echo @$keyword; ?>', '<?php echo $nextPage; ?>') ; add2()" class="next"><a href="#">Next Page<span aria-hidden="true">&rarr;</span></a></li>
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

