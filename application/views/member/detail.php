<?php $this->load->view('public/banner-header'); ?>
<style type="text/css">
p label{display:inline-block;width:100px;text-align:right;margin-right:10px;}
p span{font-weight:bold;}
</style>
<div class="content-box">
  <!-- Start Content Box -->
  <div class="content-box-header">
    <h3>用户详情</h3>
    <div class="clear"></div>
  </div>
  <!-- test zhangliang -->
  <!-- End .content-box-header -->
  <div class="content-box-content">
    <div class="tab-content default-tab" id="tab1">
      <!-- This is the target div. id must match the href of this div's tab -->
      <?php if(empty($detail)){?>
      <div class="notification attention png_bg"> <a href="#" class="close"><img src="<?php echo $this->config->item("img_path"); ?>icons/cross_grey_small.png" title="关闭" alt="关闭" /></a>
        <div>没有相关数据</div>
      </div>
      <?php }?>
        <fieldset>
        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
        <p><label>用户ID:</label><span><?php echo $detail['id'];?></span></p>
        <?php 
            if($detail['nick_name']){
                echo "<p><label>昵称:</label><span>".$detail['nick_name']."</span></p>";
            } 
        ?>
        <?php 
            if($detail['email']){
                echo "<p><label>邮箱:</label><span>".$detail['email']."</span></p>";
            } 
        ?>
        <?php 
            if($detail['mobile']){
                echo "<p><label>手机号:</label><span>".$detail['mobile']."</span></p>";
            } 
        ?>
        <?php 
            if($detail['type'] == 1){
                echo "<p><label>用户类型:</label><span>邮箱注册</span></p>";
            }elseif($detail['type'] == 2) {
                echo "<p><label>用户类型:</label><span>手机注册</span></p>";
            }else{
                echo "<p><label>用户类型:</label><span>未知</span></p>";
            }
        ?>
        <?php 
            if($payInfo){
                echo "<hr>";
                echo "<h3>订单列表</h3>";
                foreach($payInfo as $order){
                    echo "<hr>";
                    echo "<p><label>订单ID:</label><span>".$order['id']."</span></p>";
                    echo "<p><label>订单号:</label><span>".$order['order_sn']."</span></p>";
                    echo "<p><label>订单金额:</label><span>".$order['price']."元</span></p>";
                    echo "<p><label>支付金额:</label><span>".$order['amount']."元</span></p>";
                    echo "<p><label>折扣:</label><span>".$order['discount']."</span></p>";
                    echo "<p><label>订单状态:</label><span>".($order['status'] == 2 ? "已支付" : "待支付")."</span></p>";
                    echo "<p><label>订单类型:</label><span>".$order['goods_type']."</span></p>";
                    echo "<p><label>订单标题:</label><span>".$order['goods_title']."</span></p>";
                }
            }
        ?>
        <?php 
            if($favourList){
                echo "<hr>";
                echo "<h3>收藏列表</h3>";
                foreach($favourList as $type=>$favour){
                    echo "<hr>";
                    if($type == 2){
                        echo "<p style='background:#ccc;'>收藏课程</p>";
                        foreach($favour as $val){
                            echo "<p><label>课程标题:</label><span>".$val['title']."</span></p>";
                        }

                    }elseif($type == 3){
                        echo "<p style='background:#ccc;'>收藏活动</p>";
                        foreach($favour as $val){
                            echo "<p><label>活动标题:</label><span>".$val['title']."</span></p>";
                            echo "<p><label>活动主题:</label><span>".$val['theme']."</span></p>";
                        }
                    }elseif($type == 4){
                        echo "<p style='background:#ccc;'>收藏老师</p>";
                        foreach($favour as $val){
                            echo "<p><label>老师名称:</label><span>".$val['name']."</span></p>";
                            echo "<p><label>老师职业:</label><span>".$val['occupation']."</span></p>";
                        }
                    }
                }
            }
        ?>
        </fieldset>
        <div class="clear"></div>
        <input type="hidden" value="<?php echo $isfee;?>" id="isfee" />
        <!-- End .clear -->
    </div>
  </div>
  <!-- End .content-box-content -->
</div>
<script>
$(document).ready(function(){
    var isfee = $("#isfee").val();
    $("#main-nav > li:eq(4) > ul").css('display','block');
    if(isfee){
        $("#main-nav > li:eq(4) > ul > li:eq(0) > a").removeClass('current');
        $("#main-nav > li:eq(4) > ul > li:eq(1) > a").addClass('current');
    }else{
        $("#main-nav > li:eq(4) > ul > li:eq(1) > a").removeClass('current');
        $("#main-nav > li:eq(4) > ul > li:eq(0) > a").addClass('current');
    }
});
</script>
<?php $this->load->view('public/footer'); ?>

