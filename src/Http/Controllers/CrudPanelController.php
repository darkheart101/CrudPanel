<?php

namespace tkouleris\CrudPanel\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use stdClass;
use tkouleris\CrudPanel\Models\ModelFile;
use tkouleris\CrudPanel\File\FileEditor;
use tkouleris\CrudPanel\Repositories\Interfaces\IMigrationFile;
use tkouleris\CrudPanel\Repositories\Interfaces\IModelFile;

class CrudPanelController extends Controller
{
    // View Controllers
    public function index(IModelFile $r_model_file)
    {
        $filter = new stdClass();
        $filter->limit = 5;
        $modelFiles = $r_model_file->list($filter);
        return view('CrudPanel::crud_panel_index',compact('modelFiles'));
    }

    public function modelsIndex()
    {
        return view('CrudPanel::crud_panel_models');
    }

    // Other Requests
    public function create_model(Request $request, IModelFile $r_model_file, IMigrationFile $r_migration_file)
    {
        if(($request->model_name == null) || (!$request->has('model_name')) )
        {
            $results['success'] = false;
            $results['message'] = "No model name selected!";
            return $results;
        }

        if ($request->model_name == trim($request->model_name) && strpos($request->model_name, ' ') !== false) {
            $results['success'] = false;
            $results['message'] = "Model name must not contain spaces!";
            return $results;
        }

        $model = $r_model_file->find_by_filename($request->model_name);
        if( $model == null)
        {
            $data = [
                'ModelFileName' =>$request->model_name
            ];
            $model_record = $r_model_file->create($data);
        }

        Artisan::call('make:model '.$request->model_name);
        $message = Artisan::output();

        if( $request->create_migration == 1)
        {
            Artisan::call('make:migration create_'.$request->model_name.'_table');
            $MigrationOutput = Artisan::output();
            $MigrationFile = trim(substr($MigrationOutput,19));

            $ins_migration_args = array();
            $ins_migration_args['MigrationFileName'] = $MigrationFile;
            $ins_migration_args['MigrationModelId'] = $model_record->ModelFileId;
            $migration_record = $r_migration_file->create($ins_migration_args);

            $message .= $MigrationOutput;
        }

        if( $request->create_controller == 1)
        {
            Artisan::call('make:controller '.$request->model_name.'Controller');
            $message .= Artisan::output();
        }


        $results['success'] = true;
        $results['message'] = $message;
        return $results;
    }

    public function create_table_field(Request $request, IMigrationFile $r_migration_file, FileEditor $file_editor)
    {
        $migr_record = $r_migration_file->find_by_id( $request->input('migration_file_id') );

        // create migration line
        $field_name = $request->input('field_name');
        $field_type = $request->input('field_type');
        $migr_line = "\t\t\t\$table->$field_type('$field_name');\n\n";

        $file_editor->replace_line($migr_record->MigrationFileFullPath,17,$migr_line);

        $results['success'] = true;
        $results['message'] = "done!";
        return $results;
    }
}
