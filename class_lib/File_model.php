<?php
  class File_model{
    private $db;

    public function __construct(){
      $this->db = Db_connect::connect();
    }

    public function upload($file_name, $uploaded_for, $uploaded_by, $description)
    {
      $queryInsert = "INSERT INTO files (file_name, uploaded_for, uploaded_by, description) VALUES ( ?,?,?,? )";
      if ( $stmt = $this->db->prepare($queryInsert) )
      {
        $stmt->bind_param("ssss", $file_name, $uploaded_for, $uploaded_by, $description);
        $stmt->execute();
        $stmt->close();
        return true;
      }
    }

    public function listFiles()
    {
      if( $query = $this->db->query("SELECT id, file_name, uploaded_for, uploaded_by, description, uploaded_time FROM files") )
      {
        while( $row = $query->fetch_array() )
        {
          $rows[] = $row;
        }
      }
      return $rows;
    }

    public function listFilesForAdminHome(){
      if( $query = $this->db->query("SELECT file_name, description, uploaded_for, uploaded_time FROM files") )
      {
        while( $row = $query->fetch_array() )
        {
          $rows[] = $row;
        }
      }
      return $rows;
    }

    public function listFilesBySem($semester){
      if( $query = $this->db->query("SELECT file_name, description, uploaded_time FROM files WHERE uploaded_for = '$semester'") )
      {
        while( $row = $query->fetch_array() )
        {
          $rows[] = $row;
        }
      }
      return $rows;
    }

    public function listFilesByAll(){
      if( $query = $this->db->query("SELECT file_name, description, uploaded_time FROM files WHERE uploaded_for = 'All'") )
      {
        while( $row = $query->fetch_array() )
        {
          $rows[] = $row;
        }
      }
      return $rows;
    }

    public function deleteFile($id){
      $query = "DELETE FROM files WHERE id = '$id'";

      if( $this->db->query( $query ) )
      {
        return true;
      }
    }
  }
?>
