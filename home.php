<html>
    <head>
        <link href="home.css" rel="stylesheet" text="text/css">
    </head>
    <?php
   //session_destroy();
    if(isset($_GET['Message']))
    {
        echo '<script language="javascript">alert("' . $_GET['Message'] . '")</script>';
        //session_destroy();
    }
session_start();
session_regenerate_id(true);
if(isset($_POST['s1']))
{
    $_SESSION['y']=10;
    $conn=mysql_connect("localhost","root","");
    if(!$conn)
    {
        die("could not connect".mysql_error());
    }
    mysql_select_db("userdb",$conn);
    //mysql_query("INSERT INTO clientinfo (CCN,Password) VALUES ('999','999')");
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name=$_POST['cc'];
        $pass=$_POST['pass'];
        $q="SELECT * FROM clientinfo where cc_no='$name' and password='$pass' ";
        $result=mysql_query($q,$conn);
       //echo mysql_num_rows($result);
        if(mysql_num_rows($result)!=0)
        {   
            $_SESSION['x']=$name;
            header("location:Payment.php");
        }
        else
            echo '<script language="javascript">alert("Username & password dont match")</script>';
    }
}
?>
    
    <script>
        function check1()
            {
              var p1=document.getElementById('c').value;
                 var x= p1.indexOf(' ');
                if(p1!="" && x>=0)
                    {
                    alert("space detected");
                         document.getElementById('c').value="";
                        document.getElementById('c').focus();
                    }
                else if(p1!="" && isNaN(p1))
                {
                    document.getElementById('c').value="";
                    alert("Not a number");
                     document.getElementById('c').focus();
                }
                else 
                    {
                         
                    if(p1!="" && p1.length!=16 )
                    {
                        alert("CCno. length should be 16");
                        document.getElementById('c').focus();
                        document.getElementById('c').value="";
                    }
                    }
                
            }
            function check2()
            {
                 var p2=document.getElementById('p').value;
                var x= p2.indexOf(' ');
                if(x>=0)
                {
                    alert("Password detected");
               return false;
                }
                
            }
        </script>
    <body>
    <div class="main">
        <h1>Fraudulent transaction checking system</h1>
        <div class="mid">
        <h2>Login Page</h2>
            <div class="left">
                <form method="post">
                    <pre>     
                    <label id="p1"><strong>CC No. : </strong></label>
                    <label><input type="text" id="c" name="cc" value="" required onfocusout="check1()"></label><br>
                    <label id="p2">Password : </label>
                    <label><input type="password" id="p" name="pass" value="" required></label><br>s
                    <div>
                    <input type="submit" name="s1" value="Login" class="submit" align="center" onclick="return check2()"><u>Forget password?</u> 
                    </div>
                    <label><a href="register.php"><span style="color: midnightblue; font-family: inherit; font-size: 15">New User? </span><span style="color: red; font-size: 15"><u style="color: red">Register here</u></span></a></label>
                    </pre>
                </form>
            </div>
        </div>
        
        </div>
        <div>
        <footer style="color:white" align="center" font-size:"20px"; marigin-bottom:"20px";>© 2018 CREDIT CARD FRAUDULENT CHECK. All rights reserved. Design by S2BPR</footer>
            </div>
    </body>
</html>