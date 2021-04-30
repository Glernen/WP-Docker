<?php 
$url = $_GET['url'];
$a = '';
if( $a==$url ) {
	$b = "";
// echo 'true';
} else {
	$b = $url;
	$b = base64_decode($b);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,height=device-height, initial-scale=1.0, user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes"> 
<meta name="robots" content="noindex,follow">
<title><?php _e('加载中','i_owen') ?></title>
<meta http-equiv="refresh" content="0.1;url=<?php echo $b; ?>">
<style>
body{overflow:hidden;background:#101213}
.container{display:flex;justify-content:center;align-items:center;height:100vh;overflow:hidden;animation-delay:1s}
.item-1,.item-2,.item-3,.item-4,.item-5{width:20px;height:20px;border-radius:50%;margin:7px;display:flex;justify-content:center;align-items:center}
.item-1:before,.item-2:before,.item-3:before,.item-4:before,.item-5:before{content:'';width:20px;height:20px;border-radius:50%;opacity:.7;animation:scale 2s infinite cubic-bezier(0,0,0.49,1.02);transition:.5s all ease}
.item-1{background-color:#eed968}
.item-1:before{background-color:#eed968;animation-delay:200ms}
.item-2{background-color:#eece68}
.item-2:before{background-color:#eece68;animation-delay:400ms}
.item-3{background-color:#eec368}
.item-3:before{background-color:#eec368;animation-delay:600ms}
.item-4{background-color:#eead68}
.item-4:before{background-color:#eead68;animation-delay:800ms}
.item-5{background-color:#ee8c68}
.item-5:before{background-color:#ee8c68;animation-delay:1000ms}
@keyframes scale{0%{transform:scale(1)}50%,75%{transform:scale(3.5)}78%,100%{opacity:0}}
</style>
</head>
<body>
<div class="container">
	<div class="item-1"></div>
	<div class="item-2"></div>
	<div class="item-3"></div>
	<div class="item-4"></div>
	<div class="item-5"></div>
</div>
</body>
</html>