<div class="container">
  <div class="row">
  	<div class="col-md-2"></div>
    <div class="col-md-8">
    	<h2><u>Takeaways</u></h2>
    	<p>My experience developing software is that things always end up being harder than originally expected.  Trying to build a secure login and registration system was no exception</p>

    	<p>While spec'ing out my app, I had a list of features that I thought made sense for a login and registration system.  For example, I had safeguards to ensure that the user did not enter a commonly used password.  I had password complexity requirements and a question/answer format to a retrieve password.  Most importantly, or so I thought, I had encrypted passwords in the database.</p>

    	<p>However, just as I finished developing my application, I had realized that my system had so many more vulnerabilities than I originally expected.  For example, I realized that many of my rules were being applied on the front end using javascript (ie the client browser).  This was a problem because the client has a lot of control over how javascript works in their own browser.  Additionally, the client could even turn OFF javascript, leaving my controls in the dark.</p>

    	<p>Fortunately, some of the exploits I found could be resolved easily.  In the prior example, I simply moved some of the controls to the back end.  So, if the user decides he doesn't want to enter 8 characters for a password, they can modify the javascript rules.  However, the web server would still catch the problem and not allow the user to follow through with their devious plan.</p>

    	<p>However, some other issues could not be resolved so easily.  For example, I hadn't originally planned to provide a secure connection (HTTPS) to my site.  I found the process of making my site secure incredibly difficult and surprisingly expensive.  But the fact remains... all the work I did to secure my site were in vain simply because my communications were not encrypted.</p>

    	<p>I scoped my application to be secure, however, I didn't scope the time or work it would take to create a secure server.  My web app could have been water tight, but the server was leaking and the ship was sinking fast.  However, I think my experience here demonstrates why creating a secure application is so difficult.  Security isn't just about an application or data encryption.  It needs to  encompass all compenents of a system (application, presentation, session, transport, network, data link, physical).</p>

    </div>
    <div class="col-md-2"></div>


 
</div></div>