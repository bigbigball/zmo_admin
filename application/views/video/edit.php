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
       <form role="form" id="local_form" method="post"
        enctype="multipart/form-data" action="<?php echo site_url('video/video/doEditVideo')?>">
        <fieldset class="fla_btn">
        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
        <p>
          <label for="exampleInputFile">视频图片</label>
          <img src="<?php echo $info['img'] ;?>" width="100px;" height="135px;"> </br>
        <p>
        <p>
          <label>视频标题：</label>
          <input type="text" name="title" id="title" value="<?php echo $info['title']?>" class="text-input large-input"/>
        </p>
        <p>
          <label>标签[注：以";"号分割多个tag]</label>
          <input class="text-input large-input" type="text" id="tag" value="<?php echo $info['tag']?>" name="tag"/>
        </p>
        <p>
          <label>简介</label>
         <textarea class="text-input textarea" id="content" name="content" cols="79" rows="15"><?php echo $info['content']?></textarea>
        </p>
        <p>
		  <input type="hidden" id='id' name='id' value="<?php echo $info['id'];?>" /> 
          <input class="button" type="submit" value="提交" onClick="from_submit()"/>
          <input class="button" type="button" value="返回" onClick="go_back()"/>
        </p>
        </fieldset>
        <div class="clear"></div>
        <!-- End .clear -->
      </form>
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
