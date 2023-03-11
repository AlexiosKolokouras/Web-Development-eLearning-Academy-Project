<?php

namespace Hotel;

use DateTime;
use Hotel\BaseService;

class Booking extends BaseService
{
    public function getListByUser($userId)
    {
        $parameters = [
            ':user_id' => $userId,
            ];
            return $this->fetchAll('SELECT booking.*, room.*, room_type.title as room_type
            FROM booking 
            INNER JOIN room ON booking.room_id = room.room_id
            INNER JOIN room_type ON room.type_id = room_type.type_id
            WHERE user_id = :user_id', $parameters); 
    }

    public function insert($roomId, $userId, $CheckInDate, $CheckOutDate)
    {
        $this->getPdo()->beginTransaction();

        // Get room info

        $parameters = [
            ':room_id' => $roomId
            ];
            $roomInfo = $this->fetch('SELECT * FROM room WHERE room_id = :room_id', $parameters); 
            $price = $roomInfo['price'];

            // Calculate final price
            $CheckInDateTime = new DateTime($CheckInDate);
            $CheckOutDateTime = new DateTime($CheckOutDate);
            $daysDiff = $CheckOutDateTime->diff($CheckInDateTime)->days;
            $totalPrice = $price * $daysDiff;

            // Book room
            $parameters = [
                ':room_id' => $roomId,
                ':user_id' => $userId,
                ':total_price' => $totalPrice,
                ':check_in_date' => $CheckInDate,
                ':check_out_date' => $CheckOutDate,
                ];
                $this->execute('INSERT INTO booking (room_id, user_id, total_price, check_in_date, check_out_date) VALUES (:room_id, :user_id, :total_price, :check_in_date, :check_out_date)', $parameters);

                return $this->getPdo()->commit();
    }
    public function isBooked($roomId, $CheckInDate, $CheckOutDate)
    {
        $parameters = [
            ':room_id' => $roomId,
            ':check_in_date' => $CheckInDate,
            ':check_out_date' => $CheckOutDate,
            ];

        $rows = $this->fetchAll('SELECT room_id
        FROM booking
        WHERE room_id = :room_id AND check_in_date <= :check_out_date AND check_out_date >= :check_in_date', $parameters);
        
        return count($rows) > 0;
        

    }

}