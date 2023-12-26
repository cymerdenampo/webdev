<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueAcrossTables implements Rule
{
    protected $table1;
    protected $column1;
    protected $table2;
    protected $column2;
    protected $exceptId;

    public function __construct($table1, $column1, $table2, $column2, $exceptId = null)
    {
        $this->table1 = $table1;
        $this->column1 = $column1;
        $this->table2 = $table2;
        $this->column2 = $column2;
        $this->exceptId = $exceptId;
    }

    public function passes($attribute, $value)
    {
        $query1 = DB::table($this->table1)
            ->where($this->column1, $value)
            ->where(function ($query) {
                if ($this->exceptId) {
                    $query->where('id', '<>', $this->exceptId);
                }
            });

        $query2 = DB::table($this->table2)
            ->where($this->column2, $value)
            ->where(function ($query) {
                if ($this->exceptId) {
                    $query->where('id', '<>', $this->exceptId);
                }
            });

        return !$query1->exists() && !$query2->exists();
    }

    public function message()
    {
        return 'The :attribute has already been taken.';
    }
}
