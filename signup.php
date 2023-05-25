<?php include 'includes/session.php'; ?>
<?php if (isset($_SESSION['writer'])) {
	header('Location: blog.php');
} ?>
<?php include 'includes/title.php';?>
<!-- Page content -->
<div class="w3-content" style="max-width:700px">
	
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
		
    
      <!-- Modal content-->
      <div class="w3-container">
        <div class="w3-container" >
              <form  action="register.php" method="POST">
                  <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
     <div class="form-group">
            <div class="form-group">
              <label for="First Name"><span class="glyphicon glyphicon-user"></span> First Name</label>
              <input type="text" class="form-control" id="fname" name="firstname" style="width: 100%;" placeholder="Enter First Name" value="<?php echo(isset($_SESSION['firstname']))? $_SESSION['firstname']:''?>" required>
            </div>

            <div class="form-group">
              <label for="Last Name"><span class="glyphicon glyphicon-user"></span> Last Name</label>
              <input type="text" class="form-control" id="lname" name="lastname" style="width: 100%;" placeholder="Enter Last Name" value="<?php echo(isset($_SESSION['lastname']))? $_SESSION['lastname']:''?>" required>
            </div>
            <div class="form-group">
              <label for="email"><span class="glyphicon glyphicon-user"></span> Email</label>
              <input type="text" class="form-control" id="email" name="email"style="width: 100%;" placeholder="Enter email" value="<?php echo(isset($_SESSION['email']))? $_SESSION['email']:''?>" required>
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="password" class="form-control" id="psw" style="width: 100%;"placeholder="Password" name="pass" required>
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Confirm Password</label>
              <input type="password" class="form-control" id="ps" style="width: 100%;"placeholder="Retype password" name="repass"  required> 
            </div>

                        <div class="form-group"><p>By creating an account you agree to our <span><a href="#" class="w3-text-blue"style="cursor:pointer;">Terms & Privacy.</a></span><p></div>
              <button type="submit" class="btn btn-success btn-block" name="signup"><span class="glyphicon glyphicon-off"></span> Sign Up</button>
          </form>
                         </div>
        <div class="w3-container" style="padding-left:20px">
          
          <p class="w3-center">Already a member? <a href="login.php">Sign In</a></p>

                  </div>
      </div>
      
     
</div>	
	</div>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
 </body>
</html>
