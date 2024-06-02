<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class Resources extends Model
{
    use HasFactory, SoftDeletes;

    protected $guard_name = 'web';

    protected $forms = [];

    protected $reference = [];

    public function getForms() : array
    {
        return $this->forms;
    }

    public function getTableFields() : array
    {
        return Schema::getColumnListing($this->getTable());
    }

    public function getFilesList() : array
    {
        return [];
    }

    public function getReference() : array
    {
        return $this->reference;
    }

    public function createRules() : bool
    {
        return false;
    }

    public function updateRules() : bool
    {
        return false;
    }

    public function checkTableExists($table_name)
    {
        return Schema::hasTable($table_name);
    }

    public function searchable() : bool
    {
        return false;
    }
}
