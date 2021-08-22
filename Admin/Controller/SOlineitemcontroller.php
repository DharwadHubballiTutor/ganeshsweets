<?php
require_once "../DB Operations/SOlineItemOps.php";
require_once "../Utilities/Sanitization.php";
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    if (isset($_POST['SOlineItemId'])) {
        $SaleslineItem=new SaleslineItem();
        $SaleslineItem->set_SOlineitemId(Sanitization::test_input($_POST["SOlineItemId"]));
        $SaleslineItem->set_quantity(Sanitization::test_input($_POST["editedquantity"]));
        $SaleslineItem->set_price(Sanitization::test_input($_POST["editedprice"]));
      
        $SaleslineItem->set_totalamt(Sanitization::test_input($_POST["editedtotalamt"]));
          
        DBSOLineItem::update($SaleslineItem);
    } elseif (isset($_POST["action"]) && $_POST["action"] == 'delete') {
        DBSOLineItem::delete($_POST["id"]);
    } else {
        $SaleslineItem=new SaleslineItem();
        $SaleslineItem->set_itemid($_POST['additemid']);
        $SaleslineItem->set_SOID(Sanitization::test_input($_POST["SOID"]));
        $SaleslineItem->set_quantity(Sanitization::test_input($_POST["quantity"]));
        $SaleslineItem->set_price(Sanitization::test_input($_POST["price"]));
        $SaleslineItem->set_totalamt(Sanitization::test_input($_POST["totalamt"]));
        $SaleslineItem->set_unit(Sanitization::test_input($_POST["unit"]));
        DBSOLineItem::insert($SaleslineItem);
        header("location: ../View/SOlineItemView.php?id=".$_POST["SOID"]);
    }
}
//else if($_SERVER["REQUEST_METHOD"]=="GET"){
//   DBLineItem::getLineItemByQuoteId($_GET['id']);
//   // header("location: ../View/SOlineItemView.php?id=".$_POST["SOID"]);
// }

?>