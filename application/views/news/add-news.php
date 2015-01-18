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
            	<form role="form" id="local_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('news/news/doAddNews')?>">
                  <div class="form-group">
                  	<label>新闻标题</label>
                    <input type="text" name="title" id="title" style="width:450px;"/>
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">选择新闻类型</label>
                    <select class="form-control input-lg" name="type" id="type">
                    	<?php if(!empty($type)){foreach($type as $k => $v){?>
                        <option value="<?php echo $k ;?>"><?php echo $v;?></option>
						<?php }}?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">上传列表图片</label>
                    <input type="file" id="file" name="file">
                    <p class="help-block">只能上传.jpg,.png,.jpeg</p>
                  </div>
                  <div class="form-group">
                  	<label>新闻来源</label>
                    <input type="text" name="author" id="author" style="width:450px;"/>
                  </div>
                  
                   <div class="form-group">
                  	<label>新闻描述</label>
                    <textarea name="desc" id="desc" style="height:250px; width:450px"></textarea>
                  </div>
                  <div class="form-group">
                  	<label>新闻内容</label>
                    <textarea name="web_description" id="web_description" style="height:250px;"></textarea>
                  </div>
                  <button type="button" class="btn btn-primary" onClick="from_submit()">提交</button>
                </form>
			</div>
            <!-- end: Content -->
		</div>
	</div>
	<?php $this->load->view('public/footer'); ?>
	<!-- start: JavaScript-->
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
	function from_submit(){
		$("#local_form").submit();	
	}
	</script>
	<!-- end: JavaScript-->
</body>
</html>
