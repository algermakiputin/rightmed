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
                            <li class="active">Home</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <section class='main-sec'>
                <h1>Appointments</h1>

                <table id="classes" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Schedule</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $inc = 1;
                            foreach ($appointments as $appointment): 
                        ?>
                        <tr class="color<?php echo $appointment->type ?>">
                            <td><a class='patientinfo' href="archives_details/<?php echo $appointment->id ?>" data-id='<?php echo $appointment->id ?>'><?php echo  ucfirst($appointment->patientlname) . ', ' . ucfirst($appointment->patientfname) . ' ' . ucfirst($appointment->patientmname)?></a></td>
                            <td><?php echo $appointment->date ?>
                                <?php echo date('h:i a', strtotime($appointment->start)) ?>
                                - <?php echo date('h:i a', strtotime($appointment->end)) ?></td>
                            <td class='d-none'><?php echo $appointment->patient_id ?></td>
                            <td class='d-none'><?php echo $appointment->medinfo ?></td>
                            <td>
                                <?php if ($appointment->req_medical == '0') { ?>
                                
                                <a class="edit" href="<?php echo base_url() . $usertype ?>/req_medical/<?php echo $appointment->id ?>" data-id="<?php echo $appointment->id ?>" data-row="<?php echo $inc ?>"> 
                                    <i class="menu-icon fa fa-id-card"></i> Request medical
                                </a>

                                <?php } else if ($appointment->medinfo != '') {
                                    
                                    echo $appointment->medinfo;

                                } else echo 'Pending medical request' ?>

                                <a class="edit" href="<?php echo base_url() . $usertype ?>/edit_status/<?php echo $appointment->id ?>/Accepted/?prev_url=<?php echo current_url() ?>" data-id="<?php echo $appointment->id ?>" data-row="<?php echo $inc ?>"> 
                                    <i class="menu-icon fa fa-check"></i> Accept 
                                </a>

                                <a class="remove" href="<?php echo base_url() . $usertype ?>/edit_status/<?php echo $appointment->id ?>/Declined/?prev_url=<?php echo current_url() ?>" data-id="<?php echo $appointment->id ?>" data-row="<?php echo $inc ?>"> 
                                    <i class="menu-icon fa fa-ban"></i> Decline 
                                </a>
                            </td>
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
                        <h5 class="modal-title" id="addeditmodalLabel">Setting medical info for </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id='resproc' class="row">
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

    <div class="modal fade" id="removemodal" tabindex="-1" role="dialog" aria-labelledby="removemodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="remove_schedule" action="remove_appointment" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="removemodalLabel">Remove schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="d-none form-control" id="id2" name="id2">
                        <p id="confirm"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button id="submit" type="submit" class="btn btn-primary">Confirm</button>
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