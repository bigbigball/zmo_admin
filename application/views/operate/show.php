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
            <th>邀请码</th>
            <th>活动</th>
            <th>是否使用</th>
            <th>使用手机号</th>
            <th>使用邮箱</th>
            <th>有效期</th>
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
            <td><?php echo $v['code'];?></td>
            <td><?php if(!empty($v['title'])){echo $v['title'];}?></td>
            <td><?php if(strval($v['status']) == '0'){echo '未使用';}else{echo '已使用';}?></td>
            
            <td><?php if(!empty($v['phone'])){echo $v['phone'];}?></td>
            <td><?php if(!empty($v['mail'])){echo $v['mail'];}?></td>
            <td><?php if($v['expire'] > time()){ echo date('Y-m-d H:i:s' , $v['expire']);}else{echo '已过期';}?></td>
            <td>
              <!-- Icons -->
              <a href="<?php echo site_url('active/active/deleteActive' , array('id' => $v['id']));?>" title="Delete" onClick="delform()"><img src="<?php echo $this->config->item("img_path"); ?>icons/cross.png" alt="Delete" /></a>
              <!--a href="#" title="Edit Meta"><img src="<?php echo $this->config->item("img_path"); ?>icons/hammer_screwdriver.png" alt="Edit Meta" /></a--> 
           	</td>
          </tr>
          <?php }}?>
        </tbody>
      </table>
    </div>
    <!-- End #tab1 -->
    <div class="tab-content" id="tab2">
      <form role="form" id="local_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('operate/operate/doAddOperate')?>">
        <fieldset>
        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
        <p>
         <label>活动标题</label>
          <input class="text-input small-input" type="text" id="title" placeholder="请输入标题"name="title"/>
          <!--span class="input-notification success png_bg">Successful message</span-->
          <!-- Classes for input-notification: success, error, information, attention -->
          <br />
          <!--small>A small description of the field</small--> </p>
        <p>
          <label>时间期限</label>
          <input class="text-input small-input" type="text" id="etime" placeholder="0" name="etime"  onClick="WdatePicker()"/>
        </p>
         <p>
          <label>数量</label>
          <input class="text-input small-input" type="text" id="amount" placeholder="必填" name="amount"/>
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
