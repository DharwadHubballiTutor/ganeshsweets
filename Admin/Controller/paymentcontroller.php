<?php
require_once "../Model/paymentmodel.php";
require_once "../Utilities/Sanitization.php";
require_once "../Utilities/Helper.php";
//require "../Admin/navbar.php";
require_once "../DB Operations/paymentOps.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $admit=new Payment();
    $admit->set_SOID(Sanitization::test_input($_POST["SOID"]));
    //$admit->set_custid(Sanitization::test_input($_POST["custid"]));
    $admit->set_paymentid(Sanitization::test_input($_POST["paymentid"]));
    //$admit->set_custname(Sanitization::test_input($_POST["custname"]));
    //$admit->set_custcontactnumber(Sanitization::test_input($_POST["custcontactno"]));
    $admit->set_totalamt(Sanitization::test_input($_POST["totalamt"]));
    $admit->set_paidamt(Sanitization::test_input($_POST["paidamt"]));
    $admit->set_receivedamt(Sanitization::test_input($_POST["receivedamt"]));
    $admit->set_pendingamt(Sanitization::test_input($_POST["pendingamt"]));
   // $admit->set_paymentplan(Sanitization::test_input($_POST["paymentplan"]));
    $admit->set_paymentmode(Sanitization::test_input($_POST["paymentmode"]));
    $admit->set_paymentdescription(Sanitization::test_input($_POST["paymentdescription"]));
    $admit->set_modifiedby(Sanitization::test_input($_POST["modifiedby"]));

    if (isset($_POST["duedate"])){
      $admit->set_duedate(Sanitization::test_input($_POST["duedate"]));
    }else{
      $admit->set_duedate(NULL); 
    }
    DBpayment::insert($admit);

    header("location: ../View/paymentView.php?id=".$_POST["salesOrderNumber"]);
    
  }
  if ($_SERVER["REQUEST_METHOD"]=="GET") {
 
    
  }
  
?>
