<!DOCTYPE html>

<html lang="en">

    <head>
        <title>Form Title</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script
            src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    <style>
    div {
        border-width: 0px;
        border-style: ridge;
        border-color: red;
        }


        </style>

    <body>

        <div class="container-fluid">

            <div class="row">
                <div class="col-4"></div>
                <div class="col-4 bg-">
                    <h2>Profile</h2>
                    <form action="insert.php" method="POST"
                        class="was-validated" name="myform" >
         
                        <?php
                      
                         $id = $_REQUEST['id'];
                         $con=mysqli_connect('localhost','root','','documents');
                         $sql = "SELECT * FROM `data` WHERE `id`='$id'";
                         $query = mysqli_query($con , $sql);

                         while($row = mysqli_fetch_array($query)){}
                      
                      ?>
                        <div class="form-group">
                            <input type="text" name="id" value="<?php echo $row[0]; ?>" hidden>
                            <label for="name">Name:</label>

                            <input type="text" class="form-control" id="name"
                                placeholder="Enter Name" name="name" value="<?php echo $row[1]; ?>" onblur = "validatename(this.value)">
                                <span id="message" style="color:red"></span>
                        </div>

                        <div class="form-group">
                            <label for="email">E-Mail</label>
                            <input type="email" class="form-control" id="email"
                                placeholder="Enter EMail" name="email" value="<?php echo $row[2]; ?>">
                                <span id="messageemail" style="color:red"></span>
                        </div>


                       <div class="form-group">

        <script>  
        function validateform()
        {  
            document.getElementById("message").innerHTML="";
            document.getElementById("messageemail").innerHTML="";
        var name=document.myform.name.value;  
        var x=document.myform.email.value;  
        var atposition=x.indexOf("@");  
        var dotposition=x.lastIndexOf("."); 
        var a=document.getElementById("mobile").value; 
        
            if (name==null || name==""){  
                document.getElementById("message").innerHTML="**Please input name field"; 
                return false;  

                } 

            
            if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
                document.getElementById("messageemail").innerHTML="**Please enter a valid e-mail address \n such as 'example@gmail.com'";
                //alert("Please enter a valid e-mail address \n atpostion:"+atposition+"\n dotposition:"+dotposition);  
                return false;  
        }  
        if (a==""){
                    document.getElementById("messagemobile").innerHTML="**Please input the mobile no";
                    return false;
                }
                if (isNaN(a)){
                    document.getElementById("messagemobile").innerHTML="Only numeric values are allowed";
                    return false;
                }
                if (a.length<10){
                    document.getElementById("messagemobile").innerHTML="**Mobile Number must be 10 digits";
                    return false;
                }
                if (a.length>10){
                    document.getElementById("messagemobile").innerHTML="**Mobile Number must be 10 digits";
                    return false;
                }

                if ((a.charAt(0)!=9) && (a.charAt(0)!=8) && (a.charAt(0)!=7) && (a.charAt(0)!=6)){
                    document.getElementById("messagemobile").innerHTML="**'9','8' ,'7' digits are allowed on first";
                    return false;
                }
        }

        </script>  




                            <label for="mobile">Mobile</label>
                            <input type="text" class="form-control" id="mobile"
                                placeholder="Enter Mobile No" name="mobile" value="<?php echo $row[3]; ?>">
                                <span id="messagemobile" style="color:red"></span><br>
                        </div>

                        <button type="submit" name="insert" class="btn
                            btn-primary" onclick="return validateform()">Insert</button>

                        <button type="submit" name="search" class="btn
                            btn-success">Search</button>

                            <?php
                           
                           mysqli_close($con);
                        ?>
                    </form>
                </div>
                <?php



                    $con=mysqli_connect('localhost','root','','documents');
                    if(isset($_POST['insert'])){
                    $id= $_POST['id'];
                    $name=$_POST['name'];
                    $email=$_POST['email'];
                    $mobile= $_POST['mobile'];
                    $q="insert into data (id,name,email,mobile) values
                    ('$id','$name','$email','$mobile')" ;
                    mysqli_query($con,$q);
                    echo" <p style='color:green;'>Inserted Successfully.</p>" ;
                    }
                    ?>
                    <div class="col-4"></div>
                </div>

                <div class="row">
                    &nbsp; </div>

              

                        <table class="table">
                            <thead>
                                <tr class="thead-dark">
                                <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Operations</th>

                                </tr>
                            </thead>
                            <tbody>


                                <?php
                                    
                                    //select query-----------
                                    $query="select * from `data`" ;
                                    $result=mysqli_query($con,$query);
                                    while($row= mysqli_fetch_array($result)){
                                    $id=$row['id'];
                                    $name=$row['name'];
                                    $email=$row['email'];
                                    $mobile=$row['mobile'];
                                    echo '<tr>
                                    <td>'.$id.'</td>
                                    <td>'. $name .'</td>
                                    <td>' .$email .'</td>
                                    <td>' .$mobile .'</td>
                                    <td>
                                    <button class="btn btn-warning mr-1"><a class="text-light" href="insert.php?id='.$row['id'].'">Update</a></button>
                                    <button class="btn btn-danger "><a class="text-light" href="insert.php?delete='.$row['id'].'">Delete</a></button></td>
                                    
                                </tr>';
                                }
                                ?>

                                    <?php
                                    if(isset($_POST['update'])){
                                        $sql = "UPDATE `data` SET `name`='$name' , `email` = '$email',`mobile`='$mobile' WHERE `id`='$id'";

                                        mysqli_query($con , $sql);
                                        echo "Updated Successfully.";
                                        //header("location:localhost:8080/myapp/data.php");
                                    }
                                    ?>

                                <?php

                                    //delete query--------------
                                    
                                    if(isset($_GET['delete'])){
                                        $del_id=$_GET['delete'];
                                        $sql="DELETE FROM `data` WHERE
                                        `id`='$del_id'" ;
                                        $result=mysqli_query($con , $sql);
                                        if($result){
                                        echo "<p style='color:red;'>Deleted Successfully</p>";
                                          //header('Location:insert.php');
                                    }else{
                                        echo "none" ;
                                    }
                                    }
                                ?>

                                </tbody>
                            </table>
                
                </div>



            </body>
        </html>
