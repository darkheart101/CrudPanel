<?php

namespace tkouleris\CrudPanel\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use tkouleris\CrudPanel\Models\MigrationFile;
use tkouleris\CrudPanel\Models\ModelFile;

class CrudPanelController extends Controller
{
    // View Controllers
    public function index()
    {
        $modelFiles = ModelFile::all()->take(5);
        return view('CrudPanel::crud_panel_index',compact('modelFiles'));
    }

    public function modelsIndex()
    {
        return view('CrudPanel::crud_panel_models');
    }

    // Other Requests
    public function create_model(Request $request, ModelFile $mf,MigrationFile $migf)
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

        $model = $mf::where('ModelFileName',$request->model_name)->first();

        if( $model == null)
        {
            $data = [
                'ModelFileName' =>$request->model_name
            ];
            $model_record = $mf::create($data);
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
            $migration_record = $migf::create($ins_migration_args);

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

    public function create_migration(Request $request, MigrationFile $migrationModel)
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

        Artisan::call('make:migration create_'.$request->table_name.'_table');
        $MigrationOutput = Artisan::output();
        $MigrationFile = trim(substr($MigrationOutput,19));

        $ins_migration_args = array();
        $ins_migration_args['MigrationFileName'] = $MigrationFile;
        $ins_migration_args['MigrationTable'] = $request->table_name;
        $migration_record = $migrationModel::create($ins_migration_args);

        // $dir = $dir = database_path()."/migrations/".$MigrationFile.'.php';
        // $contents = file_get_contents($dir);
        // $contents = str_replace(17, "testing line replacement", $contents);
        // dd($contents);
        // file_put_contents($dir, $contents);

        $file = database_path()."/migrations/".$MigrationFile.'.php';
        // $contents = file_get_contents($file);
        $migration_code_lines = file($file); // reads an array of lines
        $migration_code_lines[16] = str_replace($migration_code_lines[16], "\n", $migration_code_lines[16]);
        $contents = "";
        foreach($migration_code_lines as $line)
        {
            $contents .= $line;
        }
        file_put_contents($file, $contents);
        // function replace_a_line($data) {
        //    if (stristr($data, 'certain word')) {
        //      return "replaement line!\n";
        //    }
        //    return $data;
        // }
        // $data = array_map('replace_a_line',$data);
        // file_put_contents('myfile', implode('', $data));

        $message = $MigrationOutput;

        $results['success'] = true;
        $results['message'] = $message;
        $results['data'] = $migration_record;
        return $results;
    }

    public function migration_editor(Request $request,  MigrationFile $migrationModel)
    {
        $migration_file_id = $request->input('migration_file_id');

        $migration_record = $migrationModel::find($migration_file_id);

        return view('CrudPanel::crud_panel_migration_editor',compact('migration_record'));
    }
}
