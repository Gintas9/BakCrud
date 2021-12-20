<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\URL;
use PhpParser\Node\Stmt\Foreach_;
use function PHPUnit\Framework\throwException;

class CRUDJSON extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crudgen:json {name}
                            {--vars= : type:name,}
                            {--validation= : [name,validation] hyphen (-) seperated}
                            {--keys= : Variable,references,on}
                            {--inputs= : name,inputType,option1:option2 (-) seperated}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * The name of stub path being used.
     *
     * @var string
     */
    protected $stub ='./stubs/json.stub';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $jsonDir = './app/Console/crudDataFiles';




    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      //  $this->info($this->generateInputs());
        //
        $regName = "/^[A-Za-z]+$/";
        $reg = "/^(\w|)+(?:,[A-Za-z0-9]+)*$/";
        if(preg_match($regName, $this->argument('name')) ==0)
        {
            throw new Exception('Wrong Name Convention. Can only be string letters, no numbers or special characters.');


        }
        if(preg_match($reg, $this->option('keys')) ==0)
        {
            throw new Exception('Wrong Name Convention. Foreign key must be seperated with commas!.');


        }

        if( $this->argument('name') !== null &&$varInput = $this->option('vars') !== null ){

            $this->buildJson($this->jsonDir);

        }else{
            $this->error("Not Enough Parameters!");
        }

//php artisan crudgen:json Testeryzas --vars="string:gender,string:name,string:lastName" --validation="gender,required|min:1-name,required|max:100-lastName,required" --inputs="gender,select,male:female-name,text-lastName,text"
//--vars="string:gender,string:name,string:lastName" --validation="gender,required|min:1-name,required|max:100-lastName,required"

    }

    /**
     * Creates Edit View
     *
     * @return void
     */
    protected function buildJson($path)
    {

        $onlyName = strtolower($this->argument('name'));
        $tempStub = $this->files->get(base_path('/stubs/json.stub'));
        $fileName = $onlyName."JSON.json";
        $finalPath = base_path('app/Console/crudDataFiles' . "/" . $fileName);
        $stub = $this->replaceStubItems($tempStub);
        $this->files->put($finalPath, $stub);

    }


    /**
     * generates JSON
     *
     * @return int
     */
    protected function generateJson()
    {
        $stub = $this->files->get($this->getStub());
        $tableName = lcfirst($this->argument('name')) . "s";
        $schemaPlan = $this->option('schema');
        $className = 'Create' . ucwords($tableName) . 'Table';

        $schemaPlan=$this->userInput($schemaPlan);

    }

    /**
     * generates inputs
     *
     * @return int
     */
    protected function generateInputs()
    {
        // php artisan crudgen:json Beta --inputs="gender,select,male:female-name,text-lastName,text"
        $mainTemplate=',"inputs":[
        {{items}}
        ]';

        $itemsTemplate = "{ {{Items}}  },";
        $inputsTemplate = '{ "name":"{{name}}",
          "inputType":"{{Type}}"
          {{Options}}
          },';

        $varInput = $this->option('inputs');

        //explode items
        $exploded = explode("-",trim($varInput));
        $final='';
        foreach ($exploded as $set){

            $options = explode(",",trim($set));
           // $this->info($options[1]);
            if(  strtolower($options[1]) == "checkbox" || strtolower($options[1]) == "radio" || strtolower($options[1]) == "select"){
                $opts = explode(":",$options[2]);
                $this->info($opts[0]);
                $temp = str_replace(
                    '{{Options}}',$this->generateOptions($opts),$inputsTemplate
                );
                $temp = str_replace(
                    '{{name}}', $options[0],$temp
                );
                $final .= str_replace(
                    '{{Type}}', $options[1],$temp
                );


            }else{

                $temp = str_replace(
                    '{{Options}}', "",$inputsTemplate
                );
                $temp = str_replace(
                    '{{name}}', $options[0],$temp
                );
                $final .= str_replace(
                    '{{Type}}', $options[1],$temp
                );



            }


         }
        $final = str_replace(
            '{{items}}', mb_substr($final, 0, -1),$mainTemplate
        );

