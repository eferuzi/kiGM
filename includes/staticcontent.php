<?php
	function kigmintro() {
?>
	<h1><span class="blue">k</span><span class="red">i</span><span class="black">GM</span></h1>
	<p>
		To explain <span class="blue">k</span><span class="red">i</span><span class="black">GM</span> one has to start with 
		<a href="http://www.it46.se/glossmaster/">Glossmaster</a>. <a href="http://www.it46.se/glossmaster/">Glossmaster</a> is the fabulous 
		multi-lingual terminology tool developed for ANLoc, the African Network for Localization. 
		<span class="blue">k</span><span class="red">i</span><span class="black">GM</span> is a very lightweght version GlossMaster with an aim of allowing
		user with low or not internet connection to work and sycn data with Glossmaster periodically. Glossmaster.
		<span class="blue">k</span><span class="red">i</span><span class="black">GM</span> has a verys small subset of the functionality that Glossmaster has.
	</p>
<?php 		
	}
	
	function newAccount(){
?>
	 <fieldset>
    	<legend>Help</legend>
		<div class="center"><a href="#">Forgot Password</a> | <a href="createaccount.php" title="Create Account">Create Account</a></div>
	</fieldset>
<?php		
	}
	
	
	function configInfo(){
?>
	 <fieldset>
    	<legend>Configuration Info</legend>
		<ul>
			<li><strong>Language Name</strong>. This is the language you are translating to from Englisj </li>
			<li><strong>Group Mail</strong>. The email address that will be used to communicate to the rest of the team. </li>
		</ul>
	</fieldset>
<?php		
	}
	
	function createAccountInfo(){
?>
	 <fieldset>
    	<legend>Createa Account Info</legend>
		<p>
			Before you can start working on <span class="blue">k</span><span class="red">i</span><span class="black">GM</span> you need 
			to have an account. To create an account please fill in the form and an account will be created for you.
		</p>
		<br /><br />
		<p>
			<span class="red">Error:</span> <strong>Account Already Exist</strong><br />
			This means that someone has registered an account with your email address or username. Use the <a href="passwordrecovery.php" title="Password Recovery">password 
			recovery</a> feature to get your password.
		</p>
	</fieldset>
	
<?php		
	}
?>