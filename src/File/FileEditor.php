<?php

namespace tkouleris\CrudPanel\File;

class FileEditor
{
    public function replace_line( $file, $line_number, $new_content):bool
    {
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
}