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
            <th>意见</th>
            <th>反馈者邮箱</th>
            <th>日期</th>
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
            <td><?php if(!empty($v['info'])){echo $v['info'];}?></td>
            <td><?php if(!empty($v['mail'])){echo $v['mail'];}?></td>
            <td><?php echo date('Y-m-d H:i:s' , $v['ctime']);?></td>
            <td>
              <!-- Icons -->
              <a href="<?php echo site_url('feedback/feedback/deleteFeedback' , array('id' => $v['id']));?>" title="Delete" onClick="delform()"><img src="<?php echo $this->config->item("img_path"); ?>icons/cross.png" alt="Delete" /></a>
              <!--a href="#" title="Edit Meta"><img src="<?php echo $this->config->item("img_path"); ?>icons/hammer_screwdriver.png" alt="Edit Meta" /></a--> 
           	</td>
          </tr>
          <?php }}?>
        </tbody>
      </table>
    </div>
    <!-- End #tab2 -->
  </div>
  <!-- End .content-box-content -->
</div>
<script>
$(document).ready(function(){
	$("#main-nav > li:eq(3) > ul").css('display','block'); 
	$("#main-nav > li:eq(3) > ul > li:eq(0) > a").removeClass('current'); 
	$("#main-nav > li:eq(3) > ul > li:eq(1) > a").addClass('current'); 
});
function form_submit(){
	$("#local_form").submit();	
}
function delform() {
	if (!confirm("确认要删除？")) {
       window.event.returnValue = false;
    }
}
</script>
<?php $this->load->view('public/footer'); ?>
