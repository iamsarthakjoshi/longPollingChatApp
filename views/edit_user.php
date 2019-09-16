<?php if( !empty($_SESSION['username']) && $_SESSION['role'] == "Staff"): ?>
  <?php
    $id = $_GET['id'];
    $result = $user->getUserInfoById($id);
  ?>
<div class="container">
  <div class="row">
    <!-- Page Heading -->
    <h1 class="page-header" style="color: #fff;"><strong>Dashboard</strong></h1>

    <div class="form-box" style="margin-top: 40px;">
      <div class="col-md-3">
        <div class="form-top">
          <div class="form-top-left">
            <h3>Admin</h3>
            <p>Edit User</p>
          </div>
          <div class="form-top-right">
            <i class="fa fa-pencil"></i>
          </div>
        </div>

        <div class="form-bottom" id="form-bottom">
          <div class="list-group">
            <a href="<?php echo $config['base_url']; ?>index.php?action=list_users" class="list-group-item active">List Users</a>
            <a href="<?php echo $config['base_url']; ?>index.php?action=add_user" class="list-group-item">Add User</a>
            <a href="<?php echo $config['base_url']; ?>index.php?action=list_files" class="list-group-item">List Files</a>
            <a href="<?php echo $config['base_url']; ?>index.php?action=upload" class="list-group-item">Upload Files</a>
            <a href="<?php echo $config['base_url']; ?>index.php?action=delete_messages" class="list-group-item">Delete Messages</a>
          </div>
        </div>
      </div>

      <div class="col-lg-9">
        <div class="form-top">
          <div class="form-top-left">
            <h3>Edit or update user's details</h3>
            <p>Set users active or inactive. Edit their information as per the need.</p>
          </div>
          <div class="form-top-right">
            <i class="fa fa-pencil"></i>
          </div>
        </div>

        <div class="form-bottom">
          <form method="post" action="<?php echo $config['base_url'];?>index.php?action=controller/controller" enctype="multipart/form-data">
            <input type="text" name="user_id" value="<?php echo $id;?>" style="display:none;">
            <div class="form-group">
              <label class="control-label" for="fullname">Fullname</label>
              <input type="text" name="fullname" value="<?php echo $result->fullname; ?>" placeholder="Fullname" class="form-first-name form-control" id="form-first-name" required>
            </div>

            <div class="form-group">
              <label class="control-label" for="email">Email ID</label>
              <input type="text" name="email_id" value="<?php echo $result->email_id; ?>" placeholder="Email Id" class="form-first-name form-control" id="form-first-name" required>
            </div>

            <?php if(  $result->role === "Staff" ): ?>
              <input type="text" name="semester" value="" style="display:none;" />
            <?php else: ?>
            <div class="form-group">
              <label class="control-label" for="semester">Semester</label>
              <input type="text" name="semester" value="<?php echo $result->semester; ?>" placeholder="Semester" class="form-first-name form-control" id="form-first-name" required>
            </div>
          <?php endif; ?>

            <div class="form-group">
              <label class="control-label" for="description">Description</label>
              <textarea class="form-control noresize" name="description" rows="8" placeholder="Description here..." style="width:100%;" required><?php echo $result->description; ?></textarea>
            </div>

            <div class="form-group">
              <label class="control-label" for="form-first-name">Active</label>
              <select name="set_active">
                <?php if( $result->active == "1" ): ?>
                  <option value="1">1</option>
                  <option value="0">0</option>
                <?php else: ?>
                  <option value="0">0</option>
                  <option value="1">1</option>
                <?php endif; ?>
              </select>
            </div>

            <button type="submit" class="btn" name="editUser">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php else: ?>
    <div class="alert alert-danger" >Please login to access dashboard. <a href="<?php echo $config['base_url']; ?>index.php?action=login">Login here</a></div>
<?php endif; ?>
