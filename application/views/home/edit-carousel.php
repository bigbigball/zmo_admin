<?php $this->load->view('public/banner-header'); ?>
<div class="content-box">
  <!-- Start Content Box -->
  <div class="content-box-content">
    <!-- End #tab1 -->
    <div class="tab-content default-tab">
     <form role="form" id="local_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('home/home/doEditCarousel')?>">
        <fieldset>
        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
        <p>
          <label>标题</label>
          <input class="text-input small-input" type="text" id="title" placeholder="请输入标题" style="width:500px;" name="title" value="<?php if(!empty($info['title'])){ echo $info['title'];}?>"/>
          <!--span class="input-notification success png_bg">Successful message</span-->
          <!-- Classes for input-notification: success, error, information, attention -->
          <br />
          <!--small>A small description of the field</small--> </p>
          <?php if(!empty($info['path'])){?>
          <p>
            <label for="exampleInputFile">已上传图片</label>
            <img src="<?php echo $info['path']?>" width="300" height="200" />
          </p>
          <?php }?>
        <p>
          <label for="exampleInputFile">选择图片</label>
          <input type="file" id="file" name="file">
          <small>只上传.jpg/.png格式图片</small>
          <!--span class="input-notification error png_bg">Error message</span--> </p>
        <p>
          <label>对应链接[请以http://开头]</label>
          <input class="text-input large-input" type="text" id="uri" placeholder="请输入链接" style="width:500px;" name="uri" value="<?php if(!empty($info['uri'])){ echo $info['uri'];}?>"/>
        </p>
        <p>
          <input type="hidden" value="<?php echo $info['id']?>" name="id" />
          <input class="button" type="submit" value="提交" onClick="add_carousel()"/>
        </p>
        </fieldset>
        <div class="clear"></div>
        <!-- End .clear -->
      </form>
    </div>
    <!-- End #tab2 -->
  </div>
  <!-- End .content-box-content -->
</div>
<script>
function add_carousel(){
	$("#local_form").submit();	
}
</script>
<?php $this->load->view('public/footer'); ?>
