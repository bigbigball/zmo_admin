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
                    	<th>图片</th>
                        <th>题目</th>
                        <th>来源</th>
                        <th>时间</th>
                        <!--th>描述</th-->
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
						<?php if(!empty($v['img'])){?>
                        	<img src="<?php echo $v['img'] ;?>" width="100px;"/ height="135px;">
							<?php }?>
                        </td>
                        <td><?php echo $v['title'];?></td>
                        <td><?php echo $v['author']?></td>
                        <td><?php echo date('Y-m-d',$v['ctime']);?></td>
                        <!--td><?php echo $v['desc'];?></td-->
            <td>
              <!-- Icons -->
              <a href="<?php echo site_url('news/news/deleteNews' , array('id' => $v['id']));?>" title="Delete">
              	<img src="<?php echo $this->config->item("img_path"); ?>icons/cross.png" alt="Delete" />
              </a>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <a href="<?php echo site_url('news/news/edit' , array('id' => $v['id']));?>" title="Edit Meta">
              	<img src="<?php echo $this->config->item("img_path"); ?>icons/hammer_screwdriver.png" alt="Edit Meta" />
              </a> 
           	</td>
          </tr>
          <?php }}?>
        </tbody>
      </table>
    </div>
    <!-- End #tab1 -->
    <div class="tab-content" id="tab2">
     <form role="form" id="local_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('news/news/doAddNews')?>">
        <fieldset>
        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
        <p>
         <label>标题</label>
          <input class="text-input large-input" type="text" id="title" placeholder="请输入标题" style="width:500px;" name="title"/>
          <!--span class="input-notification success png_bg">Successful message</span-->
          <!-- Classes for input-notification: success, error, information, attention -->
          <br />
          <!--small>A small description of the field</small--> </p>
        <p>
         <label>作者</label>
          <input class="text-input small-input" type="text" id="author" placeholder="请输入作者" name="author"/>
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
          <label for="exampleInputFile">列表图片</label>
          <input type="file" id="file" name="file">
          <small>只能上传.jpg,.png,.jpeg</small>
          <!--span class="input-notification error png_bg">Error message</span--> </p>
        <p>
          <label>标签[注：以";"号分割多个tag]</label>
          <input class="text-input large-input" type="text" id="tag" placeholder="tag1;tag2;ta3" style="width:200px;" name="tag"/>
        </p>
         <!--p>
          <label>资讯时间</label>
          <input class="text-input small-input" type="text" id="stime" placeholder="0" name="stime"  onClick="WdatePicker()"/> ----
          <input class="text-input small-input" type="text" id="etime" placeholder="0" name="etime"  onClick="WdatePicker()"/>
        </p-->
        <p>
          <label>列表页描述</label>
         <textarea class="text-input textarea" id="desc" name="desc" cols="79" rows="15"></textarea>
        </p>
        <p>
          <label>简介</label>
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
<script>
$(document).ready(function(){
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
</script>
<?php $this->load->view('public/footer'); ?>
