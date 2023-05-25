<?php include 'includes/session.php'; ?>
<?php
  if(!isset($_GET['code']) OR !isset($_GET['user'])){
    header('location: index.php');
    exit(); 
  }
?>

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
                 <form role="form" method="POST" action="password_new.php?code=<?php echo $_GET['code']; ?>&user=<?php echo $_GET['user']; ?>" enctype="multipart/form-data">
                  <h4 class="w3-center"><span class="glyphicon glyphicon-lock"></span> Password Reset</h4>
<div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="New password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="repassword" placeholder="Re-type password" required>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="row">
          <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat" name="reset"><i class="fa fa-check-square-o"></i> Reset</button>
            </div>
          </div>

                           </form>
        </div>
        <div class="w3-container" style="padding-left:20px">
          <p> <a href="login.php">I rememberd my password</a><br></p>
          <p> <a href="index.php"><i class="fa fa-home"></i> Home</a></p>

      
                </div>
      </div>
      
     
</div>  
  </div>
<?php include 'includes/scripts.php'; ?>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
 </body>
</html>