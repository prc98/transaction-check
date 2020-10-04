<?php
session_start();
$amt=$_SESSION['amt'];
$item = $_SESSION['item'];
$ccno= $_SESSION['ccno'];

$conn=mysql_connect('localhost','root','');
        if(!$conn)
        {
            
            die('could not connect: '.mysql_error());
        }
    $sqlstr = "INSERT INTO transactions VALUES($ccno,$item,$amt,NOW())";
            mysql_select_db("bankdb");
           $ret = mysql_query($sqlstr,$conn);
    if($ret)
        echo '<h1>"Transaction Successful"</h1>';
    else
        echo '<h1>"Transaction not Successful"</h1>';
//$_SESSION['p']=10;
session_destroy();
$Message="Transaction Successful";
header("Location: home.php?Message=" . urlencode($Message));
?>
