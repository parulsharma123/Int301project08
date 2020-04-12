<style>

* {
    margin: 0;
    padding: 0;
}

*,
*::after,
*::before {
    -webkit-box-sizing: inherit;
            box-sizing: inherit;
}

html {
    font-size: 62.5%;
    -webkit-box-sizing: border-box;
            box-sizing: border-box;
    width: 100%;
}

body {
    font-size: 1.6rem;
   
    width: 100%;
}

.content {
    width: 40%;
    margin-left: 30%;
    background-color: #fff;
    padding: 9rem 0rem;
}

@media only screen and (max-width: 1000px) {
    .container {
        width: 100vw;
        height: 100vh;
        background-color: #E5E5E5;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }
    
    .content {
        width: 100%;
        margin-left: 0%;
        background-color: #fff;
        padding: 3rem 1rem;
    }
}

.heading {
    text-transform: uppercase;
    font-weight: 100;
    font-size: 3rem;
    letter-spacing: 2px;
    text-align: center;
    color: #777;
}

.heading::after {
    content: "";
    display: block;
    width: 10rem;
    height: 3px;
    background-color: red;
    margin-left: calc( 50% - 5rem );
    margin-top: 2rem;
    margin-bottom: 2rem;
}

.input-box {
    width: 100%;
    
}

.input-control {
    padding: 1rem 1.5rem;
    width: 100%;

    margin: 1rem 0;
    outline: none;
    border: none;
    border-radius: 10rem;
    border: 1px solid #E5E5E5;
    font-size: 1.6rem;
}

.input-control:focus {
    border: 1px solid red;
}


.input-submit {
    color: #fff;
    background-color: red;
    border-radius: 10rem;
    border: none;
    outline: none;
    width: 100%;
    padding: 1rem 1.5rem;
    margin-top: 2rem;
}




.error {
    color: red;
    font-size: 1.4rem;
    margin-left: 1.5rem;
}




  .box {
  position: relative;
  top: 25%;
  left: 25%;
  transform: translate(-24%, 10%);
     
}
    


</style>
<?php
include('database.php');
session_start();
?>  


<html>
<body>
<div class="container">
        <div class="content">
            <h2 class="heading">Sign Up</h2>
            <?php
                if(isset($_POST['sign-up'])) {
                    $first_name     = mysqli_real_escape_string($conn,$_POST['first_name']);
                    $user_name      = mysqli_real_escape_string($conn,$_POST['user_name']);
                    $user_email     = mysqli_real_escape_string($conn,$_POST['user_email']);
                    $user_pass      = mysqli_real_escape_string($conn,$_POST['user_password']);
                    $user_con_pass  = mysqli_real_escape_string($conn,$_POST['user_confirm_password']);
                    
                     $uname = htmlentities($_POST['first_name']);
         

                    $_SESSION['first_name'] = $first_name;
                   
                    $pattern_fn = "/^[a-zA-Z ]{3,12}$/";
                    if(!preg_match($pattern_fn, $first_name)) {
                        $errFn = "Must be at lest 3 character long, letter and space allowed";
                    }
                   
					
                    $pattern_un = "/^[a-zA-Z0-9_]{3,16}$/";
                    if(!preg_match($pattern_un, $user_name)) {
                        $errUn = "Must be at lest 3 character long, letter, number and underscore allowed";
                    } else {
                        $query = "SELECT * FROM prm WHERE user_name = '$user_name'";
                        $query_con = mysqli_query($conn, $query);
                        if(!$query_con) {
                            die("Query Failed" . mysqli_error($conn));
                        }
                        $count = mysqli_num_rows($query_con);
                        if($count == 1) {
                            $errUn = "User name not available pick new one";
                       }
                    }
                   
                    $pattern_ue = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i";
                    if(!preg_match($pattern_ue, $user_email)) {
                        $errUe = "Invalid format of email";
                    } else {
                        $query = "SELECT * FROM prm WHERE user_email = '$user_email'";
                        $query_con = mysqli_query($conn, $query);
                        if(!$query_con) {
                            die("Query Failed" . mysqli_error($conn));
                        }
                        $count = mysqli_num_rows($query_con);
                        if($count == 1) {
                            $errUe = "Email already exists";
                        }
                    }
                    if($user_pass == $user_con_pass) {
                        $pattern_up = "/^.*(?=.{4,56})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$/";
                        if(!preg_match($pattern_up, $user_pass)) {
                            $errPass = "Must be at lest 4 character long, 1 upper case, 1 lower case letter and 1 number exist";
                        }
                    } else {
                        $errPass = "Password dosen't matched";
                    }
                    if(!isset($errFn) && !isset($errLn) && !isset($errUn) && !isset($errUe) && !isset($errPass) && !isset($errCaptcha)) {
                        $hash = sha1($user_pass);
                        {
                            $query = "INSERT INTO prm (first_name, user_name, user_email, user_password) VALUES ('$first_name', '$user_name', '$user_email', '$hash')";
                            $query_conn = mysqli_query($conn, $query);
                            
                         
                            
                            
                            if(!$query_conn) {
                                die("Query failed" . mysqli_error($conn));
                            } else {
                                
                            
                                
                                
                                echo "<div class='notification'>Register successful.</div>";
                                unset($first_name);
                                unset($user_type);
                                unset($user_name);
                                unset($user_email);
                                
                                
                            
                           header("Location:welcome.php");
                           
                                
                                
                            }
                        } 
                    }
                }

            ?>
           
            <form action="sign_up.php" method="POST">
          
               
            
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="First name" value="<?php echo isset($first_name)?$first_name:""; ?>" name="first_name" autocomplete="off">
                    <?php echo isset($errFn)?"<span class='error'>{$errFn}</span>":""; ?>
                </div>
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="Username" value="<?php echo isset($user_name)?$user_name:""; ?>"  name="user_name" autocomplete="off">
                    <?php echo isset($errUn)?"<span class='error'>{$errUn}</span>":""; ?>
                </div>
                <div class="input-box">
                    <input type="email" class="input-control" placeholder="Email address" value="<?php echo isset($user_email)?$user_email:""; ?>"  name="user_email" autocomplete="off">
                    <?php echo isset($errUe)?"<span class='error'>{$errUe}</span>":""; ?>
                </div>
                <div class="input-box">
                    <input type="password" class="input-control" placeholder="Enter password" name="user_password" autocomplete="off">
                    <?php echo isset($errPass)?"<span class='error'>{$errPass}</span>":""; ?>
                </div>
                <div class="input-box">
                    <input type="password" class="input-control" placeholder="Confirm password" name="user_confirm_password" autocomplete="off">
                    <?php echo isset($errPass)?"<span class='error'>{$errPass}</span>":""; ?>
                </div>
               
                <div class="input-box">
                    <input type="submit" class="input-submit" value="SIGN UP" name="sign-up">
                </div>
               
            </form>
        </div>
    </div>

    
      
    </body>



</html>
