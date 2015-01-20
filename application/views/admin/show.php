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
            <!--th>
              <input class="check-all" type="checkbox" />
            </th-->
             <th>头像</th>
            <th>用户名</th>
            <th>权限</th>
            <th>状态</th>
            <th>创建时间</th>
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
            <td>
            <?php if(!empty($v['img'])){?>
                <img src="<?php echo $v['img'] ;?>" width="100px;"/ height="135px;">
                <?php }?>
            </td>
            <td><?php echo $v['uname'];?></td>
            <td><?php echo $v['power_group'];?></td>
            <td><?php if(strval($v['status'] == '0')){ echo '正在使用';}else{ echo '禁止使用';}?></td>
            <td><?php echo date('Y-m-d H:i:s' , $v['ctime']);?></td>
            <td>
              <!-- Icons -->
              <a href="<?php echo site_url('zmo_admin/admin/deleteAdmin' , array('id' => $v['id']));?>" title="Delete"><img src="<?php echo $this->config->item("img_path"); ?>icons/cross.png" alt="Delete" /></a>
              <!--a href="#" title="Edit Meta"><img src="<?php echo $this->config->item("img_path"); ?>icons/hammer_screwdriver.png" alt="Edit Meta" /></a--> 
           	</td>
          </tr>
          <?php }}?>
        </tbody>
      </table>
    </div>
    <!-- End #tab1 -->
    <div class="tab-content" id="tab2">
      <form role="form" id="local_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('zmo_admin/admin/doAddAdmin')?>">
        <fieldset>
        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
        <p>
         <label>用户名</label>
          <input class="text-input small-input" type="text" id="title" placeholder="请输入用户名" name="title"/>
          <!--span class="input-notification success png_bg">Successful message</span-->
          <!-- Classes for input-notification: success, error, information, attention -->
          <br />
          <!--small>A small description of the field</small--> </p>
        <p>
          <label>选择权限</label>
			     <?php if(!empty($power)){foreach($power as $k => $v){?>
            <input class="check-all" type="checkbox" name="power[]" value="<?php echo $v['id'];?>" checked>&nbsp;&nbsp;<?php echo $v['zh_name'];?>
            <?php }}?>
        </p>
        <p>
          <label for="exampleInputFile">用户头像</label>
          <input type="file" id="file" name="file">
          <small>只能上传.jpg,.png,.jpeg</small>
          <!--span class="input-notification error png_bg">Error message</span--> </p>
          <p>
          <label>用户密码</label>
          <input class="text-input small-input" type="text" id="password" placeholder="用户密码" name="password"/>
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
