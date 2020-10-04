<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>UI Card Payment Flat Responsive Widget Template :: w3layouts</title>
<link href="style.css" rel="stylesheet" type="text/css" media="all" />
<link href="font-awesome.css" rel="stylesheet"> <!-- font-awesome icons -->
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Lobster+Two:400,400i,700,700i" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'> 
<!-- //web font -->
</head>
  
    <?php
       session_start();
     if($_SESSION['y']!=10)
       header("location:home.php");
    if(isset($_POST['s2']))
    {     
                   
        $conn=mysql_connect('localhost','root','');
        if(!$conn)
        {
            
            die('could not connect: '.mysql_error());
        }
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            
            $ccno=$_SESSION['x'];
            $name=$_POST['name'];
            $date=$_POST['date'];
            $cvv=$_POST['cvv'];
            $amt=$_POST['amt'];
            $item=$_POST['item'];
            mysql_select_db("bankdb");
        //  $sqlstr = "INSERT INTO ccdetail VALUES('$ccno','$name','$date','$cvv')";
           $sqlstr = "Select * from ccdetail where (ccno='$ccno' AND name='$name' AND date= '$date' AND cvv='$cvv')";
            $ret = mysql_query($sqlstr,$conn);
            if($ret)
            {
                
                $coun=mysql_num_rows($ret);
                if($coun==0)
                {
                    $text=12;
                     
                    echo '<script language="javascript"> alert("NOT a Valid card")
                    </script>';
                   // echo 'alert("NOT a Valid card")';
                //    echo '</script>'; 
                   //header("Location:Payment.php");
                }
                else 
                {
                    $text=11;
                    if (fraudcheck($amt,$item,$ccno))
                    {
                         if(!isset($_SESSION['item']) && !isset($_SESSION['amt']) && !isset($_SESSION['ccno']))
                                        {
                                            $_SESSION['item']=$item;
                                            $_SESSION['amt']=$amt;
                                            $_SESSION['ccno']=$ccno;
                                         
                                        }
                          header("Location:secquiz.php");
                    }
                    else
                    {
                        
                                        if(!isset($_SESSION['item']) && !isset($_SESSION['amt']) && !isset($_SESSION['ccno']))
                                        {
                                            $_SESSION['item']=$item;
                                            $_SESSION['amt']=$amt;
                                            $_SESSION['ccno']=$ccno;

                                        }
                                     header("Location:tran.php");

                        
                    }
                }
                
            }
            else
            {
                echo "".mysql_error();
            }
        }
    
    }
    function fraudcheck($amt,$item,$ccno)
    {
        //echo $amt." ".$item."<br> ";
            $conn=mysql_connect('localhost','root','');
            $sqlstr = "select * from transactions where item = '$item' AND ccno='$ccno'";
            mysql_select_db("bankdb");
           $ret = mysql_query($sqlstr,$conn);
            if(mysql_num_rows($ret))
            {
               $p=item_exist($ccno,$amt,$item);
            }
            else 
            {
                $p=new_item($ccno,$amt);
                
            }
        return $p;
        /*if($ret)
        {
            while($row = mysql_fetch_array($ret)) {}
			
        }
        return true;  */
    }
    
    
    function item_exist($ccno,$amt,$item)
    {
       // echo $avg;
        //}
        $conn=mysql_connect('localhost','root','');
         mysql_select_db("bankdb");
       
            $sqlstr = "select * from transactions where item = '$item' AND ccno='$ccno' ";
           $ret = mysql_query($sqlstr,$conn);
       $num = mysql_num_rows($ret);   
       // $num1=round($num*0.6);
        $num2=1;
        $i=0;$sum=0;$diff=0;
        $d = array();
        while($row=mysql_fetch_array($ret))
        {
            $i++;
            if($i>=$num2)
            {
                $sum+=$row[2];
                $d[]=$row[3];
            }
            
        }
        $num2=$num-$num2+1;
        //echo $num2;
       // echo $num2;
      //  echo $d[4]." ";
        for($i=0;$i<$num2-1;$i++)
        {
           $dd=abs(strtotime($d[$i+1])-strtotime($d[$i]))/(60*60*24);
           // echo $dd." ";
            $diff+=$dd;
        }
        $avd=$diff/($num2-1);
       
       $fdiff= abs(strtotime(date("Y-m-d"))-strtotime($d[$num2-1]))/(60*60*24);
           //    echo $d[0]."<br>";
// echo $fdiff;
        $avg1=$sum/$num2;
       // echo $amt;
        $avg2=($sum+$amt)/($num2+1);
       // echo $avg1." ".$avg2."<br>";
        $dev = abs($avg2-$avg1);
        //echo $dev." ";
       // $devp = ($dev/$avg1)*100;
        $devd=0;$fdevd=0;
       
            
            $devd = abs(($avd-$fdiff)/$avd)*100;
      //  echo $avd." ";
            $fdevd = ($devd/100) * $avg1;
            
        if($avg1>$avg2 && $fdiff<$avd )
             $fdev =  $fdevd * 0.2; //if the amt is within range or < than lower limit of range, deviation is calculated                                based on date
        else if($avg1<$avg2 && $fdiff<$avd)
        $fdev = $dev * 0.8 + $fdevd * 0.2;
        else if($avg1<$avg2 && $fdiff>=$avd)
            $fdev =  $dev * 0.8;
        else
        {
            if($fdiff)
            {
                if($amt<=(0.4*$avg1))
                    $fdev=$amt;
                else
             $fdev = $dev *0.5 + $fdevd *0.5;
            }
            else
            $fdev = $dev + $fdevd *0.3;
        }
        $fdevp= ($fdev/$avg1)*100;
      //  echo $fdevp;
      //  echo $devp;
       if($fdevp<=20)
           return false;
        else
            return true;
       // echo $avg;
        //}
    }
    
    function new_item($ccno,$amt)
    {
        $conn=mysql_connect('localhost','root','');
         mysql_select_db("bankdb");
            $sqlstr = "select * from transactions where ccno='$ccno'";
           $ret = mysql_query($sqlstr,$conn);
       $num = mysql_num_rows($ret);   
      //  $num1  = ceil($num*0.6);
      //  $num2=round($num-$num1);
         $num2=1;
        $i=0;$sum=0;$diff=0;
        $d = array();
        while($row=mysql_fetch_array($ret))
        {
            $i++;
            if($i>=$num2)
            {
                $sum+=$row[2];
                $d[]=$row[3];
            }
            
        }
        $num2=$num-$num2+1;
        //echo $num2;
       // echo $num2;
      //  echo $d[4]." ";
        for($i=0;$i<$num2-1;$i++)
        {
           $dd=abs(strtotime($d[$i+1])-strtotime($d[$i]))/(60*60*24);
           // echo $dd." ";
            $diff+=$dd;
        }
        $avd=$diff/($num2-1);
       
       $fdiff= abs(strtotime(date("Y-m-d"))-strtotime($d[$num2-1]))/(60*60*24);
        //       echo $fdiff."<br>";
// echo $fdiff;
        $avg1=$sum/$num2;
     //   echo $amt;
        $avg2=($sum+$amt)/($num2+1);
       //echo $avg1." ".$avg2."<br>";
        $dev = abs($avg2-$avg1);
        //echo $dev." ";
       // $devp = ($dev/$avg1)*100;
        $devd=0;$fdevd=0;
       
            
            $devd = abs(($avd-$fdiff)/$avd)*100;
      //  echo $avd." ";
            $fdevd = ($devd/100) * $avg1;
            
        if($avg1>$avg2 && $fdiff<$avd )
             $fdev =  $fdevd * 0.2; //if the amt is within range or < than lower limit of range, deviation is calculated                                based on date
        else if($avg1<$avg2 && $fdiff<$avd)
        $fdev = $dev * 0.8 + $fdevd * 0.2;
        else if($avg1<$avg2 && $fdiff>=$avd)
            $fdev =  $dev * 0.8;
        else
        {
            if($fdiff)
            {
                if($amt<=(0.3*$avg1))
                    $fdev=$amt;
                else
                    $fdev = $dev *0.5 + $fdevd *0.5;
            }
        
             
            else
            $fdev = $dev+$fdevd*0.2;
        }
        $fdevp= ($fdev/$avg1)*100;
      //  echo $fdevp;
      //  echo $devp;
       if($fdevp<=20)
           return false;
        else
            return true;
       // echo $avg;
        //}
    }
    ?>
    

