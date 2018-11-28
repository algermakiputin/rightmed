
    <!-- ***** Footer Area Start ***** -->
 
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

            var height = $(document).height();
            var width = $(document).width();

            if (width > 980) {
                height = height - 100;
                $(".single-hero-slide").css('height' , height + 'px');
            }
        })
    </script>
</body>

</html>