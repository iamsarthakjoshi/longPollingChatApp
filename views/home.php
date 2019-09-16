<?php
$semester = $_SESSION['semester'];
$rows = $files->listFilesForAdminHome();
$rows2 = $files->listFilesBySem($semester);
$rows3 = $files->listFilesByAll();
?>

<!-- <div class="container"> -->
<!-- Main component for a primary marketing message or call to action -->
<div class="jumbotron" id="jumbotron">
  <h1>TBC Portal</h1>
  <p>Dedicated to providing the best chat service to our staff and students for the reliable communication.
    Also, it has made easy to get new updates, notices and necessary files and documents to our staff and students.<p>
    <a class="btn btn-lg btn-primary" href="<?php echo $config['base_url'];?>index.php?action=login" role="button">Click to login &raquo;</a>
  </p>
</div>
<!-- </div> -->

<div class="container">
  <div class="row">
    <div class="col-md-5 chatrooms">
      <div class="list-group">
        <?php if(isset($_SESSION['logged']) && $_SESSION['role'] == "Staff"): ?>
          <a href="<?php echo $config['base_url'];?>index.php?action=pblc_cht_rm" class="list-group-item list-group-item-success" id="list-group-item" style="line-height: 16.7 !important;">Public Chat Room</a>
        <?php else: ?>
          <a href="<?php echo $config['base_url'];?>index.php?action=pblc_cht_rm" class="list-group-item list-group-item-success" id="list-group-item">Public Chat Room</a>
          <a href="<?php echo $config['base_url'];?>index.php?action=pvt_cht_rm" class="list-group-item list-group-item-danger" id="list-group-item">Private Chat Room</a>
        <?php endif; ?>
      </div>
    </div>
    <!-- <div class="col-md-1">

    </div> -->
    <div class="col-md-7 files">
      <a class="list-group-item active" style="position:absolute;width:98.5%;">Notices, Feeds &amp more</a>
      <div class="list-group" id="list-group">
        <a class="list-group-item active">Notices, Feeds &amp more</a>
        <?php if( isset($_SESSION['logged']) && $_SESSION['semester'] == "" ): ?>

          <?php foreach( $rows as $r ): ?>
            <?php if( $r['file_name'] == "" ): ?>
              <a class="list-group-item">
                <i class="fa fa-rss" aria-hidden="true"></i>
                <?php echo "(".$r['uploaded_for'].")"; ?>
                <?php echo $r['description']; ?>
                <span class="notice">Posted on <?php $date= date_create($r['uploaded_time']); echo date_format($date, 'Y-m-d'); ?></span>
              </a>
            <?php else: ?>
              <a href="<?php $b=$config['base_url']."uploads/"; echo $b.$r['file_name'];?>" class="list-group-item" target="_blank">
                <i class="fa fa-download" aria-hidden="true"></i>
                <?php echo "(".$r['uploaded_for'].")"; ?>
                <?php echo $r['description']; ?>
                <span class="notice">Posted on <?php $date= date_create($r['uploaded_time']); echo date_format($date, 'Y-m-d'); ?></span>
              </a>
            <?php endif; ?>
          <?php endforeach; ?>

        <?php elseif( isset($_SESSION['logged']) && isset($_SESSION['semester']) ): ?>
          <?php foreach( $rows3 as $r ): ?>
            <?php if( $r['file_name'] == "" ): ?>
              <a class="list-group-item">
                <i class="fa fa-rss fa-lg" aria-hidden="true"></i> <?php echo $r['description']; ?><span class="notice">Posted on <?php $date= date_create($r['uploaded_time']); echo date_format($date, 'Y-m-d'); ?></span>
              </a>
            <?php else: ?>
              <a href="<?php $b=$config['base_url']."uploads/"; echo $b.$r['file_name'];?>" class="list-group-item" target="_blank">
                <i class="fa fa-download fa-lg" aria-hidden="true"></i> <?php echo $r['description']; ?>
                <span class="notice">Posted on <?php $date= date_create($r['uploaded_time']); echo date_format($date, 'Y-m-d'); ?></span>
              </a>
            <?php endif; ?>
          <?php endforeach; ?>
          <?php foreach( $rows2 as $r ): ?>
            <?php if( $r['file_name'] == "" ): ?>
              <a class="list-group-item">
                <i class="fa fa-rss fa-lg" aria-hidden="true"></i> <?php echo $r['description']; ?>
                <span class="notice">Posted on <?php $date= date_create($r['uploaded_time']); echo date_format($date, 'Y-m-d'); ?></span>
              </a>
            <?php else: ?>
              <a href="<?php $b=$config['base_url']."uploads/"; echo $b.$r['file_name'];?>" class="list-group-item" target="_blank">
                <i class="fa fa-download fa-lg" aria-hidden="true"></i> <?php echo $r['description']; ?>
                <span class="notice">Posted on <?php $date= date_create($r['uploaded_time']); echo date_format($date, 'Y-m-d'); ?></span>
              </a>
            <?php endif; ?>
          <?php endforeach; ?>

        <?php else: ?>
          <?php foreach( $rows3 as $r ): ?>
            <?php if( $r['file_name'] == "" ): ?>
              <a class="list-group-item">
                <i class="fa fa-rss fa-lg" aria-hidden="true"></i> <?php echo $r['description']; ?><span class="notice">Posted on <?php $date= date_create($r['uploaded_time']); echo date_format($date, 'Y-m-d'); ?></span>
              </a>
            <?php else: ?>
              <a href="<?php $b=$config['base_url']."uploads/"; echo $b.$r['file_name'];?>" class="list-group-item" target="_blank">
                <i class="fa fa-download fa-lg" aria-hidden="true"></i> <?php echo $r['description']; ?>
                <span class="notice">Posted on <?php $date= date_create($r['uploaded_time']); echo date_format($date, 'Y-m-d'); ?></span>
              </a>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
