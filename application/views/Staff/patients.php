
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
                            <li class="active">Patients</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3 myDivToPrint">
            <section class='main-sec'>
                <h1>List of patients</h1>

                <br />
                <form id="checkup_user" class='dontprint form-inline' action="<?php echo current_url() ?>" method="get">
                    <input type="text" class="form-control" id="search" name="search" placeholder="Enter the name to search" value="<?php echo $this->input->get('search') ?>">
                    &nbsp;<input type="submit" class="btn btn-secondary" value="Search">
                    &nbsp;<a href="#" id="print" class="btn btn-info" onclick="window.print()">Print</a>
                </form>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>First name</th>
                            <th>Middle name</th>
                            <th>Last name</th>
                            <th>Contact</th> 
                            <th>Email</th>
                            <th class='dontprint'></th>
                            <th class='d-none print'>Gender</th>
                            <th class='d-none print'>Marital Status</th>
                            <th class='d-none print'>Birthdate</th>
							<th class='d-none print'>Age</th>
                            <th class='d-none print'>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $inc = 1;
                            foreach ($patients as $patient): 
                        ?>
                        <tr>
                            <td><?php echo $patient->username ?></td>
                            <td><?php echo ucfirst($patient->fname) ?></td>
                            <td><?php echo ucfirst($patient->mname) ?></td>
                            <td><?php echo ucfirst($patient->lname) ?></td>
                            <td><?php echo $patient->contact ?></td>
                            <td><?php echo $patient->email ?></td>
                            <td class='print d-none'><?php echo $patient->gender ?></td>
                            <td class='print d-none'><?php echo $patient->marital_status ?></td>
                            <td class='print d-none'><?php echo $patient->birthdate ?></td>
                            <td class='print d-none'><?php echo $patient->age ?></td>
							<td class='d-none'><?php echo $patient->password ?></td>
                            <td class='print d-none'><?php echo $patient->address ?></td>
                            <td class='d-none'><?php echo $patient->height ?></td>
                            <td class='d-none'><?php echo $patient->weight ?></td>
                            <td class='d-none'><?php echo $patient->temperature ?></td>
                            <td class='d-none'><?php echo $patient->blood_pressure ?></td>
                            <td class='d-none'><?php echo $patient->symptoms ?></td>
                            <td class='d-none'><?php echo $patient->prevmed ?></td>
                            <td class='dontprint'>
                                <a class="checkup" href="#" data-row="<?php echo $inc ?>" data-id="<?php echo $patient->id ?>" data-toggle="modal" data-target="#checkupmodal"> 
                                    <i class="menu-icon fa fa-search"></i> Check up
                                </a>

                                <br />
                                <a class="edit" href="#" data-row="<?php echo $inc ?>" data-id="<?php echo $patient->id ?>" data-toggle="modal" data-target="#addeditmodal"> 
                                    <i class="menu-icon fa fa-edit"></i> Edit 
                                </a>

                                <br />
                                <a class="remove" href="#" data-row="<?php echo $inc ?>" data-id="<?php echo $patient->id ?>" data-toggle="modal" data-target="#removemodal"> 
                                    <i class="menu-icon fa fa-minus"></i> Remove 
                                </a>
                            </td>
                        </tr>
                        <?php 
                            $inc++;
                            endforeach; 
                        ?>
                    </tbody>
                </table>

                <div id="user" class="dontprint d-flex justify-content-center">
                    <a href="#" class="btn btn-primary add" data-toggle="modal" data-target="#addeditmodal">Add new patient</a>
                </div>
            </section>
        </div> <!-- .content -->
    </div>

    <div class="modal fade" id="checkupmodal" tabindex="-1" role="dialog" aria-labelledby="addeditmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="checkup_user" action="add_checkup" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addeditmodalLabel">Checking up patient's results</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="d-none form-control" id="id" name="id">
                                <div class="form-group">
                                  <label for="patient">Patient</label>
                                    <input type="text" id="patient" name="patient" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="height">Height</label>
                                    <input type="text" required class="form-control" id="height" name="height" placeholder="Enter the height of the patient">
                                </div>
                                <div class="form-group">
                                    <label for="height">Weight</label>
                                    <input type="text" required class="form-control" id="weight" name="weight" placeholder="Enter the weight of the patient">
                                </div>

                                <div class="form-group">
                                    <label for="temper">Temperature</label>
                                    <input type="text" required class="form-control" id="temper" name="temper" placeholder="Enter the temperature of the patient">
                                </div>

                                <div class="form-group">
                                    <label for="bloodpres">Blood Pressure</label>
                                    <input type="text" required class="form-control" id="bloodpres" name="bloodpres" placeholder="Enter the blood pressure of the patient">
                                </div>

                                  <div class="form-group">
                                    <label for="bloodpres">Symptoms</label>
                                    <input type="text" required="" class="form-control" id="symptoms" name="symptoms" placeholder="Enter the complain of the patient">
                                </div>

                                <div class="form-group">
                                    <label for="prevmed">Patient History</label>
                                    <input type="text" required class="form-control" id="prevmed" name="prevmed" placeholder="Enter the previous medicine taken by the patient">
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

    <div class="modal fade" id="addeditmodal" tabindex="-1" role="dialog" aria-labelledby="addeditmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addedit_user" action="add_user" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addeditmodalLabel">New patient</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="d-none form-control" id="id2" name="id">
                                <div class="form-group">
                                    <label for="usern">Username</label>
                                    <input type="text" class="form-control" id="usern" name="usern" placeholder="Enter the username of the new patient" required>
                                </div>
                                <div class="form-group">
                                    <label for="passw">Password</label>
                                    <input type="password" class="form-control" id="passw" name="passw" placeholder="Enter the password of the new patient" required>
                                </div>
                                <div class="form-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter the first name of the new patient" required>

                                      <label for="fname">Middle Name</label>
                                      <input type="text" class="form-control" id="mname" name="mname" placeholder="Enter the middle name of the new patient" required>
                                    <label for="lname">Last Name</label>
                                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter the last name of the new patient" required>
                                </div>

                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select id="gender" name="gender" class="form-control">
                                        <option selected>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="birthdate">Birth Date</label>
                                    <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Enter the birth date of the new patient">
                                </div>
								
								
                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="text" class="form-control" id="age" name="age" placeholder="Enter the age of the new patient">
                                </div>

                                <div class="form-group">
                                    <label for="marital_status">Marital Status</label>
                                    <select id="marital_status" name="marital_status" class="form-control">
                                        <option selected>Single</option>
                                        <option>Widow</option>
                                        <option>Married</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter the address of the new patient" required>
                                </div>

                                <div class="form-group">
                                    <label for="contact">Contact Number</label>
                                    <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter the contact number of the new patient">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter the email address of the new patient">
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
                <form id="remove_user" action="<?php echo base_url() . $usertype?>/remove_patient" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="removemodalLabel">Remove patient</h5>
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
      jQuery(".checkup").click(function() {
      jQuery("#id").val(jQuery(this).data('id'));

      jQuery("#patient").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(3)").html() + ", " + jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(1)").html() + " " + jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(2)").html() );
      jQuery("#height").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(12)").html());
      jQuery("#weight").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(13)").html());
      jQuery("#temper").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(14)").html());
      jQuery("#bloodpres").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(15)").html());
      jQuery("#symptoms").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(16)").html());
      jQuery("#prevmed").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(17)").html());
      });

      jQuery(".add").click(function() {
      jQuery("#addeditmodal .modal-title").html("Add user");
      jQuery("#addedit_user").attr("action", "<?php echo base_url() . $usertype ?>/add_patient");
            jQuery("#usern").val('');
            jQuery("#fname").val('');
            jQuery("#mname").val('');
            jQuery("#lname").val('');
            jQuery("#gender").val('Male');
            jQuery("#marital_status").val('');
            jQuery("#contact").val('');
            jQuery("#email").val('');
            jQuery("#passw").val('');
            jQuery("#birthdate").val('');
			jQuery("#age").val('');
            jQuery("#address").val('');
            jQuery("#submit").html("Add");
      });

      jQuery(".edit").click(function () {
      jQuery("#addeditmodal .modal-title").html("Edit user");
      jQuery("#addedit_user").attr("action", "<?php echo base_url() . $usertype ?>/edit_patient");
      jQuery("#id2").val(jQuery(this).data('id'));
      jQuery("#usern").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(0)").html());
      jQuery("#fname").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(1)").html());
      jQuery("#mname").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(2)").html());
      jQuery("#lname").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(3)").html());
      jQuery("#contact").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(4)").html());
      jQuery("#email").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(5)").html());
      jQuery("#gender").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(6)").html());
      jQuery("#marital_status").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(7)").html());
      jQuery("#birthdate").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(8)").html());
	  jQuery("#age").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(9)").html());
	  jQuery("#passw").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(10)").html());
	  jQuery("#address").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(11)").html());
      jQuery("#submit").html("Update");
      });

      jQuery(".remove").click(function () {
      jQuery("#id2").val(jQuery(this).data('id'));
      jQuery("#confirm").html("Are you sure you want to remove " + jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(0)").html() + "?");
      });
    </script>