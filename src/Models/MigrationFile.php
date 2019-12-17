<?php

namespace tkouleris\CrudPanel\Models;

use Illuminate\Database\Eloquent\Model;

class MigrationFile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cp_migration_files';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'MigrationFileId';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'MigrationFileName',
        'MigrationTable',
        'MigrationModelId'
    ];

    protected $appends = ['MigrationFileFullPath'];


    public function getMigrationFileFullPathAttribute()
    {
        return database_path()."/migrations/".$this->MigrationFileName.'.php';
    }
}
