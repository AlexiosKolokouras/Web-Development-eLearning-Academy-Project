<?php

namespace Hotel;

use Hotel\BaseService;

class RoomType extends BaseService
{
    public function getAllTypes()
    {
        //Get all types
        return $this->fetchAll('SELECT * FROM room_type');
    }
}