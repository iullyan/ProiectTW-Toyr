<?php


class EventModel
{
    public function addSpecialEvent($name, $startingDate, $endintDate)
    {
        $sql = "INSERT INTO special_event (name, starting_date, ending_date) 
                    values (:eventName, :starting_date, :ending_date )";

        $query = $this->getconnection() > prepare($sql);
        $parameters = array(':eventName' => $name,
            ':starting_date' => $startingDate,
            ':ending_date' => $endintDate);
        $query->execute($parameters);
        return $this->getconnection()->lastInsertId();
    }

    public function addProductToSpecialEvent($productId, $eventId)
    {
        $sql = "INSERT INTO products_events (product_id, event_id)
                    values (:productId, :eventId)";

        $query = $this->getconnection() > prepare($sql);
        $parameters = array(':productId' => $productId, ':eventId' => $eventId);
        $query->execute($parameters);
        return $this->getconnection()->lastInsertId();

    }


    public function getCurrentEventDetails()
    {
        $sql = "SELECT * FROM special_event s WHERE s.starting_date <= now() LIMIT 1";

        $query = $this->getconnection()->prepare($sql);
        $query->execute();
        return ($query->rowcount() ? $query->fetch(PDO::FETCH_ASSOC) : false);
    }
}