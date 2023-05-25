<div class="w3-bar w3-top w3-black w3-large" >
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right"></span>
  <a href="../logout.php" style="text-decoration:none;"  class="w3-bar-item w3-round w3-right w3-red">Sign Out</a>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="<?php echo(!empty($admin['photo']))?'../images/'.$admin['photo']:'../images/profile.jpg'; ?>" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong><?php echo $admin['firstname']; ?></strong></span><br>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="#profile" class="editprofile w3-bar-item w3-button" data-toggle="modal" data-id='<?php echo $admin['id']; ?>'>  <i class="fa fa-user"></i> Edit Profile</a>
    <a href="updates.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-pencil-square" aria-hidden="true"></i>  Blogs</a>
    <a href="category.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-list" aria-hidden="true"></i>  Category</a>
    <a href="users.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Writers</a>
    <a href="publish.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Publish</a><br><br>
  </div>
</nav>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
