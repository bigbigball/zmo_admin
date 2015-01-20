<?php $this->load->view('public/header'); ?>
<style>
.form-group{ border:1px solid #5bc0de; padding:10px 5px; margin-top:10px;}
.btn{ margin-top:10px;}
.form-control{ width:500px;}
</style>
</head>
<body>
	<!-- start: Header -->
	<?php $this->load->view('public/banner-header'); ?>
	<!-- start: Header -->
	<div class="container-fluid-full">
		<div class="row-fluid">
			<!-- start: Main Menu -->
			<?php $this->load->view('public/main-menu'); ?>
			<!-- end: Main Menu -->
			<!-- start: Content -->
			<div id="content" class="span10">
            	<form role="form" id="local_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('teacher/teacher/doEditTeacher')?>">
                  <div class="form-group">
                    <label for="exampleInputEmail1">导师姓名</label>
                    <input type="text" class="form-control" id="title" placeholder="请输入导师姓名" style="width:500px;" name="name" value="<?php if(!empty($info['name'])){echo $info['name'];}?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">导师职业</label>
                    <input type="text" class="form-control" id="title" placeholder="请输入导师职业" style="width:500px;" name="occ" value="<?php if(!empty($info['occ'])){echo $info['occ'];}?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">导师描述</label>
                   	<textarea class="form-control" rows="3" id="desc" name="desc"><?php if(!empty($info['desc'])){echo $info['desc'];}?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">导师 简历</label>
                    <textarea class="form-control" rows="3" name="resume" id="resume"><?php if(!empty($info['desc'])){echo $info['resume'];}?></textarea>
                  </div>
                  <?php if(!empty($info['portrait'])){?>
                  <div class="form-group">
                    <label for="exampleInputFile">已上传图片</label>
                    <img src="<?php echo $info['portrait']?>"/>
                  </div>
                  <?php }?>
                  <div class="form-group">
                    <label for="exampleInputFile">导师照片</label>
                    <input type="file" id="file" name="file">
                    <p class="help-block">只能上传.jpg,.png,.jpeg</p>
                  </div>
                   <input type="hidden" value="<?php echo $info['id']?>" name="id" />
                   <input class="button" type="submit" value="提交" onClick="from_submit()"/>
                </form>
			</div>
            <!-- end: Content -->
		</div>
	</div>
	<script src="<?php echo $this->config->item('js_path'); ?>keditor/kindeditor-min.js"></script>
<script src="<?php echo $this->config->item('js_path'); ?>keditor/lang/zh_CN.js"></script>
<script>
$(document).ready(function(){
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('#resume', {
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
</script>
	<?php $this->load->view('public/footer'); ?>
</body>
</html>
