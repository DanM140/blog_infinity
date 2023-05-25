<?php include 'includes/session.php'; ?>
<?php if (isset($_SESSION['visitor'])) {
	header('Location: index.php');
} ?>

<?php include 'includes/title.php';?>
<!-- Page content -->
<div class="w3-content " style="max-width:700px">
	
	<!--Grid-->
	<div class="w3-container">

						 <?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='w3-panel w3-yellow'>
            <p class='w3-center'>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
      if(isset($_SESSION['success'])){
        echo "
          <div class='w3-panel w3-green'>
            <p class='w3-center'>".$_SESSION['success']."</p> 
          </div>
        ";
        unset($_SESSION['success']);
      }
    ?>

   
      <div class="w3-container w3-card-4 w3-border w3-padding-top-64" style="margin-top:100px;">
      	        <div class="w3-container" >
                 <form role="form" method="POST" action="verify.php" enctype="multipart/form-data">
                 	<h4 class="w3-center"><span class="glyphicon glyphicon-lock"></span> Login</h4>
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Enter Email:</label>
              <input type="email" name="email" class="form-control" id="usrname"style="width: 100%;" placeholder="Enter email">
            </div>
            <div class="form-group">
              <input type="password" name="password"class="form-control" id="pass" style="width: 100%;"placeholder="Enter password">
              
            </div>
            
              <button type="submit" class="btn btn-success" name="login"><span class="glyphicon glyphicon-off"></span> Login</button>
          </form>
        </div>
        <div class="w3-container" style="padding-left:20px">
          <p>Not a member? <a href="signup.php" class="w3-text-blue">Sign Up</a></p>
          <p>Forgot <a href="password_forgot.php" class="w3-text-blue">Password?</a></p>
        </div>
      </div>
      
     
</div>	
	</div>
<?php include 'includes/scripts.php'; ?>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
 </body>
</html>