<?php
include_once("../model/model.php");
include_once("util.php");

function getReservationTable($aRequest=array()) {
  //
  $result = getReservations($aRequest); 
  //
  if(!is_array($result))
    return $result; // null or error message   
  //
  //--------------------------- add buttons
  foreach($result as $k=>$v) {
    $sAction[] = '<button type="button" 
                        class="btn btn-default btn-sm" onclick="editRes('.$v['gnc_id'].', '.$v['rsr_num'].')">
    <span class="glyphicon glyphicon-pencil"></span>  
  </button>&nbsp;';
    $sAction[] '<button type="button" 
                         class="btn btn-default btn-sm" onclick="deleteRes('.$v['gnc_id'].', '.$v['rsr_num'].')" >
    <span class="glyphicon glyphicon-trash"></span>  
  </button>&nbsp;';
    $sAction[] '<button type="button" 
                         class="btn btn-default btn-sm" onclick="getPdf('.$v['gnc_id'].', '.$v['rsr_num'].')">
    <span class="glyphicon glyphicon-file"></span>  
  </button>&nbsp;';
    //
    unset($result[$k]['gnc_id']);
    unset($result[$k]['rsr_num']);
    //
    $result[$k]['&nbsp;'] = implode( '&nbsp;', $aAction);
  }
  //
  return mkHtmlTable($result);   
}

if(isset($_REQUEST['action'])) {
  switch($_REQUEST['action']) {
    case 'getList':
      echo getReservationTable($_REQUEST);
      exit();
      break;
    //
    case 'delete':
      $aRes = deleteReservation([':gnc_id' => $_REQUEST['gnc_id'], 
        ':rsr_num' => $_REQUEST['rsr_num']]);
      //
      echo getReservationTable();
      exit();
      break;
      //
  }
  //

}  
else {
  header("Location: ../views/reservation.php");
}

?>
