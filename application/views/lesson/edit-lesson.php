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
      <form role="form" id="local_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('lesson/lesson/doEditLesson')?>">
        <fieldset>
        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
        <p>
         <label>课程标题</label>
          <input class="text-input small-input" type="text" id="title" placeholder="请输入标题" style="width:500px;" name="title" value="<?php echo $info['info']['title'];?>"/>
          <!--span class="input-notification success png_bg">Successful message</span-->
          <!-- Classes for input-notification: success, error, information, attention -->
          <br />
          <!--small>A small description of the field</small--> </p>
        <p>
          <label>选择类型</label>
          <select name="type" class="small-input">
            <option value="0">请选择</option>
			<?php if(!empty($type)){foreach($type as $k => $v){?>
            <option value="<?php echo $k ;?>" <?php if($info['info']['type'] == $k) echo "selected"?>><?php echo $v;?></option>
            <?php }}?>
          </select>
        </p>
        <p>
          <label>选择导师</label>
          <select name="teacher" class="small-input">
            <option value="0">请选择</option>
			<?php if(!empty($type)){foreach($tinfo as $k => $v){?>
            <option value="<?php echo $v['id'] ;?>" <?php if($info['info']['guest_id'] == $v['id']) echo "selected"?>><?php echo $v['name'];?></option>
            <?php }}?>
          </select>
        </p>
        <p>
        <label>显示位置<small>（1,2,3，默认为空）</small></label>
        <input class="text-input small-input" type="text" id="position" value="<?php echo $info['info']['position']?>" name="position"/>
        </p>
        <p>
        	<label for="exampleInputFile">列表图片</label>
        	<div id="upload_img">
        	<img src='<?php echo $info['info']['img'];?>' style='width: 80px; height:80px; margin-right: 5px;'/>
        	</div>
			<?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload'));?>
			<small id='tips'>支持格式:jpg/gif/jpeg/png/bmp;文件小于500k,长宽比4:3</small><br/>
			<a class='operation' href="javascript:$('#upload').uploadifyUpload();">上传文件</a>
			<input id="file_path" type="hidden" name='file_path' value=""></input>
			</p>
        <p>
          <label>标签[注：以";"号分割多个tag]</label>
          <input class="text-input large-input" type="text" id="tag" placeholder="tag1;tag2;ta3" style="width:200px;" name="tag" value="<?php echo $info['info']['tag_info'];?>"/>
        </p>
         <p>
          <label>时间期限</label>
          <input class="text-input small-input" type="text" id="stime" placeholder="0" name="stime"  value="<?php echo date('Y-m-d', $info['info']['stime']);?>" onClick="WdatePicker()"/> ----
          <input class="text-input small-input" type="text" id="etime" placeholder="0" name="etime"  value="<?php echo date('Y-m-d', $info['info']['etime']);?>"onClick="WdatePicker()"/>
        </p>
        <p>
          <input type="checkbox" name="is_price" <?php if($info['info']['is_price'] == '1') echo "checked";?> value="1"/>
          该课程是否需要缴费 </p>
        <p>
          <label>缴费金额</label>
          <input class="text-input large-input" type="text" id="price" placeholder="0" style="width:200px;" name="price" value="<?php echo $info['info']['price'];?>"/>
        </p>
        <p>
          <label>列表页描述</label>
         <textarea class="text-input textarea" id="desc" name="desc" cols="79" rows="15"><?php echo $info['info']['desc'];?></textarea>
        </p>
        <p>
          <label>地址</label>
         <textarea class="text-input textarea" id="address" name="address" cols="79" rows="15"><?php echo $info['info']['address'];?></textarea>
        </p>
        <p>
          <label>简介</label>
         <textarea class="text-input textarea" id="web_description" name="web_description" cols="79" rows="15"><?php echo $info['info']['content'];?></textarea>
        </p>
        <p>
          <input type="hidden" value="<?php echo $info['info']['id']?>" name="id" />
          <input class="button" type="submit" value="提交" onClick="from_submit()"/>
          <input class="button" type="button" value="返回" onClick="go_back()"/>
        </p>
        </fieldset>
        <div class="clear"></div>
        <!-- End .clear -->
      </form>
    </div>
    
  </div>
  <!-- End .content-box-content -->
</div>
<script src="<?php echo $this->config->item('js_path'); ?>keditor/kindeditor-min.js"></script>
<script src="<?php echo $this->config->item('js_path'); ?>keditor/lang/zh_CN.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>static/script/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>static/script/jquery-1.3.2.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>static/script/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript" language="javascript">
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
				$('#upload_img').html("<img src='" + obj.path +"' style='width: 80px; height:80px; margin-right: 5px;'/>")
				$('#file_path').val(obj.file_path);
			}	
		});
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
				items : [
					'source','fontname', 'fontsize','wordpaste','fullscreen','|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
					'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
					'insertunorderedlist', '|', 'emoticons', 'link']
			});
		});
	});
	function add_carousel(){
		$("#local_form").submit();	
	}
	function go_back(){
		window.location.href="<?php echo site_url('lesson/lesson/show'); ?>";
	}
</script>
	<?php $this->load->view('public/footer'); ?>
