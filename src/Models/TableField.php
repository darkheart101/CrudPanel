<?php

namespace tkouleris\CrudPanel\Models;

use Illuminate\Database\Eloquent\Model;

class TableField extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cp_table_fields';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'TableFieldId';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TableFieldMigrationId',
        'TableFieldName',
        'TableFieldType'
    ];
}
