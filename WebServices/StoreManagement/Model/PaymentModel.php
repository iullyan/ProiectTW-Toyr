<?php
require '../../Config/config.php';
require_once 'Model.php';
require_once 'Utility.php';
require_once 'QueryProductBuilder.php';

class PaymentModel extends Model
{
   private $lastname;
   private $firstname;
   private $phone;
   private $address;
   private $city;
   private $county;
   private $postalCode;
   private $nameCard;
   private $numberCard;
   private $monthExp;
   private $yearExp;
   private $codeCVC;
   private $sameInvoiceAdress;

   public function setPayment($firstname,$lastname,$phone,$address,$city,$county,$postalCode,$nameCard,$numberCard,$monthExp,$yearExp,$codeCVC,$sameInvoiceAdress)
   {
    $this->$lastname = $lastname;
    $this->$firstname = $firstname;
    $this->$phone = $phone;
    $this->$address = $address; 
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

   public function addPayment($orderId,$id_card,$amount)
   {
      $sql= "INSERT INTO payments(order_id, credit_card_id, amount)
      values(:orderId,:idCard,:amount)";
      $parameters = array (
         'orderId' => $orderId,
         'idCard' => $id_card,
         '$amount' => $amount
      );
      $query = $this->getConnection()->prepare($sql);
      return ($query->execute($parameters) ? true : false);
   }

   public function addAddress($user_id,$firstname,$lastname,$phone,$address,$city,$county,$postalCode)
   {
      $sql= "INSERT INTO addresses (user_id, firstname, lastname, telephone, county, locality, street_address, postal_code) 
      values(:userId,:firstname,:lastname,:telephone,:county,:locality,:address,:postal)";
      $parameters = array(
         'userId' => $user_id,
         ':firstname' => $firstname,
         ':lastname' => $lastname,
         ':telephone' => $phone,
         ':county' => $county,
         ':locality' => $city,
         ':address' => $address,
         ':postal' => $postalCode);
      $query = $this->getConnection()->prepare($sql);
      return ($query->execute($parameters) ? true : false);
   }

   public function addCreditCard($nameCard,$numberCard,$monthExp,$yearExp,$codeCVC)
   {
      $sql= "INSERT INTO credit_cards (bank_name, cardholder, card_number, expiration_month, expiration_year, security_code) 
      values(:bank,:name,:cardNumber,:expMonth,:expYear,:code)";
       $parameters = array(
         ':bank' => '[Placeholder]',
         ':name' => $nameCard,
         ':cardNumber' => $numberCard,
         ':expMonth' => $monthExp,
         ':expYear' => $yearExp,
         ':code' => $codeCVC);
         $query = $this->getConnection()->prepare($sql);
      return ($query->execute($parameters) ? true : false);
   }
   

   public function addOrder($userId,$status)
   {
      $sql= "INSERT INTO orders (user_id, status) 
      values(:userId,:status)";
      $parameters = array(
         ':userId' => $userId,
         ':status' => $status);
      $query = $this->getConnection()->prepare($sql);
      return ($query->execute($parameters) ? true : false);
   }

   public function addOrderItems($orderId,$productId,$quantity)
   {  
      $sql= "INSERT INTO orders_items (order_id, product_id, quantity)
      values(:orderId,:productId,:quantity)";
      $parameters = array(
         ':orderId' => $orderId,
         ':productId' => $productId,
         ':quantity' => $quantity
      );
      $query = $this->getConnection()->prepare($sql);
      return ($query->execute($parameters) ? true : false);
   }

   public function deleteOrderItems($orderId,$productId)
   {
      $sql = "DELETE FROM orders_items WHERE order_id = :ordertId AND product_id = :productId";
      $parameters = array(
         ':ordertId' => $orderId,
         ':productId' => $productId
      );
      if (!$query->execute($parameters))
         return false;
      return true;
   }
}



