<?php $this->load->view('public/banner-header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/style/uploadify.css" />
<div class="content-box">
  <!-- Start Content Box -->
  <div class="content-box-header">
    <h3>轮播列表</h3>
    <ul class="content-box-tabs">
      <li><a href="#tab1" class="default-tab">轮播列表</a></li>
      <li><a href="#tab2">添加轮播</a></li>
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
            <th>标题</th>
            <th>链接地址</th>
            <th>显示位置</th>
            <th>图片内容</th>
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
          <?php if(!empty($list)){foreach($list as $k => $v){?>
          <tr>
            <!--td>
              <input type="checkbox" />
            </td-->
            <td><?php echo $v['title'];?></td>
            <td><?php echo $v['uri'];?></td>
            <td><?php echo $v['position'];?></td>
            <td>
				<?php if(!empty($v['path'])){?>
                <img src="<?php echo $v['path'] ;?>" width="200px;"/ height="100px;">
                <?php }?>
            </td>
            <td>
              <!-- Icons -->
              <a href="<?php echo site_url('home/home/editCarousel' , array('id' => $v['id']));?>" title="Edit"><img src="<?php echo $this->config->item("img_path"); ?>icons/pencil.png" alt="Edit" /></a>
              <a href="<?php echo site_url('home/home/deleteCarousel' , array('id' => $v['id']));?>" title="Delete"><img src="<?php echo $this->config->item("img_path"); ?>icons/cross.png" alt="Delete" /></a>
              <!--a href="#" title="Edit Meta"><img src="<?php echo $this->config->item("img_path"); ?>icons/hammer_screwdriver.png" alt="Edit Meta" /></a--> 
           	</td>
          </tr>
          <?php }}?>
        </tbody>
      </table>
    </div>
    <!-- End #tab1 -->
    <div class="tab-content" id="tab2">
      <form role="form" id="local_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('home/home/doAddCarousel')?>">
        <fieldset>
        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
        <p>
          <label>标题</label>
          <input class="text-input small-input" type="text" id="title" placeholder="请输入标题" style="width:500px;" name="title"/>
          <!--span class="input-notification success png_bg">Successful message</span-->
          <!-- Classes for input-notification: success, error, information, attention -->
          <br />
          <!--small>A small description of the field</small--> </p>
          <p>
        <label>显示位置<small>（1,2,3，默认为空）</small></label>
        <input class="text-input small-input" type="text" id="position" placeholder="请输入显示位置" name="position"/>
        </p>
          <p>
            <label for="exampleInputFile">轮播图片</label>
        	<div id="upload_img"></div>
			<?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload'));?>
			<small id='tips'>支持格式:jpg/gif/jpeg/png/bmp;文件小于500k,长宽比4:3</small><br/>
			<a class='operation' href="javascript:$('#upload').uploadifyUpload();">上传文件</a>
			<input id="file_path" type="hidden" name='file_path' value=""></input>
		</p>
          <label>对应链接[请以http://开头]</label>
          <input class="text-input large-input" type="text" id="uri" placeholder="请输入链接" style="width:500px;" name="uri"/>
        </p>
        <!--p>
          <label>Checkboxes</label>
          <input type="checkbox" name="checkbox1" />
          This is a checkbox
          <input type="checkbox" name="checkbox2" />
          And this is another checkbox </p>
        <p>
          <label>Radio buttons</label>
          <input type="radio" name="radio1" />
          This is a radio button<br />
          <input type="radio" name="radio2" />
          This is another radio button </p>
        <p>
          <label>This is a drop down list</label>
          <select name="dropdown" class="small-input">
            <option value="option1">Option 1</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
          </select>
        </p>
        <p>
          <label>Textarea with WYSIWYG</label>
          <textarea class="text-input textarea wysiwyg" id="textarea" name="textfield" cols="79" rows="15"></textarea>
        </p-->
        <p>
          <input class="button" type="submit" value="提交" onClick="add_carousel()"/>
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
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>static/script/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>static/script/jquery-1.3.2.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>static/script/jquery.uploadify.v2.1.0.min.js"></script>
<script>
$(document).ready(function(){
	$("#main-nav > li:eq(1) > ul").css('display','block'); 
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
});
function add_carousel(){
	$("#local_form").submit();	
}
</script>
<?php $this->load->view('public/footer'); ?>

