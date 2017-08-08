 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
          
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               
            </div>
           
            <div class="logoContainer">
               <img width="180" class="pageLogo" src="<?php echo $this->config->item('assets_url')?>images/timbremedia_logo.jpg" />
              <a class="navbar-brand navbarHeading" href="<?php echo base_url(); ?>admin">CORPORATE RADIO ADMINISTRATION PANEL</a>
             </div>   
            <!-- /.navbar-header -->
            
            <ul class="nav navbar-top-links navbar-right">
          
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!--<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>-->
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>admin/index/user_logout">Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <div style="float:right;margin-right:170px"  > <a target="_blank" href="<?php echo base_url(); ?>">Visit Corporate Radio</a></div>