<?php
// How to make this script works ...
// http://wpplayer.org/how-to-remove-youtube-logo-from-embedded-player-jwplayer/
// @edited by wpplayer.org = giveaway4u.team@gmail.com
error_reporting(E_ERROR | E_PARSE);
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("Asia/Kolkata");

function curl($url) {
	$ch = @curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	$head[] = "Connection: keep-alive";
	$head[] = "Keep-Alive: 300";
	$head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$head[] = "Accept-Language: en-us,en;q=0.5";
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_ENCODING , 'gzip, deflate');
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
	$page = curl_exec($ch);
	curl_close($ch);
	return $page;
}

function get_size($url)
{
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_NOBODY, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	$r = curl_exec($ch);
    foreach(explode("\n", $r) as $header)
    {
        if(strpos($header, 'Content-Length:') === 0)
        {
            return trim(substr($header,16)); 
		}
    }
	return '';
}

ob_start();
function clean($string)
{
   $string = str_replace(' ', '-', $string);
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}

function formatBytes($bytes, $precision = 2)
{ 
    $units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'); 
    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0)/log(1024)); 
    $pow = min($pow, count($units) - 1); 
    $bytes /= pow(1024, $pow);
    return round($bytes, $precision).''.$units[$pow]; 
}

$link = $_GET['url'];
$id = explode('?v=', $link);
$get_video_info = 'https://www.youtube.com/get_video_info?&video_id='. $id[1].'&asv=3&el=detailpage&hl=en_US';
$get_video_info = curl($get_video_info);
$thumbnail_url = $title = $url_encoded_fmt_stream_map = $type = $url = '';
parse_str($get_video_info);

$data = explode(',',$url_encoded_fmt_stream_map);
$expire = time(); 
foreach($data as $i => $format) {
	parse_str($format);
	$data_formats[$i]['itag'] = $itag;
	$data_formats[$i]['quality'] = $quality;
	$type = explode(';',$type);
	$data_formats[$i]['type'] = $type[0];
	$data_formats[$i]['url'] = urldecode($url).'&signature='.$sig;
	parse_str(urldecode($url));
	$data_formats[$i]['expires'] = date("G:i:s T", $expire);
	$data_formats[$i]['ipbits'] = $ipbits;
	$data_formats[$i]['ip'] = $ip;
	$i++;
}
// http://wpplayer.org/how-to-remove-youtube-logo-from-embedded-player-jwplayer/
// @edited by wpplayer.org = giveaway4u.team@gmail.com
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-BR">
<head>

<meta charset="UTF-8"/>
<meta name="robots" content="noindex" />
<META NAME="GOOGLEBOT" CONTENT="NOINDEX" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<script type="text/javascript" src="https://ssl.p.jwpcdn.com/player/v/7.7.3/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key = "rqQQ9nLfWs+4Fl37jqVWGp6N8e2Z0WldRIKhFg==";</script>
<style type="text/css">
*{margin:0;padding:0}#picasa{position:absolute;width:100%!important;height:100%!important}
</style>
</head>
<body>
<div>
<center>
<div id="picasa" class="picasa"></div>'
<script type="text/javascript">
 	var playerInstance = jwplayer("picasa");
		playerInstance.setup({
		id:'picasa',
		controls: true,
		displaytitle: true,
		flashplayer: "https://ssl.p.jwpcdn.com/player/v/7.7.3/jwplayer.flash.swf",
		width: "100%",
		height: "100%",
		aspectratio: "16:9",
		fullscreen: "true",
		provider: 'http',
		autostart: false,
		abouttext: "Google Video Player",
        aboutlink: "http://wpplayer.org/",
		image:"/jwplayer/thumb.jpg",
		sources: [<?php
	
for($i=0; $i<count($data_formats); $i++)
if(!isset($link)){
}else {
{
    $type = $data_formats[$i]['type'];
	$type = preg_replace('/video\//is', '', $type);
    $quality = $data_formats[$i]['quality'];

    $fileSize = formatBytes(get_size($data_formats[$i]['url']));
    $download = $data_formats[$i]['url'].'&title='.clean($title);
	if(preg_match('?itag=22?', $download)){
$url1 = '{file:"' . $download . '",label:"HD",type: "video/mp4"},';		
	echo $url1;
	}
	elseif(preg_match('?itag=18?', $download)){
$url1= '{file:"' . $download . '",label:"SD",type: "video/mp4",default: true},';	
	echo $url1;
	}
   }} 

?>],

	});
	

					
		
</script>
</center>
</div>
</body>
</html>