<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\DB;

trait DisableForeignKeys
{
    protected function disableForeignKeys()
    {
        DB::statement('SET foreign_key_checks = 0');
    }

    protected function enableForeignKeys()
    {
        DB::statement('SET foreign_key_checks = 1');
    }

}
