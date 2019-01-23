<?php

namespace Storage;

use Database\DB;
use Filesystem\Filesystem;

class StorageFabric
{
    public function defineStorage($destination)
    {
        switch ($destination) {
            case 'database':
                return new DB();
                break;

            case 'filesystem':
                return new Filesystem();
                break;
        }
    }
}

