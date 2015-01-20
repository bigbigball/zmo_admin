 <!-- Wrapper for the radial gradient background -->
  <div id="sidebar">
    <div id="sidebar-wrapper">
      <!-- Sidebar with logo and menu -->
      <h1 id="sidebar-title"><a href="#">ZMO Admin</a></h1>
      <!-- Logo (221px wide) -->
      <div style="height:40px;"></div>
      <!--a href="#"><img id="logo" src="<?php echo $this->config->item("img_path"); ?>logo.png" alt="Simpla Admin logo" /></a-->
      <!-- Sidebar Profile links -->
      <div id="profile-links"> Hello, <a href="<?php echo site_url('zmo_admin/admin/info')?>" title="修改账户信息">管理员</a><!--, you have <a href="#messages" rel="modal" title="3 Messages">3 Messages</a--><br />
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
        	  <a href="#/" class="nav-top-item no-submenu">
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
          </ul>
        </li>
      </ul>
      <!-- End #main-nav -->
      <div id="messages" style="display: none">
        <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
        <h3>3 Messages</h3>
        <p> <strong>17th May 2009</strong> by Admin<br />
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. <small><a href="#" class="remove-link" title="Remove message">Remove</a></small> </p>
        <p> <strong>2nd May 2009</strong> by Jane Doe<br />
          Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est. <small><a href="#" class="remove-link" title="Remove message">Remove</a></small> </p>
        <p> <strong>25th April 2009</strong> by Admin<br />
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. <small><a href="#" class="remove-link" title="Remove message">Remove</a></small> </p>
        <form action="#" method="post">
          <h4>New Message</h4>
          <fieldset>
          <textarea class="textarea" name="textfield" cols="79" rows="5"></textarea>
          </fieldset>
          <fieldset>
          <select name="dropdown" class="small-input">
            <option value="option1">Send to...</option>
            <option value="option2">Everyone</option>
            <option value="option3">Admin</option>
            <option value="option4">Jane Doe</option>
          </select>
          <input class="button" type="submit" value="Send" />
          </fieldset>
        </form>
      </div>
      <!-- End #messages -->
    </div>
  </div>
  <!-- End #sidebar -->