    <!-- Right Panel -->

        <div id="right-panel" class="right-panel .d-print-none">

    <!-- Header-->
    <header id="header" class="header">

        <div class="header-menu">

            <div class="col-sm-7">
                <div class="header-left">
                    <?php if ($notif = hasNotifications()) : ?>
                    <div class="dropdown for-notification">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="count bg-danger">
                                <?php echo count($notif); ?>
                            </span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="notification">
                            <a class="dropdown-item media notification" href="#" data-recipient = <?php echo $notif[0]->recipient ?>>
                                <i class="fa fa-check"></i>
                                <p>You have <?php echo count($notif) ?> new appointment.</p>
                            </a>
                            <!-- <?php foreach ($notif as $noti) : ?>
                                <a class="dropdown-item media " href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                            <?php endforeach; ?> -->
                            
                           
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
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