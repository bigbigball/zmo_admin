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
                    	<th>图片</th>
                        <th>题目</th>
                        <th>是否收费</th>
                        <th>收费金额</th>
                        <th>地址</th>
                        <th>tag</th>
                        <th>操作</th>
                    </tr>
                    <?php foreach($list as $k => $v){?>
                   	<tr>
                    	<td>
						<?php if(!empty($v['thumb'])){?>
                        	<img src="<?php echo $v['thumb'] ;?>" width="100px;"/ height="135px;">
							<?php }?>
                        </td>
                        <td><?php echo $v['title'];?></td>
                        <td><?php if(!empty($v['is_price']) && $v['is_price'] == 1){ echo '是' ; }else{ echo '否';}?></td>
                        <td><?php echo $v['price'];?></td>
                        <td><?php echo $v['address'];?></td>
                        <td><?php echo str_replace('|' , ';' , $v['tag_info']);?></td>
                        <td>
                        	<!--a href="<?php echo site_url('lesson/lesson/editLesson' , array('id' => $v['id']));?>"><button type="button" class="btn btn-info">编辑</button></a-->
                        	<a href="<?php echo site_url('lesson/lesson/deleteLesson' , array('id' => $v['id']));?>"><button type="button" class="btn btn-warning">删除</button></a>
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
