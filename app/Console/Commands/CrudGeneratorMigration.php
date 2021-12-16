<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Reference;

class CrudGeneratorMigration extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crudgen:migration {name}
                            {--schema= : type:name SINGULAR}
                            {--reference= : references,on,entity }
                            {--json= : Name of JSON file}';

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
    protected $stub = "/stubs/migration.create.stub";

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


        $jsonpath = '/app/Console/crudDataFiles/';
        $stub = $this->files->get(base_path($this->getStub()));
        $tableName = lcfirst($this->argument('name')) . "s";
        $schemaPlan = $this->option('schema');
        $className = 'Create' . ucwords($tableName) . 'Table';

        //$schemaPlan=$this->userInput($schemaPlan);


        if($this->option('json') != null ) {
            $this->warn($jsonpath . $this->option("json"));

            if (!file_exists(base_path($jsonpath . $this->option("json"))))
                throw new Exception('Path Not Present!');

            return $this->schemaUp($stub,$this->buildJSONSchema($this->readJSON($jsonpath)))
                ->replaceTable($stub,$tableName)                     //must be plural
                ->replaceClass($stub,$className);

        }
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
     * Build the model class with the given json file.
     *
     *
     *
     * @return string
     */
    protected function buildJSONSchema($jsonObj){

        $variables = $jsonObj->variables;
        $finalMigration="";
        foreach($variables as $item){

            if($item->type == "bigIncrements"){
                $finalMigration.="\$table->".$item->type."('".$item->name."');\n";
            }
            else if($item->type == "bigInteger"){
                $finalMigration.="\$table->".$item->type."('".$item->name."')->unsigned();\n";
            }else if($item->type == "integer" || $item->type == "int"){
                $finalMigration.="\$table->"."integer"."('".$item->name."');\n";
            }else if($item->type == "unsignedBigInteger"){
                $finalMigration.="\$table->".$item->type."('".$item->name."');\n";
            }
            else if($item->type == "boolean"){
                $finalMigration.="\$table->".$item->type."('".$item->name."');\n";
            }
            else if($item->type == "char"){
                $finalMigration.="\$table->".$item->type."('".$item->name."',1);\n"; // UPDATE!!!!!!!!!!!!!!!!!!!
            }
            else if($item->type == "date"){
                $finalMigration.="\$table->".$item->type."('".$item->name."');\n";
            }
            else if($item->type == "double"){
                $finalMigration.="\$table->".$item->type."('".$item->name."',8,2);\n";
            }
            else if($item->type == "float"){
                $finalMigration.="\$table->".$item->type."('".$item->name."');\n";
            }
            else if($item->type == "longText"){
                $finalMigration.="\$table->".$item->type."('".$item->name."');\n";
            }
            else if($item->type == "string"){
                $finalMigration.="\$table->".$item->type."('".$item->name."');\n";
            }
            else if($item->type == "text"){
                $finalMigration.="\$table->".$item->type."('".$item->name."');\n";
            }
            else if($item->type == "time"){
                $finalMigration.="\$table->".$item->type."('".$item->name."',\$precision = 0);\n";
            }
            else {

                $finalMigration.="\$table->string('".$item->name."');\n";

                $this->info("\"".$item->type."\" NOT RECOGNISED AS TYPE. SET AS STRING!!!");
            }


        }

        if(isset($jsonObj->foreignKey)) {
            $foreignKey = $jsonObj->foreignKey;
            if ($foreignKey !== null) {
               // $this->info("some:" . $foreignKey->on . ": ");
                $finalMigration = $this->buildJSONForeignKey($finalMigration, $this->readJSON('./app/Console/crudDataFiles/'));

            }
        }

        return $finalMigration;
    }

    /**
     * Creates foreign key
     * from JSON file
     *
     * @param  string  $builtSchema
     * * @param  object  $jsonObj
     *
     * @return string
     */
    protected function buildJSONForeignKey($builtSchema, $jsonObj){

        $foreignKey = $jsonObj->foreignKey;
        foreach ($foreignKey as $item) {
            $template = "\$table->foreign('" . $item->column . "')->references('" . $item->references . "')->on('" . $item->on . "');\n";
            $builtSchema .= $template;
        }
        return $builtSchema;

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
            }else if($item['type'] == "unsignedBigInteger"){
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
        $foreignKey = $this->option('reference');
        if($foreignKey !== null) {
            $this->info("good:".$foreignKey);
           $finalMigration=$this->buildForeignKey($finalMigration);

        }


        return $finalMigration;
    }


    /**
     * Creates foreign key
     * is added to buildSchema method
     *
     * @param  string  $builtSchema
     *
     * @return string
     */
    protected function buildForeignKey($builtSchema){

        $foreignKey = $this->option('reference');
        $exploded = explode(",",$foreignKey);
        $variable=$exploded[0];
        $references = $exploded[1];
        $on = $exploded[2];
        $template ="\$table->foreign('".$variable."')->references('".$references."')->on('".$on."');\n";
        $builtSchema .= $template;

    return $builtSchema;

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

    /**
     * Read JSON
     *
     * @return object
     */
    protected function readJSON($path){

        $jsonpath = $this->files->get(base_path($path . $this->option("json")));

        $json = json_decode($jsonpath);

        return $json;

    }


}
