<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LanguageSeeder extends Seeder
{
    protected $table = 'languages';

    protected $data = [
        [
            'name' => 'Български',
            'code' => 'bg',
            'active' => 1,
        ],
        [
            'name' => 'English',
            'code' => 'en',
            'active' => 0,
        ],
    ];

    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table($this->table)->truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($this->data as $row) {
            $row['created_at'] = now();
            $row['updated_at'] = now();

            DB::table($this->table)->insert($row);
        }
    }
}
