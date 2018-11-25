
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
                <h1>Requests</h1>

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
                        <td><a class='patientinfo' href="#" data-id='<?php echo $appointment->patient_id ?>' data-toggle='modal' data-target='#patientmodal'><?php echo  ucfirst($appointment->patientlname) . ', ' . ucfirst($appointment->patientfname) . ' ' . ucfirst($appointment->patientmname)?></a></td>
                            <td><?php echo $appointment->date ?>
                                <?php echo date('h:i a', strtotime($appointment->start)) ?>
                                - <?php echo date('h:i a', strtotime($appointment->end)) ?></td>
                            <td class='d-none'><?php echo $appointment->id ?></td>
                            <td class='d-none'><?php echo $appointment->medinfo ?></td>
                            <td>
                                <a class='patientinfo' href="#" data-id='<?php echo $appointment->patient_id ?>' data-toggle='modal' data-target='#patientmodal'>
                                    <i class="menu-icon fa fa-user"></i> View patient info
                                </a>

                                <?php if ($appointment->medinfo != "Medtech Accepted") { ?>

                                <br />
                                <a class="set" href="<?php echo base_url() . $usertype ?>/add_medical/<?php echo $appointment->id ?>" data-id="<?php echo $appointment->id ?>" data-row="<?php echo $inc ?>"> 
                                    <i class="menu-icon fa fa-check"></i> Accept 
                                </a>

                                <?php } else { echo "<br /> Accepted"; } ?>
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
                        <h5 class="modal-title" id="addeditmodalLabel">Setting medical info</h5>
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
                                    <input value='' class="form-control"  id='patient' readonly/>
                                </div>
                                <div class="form-group" id="doctorgrp">
                                    <label for="medinfo">Medical info</label>
                                    <textarea id="medinfo" name="medinfo" class="form-control" rows='10'></textarea>
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

        jQuery(".set").click(function () {

            jQuery("#addedit_schedule #id").val(jQuery(this).data('id'));
            
            jQuery("#id").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(2)").html());
            jQuery("#medinfo").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(3)").html());
            jQuery("#patient").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(0)").text());

        });

        jQuery(".patientinfo").click(function() {

            var jqxhr = jQuery.ajax( "<?php echo base_url() . $usertype ?>/load_patientinfo/" + jQuery(this).data('id') )
            .done(function( msg ) {
                    jQuery('#patient_info').html(msg);
            })

        });

    </script>