<?php
        $con = mysqli_connect('localhost','root','root','unityproject');
        //check that connection happened
       if(mysqli_connect_errno())
       {
             echo "1: Connection failed";//error code#1 = connection failed
             exit();
       }
       //get the name and password from unity
       $username = $_POST["name"];
       $password = $_POST["password"];
        
        //check if name exists
        $namecheckquery = "SELECT username FROM players WHERE username='" . $username . "';";
        $namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed"); //errer code#2 = name check query failed
  
        if (mysqli_num_rows($namecheck) > 0){
               echo "3: Name already exists"; //error code #3 - name exists cannot register
               exit();
        }
         
        //add user to the table and transfer the password into hush and salt
        $salt = "\$5\$rounds=5000\$" . "beautiful426" . $username . "\$";
        $hash = crypt($password, $salt);
        $insertuserquery = "INSERT INTO players (username, hash, salt) VALUES ('" . $username . "', '" . $hash . "', '" . $salt . "');";
        mysqli_query($con, $insertuserquery) or die("4: insert player query failed");
    
        echo("0");
        
?>