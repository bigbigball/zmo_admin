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
            	<form role="form" id="local_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('teacher/teacher/doAddHomeTeacher')?>">
                  <div class="form-group">
                    <label for="exampleInputEmail1">选择导师</label>
                    <select class="form-control input-lg" name="id" id="id">
                    	<?php if(!empty($info)){foreach($info as $k => $v){?>
                        <option value="<?php echo $v['id'] ;?>">---<?php echo $v['name'];?> ---</option>
						<?php }}?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">首页热门导师展示图片</label>
                    <input type="file" id="file" name="file">
                    <p class="help-block">只能上传.jpg,.png,.jpeg</p>
                  </div>
                   <button type="button" class="btn btn-primary" onClick="add_home_teacher()">提交</button>
                </form>
			</div>
            <!-- end: Content -->
		</div>
	</div>
	<?php $this->load->view('public/footer'); ?>
	<!-- start: JavaScript-->
	<script>
		function add_home_teacher(){
			$("#local_form").submit();	
		}
	</script>
	<!-- end: JavaScript-->
</body>
</html>
