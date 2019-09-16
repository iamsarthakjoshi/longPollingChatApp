<?php
class User_model{
  private $db;

  public function __construct(){
    $this->db = Db_connect::connect();
  }

  public function login($u, $p, $r, $s)
  {
    $p = md5($p);
    $active = 0;
    $user_id = 0;

    $querySelect = "SELECT user_id, username, semester, role, active, fullname
    FROM users WHERE username=? AND password=? AND role=? AND semester=?";  /* create query */
    $queryInsert = "INSERT INTO online_users (user_id, fullname)
    VALUES ( ?,? )";
    $querySelectOnlineUsers = "SELECT fullname from online_users";

    $stmt = $this->db->prepare($querySelect);  /* create a prepared statement */
    $stmt->bind_param("ssss",$u,$p,$r,$s);    /* bind parameters for markers */
    $stmt->execute();             /* execute query */
    $stmt->bind_result($user_id, $username, $semester, $role, $active, $fullname);
    $stmt->store_result();

    if( $stmt->num_rows == 1 ){
      if( $stmt->fetch() ){
        if( $active != 1 ){
          echo "You are set to in-active member right now.
          Thus your account has been deactivated.
          Consult with student department.";
          return false;
        } else {
          $_SESSION['logged'] = 1;
          $_SESSION['uid'] = $user_id;
          $_SESSION['username'] = $username;
          $_SESSION['semester'] = $semester;
          $_SESSION['role'] = $role;

          $stmt2 = $this->db->prepare($queryInsert);      /* create a prepared statement */
          $stmt2->bind_param("is",$user_id, $fullname);   /* bind parameters for markers */
          $stmt2->execute();
          $stmt2->close();

          $file = fopen("files/online_users.txt", "a") or die("Unable to open file!");
          $data = "<li class='user'>".
          "<i class='fa fa-dot-circle-o'></i>".
          "<span class='username'>".$fullname."</span>".
          "</li>";

          fwrite($file, $data);
          fclose($file);

          return true;
        }
      }
    } else {
      return false;
    }
    $stmt->close();
  }

  public function logout()
  {
    $id = $_SESSION['uid'];

    /* Delete user session from database */
    $stmt = $this->db->prepare("DELETE FROM online_users WHERE user_id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();

    /* Destroy user session */
    session_destroy();

    /* Rewrite records of online users into file */
    $querySelectOnlineUsers = $this->db->query("SELECT fullname FROM online_users");
    $file = fopen("files/online_users.txt", "w") or die("Unable to open file!");

    while( $row = $querySelectOnlineUsers->fetch_array() )
    {
      $rows[] = $row;
    }
    foreach( $rows as $row )
    {
      $data = "<li class='user'>".
      "<i class='fa fa-dot-circle-o'></i>".
      "<span class='username'>".$row['fullname']."</span>".
      "</li>";
      fwrite($file, $data);
    }
    fclose($myfile);
  }

  public function listUsers()
  {
    $rows = array();
    if( $query = $this->db->query("SELECT user_id, username, email_id, fullname, role, semester, active FROM users") )
    {
      while( $row = $query->fetch_array() )
      {
        $rows[] = $row;
      }
    }
    return $rows;
  }

  public function getUserInfoById($id){
    if( $result = $this->db->query("SELECT fullname, email_id, semester, description, active, role FROM users WHERE user_id = '$id'") )
    {
      return $result->fetch_object();
    }
  }

  public function getUserInfoBySem($semester){
    if( $result = $this->db->query("SELECT user_id, username, fullname, semester FROM users WHERE semester = '$semester'") )
    {
      while( $row = $result->fetch_array() )
      {
        $rows[] = $row;
      }
    }
    return $rows;
  }

  public function editUser($id, $fullname, $email_id, $semester, $description, $active)
  {
    $query = "UPDATE users SET
    fullname = '$fullname',
    email_id = '$email_id',
    semester = '$semester',
    description = '$description',
    active = '$active'
    WHERE user_id = '$id'";

    if( $this->db->query( $query ) )
    {
      return true;
    }
  }

  public function addUser($username, $password, $role, $fullname, $email_id, $semester, $description, $active)
  {
    $password = md5($password);
    $query = "INSERT INTO users (username, password, role, fullname, email_id, semester, description, active)
              VALUES ('$username', '$password', '$role', '$fullname', '$email_id', '$semester', '$description', '$active')";
    if( $this->db->query( $query ) )
    {
      return true;
    }
  }

  public function deleteUser($id){
    $query = "DELETE FROM users WHERE user_id = '$id'";
    if( $this->db->query( $query ) )
    {
      return true;
    }
  }

  public function changePass($username, $password, $id){
    $password = md5($password);
    $query = "UPDATE users SET
    password = '$password'
    WHERE user_id = '$id'";

    if( $this->db->query( $query ) )
    {
      return true;
    }
  }

  public function changePassUname($username, $password, $id){
    $password = md5($password);
    $query = "UPDATE users SET
    password = '$password',
    username = '$username'
    WHERE user_id = '$id'";

    if( $this->db->query( $query ) )
    {
      return true;
    }
  }

}
?>
