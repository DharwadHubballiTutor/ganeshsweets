<?php
require_once "../DB Operations/lineItemOps.php";
if($_SERVER["REQUEST_METHOD"]=="GET"){
    error_log($_GET['id']);
    DBLineItem::getLineItemByQuoteId($_GET['id']);
  }

?>