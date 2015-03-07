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
      <li><a href="#tab1" class="default-tab">编辑</a></li>
    </ul>
    <div class="clear"></div>
  </div>
  <!-- End .content-box-header -->
  <div class="content-box-content">
    <div class="tab-content default-tab" id="tab1">
        <div class="content-box-content">
    <?php
    	if ($ret) {
    		echo "<span class='input-notification success png_bg'>更新CC视频到本地成功</span>";
            echo "<p><span class='input-notification'>[温馨提示:删除CC视频，请记得在ZMO后台也删除视频,谢谢]</span></p>";
    	} else {
    		echo "<span class='input-notification error png_bg'>更新失败，如果时常成功时常失败，请联系CC视频中心，可能是接口不稳定。</span>";
    	}
    ?>
      </div>
    <br>
        <div class="content-box-content">
            <p>
                <label>是否付费观看：</label>
                <br>
            <div id="is_cost">
                免费<input class="text-input small-input" value="0" type="radio"
                         <? if ($is_cost ==0):?>
                         checked="checked"
                         <?endif;?>
                         name="need_cost" >
                付费<input class="text-input small-input" type="radio" value="1"
                        <? if ($is_cost ==1):?>
                            checked="checked"
                        <?endif;?>
                         name="need_cost" >
            </div>
            </p>
            <br>
            <p>
                <label>付费金额：</label>
                <br>
                <input class="text-input small-input" type="input" value="<? echo $cost; ?>" id="cost_value" name="cost" placeholder="付款金额">
            </p>
            <br>
    
            <p>
                <input class="button" type="button" value="提交" onClick="editVideo(<?php echo $_GET['id']?>)"/>
                <input class="button" type="button" value="返回" onClick="go_back()"/>
            </p>
        </div>
    </div>
      <!-- End #tab1 -->
  </div>
  <!-- End .content-box-content -->
</div>
<script>
function go_back(){
	window.location.href="<?php echo site_url('video/video/show'); ?>";
}
function editVideo(id){
    var is_cost = $('#is_cost input[name="need_cost"]');
    for(var i in is_cost) {
        if(is_cost.eq(i).attr('checked')){
            is_cost = is_cost.eq(i).val();
            break;
        }
    }
    var cost = $('#cost_value').val();
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('video/video/isCostVideo')?>",
        data: {is_cost:is_cost,cost:cost,id:id},
        success: function(msg){
            //var info = eval("(" + msg + ")");
            //if(info.ret == 200){
            if(msg){
                alert('操作成功');
                window.location.href="<?php echo site_url('video/video/show'); ?>";
            }else{
                alert('操作失败');
            }
            //}else{
            //   alert('没有内容可以同步');
            //}
        }
    });
}
</script>
<?php $this->load->view('public/footer'); ?>
