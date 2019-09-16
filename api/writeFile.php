<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Methods: GET, POST, PUT');

$message = $_GET['message']."\n";
$username = $_GET['username'];

$myfile = fopen("../files/data.txt", "w") or die("Unable to open file!");

include_once "connect.php";

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$queryInsert = $db->query("INSERT INTO public_messages (username, user_id, message, posted)
VALUES('$username', 1, '$message', CURRENT_TIMESTAMP)");
$querySelect = $db->query("SELECT username, posted, message FROM public_messages ORDER BY posted ASC");

if($queryInsert){
    while($row = $querySelect->fetch_array())
    {
        $rows[] = $row;
    }

    foreach($rows as $row)
    {
        $a = '<li class="chatMessage"><p><span id="username"><strong>'.$row['username'].'</strong></span><span id="datetime"> '.$row['posted'].'</span></p><p class="message" id="sick">'.rtrim($row['message']).'</p></li>';
        fwrite($myfile, $a);
    }
    fclose($myfile);
} else{
    echo "Bad insert";
}
?>
