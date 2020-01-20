<?php

namespace tkouleris\CrudPanel\Models;

use Illuminate\Database\Eloquent\Model;

class ControllerFile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cp_controller_files';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ControllerFileId';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ControllerFileFilename',
    ];

}
