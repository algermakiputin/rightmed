
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

<div class="content mt-3">
    <section class='main-sec'>
        <h1>List of patients </h1>
        <span class="lead" id="filter-indicator"></span>
        <br />
        <div class="row">
          <div class="col-md-2">
            <select id="select-gender" class="form-control form-control-sm">
              <option value="">Select Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="col-md-8 text-center middle-toolbar">
            <button class="btn btn-default btn-sm btn-custom" data-toggle="modal" data-target="#agerange">Filter by Age</button>
            <button class="btn btn-default btn-sm btn-custom" data-toggle="modal" data-target="#addressfilter">Filter by Address</button>
            <button class="btn btn-default btn-sm btn-custom" data-toggle="modal" data-target="#measurementsFilter">Filter by Mesurements</button>
            <button class="btn btn-default btn-sm btn-custom" data-toggle="modal" data-target="#diagnosesFilter">Filter by Diagnoses</button>

          </div>
          <div class="col-md-2">
            <input type="text" name="" class="form-control form-control-sm" placeholder="Search name" id="patient-search">
          </div>
          
        </div>
        <table class="table table-striped myDivToPrint" id="patient_table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>First name</th>
                    <th>Middle name</th>
                    <th>Last name</th>
                    <th>Contact</th> 
                    <th>Email</th>
                    <th class="no-print">Actions</th>
                    <th>Birthdate</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <div id="user" class="d-flex justify-content-center">
        <a class="add btn btn-primary" href="#"  data-toggle="modal" data-target="#addeditmodal"> Add new Patient</a>
        </div>
    </section>
</div> <!-- .content -->
</div>

<div class="modal fade" id="agerange" tabindex="-1" role="dialog" aria-labelledby="agerange" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content text-center">
        
                <div class="modal-header">
                    <h5 class="modal-title" id="addeditmodalLabel">Choose Age Rage</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                     
                    <div class="col-md-12 text-center">
                        <span id="rangeValues">Age: 0 - 150</span>
                        <section class="range-slider">
                            
                            <input value="0" min="0" max="150" step="1" class="slider" type="range" id="age-start">
                            <input value="150" min="0" max="150" step="1" class="slider" type="range" id="age-end">
                        </section>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="filter-age">Confirm</button>
            </div>
        
    </div>
  </div>
</div>

<div class="modal fade" id="diagnosesFilter" tabindex="-1" role="dialog" aria-labelledby="addressfilter" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content text-center">
          <form id="filter-diagnose-form" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="addeditmodalLabel">Enter Diagnoses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class="col-md-12 text-center">

                      <div class="form-group">
                          <input type="text" name="diagnose-filter" placeholder="Enter Diagnoses" id="diagnoses-filter" class="form-control">
                      </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
          </form>
    </div>
  </div>
</div>

<div class="modal fade" id="addressfilter" tabindex="-1" role="dialog" aria-labelledby="addressfilter" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content text-center">
          <form id="filter-address-form" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="addeditmodalLabel">Enter Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class="col-md-12 text-center">

                      <div class="form-group">
                          <input type="text" name="filter-address" placeholder="Enter address" id="filter-address" class="form-control">
                      </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
          </form>
    </div>
  </div>
</div>

<div class="modal fade" id="measurementsFilter" tabindex="-1" role="dialog" aria-labelledby="diagnosesFilter" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content text-center">
          <form id="filter-diagnoses-form" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="addeditmodalLabel">Filter By Measurements</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">

                      <div class="form-group">
                            <span id="weightValues">Weight: 0 - 150</span>
                            <section class="range-slider">
                            
                                <input value="0" min="0" max="300" step="1" class="slider" type="range" id="weight-start">
                                <input value="300" min="0" max="300" step="1" class="slider" type="range" id="weight-end">
                            </section>
                      </div>
                      <div class="form-group">
                            <span id="heightValues">Height: 0 - 150</span>
                            <section class="range-slider">
                            
                                <input value="0" min="0" max="300" step="1" class="slider" type="range" id="height-start">
                                <input value="300" min="0" max="300" step="1" class="slider" type="range" id="height-end">
                            </section>
                      </div>
                      <div class="form-group">
                            <span id="bloodpressureValues">Blood Pressure: 0 - 150</span>
                            <section class="range-slider">
                            
                                <input value="0" min="0" max="300" step="1" class="slider" type="range" id="bloodpressure-start">
                                <input value="300" min="0" max="300" step="1" class="slider" type="range" id="bloodpressure-end">
                            </section>
                      </div>
                      <div class="form-group">
                            <span id="temperatureValues">Temperature: 0 - 150</span>
                            <section class="range-slider">
                            
                                <input value="0" min="0" max="300" step="1" class="slider" type="range" id="temperature-start">
                                <input value="300" min="0" max="300" step="1" class="slider" type="range" id="temperature-end">
                            </section>
                      </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
          </form>
    </div>
  </div>
</div>

<div class="modal fade" id="checkupmodal" tabindex="-1" role="dialog" aria-labelledby="checkupmodal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <form id="checkup_user" action="add_checkup" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addeditmodalLabel">Checking up patient's results</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-md-6">
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
                    </div>
                    <div class="col-md-6">
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
                            <textarea type="text" required class="form-control" id="prevmed" name="prevmed" placeholder="Enter the previous medicine taken by the patient" rows="5"></textarea>
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
    <div class="modal-dialog modal-lg" role="document">
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
                        <div class="col-md-6">
                            <input type="hidden" name="edit-patient-id" id="edit-patient-id">
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
                                
                            </div>
                            <div class="form-group">
                                <label for="fname">Middle Name</label>
                                <input type="text" class="form-control" id="mname" name="mname" placeholder="Enter the middle name of the new patient" required>
                            </div>
                            <div class="form-group">
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

                        </div>
                        <div class="col-md-6">
                            <input type="text" class="d-none form-control" id="id2" name="id">
                            
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
                    <p>Are you sure you want to delete that patient?</p>
                    <input type="text" class="d-none form-control" id="id-remove" name="id-remove">
                    <p id="confirm"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button id="submit" type="submit" class="btn btn-danger">Confirm</button>
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
 
</script>