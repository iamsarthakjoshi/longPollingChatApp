<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Methods: GET, POST, PUT');

$message = $_GET['message']."\n";
$username = $_GET['username'];
$semester = $_GET['semester'];

$myfile = fopen("../files/data_priv_$semester.txt", "w") or die("Unable to open file!");

include_once "connect.php";

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$queryInsert = $db->query("INSERT INTO private_messages (username, user_id, message, posted, semester)
VALUES('$username', 1, '$message', CURRENT_TIMESTAMP, '$semester')");
$querySelect = $db->query("SELECT username, posted, message FROM private_messages WHERE semester = '$semester' ORDER BY posted ASC ");

if($queryInsert){
    while($row = $querySelect->fetch_array())
    {
        $rows[] = $row;
    }

    foreach($rows as $row)
    {
        $a = '<li class="chatMessage"><p><span id="username"><strong>'.$row['username'].'</strong></span><span id="datetime"> '.$row['posted'].'</span></p><p class="message">'.rtrim($row['message']).'</p></li>';
        fwrite($myfile, $a);
    }
    // fwrite($myfile, $a);
    fclose($myfile);
} else{
    echo "Bad insert";
}
?>
