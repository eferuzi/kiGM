<?php 

require_once ('dbcomponents.php');

session_start();

function loginform() {
?>
<form method="post" action="login.php" id="loginform">
    <fieldset>
        <legend>
            Login
        </legend>
        <label id="lb_username" for="username">
            Username
        </label>
        <input type="text" name="username" id="username" />
        <label id="lb_secretword" for="secretword">
            Password
        </label>
        <input type="password" name="secretword" id="secretword" /><input type="submit" name="login" id="login" value="Login"/>
    </fieldset>
</form>
<?php 
}


function configform() {
	//print the error message
	if(isset($_SESSION['config_error'])){
?>
		<br />Error:<div class="error"><?php echo $_SESSION['config_error']['email']; ?> </div>
<?php
		unset($_SESSION['config_error']);
		
	}
?>
<form method="post" action="actions/config.php" id="configform">
    <fieldset>
        <legend>
            Configurations
        </legend>
		<label id="lb_groupemail" for="groupemail">
            Translators Group Email
        </label>
		<input type="text" name="groupemail" id="groupemail" />
		<label id="lb_langname" for="langname">
            Language Name
        </label>
        <?php languagesCombo(); ?>				
		<input type="submit" name="configure" id="configure" value="Configure"/>
    </fieldset>
</form>
<?php
}

function createaccountform() {
?>
<form method="post" action="actions/createaccount.php" id="configform">
    <fieldset>
        <legend>
            Account Details
        </legend>
		<label id="lb_groupemail" for="groupemail">
            Full name
        </label>
		<input type="text" name="groupemail" id="groupemail" />
		<label id="lb_groupemail" for="groupemail">
            Email Address
        </label>
		<input type="text" name="groupemail" id="groupemail" />
		<br /><br />
		<label id="lb_langname" for="langname">
            Username
        </label>
		<input type="text" name="groupemail" id="groupemail" />
		
		<label id="lb_langname" for="langname">
            Password
        </label>
		<input type="text" name="groupemail" id="groupemail" />
		
		<label id="lb_langname" for="langname">
            Confirm Password
        </label>
		<input type="text" name="groupemail" id="groupemail" />
		<input type="submit" name="create" id="create" value="Create"/>
    </fieldset>
</form>
<?php 
}

?>
