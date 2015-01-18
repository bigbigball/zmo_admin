<?php $this->load->view('public/banner-header'); ?>
<div class="content-box">
  <!-- Start Content Box -->
  <div class="content-box-header">
    <h3>列表</h3>
    <ul class="content-box-tabs">
      <li><a href="#tab1" class="default-tab">列表</a></li>
      <li><a href="#tab2">添加</a></li>
    </ul>
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
            <th>用户权限组</th>
            <th>权限</th>
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
              <div class="clear"></div>
            </td>
          </tr>
        </tfoot>
        <tbody>
          <?php if(!empty($list) && count($list) > 0){foreach($list as $k => $v){?>
          <tr>
            <td><?php echo $v['zh_name'];?></td>
            <td><?php 
             $as = '';
            if(!empty($v['action'])){
              $a = explode(',' , $v['action']);
              if(!empty($a) && count($a) > 0){
                foreach($a as $vv){
                  $as .= $action[$vv]['zh_name'] .'&nbsp;&nbsp;';
                }
              } 
              echo $as ;
            }
            ?></td>
            <td>
              <!-- Icons -->
              <a href="<?php echo site_url('admin/admin/deletePower' , array('id' => $v['id']));?>" title="Delete"><img src="<?php echo $this->config->item("img_path"); ?>icons/cross.png" alt="Delete" /></a>
              <!--a href="#" title="Edit Meta"><img src="<?php echo $this->config->item("img_path"); ?>icons/hammer_screwdriver.png" alt="Edit Meta" /></a--> 
           	</td>
          </tr>
          <?php }}?>
        </tbody>
      </table>
    </div>
    <!-- End #tab1 -->
    <div class="tab-content" id="tab2">
      <form role="form" id="local_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('admin/admin/doAddPower')?>">
        <fieldset>
        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
        <p>
         <label>权限组</label>
          <input class="text-input small-input" type="text" id="zh_name" placeholder="请输入权限组名" name="zh_name"/>
          <!--span class="input-notification success png_bg">Successful message</span-->
          <!-- Classes for input-notification: success, error, information, attention -->
          <br />
          <!--small>A small description of the field</small--> </p>
        <p>
          <label>选择权限</label>
			     <?php if(!empty($action)){foreach($action as $k => $v){?>
            <input class="check-all" type="checkbox" name="power[]" value="<?php echo $v['id'];?>" checked>&nbsp;&nbsp;<?php echo $v['zh_name'];?>
            <?php }}?>
        </p>
        <p>
          <input class="button" type="submit" value="提交" onClick="form_submit()"/>
        </p>
        </fieldset>
        <div class="clear"></div>
        <!-- End .clear -->
      </form>
    </div>
    <!-- End #tab2 -->
  </div>
  <!-- End .content-box-content -->
</div>
<script>
function from_submit(){
	$("#form_submit").submit();	
}
</script>
<?php $this->load->view('public/footer'); ?>
