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

				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="<?php echo site_url('index/index'); ?>">首页</a> 
						<i class="icon-angle-right"></i>
					</li>
					<li><a href="javascript:void(0);">用户信息</a><i class="icon-angle-right"></i></li>
					<li><a href="javascript:void(0);">修改密码</a></li>
				</ul>

				<!-- start: Coding... -->
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
							<div class="tabbable" id="tabs-1">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#panel-1" data-toggle="tab">修改用户密码</a>
									</li>
								</ul>
                                <?php if(!empty($msg)){?>
                                <div class="success alert alert-block span10 " style="text-align:center;">
                                    <h4 class="alert-heading"><?php if(!empty($ret) && $ret ==200){ echo 'Success!' ;}else{ echo 'Warning!';}?></h4>
                                    <p> <?php echo $msg;?></p>
                                </div>
                                <div style="clear:both"></div>
                                <?php }?>
								<div class="tab-content">
									<!-- 第一部分内容 -->
									<div class="tab-pane active" id="panel-1">
										<div class="pull-left">
											<form id="local_form" role="form" action="<?php echo site_url('user/user/doUpdatePassword')?>" method="post" enctype="multipart/form-data">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">原密码：</label>
                                                <input type="password" class="form-control" id="old_password" name="opwd" id="opwd" placeholder="密码" />
                                              </div>
                                              <div class="form-group">
                                                <label for="exampleInputPassword1">新密码：</label>
                                                <input type="password" class="form-control" id="new_password" name="npwd" id="npwd" placeholder="新密码" />
                                              </div>
                                              <div class="form-group">
                                                <label for="exampleInputPassword1">重复新密码：</label>
                                                <input type="password" class="form-control" id="new_password2" name="npwd2" id="npwd2" placeholder="重复新密码" />
                                              </div>
                                              <button type="button" class="btn btn-primary" onClick="updata_sbumit()">提交</button>
                                            </form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- end: Coding... -->

				<!-- end: Content -->
			</div>
		</div>
	</div>
	<?php $this->load->view('public/footer'); ?>

	<!-- start: JavaScript-->

<script>
function updata_sbumit(){
	var opwd = $("#opwd").val();
	var npwd = $("#npwd").val();
	var npwd2 = $("#npwd2").val();
	if(opwd == '' || npwd == '' || npwd2 == '' || npwd != npwd2){
		alert('请输入正确的内容');	
	}else{
		$("#local_form").submit();
	}
}	
</script>
	<!-- end: JavaScript-->

</body>
</html>
