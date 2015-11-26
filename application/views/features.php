<div class="container">
  <div class="row">
    
    <div class="col-md-12">
		<h2><u>Goals</h2></u>
		<p>The goal of my project is to create a web based user login and registration system with accompanying  documentation.  The system will implement best practices, such as minimum complexity requirements, expiration intervals, and keywords that cannot be used for passwords. Additionally, the system needs to balance usability and security. </p>
		<h2><u>Features:</h2></u> 

		<h3><u>Minimum Password Complexity Requirements:</h3></u>

		<h4>TL;DR</h4><p> System requires a minimum of an 8 character password using at least 1 upper case, 1 lower case, 1 number, and 1 special character.</p>

		<h4>Summary</h4>
		<p>- Minimum Length: Passwords should be, at a minimum, 8 characters long.  The minimum character requirement helps prevent against a brute force attack.  The amount of time a successful brute force attack should take increases exponentially to the length of the password.  A helpful guide related to this can be found <a href="http://www.lockdown.co.uk/?pg=combi&s=articles"> here</a>.</p>

		<p>- Uppercase / Lowercase, Alphanumberic, & Special Character Requirements: Like the minimum length requirement, adding this restriction will help prevent against a brute force attack.  According to the link above, a standard 8 character password using 26 upper and lower case characters will take a fast, dual core PC around 350 minutes.  However, it would take that same PC 23 years to crack a password that included 96 different characters (Uppercase / Lowercase, Alphanumberic, & Special Character Requirements).  </p>

		<h4>Technical Overview </h4>

		<p>- The webserver will receive the password and apply verification rules</p>
		<p>- The workhorse of this feature can be found in 'application/MY_Form_validation'.  It is an extention of the standard Codeigniter 'Form_validation' library.  </p>
		<p>-The call to this class can be found in 'applicaiton/controllers/users.php'.</p>

		

		<h3><u>List of forbidden words</h3></u>

		<h4>TL;DR</h4><p> The user will be forbidden to use a password that contains words from a predefined list. The user also cannot use his or her name or alias as part of a password</p>

		<h4>Summary</h4>
		<p>- "The Forbidden" List: Users will be inclined to use simple and easy to remember passwords, like their name.  However, simple and easy to remember passwords are weak and are especially vulnerable to a brute force attack.  Additionally, certain phrases for particular industries are more prevelant... ie football for a company that manufactures footballs.    The system will prompt the user that he or she selects a password that contains a phrase in the forbidden list.</p>

		<h4>Technical Overview</h4>
		<p>This feature is implimented on the client side.  The actual logic is javascript that runs in the client browser.  With that being said, the implimentation of this feature is vulnerable because the user can modify or turn off javascript.  Once javascript is turned off, the user can enter a passphrase of their choosing.  However, I do believe that the risk associated with this weakness is minimal.  </p>

		<p>Credit: Part of the list was obtained from http://www.whatsmypass.com/the-top-500-worst-passwords-of-all-time</p>

		

		<h3><u>Expiration intervals</h3></u>

		<h4>TL;DR</h4><p> Users will be prompted to change their password if last their password update was greater than 60 days.  </p>

		<h4>Summary</h4><p> I had originally planned to force the user to change his or her password after 60 days.  However, this is inconvenient and the user might actually be more likely to forget his or her password in the future.  My goal for the system was to make it usable, so I decided to simply prompt the user to change his or her password every time they log in if last their password update was greater than 60 days. </p>

		<p>Users are prompted with the message</p>
		<p>"Last password change was >60 days ago. <a href = '/users/reset'>Please consider resetting your password </a>"</p>

		<h4>Technical Overview</h4><p>: The 'users' table in the database records the last time a user updates his or her password.</p>

		<p>You can view an outdated password by using the following credentials</p>

		<p>login: tony@stark.com</p>
		<p>password: Blahblah1!</p>

		

		<h3><u>Database Password Encryption</h3></u>

		<h4>TL;DR</h4>
		<p> User passwords are encrypted using the default encryption provided by PHP.</p>

		<h4>Summary</h4>
		<p>All use passwords are hashed using PHP's default hashing function.  The default algorithm used in this function is Blowfish. According to wikipedia (sorry about that reference) no effective cryptanalysis of it has been found to date.  In addition, a salt is added to the password to decrease the liklihood of a brute force attack.</p>
		<p>Passwords are saved in the 'users' table and the 'account_history' table.  The passwords in both of these tables are hashed.</p>
		<img src="/assets/img/password.png" width="400">
		

		<h3><u>Password reset options</h3></u>
		<h4>TL;DR</h4> <p>Users must enter their login email and security question correctly to receive email with a link to reset their password.  Email system is not working, so users who answer the security question correctly can just reset their password</p>

		<h4>Summary</h4> <p>The system is built for the following use cases</p>

		<p><b>Case 1</b>: User Provides Valid Email Address And Correct Answer</p>
		<p>User receives email with a link to reset their password. In reality, the email system isn't working, so the user can simply reset their password.</p>

		<p><b>Case 2</b>: User Provides Valid Email and Incorrect Answer</p>
		<p>User is prompted with a message to check their email.  Email notify user that an attempt has been made to reset their password and to try again. </p>

		<p><b>Case 3</b>: User provides Invalid Email</p>
		<p>User is still given question to answer and is told to check their email.  In reality, no email has been sent</p>

		<p><b>IMPORTANT NOTE</b>: This functionality is only partially function.  Without email, we cannot validate that the user actually has access to his login email. Therefore, this feature is vulnerable because the user can simply guess the answer to the question and be granted the ability to reset the password.</p>


		<h4>Technical Overview</h4>
		<p>The user password information is stored in the database.  Javascript on the front end will guide the user through the password reset options.  Additionally, the javascript will determine which is the correct question for the user to answer.</p>
		<p>After the user submits his or her email and answer, the web server will validate the user inputs.  If everything is correct, then the password is reset and the database is updated.</p>


		

		<h3><u>User password reset options with question/answer format</h3></u>

		<h4>TL;DR</h4> <p>The user is required to answer a question when he or she creates an account.  This will be used when the user attempts to reset his or her password.</p>

		<h4>Summary</h4> <p>The user is given the option of three questions to answer when he or she creates an account.  In an ideal system, the user would also have the ability to change his or her question/answer AND answer additional questions.</p>

		<h4>Technical Overview</h4>
		<p>The question and answer are stored in the 'users' table in the database.  I decided to keep the answer  unencrypted so the system can be more usable.  For example, if the user can't remember his or her password, then they can potentially call into customer support.  The support team can then view the question and answer  and determine if the user is close the answer or has a typo.</p>


		

		<h3><u>Limit failed login attempts</h3></u>

		<h4>TL;DR</h4> <p>Users have 5 attempts to enter a correct password.  If they are not successful, they need to reset their password</p>

		<h4>Summary</h4>
		<p>- Each user will be restricted to 5 unsuccessful login attempts.  The purpose of this feature helps to prevent against brute force attacks.  After the 5 failures, the password changes to a random hashed password and the user is directed to the password reset landing page.  </p>

		<p>- Note for later implimentation: Email notifications are not currently working.  However, the user should receive an email when his or her account has 5 or more unsuccessful login attempts.</p>

		<h4>Technical Overview</h4>
		<p>All login attempts are saved in the database table 'logins'.  This table saves the time of the attempted login, the account the user is attempting to access, and the IP address of the user attempting to access the account.  </p>


		


		<h3><u>Password history feature</h3></u>
		<h4>TL;DR</h4> <p>Users cannot reset their password to a password they originally used</p>

		<h4>Technical Overview</h4><p> Each user password is hashed and stored in the 'account_history' table.  When a user attempts to reset his or her password, the web server pulls all the users previous passwords and checks to see if there are any duplicates.  If we establish that there are no duplicates, the user can then finish resetting his or her password.</p>


		

		<h3><u>SQL injection preventions</h3></u>

		<h4>TL;DR</h4> <p>Applicatoin uses default CodeIgniter SQL injection prevention functions.</p>

		<h4>Technical Overview</h4><p>  CodeIgniter has 2 features that help prevent against a SQL injection</p>
		<p>1) Escapes the variables whenever I query the database using $this->db->query</p>
		<p>2) Binds the inputs to variables, which are then used to query.</p>


	</div>
	</div>		
</div>	