<?php
        $con = mysqli_connect('localhost','root','root','unityproject');
        //check that connection happened
       if(mysqli_connect_errno())
       {
             echo "1: Connection failed";//error code#1 = connection failed
             exit();
       }
       $username = $_POST["name"];
       $password = $_POST["password"];
        
        //check if name exists
        $namecheckquery = "SELECT username, salt, hash, score FROM players WHERE username='" . $username . "';";
        $namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed"); //errer code#2 = name check query failed
  
        if (mysqli_num_rows($namecheck) !=1){
               echo "5: Either no user with name or more than one"; //error code #5 number of names matching !=1
               exit();
        }
         
        //get login info from query 
        $logininfo = mysqli_fetch_assoc($namecheck);
        $salt = $logininfo["salt"];
        $hash = $logininfo["hash"];
       
         $loginhash = crypt($password, $salt);
        if($hash != $loginhash){
                echo"6: Incorrect password";
                exit();
        }
       //deliver the success code and score
        echo "0"."\t" . $logininfo["score"];
       
        
?>