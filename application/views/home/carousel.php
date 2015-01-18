<?php $this->load->view('public/banner-header'); ?>
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
            <th>链接诶地址</th>
            <th>状态</th>
            <th>排序</th>
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
            <td><?php echo $v['status']?></td>
            <td><?php echo $v['order'];?></td>
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
          <label for="exampleInputFile">选择图片</label>
          <input type="file" id="file" name="file">
          <small>只上传.jpg/.png格式图片</small>
          <!--span class="input-notification error png_bg">Error message</span--> </p>
        <p>
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
<script>
function add_carousel(){
	$("#local_form").submit();	
}
</script>
<?php $this->load->view('public/footer'); ?>

