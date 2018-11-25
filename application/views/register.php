    
    <section id="login-sec" class='main-sec'>
        <h2 class='text-info text-center'>Please enter the following to proceed</h2>

        <form id='login-form' action='register_check?prev=<?php echo current_url() ?>' method='post'>
            <div class='form-group text-center'>
                <label for='username'>Username</label>
                <input id='username' class='form-control form-control-lg' type='text' name='username' required>
            </div>
            
            <div class='form-group text-center'>
                <label for='password'>Password</label>
                <input id='password' class='form-control form-control-lg' type='password' name='password' required>
            </div>

            <div class='form-group text-center'>
                <label for="fname">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" required>

                  <label for="fname">Middle Name</label>
                  <input type="text" class="form-control" id="mname" name="mname" required>

                <label for="lname">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" required>
            </div>

            <div class='form-group text-center'>
                <label for="gender">Gender</label>
                <select id="gender" name="gender" class="form-control">
                    <option selected>Male</option>
                    <option>Female</option>
                </select>
            </div>

            <div class='form-group text-center'>
                <label for="birthdate">Birth Date</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate">
            </div>
			
			 <div class='form-group text-center'>
                <label for="age">Age</label>
                <input type="age" class="form-control" id="age" name="age">
            </div>


            <div class='form-group text-center'>
                <label for="marital_status">Marital Status</label>
                <select id="marital_status" name="marital_status" class="form-control">
                    <option selected>Single</option>
                    <option>Married</option>
                    <option>Widow</option>
                </select>
            </div>

            <div class='form-group text-center'>
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" required >
            </div>

            <div class='form-group text-center'>
                <label for="contact">Contact Number</label>
                <input type="text" class="form-control" id="contact" name="contact">
            </div>

            <div class='form-group text-center'>
                <label for="email">Email Address</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>
            
            <input id='login-btn' type='submit' class='form-control btn btn-primary' value='Register'>
        </form>
    </section>
