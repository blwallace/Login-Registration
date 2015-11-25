<div class="container">
  <div class="row">
    <div class="col-md-12">
<h2>List of Known Vulnerabilitiy Exploits</h2>
<div><h3>Brute Force Password Reset Question</h3>
<p>The password reset option should have two safeguards to validate the user. The user should be able to answer a security question and the user should be able to verify that he or she has access to the email account used during registration.  However, the application currently does not send emails, so the user only needs to know a login email and the answer to a security question in order to successfully reset a password and take over an account.</p>

<p>Upon closer inspection, a user with malicious intent would notice a POST request in the javascript</p>

<ul>
<li>Right click anywhere on the page</li>
<li>Click 'View Source'</li>
<li>Find src="/assets/js/login.js" and click to navigate to the file</li>
<li>Scroll to the bottom and you'll find the following JQuery POST function</li>
</ul>

<b>
$.post( "/users/answer", { email: $("#emailreset").val(), answer:$("#answerreset").val()})
				  .done(function( data )			 
</b>
<br>

<p>Easy enough. The POST request goes to '/users/reset password' and sends the user email and answer to the reset password question.  Additionally, code from that function gives us a flag if the POST request is successful (below)</p>
<br>
<b>//do this if the answer was correct<br>
if(data == 1)</b>

<p>We now have everything we need to know in order to brute force the system. Suppose you know that your friend has registered with the email 'obama@uchicago.edu'.  You can use your browser, JQuery, and basic Javascript knowledge to brute force an answer.  </p>

<p><a href="/main/brute_force" target="_blank">Click here for an example.</a> To view the javascript for that page, right click and click 'View Source' </p>

<p>That page ran a script to loop through all current car models. Do a search on the page and look for "Loaded: 1". This indicates that we were successfully able to guess the car model. Now we can basically reset Obama's password and take over his account.</p>
</div>
<div>
	<br><br>
<h3>Unsecure Connection: No HTTPS connection</h3>
<p>Every system that requires a username and password should have a secure HTTPS connection and be registered with a Certificate Authority.  This system does not have a secure HTTPS connection, so all the information being sent to the server is in Plaintext.</p>
<p>This leave the user very vulnerable because he or she might be re-using a password.  Another user with malicious intent on the same network might use a program like Wireshark to sniff unencrypted communication over a wireless network.  Upon finding a POST HTTP request, the user can simply parse the data and view the user login </p>
<img src="/assets/img/login.png" width = "750">
<br><br><br>
</div>

<div>

<h3>Front End Javascript Manipulation</h3>
<p>Some password checking rules are run in the client browser using Javascript.  That means that the client has some control over the way these verification rules work.  For example, the user can manipulate the verification rules so he or she does not need to enter a special character or upper case chaacter.  </p>

<p>The example below shows how the user can manipulate javascript and force the system to take a bad input. </p>
<ul>
<li>Right click anywhere on the page</li>
<li>Click 'Inspect Element'</li>
<li>Navigate to 'Sources' and find the 'login.js' file.</li>
<li>You can now manipulate the javascript that controls certain user inputs.  For example, changing the  conditional statement in the image below would allow the system to initially accept a password of length less than 8 characters. However, we can only change the front end rules... in this particular case the web server will also validate the user input</li>
<img src="/assets/img/jquery.png" width = "750">
</ul>



 </div>
</div></div></div>