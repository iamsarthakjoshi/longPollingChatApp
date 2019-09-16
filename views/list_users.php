<?php if( !empty($_SESSION['username']) && $_SESSION['role'] == "Staff"): ?>
  <?php $rows = $user->listUsers(); ?>
<div class="container">
  <div class="row">
    <!-- Page Heading -->
    <h1 class="page-header" style="color: #fff;"><strong>Dashboard</strong></h1>

    <div class="form-box" style="margin-top: 40px;">
      <div class="col-md-3">

        <div class="form-top">
          <div class="form-top-left">
            <h3>Admin</h3>
            <p>List Users</p>
          </div>
          <div class="form-top-right">
            <i class="fa fa-pencil"></i>
          </div>
        </div>

        <div class="form-bottom" id="form-bottom">
          <div class="list-group">
            <a href="<?php echo $config['base_url']; ?>index.php?action=list_users" class="list-group-item active">List Users</a>
            <a href="<?php echo $config['base_url']; ?>index.php?action=add_user" class="list-group-item">Add User</a>
            <a href="<?php echo $config['base_url']; ?>index.php?action=list_files" class="list-group-item">List Files/Notice</a>
            <a href="<?php echo $config['base_url']; ?>index.php?action=upload" class="list-group-item">Upload Files/Notice</a>
            <a href="<?php echo $config['base_url']; ?>index.php?action=delete_messages" class="list-group-item">Delete Messages</a>
          </div>
        </div>

      </div>

      <div class="col-md-9">
        <div class="form-top">
          <div class="form-top-left">
            <h3>List Users</h3>
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
                <th>User ID</th>
                <th>Fullname</th>
                <th>Role</th>
                <th>Semester</th>
                <th>Username</th>
                <th>Active</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach( $rows as $r ): ?>
              <tr>

                <td>
                  <?php echo $r['user_id']; ?>
                </td>
                <td>
                  <?php echo $r['fullname']; ?>
                </td>
                <td>
                  <?php echo $r['role']; ?>
                </td>
                <td>
                  <?php echo $r['semester']; ?>
                </td>
                <td>
                  <?php echo $r['username']; ?>
                </td>
                <td>
                  <?php echo $r['active']; ?>
                </td>
                <td>
                  <a href="<?php echo $config['base_url']; ?>index.php?action=edit_user&id=<?php echo $r['user_id']; ?>">Edit</a>
                </td>
                <td>
                  <a name="remove_levels" href="<?php echo $config['base_url']; ?>index.php?action=controller/controller&do=delete_usr&id=<?php echo $r['user_id']; ?>">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </tr>
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
