<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['unique_id'])){
    header("location: users.php");
    exit();
}
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>TaskRabbit</header>
      <form id="signupForm" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text" style="display: none;"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter new password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field input">
          <label>Confirm Password</label>
          <input type="password" name="cpassword" placeholder="Confirm password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field input">
          <label>User Type</label>
          <select name="user_type" id="user_type" required>
            <option value="">Select User Type</option>
            <option value="user">I need a tasker</option>
            <option value="tasker">I am a tasker</option>
          </select>
        </div>
        <div id="tasker_fields" style="display: none;">
          <div class="field input">
            <label>Profession</label>
            <select name="profession" id="profession" aria-label="Select your profession">
              <option value="">Select Profession</option>
              <option value="Carpenter">Carpenter</option>
              <option value="Plumber">Plumber</option>
              <option value="Electrician">Electrician</option>
              <option value="Painter">Painter</option>
              <option value="Handyman">Handyman</option>
            </select>
          </div>
          <div class="field input">
            <label>Bio</label>
            <textarea name="bio" placeholder="Tell us about yourself" aria-required="true"></textarea>
          </div>
          <div class="field input">
            <label>Skills</label>
            <input type="text" name="skills" placeholder="Enter your skills (comma separated)" aria-required="true">
          </div>
          <div class="field input">
            <label>Location</label>
            <input type="text" name="location" placeholder="Enter your location" aria-required="true">
          </div>
          <div class="field input">
            <label>Hourly Rate ($)</label>
            <input type="number" name="hourly_rate" placeholder="Enter your hourly rate" min="0" step="0.01" aria-required="true">
          </div>
        </div>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <button type="submit">Continue to Chat</button>
        </div>
      </form>
      <div class="link">Already signed up? <a href="login.php">Login now</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>
</html> 