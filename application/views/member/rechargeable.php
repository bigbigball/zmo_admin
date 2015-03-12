<?php $this->load->view('public/banner-header'); ?>
<div class="content-box">
  <!-- Start Content Box -->
  <div class="content-box-header">
    <h3>列表</h3>
    <div class="clear"></div>
  </div>
  <!-- End .content-box-header -->
  <div class="content-box-content">
    <div class="tab-content default-tab" id="tab1">
      <!-- This is the target div. id must match the href of this div's tab -->
      <?php if(empty($list)){?>
      <div class="notification attention png_bg"> <a href="#" class="close"><img src="<?php echo $this->config->item("img_path"); ?>icons/cross_grey_small.png" title="关闭" alt="关闭" /></a>
        <div>没有相关数据</div>
      </div>
      <?php }?>
      <table>
        <thead>
          <tr>
            <th>用户ID</th>
            <th>昵称</th>
            <th>手机号</th>
            <th>使用邮箱</th>
            <th>用户类型</th>
            <th>注册时间</th>
            <th>操作</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <td colspan="6">
              <div class="pagination">
              <?php if(!empty($page)){?>
              <?php echo $page;?>
              <?php }?>
               </div>
              <!-- End .pagination -->
              <div class="clear"></div>
            </td>
          </tr>
        </tfoot>
        <tbody>
          <?php if(!empty($list) && count($list) > 0){foreach($list as $k => $v){?>
          <tr>
            <td><?php echo $v['id'];?></td>
            <td><?php echo $v['nick_name'];?></td>
            <td><?php echo $v['mobile'];?></td>
            <td><?php echo $v['email'];?></td>
            <td><?php echo $v['type'] == 1 ? '邮箱注册' : '手机注册';?></td>
            <td><?php echo date('Y-m-d H:i:s' , $v['ctime']);?></td>
            <td>
                <a href="<?php echo site_url('member/member/detail' , array('id' => $v['id'], 'isfee'=> true));?>">查看详情</a>
           	</td>

          </tr>
          <?php }}?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- End .content-box-content -->
</div>
<script type="text/javascript">
$(function(){
	$("#main-nav > li:eq(4) > ul").css('display','block'); 
	$("#main-nav > li:eq(4) > ul > li:eq(0) > a").removeClass('current'); 
	$("#main-nav > li:eq(4) > ul > li:eq(1) > a").addClass('current'); 
});
</script>
<?php $this->load->view('public/footer'); ?>
