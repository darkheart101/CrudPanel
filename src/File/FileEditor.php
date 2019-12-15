<?php

namespace tkouleris\CrudPanel\File;

class FileEditor
{
    public function replace_line( $file, $line_number, $new_content):bool
    {
        $migration_code_lines = file($file); // reads an array of lines
        $migration_code_lines[16] = str_replace($migration_code_lines[16], "\n", $migration_code_lines[16]);
        $contents = "";
        foreach($migration_code_lines as $line)
        {
            $contents .= $line;
        }
        file_put_contents($file, $contents);

        return true;
    }
}