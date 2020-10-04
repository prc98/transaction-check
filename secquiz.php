<html>
    <head>
        <title> Fraud Check
        </title>
    </head>
     <style>
        body{
            background-image: url(images/bg72.jpg);
        }
    
        .container{
            margin-left: 30%;
            margin-top: 10%;
            margin-top: 10%;
            background-color: rgba(0, 0, 0, 0.6);
            margin-right: 30%;
            color: azure;
            padding: 10px;
        }
        .btn
        {
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
        }
        .btn:hover {opacity: 1}
    
    </style>
    
    
    <script>
        
        function c(){
           
            var ques=[""," What was the first phone number you remember?",
                      " What is your favourite website?",
                      " How long was your first train journey?",
                      " What was the first story book you have read?",
                      " Name of the teacher you hated the most?",
                      " What was your first vacation spot?",
                      " What is the name of the first movie you have watched?",
                      " What was your first pocket money?",
                      " What is the best gift you have ever received?",
                      "  What was the first cinema hall you have ever visited?"];
        var arr=[];
   var flag=1;
        while(flag==1){
    arr[0]=Math.round(Math.random()*9)+1;
            arr[1]=Math.round(Math.random()*9)+1;
            arr[2]=Math.round(Math.random()*9)+1;
            if(arr[0]!=arr[1] && arr[1]!=arr[2] && arr[2]!=arr[0])
                {
                    flag=0;
                }
        }
       // alert(" x1="+arr[0]+" ,x2="+arr[1]+" ,x3="+arr[2]);
        
        document.getElementById('1').innerHTML="Q1. "+ques[arr[0]];
        document.getElementById('2').innerHTML="Q2. "+ques[arr[1]];
        document.getElementById('3').innerHTML="Q3. "+ques[arr[2]];
            
            
       document.getElementById('h1').value=arr[0];
        document.getElementById('h2').value=arr[1];
       document.getElementById('h3').value=arr[2];
                return true;
            }
    </script>
     <?php
       
               session_start();
    if(!isset($_SESSION['ccno']))
        header("location:home.php");
        // echo $_SESSION['ccno'];
    if(isset($_GET['s']))
    {
      
        $conn=mysql_connect("localhost","root","");
        if(!$conn)
        {
            die("could not connect".mysql_error());
        }
            mysql_select_db("userdb",$conn);
        
    //mysql_query("INSERT INTO clientinfo (CCN,Password) VALUES ('999','999')");
        if($_SERVER["REQUEST_METHOD"]=="GET")
        {
        $h1=$_GET['q1'];
        $h2=$_GET['q2'];
        $h3=$_GET['q3'];
        $ans1=$_GET['a1'];
        $ans2=$_GET['a2'];
        $ans3=$_GET['a3'];
        $ccno=$_SESSION['ccno'];
          
       // echo " ".$h1." ".$h2." ".$h3;
        $sqlstr= "select * from secquiz where userId = '$ccno'";
        $ret = mysql_query($sqlstr,$conn);
            
          while($rows = mysql_fetch_array($ret))
          {
              
              
              if(strcasecmp($rows[$h1],$ans1)==0 && strcasecmp($rows[$h2],$ans2)==0  && strcasecmp($rows[$h3],$ans3)==0 )
              {
                    header("location:tran.php");
              }
              else
              {
                  session_destroy();
                  $Message="Transaction not Successful";
                  header("Location: home.php?Message=" . urlencode($Message));
                  
              }
               
          }
            
                            
                            
     //  $q=mysql_query("SELECT * FROM clientinfo WHERE CCN='$name' ",$conn);      
            
    }        
}
        
        
        ?>
        
    <body
        onload ="c()">
        <form  name="abc" class="container">
             <p id="1" style="font-size:25px"> </p>
            <br>
            <input type = "text" name="a1" size="20" required>
            <p id="2" style="font-size:25px"> </p>
            <br>
            <input type = "text" name="a2" size="20" required>
            <p id="3" style="font-size:25px"> </p>
            <br>
            <input type = "text" name="a3" size="20" required>
            <br>
            <center>
            <input type = "submit" class="btn" name="s" value="Check"   size="20" style="margin-top:20px;">
                </center>
            <input type = "hidden" value="" id="h1" name="q1" size="20" >
            <input type = "hidden" id="h2" name="q2" size="20">
            <input type = "hidden" id="h3" name="q3" size="20">

        </form>
        
       
        <div>
        <footer style="color:white" align="center" font-size:"20px"; marigin-bottom:"20px";>© 2018 CREDIT CARD FRAUDULENT CHECK. All rights reserved. Design by S2BPR</footer>
            </div> 
        
    </body>
</html>