<?php $this->load->view('public/header'); ?>
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
            	<form role="form" id="local_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('home/home/doAddCarousel')?>">
                  <div class="form-group">
                    <label for="exampleInputEmail1">标题</label>
                    <input type="text" class="form-control" id="title" placeholder="请输入标题" style="width:500px;" name="title">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">选择图片</label>
                    <input type="file" id="file" name="file">
                    <p class="help-block">只能上传.jpg,.png,.jpeg</p>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">对应链接[请以http://开头]</label>
                    <input type="text" class="form-control" id="uri" placeholder="请输入链接" style="width:500px;" name="uri">
                  </div>
                   <button type="button" class="btn btn-primary" onClick="add_carousel()">提交</button>
                </form>
			</div>
            <!-- end: Content -->
		</div>
	</div>
	<?php $this->load->view('public/footer'); ?>
	<!-- start: JavaScript-->
	<script>
		function add_carousel(){
			$("#local_form").submit();	
		}
	</script>
	<!-- end: JavaScript-->
</body>
</html>
