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

        <style>

            .innerright,label {
                color: blue;
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
                margin: auto;
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

            <div class="container" >

                <div class="row"><img class="imglogo" src="images/headpic.png" weight="100" height="150"/></div>
                
                <div class="innerdiv">

                    <h6><b>ADMIN</b></h6> 

                    <div class="leftinnerdiv">

                        <Button class="btn" onclick="openpart('addbook')" >ADD BOOK</Button>
                        <Button class="btn" onclick="openpart('bookreport')" > BOOK REPORT</Button>
                        <Button class="btn" onclick="openpart('bookrequestapprove')"> BOOK REQUESTS</Button>
                        <Button class="btn" onclick="openpart('addperson')"> ADD STUDENT</Button>
                        <Button class="btn" onclick="openpart('studentrecord')"> STUDENT REPORT</Button>
                        <Button class="btn"  onclick="openpart('issuebook')"> ISSUE BOOK</Button>
                        <Button class="btn" onclick="openpart('issuebookreport')"> ISSUE REPORT</Button>
                        <a href="Login.php"><Button class="btn" > LOGOUT</Button></a>

                    </div>

                    <div class="rightinnerdiv">   

                        <div id="bookrequestapprove" class="innerright portion" style="display:none">

                            <Button class="btn" >BOOK REQUEST APPROVE</Button>

                            <?php

                                $u=new data;
                                $u->setconnection();
                                $u->requestbookdata();
                                $recordset=$u->requestbookdata();

                                $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
                                padding: 8px;'>Person Name</th><th>person type</th><th>Book name</th><th>Days </th><th>Approve</th></tr>";
                                foreach($recordset as $row)
                                {
                                    $table.="<tr>";
                                    "<td>$row[0]</td>";
                                    "<td>$row[1]</td>";
                                    "<td>$row[2]</td>";

                                    $table.="<td>$row[3]</td>";
                                    $table.="<td>$row[4]</td>";
                                    $table.="<td>$row[5]</td>";
                                    $table.="<td>$row[6]</td>";
                                    $table.="<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'>Approved</a></td>";
                                    // $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
                                    $table.="</tr>";
                                    // $table.=$row[0];
                                }
                                $table.="</table>";

                                echo $table;
                            ?>

                        </div>

                    </div>

                    <div class="rightinnerdiv">   

                        <div id="addbook" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ echo "display:none";} else {echo ""; }?>">

                            <Button class="btn" >ADD NEW BOOK</Button>

                            <form action="addbookserver_page.php" method="post" enctype="multipart/form-data">
                                <br>
                                <label>Book Name:</label><input type="text" name="bookname"/>
                                <br>
                                <label>Detail:</label><input  type="text" name="bookdetail"/>
                                </br>
                                <label>Autor:</label><input type="text" name="bookaudor"/></br>
                                <label>Publication</label><input type="text" name="bookpub"/></br>
                                <div>Branch:<input type="checkbox" name="branch" value="it"/>IT<input type="checkbox" name="branch" value="civil"/> Civil<div style="margin-left:80px"><input type="checkbox" name="branch" value="ec"/>BS<input type="checkbox" name="branch" value="electrical"/>Electrical</div>
                                </div>   
                                <label>Price:</label><input  type="number" name="bookprice"/></br>
                                <label>Quantity:</label><input type="number" name="bookquantity"/></br>
                                <label>Book Photo</label><input  type="file" name="bookphoto"/></br>
                    
                                <input type="submit" value="SUBMIT">
                                <br>
                                </br>

                            </form>

                        </div>

                    </div>


                    <div class="rightinnerdiv"> 

                        <div id="addperson" class="innerright portion" style="display:none">

                            <Button class="btn" >ADD PERSON</Button>

                            <form action="addpersonserver_page.php" method="post" enctype="multipart/form-data">
                                <br>
                                <label>Name:</label><input type="text" name="addname"/></br>
                                <label>Pasword:</label><input type="pasword" name="addpass"/></br>
                                <label>Email:</label><input  type="email" name="addemail"/></br>
                                <label for="typw">Choose type:</label>
                                
                                <select name="type" >

                                    <option value="student">student</option>
                                    <option value="teacher">teacher</option>

                                </select>

                                <input type="submit" value="SUBMIT"/>
                                
                            </form>

                        </div>

                    </div>

                    <div class="rightinnerdiv">   

                        <div id="studentrecord" class="innerright portion" style="display:none">

                            <Button class="btn" >STUDENT RECORD</Button>

                            <?php

                                $u=new data;
                                $u->setconnection();
                                $u->userdata();
                                $recordset=$u->userdata();

                                $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
                                padding: 8px;'> Name</th><th>Email</th><th>Type</th><th>Delete</th></tr>";
                                foreach($recordset as $row){
                                    $table.="<tr>";
                                "<td>$row[0]</td>";
                                    $table.="<td>$row[1]</td>";
                                    $table.="<td>$row[2]</td>";
                                    $table.="<td>$row[4]</td>";
                                    $table.="<td><a href='deleteuser.php?useriddelete=$row[0]'>Delete</a></td>";
                                    $table.="</tr>";
                                    // $table.=$row[0];
                                }
                                $table.="</table>";

                                echo $table;

                            ?>

                        </div>

                    </div>

                    <div class="rightinnerdiv"> 

                        <div id="issuebookreport" class="innerright portion" style="display:none">

                            <Button class="btn" >ISSUE BOOK RECORD</Button>

                            <?php
                            
                                $u=new data;
                                $u->setconnection();
                                $u->issuereport();
                                $recordset=$u->issuereport();

                                $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
                                padding: 8px;'>Issue Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></th><th>Issue Type</th></tr>";

                                foreach($recordset as $row)
                                {
                                        $table.="<tr>";
                                        "<td>$row[0]</td>";
                                    $table.="<td>$row[2]</td>";
                                    $table.="<td>$row[3]</td>";
                                    $table.="<td>$row[6]</td>";
                                    $table.="<td>$row[7]</td>";
                                    $table.="<td>$row[8]</td>";
                                    $table.="<td>$row[4]</td>";
                                    // $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'>Return</a></td>";
                                    $table.="</tr>";
                                    // $table.=$row[0];
                                }
                                $table.="</table>";

                                echo $table;
                            ?>

                        </div>

                    </div>

        <!--issue book -->

                    <div class="rightinnerdiv">

                        <div id="issuebook" class="innerright portion" style="display:none">

                            <Button class="btn" >ISSUE BOOK</Button>

                            <form action="issuebook_server.php" method="post" enctype="multipart/form-data">
                                <br>
                                <label for="book">Choose Book:</label>
                                <select name="book" >
                                    <?php
                                        $u=new data;
                                        $u->setconnection();
                                        $u->getbookissue();
                                        $recordset=$u->getbookissue();
                                        foreach($recordset as $row)
                                        {

                                            echo "<option value='". $row[2] ."'>" .$row[2] ."</option>";
                                    
                                        }            
                                    ?>
                                </select>

                                <label for="Select Student">:</label>
                                <select name="userselect" >

                                    <?php
                                        $u=new data;
                                        $u->setconnection();
                                        $u->userdata();
                                        $recordset=$u->userdata();
                                        foreach($recordset as $row)
                                        {
                                            $id= $row[0];
                                            echo "<option value='". $row[1] ."'>" .$row[1] ."</option>";
                                        }            
                                    ?>

                                </select><br>

                                Days<input type="number" name="days"/>

                                <input type="submit" value="SUBMIT"/>

                            </form>

                        </div>

                    </div>

                    <div class="rightinnerdiv">   

                        <div id="bookdetail" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ $viewid=$_REQUEST['viewid'];} else {echo "display:none"; }?>">
                        
                        <Button class="btn" >BOOK DETAILS</Button></br>

                        <?php

                            $u=new data;
                            $u->setconnection();
                            $u->getbookdetail($viewid);
                            $recordset=$u->getbookdetail($viewid);

                            foreach($recordset as $row)
                            {

                                $bookid= $row[0];
                                $bookimg= $row[1];
                                $bookname= $row[2];
                                $bookdetail= $row[3];
                                $bookauthour= $row[4];
                                $bookpub= $row[5];
                                $branch= $row[6];
                                $bookprice= $row[7];
                                $bookquantity= $row[8];
                                $bookava= $row[9];
                                $bookrent= $row[10];

                            }            
                        ?>

                        <img width='150px' height='150px' style='border:1px solid #333333; float:left;margin-left:20px' src="uploads/<?php echo $bookimg?> "/></br>

                        <p style="color:black"><u>Book Name:</u> &nbsp&nbsp<?php echo $bookname ?></p>
                        <p style="color:black"><u>Book Detail:</u> &nbsp&nbsp<?php echo $bookdetail ?></p>
                        <p style="color:black"><u>Book Authour:</u> &nbsp&nbsp<?php echo $bookauthour ?></p>
                        <p style="color:black"><u>Book Publisher:</u> &nbsp&nbsp<?php echo $bookpub ?></p>
                        <p style="color:black"><u>Book Branch:</u> &nbsp&nbsp<?php echo $branch ?></p>
                        <p style="color:black"><u>Book Price:</u> &nbsp&nbsp<?php echo $bookprice ?></p>
                        <p style="color:black"><u>Book Available:</u> &nbsp&nbsp<?php echo $bookava ?></p>
                        <p style="color:black"><u>Book Rent:</u> &nbsp&nbsp<?php echo $bookrent ?></p>

                        </div>

                    </div>



                    <div class="rightinnerdiv">   

                        <div id="bookreport" class="innerright portion" style="display:none">

                            <Button class="btn" >BOOK RECORD</Button>

                            <?php

                                $u=new data;
                                $u->setconnection();
                                $u->getbook();
                                $recordset=$u->getbook();

                                $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
                                padding: 8px;'>Book Name</th><th>Price</th><th>Qnt</th><th>Available</th><th>Rent</th></th><th>View</th><th>Delete</th></tr>";
                                foreach($recordset as $row){
                                    $table.="<tr>";
                                "<td>$row[0]</td>";
                                    $table.="<td>$row[2]</td>";
                                    $table.="<td>$row[7]</td>";
                                    $table.="<td>$row[8]</td>";
                                    $table.="<td>$row[9]</td>";
                                    $table.="<td>$row[10]</td>";
                                    $table.="<td><a href='admin_service_dashboard.php?viewid=$row[0]'>View</a></td>";
                                    $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
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