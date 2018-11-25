
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
                            <li class="active"><a href="<?php echo base_url() . $this->session->usertype ?>/users">Users</a></li>
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
                            <td>
                          <?php echo  ucfirst($appointment->doctorlname) . ', ' . ucfirst($appointment->doctorfname) . ' ' . ucfirst($appointment->doctormname) ?></td>
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
                                <div class="form-group" id="doctorgrp">
                                    <label for="doctor">Doctor</label>
                                    <select id="doctor" name="doctor" class="form-control">
                                        <?php if (empty($doctors)) echo '<option>Add a new doctor in Users</option>' ?>
                                        <?php foreach ($doctors as $doctor): ?>
                                            <option value='<?php echo $doctor->id ?>'><?php echo ucfirst($doctor->lname) . ', ' . ucfirst($doctor->fname) . ' ' . ucfirst($doctor->mname) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div id='schedule-info' class="radio">
                                        <?php if (empty($schedules)) echo '<p class="text-danger">Current doctor selected currently has no available schedules.</p>' ?>

                                        <?php foreach ($schedules as $schedule): ?>
                                            
                                            <label><input id='schedule' type="radio" name="schedule" value="<?php echo $schedule->id ?>" />
                                                <?php 
                                                    echo $schedule->date . ' ' . 
                                                    date('h:i a', strtotime($schedule->start)) . ' ' .
                                                    date('h:i a', strtotime($schedule->end));
                                                ?>
                                            </label>

                                        <?php endforeach; ?>

                                    </div>
                                </div>

                                <div class="form-group" id="doctorgrp">
                                    <label for="type">Doctor</label>
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
                <form id="remove_schedule" action="<?php echo base_url() . $usertype ?>/remove_appointment" method="post">
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
        
        jQuery(".add").click(function() {
            jQuery("#addeditmodal .modal-title").html("Adding a new appointment");
            jQuery("#addedit_schedule").attr("action", "<?php echo base_url() . $usertype ?>/add_appointment");

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
            jQuery("#addedit_schedule").attr("action", "<?php echo base_url() . $usertype ?>/edit_appointment");

            jQuery("#addedit_schedule #id").val(jQuery(this).data('id'));
            
            jQuery("#patient").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(3)").html());
            
            jQuery("#doctor").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(4)").html());
            jQuery('#doctor').trigger('change');
            
            jQuery("#schedule[value=" + jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(5)").html()).attr('selected', 'selected');
            
            jQuery("#submit").html("Update");
        });

        jQuery(".remove").click(function () {
            jQuery("#removemodal #id2").val(jQuery(this).data('id'));
            jQuery("#removemodal #confirm").html("Are you sure you want to remove " + 
                jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(0)").html() + 
                "'s scheduled appointment to Dr. " + jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(1)").html() +
                " on " + jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(2)").html() + "?");
        });

        jQuery('#doctor').change( function() {
            var jqxhr = jQuery.ajax( "<?php echo base_url() . $usertype ?>/load_appointments?doctor_id=" + jQuery(this).val() )
            .done(function( msg ) {
                if (msg != '')
                    jQuery('#schedule-info').html(msg);
                else {
                    jQuery('#schedule-info').html('<p class="text-danger">Current doctor selected currently has no available schedules.</p>');
                }
            })
        });

    </script>