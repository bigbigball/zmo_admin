<?php $this->load->view('public/banner-header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/style/uploadify.css" />
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
          <p>
        <label>显示位置<small>（1,2,3，默认为空）</small></label>
        <input class="text-input small-input" type="text" id="position" value="<?php echo $info['position']?>" name="position"/>
        </p>
        <p>
            <label for="exampleInputFile">列表图片</label>
        	<div id="upload_img">
        		<img src="<?php echo $info['path']?>" style='width: 80px; height:80px; margin-right: 5px;'/>
        	</div>
			<?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload'));?>
			<small id='tips'>支持格式:jpg/gif/jpeg/png/bmp;文件小于500k,长宽比4:3</small><br/>
			<a class='operation' href="javascript:$('#upload').uploadifyUpload();">上传文件</a>
			<input id="file_path" type="hidden" name='file_path' value=""></input>
		</p>
          <label>对应链接[请以http://开头]</label>
          <input class="text-input large-input" type="text" id="uri" placeholder="请输入链接" style="width:500px;" name="uri" value="<?php if(!empty($info['uri'])){ echo $info['uri'];}?>"/>
        </p>
        <p>
          <input type="hidden" value="<?php echo $info['id']?>" name="id" />
          <input class="button" type="submit" value="提交" onClick="add_carousel()"/>
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
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>static/script/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>static/script/jquery-1.3.2.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>static/script/jquery.uploadify.v2.1.0.min.js"></script>
<script>
$(document).ready(function(){
	$("#main-nav > li:eq(1) > ul").css('display','block'); 
	$("#upload").uploadify({
		uploader: '<?php echo base_url();?>static/resource/uploadify.swf',
		script: '<?php echo base_url();?>static/script/uploadify.php',
		cancelImg: '<?php echo base_url();?>static/resource/cancel.png',
		folder: '',
		multi : true,
		simUploadLimit : 2,
		overwrite : true,
		buttonText: 'Browse',
		sizeLimit: 1048576,
		fileDesc: '支持格式:jpg/gif/jpeg/png/bmp',
		fileExt : '*.jpg;*.gif;*.jpeg;*.png;*.bmp',
		scriptAccess: 'always',
		multi: true,
		'onError' : function (event, queueID, fileObj, errorObj) {
			 if (errorObj.status == 404){
				$('#tips').html('找不到文件');
			 }else if (errorObj.type === "HTTP"){
				 $('#tips').html('error '+errorObj.type+": "+errorObj.status);
			 }else if (errorObj.type ==="File Size"){
				 $('#tips').html(fileObj.name+' '+errorObj.type+' Limit: '+Math.round(errorObj.sizeLimit/1024)+'KB');
			 }else{
				 $('#tips').html('error '+errorObj.type+": "+errorObj.text);
			 }
			},
		'onComplete'   : function (event, queueID, fileObj, response, data) {
			var obj = eval( "(" + response + ")" );
			$('#tips').html("文件上传成功!");
			$('#upload_img').html("<img src='" + obj.path +"' style='width: 80px; height:80px; margin-right: 5px;'/>");
			$('#file_path').val(obj.file_path);
		}	
	});
});
function add_carousel(){
	$("#local_form").submit();	
}
function go_back(){
	window.location.href="<?php echo site_url('home/home/carousel'); ?>";
}
</script>
<?php $this->load->view('public/footer'); ?>
