
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
                            <li class="active">Doctor Schedule</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <section class='main-sec'>
                <h1>Doctor Schedule</h1>
                
                <?php if ($this->input->get('error') != '')
                    echo "<p class='text-danger'>Duplicate doctor schedule is invalid. Please enter a new one.</p>";
                ?>

                <table id="classes" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Schedule List</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $inc =0; ?>
                        <?php foreach($schedules as $key => $schedule): ?>
                        <tr>
                            <td>
                          <?php echo  ucfirst($schedule['lname']) . ', ' . ucfirst($schedule['fname']) . ' ' . ucfirst($schedule['mname']) ?></td>
                            <td>
                                    
                                    <p>
                                        <div id='sched<?php echo $key; $inc = $key ?>';>
                                            <?php echo $schedule['date'] ?>
                                            <?php echo ($schedule['start']) ? $schedule['start'] . ' - '  :'' ?>
                                            <?php echo ($schedule['end']) ?>
                                        </div>
                                        <div class="d-none" id="sched_id<?php echo $key ?>"><?php echo $schedule['id'] ?></div>
                                        <?php if ($schedule['date']): ?>
                                        <a class="edit" href="#" data-row="<?php echo $key ?>" data-num="<?php echo $key ?>" data-id="<?php echo $schedule['id'] ?>" data-id="<?php echo $schedule['id'] ?>" data-date='<?php echo $schedule['date'] ?>' data-start='<?php echo $schedule['start'] ?>' data-end='<?php echo $schedule['end'] ?>' data-toggle="modal" data-target="#addeditmodal"> 
                                            <i class="menu-icon fa fa-edit"></i> Edit 
                                        </a>
                                        <?php endif; ?>
                                    </p>
                                
                            </td>
                            <td class="d-none"><?php echo $schedule['id'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div id="user" class="d-flex justify-content-center">
                <a class="add btn btn-primary" href="#" data-row="<?php echo $inc ?>" data-toggle="modal" data-target="#addeditmodal"> Add new schedule</a>
                </div>
            </section>
        </div> <!-- .content -->
    </div>

    <div class="modal fade" id="addeditmodal" tabindex="-1" role="dialog" aria-labelledby="addeditmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addedit_schedule" action="add_section" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addeditmodalLabel">New schedule</h5>
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
                                        <?php foreach ($doctors as $doctor): ?>
                                            <option value='<?php echo $doctor->id ?>'><?php echo ucfirst($doctor->lname) . ', ' . ucfirst($doctor->fname) . ' ' . ucfirst($doctor->mname) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" id="date" name="date" min="<?php echo date('Y-m-d') ?>">
                                </div>
                                <div class="form-group row">
                                    <div class="col-6">
                                        <label for="start">Start Time</label>
                                        <input type="time" class="form-control" id="start" name="start">
                                    </div>
                                    <div class="col-6">
                                        <label for="end">End Time</label>
                                        <input type="time" class="form-control" id="end" name="end">
                                    </div>
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
                <form id="remove_schedule" action="remove_schedule" method="post">
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
            jQuery("#addeditmodal .modal-title").html("Adding a new doctor's schedule");
            jQuery("#addedit_schedule").attr("action", "add_schedule");

            jQuery("#doctorgrp").show();

            if (jQuery('#doctor').val() == 'Add a new doctor in Users')
                jQuery("#doctor").val('');
            else
                jQuery("#doctor option:first-child").attr("selected", "selected");

            jQuery("#date").val('');
            jQuery("#start").val('');
            jQuery("#end").val('');
            jQuery("#submit").html("Add");
        });

        jQuery(".edit").click(function () {
            jQuery("#addeditmodal .modal-title").html("Editting a doctor's schedule");
            jQuery("#addedit_schedule").attr("action", "edit_schedule");
            jQuery("#id").val(jQuery("div#sched_id" + jQuery(this).data('num')).html());
            jQuery("#doctorgrp").hide();
            jQuery("#doctor").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(2)").html());
            jQuery("#date").val(jQuery(this).data('date'));
            jQuery("#start").val(jQuery(this).data('start'));
            jQuery("#end").val(jQuery(this).data('end'));
            jQuery("#submit").html("Update");
        });

        jQuery(".remove").click(function () {
            jQuery("#removemodal #id2").val(jQuery(this).data('id'));
            jQuery("#removemodal #confirm").html("Are you sure you want to remove " + 
                jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(0)").html() + 
                "'s schedule on " + jQuery("div#sched" + jQuery(this).data('num')).html() + "?");
        });

    </script>