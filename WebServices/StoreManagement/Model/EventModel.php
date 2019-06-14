<?php

require_once 'Model.php';

class EventModel extends Model
{
    public function addSpecialEvent($name, $startingDate, $endintDate)
    {
        $sql = "INSERT INTO special_event (name, starting_date, ending_date) 
                    values (:eventName, :starting_date, :ending_date )";

        $query = $this->getConnection()-> prepare($sql);
        $parameters = array(':eventName' => $name,
            ':starting_date' => $startingDate,
            ':ending_date' => $endintDate);
        if(! $query->execute($parameters))
            return false;
        return $this->getConnection()->lastInsertId();
    }

    public function addProductToSpecialEvent($productId, $eventId)
    {
        $sql = "INSERT INTO products_events (product_id, event_id)
                    values (:productId, :eventId)";

        $query = $this->getConnection()-> prepare($sql);
        $parameters = array(':productId' => $productId, ':eventId' => $eventId);
        if(! $query->execute($parameters))
            return false;
        return $this->getConnection()->lastInsertId();

    }


    public function getCurrentEventDetails()
    {
        $sql = "SELECT * FROM special_event s WHERE s.starting_date <= now() AND s.ending_date >=now()  LIMIT 1";

        $query = $this->getConnection()->prepare($sql);
        if(! $query->execute())
            return false;
        return ($query->rowcount() ? $query->fetch(PDO::FETCH_ASSOC) : false);
    }
}