<?php

namespace Core\Database;
interface DBConnectionInterface
{
    public function connect();
    public function query($query);
    public function close();
}
