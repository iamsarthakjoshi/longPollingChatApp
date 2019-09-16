<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><strong>TBC Portal</strong></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo $config['base_url']; ?>">Home</a></li>
                <li><a href="<?php echo $config['base_url']; ?>index.php?action=about">About</a></li>
                <li><a href="<?php echo $config['base_url']; ?>index.php?action=contact">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if( isset($_SESSION['username']) && $_SESSION['role'] === "Student") :?>
                    <li class="active"><a><strong>Hi, <?php echo $_SESSION['username']; ?></strong></a></li>
                    <li><a href="<?php echo $config['base_url']; ?>index.php?action=change_password">Change Password</a></li>
                    <li><a href="<?php echo $config['base_url']; ?>index.php?action=controller/controller&do=logout">Logout</a></li>
                <?php elseif( $_SESSION['role'] === "Staff" ) :?>
                    <li class="active"><a><strong>Hi, <?php echo $_SESSION['username']; ?></strong></a></li>
                    <li><a href="<?php echo $config['base_url']; ?>index.php?action=list_users">Dashboard</a></li>
                    <li><a href="<?php echo $config['base_url']; ?>index.php?action=controller/controller&do=logout">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?php echo $config['base_url']; ?>index.php?action=login">Sign in</a></li>
                <?php endif; ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