<body>
	<!-- main -->
	<div class="mainw3 agile">
		<h1>Enter payment details</h1>
		<div class="main-agileinfo">
			<div class="w3pay-right">
					<form action="#" method="post"> 
						<div class="card-details" style="color:#FFF">
                            Name Of Bank :
                            <select>
                            <option>SBI</option>
                            <option>BOI</option>
                            <option>HDFC</option>
                            </select>
							<br><br>
							Name On Card :
							<input type="text" name="name" placeholder="Name On Card" required=""/> <br><br>
                            Card Number: &nbsp
                            <input type="text" name="ccno" placeholder="0000 0000 0000 0000" disabled required="" value="<?php if(isset($_SESSION['x'])) echo $_SESSION['x']?>"/><br><br>
								Expiration Date :<input type="text" name="date" maxlength="7" placeholder="mm/yyyy" required="" size="3"/>&nbsp &nbsp
								CVV :
								<input type="text" name="cvv" placeholder="XXX" maxlength="3" size="3" required=""/><br><br>
                                Amount : 
                               <input type="number" name="amt" placeholder="$$$$"/>
                                &nbsp &nbsp
                                Category : 
                                <select name="item">
                                    <option value="1">1-Electronics</option>
                                    <option value="2">2-Groceries</option>
                                    <option value="3">3-Bill Payment</option>
                            </select>
                               <br><br>
							<div class="clear">	</div>		
						</div>
						<input type="submit" value="Pay Now" name="s2"> 
                </form>  
			</div>	
			<div class="clear">	</div>		
		</div>	
	</div>	
    
	<!-- //main -->
	<!-- copyright -->
	
        <div>
        <footer style="color:white" align="center" font-size:"20px"; marigin-bottom:"20px";>© 2018 CREDIT CARD FRAUDULENT CHECK. All rights reserved. Design by S2BPR</footer>
            </div>
    </body>    
</html>