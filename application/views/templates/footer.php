
    <!-- ***** Footer Area Start ***** -->
    <footer class="footer-area" id="contact-us">
        <!-- Main Footer Area -->
        <div class="main-footer-area section_padding_100 bg-default">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 footer-widget-area">
                        <div class="widget-title">
                                <h6>Opening Time</h6>
                        </div>
                        <div class="widget-single-contact d-flex align-items-center">
                            <div class="widget-contact-thumbnail mr-15">
                                <img src="<?php echo base_url() ?>includes/others/img/icons/alarm-clock.png" alt="">
                            </div>
                            <div class="widget-contact-info">
                                <p>Monday - Friday 08:00 - 21:00 <br>Saturday &amp; Sunday - CLOSED</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 footer-widget-area">
                        <div class="widget-title">
                                <h6>Address</h6>
                            </div>
                        <div class="widget-single-contact d-flex align-items-center">
                            <div class="widget-contact-thumbnail mr-15">
                                <img src="<?php echo base_url() ?>includes/others/img/icons/map-pin.png" alt="">
                            </div>
                            <div class="widget-contact-info">
                                <p>123 Street, City<br>Country</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 footer-widget-area">
                        <div class="widget-title">
                                <h6>Contact</h6>
                            </div>
                        <div class="widget-single-contact d-flex align-items-center">
                            <div class="widget-contact-thumbnail mr-15">
                                <img src="<?php echo base_url() ?>includes/others/img/icons/envelope.png" alt="">
                            </div>
                            <div class="widget-contact-info">
                                <p>09123456789 <br>contact@business.com</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div>
            <p class="text-center" style="margin: 0;padding: 20px;">&copy; 2018 All Rights Reserved</p>
        </div>
    </footer>
    <!-- ***** Footer Area End ***** -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="<?php echo base_url() ?>includes/others/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="<?php echo base_url() ?>includes/others/js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo base_url() ?>includes/others/js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="<?php echo base_url() ?>includes/others/js/plugins.js"></script>
    <!-- Active js -->
    <script src="<?php echo base_url() ?>includes/others/js/active.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("[name='birthdate']").change(function() {
                var bdate = moment($(this).val());
                var currentAge = moment().diff(bdate, 'years');
                $("#age").val(currentAge);
            })
        })
    </script>
</body>

</html>