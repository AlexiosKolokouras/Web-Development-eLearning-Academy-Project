<?php

namespace Hotel;

use Hotel\BaseService;

class CountOfGuest extends BaseService
{
    public function getCountOfGuest()
    {
        //Get all guests
        return $this->fetchAll('SELECT DISTINCT count_of_guests FROM room');
    }
}