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
            	<form role="form" id="local_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('teacher/teacher/doAddTeacher')?>">
                  <div class="form-group">
                    <label for="exampleInputEmail1">导师姓名</label>
                    <input type="text" class="form-control" id="title" placeholder="请输入导师姓名" style="width:500px;" name="name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">导师职业</label>
                    <input type="text" class="form-control" id="title" placeholder="请输入导师职业" style="width:500px;" name="occ">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">导师描述</label>
                   	<textarea class="form-control" rows="3" id="desc" name="desc"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">导师简历</label>
                    <textarea class="form-control" rows="3" name="resume" id="resume"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">导师照片</label>
                    <input type="file" id="file" name="file">
                    <p class="help-block">只能上传.jpg,.png,.jpeg;文件小于500k,标准图片尺寸250x290px</p>
                  </div>
                   <button type="button" class="btn btn-primary" onClick="add_teacher()">提交</button>
                </form>
			</div>
            <!-- end: Content -->
		</div>
	</div>
	<?php $this->load->view('public/footer'); ?>
	<!-- start: JavaScript-->
	<script>
		function add_teacher(){
			$("#local_form").submit();	
		}
	</script>
	<!-- end: JavaScript-->
</body>
</html>
