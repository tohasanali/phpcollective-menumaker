<?php

namespace PhpCollective\MenuMaker\Support;

use Illuminate\Support\Facades\DB;

class Database
{
    public static function likeOperator()
    {
        return DB::getDriverName() === 'pgsql' ? 'ilike' : 'like';
    }
}
