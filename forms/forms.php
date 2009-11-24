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
	if(isset($_SESSION['result'])){
		
		echo "<br />Error:<div class='error'><ul>";
		foreach($_SESSION['result'] as $key => $value){
			if($value[0]){
				${$key}=$value[1];
			}else{
				${$key}="";
				echo "<li>{$value[1]}</li>";
			}
		}
		echo "<ul></div>";
	}
?>
<form method="post" action="actions/createaccount.php" id="configform">
    <fieldset>
        <legend>
            Account Details
        </legend>
		<label id="lb_fullname" for="fullname">
            Full name
        </label>
		<input type="text" name="fullname" id="fullname" value="<?php echo $fullname; ?>" />
		<label id="lb_email" for="email">
            Email Address
        </label>
		<input type="text" name="email" id="email" value="<?php echo $email; ?>"/>
		<br /><br />
		<label id="lb_username" for="username">
            Username
        </label>
		<input type="text" name="username" id="username" value="<?php echo $username; ?>" />
		
		<label id="lb_password" for="password">
            Password
        </label>
		<input type="password" name="password" id="password" value="<?php echo $password; ?>" />
		
		<label id="lb_langname" for="langname">
            Confirm Password
        </label>
		<input type="password" name="repassword" id="repassword" value="<?php echo $password; ?>" />
		<input type="submit" name="create" id="create" value="Create"/>
    </fieldset>
</form>
<?php
	unset($_SESSION['result']);
}

?>
