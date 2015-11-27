<?php
$response = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=statistics&key=AIzaSyBRxS0JS_JD_FTarF784exuKNuCgCnJIy0&id='.$_GET['id']));

?>
<div class="meta-information">
	<strong>Views : </strong> <?php echo number_format(@$response->items[0]->statistics->viewCount); ?><br>
    <strong>Likes : </strong> <?php echo number_format(@$response->items[0]->statistics->likeCount); ?><br>
</div>
