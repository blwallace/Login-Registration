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

      <h2>Login and Registration System</h2>
      <h5>Welcome to my login and registration system.  Please create an account =)</h5>
      <h5></h5><a href="/main/features">View Features</a></h5></h5>
      <h5></h5><a href="/main/vulnerabilities">View Known Vulnerabilities</a></h5></h5>
      <h5></h5><a href="/main/feedback">View My Feedback</a></h5></h5>      


      <h3>Login</h3>
      <form action='/users/login' method='post'>
        <input type="text" placeholder="Email" name = 'email' class="form-control">
        <input type="password" placeholder="Password" name = 'password' class="form-control">
      <button type="submit" class="btn btn-success">Sign in</button>
      </form>
      <a href = "/users/reset">Forgot Password</a>

      <h4>Warning! Data is transferred over an unsecure connection.  Please use a completely unique password and dummy email address</h4>

      <h3>Registration</h3>
      <form action='/users/add' method='post' id="registration">
        <input type='text' name='email' class="form-control" placeholder="Email">
        <input type='text' name='user_name' class="form-control" placeholder="Name" id = "name">
        <input type='text' name='alias' class="form-control" placeholder="Alias" id = "alias">
        <input type='password' name='password' class="form-control" placeholder="Password" id="password">
        <input type='password' name='confirm' class="form-control" placeholder="Confirm Password">
        <select name="question" class="form-control" placeholder="Select Question">
          <option value="" disabled selected>Select a Question</option>
          <option value="What was the model of your first car?">What was the model of your first car?</option>
          <option value="What city where you born?">What city where you born?</option>
          <option value="What is your greatest fear?">What is your greatest fear?</option>
        </select>
        <input type='text' name='answer' class="form-control" placeholder="Answer">
        <button type="submit" class="btn btn-success" disabled id="regbut">Register</button>
      </form>


    </div>
    <div class="col-md-3"></div>
  </div>

</body>
</html>      