return $final;

    }

    /**
     * generates JSON Variables
     *
     * @return int
     */
    protected function generateOptions($options)
    {
        $temp='';
        $inputs=',"options":[ 
         {{Options}}
         ]';
        foreach ($options as $opt)
        {
            $temp .= '"'.$opt.'",';

        }
        $removedLast = mb_substr($temp, 0, -1);
        $end =   $removedLast  ;
        $temp = str_replace(
            '{{Options}}', $end,$inputs
        );

        return $temp;
    }

    /**
     * generates JSON Variables
     *
     * @return int
     */
    protected function generateJsonVariables()
    {
        $generated="";
        $temp="";
        $varInput = $this->option('vars');
        $exploded = explode(",",trim($varInput));

        $variableTemplate= ' {
            "type":"{{Type}}",
            "name":"{{Name}}"
                             },';
        $variableTemplateLast= ' {
            "type":"{{Type}}",
            "name":"{{Name}}"
                             }';


        foreach ($exploded as $item){

            $typeName = explode(":",$item);

            if (!next($exploded)) {
                $temp = str_replace(
                    '{{Type}}', $typeName[0],$variableTemplateLast
                );

                $generated .= str_replace(
                    '{{Name}}', $typeName[1],$temp
                );
            }else{
                $temp = str_replace(
                    '{{Type}}', $typeName[0],$variableTemplate
                );

                $generated .= str_replace(
                    '{{Name}}', $typeName[1],$temp
                );

            }


        }

        return $generated;

    }

    /**
     * generates JSON Validations
     *
     * @return string
     */
    protected function generateJsonValidations()
    {

        $template = ',
  "validations": [
    
    {{Items}}
  ]';
//required|min:1
        $itemsTemplate = '{
    
    "name":"{{Name}}",
    "validation":"{{Validation}}"
    }';

        $temp = "";
        $onlyName = strtolower($this->argument('name'));
        $valInput = $this->option('validation');
        $exploded= array();
        $exploded = explode("-", trim($valInput));
        $generated = "";
        //title,required|min:1-body,required|max:100

            foreach ($exploded as $item) {

                $nameVal = explode(",", $item);

                if (!next($exploded)) {
                    $temp = str_replace(
                        '{{Name}}', $nameVal[0], $itemsTemplate
                    );

                    $generated .= str_replace(
                        '{{Validation}}', $nameVal[1], $temp
                    );
                } else {

                    $temp = str_replace(
                        '{{Name}}', $nameVal[0], $itemsTemplate . ","
                    );

                    $generated .= str_replace(
                        '{{Validation}}', $nameVal[1], $temp
                    );

                }
            }

            $final = str_replace(
                '{{Items}}', $generated, $template
            );

            return $final;


    }

        protected function generateForeignKeys(){

    $template = ',
  "foreignKey": [
    {{Items}}
  ]';

    $itemsTemplate = '{
      "column": "{{Column}}",
      "references": "{{References}}",
      "on": "{{On}}"
    }';
    $temp="";
        $onlyName = strtolower($this->argument('name'));
        $valInput = $this->option('keys');
        $exploded = explode(",",trim($valInput));
        $generated="";

            if (count($exploded) != 3) {
                $this->error("Wrong number of Parameters!");

                throw new Exception('Wrong number of Parameters!');
            }else {
                $generated = str_replace(
                    '{{Column}}', $exploded[0], $itemsTemplate
                );

                $generated = str_replace(
                    '{{References}}', $exploded[1], $generated
                );


                $generated = str_replace(
                    '{{On}}', $exploded[2], $generated
                );


                $final = str_replace(
                    '{{Items}}', $generated, $template
                );

                return $final;
            }
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

    /**
     * Execute the console command.
     *
     * @return int
     */
    protected function replaceStubItems($stub)
    {
        $crudname = strtolower($this->argument('name'));
        $stub = str_replace(
            '{{crudName}}', $crudname,$stub
        );

        $stub = str_replace(
            '{{Variables}}', $this->generateJsonVariables(),$stub
        );

        //replace validation

        if($this->option('validation') !== null) {
            $stub = str_replace(
                '{{Validations}}', $this->generateJsonValidations(), $stub
            );
        }else{

            throw new Exception('No validations!');

        }

        if($this->option('inputs') !== null) {
            $stub = str_replace(
                '{{Inputs}}', $this->generateInputs(), $stub
            );
        }else{

            throw new Exception('No input types!');

        }

        if($this->option('keys') !== null) {
           $stub = str_replace(
                '{{ForeignKeys}}', $this->generateForeignKeys(), $stub
           );
        }else{

            $stub = str_replace(
                '{{ForeignKeys}}', "", $stub
            );

        }


        return $stub;
    }

}
