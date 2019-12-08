<?php

namespace tkouleris\CrudPanel\Models;

use Illuminate\Database\Eloquent\Model;

class ModelFile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cp_model_files';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ModelFileId';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ModelFileName'
    ];
}
