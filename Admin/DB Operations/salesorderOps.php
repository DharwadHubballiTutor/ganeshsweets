<?php
require_once "../DB Operations/dbconnection.php";
require_once "../Model/salesorderModel.php";
require_once "../Model/item_detailsmodel.php";
class DBsales
{
  public static function insert($salesObj)
  {
    $db = ConnectDb::getInstance();
    $connectionObj = $db->getConnection();
    $sql = "INSERT INTO sales_order (`Item_id`, `CustomerId`, `SOcode`,`TotalAmt`,`PendingAmt`,`SalesDate`) 
                values ('" . $salesObj->get_itemid() . "','" . $salesObj->get_customer() . "','" . $salesObj->getSOcode() . "','" . $salesObj->get_totalAmount() . "','" . $salesObj->get_totalAmount() . "','" . $salesObj->get_salesdate() . "')";
    error_log($sql);
    if ($connectionObj->query($sql) === TRUE) {
      $salesId = $connectionObj->insert_id;

      $sql="UPDATE sales_order SET SOcode='".$salesObj->getSOcode().$salesId."' WHERE id=".$salesId;
      $connectionObj->query($sql);

      $sql = "SELECT COUNT(*) FROM sales_order where Item_id=" . $salesObj->get_itemid() . "";
      $count = $connectionObj->query($sql);
      $row = mysqli_fetch_array($count);
      $total = $row[0];
      return $salesId;
    } else {
      echo "Error: " . $sql . "<br>" . $connectionObj->error;
    }
  }
  public static function getAllsales()
  {
    $db = ConnectDb::getInstance();
    $connectionObj = $db->getConnection();
    $sql = "SELECT SO.Id AS Id,
     SO.SOcode AS SOcode,
     SO.SalesDate AS SalesDate, 
     CU.customerId AS customerId,
     CU.customerName AS customerName, 
     CU.customerContactNumber AS customerPhone,
     CU.customerEmail AS customerEmail,
     CU.customerAddress AS Address,
     CU.customerCity AS city,
     SO.salesPDFName AS PDFName,
     SUM(SLI.TotalAmt) AS TotalAmt 
     FROM `sales_order` AS SO 
     JOIN `salesorder_lineitem` SLI ON SLI.SOID=SO.id
     JOIN `customer` CU ON CU.customerId=SO.CustomerId 
     GROUP BY Id,
     SOcode,
     SalesDate,
     customerId,
     customerName,
     customerPhone,
     customerEmail ORDER BY SO.Id DESC";
     error_log($sql);
    $result = $connectionObj->query($sql);
    $count = mysqli_num_rows($result);
    $salesList = [];
    if ($count > 0) {
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $sales = new salesOrder();
        $sales->set_Id($row["Id"]);
        $sales->setSOcode($row["SOcode"]);
        $sales->set_customer($row["customerId"]);
        $sales->setCustomerName($row["customerName"]);
        $sales->set_totalAmount($row["TotalAmt"]);
        $sales->set_salesdate((date('Y-m-d',strtotime($row["SalesDate"]))));
        $sales->setCustomerContactNumber($row["customerPhone"]);
        $sales->setCustomerEmail($row["customerEmail"]);
        $sales->setCustomerAddress($row["Address"]);
        $sales->setCity($row["city"]);
        $sales->set_salesPDFName($row["PDFName"]);
        array_push($salesList, $sales);
      }
    }
    return $salesList;
  }

  public static function getsalesForPrint($id)
  {
    $db = ConnectDb::getInstance();
    $connectionObj = $db->getConnection();
    $sql = "SELECT S.Id AS Id,
    S.Item_id AS ItemId,
    SO.TotalAmt AS TotalAmt,
    S.SOcode AS SOcode,
    S.SalesDate AS SalesDate,
    CU.customerId AS customerId, 
    CU.customerName AS CustomerName, 
    CU.customerAddress AS customerAddress, 
    CU.customerContactNumber As customerContactNumber, 
    I.item_name AS Name, 
    SO.SOID AS salesid, 
    SO.Quantity AS Quantity, 
    U.unitName AS Unit
    FROM `sales_order` 
    AS S 
    JOIN `customer` CU ON CU.customerId=S.CustomerId 
    JOIN `salesorder_lineitem` SO ON SO.SOID =S.Id 
    JOIN `item_details` I ON I.item_id =SO.Item_id 
    JOIN `units` U ON SO.unit_id=U.unitId
    WHERE S.Id=" . $id;
    $result = $connectionObj->query($sql);
    $count = mysqli_num_rows($result);
    error_log($sql);
    $salesList = [];
    if ($count > 0) {
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $sales = new salesOrder();
        $sales->set_Id($row["Id"]);
        $sales->setSOcode($row["SOcode"]);
        $sales->setName($row["Name"]);
        $sales->setCustomerName($row["CustomerName"]);

        $sales->setCustomerContactNumber($row["customerContactNumber"]);
        $sales->setCustomerAddress($row["customerAddress"]);

        $sales->setQuantity($row["Quantity"]);
        $sales->set_unit($row["Unit"]);
        $sales->set_itemId($row["ItemId"]);
        $sales->set_salesdate(date('Y-m-d',strtotime($row["SalesDate"])));
        $sales->set_totalAmount($row["TotalAmt"]);
        array_push($salesList, $sales);
      }
    }
    return $salesList;
  }



  public static function selectCustomer($id)
  {
    $db = ConnectDb::getInstance();
    $connectionObj = $db->getConnection();
    $sql = "SELECT customerName FROM customer where customerId=$id";
    error_log($sql);
    $result = $connectionObj->query($sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $view = new Customer();
        $view->set_customerName($row['customerName']);
      }
    } else {
      // echo "0 results";
    }
    return $view;
  }

  public static function update($salesObj)
  {
    $db = ConnectDb::getInstance();
    $connectionObj = $db->getConnection();
    $sql = "UPDATE sales_order SET 
        Quantity='" . $salesObj->get_quantity() .
      "', Price='" . $salesObj->get_price() .
      "', TotalAmt='" . $salesObj->get_totalamt() .
      "', SOID='" . $salesObj->get_SOID() .
      "' WHERE Id=" . $salesObj->get_Id();
    if ($connectionObj->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $connectionObj->error;
    }
  }


  public static function updateFileName($salesObj)
  {
    $db = ConnectDb::getInstance();
    $connectionObj = $db->getConnection();
    $sql = "UPDATE sales_order SET ";

    $sql .= "salesPDFName='" . $salesObj->get_salesPDFName().
      "' WHERE id=" . $salesObj->get_Id();
    error_log($sql);
    if ($connectionObj->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $connectionObj->error;
    }
  }

  public static function delete($salesId)
  {
    $db = ConnectDb::getInstance();
    $connectionObj = $db->getConnection();
    $sql = "DELETE FROM sales_order WHERE salesId=" . $salesId;
    error_log($sql);
    if ($connectionObj->query($sql) === TRUE) {
      $sql = "DELETE from sales_order where Id=" . $salesId;
      error_log($sql);
      if ($connectionObj->query($sql) === TRUE) {
      } else {
        echo "Error: " . $sql . "<br>" . $connectionObj->error;
      }
    } else {
      echo "Error: " . $sql . "<br>" . $connectionObj->error;
    }
  }
}
