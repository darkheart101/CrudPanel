<?php

namespace tkouleris\CrudPanel\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use tkouleris\CrudPanel\File\FileEditor;
use tkouleris\CrudPanel\Repositories\Interfaces\IMigration;
use tkouleris\CrudPanel\Repositories\Interfaces\IMigrationFile;
use tkouleris\CrudPanel\Repositories\Interfaces\ITableField;
use tkouleris\CrudPanel\Services\MigrationService;

class CP_migrationController extends Controller
{
    protected $migration_service;

    /**
     * CP_migrationController constructor.
     * @param MigrationService $migration_service
     */
    public function __construct(MigrationService $migration_service)
    {
        $this->migration_service = $migration_service;
    }

    public function list()
    {
        $migration_files = $this->migration_service->list();
        return view('CrudPanel::crud_panel_migrations',compact('migration_files'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create_migration(Request $request)
    {
        $validation = $this->validate_create_migration($request);
        if($validation['success'] == false)
        {
            $results['success'] = false;
            $results['message'] = $validation['message'];
            return $results;
        }
        return $this->migration_service->create($request->table_name);
    }

    /**
     * @param Request $request
     * @param IMigration $r_migration
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function delete(Request $request, IMigration $r_migration)
    {
        $mc_output = $this->migration_service->delete($request->MigrationFileId);
        if($mc_output['success'] == false)
        {
            return response($mc_output['message'],409);
        }
        return $mc_output['data'];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function migration_editor(Request $request)
    {
        $migration_file_id = $request->input('migration_file_id');
        $migration_record = $this->migration_service->show_migration($migration_file_id);
        $migrated = $this->migration_service->migration_file_is_migrated( $migration_record->MigrationFileName);
        $tableFieldList = $this->migration_service->show_migration_fields($migration_file_id);
        return view('CrudPanel::crud_panel_migration_editor',
            compact('migration_record','tableFieldList', 'migrated'));
    }

    /**
     * creates new table
     * @param Request $request
     * @param IMigrationFile $r_migration_file
     * @param FileEditor $file_editor
     * @param ITableField $r_table_field
     * @return mixed
     */
    public function create_table_field(Request $request)
    {
        $migration_file_id = $request->input('migration_file_id');
        $field_name = $request->input('field_name');
        $field_type = $request->input('field_type');
        $this->migration_service->create_table_field($migration_file_id,$field_name,$field_type);
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
        $this->migration_service->delete_table_field($TableFieldId);
    }

    private function validate_create_migration($request)
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

        $results['success'] = true;
        return $results;
    }


}
