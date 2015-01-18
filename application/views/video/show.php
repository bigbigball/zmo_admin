<?php $this->load->view('public/banner-header'); ?>
<style type="text/css">
.fla_btn {
  position: relative;
}
.fla_btn embed {
  position: absolute;
  z-index: 1;
}
#swfDiv{*position:absolute; z-index:2;}
</style>
<div class="content-box">
  <!-- Start Content Box -->
  <div class="content-box-header">
    <h3>列表</h3>
    <ul class="content-box-tabs">
      <li><a href="#tab1" class="default-tab">列表</a></li>
      <!--  <li><a href="#tab2">添加</a></li>  -->
      <li><a href="#tab3">上传视频同步到本地</a></li>
    </ul>
    <div class="clear"></div>
  </div>
  <!-- End .content-box-header -->
  <div class="content-box-content">
    <div class="tab-content default-tab" id="tab1">
      <!-- This is the target div. id must match the href of this div's tab -->
      <?php if(empty($video)){?>
      <div class="notification attention png_bg"> <a href="#" class="close"><img src="<?php echo $this->config->item("img_path"); ?>icons/cross_grey_small.png" title="关闭" alt="关闭" /></a>
        <div>没有相关数据</div>
      </div>
      <?php }?>
      <table>
        <thead>
          <tr>
            	<th>图片</th>
              <th>题目</th>
              <th>内容</th>
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
          <?php if(!empty($video) && count($video) > 0){foreach($video as $k => $v){?>
          <tr>
                    	<td>
						<?php if(!empty($v['img'])){?>
                        	<img src="<?php echo $v['img'] ;?>" width="100px;"/ height="135px;">
							<?php }?>
                        </td>
                        <td><?php echo $v['title'];?></td>
                        <td><?php echo $v['content']?></td>
            <td>
              <!-- Icons -->
              <a href="<?php echo site_url('video/video/deleteVideo' , array('id' => $v['id']));?>" title="Delete"><img src="<?php echo $this->config->item("img_path"); ?>icons/cross.png" alt="Delete" /></a>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <a href="<?php echo site_url('video/video/updateVideo' , array('id' => $v['id']));?>" title="Update"><img src="<?php echo $this->config->item("img_path"); ?>icons/hammer_screwdriver.png" alt="Update" /></a> 
           	</td>
          </tr>
          <?php }}?>
        </tbody>
      </table>
    </div>
    <!-- End #tab1 -->
    <div class="tab-content" id="tab2">
       <form id="addvform" name="addvform" action="" method="get" onsubmit="alert('提交视频');">
        <fieldset class="fla_btn">
        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
        <div style="height:25px; line-height:25px;">
         <label>选择视频：</label>
        <div style="float:left;" >
        <input id="videofile" name="videofile" type="text" readonly="readonly"/></div>
        <div style="float:left; position:relative; width:80px; height:25px;">
            <div id="swfDiv" style="width:80px;height:25px;position:absolute;z-index:2;"></div>
            <input type="button" value="upload" id="btn_width" style="width:80px;height:25px;position:absolute;z-index:1;" />
        </div> 
        </div>
        <div style="clear:both"></div>
        <p>
            <label>上传进度：</label><span id="up"></span>
        <p>
        <p>
          <label>视频标题：</label>
          <input type="text" name="title" id="title" class="text-input large-input"/>
        </p>
        <p>
          <label>标签[注：以";"号分割多个tag]</label>
          <input class="text-input large-input" type="text" id="tag" placeholder="tag1;tag2;tag3" name="tag"/>
        </p>
        <p>
          <label>简介</label>
         <textarea class="text-input textarea" id="description" name="description" cols="79" rows="15"></textarea>
        </p>
        <p>
        	<input id="videoid" name="videoid" type="hidden"/>
          <input class="button" type="button" value="提交" onClick="submitvideo()"/>
        </p>
        </fieldset>
        <div class="clear"></div>
        <!-- End .clear -->
      </form>
    </div>
    <!-- End #tab2 -->
    <div class="tab-content" id="tab3">
        <fieldset class="fla_btn">
        <p>
          <input class="button" type="button" value="提交" onClick="toloacl();"/>
        </p>
        </fieldset>
        <div class="clear"></div>
        <!-- End .clear -->
    </div>
    <!-- End #tab3 -->
  </div>
  <!-- End .content-box-content -->
