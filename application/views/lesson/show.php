<?php $this->load->view('public/banner-header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/style/uploadify.css" />
<div class="content-box">
  <!-- Start Content Box -->
  <div class="content-box-header">
    <h3>课程列表</h3>
    <ul class="content-box-tabs">
      <li><a href="#tab1" class="default-tab">课程列表</a></li>
      <li><a href="#tab2">添加课程</a></li>
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
            <th>图片</th>
            <th>题目</th>
            <th>是否收费</th>
            <th>收费金额</th>
            <th>地址</th>
            <th>tag</th>
            <th>位置</th>
            <th>期数</th>
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
			<?php if(!empty($v['thumb'])){?>
                <img src="<?php echo $v['thumb'] ;?>" width="100px;"/ height="135px;">
                <?php }?>
            </td>
            <td><?php echo $v['title'];?></td>
            <td><?php if(!empty($v['is_price']) && $v['is_price'] == 1){ echo '是' ; }else{ echo '否';}?></td>
            <td><?php echo $v['price'];?></td>
            <td><?php echo $v['address'];?></td>
            <td><?php echo str_replace('|' , ';' , $v['tag_info']);?></td>
            <td><?php echo $v['position']?></td>
            <td><?php echo $v['sequence']?></td>
            <td>
				<?php if(!empty($v['path'])){?>
                <img src="<?php echo $v['path'] ;?>" width="200px;"/ height="100px;">
                <?php }?>
            </td>
            <td>
              <!-- Icons -->
              <a href="<?php echo site_url('lesson/lesson/deleteLesson' , array('id' => $v['id']));?>" title="Delete" onClick="delform()"><img src="<?php echo $this->config->item("img_path"); ?>icons/cross.png" alt="Delete" /></a>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <a href="<?php echo site_url('lesson/lesson/editLesson' , array('id' => $v['id']));?>" title="Edit Meta"><img src="<?php echo $this->config->item("img_path"); ?>icons/hammer_screwdriver.png" alt="Edit Meta" /></a> 
           	</td>
          </tr>
          <?php }}?>
        </tbody>
      </table>
    </div>
    <!-- End #tab1 -->
    <div class="tab-content" id="tab2">
      <form role="form" id="local_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('lesson/lesson/doAddLesson')?>">
        <fieldset>
        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
        <p>
         <label>课程标题</label>
          <input class="text-input small-input" type="text" id="title" placeholder="请输入标题" style="width:500px;" name="title"/>
          <!--span class="input-notification success png_bg">Successful message</span-->
          <!-- Classes for input-notification: success, error, information, attention -->
          <br />
          <!--small>A small description of the field</small--> </p>
        <p>
          <label>选择类型</label>
          <select name="type" class="small-input">
            <option value="0">请选择</option>
			<?php if(!empty($type)){foreach($type as $k => $v){?>
            <option value="<?php echo $k ;?>"><?php echo $v;?></option>
            <?php }}?>
          </select>
        </p>
        <p>
          <label>选择导师</label>
          <select name="teacher" class="small-input">
            <option value="0">请选择</option>
			<?php if(!empty($type)){foreach($tinfo as $k => $v){?>
            <option value="<?php echo $v['id'] ;?>"><?php echo $v['name'];?></option>
            <?php }}?>
          </select>
        </p>
        <p>
        <label>课程期数<small>（1,2,3，默认为空）</small></label>
        <input class="text-input small-input" type="text" id="sequence" placeholder="请输入显示位置" name="sequence"/>
        </p>
        <p>
        <label>显示位置<small>（1,2,3，默认为空）</small></label>
        <input class="text-input small-input" type="text" id="position" placeholder="请输入显示位置" name="position"/>
        </p>
        <p>
        	<label for="exampleInputFile">列表图片</label>
        	<div id="upload_img"></div>
			<?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload'));?>
			<small id='tips'>支持格式:jpg/gif/jpeg/png/bmp;文件小于500k,长宽比4:3<br>若作为第一张大图，保证图片宽1000px、高400px左右</small><br/>
			<a class='operation' href="javascript:$('#upload').uploadifyUpload();">上传文件</a>
			<input id="file_path" type="hidden" name='file_path' value=""></input>
        </p>
        <p>
          <label>标签[注：以";"号分割多个tag]</label>
          <input class="text-input large-input" type="text" id="tag" placeholder="tag1;tag2;ta3" style="width:200px;" name="tag"/>
        </p>
         <p>
          <label>时间期限</label>
          <input class="text-input small-input" type="text" id="stime" placeholder="0" name="stime"  onClick="WdatePicker()"/> ----
          <input class="text-input small-input" type="text" id="etime" placeholder="0" name="etime"  onClick="WdatePicker()"/>
        </p>
        <p>
          <label>Checkboxes</label>
          <input type="checkbox" name="is_price" value="1"/>
          该课程是否需要缴费 </p>
        <p>
          <label>缴费金额</label>
          <input class="text-input large-input" type="text" id="price" placeholder="0" style="width:200px;" name="price"/>
        </p>
        <p>
          <label>列表页描述</label>
         <textarea class="text-input textarea" id="desc" name="desc" cols="79" rows="15" placeholder="限制输入500字"></textarea>
        </p>
        <p>
          <label>地址</label>
         <textarea class="text-input textarea" id="address" name="address" cols="79" rows="15" placeholder="限制输入100字"></textarea>
        </p>
        <p>
          <label>正文</label>
         <textarea class="text-input textarea" id="web_description" name="web_description" cols="79" rows="15"></textarea>
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
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>static/script/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>static/script/jquery-1.3.2.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>static/script/jquery.uploadify.v2.1.0.min.js"></script>
<script>
$(document).ready(function(){
	$("#main-nav > li:eq(2) > ul").css('display','block'); 
	$("#main-nav > li:eq(2) > ul > li:eq(1) > a").removeClass('current'); 
	$("#main-nav > li:eq(2) > ul > li:eq(2) > a").removeClass('current'); 
	$("#main-nav > li:eq(2) > ul > li:eq(3) > a").removeClass('current'); 
	$("#main-nav > li:eq(2) > ul > li:eq(4) > a").removeClass('current'); 
	$("#main-nav > li:eq(2) > ul > li:eq(0) > a").addClass('current'); 
	$("#upload").uploadify({
		uploader: '<?php echo base_url();?>static/resource/uploadify.swf',
		script: '<?php echo base_url();?>static/script/uploadify.php',
		cancelImg: '<?php echo base_url();?>static/resource/cancel.png',
		folder: '',
		multi : true,
		simUploadLimit : 2,
		overwrite : true,
		buttonText: 'Browse',
		sizeLimit: 1048576,
		fileDesc: '支持格式:jpg/gif/jpeg/png/bmp',
		fileExt : '*.jpg;*.gif;*.jpeg;*.png;*.bmp',
		scriptAccess: 'always',
		multi: true,
		'onError' : function (event, queueID, fileObj, errorObj) {
			 if (errorObj.status == 404){
				$('#tips').html('找不到文件');
			 }else if (errorObj.type === "HTTP"){
				 $('#tips').html('error '+errorObj.type+": "+errorObj.status);
			 }else if (errorObj.type ==="File Size"){
				 $('#tips').html(fileObj.name+' '+errorObj.type+' Limit: '+Math.round(errorObj.sizeLimit/1024)+'KB');
			 }else{
				 $('#tips').html('error '+errorObj.type+": "+errorObj.text);
			 }
			},
		'onComplete'   : function (event, queueID, fileObj, response, data) {
			var obj = eval( "(" + response + ")" );
			$('#tips').html("文件上传成功!");
			$('#upload_img').html("<img src='" + obj.path +"' style='width: 80px; height:80px; margin-right: 5px;'/>");
			$('#file_path').val(obj.file_path);
		}	
	});
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('#web_description', {
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
function delform() {
	if (!confirm("确认要删除？")) {
       window.event.returnValue = false;
    }
}
</script>
<?php $this->load->view('public/footer'); ?>

