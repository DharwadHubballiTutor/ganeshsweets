<?php
require "../Model/customerModel.php";
require "../Utilities/Sanitization.php";
include "../DB Operations/customerOps.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['customerId'])) {
    $customer = new customer();
    $customer->set_customerName(Sanitization::test_input($_POST["customerName"]));
    $customer->set_customerPhone(Sanitization::test_input($_POST["customerPhone"]));
    $customer->set_customerEmail(Sanitization::test_input($_POST["customerEmail"]));
    $customer->set_customerAddress(Sanitization::test_input($_POST["customerAddress"]));
    $customer->set_customerCity(Sanitization::test_input($_POST["customerCity"]));
    $customer->set_customerState(Sanitization::test_input($_POST["customerState"]));
    $customer->set_customerDov(Sanitization::test_input($_POST["customerDov"]));
    $customer->set_CreatedBy(Sanitization::test_input($_POST["createdby"]));
    $customer->set_ModifiedBy(Sanitization::test_input($_POST["modifiedby"]));
    $customer->set_customerId(Sanitization::test_input($_POST["customerId"]));
    $customer->setCustomerCode(Sanitization::test_input($_POST["customerCode"]));
    $words = preg_split("/\s+/",$customer->get_customerName());
    $acronym = "";
    foreach($words as $w){
      $acronym .= $w[0];
    }
    $codes = preg_split("/-/",$customer->getCustomerCode());
    $textArray =str_split($codes[2]);
    $id='';
    foreach($textArray as $char){
      if(is_numeric($char)){
              $id.=$char;
      }
    }
    $customerCode='GS-'.substr((str_replace('-','',$customer->get_customerDov())),0,6).'-'.$acronym.$id.'-CU';
    $customer->setCustomerCode($customerCode);
    error_log($customerCode);
    DBcustomer::update($customer);
  } else if ($_POST["action"] == 'delete') {
    DBcustomer::delete($_POST["id"]);
  } else {
    $customer = new customer();
    $customer->set_customerName(Sanitization::test_input($_POST["customerName"]));
    $customer->set_customerPhone(Sanitization::test_input($_POST["customerPhone"]));
    $customer->set_customerEmail(Sanitization::test_input($_POST["customerEmail"]));
    $customer->set_customerAddress(Sanitization::test_input($_POST["customerAddress"]));
    $customer->set_customerCity(Sanitization::test_input($_POST["customerCity"]));
    $customer->set_customerState(Sanitization::test_input($_POST["customerState"]));
    $customer->set_customerDov(Sanitization::test_input($_POST["customerDov"]));
    // $customer->set_enqId(Sanitization::test_input($_POST["enqId"]));
    $customer->set_CreatedBy(Sanitization::test_input($_POST["createdby"]));
    $customer->set_ModifiedBy(Sanitization::test_input($_POST["modifiedby"]));
    $words = preg_split("/\s+/",$customer->get_customerName());
    $acronym = "";
    foreach($words as $w){
      $acronym .= $w[0];
    }
    $customerCode='GS-'.substr((str_replace('-','',$customer->get_customerDov())),0,6).'-'.$acronym;
    $customer->setCustomerCode($customerCode);
    DBcustomer::insert($customer);
  }
   header("location:../View/customer.php");
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  DBcustomer::selectcustomer();
}
