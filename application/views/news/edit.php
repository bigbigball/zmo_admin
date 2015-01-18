<?php $this->load->view('public/banner-header'); ?>
<div class="content-box">
  <!-- Start Content Box -->
  <div class="content-box-header">
    <h3>列表</h3>
    <ul class="content-box-tabs">
      <li><a href="#tab3" class="default-tab">编辑</a></li>
    </ul>
    <div class="clear"></div>
  </div>
  <!-- End .content-box-header -->
  <div class="content-box-content">
    <div class="tab-content  default-tab" id="tab3">
     <form role="form" id="local_form" method="post"
        enctype="multipart/form-data" action="<?php echo site_url('news/news/doEdit')?>">
        <fieldset>
        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
        <p>
         <input type="hidden" id='id' name='id' value="<?php echo $info['id'];?>" /> 
         <label>标题</label>
          <input class="text-input large-input" type="text" id="title" value="<?php echo $info['title']?>" style="width:500px;" name="title"/>
          <!--span class="input-notification success png_bg">Successful message</span-->
          <!-- Classes for input-notification: success, error, information, attention -->
          <br />
          <!--small>A small description of the field</small--> </p>
        <p>
         <label>作者</label>
          <input class="text-input small-input" type="text" id="author" value="<?php echo $info['author']?>" name="author"/>
          <!--span class="input-notification success png_bg">Successful message</span-->
          <!-- Classes for input-notification: success, error, information, attention -->
          <br />
          <!--small>A small description of the field</small--> </p>
        <p>
          <label>选择类型</label>
          <select name="type" class="small-input">
            <option value="<?php echo $info['type'] ;?>"><?php echo $type[$info['type']];?></option>
          </select>
        </p>
        <p>
          <label for="exampleInputFile">列表图片</label>
          <p>原始图片</p>
          <img src="<?php echo $info['img'] ;?>" width="100px;" height="135px;"> </br>
          <input type="file" id="file" name="file">
          <small>只能上传.jpg,.png,.jpeg</small>
          <!--span class="input-notification error png_bg">Error message</span--> </p>
        <p>
          <label>标签[注：以";"号分割多个tag]</label>
          <input class="text-input large-input" type="text" id="tag" placeholder="tag1;tag2;ta3" style="width:200px;" name="tag"/>
        </p>
         <!--p>
          <label>资讯时间</label>
          <input class="text-input small-input" type="text" id="stime" placeholder="0" name="stime"  onClick="WdatePicker()"/> ----
          <input class="text-input small-input" type="text" id="etime" placeholder="0" name="etime"  onClick="WdatePicker()"/>
        </p-->
        <p>
          <label>列表页描述</label>
         <textarea class="text-input textarea" id="desc" name="desc" cols="79" rows="15"><?php echo $info['desc']?></textarea>
        </p>
        <p>
          <label>正文</label>
         <textarea class="text-input textarea" id="web_description" name="web_description" cols="79" rows="15"><?php echo $info['content']?></textarea>
        </p>
        <p>
          <input class="button" type="submit" value="提交" onClick="from_submit()"/>
          <input class="button" type="button" value="返回" onClick="go_back()"/>
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
<script src="<?php echo $this->config->item('js_path'); ?>keditor/kindeditor-min.js"></script>
<script src="<?php echo $this->config->item('js_path'); ?>keditor/lang/zh_CN.js"></script>
<script>
$(document).ready(function(){
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('#web_description', {
			resizeType : 1,
			allowPreviewEmoticons : false,
			allowImageUpload : true,
			width : '100%',
			afterBlur: function(){this.sync('#web_description');},
			//items : [
			//	'source','fontname', 'fontsize','wordpaste','fullscreen','|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			//	'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			//	'insertunorderedlist', '|', 'emoticons', 'image','multiimage', 'link']
			//items : [
			//	'source','fontname', 'fontsize','wordpaste','fullscreen','|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			//	'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			//	'insertunorderedlist', '|', 'emoticons', 'link']
		});
	});	
});
function add_carousel(){
	$("#local_form").submit();	
}
function go_back(){
	window.location.href="<?php echo site_url('news/news/show'); ?>";
}
</script>
<?php $this->load->view('public/footer'); ?>
