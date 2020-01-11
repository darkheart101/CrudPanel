<?php

namespace tkouleris\CrudPanel\File;

class FileEditor
{
    public function replace_line( $file, $line_number, $new_content):bool
    {
        if( ($line_number < 0) || !is_numeric($line_number)) return false;

        $line_number = $line_number - 1;
        $migration_code_lines = file($file); // reads an array of lines
        $migration_code_lines[$line_number] = str_replace($migration_code_lines[$line_number], $new_content, $migration_code_lines[$line_number]);
        $contents = "";
        foreach($migration_code_lines as $line)
        {
            $contents .= $line;
        }
        file_put_contents($file, $contents);

        return true;
    }

    public function delete_line( $file, $line_number )
    {
        if( ($line_number < 0) || !is_numeric($line_number)) return false;

        $line_number -= 1;
        $migration_code_lines = file($file); // reads an array of lines
        $migration_code_lines[$line_number] = str_replace($migration_code_lines[$line_number], " \n", $migration_code_lines[$line_number]);
        $contents = "";
        foreach($migration_code_lines as $line)
        {
            $contents .= $line;
        }
        file_put_contents($file, $contents);

        return true;
    }
}