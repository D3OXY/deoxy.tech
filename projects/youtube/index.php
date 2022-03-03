<?php
if(!isset($_GET['id']) || $_GET['id'] == ""){
	die('Please provide video id');
}

$id = $_GET['id'];
$geo = isset($_GET['geo']) ? $_GET['geo'] : '';

#Enter RapidAPI key here:
$apiKey = "b9ad1eb16fmsh5e2e547e49d908fp1944e1jsn9e730c1c1d89";

if($apiKey == "b9ad1eb16fmsh5e2e547e49d908fp1944e1jsn9e730c1c1d89"){
	die('RAPIDAPI_KEY missing');
}

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://youtube-video-download-info.p.rapidapi.com/dl?id=".$id."&geo=".$geo,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: youtube-video-download-info.p.rapidapi.com",
		"x-rapidapi-key: ".$apiKey
	],
]);

$json = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	
	$apiArr = json_decode($json, true);
	
	echo '<img src="'.$apiArr['thumb'].'" /><br/>';
	echo 'Title: '.$apiArr['title'].'<br/>';
	echo 'Channel: '.$apiArr['author'].'<br/>';
	echo 'Rating: '.$apiArr['avg_rating'].'<br/>';
	echo 'Publshed: '.$apiArr['date'].'<br/>';
	echo 'Keywords: '.$apiArr['keywords'].'<br/>';
	echo 'Duration: '.$apiArr['length'].'<br/>';
	echo 'View Count: '.$apiArr['view_count'].'<br/>';
	echo 'Download Links:<hr/>';
	foreach($apiArr['link'] as $itag => $l){
		echo '<a href="'.$l[0].'">'.$l[3].'-'.$l[1].'</a> - '.$l[4].'<br/>';
	}
}
