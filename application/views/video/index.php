<?php $this->load->view('public/header.php');?>
<div class="container">
  <h1>视频管理</h1>
  <div class="row show-grid">
  	<div class="carousel slide">    
    	<div class="row"><h4>账户:<?php echo $uinfo['user']['account'];?></h4></div>
        <div class="row"><h4>版本:<?php echo $uinfo['user']['expired'];?></h4></div>
        <div class="row"><h4>有效期至 :<?php echo $uinfo['user']['expired'];?></h4></div>
        <div class="row"><h4>空间&nbsp;&nbsp;总:<?php echo $uinfo['user']['space']['total'];?>G;剩余<?php echo $uinfo['user']['space']['remain'] ?></h4></div>
        <div class="row"><h4>流量&nbsp;&nbsp;总:<?php echo $uinfo['user']['traffic']['total'];?>G;已用<?php echo $uinfo['user']['traffic']['used']?></h4></div>
    </div>
    <div> <a href="<?php echo site_url('video/send')?>">去上传视频</a></div>
    <div> <a href="<?php echo site_url('video/show')?>">查看视频列表</a></div>
    <div> <a href="<?php echo site_url('video/tolocal')?>">将视频同步到本地</a></div>
  </div>
</div>
<?php $this->load->view('public/footer.php');?>
<script type="text/javascript" src="/zmo_admin/static/js/swfobject.js"></script>