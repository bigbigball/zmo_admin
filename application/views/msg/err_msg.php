<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/static/style/msg.css" />
<div class="cmbody">
	<div><img src="/static/img/icon_warning.png"></div>
	<h1 style="margin-top:20px;"><?php echo $msg;?></h1>
    <h3 style="margin-top:20px;"><span id="seconde">5</span>秒后跳转</h3>
</div>
<script>
var s = 5, t;
function settime(){
	s--;
	$("#seconde").html(s);
	t = setTimeout('settime()', 1000);
	if ( s <= 0 ){
		s = 5;
	 	clearTimeout(t);
		window.location.href="<?php echo $url ;?>";
	}
}
$(document).ready(function(){
	setTimeout("settime()", 1000);
});
</script>
<?php $this->load->view('public/footer.php');?>