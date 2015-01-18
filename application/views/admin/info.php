<?php $this->load->view('public/banner-header'); ?>
<div class="content-box">
  <!-- Start Content Box -->
  <div class="content-box-header">
    <h3>列表</h3>
    <ul class="content-box-tabs">
      <li><a href="#tab1" class="default-tab">列表</a></li>
      <li><a href="#tab2">编辑</a></li>
    </ul>
    <div class="clear"></div>
  </div>
  <!-- End .content-box-header -->
  <div class="content-box-content">
    <div class="tab-content default-tab" id="tab1">
      <!-- This is the target div. id must match the href of this div's tab -->
      <?php if(empty($info)){?>
      <div class="notification attention png_bg"> <a href="#" class="close"><img src="<?php echo $this->config->item("img_path"); ?>icons/cross_grey_small.png" title="关闭" alt="关闭" /></a>
        <div>没有相关数据</div>
      </div>
      <?php }?>
     <fieldset>
        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
        <p>
         <label>用户名</label>
         <label><?php echo $info['uname'];?></label>
          <!--span class="input-notification success png_bg">Successful message</span-->
          <!-- Classes for input-notification: success, error, information, attention -->
          <br />
          <!--small>A small description of the field</small--> </p>
        <p>
        <label>权限</label>
        <label>全部</label>
        </p>
        </fieldset>
        <div class="clear"></div>
    </div>
    <!-- End #tab1 -->
    <div class="tab-content" id="tab2">
     <form role="form" id="local_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('user/user/doUpdatePassword')?>">
        <fieldset>
        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
        <p>
         <label>用户名</label>
         <label><?php echo $info['uname'];?></label>
          <!--span class="input-notification success png_bg">Successful message</span-->
          <!-- Classes for input-notification: success, error, information, attention -->
          <br />
          <!--small>A small description of the field</small--> </p>
         <p>
         <label>新密码</label>
          <input class="text-input small-input" type="password" id="new_password" name="npwd" id="npwd" placeholder="新密码"/>
          <!--span class="input-notification success png_bg">Successful message</span-->
          <!-- Classes for input-notification: success, error, information, attention -->
          <br />
          <!--small>A small description of the field</small--> </p>
         <p>
         <label>重复新密码</label>
          <input class="text-input small-input" type="password" id="new_password2" name="npwd2" id="npwd2" placeholder="重复新密码"/>
          <!--span class="input-notification success png_bg">Successful message</span-->
          <!-- Classes for input-notification: success, error, information, attention -->
          <br />
          <!--small>A small description of the field</small--> </p>
        <p>
          <input class="button" type="submit" value="提交" onClick="from_submit()"/>
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
  var npwd = $("#npwd").val();
  var npwd2 = $("#npwd2").val();
  if(npwd == '' || npwd2 == '' || npwd != npwd2){
    alert('请输入正确的内容');  
  }else{
    $("#local_form").submit();
  }
}
</script>
<?php $this->load->view('public/footer'); ?>