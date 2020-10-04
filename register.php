
<!DOCTYPE html>
<html>
<head>
<title>Registration</title>

<link href="style1.css" rel="stylesheet"><!--online_fonts-->
</head>
    <?php
    session_start();
if(isset($_POST['done'])){
    $con=mysql_connect('localhost','root','');
    if(!$con)
    {
        die('could not connect: '.mysql_error());
    }
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $ccnum=$_POST['cc'];
        $paswd=$_POST['pw'];
        $cpwd=$_POST['pw2'];
        $email=$_POST['email'];
        $country=$_POST['coun'];
        $state=$_POST['state'];
        $phone=$_POST['ph1'];
        $altno=$_POST['ph2'];
        $gender=$_POST['a'];
        $date=$_POST['dob'];
        
      //  $cc=$_POST['cc'];
        $_SESSION['d']=$ccnum;
        
        $per="insert into clientinfo  values('$ccnum','$paswd','$cpwd','$email','$country','$state','$phone','$altno','$gender','$date') "; //clientinfo is my table name in userdb//
        mysql_select_db("userdb"); // userdb is my database//
        $res=mysql_query($per,$con);
        if(!$res)
            die('could not enter daata'.mysql_error());
        else
        {
            header("location:security.php");
            
        }
    }
}
    ?>
<body>
<h1>Sign Up</h1>
<div class="main">


<div class="form">
<form  method="post" name="regs">
<aside>
<div class="mid">
<h3 style="font-size: 20px; text-align: center">Your details</h3>
    <hr>
		
        <div>
            <span class="spa">
            <label class="box">Credit Card no :</label>
            
                             <label><input type="text" id="c" required="put 16 digit card no" name="cc" min="16" maxlength="16" onfocusout="check1()"></label>
                   </span>
            <span id="msg1" style="color:white"></span>
            
        </div>
	
		<div class="boxname">
            <span class="spa">
		<label class="box">Password :</label>
			
                <label><input type="password" name="pw" id="" placeholder="" required=" "  onfocusout="check2()"/></label>
            </span>
		</div>
	
    <div class="boxname">
            <span class="spa">
		<label class="box">Confirm Password :</label>
			
                <label><input type="password" name="pw2" id="c" placeholder="" required=" " onfocusout="check2()"/></label>
            </span>
		</div>
    		
	
		<div class="boxname">
            <span class="spa">
			<label class="box">Email :</label>
			
                <lable><input type="email" name="email" placeholder="enter your e-mail" required="" onfocusout="check3()"/></lable>
			</span>
		</div>
    
		<div class="boxname">
			<span class=spa><label class="box">Country :</label>
			
				<select name="coun" onchange="upda()">
                    <option>Select</option>
                    <option>Afghanistan</option>
                    <option>Brazil</option>
                    <option value="1">India</option>
                    <option value="2">Nepal</option>
                    <option>Spain</option>
                    <option>USA</option>
                </select>
                

		
            <label class="box" >State :</label>
			     
				<select name="state" id="s">
                    <option>Select</option>
                    <option id="1"></option>
                    <option id="2"></option>
                    <option id="3"></option>
                     </select>
                
            </span>

		</div>
    <div>
		<span class="spa">
		<label class="box">Phone No :</label>
		
            <label><input type="text" name="ph1" pattern="[6789][0-9]{9}" placeholder="" required=" " maxlength="10"/></label>
                </span>
            
            </div>
    <div>
        <span class="spa">
		<label class="box">Alternate Phone :</label>
		<label>	
			<input type="text" name="ph2"  placeholder="" pattern="[6789][0-9]{9}" required=" " maxlength="10" onfocusout="check4()"/>
		</label>
    </span>
    </div>
	
    <div>
        <span class="spa">
		<label class="box">Gender :</label>	
			<label class="gen" style="color: white;">
                <input type="radio" name="a" value="male" checked>Male
                <input type="radio" name="a" value="female">Female
                <input type="radio" name="a" value="other">Other  
        </label>
        </span>
    </div>
	    <div >
            <span class="spa">
			   <label class="box">Date Of Birth :</label>
			    <label><input type="date" name="dob" placeholder=""  required="" onfocusout="check5()" /></label>
            </span>
		</div>
<center>
	<div class="btn">
		<input type="submit" value="s" class="submit" name="done" >
	</div>
    </center>
</div>
    </aside>
    </form>
</div>
 </div>

        <div>
        <footer style="color:white" align="center" font-size:"20px"; marigin-bottom:"20px";>© 2018 CREDIT CARD FRAUDULENT CHECK. All rights reserved. Design by S2BPR</footer>
            </div>
</body>
</html>
    <script>
        function upda()
        {
            var x = document.regs.coun
           var o
            if(x.value=="1")
            {
                for(var i =1;i<=3;i++)
                    {
                    o= document.getElementById(i)
	           //var op=o.options[o.selectedIndex]
                        if(i==1)
                    o.text="Westbengal"
                        if(i==2)
                        o.text="Maharashtra"
                        if(i==3)
                            o.text="Bihar"
                    }
           }
            if(x.value=="2")
                {
                    for(var i =1;i<=3;i++)
                    {
                    o= document.getElementById(i)
	           //var op=o.options[o.selectedIndex]
                        if(i==1)
                    o.text="Lhotse"
                        if(i==2)
                        o.text="Makalu"
                        if(i==3)
                            o.text="Cho Oyu"
                    }
                }

        }
    
         function check1()
        {
             var reg=/^[0-9]+$/;
            var p1=document.getElementById('c').value;
            if(!p1.match(reg) || p1.length!=16 )
            {
                document.getElementById('msg1').innerHTML="invalid CC no";
                
            
                       // alert("CCno. length should be 16");
                        document.getElementById('c').focus();
                        document.getElementById('c').value="";
                return false;
             }
        else
            {
                document.getElementById('msg1').innerHTML="";
                return false;
            }
        // var p1=document.getElementById('c').value;
        }
        function check2()
        {
             var p1=document.regs.pw.value;
                 var x= p1.indexOf(' ');
                if(p1!="" && x>=0)
                {
                    alert("space detected");
                    
                   document.regs.pw.value="";
                     document.regs.pw.focus();
                    return false;
                }
            
            var p=document.regs.pw
            var p2=document.regs.pw2
        if(p2.value!=""  && p.value!=p2.value)
        {
            alert("opps pasword dont match");
            p2.focus();
            p2.value=""
        }
        }
        function check3()
        {
            var p=document.regs.email.value;
            var a=p.indexOf("@");
            
            if(p!="" && p.indexOf(".",a)<0)
            {
                alert("Incorrect Email");
                document.regs.email.value="";
                 document.regs.email.focus();
            }
                
            
        }
        function check4()
        { 
           var  p=document.regs.ph1;
            var q=document.regs.ph2;
            if(q.value !="" && p.value==q.value)
            {
                alert("Enter different");
                q.value=""
                q.focus();
            
            }
      
     }
        
    
    
    
    </script>

