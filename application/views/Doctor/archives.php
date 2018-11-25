
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?php echo base_url() . $this->session->usertype ?>">Dashboard</a></li>
                            <li class="active">Archives</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <section class='main-sec'>
                <h1>Archives</h1>

                <table id="classes" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Last Appointment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $inc = 1;
                            foreach ($appointments as $appointment): 
                        ?>
                        <tr>
                            <td><a class='patientinfo' href="archives_details/<?php echo $appointment->id ?>" data-id='<?php echo $appointment->id ?>'><?php echo  ucfirst($appointment->lname) . ', ' . ucfirst($appointment->fname) . ' ' . ucfirst($appointment->mname) ?></a></td>
                            <td><?php echo $appointment->date ?></td>
                        </tr>
                        <?php 
                            $inc++;
                            endforeach; 
                        ?>
                    </tbody>
                </table>

                </div>
            </section>
        </div> <!-- .content -->
    </div>

    <div class="modal fade" id="addeditmodal" tabindex="-1" role="dialog" aria-labelledby="addeditmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addedit_schedule" action="<?php echo base_url() . $usertype ?>/add_medical" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addeditmodalLabel">Medical info of </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="d-none form-control" id="id" name="id">
                                <div class="form-group" id="doctorgrp">
                                    <label for="medinfo">Medical info</label>
                                    <textarea disabled id="medinfo" name="medinfo" class="form-control" rows='10'></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addeditmodal2" tabindex="-1" role="dialog" aria-labelledby="addeditmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addedit_schedule" action="<?php echo base_url() . $usertype ?>/add_findings" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addeditmodalLabel">Setting diagnosis</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="d-none form-control" id="id2" name="id">
                                <div class="form-group">
                                    <label for="patient">Patient</label>
                                    <input value='' class="form-control" id='patient' readonly/>
                                </div>
                                <div class="form-group" id="doctorgrp">
                                    <label for="findings">Diagnosis</label>
                                    <textarea id="findings" name="findings" class="form-control" rows='10'></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button id="submit" type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="patientmodal" tabindex="-1" role="dialog" aria-labelledby="addeditmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addedit_user" action="add_user" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addeditmodalLabel">Patient info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                        <div id='resproc' class="row">
                            <div id='patient_info' class="col"></div>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        jQuery(".view").click(function () {
            
            jQuery("#medinfo").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(3)").html());
            jQuery("#addeditmodal h5").html(jQuery("#addeditmodal h5").html() + jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(0)").html());

        });

        jQuery(".set").click(function () {

            jQuery("#id2").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(2)").html());
            jQuery("#findings").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(4)").html());
            jQuery("#patient").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(0)").text());

        });
        
        jQuery(".patientinfo").click(function() {

            var jqxhr = jQuery.ajax( "load_patientinfo/" + jQuery(this).data('id') )
            .done(function( msg ) {
                    jQuery('#patient_info').html(msg);
            })

        });

    </script> 