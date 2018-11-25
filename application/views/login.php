    
    <section id="login-sec" class='main-sec'>
        <h2 class='text-info text-center'>Please enter the following to proceed</h2>

        <form id='login-form' action='login_check?prev=<?php echo current_url() ?>' method='post'>
            <div class='form-group text-center'>
                <label for='username'>Username</label>
                <input id='username' class='form-control form-control-lg' type='text' name='username' required>
            </div>
            
            <div class='form-group text-center'>
                <label for='password'>Password</label>
                <input id='password' class='form-control form-control-lg' type='password' name='password' required>
            </div>
            
            <input id='login-btn' type='submit' class='form-control btn btn-primary' value='Login'>
        </form>
    </section>
