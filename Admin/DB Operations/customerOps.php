<?php
require_once "../DB Operations/dbconnection.php";
require_once "../Model/customerModel.php";
require_once "../Model/enq_cat_mappingmodel.php";
require_once "../DB Operations/enq_cat_mappingOps.php";
class DBcustomer
{
    public static function insert($customer)
    {
        $db = ConnectDb::getInstance();
        $connectionObj = $db->getConnection();
        $sql = "INSERT INTO customer (`customerName`, 
    `customerCode`,
    `customerContactNumber`,
    `customerEmail`,
    `customerAddress`,
    `customerState`,
    `customerCity`,
    `customerDOV`,
   
    `createdBy`,
    `modifiedBy`) 
                values ('" . $customer->get_customerName() .
            "','" . $customer->getCustomerCode() . 
            "','" . $customer->get_customerPhone() .
            "','" . $customer->get_customerEmail() .
            "','" . $customer->get_customerAddress() .
            "','" . $customer->get_customerState() .
            "','" . $customer->get_customerCity() .
            "','" . $customer-> get_customerDov().
          
            "','" . $customer->get_CreatedBy() .
            "','" . $customer->get_ModifiedBy() .
            "')";
           
        if ($connectionObj->query($sql) === true) {
            $lastInsertedId =  $connectionObj->insert_id;
            $sql="UPDATE customer SET customerCode='".$customer->getCustomerCode().$lastInsertedId."' WHERE customerId=".$lastInsertedId;
            $connectionObj->query($sql);
            $sql="UPDATE enquiry_details SET isCustomerCreated=true WHERE enqid=".$customer->get_enqId();
            $connectionObj->query($sql);
        } else {
            error_log("Error: " . $sql . "<br>" . $connectionObj->error);
        }
    }

    public static function getAllcustomer()
    {
        $db = ConnectDb::getInstance();
        $connectionObj = $db->getConnection();
        $sql = "SELECT * FROM customer";

        $result = $connectionObj->query($sql);
        $count = mysqli_num_rows($result);
        $customerList = [];
        if ($count > 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $customer = new customer();
                $customer->set_customerId($row['customerId']);
                $customer->setCustomerCode($row['customerCode']);
                $customer->set_customerName($row['customerName']);
                $customer->set_customerPhone($row["customerContactNumber"]);
                $customer->set_customerEmail($row["customerEmail"]);
                $customer->set_customerAddress($row["customerAddress"]);
                $customer->set_customerState($row["customerState"]);
                $customer->set_customerCity($row["customerCity"]);
                $customer->set_customerDov(date('Y-m-d',strtotime($row["customerDOV"])));
                $customer->set_createdby($row["createdby"]);
                $customer->set_modifiedby($row["modifiedby"]);
                array_push($customerList, $customer);
            }
        } else {
            // echo "0 results";
        }
        return $customerList;
    }


   


    public static function update($customer)
    {
        $db = ConnectDb::getInstance();
        $connectionObj = $db->getConnection();
        $sql = "UPDATE customer SET customerCode='". $customer->getCustomerCode() . 
            "', customerName='" . $customer->get_customerName() .
            "', customerContactNumber='" . $customer->get_customerPhone() .
            "', customerEmail='" . $customer->get_customerEmail() .
            "', customerAddress='" . $customer->get_customerAddress() .
            "', customerState='" . $customer->get_customerState() .
            "', customerCity='" . $customer->get_customerCity() .
            "',customerDOV='". $customer->get_customerDov().
            "', createdBy='" . $customer->get_CreatedBy() .
            "', modifiedBy='" . $customer->get_ModifiedBy() .
            "' WHERE customerId=" . $customer->get_customerId();
        if ($connectionObj->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $connectionObj->error;
        }
    }
    public static function selectcustomer()
    {
        $db = ConnectDb::getInstance();
        $connectionObj = $db->getConnection();
        $sql = 'SELECT customerId,customerName FROM customer';
        $result = mysqli_query($db->getConnection(), $sql);
        $customerList = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $customer = new customer();
                $customer->set_customerId($row['customerId']);
                $customer->set_customerName($row['customerName']);
                array_push($customerList, $customer);
            }
        } else {
            echo "0 results";
        }
        header('Content-Type: application/json');
        echo json_encode($customerList);
    }

    public static function delete($customerId)
    {
        $db = ConnectDb::getInstance();
        $connectionObj = $db->getConnection();
        $sql = "DELETE from customer where customerId=" . $customerId ;
        if ($connectionObj->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $connectionObj->error;
        }
    }
}
