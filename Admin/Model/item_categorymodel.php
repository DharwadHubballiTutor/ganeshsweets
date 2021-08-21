<?php
class Item_Category implements JsonSerializable
{
    private $item_catid ;
    private $item_catName;
    private	$item_catDescription;
    private	$item_catModifiedOn;
    private	$item_catCreatedBy;
    private $item_catCreatedOn;
    private $item_catModifiedBy	;
    private $table_name="item_category";
 
   function set_itemcatid($itemcatid)
    {
        $this->item_catid =$itemcatid;
    }
    function get_itemcatid()
    {
        return $this->item_catid ;
    }

    function set_itemcatname($itemcatname)
    {
        $this->item_catName=$itemcatname;
    }
    function get_itemcatname()
    {
        return $this->item_catName;
    }

    function set_itemcatdescription($itemcatdescription)
    {
        $this->item_catDescription=$itemcatdescription;
    }
    function get_itemcatdescription()
    {
        return $this->item_catDescription;
    }


    function set_itemcatcreatedon($itemcatcreatedon)
    {
        $this->item_catCreatedOn=$itemcatcreatedon;
    }
    function get_itemcatcreatedon()
    {
        return $this->item_catCreatedOn;
    }

    function set_itemcatcreatedby($itemcatcreatedby)
    {
        $this->item_catCreatedBy=$itemcatcreatedby;
    }
    function get_itemcatcreatedby()
    {
        return $this->item_catCreatedBy;
    }

    function set_itemcatmodifiedby($itemcatmodifiedby)
    {
        $this->item_catModifiedBy	=$itemcatmodifiedby;
    }
    function get_itemcatmodifiedby()
    {
        return $this->item_catModifiedBy;
    }

    public function jsonSerialize()
    {
        return 
            [
                'itemcatid' => $this->item_catid,
                'itemcatname' => $this->item_catName,
                'itemcatdescription' => $this->item_catDescription,
                
            ];
        
    }
}
