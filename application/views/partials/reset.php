
<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <h4><a href="/">Home</a> > <a href="/users/reset">Password Reset</a></h4>
            <h5>
<!-- // This section is used mainly to display errors during the registration process -->
              <?php 
        echo $this->session->flashdata('login_error');
        echo $this->session->flashdata('registration_error');
         ?>
         <div id="errors"></div>
      </h5>
    	<h2>Password Reset</h2>

      <input type='text' name='user_name' class="form-control" placeholder="Name" value = "name" id = "name" style="display:none;">
      <input type='text' name='user_name' class="form-control" placeholder="Name" value = "name" id = "alias" style="display:none;">
      <form action='/users/question' method='post' id="loginreset">
        <input type='text' name='email' class="form-control" placeholder="Login Email" id="emailreset">

    
        <!-- <input type='date' name='dob' class="form-control"> -->
        <button type="submit" class="btn btn-success">Enter Login email</button>
      </form>
      
      <form id = "questionForm" style="display:none;">
          <h5 id = "resetQuestion"></h5>
          <input type='text' id='answerreset' class="form-control" placeholder="Answer">
          <button type="submit" class="btn btn-success">Submit</button>
     </form> 

     <h5 id="failure1" style="display:none;">The user gets this message if the password reset was unsuccessful.<br><br>  This means either his login email was invalid or his answer was incorrect</h5>
     <h5 id="emailMessage1" style="display:none;">Please look in your inbox for a link to reset your password.  <br><br>However, I haven't set up an email system, so you get to reset your password NOW =)</h5>
     <h5 id="failure2" style="display:none;">Nice Job, you fucked up =) Make sure your passwords match</h5>
    <h5 id="successreset" style="display:none;">Password reset. <a href="/">Try logging in again</a></h5>
    <form id = "answerForm" style="display:none;">
        <input type='password' name='password' class="form-control" placeholder="Password" id="password">
        <input type='password' name='confirm' class="form-control" placeholder="Confirm Password" id ="confirm">
          <button type="submit" class="btn btn-success">Submit</button>
     </form>      
    <div class="col-md-3"></div>
  </div>

</body>
</html>      
