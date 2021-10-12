<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class CrudGeneratorMigration extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crudgen:migration {name}
                            {--schema=: type:name SINGULAR}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command creates migration';

    /**
     * The name of stub path being used.
     *
     * @var string
     */
    protected $stub = "./stubs/migration.create.stub";

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function getPath($name)
    {
        $migrationName = str_replace($this->laravel->getNamespace(), '', $name . 's');
        $datePrefix = date('Y_m_d_His');

        return database_path('/migrations/') . $datePrefix . '_create_' . $migrationName . '_table.php';
    }




    /**
     * Build the model class with the given name.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function buildClass($name){

        $stub = $this->files->get($this->getStub());
        $tableName = lcfirst($this->argument('name')) . "s";
        $schemaPlan = $this->option('schema');
        $className = 'Create' . ucwords($tableName) . 'Table';

        $schemaPlan=$this->userInput($schemaPlan);


        return $this->schemaUp($stub,$this->buildSchema($schemaPlan))
            ->replaceTable($stub,$tableName)                     //must be plural
            ->replaceClass($stub,$className);


    }

    /**
     * Build the model class with the given name.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function userInput($schemaPlan){

        $answer=$this->ask("Any more schema data types for migration? y/N:");
        $temp=$schemaPlan;

        while($answer=='y'){

            $data=$this->ask("Enter schema data: ");
            $temp.=','.$data;
            $answer=$this->ask("Any more schema data types for migration? y/N:");
        }

       return $temp;


    }



    /**
     * Build the model class with the given name.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function buildSchema($schemaPlan){

       $exploded = explode(",",$schemaPlan);
       $schemaItems=array();
       $finalMigration="";
       $i=0;

       foreach($exploded as $item){
           $temp=explode(":", $item);
           $schemaItems[$i]['type'] = trim($temp[0]);
           $schemaItems[$i]['name'] = trim($temp[1]);
           $i++;
       }

        foreach($schemaItems as $item){

            if($item['type'] == "bigIncrements"){

                $finalMigration.="\$table->".$item['type']."('".$item['name']."');\n";
            }
            else if($item['type'] == "bigInteger"){
                $finalMigration.="\$table->".$item['type']."('".$item['name']."');\n";
            }
            else if($item['type'] == "binary"){
                $finalMigration.="\$table->".$item['type']."('".$item['name']."');\n";
            }
            else if($item['type'] == "boolean"){
                $finalMigration.="\$table->".$item['type']."('".$item['name']."');\n";
            }
            else if($item['type'] == "char"){
                $finalMigration.="\$table->".$item['type']."('".$item['name']."',100);\n"; // UPDATE!!!!!!!!!!!!!!!!!!!
            }
            else if($item['type'] == "date"){
                $finalMigration.="\$table->".$item['type']."('".$item['name']."');\n";
            }
            else if($item['type'] == "double"){
                $finalMigration.="\$table->".$item['type']."('".$item['name']."',8,2);\n";
            }
            else if($item['type'] == "float"){
                $finalMigration.="\$table->".$item['type']."('".$item['name']."');\n";
            }
            else if($item['type'] == "longText"){
                $finalMigration.="\$table->".$item['type']."('".$item['name']."');\n";
            }
            else if($item['type'] == "string"){
                $finalMigration.="\$table->".$item['type']."('".$item['name']."');\n";
            }
            else if($item['type'] == "text"){
                $finalMigration.="\$table->".$item['type']."('".$item['name']."');\n";
            }
            else if($item['type'] == "timestamps"){
                $finalMigration.="\$table->".$item['type']."('".$item['name']."');\n";
            }
            else {
                $finalMigration.="\$table->string('".$item['name']."');\n";
                $this->info("\"".$item['type']."\" NOT RECOGNISED AS TYPE. SET AS STRING!!!");
            }


        }

        return $finalMigration;
    }



    /**
     * Execute the console command.
     *
     * @return int
     */

    protected function getStub()
    {
        return $this->stub;
    }


    protected function schemaUp(&$stub,$schemaUp)
    {
        $stub = str_replace(
            '{{schema_up}}', $schemaUp, $stub
        );

        return $this;
    }


    protected function replaceTable(&$stub,$table)
    {

        $stub = str_replace(
            '{{ table }}', $table,$stub
        );

        return $this;
    }

}
