<?php $this->load->view('public/banner-header'); ?>
<div class="content-box">
  <!-- Start Content Box -->
  <div class="content-box-header">
    <h3>列表</h3>
    <div class="clear"></div>
  </div>
  <!-- End .content-box-header -->
  <div class="content-box-content">
    <div class="tab-content default-tab" id="tab1">
      <!-- This is the target div. id must match the href of this div's tab -->
      <?php if(empty($list)){?>
      <div class="notification attention png_bg"> <a href="#" class="close"><img src="<?php echo $this->config->item("img_path"); ?>icons/cross_grey_small.png" title="关闭" alt="关闭" /></a>
        <div>没有相关数据</div>
      </div>
      <?php }?>
    </div>
    <!-- End #tab2 -->
  </div>
  <!-- End .content-box-content -->
</div>
<script type="text/javascript">
$(function(){
	$("#main-nav > li:eq(4) > ul").css('display','block'); 
	$("#main-nav > li:eq(4) > ul > li:eq(1) > a").removeClass('current'); 
	$("#main-nav > li:eq(4) > ul > li:eq(0) > a").removeClass('current'); 
	$("#main-nav > li:eq(4) > ul > li:eq(2) > a").addClass('current'); 
});
</script>
<?php $this->load->view('public/footer'); ?>
