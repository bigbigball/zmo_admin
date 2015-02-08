 <!-- Wrapper for the radial gradient background -->
  <div id="sidebar">
    <div id="sidebar-wrapper">
      <!-- Sidebar with logo and menu -->
      <h1 id="sidebar-title"><a href="#">ZMO Admin</a></h1>
      <!-- Logo (221px wide) -->
      <div style="height:40px;"></div>
      <!--a href="#"><img id="logo" src="<?php echo $this->config->item("img_path"); ?>logo.png" alt="Simpla Admin logo" /></a-->
      <!-- Sidebar Profile links -->
      <div id="profile-links"> Hello, <a href="<?php echo site_url('admin/admin/show')?>" title="修改账户信息">管理员</a><!--, you have <a href="#messages" rel="modal" title="3 Messages">3 Messages</a--><br />
        <br />
        <a href="http://www.cmpao.com" title="ZMO 网站" target="_blank">官网</a> | <a href="<?php echo site_url('user/user/loginout')?>" title="退出">退出</a> 
      </div>
      <ul id="main-nav">
      	<!--选中 current-->
        <!-- Accordion Menu -->
         <!--li> 
            <a href="#/" class="nav-top-item no-submenu">
              管理员管理</a> 
              <ul>
                <li><a class="current" href="<?php echo site_url('zmo_admin/admin/show'); ?>">管理员信息</a></li>
                <li><a class="current" href="<?php echo site_url('zmo_admin/admin/power'); ?>">权限信息</a></li>
              </ul>
        </li-->
        <li> 
            <a href="#/" class="nav-top-item no-submenu">
              <!-- Add the class "no-submenu" to menu items with no sub menu -->
              个人信息管理</a> 
              <ul>
                <li><a class="current" href="<?php echo site_url('user/user/info'); ?>">个人信息</a></li>
              </ul>
        </li>
        <li> 
        	  <a href="#" class="nav-top-item no-submenu">
              <!-- Add the class "no-submenu" to menu items with no sub menu -->
              首页推荐 </a> 
              <ul>
                <li><a class="current" href="<?php echo site_url('home/home/carousel'); ?>">轮播列表</a></li>
              </ul>
        </li>
        <li> 
          <a href="#" class="nav-top-item">
          <!-- Add the class "current" to current menu item -->
          内容管理 </a>
          <ul>
            <li><a class="current" href="<?php echo site_url('lesson/lesson/show'); ?>">课程</a></li>
            <li><a href="<?php echo site_url('video/video/show'); ?>">视频</a></li>
            <li><a href="<?php echo site_url('active/active/show'); ?>">活动</a></li>
            <li><a href="<?php echo site_url('teacher/teacher/show'); ?>">导师</a></li>
            <li><a href="<?php echo site_url('news/news/show'); ?>">资讯</a></li>
          </ul>
        </li>
        <li> 
          <a href="#" class="nav-top-item">
          <!-- Add the class "current" to current menu item -->
          运营管理 </a>
          <ul>
            <li><a class="current" href="<?php echo site_url('operate/operate/show'); ?>">邀请码</a></li>
            <li><a class="current" href="<?php echo site_url('feedback/feedback/show'); ?>">意见反馈</a></li>
          </ul>
        </li>
      </ul>
      <!-- End #main-nav -->
    </div>
  </div>
  <!-- End #sidebar -->