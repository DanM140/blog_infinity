 <!-- Header -->
  <header class="w3-container w3-hide-small" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom w3-hide-small">
        <div class="w3-third w3-hide-small">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
        <div class="w3-right">
           <?php
           $conn=$pdo->open();
    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM views  WHERE date_view=:date_view");
                $stmt->execute(['date_view'=>$now]);

                $urow =  $stmt->fetch();

                echo "<h3>".$urow['numrows']."</h3>";
                $pdo->close();
              ?>
        </div>
        <div class="w3-clear"></div>
        <h4>Views</h4>
      </div>
    </div>
    <div class="w3-third w3-hide-small">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
         <?php
           $conn=$pdo->open();
    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM shares  WHERE date_shared=:date_shared");
                $stmt->execute(['date_shared'=>$now]);

                $srow =  $stmt->fetch();

                echo "<h3>".$srow['numrows']."</h3>";
                $pdo->close();
              ?>
        </div>
        <div class="w3-clear"></div>
        <h4>Shares</h4>
      </div>
    </div>
    <div class="w3-third w3-hide-small">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <?php
           $conn=$pdo->open();
    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users  ");
                $stmt->execute();

                $ssrow =  $stmt->fetch();

                echo "<h3>".$ssrow['numrows']."</h3>";
                $pdo->close();
              ?>        </div>
        <div class="w3-clear"></div>
        <h4>Users</h4>
      </div>
    </div>
  </div>