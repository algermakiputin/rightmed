    <!-- Right Panel -->

        <div id="right-panel" class="right-panel .d-print-none">

    <!-- Header-->
    <header id="header" class="header">

        <div class="header-menu">

            <div class="col-sm-7">
            </div>

            <div class="col-sm-5">
                <div class="user-area dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: relative; top: 6.5px;">
                        <?php 
                            if ($this->session->username)
                                echo ucfirst($this->session->username);
                            else 
                                echo "Guest";
                        ?>
                    </a>

                    <div class="user-menu dropdown-menu text-right">
                        <!-- <?php if ($this->session->username): ?>
                            <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>
                        <?php endif; ?> -->

                            <a class="nav-link" href="<?php echo base_url() . str_replace(' ', '', $this->session->usertype) ?>/logout"><i class="fa fa-power -off"></i>Logout</a>
                    </div>
                </div>

                <div class="language-select" id="language-select">
                    <p>Welcome</p>
                </div>

            </div>
        </div>

    </header>
    <!-- Header-->