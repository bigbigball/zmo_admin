<?php $this->load->view('public/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/style/uploadify.css" />
<style>
.form-group{ border:1px solid #5bc0de; padding:10px 5px; margin-top:10px;}
.btn{ margin-top:10px;}
.form-control{ width:500px;}
</style>
	<!-- start: Header -->
	<?php $this->load->view('public/banner-header'); ?>
	<!-- start: Header -->
    <div class="tab-content" id="tab2">
      <form role="form" id="local_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('teacher/teacher/doEditTeacher')?>">
        <fieldset>
        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
        <p>
         <label>导师姓名</label>
         <input type="text" class="form-control" id="title" placeholder="请输入导师姓名" style="width:500px;" name="name" value="<?php if(!empty($info['name'])){echo $info['name'];}?>">
          <!--span class="input-notification success png_bg">Successful message</span-->
          <!-- Classes for input-notification: success, error, information, attention -->
          <br />
          <!--small>A small description of the field</small--> </p>
        <p>
         <label>导师职业</label>
         <input type="text" class="form-control" id="title" placeholder="请输入导师职业" style="width:500px;" name="occ" value="<?php if(!empty($info['occ'])){echo $info['occ'];}?>">
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
               <img src="<?php echo $info['portrait']?>" style='width: 80px; height:80px; margin-right: 5px;'/>
        	</div>
			<?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload'));?>
			<small id='tips'>支持格式:jpg/gif/jpeg/png/bmp;文件小于500k,长宽比1:1</small><br/>
			<a class='operation' href="javascript:$('#upload').uploadifyUpload();">上传文件</a>
			<input id="file_path" type="hidden" name='file_path' value=""></input>
        </p>
          <label>导师描述</label>
         <textarea class="form-control" rows="3" id="desc" name="desc"><?php if(!empty($info['desc'])){echo $info['desc'];}?></textarea>
        </p>
        <p>
          <label>导师简历</label>
          <textarea class="form-control" rows="3" name="resume" id="resume"><?php if(!empty($info['desc'])){echo $info['resume'];}?></textarea>
        </p>
        <p>
        <input type="hidden" value="<?php echo $info['id']?>" name="id" />
          <input class="button" type="submit" value="提交" onClick="from_submit()"/>
          <input class="button" type="button" value="返回" onClick="go_back()"/>
        </p>
        </fieldset>
        <div class="clear"></div>
        <!-- End .clear -->
      </form>
    </div>
	<?php $this->load->view('public/footer'); ?>
	<!-- start: JavaScript-->
	<script type="text/javascript" language="javascript" src="<?php echo base_url();?>static/script/swfobject.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url();?>static/script/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url();?>static/script/jquery.uploadify.v2.1.0.min.js"></script>
	
	<script>
	$(document).ready(function(){
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
		function add_teacher(){
			$("#local_form").submit();	
		}
		function go_back(){
			window.location.href="<?php echo site_url('teacher/teacher/show'); ?>";
		}
	</script>
	<!-- end: JavaScript-->
