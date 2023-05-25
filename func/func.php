<?php

function gstatus($fstatus) {
  $p = null;
  if($fstatus=="TIMED"){

  $p.="<span class='w3-text-red w3-round-xlarge'>SCHEDULED</span>" ;
  }
  elseif($fstatus=="FINISHED"){
  $p.="<span class='w3-text-yellow w3-round-xlarge'>Finished</span>" ;  }
  else{
   $p.="<span class='w3-orange w3-round-xlarge'>Postponed</span>" ; 
  }
  return $p;
} 
?>