<?php
$sign_in_as = "";
$msg = ""; $url = "";
$open_err_div = '<div class="row">
<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
<div class="alert alert-danger" >';
$close_err_div = 'Try again!</a></div></div><div>';

if( $_POST )
{
  /* Login */
  if( isset($_POST['login']) )
  {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['userkey'], FILTER_SANITIZE_STRING);
    $sign_in_as = filter_var($_POST['sign_in_as'], FILTER_SANITIZE_STRING);
    $semester = filter_var($_POST['semester'], FILTER_SANITIZE_STRING);

    if( !empty($sign_in_as) && $sign_in_as == 1 )
    {
      $sign_in_as = "Staff";
      $semester = "";
    }
    else
    {
      $sign_in_as = "Student";
    }

    if( $user->login($username, $password, $sign_in_as, $semester) )
    {
      $url = "index.php?action=home";
      echo "<script>window.location='".$url."';</script>";
    }
    else
    {
      $url = "index.php?action=login";
      $msg = "Error: Username/password is incorrent. Please try again.";
      echo $open_err_div . $msg. '<a href="'.$url.'">' . $close_err_div;
    }
  }
  elseif( isset($_POST['upload']) )
  {
    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $tmp_name = $_FILES["fileToUpload"]["tmp_name"];
    $uploaded_for = filter_var($_POST['uploaded_for'], FILTER_SANITIZE_STRING);
    $uploaded_by = filter_var($_POST['uploaded_by'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);

    if( !empty($file_name) && !empty($uploaded_for) && !empty($uploaded_by) && !empty($description) )
    {
      $target_dir = "./uploads/";
      $target_file = $target_dir . $file_name;
      $uploadOk = 1;
      $fileType = pathinfo($target_file,PATHINFO_EXTENSION);

      // Check if image file is a actual image or fake image
      $check = getimagesize($tmp_name);
      if($check !== false)
      {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 0;
      }
      else
      {
        $uploadOk = 1;
      }

      // Check if file already exists
      if (file_exists($target_file))
      {
        $url = "index.php?action=upload";
        $msg = "Error: Sorry, file already exists. Please try again.";
        echo $open_err_div . $msg. '<a href="'.$url.'">' . $close_err_div;
        $uploadOk = 0;
      }

      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 500000)
      {
        $url = "index.php?action=upload";
        $msg = "Error: Sorry, your file is too large. Please try again.";
        echo $open_err_div . $msg. '<a href="'.$url.'">' . $close_err_div;
        $uploadOk = 0;
      }

      if($fileType != "docx" && $fileType != "txt" && $fileType != "pdf" && $fileType != "doc" )
      {
        $url = "index.php?action=upload";
        $msg = "Error: Sorry, only docx, txt, pdf & doc files are allowed. Please try again.";
        echo $open_err_div . $msg. '<a href="'.$url.'">' . $close_err_div;
        $uploadOk = 0;
      }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0)
        {
          $url = "index.php?action=upload";
          $msg = "Error: Sorry, your file was not uploaded. Please try again.";
          echo $open_err_div . $msg. '<a href="'.$url.'">' . $close_err_div;
          // if everything is ok, try to upload file
        }
        else
        {
          if (move_uploaded_file($tmp_name, $target_file))
          {
            if( $files->upload($file_name, $uploaded_for, $uploaded_by, $description) )
            {
              echo "<script>alert('Submited!');</script>";
              echo "<script>window.location='index.php?action=home';</script>";
            }
            else
            {
              echo "<script>window.location='index.php?action=dashboard';</script>";
            }
          }
          else
          {
            $url = "index.php?action=upload";
            $msg = "Error: Sorry, there was an error uploading your file. Please try again.";
            echo $open_err_div . $msg. '<a href="'.$url.'">' . $close_err_div;
          }
        }

    }
    elseif( !empty($uploaded_for) && !empty($uploaded_by) && !empty($description) && !move_uploaded_file($tmp_name, $target_file) ){
      $file_name = "";
      $files->upload($file_name, $uploaded_for, $uploaded_by, $description);
      echo "<script>alert('Submited as a notice-feed without file!');</script>";
      echo "<script>window.location='index.php?action=home';</script>";
    }
  }
  elseif( isset($_POST['editUser']) )
  {
    $user_id = filter_var($_POST['user_id'], FILTER_SANITIZE_STRING);
    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
    $email_id = filter_var($_POST['email_id'], FILTER_SANITIZE_STRING);
    $semester = filter_var($_POST['semester'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $active = filter_var($_POST['set_active'], FILTER_SANITIZE_STRING);

    if( $user->editUser($user_id, $fullname, $email_id, $semester, $description, $active) )
    {
      $url = "index.php?action=list_users";
      echo "<script>window.location='".$url."';</script>";
    }
    else
    {
      $url = "index.php?action=edit_user&id=".$user_id;
      $msg = "Error: Database error. Please try again.";
      echo $open_err_div . $msg. '<a href="'.$url.'">' . $close_err_div;
    }
  }
  elseif( isset($_POST['addUser']) ) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $role = filter_var($_POST['role'], FILTER_SANITIZE_STRING);
    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
    $email_id = filter_var($_POST['email_id'], FILTER_SANITIZE_STRING);
    $semester = filter_var($_POST['semester'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $active = filter_var($_POST['set_active'], FILTER_SANITIZE_STRING);

    if( $user->addUser($username, $password, $role, $fullname, $email_id, $semester, $description, $active) )
    {
      $url = "index.php?action=list_users";
      echo "<script>window.location='".$url."';</script>";
    }
    else
    {
      $url = "index.php?action=add_user";
      $msg = "Error: Database error. Please try again.";
      echo $open_err_div . $msg. '<a href="'.$url.'">' . $close_err_div;
    }
  }
  elseif( isset($_POST['changePass']) ){
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $id = filter_var($_POST['id'], FILTER_SANITIZE_STRING);

    if($username == ""){
      $username == "";
      if($user->changePass($username, $password, $id)){
        echo "<script>alert('Done!');</script>";
        echo "<script>window.location='index.php?action=home';</script>";
      }
    }
    else
    {
      if($user->changePassUname($username, $password, $id)){
        echo "<script>alert('Done!');</script>";
        echo "<script>window.location='index.php?action=home';</script>";
      }
    }
  }
  elseif( isset($_POST['send_email']) ){
    $sender_name = filter_var($_POST['sender_name'], FILTER_SANITIZE_STRING);
    $sender_id = filter_var($_POST['sender_email'], FILTER_SANITIZE_STRING);
    $email_sub = filter_var($_POST['email_subject'], FILTER_SANITIZE_STRING);
    $email_msg = filter_var($_POST['email_message'], FILTER_SANITIZE_STRING);
    $email_subject = "$email_sub | Inquiry by: $sender_name ($sender_id)";
    mail("iamsarthakjoshi@gmail.com", $email_subject, $email_message);
    echo "<script>alert('Thank you! We will get back to you as soon as possile');</script>";
    echo "<script>window.location='index.php?action=home';</script>";
  }
  elseif( isset($_POST['del_priv_msg']) ){
    if( $chat_msg->deletePrivChat() ){
      echo "<script>alert('Done!');</script>";
      $url = "index.php?action=list_users";
      echo "<script>window.location='".$url."';</script>";
    } else {
      echo "<script>alert('Error!');</script>";
      $url = "index.php?action=delete_messages";
      echo "<script>window.location='".$url."';</script>";
    }
  }
  elseif( isset($_POST['del_pub_msg']) ){
    if( $chat_msg->deletePubChat() ){
      echo "<script>alert('Done!');</script>";
      $url = "index.php?action=list_users";
      echo "<script>window.location='".$url."';</script>";
    } else {
      echo "<script>alert('Error!');</script>";
      $url = "index.php?action=delete_messages";
      echo "<script>window.location='".$url."';</script>";
    }
  }
}
elseif ( $_GET )
{
  if( isset($_GET['action']) && $_GET['action']=="controller/controller" && $_GET['do'] == "logout" )
  {
    $user->logout();
    echo "<script>window.location='index.php?action=login';</script>";
  }
  elseif( $_GET['action']=="controller/controller" && $_GET['do'] == "delete_usr" )
  {
    $id = $_GET['id'];
    $user->deleteUser($id);
    echo "<script>window.location='index.php?action=list_users';</script>";
  }
  elseif( $_GET['action']=="controller/controller" && $_GET['do'] == "delete_fl" )
  {
    $id = $_GET['id'];
    $files->deleteFile($id);
    echo "<script>window.location='index.php?action=list_files';</script>";
  }
}
?>
