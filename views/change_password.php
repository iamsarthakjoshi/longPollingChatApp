<?php if( !empty($_SESSION['username']) && $_SESSION['role'] == "Student"): ?>
<div class="container">
  <div class="row">
    <!-- Page Heading -->
    <h1 class="page-header" style="color: #fff;"><strong>Change Username &amp Password</strong></h1>

      <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        <div class="form-top">
          <div class="form-top-left">
            <h3>Update credentials</h3>
            <p>We encourage you to at least change your password for security reasons.</p>
          </div>
          <div class="form-top-right">
            <i class="fa fa-pencil"></i>
          </div>
        </div>

        <div class="form-bottom">
          <form method="post" action="<?php echo $config['base_url'];?>index.php?action=controller/controller" autocomplete="off">
            <input type="text" name="id" value="<?php echo $_SESSION['uid']; ?>" hidden>
            <div class="form-group">
              <label class="sr-only" for="form-first-name">Username</label>
              <input type="text" name="username" id="uname" placeholder="Enter new username" class="form-first-name form-control" readonly onfocus="this.removeAttribute('readonly');">
            </div>
            <p class="help-block text-danger" id="userexists"></p>
            <div class="form-group">
              <label class="sr-only" for="form-first-name">Password</label>
              <input type="password" name="password" placeholder="Enter strong password" class="form-first-name form-control" required>
            </div>

            <button type="submit" class="btn change" name="changePass">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php else: ?>
    <div class="alert alert-danger" >Please login to access dashboard. <a href="<?php echo $config['base_url']; ?>index.php?action=login">Login here</a></div>
<?php endif; ?>
