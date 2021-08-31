<?php
require_once "../Model/salesorderModel.php";
require_once "../Utilities/Sanitization.php";
require_once "../DB Operations/salesorderOps.php";
require_once  "../DB Operations/customerOps.php ";
require_once "../Model/SOlineitemModel.php";
require_once  "../DB Operations/SOlineitemOps.php ";
require_once  "../DB Operations/paymentOps.php ";
require_once "../Model/paymentmodel.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['obj'])) {
          $value=$_POST['obj'];
          
          $sales=new SalesOrder();
          $sales->set_customer(Sanitization::test_input($value[0]["customer"]));
          $sales->set_itemid(Sanitization::test_input($value[0]["itemid"]));
          $sales->set_totalAmount(Sanitization::test_input($value[0]["totalAmount"]));
          $sales->set_itemquantity(Sanitization::test_input($value[0]["itemquantity"]));
          $sales->set_itemperpieceprice(Sanitization::test_input($value[0]["itemperpieceprice"]));
          $sales->set_salesdate(Sanitization::test_input($value[0]["salesdate"]));
          $customername=DBsales::selectcustomer($sales->get_customer());
          $customername=$customername->get_customerName();
          $words = preg_split("/\s+/",$customername);
          $acronym = "";
          foreach ($words as $w) {
              $acronym .= $w[0];
          }
          $salesCode='GS-'.substr((str_replace('-', '', $sales->get_salesdate())), 0, 6).'-'.$acronym.'-SO';
          $sales->setSOcode($salesCode);
          $salesId=DBsales::insert($sales);
          $payment= new Payment();
          $payment->set_SOID($salesId);
            $payment->set_custid(Sanitization::test_input($value [0] ["customer"])); 
            $payment->set_totalamt(Sanitization::test_input($value [count($value)-1]["totalOrderAmount"]));
            $payment->set_pendingamt(Sanitization::test_input($value [count($value)-1]["totalOrderAmount"]));
            $payment->set_modifiedby(Sanitization::test_input($value[0]["modifiedby"]));
            $payment->set_receivedamt(0);
            $payment->set_paymentplan(0);
            $payment->set_paidamt(0);
            $payment->set_paymentmode(0);
            $payment->set_paymentdescription(0);
            DBpayment::insert($payment);
          foreach ($value as $key=>$value) {
            $saleslineitem= new SaleslineItem();
            $saleslineitem->set_SOID($salesId);
              $saleslineitem->set_itemid(Sanitization::test_input($value["itemid"]));
              $saleslineitem->set_totalamt(Sanitization::test_input($value["totalAmount"]));
              $saleslineitem->set_quantity(Sanitization::test_input($value["itemquantity"]));
              $saleslineitem->set_unit(Sanitization::test_input($value["unit"]));
              $saleslineitem->set_price(Sanitization::test_input($value["itemperpieceprice"]));
              DBSOLineItem::insert($saleslineitem);
          }
         
      } elseif (isset($_POST['id'])) {
          $sales=new salesOrder();
          $sales->set_customer(Sanitization::test_input($_POST["customer"]));
          $sales->set_itemid(Sanitization::test_input($_POST["itemid"]));
          $sales->set_totalAmount(Sanitization::test_input($_POST["totalAmount"]));
          $sales->set_itemquantity(Sanitization::test_input($_POST["itemquantity"]));
          $sales->set_itemperpieceprice(Sanitization::test_input($_POST["itemperpieceprice"]));
          $sales->set_salesdate(Sanitization::test_input($value[0]["salesddate"]));
          DBsales::update($sales);
      } elseif ($_POST["action"]=='delete') {
          DBsales::delete($_POST["id"]);
      }
    header("location:../Admin/View/SOview.php");  
  }
  
