<!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                    <a href="<?php echo base_url() . $this->session->usertype ?>"> <!--<i class="menu-icon fa fa-dashboard"></i>--><b align="center"><h5>R.E.D Medical Laboratory Clinic</h5></b></a>
                    </li>
                    
					<h3 class="menu-title">Dashboard</h3><!-- /.menu-title -->
                    
					<li class="menu-item">
                        <a href="<?php echo base_url() . $user ?>"> 
                            <i class="menu-icon fa fa-home"></i>Home
                        </a>

                        <a href="<?php echo base_url() . $user ?>/my_patients"> 
                            <i class="menu-icon fa fa-user-md"></i>My Patients
                        </a>

                        <a href="<?php echo base_url() . $user ?>/archives"> 
                            <i class="menu-icon fa fa-archive"></i>Archives
                        </a>
                    </li>

                    <!-- <h3 class="menu-title">Wala kabalo unsay Title #1</h3><!-- /.menu-title 
                    
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-archive"></i>Link #1</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-map-marker"></i><a href="<?php echo base_url() . $user ?>/">Link #1</a></li>
                            <li><i class="fa fa-map-marker"></i><a href="<?php echo base_url() . $user ?>/">Link #2</a></li>
                            <li><i class="fa fa-map-marker"></i><a href="<?php echo base_url() . $user ?>/">Link #3</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-archive"></i>Link #2</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-map-marker"></i><a href="<?php echo base_url() . $user ?>/">Link #1</a></li>
                            <li><i class="fa fa-map-marker"></i><a href="<?php echo base_url() . $user ?>/">Link #2</a></li>
                            <li><i class="fa fa-map-marker"></i><a href="<?php echo base_url() . $user ?>/">Link #3</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-archive"></i>Link #3</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-map-marker"></i><a href="<?php echo base_url() . $user ?>/">Link #1</a></li>
                            <li><i class="fa fa-map-marker"></i><a href="<?php echo base_url() . $user ?>/">Link #2</a></li>
                            <li><i class="fa fa-map-marker"></i><a href="<?php echo base_url() . $user ?>/">Link #3</a></li>
                        </ul>
                    </li> -->
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>

    <!-- Left Panel -->