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
                        <th>姓名</th>
                        <th>职业</th>
                        <th>是否热门</th>
                        <th>操作</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <td colspan="6">
              <!--div class="bulk-actions align-left">
                <select name="dropdown">
                  <option value="option1">Choose an action...</option>
                  <option value="option2">Edit</option>
                  <option value="option3">Delete</option>
                </select>
                <a class="button" href="#">Apply to selected</a> </div-->
              <div class="pagination">
              <?php if(!empty($page)){?>
              <?php echo $page;?>
              <?php }?>
              <!--a href="#" title="First Page">&laquo; First</a><a href="#" title="Previous Page">&laquo; Previous</a> <a href="#" class="number" title="1">1</a> <a href="#" class="number" title="2">2</a> <a href="#" class="number current" title="3">3</a> <a href="#" class="number" title="4">4</a> <a href="#" title="Next Page">Next &raquo;</a><a href="#" title="Last Page">Last &raquo;</a--> </div>
              <!-- End .pagination -->
              <div class="clear"></div>
            </td>
          </tr>
        </tfoot>
        <tbody>
          <?php if(!empty($list) && count($list) > 0){foreach($list as $k => $v){?>
          <tr>
            <!--td>
              <input type="checkbox" />
            </td-->
                    	<td>
						<?php if(!empty($v['portrait'])){?>
                        	<img src="<?php echo $v['portrait'] ;?>" width="100px;"/ height="135px;">
							<?php }?>
                        </td>
                        <td><?php echo $v['name'];?></td>
                        <td><?php echo $v['occ']?></td>
                        <td><?php echo $v['top'];?></td>
            <td>
              <!-- Icons -->
              <a href="<?php echo site_url('teacher/teacher/deleteTeacher' , array('id' => $v['id']));?>" title="Delete"><img src="<?php echo $this->config->item("img_path"); ?>icons/cross.png" alt="Delete" /></a>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <a href="<?php echo site_url('teacher/teacher/editTeacher' , array('id' => $v['id']));?>" title="Edit Meta"><img src="<?php echo $this->config->item("img_path"); ?>icons/hammer_screwdriver.png" alt="Edit Meta" /></a> 
           	</td>
          </tr>
          <?php }}?>
        </tbody>
      </table>
    </div>
    <!-- End #tab1 -->
    <div class="tab-content" id="tab2">
      <form role="form" id="local_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('teacher/teacher/doAddTeacher')?>">
        <fieldset>
        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
        <p>
         <label>导师姓名</label>
          <input class="text-input small-input" type="text" id="name" placeholder="请输入导师姓名" name="name"/>
          <!--span class="input-notification success png_bg">Successful message</span-->
          <!-- Classes for input-notification: success, error, information, attention -->
          <br />
          <!--small>A small description of the field</small--> </p>
        <p>
         <label>导师职业</label>
          <input class="text-input small-input" type="text" id="occ" placeholder="请输入导师职业" name="occ"/>
          <!--span class="input-notification success png_bg">Successful message</span-->
          <!-- Classes for input-notification: success, error, information, attention -->
          <br />
          <!--small>A small description of the field</small--> </p>
        <p>
          <label for="exampleInputFile">列表图片</label>
          <input type="file" id="file" name="file">
          <small>只能上传.jpg,.png,.jpeg</small>
          <!--span class="input-notification error png_bg">Error message</span--> </p>
        <p>
          <label>导师描述</label>
         <textarea class="text-input textarea" id="desc" name="desc" cols="79" rows="15"></textarea>
        </p>
        <p>
          <label>导师简历</label>
         <textarea class="text-input textarea" id="resume" name="resume" cols="79" rows="15"></textarea>
        </p>
        <p>
          <input class="button" type="submit" value="提交" onClick="from_submit()"/>
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
<script src="<?php echo $this->config->item('js_path'); ?>keditor/kindeditor-min.js"></script>
<script src="<?php echo $this->config->item('js_path'); ?>keditor/lang/zh_CN.js"></script>
<script>
$(document).ready(function(){
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('#resume', {
			resizeType : 1,
			allowPreviewEmoticons : false,
			allowImageUpload : true,
			width : '100%',
			afterBlur: function(){this.sync('#web_description');},
			//items : [
			//	'source','fontname', 'fontsize','wordpaste','fullscreen','|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			//	'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			//	'insertunorderedlist', '|', 'emoticons', 'image','multiimage', 'link']
			//items : [
			//	'source','fontname', 'fontsize','wordpaste','fullscreen','|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			//	'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			//	'insertunorderedlist', '|', 'emoticons', 'link']
		});
		editor = K.create('#desc', {
			resizeType : 1,
			allowPreviewEmoticons : false,
			allowImageUpload : true,
			width : '100%',
			afterBlur: function(){this.sync('#web_description');},
			//items : [
			//	'source','fontname', 'fontsize','wordpaste','fullscreen','|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			//	'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			//	'insertunorderedlist', '|', 'emoticons', 'image','multiimage', 'link']
			//items : [
			//	'source','fontname', 'fontsize','wordpaste','fullscreen','|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			//	'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			//	'insertunorderedlist', '|', 'emoticons', 'link']
		});
	});	
});
function add_carousel(){
	$("#local_form").submit();	
}
</script>
<?php $this->load->view('public/footer'); ?>
