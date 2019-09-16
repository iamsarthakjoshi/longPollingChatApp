 <div class="container">
    <div class="row">
    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        <!-- Page Heading -->
      <h1 class="page-header" style="color: #fff;"><strong>Contact Us</strong></h1>
   
        <div class="form-box" style="margin-top: 40px;">
          <div class="form-top">
            <div class="form-top-left">
              <h3>Email us now</h3>
              <p>Fill in the form below to get your enquiry answered is short time:</p>
            </div>
            <div class="form-top-right">
              <i class="fa fa-pencil"></i>
            </div>
          </div>
          <div class="form-bottom">
          <form method="post" action="<?php echo $config['base_url'];?>index.php?action=controller/controller">
            <div class="form-group">
              <label class="sr-only" for="form-first-name">Fullname</label>
              <input type="text" name="sender_name"  placeholder="Fullname" class="form-first-name form-control" id="form-first-name">
            </div>

            <div class="form-group">
              <label class="sr-only" for="form-email">Email</label>
              <input type="text" name="sender_email" placeholder="Email..." class="form-email form-control" id="form-email">
            </div>

            <div class="form-group">
              <label class="sr-only" for="form-first-name">Subject</label>
              <input type="text" name="email_subject" placeholder="Subject" class="form-first-name form-control" id="form-first-name">
            </div>

            <div class="form-group">
              <label class="sr-only" for="form-first-name">Message</label>
              <textarea class="form-control noresize" name="email_message" rows="8" placeholder="Enter your message here..." style="width:100%;"></textarea>
            </div>

            <button type="submit" class="btn" name="send_email">Send</button>
          </form>
        </div>
    </div>
    </div>
  </div>
</div>