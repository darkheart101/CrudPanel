<?php

namespace tkouleris\CrudPanel\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use tkouleris\CrudPanel\File\FileEditor;
use tkouleris\CrudPanel\File\FileCreator;
use tkouleris\CrudPanel\Repositories\Interfaces\IMigrationFile;

class CP_migrationController extends Controller
{

    public function create_migration(Request $request,
        IMigrationFile $r_migration_file,
        FileEditor $file_editor,
        FileCreator $file_creator)
    {
        if(($request->table_name == null) || (!$request->has('table_name')) )
        {
            $results['success'] = false;
            $results['message'] = "No table name selected!";
            return $results;
        }

        if ($request->table_name == trim($request->table_name) && strpos($request->table_name, ' ') !== false) {
            $results['success'] = false;
            $results['message'] = "Table name must not contain spaces!";
            return $results;
        }

        $MigrationOutput = $file_creator->migration('create_'.$request->table_name.'_table');

        $ins_migration_args = array();
        $ins_migration_args['MigrationFileName'] = $MigrationOutput['file'];
        $ins_migration_args['MigrationTable'] = $request->table_name;
        $migration_record = $r_migration_file->create($ins_migration_args);

        $file = database_path()."/migrations/".$MigrationOutput['file'].'.php';
        $file_editor->replace_line($file,17,"\n");

        $results['success'] = true;
        $results['message'] = $MigrationOutput['message'];
        $results['data'] = $migration_record;
        return $results;
    }

    public function migration_editor(Request $request, IMigrationFile $r_migration_file)
    {
        $migration_file_id = $request->input('migration_file_id');

        $migration_record = $r_migration_file->find_by_id($migration_file_id);

        return view('CrudPanel::crud_panel_migration_editor',compact('migration_record'));
    }

}
