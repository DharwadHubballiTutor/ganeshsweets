<?php
class Item_Details implements JsonSerializable
{
    private $item_id ;
    private $item_name;
    private	$item_description;
    private $item_categoryname;
    private $item_subcategoryname;
    private	$item_catid;
    private $item_subcatid;
    private $item_image;
    private $item_modifiedby;
    private $item_createdby;
    private $table_name="item_details";

   function set_itemid($itemid)
    {
        $this->item_id =$itemid;
    }
    function get_itemid()
    {
        return $this->item_id ;
    }

    function set_itemname($itemname)
    {
        $this->item_name=$itemname;
    }
    function get_itemname()
    {
        return $this->item_name;
    }

    function set_itemcategoryname($itemcategoryname)
    {
        $this->item_categoryname=$itemcategoryname;
    }
    function get_itemcategoryname()
    {
        return $this->item_categoryname;
    }
    function set_itemsubcategoryname($itemsubcategoryname)
    {
        $this->item_subcategoryname=$itemsubcategoryname;
    }
    function get_itemsubcategoryname()
    {
        return $this->item_subcategoryname;
    }



    function set_itemdescription($itemdescription)
    {
        $this->item_description=$itemdescription;
    }
    function get_itemdescription()
    {
        return $this->item_description;
    }




    function set_itemcatid($itemcatid)
    {
        $this->item_catid =$itemcatid;
    }
    function get_itemcatid()
    {
        return $this->item_catid ;
    }

    function set_itemsubcatid($itemsubcatid)
    {
        $this->item_subcatid =$itemsubcatid;
    }
    function get_itemsubcatid()
    {
        return $this->item_subcatid ;
    }

    function set_itemimage($itemimage)
    {
        $this->item_image=$itemimage;
    }
    function get_itemimage()
    {
        return $this->item_image;
    }



    
    function set_itemcreatedby($itemcreatedby)
    {
        $this->item_createdby=$itemcreatedby;
    }
    function get_itemcreatedby()
    {
        return $this->item_createdby;
    }

    function set_itemmodifiedby($itemmodifiedby)
    {
        $this->item_modifiedby	=$itemmodifiedby;
    }
    function get_itemmodifiedby()
    {
        return $this->item_modifiedby;
    }

 

    public function jsonSerialize()
    {
        return [
                'itemname' => $this->item_name,
                'itemid' => $this->item_id,

                'subCategory'=>$this->item_subcatid,
                'itemCategory' =>$this->item_catid,
              
                'itemimage'=>$this->item_image,
                'itemdescription' =>$this->item_description,

                'itemmodifiedby' =>$this->item_modifiedby,
                'itemcreatedby' =>$this->item_createdby 

        ];
    }
}
