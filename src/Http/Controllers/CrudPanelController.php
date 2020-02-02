<?php

namespace tkouleris\CrudPanel\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use stdClass;

use tkouleris\CrudPanel\File\FileEditor;
use tkouleris\CrudPanel\File\FileCreator;
use tkouleris\CrudPanel\Repositories\Interfaces\IMigrationFile;
use tkouleris\CrudPanel\Repositories\Interfaces\ITableField;
use tkouleris\CrudPanel\Services\ControllerService;
use tkouleris\CrudPanel\Services\ModelService;

class CrudPanelController extends Controller
{
    protected $controller_service;
    protected $model_service;

    /**
     * CrudPanelController constructor.
     * @param ControllerService $controller_service
     * @param ModelService $model_service
     */
    public function __construct(ControllerService $controller_service, ModelService $model_service)
    {
        $this->controller_service = $controller_service;
        $this->model_service = $model_service;
    }


    /**
     * @param IMigrationFile $r_migration_file
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(IMigrationFile $r_migration_file)
    {
        $filter = new stdClass();
        $filter->limit = 5;

        $modelFiles = $this->model_service->list($filter);
        $migrationFiles = $r_migration_file->list( $filter );
        $controllerFiles = $this->controller_service->list($filter);

        return view('CrudPanel::crud_panel_index',compact('modelFiles','migrationFiles','controllerFiles'));
    }
    

    // Other Requests

    /**
     *  creates new model
     * @param Request $request
     * @param IMigrationFile $r_migration_file
     * @param FileCreator $file_creator
     * @return mixed
     */
    public function create_model(Request $request, IMigrationFile $r_migration_file, FileCreator $file_creator)
    {
        $validation = $this->validate_create_model_request($request);
        if($validation['success'] = false)
        {
            $results['success'] = false;
            $results['message'] = $validation['message'];
            return $results;
        }

        $message = "";
        $model_creation_output = $this->model_service->create($request->model_name);
        $message .= $model_creation_output['message'];


        if( $request->create_migration == 1)
        {
            $migration_name = 'create_'.$request->model_name.'_table';
            $migration_output = $file_creator->migration($migration_name);
            $MigrationMessage = $migration_output['message'];
            $MigrationFile = $migration_output['file'];

            $ins_migration_args = array();
            $ins_migration_args['MigrationFileName'] = $MigrationFile;
            $ins_migration_args['MigrationModelId'] = $model_record->ModelFileId;
            $ins_migration_args['MigrationTable'] = $request->model_name;
            $migration_record = $r_migration_file->create($ins_migration_args);

            $message .= $MigrationMessage;
        }

        if( $request->create_controller == 1)
        {
            $output = $this->controller_service->create($request->model_name);
            $message .= $output['message'];
        }


        $results['success'] = true;
        $results['message'] = $message;
        return $results;
    }

    /**
     * creates new table
     * @param Request $request
     * @param IMigrationFile $r_migration_file
     * @param FileEditor $file_editor
     * @param ITableField $r_table_field
     * @return mixed
     */
    public function create_table_field(Request $request,
        IMigrationFile $r_migration_file,
        FileEditor $file_editor,
        ITableField $r_table_field)
    {
        $migr_record = $r_migration_file->find_by_id( $request->input('migration_file_id') );

        // create migration line
        $field_name = $request->input('field_name');
        $field_type = $request->input('field_type');
        $migr_line = "\t\t\t\$table->$field_type('$field_name');\n\n";

        $line = $r_table_field->next_migration_file_available_line($request->input('migration_file_id'));

        $file_editor->replace_line($migr_record->MigrationFileFullPath,$line,$migr_line);

        $ins_table_field_rec = [
            'TableFieldMigrationId' => $request->input('migration_file_id'),
            'TableFieldName' => $field_name,
            'TableFieldType' => $field_type,
            'TableFieldLineNumber' => $line
        ];
        $r_table_field->create($ins_table_field_rec);

        $results['success'] = true;
        $results['message'] = "done!";
        return $results;
    }

    /**
     * @param $TableFieldId
     * @param ITableField $r_table_field
     * @param FileEditor $file_editor
     */
    public function delete_table_field($TableFieldId, ITableField $r_table_field, FileEditor $file_editor )
    {
        $deleted_record = $r_table_field->delete( $TableFieldId );

        $filename = $deleted_record->MigrationFileName;
        $linenumber = $deleted_record->TableFieldLineNumber;
        $file = database_path()."/migrations/".$filename.'.php';

        $file_editor->delete_line( $file, $linenumber);
    }

    private function validate_create_model_request($request)
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

        $results['success'] = true;
        return $results;
    }

}
