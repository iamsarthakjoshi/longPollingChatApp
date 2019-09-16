<?php if( empty($_SESSION['username']) || empty($_SESSION['logged']) ): ?>
<div class="container">

  <div class="row">
    <div class="col-sm-8 col-sm-offset-2 text">
      <h1><strong>Login Form</strong></h1>
      <div class="description">
        <p>
          You can <strong>"login"</strong> to our site with login form below.
        </p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">

      <div class="form-box">
        <div class="form-top">
          <div class="form-top-left">
            <h3>Login to our site</h3>
            <p>Enter username, userkey and role to log in:</p>
          </div>
          <div class="form-top-right">
            <i class="fa fa-lock"></i>
          </div>
        </div>
        <div class="form-bottom">
          <form method="post" action="<?php echo $config['base_url'];?>index.php?action=controller/controller">
            <div class="form-group">
              <label class="sr-only" for="form-username">Username</label>
              <input type="text" name="username" value="" placeholder="Username..." class="form-username form-control" id="form-username">
            </div>

            <div class="form-group">
              <label class="sr-only" for="form-password">Userkey</label>
              <input type="password" name="userkey" value="" placeholder="Userkey..." class="form-password form-control" id="form-password">
            </div>

            <div class="form-group">
              <label class="sr-only" for="form-username">Role</label>
              <p style="color: #fff">
                Sign in as:
              </p>
              <select id="sign_in_as" name="sign_in_as">
                <option>Select Role</option>
                <option value="1">Staff</option>
                <option value="2">Student</option>
              </select>

              <select id="semester" name="semester">
                <option>Select Semester</option>
                <option value="bscit_l6s2">BSCIT - L6S2</option>
                <option value="bscit_l6s1">BSCIT - L6S1</option>
              </select>
            </div>
            <button type="submit" class="btn" name="login">Sign in!</button>
          </form>
        </div>
      </div>

      <div class="social-login">
        <h3>...find us on:</h3>
        <div class="social-login-buttons">
          <a class="btn btn-link-2" href="#">
            <i class="fa fa-facebook"></i> Facebook
          </a>
          <a class="btn btn-link-2" href="#">
            <i class="fa fa-twitter"></i> Twitter
          </a>
          <a class="btn btn-link-2" href="#">
            <i class="fa fa-google-plus"></i> Google Plus
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php else: ?>
    <div class="alert alert-danger" >You have already logged in.<a href="<?php echo $config['base_url']; ?>index.php?action=home">Go back</a></div>
<?php endif; ?>
