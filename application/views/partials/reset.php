
<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
            <h5>
<!-- // This section is used mainly to display errors during the registration process -->
              <?php 
        echo $this->session->flashdata('login_error');
        echo $this->session->flashdata('registration_error');
         ?>
         <div id="errors"></div>
      </h5>
    	<h2>Password Reset</h2>
      <form action='/users/question' method='post' id="registration">
        <input type='text' name='email' class="form-control" placeholder="Email" value="Test@gmail.com" id="emailreset">
        <input type='password' name='password' class="form-control" placeholder="Password">
        <input type='password' name='confirm' class="form-control" placeholder="Confirm Password">
        <!-- <input type='date' name='dob' class="form-control"> -->
        <button type="submit" class="btn btn-success">Reset Password</button>
      </form>
    <div class="col-md-3"></div>
  </div>

</body>
</html>      
