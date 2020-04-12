<?php
include('database.php');
// Initialize the session
session_start();

?>
<html>
<head>
    <style>
.center {
 text-align: center;
    padding-top: 250px;
   
}
        
        
        body {
            
            
            background-image: url("paper.gif");
  background-color:#AFEEEE ;
        
        }
        
       
        
        
       
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
    padding: 30px 10px;
  background-color:#3CB371;
  color: white;
  text-align: center;
}

      
        
        
        
</style>
    </head>
    
    <body>
        
    
    <div class="center">
        <h2> Welcome <?php echo $_SESSION['first_name']; ?></h2>
        </div>
    </body>
<div class="footer">
  <p>&copy; Parul Sharma</p>
</div>
</html>



   