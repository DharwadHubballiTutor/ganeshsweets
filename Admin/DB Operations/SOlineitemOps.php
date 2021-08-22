<?php
require_once "../DB Operations/dbconnection.php";
require_once "../Model/salesorderModel.php";
require_once "../Model/SOlineitemModel.php";


class DBSOLineItem
    {
      public static function insert($lineItemObj)
      {
        $db=ConnectDb::getInstance();
        $connectionObj=$db->getConnection();
        $sql = "INSERT INTO `salesorder_lineitem`(
            `SOID`, 
            `Item_id`,
            `Quantity`, 
            `unit_id`, 
            `TotalAmt`,
            `GST`, 
            `Price`) 
                values ('".$lineItemObj->get_SOID().
                "','".$lineItemObj->get_itemid().
                "','".$lineItemObj->get_quantity().
                "','".$lineItemObj->get_unit().
                "','".$lineItemObj->get_totalamt().
                "','".$lineItemObj->get_GST().
                "','".$lineItemObj->get_price().
                "')";
                error_log($sql);
        if ($connectionObj->query($sql) === TRUE) {
          
        } else {
          echo "Error: " . $sql . "<br>" . $connectionObj->error;
        }
      }
      public static function getSOLineItemBySalesId($salesId){
        $db=ConnectDb::getInstance();
        $connectionObj=$db->getConnection();
        $sql = "SELECT 
        SLI.SOlineitemId AS SOId,
        SLI.Item_id AS Item_id,
        I.item_name AS Name,
        SLI.Quantity AS Quantity,
        SLI.TotalAmt AS TotalAmount,
        SLI.Price AS Price,
        C.item_catName AS CategoryName,
        SC.item_subcatName AS SubCategoryName,
        SLI.unit_id AS unitid,
        U.unitName AS UnitName,
        SLI.GST AS GST
        FROM `salesorder_lineitem` AS SLI 
        JOIN Units U ON U.unitId=SLI.unit_id
        JOIN `item_details` AS I ON SLI.Item_id=I.item_id 
        Join `item_category` C ON C.item_catid=I.item_catid
        Join `item_subcategory` SC ON SC.item_subcatid=I.item_subcatid
        Where SOID=".$salesId;
        error_log($sql);
        $result = $connectionObj->query($sql);
        $count = mysqli_num_rows($result);
        $lineitemList=[];
        if($count>0){
          while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $item=new SaleslineItem();
            $item->set_SOlineitemId($row["SOId"]);
            $item->setName($row["Name"]);
            $item->set_itemid($row["Item_id"]);
            $item->set_quantity($row["Quantity"]);
            $item->setunitName($row["UnitName"]);
            
            
            $item->set_totalamt($row['TotalAmount']);
            
            $item->set_price($row['Price']);
            $item->set_GST($row['GST']);
            $item->setItemcatname($row["CategoryName"]);
            $item->setItemsubcatname($row["SubCategoryName"]);


            array_push($lineitemList,$item);
          }
        }
        header('Content-Type: apSLIcation/json');
         echo json_encode($lineitemList);
      }
    
      public static function getLineItemBySalesIdForOrder($salesId){
        $db=ConnectDb::getInstance();
        $connectionObj=$db->getConnection();
        $sql = "SELECT 
        SLI.SOlineitemId AS Id,
        SLI.Item_id AS Item_id,
        I.item_name AS Name,
        SLI.Quantity AS Quantity,
        SLI.TotalAmt AS TotalAmount,
        SLI.Price AS Price,
        U.unitName AS UnitName,
        SLI.GST AS GST,
        C.item_catName AS CategoryName,
        SC.item_subcatName AS SubCategoryName
        FROM `salesorder_lineitem` AS SLI 
        JOIN `item_details` AS I ON SLI.Item_id=I.item_id 
        Join `item_category` C ON C.item_catid=I.item_catid
        Join `item_subcategory` SC ON SC.item_subcatid=I.item_subcatid
        JOIN Units U ON U.unitId=SLI.unit_id
        WHERE SLI.SOID=".$salesId;
        error_log($sql);        
        $result = $connectionObj->query($sql);
        $count = mysqli_num_rows($result);
        $SOListItem=[];
        if($count>0){
          while($row =mysqli_fetch_array ($result,MYSQLI_ASSOC)){
            $item=new SaleslineItem();
            $item->set_SOlineitemId($row["Id"]);
            $item->set_itemid($row["Item_id"]);
            $item->setName($row["Name"]);
            $item->set_quantity($row["Quantity"]);
            $item->setunitName($row["UnitName"]);
            $item->set_totalamt($row['TotalAmount']);
            $item->set_GST($row['GST']);
            $item->setItemcatname($row["CategoryName"]);
            $item->setItemsubcatname($row["SubCategoryName"]);
            $item->set_price($row["Price"]);
            array_push($SOListItem,$item);
          }
        }
        return $SOListItem;
      }


      public static function getAllsalesorders(){
        $db=ConnectDb::getInstance();
        $connectionObj=$db->getConnection();
        $sql = "SELECT * FROM  sales_order";
        $result = $connectionObj->query($sql);
        $count = mysqli_num_rows($result);
        $salesList=[];
        if($count>0){
          while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $sales=new salesOrder();
            $sales->set_Id($row["Id"]);
            //$quotation->set_quotationname($row["quotation_name"]);
            array_push($salesList, $quotation);
          }
        }
        return $salesList;
      }

      public static function update($lineItemObj){
        $db=ConnectDb::getInstance();
        $connectionObj=$db->getConnection();
        $sql="UPDATE salesorder_lineitem SET 
             Quantity=".$lineItemObj->get_quantity().
            ", TotalAmt=".$lineItemObj->get_totalamt(). 
         
            ", Price='".$lineItemObj->get_price(). 
            "' WHERE SOlineitemId=".$lineItemObj->get_SOlineitemId();
            error_log($sql);
        if ($connectionObj->query($sql) === TRUE) {
        } else {
          echo "Error: " . $sql . "<br>" . $connectionObj->error;
        }
      }

      public static function delete($lineItemObj){
        $db=ConnectDb::getInstance();
        $connectionObj=$db->getConnection();
        $sql="DELETE from salesorder_lineitem where Id=".$lineItemObj;
        error_log($sql);
        if ($connectionObj->query($sql) === TRUE) {
        } else {
          echo "Error: " . $sql . "<br>" . $connectionObj->error;
        }

      }

    }