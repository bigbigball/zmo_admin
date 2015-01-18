<?php $this->load->view('public/header'); ?>
<body id="login">
<div id="login-wrapper" class="png_bg">
  <div id="login-top">
    <h1>ZMO Admin</h1>
    <!-- Logo (221px width) -->
    <div style="height:150px;"></div>
    <!--a href="#"><img id="logo" src="<?php echo $this->config->item("img_path"); ?>logo.png" alt="ZMO Admin logo" /></a> </div-->
  <!-- End #logn-top -->
  <div id="login-content">
    <form action="<?php echo site_url('user/user/doLogin')?>" method="post" enctype="multipart/form-data" id="loacl_form">
      <?php if(!empty($msg)){?>
      <div class="notification information png_bg">
        <div><?php echo $msg;?></div>
      </div>
       <?php }?>
      <p>
        <label>用户名</label>
        <input class="text-input" type="text"  name="uname" id="uname"  placeholder="用户名" onFocus="this.value = '';" onBlur="if (this.value == '') {this.placeholder = '用户名';}"/>
      </p>
      <div class="clear"></div>
      <p>
        <label>密码</label>
        <input class="text-input" type="password" name="upwd" placeholder="密码" onFocus="this.value = '';" onBlur="if (this.value == '') {this.placeholder = '密码';}"/>
      </p>
      <div class="clear"></div>
      <!--p id="remember-password">
        <input type="checkbox" />
        Remember me </p-->
      <div class="clear"></div>
      <p>
        <input class="button" type="submit" value="登录"  onClick="myFunction()"/>
      </p>
    </form>
</div>
</body>
<!-- start: JavaScript-->
<script>
function myFunction(){
    var name= $("#uname").val();
    var pwd = $("#upwd").val();
    if(name == "" || name =="用户名" || pwd =="" || pwd == "密码"){
        alert('请输入您的用户名和密码');	
    }else{
        $("#loacl_form").submit();	
    }
}
</script>
<!-- end: JavaScript-->
</html>


