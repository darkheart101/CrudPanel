<?php


namespace tkouleris\CrudPanel\Services;


use stdClass;
use tkouleris\CrudPanel\File\FileCreator;
use tkouleris\CrudPanel\File\FileDeleter;
use tkouleris\CrudPanel\File\FileEditor;
use tkouleris\CrudPanel\Repositories\Interfaces\IMigration;
use tkouleris\CrudPanel\Repositories\Interfaces\IMigrationFile;
use tkouleris\CrudPanel\Repositories\Interfaces\ITableField;

class MigrationService
{
    protected $R_migration_file;
    protected $R_migration;
    protected $R_table_field;
    protected $file_creator;
    protected $file_editor;
    protected $file_deleter;

    /**
     * MigrationService constructor.
     * @param IMigrationFile $R_migration_file
     * @param IMigration $R_migration
     * @param ITableField $R_table_field
     * @param FileCreator $file_creator
     * @param FileEditor $file_editor
     * @param FileDeleter $file_deleter
     */
    public function __construct(
        IMigrationFile $R_migration_file,
        IMigration $R_migration,
        ITableField $R_table_field,
        FileCreator $file_creator,
        FileEditor $file_editor,
        FileDeleter $file_deleter
    ){
        $this->R_migration_file = $R_migration_file;
        $this->R_migration = $R_migration;
        $this->R_table_field = $R_table_field;
        $this->file_creator = $file_creator;
        $this->file_editor = $file_editor;
        $this->file_deleter = $file_deleter;
    }

    /**
     * @param $table_name
     * @param null $model_file_id
     * @return array
     */
    public function create($table_name, $model_file_id = null)
    {
        $migration_name = 'create_'.$table_name.'_table';
        $migration_output = $this->file_creator->migration($migration_name);
        $MigrationMessage = $migration_output['message'];
        $MigrationFile = $migration_output['file'];

        $ins_migration_args = array();
        $ins_migration_args['MigrationFileName'] = $MigrationFile;
        $ins_migration_args['MigrationModelId'] = $model_file_id;
        $ins_migration_args['MigrationTable'] = $table_name;
        $migration_record = $this->R_migration_file->create($ins_migration_args);

        $output = array();
        $output['message'] = $MigrationMessage;
        $output['data'] = $migration_record;
        return $output;
    }

    public function list($filter = null)
    {
        return $migration_files = $this->R_migration_file->list($filter);
    }

    public function show_migration($migration_file_id)
    {
        return $this->R_migration_file->find_by_id($migration_file_id);
    }

    public function show_migration_fields($migration_file_id)
    {
        $filter = new stdClass();
        $filter->TableFieldMigrationId = $migration_file_id;
        return  $this->R_table_field->list($filter);
    }

    /**
     * @param $migration_file_id
     * @return array
     */
    public function delete($migration_file_id)
    {
        $migration_file_record = $this->R_migration_file->find_by_id($migration_file_id);
        if($this->migration_file_is_migrated($migration_file_record->MigrationFileName))
        {
            $output = array();
            $output['message'] = "File cannot be deleted! Already migrated";
            $output['success'] = false;
            return $output;
        }
        $deletedRecord = $this->R_migration_file->delete($migration_file_id);
        $this->file_deleter->migration($deletedRecord->MigrationFileName);

        $output = array();
        $output['success'] = true;
        $output['data'] = $migration_file_record;
        return $output;
    }

    /**
     * creates new table
     * @param $migration_file_id
     * @param $field_name
     * @param $field_type
     * @return mixed
     */
    public function create_table_field($migration_file_id,$field_name,$field_type)
    {
        $migration_record = $this->R_migration_file->find_by_id($migration_file_id );

        // create migration line
        $migration_line = "\t\t\t\$table->$field_type('$field_name');\n\n";

        $line = $this->R_table_field->next_migration_file_available_line($migration_file_id);

        $this->file_editor->replace_line($migration_record->MigrationFileFullPath,$line,$migration_line);

        $ins_table_field_rec = [
            'TableFieldMigrationId' => $migration_file_id,
            'TableFieldName' => $field_name,
            'TableFieldType' => $field_type,
            'TableFieldLineNumber' => $line
        ];
        $this->R_table_field->create($ins_table_field_rec);

        $results['success'] = true;
        $results['message'] = "done!";
        return $results;
    }

    /**
     * @param $TableFieldId
     * @param ITableField $r_table_field
     * @param FileEditor $file_editor
     */
    public function delete_table_field($TableFieldId)
    {
        $deleted_record = $this->R_table_field->delete( $TableFieldId );

        $filename = $deleted_record->MigrationFileName;
        $line_number = $deleted_record->TableFieldLineNumber;
        $file = database_path()."/migrations/".$filename.'.php';

        $this->file_editor->delete_line( $file, $line_number);
    }

    /**
     * @param $filename
     * @param IMigration $r_migration
     * @return bool
     */
    public function migration_file_is_migrated($filename)
    {
        if( $this->R_migration->find_by_filename( $filename ) != null)
        {
            return true;
        }

        return false;
    }
}
