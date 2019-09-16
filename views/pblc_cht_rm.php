<?php if( !empty($_SESSION['username']) || isset($_SESSION['username'])): ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 border-right">
                <div class="form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Common Chat Box</h3>
                            <p id="sick">Send message to your friends</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-pencil"></i>
                        </div>
                    </div>

                    <div class="form-bottom">
                        <ul class="chatBox" id="chatBox"></ul>
                        <?php if( !empty($_SESSION['username']) || isset($_SESSION['username'])): ?>
                            <input type="text" id="uname" value="<?php echo $_SESSION['username'];?>" style="display:none;">
                        <?php endif; ?>
                        <div class="chat-box-footer">
                            <div class="input-group">
                                <input type="text" name="message" id="entry" class="form-control" placeholder="Enter Text Here...">
                                <span class="input-group-btn">
                                    <button class="btn" id="doClick" type="button">SEND</button>
                                </span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Users online</h3>
                            <p>
                                All logged in users
                            </p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <ul class="onlineUsers" id="onlineUsers">
                            <li class="user">
                                <i class="fa fa-dot-circle-o"></i>
                                <span class="username">Sarthak</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-danger" >Please login to access chat room. <a href="<?php echo $config['base_url']; ?>index.php?action=login">Login here</a></div>
<?php endif; ?>
