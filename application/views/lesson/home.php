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
            	<?php if(!empty($list) && count($list) > 0){?>
                <table class="table table-bordered">
                	<tr>
                    	<th>头像</th>
                        <th>姓名</th>
                        <th>职业</th>
                        <th>首页热门头像</th>
                        <th>操作</th>
                    </tr>
                    <?php foreach($list as $k => $v){?>
                   	<tr>
                    	<td>
						<?php if(!empty($v['portrait'])){?>
                        	<img src="<?php echo $v['../teacher - 拷贝/portrait'] ;?>" width="100px;"/ height="135px;">
						<?php }?>
                        </td>
                        <td><?php echo $v['name'];?></td>
                        <td><?php echo $v['occ']?></td>
                        <td>
						<?php if(!empty($v['home_img'])){?>
                        	<img src="<?php echo $v['../teacher - 拷贝/home_img'] ;?>" width="100px;"/ height="135px;">
						<?php }?>                        
                        </td>
                        <td>
                        	<a href="<?php echo site_url('teacher/teacher/editHomeTeacher' , array('id' => $v['id']));?>"><button type="button" class="btn btn-info">编辑</button></a>
                        	<a href="<?php echo site_url('teacher/teacher/deleteHomeTeacher' , array('id' => $v['id']));?>"><button type="button" class="btn btn-warning">删除</button></a>
                        </td>
                    </tr>
					<?php }?>
                </table>
                <?php }else{?>
				<div class="alert alert-block span10" style="text-align:center;">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>没有相关数据.</p>
                </div>
                <?php }?>
                <?php if(!empty($page)){?>
                 <div class="blockquote">
                    <?php echo $page;?>
                </div>
                <?php }?>
			</div>
            <!-- end: Content -->
		</div>
	</div>
	<?php $this->load->view('public/footer'); ?>
	<!-- start: JavaScript-->
	<script>
		$(function(){
			
		});
	</script>
	<!-- end: JavaScript-->
</body>
</html>