</div>
<script type="text/javascript" src="<?php echo $this->config->item('js_path'); ?>swfobject.js"></script>
<script>
$(document).ready(function(){
  // 加载上传flash ------------- start
var swfobj=new SWFObject('http://union.bokecc.com/flash/api/uploader.swf', 'uploadswf', '80', '25', '8');
swfobj.addVariable( "progress_interval" , 1); //  上传进度通知间隔时长（单位：s）
swfobj.addVariable( "notify_url" , "<?php echo site_url('video/doSuccess') ?>");  //  上传视频后回调接口
swfobj.addParam('allowFullscreen','true');
swfobj.addParam('allowScriptAccess','always');
swfobj.addParam('wmode','transparent');
swfobj.write('swfDiv');
// 加载上传flash ------------- end
});
//-------------------
//调用者：flash
//功能：选中上传文件，获取文件名函数
//时间：2010-12-22
//说明：用户可以加入相应逻辑
//-------------------
function on_spark_selected_file(filename) {
  document.getElementById("videofile").value = filename;
}
//-------------------
//调用者：flash
//功能：验证上传是否正常进行函数
//时间：2010-12-22
//说明：用户可以加入相应逻辑
//-------------------
function on_spark_upload_validated(status, videoid) {
  if (status == "OK") {
    alert("上传正常,videoid:" + videoid);
    document.getElementById("videoid").value = videoid;
    document.getElementById("videoidshow").innerHTML = videoid;
  } else if (status == "NETWORK_ERROR") {
    alert("网络错误");
  } else {
    alert("api错误码：" + status);
  }
}

//-------------------
//调用者：flash
//功能：通知上传进度函数
//时间：2010-12-22
//说明：用户可以加入相应逻辑
//-------------------
function on_spark_upload_progress(progress) {
  var uploadProgress = document.getElementById("up");
  if (progress == -1) {
    uploadProgress.innerHTML = "上传出错：" + progress;
  } else if (progress == 100) {
    uploadProgress.innerHTML = "进度：100% 上传完成";
  } else {
    uploadProgress.innerHTML = "进度：" + progress + "%";
  }
}

function positionUploadSWF() {
  document.getElementById("swfDiv").style.width = document
      .getElementById("btn_width").style.width;
  document.getElementById("swfDiv").style.height = document
      .getElementById("btn_width").style.height;
}
function submitvideo() {
  var videofile = document.getElementById("videofile").value;
  var title = encodeURIComponent(document.getElementById("title").value, "utf-8");
  var tag = encodeURIComponent(document.getElementById("tag").value, "utf-8");
  var description = encodeURIComponent(document.getElementById("description").value, "utf-8");
  var url = "<?php echo site_url('video/video/getUploadUri')?>?title=" + title + "&tag=" + tag
      + "&description=" + description;
  var req = getAjax();
  req.open("GET", url, true);
  req.onreadystatechange = function() {
    if (req.readyState == 4) {
      if (req.status == 200) {
        var re = req.responseText;//获取返回的内容
        document.getElementById("uploadswf").start_upload(re); // 调用flash上传函数
        //document.getElementById("request_params").innerHTML = re;
      }
    }
  };
  req.send(null);
}
function getAjax() {
  var oHttpReq = null;

  if (window.XMLHttpRequest) {
    oHttpReq = new XMLHttpRequest;
    if (oHttpReq.overrideMimeType) {
      oHttpReq.overrideMimeType("text/xml");
    }
  } else if (window.ActiveXObject) {
    try {
      oHttpReq = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      oHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
  } else if (window.createRequest) {
    oHttpReq = window.createRequest();
  } else {
    oHttpReq = new XMLHttpRequest();
  }

  return oHttpReq;
}
function toloacl(){
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('video/video/toLocal')?>",
    data: "",
    success: function(msg){
      //var info = eval("(" + msg + ")");
      //if(info.ret == 200){
         alert('同步成功');
       //}else{
       //   alert('没有内容可以同步');
       //}
      window.location.reload();
    }
  });
}
</script>
<?php $this->load->view('public/footer'); ?>
