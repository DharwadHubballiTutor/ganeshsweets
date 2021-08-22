<?php
class SaleslineItem implements JsonSerializable
{
    private $SOID;
    private $SOlineitemId;
    private $Item_id;
    private $unit_id;
    private $Price;
    private $Quantity;
    private $TotalAmt;
    private $PendingAmt;
    private $GST;
   
    public function set_GST($GST)
    {
        $this->GST=$GST;
    }
    public function get_GST()
    {
        return $this->GST;
    }
    public function set_totalamt($totalamt)
    {
        $this->TotalAmt=$totalamt;
    }
    public function get_totalamt()
    {
        return $this->TotalAmt;
    }


    public function get_SOID()
    {
        return $this->SOID;
    }
    public function set_SOID($SOID)
    {
        $this->SOID=$SOID;
    }
    public function get_SOlineitemId()
    {
        return $this->SOlineitemId;
    }
    public function set_SOlineitemId($SOlineitemId)
    {
        $this->SOlineitemId=$SOlineitemId;
    }
    public function set_itemid($itemid)
    {
        $this->Item_id =$itemid;
    }
    public function get_itemid()
    {
        return $this->Item_id ;
    }
    public function set_price($price)
    {
        $this->Price=$price;
    }
    public function get_price()
    {
        return $this->Price;
    }
    public function set_quantity($quantity)
    {
        $this->Quantity=$quantity;
    }
    public function get_quantity()
    {
        return $this->Quantity;
    }
    
    public function set_unit($unit)
    {
        $this->unit_id=$unit;
    }
    public function get_unit()
    {
        return $this->unit_id;
    }


    public function jsonSerialize()
    {
        return [
                'SOID' => $this->SOID,
                'SOlineitemId' => $this->SOlineitemId,
                'itemid' => $this->Item_id,
                'price' => $this->Price,
                'quantity'=> $this->Quantity,
                'totalamt' => $this->TotalAmt,
                'unit'=>$this->unit_id,
                'unitName'=>$this->unitName,
                'GST' => $this->GST,
                'Name' => $this->Name,
                'Itemcatname'=>$this->Itemcatname,
                'Itemsubcatname'=>$this->Itemsubcatname,
        ];
    }

    public function getName()
    {
        return $this->Name;
    }

    /**
     * Set the value of Name
     *
     * @return  self
     */
    public function setName($Name)
    {
        $this->Name = $Name;

        return $this;
    }
 

    /**
     * Set the value of Name
     *
     * @return  self
     */ 
    public function setItemcatname($Itemcatname)
    {
        $this->Itemcatname = $Itemcatname;

        return $this;
    }

    public function getItemcatname()
    {
        return $this->Itemcatname;
    }

    /**
     * Set the value of Name
     *
     * @return  self
     */ 
    public function setItemsubcatname($Itemsubcatname)
    {
        $this->Itemsubcatname = $Itemsubcatname;

        return $this;
    }
    public function getItemsubcatname()
    {
        return $this->Itemsubcatname;
    }

    public function getunitName()
    {
        return $this->unitName;
    }

    /**
     * Set the value of Name
     *
     * @return  self
     */ 
    public function setunitName($unitName)
    {
        $this->unitName = $unitName;

        return $this;
    }



    /**
     * Get the value of PendingAmt
     */
    public function getPendingAmt()
    {
        return $this->PendingAmt;
    }

    /**
     * Set the value of PendingAmt
     */
    public function setPendingAmt($PendingAmt): self
    {
        $this->PendingAmt = $PendingAmt;

        return $this;
    }
}