<h1>function check()
        {
            var p=document.regs.pw
            var p2=document.regs.pw2
            if (p2.value!="" && p.value!=p2.value)
            {
                alert("Ouch! Password don't match")
               p2.focus();
                p2.value=""
                
            }
            
        }
    ?>

      //session_start();
        if(isset($_POST['s']) && $_SERVER["REQUEST_METHOD"]=="POST" )
        {
             $cc = $_POST['cc'];
            if(!isset($_SESSION['x']))
            {
                $_SESSION['x']=$cc;
            }

        }
    ?>frauuuuuuuuuuuuuuuuuuuuuuuuuuuuuud</h1>


<!DOCTYPE html>
<html>
<style>
    body{
        background-image: url("images/img3.png");
        background-size: 1400px 1000px;
        color: aliceblue;
        font-size:25px;
        line-height: 1.5;
    }
    h1{
        color: aqua;
    }
    h2{
        color: palevioletred;
    }
    form{
        width: 800px;
        color: #EEEDF6;
        font-size:20px;
        font-family: Verdana;
    }
    input[type="submit"]{
        width: 200px;
        height: 34px;
        border: none;
        background: yellow;
        color: blue;
        text-align: center;
        
    }
    input[type="submit"]:focus{
        width: 200px;
        height: 34px;
        border: none;
        background: white;
        color: red;
        text-align: center;
    }
    input:focus{
        background: white;
    }
</style>
    <?php
    session_start();
    if(!isset($_SESSION['d']))
            header("location:register.php");
    
    if(isset($_POST['submit']))
    {
        $conn=mysql_connect('localhost','root','');//to setup connection
        if(!$conn)//if false
        {
            die('could not connect:'.mysql_error());
        }
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $crn=$_POST['crn'];
            $ans1=$_POST['ans1'];
            $ans2=$_POST['ans2'];
            $ans3=$_POST['ans3'];
            $ans4=$_POST['ans4'];
            $ans5=$_POST['ans5'];
            $ans6=$_POST['ans6'];
            $ans7=$_POST['ans7'];
            $ans8=$_POST['ans8'];
            $ans9=$_POST['ans9'];
            $ans10=$_POST['ans10'];
            $sqlstr="insert into secquiz values('$crn','$ans1','$ans2','$ans3','$ans4','$ans5','$ans6','$ans7','$ans8','$ans9','$ans10')";
            mysql_select_db("clientdb");
            $ret=mysql_query($sqlstr,$conn);
            //if(!$ret)
              //  echo "Insertion not successful";
            //else 
              //  echo "Insertion successful";
            header("location:home.php");
        }
    }
?>
    
<body>
    <center>
    <h1>SECURITY QUESTIONS</h1>
    </center>
    <h2>Please Fill Up All The Questions</h2>
    
    <form>
        <center>
            <tr>
                <td><b>CC No.:</b></td>
                <td><input type="text" name="crn" value= "<?php
                                   if(isset($_SESSION['d'])) echo $_SESSION['d'];?>" disabled></td>
            </tr>
            </center>
        <table>
            <tr>
                <td>Q1 :</td>
                <td>What was the first phone number you remembered?
                </td>
            </tr>
            <tr>
                <td>Ans :</td>
                <td><input type="password" name="ans1" placeholder="maximum 10 characters"></td>
            </tr>
            <tr>
                <td>Q2:</td>
                <td>What is your favourite website?</td>
            </tr>
            <tr>
                <td>Ans :</td>
                <td><input type="password" name="ans2"></td>
            </tr>
            <tr>
                <td>Q3:</td>
                <td>How long was your first train journey?</td>
            </tr>
            <tr>
                <td>Ans :</td>
                <td><input type="password" name="ans3"></td>
            </tr>
            <tr>
                <td>Q4:</td>
                <td>What was the first story book you have read?</td>
            </tr>
            <tr>
                <td>Ans :</td>
                <td><input type="password" name="ans4"></td>
            </tr>
            <tr>
                <td>Q5:</td>
                <td>Name of the teacher you hated the most</td>
            </tr>
            <tr>
                <td>Ans :</td>
                <td><input type="password" name="ans5"></td>
            </tr>
            <tr>
                <td>Q6:</td>
                <td>What was your first vacation spot?
                </td>
            </tr>
            <tr>
                <td>Ans :</td>
                <td><input type="password" name="ans6"></td>
            </tr>
            <tr>
                <td>Q7:</td>
                <td>What is the name of the first movie you have watched?</td>
            </tr>
            <tr>
                <td>Ans :</td>
                <td><input type="password" name="ans7"></td>
            </tr>
            <tr>
                <td>Q8:</td>
                <td>What was your first pocket money?</td>
            </tr>
            <tr>
                <td>Ans :</td>
                <td><input type="password" name="ans8"></td>
            </tr>
            <tr>
                <td>Q9:</td>
                <td>What is the best gift you have ever received?</td>
            </tr>
            <tr>
                <td>Ans :</td>
                <td><input type="password" name="ans9"></td>
            </tr>
            <tr>
                <td>Q10:</td>
                <td>What was the first cinema hall you have ever visited?</td>
            </tr>
            <tr>
                <td>Ans :</td>
                <td><input type="password" name="ans10"></td>
            </tr>
        </table>
        <input type="submit" value="Submit" name="submit">
                 
        
            
   </form>
    
</body>
</html>