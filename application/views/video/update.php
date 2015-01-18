<?php $this->load->view('public/banner-header'); ?>
<style type="text/css">
.fla_btn {
  position: relative;
}
.fla_btn embed {
  position: absolute;
  z-index: 1;
}
#swfDiv{*position:absolute; z-index:2;}
</style>
<div class="content-box">
  <!-- Start Content Box -->
  <div class="content-box-header">
    <h3>列表</h3>
    <ul class="content-box-tabs">
      <li><a href="#tab1" class="default-tab">编辑</a></li>
    </ul>
    <div class="clear"></div>
  </div>
  <!-- End .content-box-header -->
  <div class="content-box-content">
    <div class="tab-content default-tab" id="tab1">
    
    <?php 
    	if ($ret) {
    		echo "更新成功";
    	} else {
    		echo "更新失败";
    	}
    ?>
    
    <br>
    <br>
    <br>
    
    <p>
   		<input class="button" type="button" value="返回" onClick="go_back()"/>
    </p>
    </div>
    <!-- End #tab1 -->
  </div>
  <!-- End .content-box-content -->
</div>
<script>
function go_back(){
	window.location.href="<?php echo site_url('video/video/show'); ?>";
}
</script>
<?php $this->load->view('public/footer'); ?>
