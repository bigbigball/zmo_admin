<?php $this->load->view('public/header.php');?>
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
<div class="container">
    <form id="addvform" name="addvform" action="" method="get" onsubmit="alert('提交视频');">
    <div class="fla_btn"><span style="float:left;">选择视频：<input id="videofile" name="videofile" type="text" readonly="readonly"/></span> 
    <div style="float:left; position:relative; width:80px; height:25px;">
        <div id="swfDiv" style="width:80px;height:25px;position:absolute;z-index:2;"></div>
        <input type="button" value="upload"	id="btn_width" style="width:80px;height:25px;position:absolute;z-index:1;" />
    </div>
    <div style="clear:both;">视频标题：<input id="title" name="title" type="text" /></div> 
    <div>视频标签：<input id="tag" name="tag" type="text" /></div> 
    <div>视频简介：<textarea id="description" name="description" rows="5" cols="30"></textarea></div> 
    <input id="videoid" name="videoid" type="hidden" value="" /> 
    <div><input type="button" value="提交" onclick="submitvideo();"></div> 
    <br />
    <hr />
    videoid:<div id="videoidshow"></div>
    <div>上传进度：<span id="up"></span></div>
    <div>请求地址：<span id="request_params"></span></div>
    </form>
</div>
<?php $this->load->view('public/footer.php');?>
<script type="text/javascript" src="<?php echo $this->config->item('js_path'); ?>swfobject.js"></script>
<script type="text/javascript"> 
// 加载上传flash ------------- start
var swfobj=new SWFObject('http://union.bokecc.com/flash/api/uploader.swf', 'uploadswf', '80', '25', '8');
swfobj.addVariable( "progress_interval" , 1);	//	上传进度通知间隔时长（单位：s）
swfobj.addVariable( "notify_url" , "<?php echo site_url('video/doSuccess') ?>");	//	上传视频后回调接口
swfobj.addParam('allowFullscreen','true');
swfobj.addParam('allowScriptAccess','always');
swfobj.addParam('wmode','transparent');
swfobj.write('swfDiv');

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
		//document.getElementById("videoidshow").innerHTML = videoid;
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
	var url = "<?php echo site_url('video/getUploadUri')?>?title=" + title + "&tag=" + tag
			+ "&description=" + description;
	var req = getAjax();
	req.open("GET", url, true);
	req.onreadystatechange = function() {
		if (req.readyState == 4) {
			if (req.status == 200) {
				var re = req.responseText;//获取返回的内容
				document.getElementById("uploadswf").start_upload(re); //	调用flash上传函数
				document.getElementById("request_params").innerHTML = re;
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
</script>