<?php if( !empty($_SESSION['username']) && $_SESSION['role'] == "Staff"): ?>
<div class="container">
  <div class="row">
    <!-- Page Heading -->
    <h1 class="page-header" style="color: #fff;"><strong>Dashboard</strong></h1>

    <div class="form-box" style="margin-top: 40px;">
      <div class="col-md-3">
        <div class="form-top">
          <div class="form-top-left">
            <h3>Admin</h3>
            <p>Upload file</p>
          </div>
          <div class="form-top-right">
            <i class="fa fa-pencil"></i>
          </div>
        </div>

        <div class="form-bottom" id="form-bottom">
          <div class="list-group">
            <a href="<?php echo $config['base_url']; ?>index.php?action=list_users" class="list-group-item">List Users</a>
            <a href="<?php echo $config['base_url']; ?>index.php?action=add_user" class="list-group-item">Add User</a>
            <a href="<?php echo $config['base_url']; ?>index.php?action=list_files" class="list-group-item">List Files/Notice</a>
            <a href="<?php echo $config['base_url']; ?>index.php?action=upload" class="list-group-item active">Upload Files/Notice</a>
            <a href="<?php echo $config['base_url']; ?>index.php?action=delete_messages" class="list-group-item">Delete Messages</a>
          </div>
        </div>
      </div>

      <div class="col-lg-9">
        <div class="form-top">
          <div class="form-top-left">
            <h3>Upload file</h3>
            <p>Please upload the files, routine or any documents.</p>
          </div>
          <div class="form-top-right">
            <i class="fa fa-pencil"></i>
          </div>
        </div>

        <div class="form-bottom">
          <form method="post" action="<?php echo $config['base_url'];?>index.php?action=controller/controller" enctype="multipart/form-data">

            <div class="form-group">
              <label class="sr-only" for="form-first-name">Uploaded for</label>
              <input type="text" name="uploaded_for" placeholder="Uploaded for" class="form-first-name form-control" id="form-first-name" required>
            </div>

            <div class="form-group">
              <label class="sr-only" for="form-first-name">Uploaded by</label>
              <input type="text" name="uploaded_by" placeholder="Uploaded by" class="form-first-name form-control" id="form-first-name" required>
            </div>

            <div class="form-group">
              <label class="sr-only" for="form-first-name">Description</label>
              <textarea class="form-control noresize" name="description" rows="8" placeholder="Description here..." style="width:100%;" required></textarea>
            </div>

            <div class="form-group">
              <label class="sr-only" for="form-first-name">Upload file</label>
              <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <button type="submit" class="btn" name="upload">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php else: ?>
    <div class="alert alert-danger" >Please login to access dashboard. <a href="<?php echo $config['base_url']; ?>index.php?action=login">Login here</a></div>
<?php endif; ?>
