<?php

function gstatus($fstatus) {
  $p = null;
  if($fstatus=="QUARTER_FINALS"){

  $p.="<span class='w3-text-red w3-round-xlarge'>QUARTER_FINALS</span>" ;
  }
  elseif($fstatus=="SEMI_FINALS"){
  $p.="<span class='w3-text-yellow w3-round-xlarge'>SEMI_FINALS</span>" ;  }
  elseif($fstatus=="FINAL"){
  $p.="<span class='w3-text-yellow w3-round-xlarge'>Final</span>" ;  }
  elseif($fstatus=="THIRD_PLACE"){
  $p.="<span class='w3-text-yellow w3-round-xlarge'>THIRD_PLACE</span>" ;  }
  elseif($fstatus=="PRELIMINARY_ROUND"){
  $p.="<span class='w3-text-yellow w3-round-xlarge'>PRELIMINARY_ROUND</span>" ;  }
  else{
   $p.="<span class='w3-orange w3-round-xlarge'>Postponed</span>" ; 
  }
  
  return $p;
} 
?>