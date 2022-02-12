<?php

    session_start();

    $userloginid=$_SESSION["userid"] = $_GET['userlogid'];
    // echo $_SESSION["userid"];

?>


<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin Dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- <link rel="stylesheet" href="style.css"> -->

        <style>
            
            .innerright,label {
                 color: black;
                font-weight:bold;
            }
            .shape 
            {
                height: 100vh;
                width: 100%;
                background-image: url(images/background.png);
                background-position: center;
                background-size: cover;
                padding-left: 5;
                padding-right: 5;
                box-sizing: border-box;
                position: fixed;
            }
            .container,
            .row,
            .imglogo
            {
                margin:auto;
            }

            .innerdiv {
                text-align: center;
                /* width: 500px; */
                margin: auto;
            }
            input{
                margin-left:20px;
            }
            .leftinnerdiv {
                float: left;
                width: 25%;
            }

            .rightinnerdiv {
                float: right;
                width: 75%;
            }

            .innerright {
                background-color:skyblue;
            }

            .greenbtn {
                background-color: rgb(16, 170, 16);
                color: white;
                width: 95%;
                height: 40px;
                margin-top: 8px;
            }

            .greenbtn,
            a {
                text-decoration: none;
                color: white;
                font-size: large;
            }

            th{
                background-color: transparent;
                color: black;
            }
            td{
                background-color: transparent;
                color: black;
            }
            td, a{
                color:blue;
            }
            .logo{
                width: 160px;
                cursor: pointer;
            }
            .navbar{
                width: 100% ;
                height: 15vh;
                margin: auto;
                display: flex;
                align-items: center;
            }
            .btn
            {
                display: inline-block;
                background: linear-gradient(45deg, #87adfe, #ff77cd);
                border-radius: 6px;
                padding: 10px 20px;
                box-sizing: border-box;
                text-decoration: none;
                color: #fff;
                box-shadow: 3px 8px 22px rgba(94,28,68,0.15);  

                background-color: skyblue;;
                color:blue;
                width: 95%;
                height: 40px;
                margin-top: 8px;
            }

        </style>

    </head>
    
    <body>

        <?php
            include("data_class.php");
        ?>

        <div class="shape">

            <div class="navbar">

                <img src="images/Mainlogo.png" class="logo">

            </div>

            <div class="container">

                <div class="row"><img class="imglogo" src="images/headpic.png" weight="100" height="150"></div>

                <div class="innerdiv">
  
                    <div class="leftinnerdiv">
                        
                        <Button class="btn" onclick="openpart('myaccount')"> My Account</Button>
                        <Button class="btn" onclick="openpart('requestbook')"> Request Book</Button>
                        <Button class="btn" onclick="openpart('issuereport')"> Book Report</Button>
                        <a href="Login.php"><Button class="btn" > LOGOUT</Button></a>

                    </div>

                    <div class="rightinnerdiv">   

                        <div id="myaccount" class="innerright portion" style="<?php  if(!empty($_REQUEST['returnid'])){ echo "display:none";} else {echo ""; }?>">
                            <Button class="btn" >MY ACCOUNT</Button>

                            <?php

                                $u=new data;
                                $u->setconnection();
                                $u->userdetail($userloginid);
                                $recordset=$u->userdetail($userloginid);
                                foreach($recordset as $row)
                                {
                                
                                    $id= $row[0];
                                    $name= $row[1];
                                    $email= $row[2];
                                    $pass= $row[3];
                                    $type= $row[4];
                                
                                }
                                
                            ?>

                            <p style="color:blue"><u>Person Name:</u> &nbsp&nbsp<?php echo $name ?></p>
                            <p style="color:blue"><u>Person Email:</u> &nbsp&nbsp<?php echo $email ?></p>
                            <p style="color:blue"><u>Account Type:</u> &nbsp&nbsp<?php echo $type ?></p>
                    
                        </div>

                    </div>

                    <div class="rightinnerdiv"> 

                        <div id="issuereport" class="innerright portion" style="<?php  if(!empty($_REQUEST['returnid'])){ echo "display:none";} else {echo "display:none"; }?>">

                            <Button class="btn" >ISSUE RECORD</Button>

                            <?php

                                $userloginid=$_SESSION["userid"] = $_GET['userlogid'];
                                $u=new data;
                                $u->setconnection();
                                $u->getissuebook($userloginid);
                                $recordset=$u->getissuebook($userloginid);

                                $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
                                padding: 8px;'>Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></th><th>Return</th></tr>";

                                foreach($recordset as $row)
                                {
                                    $table.="<tr>";
                                "<td>$row[0]</td>";
                                    $table.="<td>$row[2]</td>";
                                    $table.="<td>$row[3]</td>";
                                    $table.="<td>$row[6]</td>";
                                    $table.="<td>$row[7]</td>";
                                    $table.="<td>$row[8]</td>";
                                    $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'>Return</a></td>";
                                    $table.="</tr>";
                                    // $table.=$row[0];
                                }
                                $table.="</table>";

                                echo $table;
                            ?>

                        </div>

                    </div>


                    <div class="rightinnerdiv">   

                        <div id="return" class="innerright portion" style="<?php  if(!empty($_REQUEST['returnid'])){ $returnid=$_REQUEST['returnid'];} else {echo "display:none"; }?>">

                            <Button class="btn" >RETURN BOOK</Button>

                            <?php

                                $u=new data;
                                $u->setconnection();
                                $u->returnbook($returnid);
                                $recordset=$u->returnbook($returnid);
                            ?>

                        </div>

                    </div>


                    <div class="rightinnerdiv">   

                        <div id="requestbook" class="innerright portion" style="<?php  if(!empty($_REQUEST['returnid'])){ $returnid=$_REQUEST['returnid'];echo "display:none";} else {echo "display:none"; }?>">

                            <Button class="btn" >REQUEST BOOK</Button>

                            <?php

                                $u=new data;
                                $u->setconnection();
                                $u->getbookissue();
                                $recordset=$u->getbookissue();

                                $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr>
                                <th>Image</th><th>Book Name</th><th>Book Authour</th><th>branch</th><th>price</th></th><th>Request Book</th></tr>";

                                foreach($recordset as $row){
                                    $table.="<tr>";
                                "<td>$row[0]</td>";
                                $table.="<td><img src='uploads/$row[1]' width='100px' height='100px' style='border:1px solid #333333;'></td>";
                                $table.="<td>$row[2]</td>";
                                    $table.="<td>$row[4]</td>";
                                    $table.="<td>$row[6]</td>";
                                    $table.="<td>$row[8]</td>";
                                    $table.="<td><a href='requestbook.php?bookid=$row[0]&userid=$userloginid'>Request Book</a></td>";
                                    $table.="</tr>";
                                    // $table.=$row[0];
                                }
                                $table.="</table>";

                                echo $table;

                            ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <script>

            function openpart(portion) 
            {
                var i;
                var x = document.getElementsByClassName("portion");
                for (i = 0; i < x.length; i++) 
                {
                    x[i].style.display = "none";  
                }
                document.getElementById(portion).style.display = "block";  
            }
        
        </script>

    </body>
    
</html>