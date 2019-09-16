<?php if( !empty($_SESSION['username']) && $_SESSION['role'] == "Staff"): ?>
  <?php $rows = $files->listFiles(); ?>
<div class="container">
  <div class="row">
    <!-- Page Heading -->
    <h1 class="page-header" style="color: #fff;"><strong>Dashboard</strong></h1>

    <div class="form-box" style="margin-top: 40px;">
      <div class="col-md-3">

        <div class="form-top">
          <div class="form-top-left">
            <h3>Admin</h3>
            <p>List Files</p>
          </div>
          <div class="form-top-right">
            <i class="fa fa-pencil"></i>
          </div>
        </div>

        <div class="form-bottom" id="form-bottom">
          <div class="list-group">
            <a href="<?php echo $config['base_url']; ?>index.php?action=list_users" class="list-group-item">List Users</a>
            <a href="<?php echo $config['base_url']; ?>index.php?action=add_user" class="list-group-item">Add User</a>
            <a href="<?php echo $config['base_url']; ?>index.php?action=list_files" class="list-group-item active">List Files/Notice</a>
            <a href="<?php echo $config['base_url']; ?>index.php?action=upload" class="list-group-item">Upload Files/Notice</a>
            <a href="<?php echo $config['base_url']; ?>index.php?action=delete_messages" class="list-group-item">Delete Messages</a>
          </div>
        </div>

      </div>

      <div class="col-md-9">
        <div class="form-top">
          <div class="form-top-left">
            <h3>List Files</h3>
            <p>Set users active or inactive. Edit their information as per the need.</p>
          </div>
          <div class="form-top-right">
            <i class="fa fa-pencil"></i>
          </div>
        </div>

        <div class="form-bottom" id="form-bottom">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Filename</th>
                <th>Uploaded For</th>
                <th>Uploaded By</th>
                <th>Description</th>
                <th>Upload time</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach( $rows as $r ): ?>
              <tr>
                <td><?php echo $r['file_name']; ?></td>
                <td><?php echo $r['uploaded_for']; ?></td>
                <td><?php echo $r['uploaded_by']; ?></td>
                <td><?php echo $r['description']; ?></td>
                <td><?php echo $r['uploaded_time']; ?></td>
                <td>
                  <a name="remove_levels" href="<?php echo $config['base_url']; ?>index.php?action=controller/controller&do=delete_fl&id=<?php echo $r['id']; ?>">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
  
  </div>

</div>
</div>
</div>
</div>
<?php else: ?>
    <div class="alert alert-danger" >Please login to access dashboard. <a href="<?php echo $config['base_url']; ?>index.php?action=login">Login here</a></div>
<?php endif; ?>
