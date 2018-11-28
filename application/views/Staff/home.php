
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
                <h1>List of users</h1>

                <table id="reservations" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Type of User</th>
                            <th>First name</th>
                            <th>Middle name</th>
                            <th>Last name</th>
                            <th>Contact</th> 
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $inc = 1;
                            foreach ($users as $user): 
                        ?>
                        <tr>
                            <td><?php echo $user->username ?></td>
                            <td><?php echo $user->usertype ?></td>
                            <td><?php echo ucfirst($user->fname) ?></td>
                            <td><?php echo ucfirst($user->mname) ?></td>
                            <td><?php echo ucfirst($user->lname) ?></td>
                            <td><?php echo $user->contact ?></td>
                            <td><?php echo $user->email ?></td>
                            <td class='d-none'><?php echo $user->password ?></td>
                            <td class='d-none'><?php echo $user->birthdate ?></td>
							<td class='d-none'><?php echo $user->age ?></td>
                            <td class='d-none'><?php echo $user->address ?></td>
                            <td>
                                <a class="edit" href="#" data-row="<?php echo $inc ?>" data-id="<?php echo $user->id ?>" data-toggle="modal" data-target="#addeditmodal"> 
                                    <i class="menu-icon fa fa-edit"></i> Edit 
                                </a>

                                <br />
                                <a class="remove" href="#" data-row="<?php echo $inc ?>" data-id="<?php echo $user->id ?>" data-toggle="modal" data-target="#removemodal"> 
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

                <div id="user" class="d-flex justify-content-center">
                    <a href="#" class="btn btn-primary add" data-toggle="modal" data-target="#addeditmodal">Add new user</a>
                </div>
            </section>
        </div> <!-- .content -->
    </div>

    <div class="modal fade" id="addeditmodal" tabindex="-1" role="dialog" aria-labelledby="addeditmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addedit_user" action="add_user" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addeditmodalLabel">New user</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id='resproc' class="row">
                            <div class="col">
                                <input type="text" class="d-none form-control" id="id" name="id">
                                <div class="form-group">
                                    <label for="usern">Username</label>
                                    <input type="text" class="form-control" id="usern" name="usern" placeholder="Enter the username of the new user">
                                </div>
                                <div class="form-group">
                                    <label for="passw">Password</label>
                                    <input type="password" class="form-control" id="passw" name="passw" placeholder="Enter the password of the new user">
                                </div>
                                <div class="form-group">
                                    <label for="passw">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_passw" name="confirm_passw" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <label for="usertype">Type of User</label>
                                    <select id="usertype" name="usertype" class="form-control">
                                        <option selected>Doctor</option>
                                        <option>Medtech</option>
                                        <option>Staff</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter the first name of the new user">

                                      <label for="fname">Middle Name</label>
                                      <input type="text" class="form-control" id="mname" name="mname" placeholder="Enter the middle name of the new user">


                                        <label for="lname">Last Name</label>
                                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter the last name of the new user">
                                </div>
                                <div class="form-group">
                                    <label for="contact">Contact Number</label>
                                    <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter the contact number of the new user">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter the email address of the new user">
                                </div>

                                <div class="form-group">
                                    <label for="birthdate">Birth Date</label>
                                    <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Enter the birth date of the new user">
                                </div>
								
								  <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="text" class="form-control" id="age" name="age" placeholder="Enter the age of the new user">
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter the address of the new user">
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
                <form id="remove_user" action="<?php echo base_url() . $usertype ?>/remove_user" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="removemodalLabel">Remove user</h5>
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
            jQuery("#addeditmodal .modal-title").html("Add user");
            jQuery("#addedit_user").attr("action", "<?php echo base_url() . $usertype ?>/add_user");
      jQuery("#usern").val('');
      jQuery("#usertype").val('Doctor');
      jQuery("#fname").val('');
      jQuery("#mname").val('');
      jQuery("#lname").val('');
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
      jQuery("#addedit_user").attr("action", "<?php echo base_url() . $usertype ?>/edit_user");
      jQuery("#id").val(jQuery(this).data('id'));
      jQuery("#usern").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(0)").html());
      jQuery("#usertype").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(1)").html());
      jQuery("#fname").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(2)").html());
      jQuery("#mname").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(3)").html());
      jQuery("#lname").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(4)").html());
      jQuery("#contact").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(5)").html());
      jQuery("#email").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(6)").html());
      jQuery("#passw").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(7)").html());
      jQuery("#birthdate").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(8)").html());
	  jQuery("#age").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(9)").html());
      jQuery("#address").val(jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(10)").html());
      jQuery("#submit").html("Update");
      });

      jQuery(".remove").click(function () {
      jQuery("#id2").val(jQuery(this).data('id'));
      jQuery("#confirm").html("Are you sure you want to remove " + jQuery("tr:eq(" + jQuery(this).data('row') +") td:eq(0)").html() + "?");
      });
    </script>