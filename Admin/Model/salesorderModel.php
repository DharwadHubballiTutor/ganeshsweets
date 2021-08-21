<?php
class SalesOrder implements JsonSerializable
{
    private $Id;
    private $SOcode;
    private $CustomerId;
    private $Item_id;
    private $Price;
    private $Quantity;
    private $TotalAmt;
    private $PendingAmt;
    private $salesPDFName;
    private $SalesDate;
    private $Unit;
    private $UnitFactor;
    private $customerPhone;
    private $customerEmail;
    private $customerAddress;
    private $city;

    public function set_id($id)
    {
        $this->Id=$id;
    }
    public function get_id()
    {
        return $this->Id;
    }
    /**
     * Get the value of SOID
     */
    public function getSOcode()
    {
        return $this->SOcode;
    }

    /**
     * Set the value of SOID
     *
     * @return  self
     */
    public function setSOcode($SOcode)
    {
        $this->SOcode = $SOcode;

        return $this;
    }
    public function set_customer($customer)
    {
        $this->CustomerId=$customer;
    }
    public function get_customer()
    {
        return $this->CustomerId;
    }
    public function set_itemid($itemid)
    {
        $this->Item_id=$itemid;
    }
    public function get_itemid()
    {
        return $this->Item_id;
    }
    public function set_itemperpieceprice($itemperpieceprice)
    {
        $this->Price=$itemperpieceprice;
    }
    public function get_itemperpieceprice()
    {
        return $this->Price;
    }
    public function set_itemquantity($itemquantity)
    {
        $this->Quantity=$itemquantity;
    }
    public function get_itemquantity()
    {
        return $this->Quantity;
    }
    public function set_totalAmount($totalAmount)
    {
        $this->TotalAmt=$totalAmount;
    }
    public function get_totalAmount()
    {
        return $this->TotalAmt;
    }

    public function set_pendingAmount($pendingAmount)
    {
        $this->PendingAmt=$pendingAmount;
    }
    public function get_pendingAmount()
    {
        return $this->PendingAmt;
    }
    
    public function set_salesdate($salesdate)
    {
        $this->SalesDate=$salesdate;
    }
    public function get_salesdate()
    {
        return $this->SalesDate;
    }

    public function set_salesPDFName($salesPDFName){
        $this->salesPDFName=$salesPDFName;
    }
    public function get_salesPDFName(){
       return $this->salesPDFName;
    }
    
    public function set_unit($unit){
        $this->Unit=$unit;
    }
    public function get_unit(){
       return $this->Unit;
    }
    public function set_unitfactor($unitfactor){
        $this->UnitFactor=$unitfactor;
    }
    public function get_unitfactor(){
       return $this->UnitFactor;
    }
    
    public function jsonSerialize()
    {
        return [
                'id'=>$this->id,
                'SOcode' => $this->SOcode,
                'customer' => $this->CustomerId,
                'itemid' => $this->Item_id,
                'itemquantity' => $this->Quantity,
                'itemperpieceprice' => $this->Price,
                'totalAmount' => $this->TotalAmt,
                'pendingAmount' => $this->PendingAmt,
                'salesdate'=>$this->salesdate,
                'CustomerName'=>$this->CustomerName,
                'CustomerContactNumber'=>$this->CustomerContactNumber,
                'CustomerAddress'=>$this->CustomerAddress,
                'Name'=>$this->Name,
                'Itemcatname'=>$this->Itemcatname,
                'Itemsubcatname'=>$this->Itemsubcatname,
                'Quantity'=>$this->Quantity,
                'UnitName'=>$this->unitName,
                'salesPDFName' => $this->salesPDFName,
                
        ];
    }
    public function getCustomerName()
    {
        return $this->CustomerName;
    }

    /**
     * Set the value of Name
     *
     * @return  self
     */ 
    public function setCustomerName($CustomerName)
    {
        $this->CustomerName = $CustomerName;

        return $this;
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

    public function getItemcatname()
    {
        return $this->Itemcatname;
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

    public function getItemsubcatname()
    {
        return $this->Itemsubcatname;
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
    
    public function getQuantity()
    {
        return $this->Quantity;
    }

    /**
     * Set the value of Name
     *
     * @return  self
     */ 
    public function setQuantity($Quantity)
    {
        $this->Quantity = $Quantity;

        return $this;
    }

  

    public function getCustomerAddress()
    {
        return $this->CustomerAddress;
    }

    /**
     * Set the value of Name
     *
     * @return  self
     */ 
    public function setCustomerAddress($CustomerAddress)
    {
        $this->CustomerAddress = $CustomerAddress;

        return $this;
    }

   

    public function getCustomerContactNumber()
    {
        return $this->CustomerContactNumber;
    }

    /**
     * Set the value of Name
     *
     * @return  self
     */ 
    public function setCustomerContactNumber($CustomerContactNumber)
    {
        $this->CustomerContactNumber = $CustomerContactNumber;

        return $this;
    }


    /**
     * Get the value of customerEmail
     */
    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    /**
     * Set the value of customerEmail
     *
     * @return  self
     */
    public function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;

        return $this;
    }

 
   

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }
}


?>