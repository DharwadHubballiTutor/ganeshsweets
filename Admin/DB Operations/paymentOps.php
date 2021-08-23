<?php
// require "../Admin/session.php";
require_once "../DB Operations/dbconnection.php";
require_once "../../Admin/Model/customerModel.php";


    class DBpayment
    {
      public static function insert($payObj)
      {
        $db=ConnectDb::getInstance();
        $connectionObj=$db->getConnection();
        if($payObj->get_duedate()==""){
          $sql = "insert into paymentinfo (`SOID`,`customer_id`, `total_amount`,`paid_amount`,`received_amount`,`pending_amount`, `payment_plan`,`payment_mode`,`payment_description`,`modified_by`) 
                values ('".$payObj->get_SOID()."','".$payObj->get_custid()."','".$payObj->get_totalamt()."','".$payObj->get_paidamt()."','".$payObj->get_receivedamt()."','".$payObj->get_pendingamt()."','".$payObj->get_paymentplan()."','".$payObj->get_paymentmode()."','".$payObj->get_paymentdescription()."','".$payObj->get_modifiedby()."')";
                
        }else {
         $sql = "insert into paymentinfo (`customer_id`, `total_amount`,`paid_amount`,`received_amount`,`pending_amount`, `payment_plan`,`payment_mode`,`payment_description`,`modified_by`) 
         values ('".$payObj->get_custid()."','".$payObj->get_totalamt()."','".$payObj->get_paidamt()."','".$payObj->get_receivedamt()."','".$payObj->get_pendingamt()."','".$payObj->get_paymentplan()."','".$payObj->get_paymentmode()."','".$payObj->get_paymentdescription()."','".$payObj->get_modifiedby()."')";
        }    
                if ($connectionObj->query($sql) === TRUE) {
        } else {
          echo "Error: " . $sql . "<br>" . $connectionObj->error;
        }
      
        error_log($sql);
      }

      public static function getcustomerpayment()
      {
          $db = ConnectDb::getInstance();
          $connectionObj = $db->getConnection();
          $sql = "SELECT 
          C.customerId as CustomerID,
          C.customerName as CustomerName,
          C.customerContactNumber as customerPhone,
          sum( P.paid_amount) AS PaidAmt,
          sum(SO.TotalAmt) as TotalAmount,
          sum( SO.PendingAmt) as PendingAmount
          From paymentinfo As P
          JOIN customer C ON C.customerId=P.customer_id
          JOIN sales_order SO ON SO.CustomerId=P.customer_id
          Group BY CustomerID,
          CustomerName,
          customerPhone";
          error_log($sql);
          $result = $connectionObj->query($sql);
          $count = mysqli_num_rows($result);
          $customerList = [];
          if ($count > 0) {
              while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                  $customer = new customer();
                 
                  $customer->set_customerId($row['CustomerID']);
                  // $customer->setCustomerCode($row['customerCode']);
                  $customer->set_customerName($row['CustomerName']);
                  $customer->set_customerPhone($row["customerPhone"]);
                  $customer->settotalAmt($row["TotalAmount"]);
                  $customer->setpendingAmt($row["TotalAmount"]-$row["PaidAmt"]);
                  $customer->setpaidAmt($row["PaidAmt"]);
                  array_push($customerList, $customer);
              }
          } else {
              // echo "0 results";
          }
          return $customerList;
      }
        
        public static function viewfeesdetails($viewObj)
       {
          $db=ConnectDb::getInstance();
          $connectionObj=$db->getConnection();
          $sql = "select Modified_Date,customer_id,paid_amount,pending_amount,payment_mode,payment_receipt from paymentinfo where customer_id=$viewObj";
          $result = mysqli_query($db->getConnection(), $sql);
          $paymentdetails=[];
          if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
          $view= new Payment();
          //$view->set_modifiedon($row['modifiedon']);
          $view->set_paidamt($row['paid_amount']);
          $view->set_pendingamt($row['pending_amount']);
          $view->set_paymentmode($row['payment_mode']);
          $view->set_custid($row['customer_id']);
          $view->set_paymentreceipt($row['paymentreceipt']);
         array_push($paymentdetails,$view);
        
         }    
         } else {
            echo "No entries ";
         } 
         return $paymentdetails;
       }
      
    

   }