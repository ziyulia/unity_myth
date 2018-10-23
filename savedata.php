<?php
        $con = mysqli_connect('localhost','root','root','unityproject');
        //check that connection happened
       if(mysqli_connect_errno())
       {
             echo "1: Connection failed";//error code#1 = connection failed
             exit();
       }
       $username = $_POST["name"];
       $newscore = $_POST["score"];
        
        //double check if name exists
        $namecheckquery = "SELECT username FROM players WHERE username='" . $username . "';";
        $namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed"); //errer code#2 = name check query failed
  
        if (mysqli_num_rows($namecheck) !=1){
               echo "5: Either no user with name or more than one"; //error code #5 number of names matching !=1
               exit();
        }
        
        $updatequery = "UPDATE players SET score = " . $newscore . " WHERE username = '" . $username . "';";
        mysqli_query($con, $updatequery) or die("7: save query failed"); 
     
        echo "0";
       
        
?>