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
        color: aliceblue;
        font-size: 60px;
    }
    h2{
        color:#CCFFFF;
        font-size:30px;
        margin:50px;
        
    }
    form{
        width: 800px;
        color: #EEEDF6;
        font-size:20px;
        font-family: Verdana;
    }
    .submit{
          background-color: dodgerblue;
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  font-size: 16px;
  margin: 4px 2px;
  opacity: 0.4;
  transition: 0.3s;
  border-radius:15px;
        margin-left:40%;
    }
    .submit:hover{opacity:1}
  
    input:focus{
        background: white;
    }
    #form1{
        margin: 0 auto;
        padding: 1em;
    }
    #user{
          
        font-size:40px;
        margin: 0 auto;
        margin-left:30%;
        
    }
    #user input[type="text"]
    {
        font-size:30px;
        
    }
    .q{
        margin: 4px 2px;
    padding: 16px 32px; 
        font-size:25px;
        font-weight: 500;
        
    }
    .qbox input[type="text"]
    {
        border:none;
        background: transparent;
        border-bottom: 1px solid #fff;
        outline:none;
        height:40px;
        color:#fff;
        font-size:20px;
        font-family:sans-serif;
        
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
            mysql_select_db("userdb");
            $sqlstr="insert into secquiz values('$crn','$ans1','$ans2','$ans3','$ans4','$ans5','$ans6','$ans7','$ans8','$ans9','$ans10')";
            
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
    <hr>
    <form Id="form1" method="post">
    <div id="user">
                <label><b>CRN :</b></label>
                <input type="text" id="c" name="crn" value= "<?php
                                   if(isset($_SESSION['d'])) echo $_SESSION['d'];?>">
            </div>
    <h2>Please fill up all the questions:</h2>
    <div class="qbox">      
    
    
        
        <table>
            
            <tr>
                <td class="q">Q1 :  What was the first phone number you remember?
                </td>
            </tr>
            <tr>
                <td>Ans : <input type="text" name="ans1" placeholder="" size="60" required></td>
            </tr>
            <tr>
                <td class="q">Q2:  What is your favourite website?</td>
            </tr>
            <tr>
                <td>Ans : <input type="text" name="ans2" size="60"  required></td>
            </tr>
            <tr>
                <td class="q">Q3:  How long was your first train journey?</td>
            </tr>
            <tr>
                <td>Ans : <input type="text" name="ans3" size="60"  required></td>
            </tr>
            <tr>
                <td class="q">Q4:  What was the first story book you have read?</td>
            </tr>
            <tr>
                <td>Ans : <input type="text" name="ans4" size="60"  required></td>
            </tr>
            <tr>
                <td class="q">Q5:  Name of the teacher you hated the most?</td>
            </tr>
            <tr>
                <td>Ans : <input type="text" name="ans5" size="60" required></td>
            </tr>
            <tr>
                <td class="q">Q6:  What was your first vacation spot?
                </td>
            </tr>
            <tr>
                <td>Ans : <input type="text" name="ans6" size="60" required></td>
            </tr>
            <tr>
                <td class="q">Q7:  What is the name of the first movie you have watched?</td>
            </tr>
            <tr>
                <td>Ans : <input type="text" name="ans7" size="60" required></td>
            </tr>
            <tr>
                <td class="q">Q8:  What was your first pocket money?</td>
            </tr>
            <tr>
                <td>Ans : <input type="text" name="ans8" size="60" required></td>
            </tr>
            <tr>
                <td class="q">Q9:  What is the best gift you have ever received?</td>
            </tr>
            <tr>
                <td>Ans : <input type="text" name="ans9" size="60" required></td>
            </tr>
            <tr>
                <td class="q">Q10:  What was the first cinema hall you have ever visited?</td>
            </tr>
            <tr>
                <td>Ans : <input type="text" name="ans10" size="60" required></td>
            </tr>
        </table>
        
        
        
                <br>
        <br>
           
        <centre>
            <div class="btn">
            <input type="submit" value="Submit" name="submit" class="submit" >
            </div>
        </centre>      
        
        </div>   
   </form>
    
    
    
        <div>
        <footer style="color:white" align="center" font-size:"20px"; marigin-bottom:"20px";>© 2018 CREDIT CARD FRAUDULENT CHECK. All rights reserved. Design by S2BPR</footer>
            </div>
</body>
</html>