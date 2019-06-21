<?php
require '../../Config/config.php';
class PaymentModel extends Model
{
   private $name;
   private $phone;
   private $adress;
   private $city;
   private $county;
   private $postalCode;
   private $nameCard;
   private $numberCard;
   private $monthExp;
   private $yearExp;
   private $codeCVC;
   private $sameInvoiceAdress;

   public function setPayment($firstname,$lastname,$phone,$adress,$city,$county,$postalCode,$nameCard,$numberCard,$monthExp,$yearExp,$codeCVC,$sameInvoiceAdress)
   {
    $this->$lastname = $lastname;
    $this->$firstname = $firstname;
    $this->$phone = $phone;
    $this->$adress = $adress; 
    $this->$city = $city;
    $this->$county = $county;
    $this->$postalCode = $postalCode;
    $this->$nameCard = $nameCard;
    $this->$numberCard = $numberCard;
    $this->$monthExp = $monthExp;
    $this->$yearExp = $yearExp;
    $this->$codeCVC = $codeCVC;
    $this->$sameInvoiceAdress= $sameInvoiceAdress;
   }

   public function addPayment($firstname,$lastname,$phone,$adress,$city,$county,$postalCode,$nameCard,$numberCard,$monthExp,$yearExp,$codeCVC,$sameInvoiceAdress)
   {
      
   }
}



