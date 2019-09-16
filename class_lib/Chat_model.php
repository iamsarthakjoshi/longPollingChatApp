<?php
class Chat_model{
  private $db;

  public function __construct(){
    $this->db = Db_connect::connect();
  }

  public function deletePrivChat(){
  	$query = "DELETE FROM private_messages";
    if( $this->db->query( $query ) )
    {
      return true;
    }
  }

  public function deletePubChat(){
  	$query = "DELETE FROM public_messages";
    if( $this->db->query( $query ) )
    {
      return true;
    }
  }
}