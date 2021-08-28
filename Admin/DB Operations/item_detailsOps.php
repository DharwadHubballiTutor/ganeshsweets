<?php
require_once "../DB Operations/dbconnection.php";
require_once "../Model/item_detailsmodel.php";
class DBitemdetails
{
  /*
  function accepts the input item object and inserts the record in 
  item details table.
  */
  public static function insert($itemdetailsObj)
  {
    $db = ConnectDb::getInstance();
    $connectionObj = $db->getConnection();
    $sql = "insert into item_details (`item_name`,  
      `item_description`,
        `item_subcatid`,
        `item_catid`,
        `item_image`)
            values ('" . $itemdetailsObj->get_itemname() .
     "','" . $itemdetailsObj->get_itemdescription() .    
      "','" . $itemdetailsObj->get_itemsubcatid() .
      "','" . $itemdetailsObj->get_itemcatid() .
      "','" . $itemdetailsObj->get_itemimage() .
      "')";

    if ($connectionObj->query($sql) === true) {
    } else {
      echo "Error: " . $sql . "<br>" . $connectionObj->error;
    }
  } 

  public static function getallItemdetails()
  {
    $db = ConnectDb::getInstance();
    $connectionObj = $db->getConnection();
    $sql = "SELECT I.item_id AS ItemId,
      I.item_name AS ItemName,
      I.item_description AS ItemDescription,
      I.item_catid AS CategoryId,
      C.item_catName AS CategoryName,
      I.item_subcatid AS SubCategoryId,
      SC.item_subcatName AS SubCategoryName,
      I.item_image AS ItemImage
    
      FROM item_details I 
      JOIN item_category C ON I.item_catid=C.item_catid 
      JOIN item_subcategory SC ON I.item_subcatid=SC.item_subcatid "; 
    $result = $connectionObj->query($sql);
    $count = mysqli_num_rows($result);
    $itemdetailslist = [];
    if ($count > 0) {
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $view = new Item_Details();
        $view->set_itemid($row['ItemId']);
        $view->set_itemname($row['ItemName']);
        $view->set_itemdescription($row["ItemDescription"]);
        $view->set_itemsubcatid($row["SubCategoryId"]);
        $view->set_itemcatid($row["CategoryId"]);
        $view->set_itemcategoryname($row["CategoryName"]);
        $view->set_itemsubcategoryname($row["SubCategoryName"]);
        $view->set_itemimage($row["ItemImage"]);
      
        array_push($itemdetailslist, $view);
      }
    } else {
      // echo "0 results";
    }

    return $itemdetailslist;
  }

  public static function update($detailsObj)
  {
    $db = ConnectDb::getInstance();
    $connectionObj = $db->getConnection();
    $sql = "UPDATE item_details SET item_name='" . $detailsObj->get_itemname() .
    "', item_description='" . $detailsObj->get_itemdescription().
      "', item_catid='" . $detailsObj->get_itemcatid() .
      "', item_subcatid='" . $detailsObj->get_itemsubcatid();
    
if($detailsObj->get_itemimage()!= ""){
        $sql.="',item_image='" . $detailsObj->get_itemimage() ;
}
$sql.="' WHERE item_id=" . $detailsObj->get_itemid(); 

    error_log($sql);
    if ($connectionObj->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $connectionObj->error;
    }
  }

  public static function selectitem($catId, $subcatId)
  {
    $db = ConnectDb::getInstance();
    $connectionObj = $db->getConnection();
    $sql = "SELECT I.item_id AS ItemId,
    I.item_name AS ItemName,
    I.item_description AS ItemDescription,
    I.item_catid AS CategoryId,
    C.item_catName AS CategoryName,
    I.item_subcatid AS SubCategoryId,
    SC.item_subcatName AS SubCategoryName,
    I.item_image AS ItemImage
   
    FROM item_details I 
    JOIN item_category C ON I.item_catid=C.item_catid 
    JOIN item_subcategory SC ON I.item_subcatid=SC.item_subcatid 
    WHERE I.item_catid=$catId and I.item_subcatid=$subcatId";
    $result = $connectionObj->query($sql);
    $count = mysqli_num_rows($result);
    $itemdetailslist = [];
    if ($count > 0) {
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $view = new Item_Details();
        $view->set_itemid($row['ItemId']);
        $view->set_itemname($row['ItemName']);
        $view->set_itemdescription($row["ItemDescription"]);
        $view->set_itemsubcatid($row["SubCategoryId"]);
        $view->set_itemcatid($row["CategoryId"]);
        $view->set_itemcategoryname($row["CategoryName"]);
        $view->set_itemsubcategoryname($row["SubCategoryName"]); 
        
      
        array_push($itemdetailslist, $view);
      }
      header('Content-Type: application/json');
      echo json_encode($itemdetailslist);
    }
  }



  
  public static function delete($itemObj)
  {
    $db = ConnectDb::getInstance();
    $connectionObj = $db->getConnection();
    $sql = "DELETE from item_details where item_id='" . $itemObj . "'";
    if ($connectionObj->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $connectionObj->error;
    }
  }
}