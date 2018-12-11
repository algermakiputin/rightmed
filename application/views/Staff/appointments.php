
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
                            <li class="active">Appointments</li>
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
                            <th>Doctor</th>
                            <th>Schedule</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $inc = 1;
                            foreach ($appointments as $appointment): 
                        ?>
                        <tr class="color<?php echo $appointment->type ?>">
                        <td><a class='patientinfo' href="#" data-id='<?php echo $appointment->patient_id ?>' data-toggle='modal' data-target='#patientmodal'><?php echo  ucfirst($appointment->patientlname) . ', ' . ucfirst($appointment->patientfname) . ' ' . ucfirst($appointment->patientmname)?></a></td>
                            <td>
                          <?php echo  ucfirst($appointment->doctorlname) . ', ' . ucfirst($appointment->doctorfname) . ' ' . ucfirst($appointment->doctormname)?></td>
                            <td><?php echo $appointment->date ?>
                                <?php echo date('h:i a', strtotime($appointment->start)) ?>
                                - <?php echo date('h:i a', strtotime($appointment->end)) ?></td>
                            <td>
                                <?php 
                                    if ($appointment->state == 'Accepted')
                                        echo 'Waiting for findings...';
                                    else  {
                                        echo $appointment->state;
                                    }
                                    
                                ?>
                            </td>
                            <td class='d-none'><?php echo $appointment->patient_id ?></td>
                            <td class='d-none'><?php echo $appointment->doctor_id ?></td>
                            <td class='d-none'><?php echo $appointment->schedule_id ?></td>
                            <td class='d-none'><?php echo $appointment->type ?></td>
                            <td>
                                <?php if ($appointment->state != 'Done') { ?>
                                    <a class="edit" href="#" data-id="<?php echo $appointment->id ?>" data-row="<?php echo $inc ?>" data-toggle="modal" data-target="#addeditmodal"> 
                                        <i class="menu-icon fa fa-edit"></i> Edit 
                                    </a>

                                    <br />
                                    <a class="remove" href="#" data-id="<?php echo $appointment->id ?>" data-row="<?php echo $inc ?>" data-toggle="modal" data-target="#removemodal"> 
                                        <i class="menu-icon fa fa-minus"></i> Remove 
                                    </a>
                                <?php } else { ?>
                                    <a class="set" href="archives_details/<?php echo $appointment->patient_id ?>" data-id="<?php echo $appointment->id ?>" data-row="<?php echo $inc ?>">
                                        <i class="menu-icon fa fa-archive"></i> View patient's archive
                                    </a>
                                    <br />
                                    <a class="edit" href="<?php echo base_url() . $usertype ?>/edit_status/<?php echo $appointment->id ?>/Archived/?prev_url=<?php echo current_url() ?>" data-id="<?php echo $appointment->id ?>" data-row="<?php echo $inc ?>"> 
                                        <i class="menu-icon fa fa-check"></i> Archive this entry 
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php 
                            $inc++;
                            endforeach; 
                        ?>
                    </tbody>
                </table>

                <div id="user" class="d-flex justify-content-center">
                <a class="add btn btn-primary" href="#" data-row="<?php echo $inc ?>" data-toggle="modal" data-target="#addeditmodal"> Add new appointment</a>
                </div>
            </section>
        </div> <!-- .content -->
    </div>

    <div class="modal fade" id="addeditmodal" tabindex="-1" role="dialog" aria-labelledby="addeditmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addedit_schedule" action="add_appointment" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addeditmodalLabel">New appointment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id='resproc' class="row">
                            <div class="col">
                                <input type="text" class="d-none form-control" id="id" name="id">
                                <div class="form-group">
                                    <label for="patient">Patient</label>
                                    <select id="patient" name="patient" class="form-control">
                                        <?php foreach($patients as $patient): ?>
                                        <option value="<?php echo $patient->id ?>">
                                            <?php echo $patient->fname . ' ' . $patient->mname ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group" id="doctorgrp">
                                    <label for="doctor">Doctor</label>
                                    <select id="doctor-select" name="doctor" class="form-control">
                                        <?php if (empty($doctors)) echo '<option>Add a new doctor in Users</option>' ?>
                                        <option value="">Select Doctor</option>
                                        <?php foreach ($doctors as $doctor): ?>
                                            <option value='<?php echo $doctor->id ?>'><?php echo ucfirst($doctor->lname) . ', ' . ucfirst($doctor->fname) . ' ' . ucfirst($doctor->mname)?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div id='schedule-info' class="radio">
                                        <div class="row">
                                             
                                        </div>
                                        <input type="hidden" name="schedule" id="schedule_time">
                                        <div class="clearfix"></div>
                                    </div>


                                </div>

                                <div class="form-group" id="doctorgrp">
                                    <label for="type">Type</label>
                                    <select id="type" name="type" class="form-control">                                        
                                        <option value='0'>Normal</option>
                                        <option value='1'>Emergency</option>
                                    </select>
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
        
        jQuery(".add").click(function() {
            jQuery("#addeditmodal .modal-title").html("Adding a new appointment");
            jQuery("#addedit_schedule").attr("action", "add_appointment");

            if (jQuery('#doctor').val() == 'Add a new doctor in Users')
                jQuery("#doctor").val('');
            else {
                jQuery("#doctor").val(jQuery("#doctor option:first").val());
                jQuery('#doctor').trigger('change');
            }

            if (jQuery('#patient').val() == 'Add a new doctor in Users')
                jQuery("#patient").val('');
            else
                jQuery("#patient option:first-child").attr("selected", "selected");

            jQuery("#schedule").attr('selected', false);

            jQuery("#submit").html("Add");
        });

        jQuery(".edit").click(function () {
            jQuery("#addeditmodal .modal-title").html("Editting a doctor's schedule");
            jQuery("#addedit_schedule").attr("action", "edit_appointment");

            jQuery("#addedit_schedule #id").val(jQuery(this).data('id'));
            
            jQuery("#patient").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(4)").html());
            
            jQuery("#doctor").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(5)").html());
            jQuery('#doctor').trigger('change');
            
            jQuery("#type").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(7)").html());
            
            jQuery("#submit").html("Update");
        });

        jQuery(".remove").click(function () {
            jQuery("#removemodal #id2").val(jQuery(this).data('id'));
            jQuery("#removemodal #confirm").html("Are you sure you want to remove " + 
                jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(0)").html() + 
                "'s scheduled appointment to Dr. " + jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(1)").html() +
                " on " + jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(2)").html() + "?");
        });
    

        jQuery(".patientinfo").click(function() {

            var jqxhr = jQuery.ajax( "load_patientinfo/" + jQuery(this).data('id') )
            .done(function( msg ) {
                    jQuery('#patient_info').html(msg);
            })

        });

        jQuery( "#patient" ).click(function() {
            this.size = 1;
        });

        jQuery( "#patient" ).keydown(function( event ) {
            if (event.which == 8) {
                jQuery('#patient').html('<option>' + jQuery('#patient option:first-child').val().substr(0, jQuery('#patient option:first-child').val().length  - 1) + '</option>');

            }
            else {
                jQuery( "#patient" ).html('<option>' + jQuery( "#patient option:first-child" ).text() + String.fromCharCode(event.which) + '</option>');
            }

            var jqxhr = jQuery.ajax( "<?php echo base_url() . $usertype ?>/load_patientnames/" + jQuery('#patient option:first-child').text() )
            .done(function( msg ) {
                jQuery( "#patient" ).html(jQuery( "#patient" ).html() + msg);
            });


            this.size = 5;
        });

    </script>