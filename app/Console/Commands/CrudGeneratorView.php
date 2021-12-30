<?php

namespace App\Console\Commands;


use Exception;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class CrudGeneratorView extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crudgen:view {name}
                            {--modelname= : Name of the model}
                            {--vars= : [Items Array comma seperated]}
                            {--json= : Path to json file}
                            {--delete : deletes view directory}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that creates controller.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'View';

    /**
     * edit.blade.stub stub
     *
     * @var string
     */
    protected $editStub = "/stubs/view.edit.stub";

    /**
     * show.blade.stub stub
     *
     * @var string
     */
    protected $showStub = "/stubs/view.show.stub";

    /**
     *
     * index.blade.stub stub
     *
     * @var string
     */
    protected $indexStub = "/stubs/view.index.stub";

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {

        $onlyName = $this->argument('name');
        $pluralname = $onlyName . 's';
        return 'resources/views/' . lcfirst($pluralname);
    }

    /**
     * Build the model class with the given name.
     *
     * @param string $name
     *
     * @return string
     */


    // TODO : add route generating
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $jsonpath = '/app/Console/crudDataFiles/';
        $dir = $this->getDefaultNamespace("");


        $regName = "/^[A-Za-z]+$/";

        if(preg_match($regName, $this->argument('name')) ==0)
        {
            throw new Exception('Wrong Name Convention. Can only be string letters, no numbers or special characters.');


        }


        $this->createViewDirectory($dir);
        $dir = $this->getDefaultNamespace("");
        if($this->option('delete') != null){
            $this->deleteViewDirectory($this->argument('name'));
        }
        else {
            if ($this->option('json') != null) {
                $this->warn($jsonpath . $this->option("json"));

                if (!file_exists(base_path($jsonpath . $this->option("json"))))
                    throw new Exception('Path Not Present!');

                $jsonObj = $this->readJSON($jsonpath);
                $this->buildJSONEditView($dir, $jsonObj);
                $this->buildJSONIndexView($dir, $jsonObj);
                $this->buildJSONShowView($dir, $jsonObj);

            } else {
                $this->buildEditView($dir);
                $this->buildIndexView($dir);
                $this->buildShowView($dir);
            }
        }


    }

    /**
     * Deletes View
     *
     * @return void
     */
    protected function deleteViewDirectory($name)
    {
        $dir = $this->getDefaultNamespace("");

        $pluralName=strtolower($name).'s';
        $directorybase=base_path($dir);
        $directory=resource_path('views/').$pluralName;
        if (file_exists($directory)) {
            //rmmkdir(base_path($directory), 777, true);


            $arr=['edit','index','show'];
            foreach ($arr as $item){

                if (file_exists($directorybase.'/' . $item . '.blade.php')) {
                    $this->warn($item.'.blade.php deleted!');
                    unlink($directory . '/' . $item . '.blade.php');
                }

            }

            rmdir($directorybase);
            Storage::deleteDirectory($directory);
            $this->warn("View ".$directory." directory deleted");
            //exec("sudo mkdir ". $directory);
        }else{
            $this->warn($directory. " does not exist!");
        }


    }
    /**
     * Creates Edit View from JSON file
     *
     * @return void
     */
    protected function buildJSONEditView($path,$jsonObj)
    {

        $onlyName = $this->argument('name');
        $onlyName = lcfirst($onlyName);
        $tempStub = $this->files->get(base_path($this->editStub));
        $fileName = "edit.blade.stub";
        $finalPath = base_path($path . "/" . $fileName);
        $stub = $this->replaceJSONStubItems($tempStub, $onlyName,$jsonObj);
        $this->info($finalPath);
        $this->files->put($finalPath, $stub);

    }

    /**
     * Creates Select
     *
     * @return void
     */
    protected function generateJSONSelect($options,$name)
    {

    $template ='    <label for="{{Name}}">{{Name}}</label>
                    <select class="form-select" name="{{Name}}" id="{{Name}}">
                      {{Options}}
                    </select> ';
    $optsEmpty="";
    $optionTemplate = '<option  value="{{Value}}">{{Name}}</option>';
        foreach ($options as $option) {

            $temp = str_replace(
                "{{Name}}", $option, $optionTemplate
            );
            if($option=="True" || $option=="true" ){
            $optsEmpty .= str_replace(
                '"{{Value}}"', 1, $temp
            );
        }else if( $option=="False" || $option=="false" ){

                $optsEmpty .= str_replace(
                    '"{{Value}}"', 0, $temp
                );
            }else{

                $optsEmpty .= str_replace(
                    "{{Value}}", $option, $temp
                );
            }

        }

        $final = str_replace(
            "{{Options}}", $optsEmpty, $template
        );

        $final=str_replace(
            "{{Name}}", $name, $final
        );

    return $final;
    }

    protected function generateChecboxRadioSelect($options,$name, $isCheckbox)
    {

        $template ='    <label ><h5>{{Name}}</h5></label> <br>';
        $optsEmpty="";
        $optionTemplate = '<input type="{{Type}}" id="{{ID}}" name="{{ID}}" value="{{Name}}">
                    <label for="{{ID}}">{{Name}}</label><br>';
        foreach ($options as $option) {

            $temp = str_replace(
                "{{Name}}", $option, $optionTemplate
            );

            $temp = str_replace(
                "{{ID}}", $name, $temp
            );
            if($isCheckbox) {
                $optsEmpty .= str_replace(
                    "{{Type}}", "checkbox", $temp
                );
            }else{
                $optsEmpty .= str_replace(
                    "{{Type}}", "radio", $temp
                );
            }
        }


        $final = str_replace(
            "{{Name}}", $name, $template
        );

        $final .= $optsEmpty;

        return $final;
    }


    /**
     * Generates input items in index.blade.stub
     *
     * @return string
     */
    protected function generateJSONIndexItems($jsonObj)
    {
        $vars = $this->option('vars');
        $exploded = explode(',', trim($vars));
        $formattedInputs = "";

        $template = "  <div class='input-group input-group-lg'>
  <label for='{{Name}}'>{{Name}}</label>
  <input name='{{Name}}' id='{{Name}}' type='{{Type}}' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='' placeholder='{{Name}}'></div>";
        $textareatemplate = "<textarea class='input-group input-group-lg form-control' name='{{Name}}' placeholder='{{Name}}'></textarea>";;

        $variables = $jsonObj->variables;
        $options = $jsonObj->inputs;


        foreach ($options as $option) {
            if($option->inputType == "textarea"){
                $formattedInputs .= str_replace(
                    "{{Name}}", lcfirst($option->name), $textareatemplate
                );
            }else if($option->inputType == "select"){
                $realOptions = $option->options;
                $formattedInputs .= $this->generateJSONSelect($realOptions,$option->name);

            }else if($option->inputType == "radio"){
                $realOptions = $option->options;
                $formattedInputs .= $this->generateChecboxRadioSelect($realOptions,$option->name,FALSE);

            }
            else if($option->inputType == "checkbox"){
                $realOptions = $option->options;
                $formattedInputs .= $this->generateChecboxRadioSelect($realOptions,$option->name,TRUE);

            }
            else {
                $temp = str_replace(
                    "{{Name}}", lcfirst($option->name), $template
                );
                $temp2 = str_replace(
                    "{{Value}}", ucfirst($option->name), $temp
                );
                $formattedInputs .= str_replace(
                    "{{Type}}", ucfirst($option->inputType), $temp2
                );
            }
        }


        return $formattedInputs;

    }

    protected function generateJSONEditInputFields($jsonObj){

        //$template="<input name='{{Name}}' type='text' id='form1Example1' class='form-control' value='{{\${{crudModelNameSing}}->{{Name}}}}'/>";

        $template = "  <div class='input-group input-group-lg'><input name='{{Name}}' id='{{Name}}' type='{{Type}}' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{\${{crudModelNameSing}}->{{Name}}}}' placeholder='{{Name}}'></div>";
        $textareatemplate = "<textarea class='input-group input-group-lg form-control' name='{{Name}}' placeholder='{{Name}}'>{{\${{crudModelNameSing}}->{{Name}}}}</textarea>";

        $vars = $this->option('vars');
        $exploded = explode(',', trim($vars));
        $options = $jsonObj->inputs;
        $formattedInputs = "";
        $variables = $jsonObj->variables;
        foreach ($options as $option) {

            if($option->inputType == "textarea"){
                $formattedInputs .= str_replace(
                    "{{Name}}", lcfirst($option->name), $textareatemplate
                );
            }else if($option->inputType == "select"){
                $realOptions = $option->options;
                $formattedInputs .= $this->generateJSONSelect($realOptions,$option->name);

            }else if($option->inputType == "radio"){
                $realOptions = $option->options;
                $formattedInputs .= $this->generateChecboxRadioSelect($realOptions,$option->name,FALSE);

            }
            else if($option->inputType == "checkbox"){
                $realOptions = $option->options;
                $formattedInputs .= $this->generateChecboxRadioSelect($realOptions,$option->name,TRUE);

            }else {


            $temp = str_replace(
                "{{Name}}", lcfirst($option->name), $template
            );
            $temp2 = str_replace(
                "{{Value}}", ucfirst($option->name), $temp
            );
            $formattedInputs .= str_replace(
                "{{Type}}", ucfirst($option->inputType), $temp2
            );
        }
        }

        return $formattedInputs;
    }


    /**
     * Generates Controller Class
     * BAD
     * @return string
     */
    protected function replaceJSONStubItems($stub, $name,$jsonObj)
    {


        $plural = lcfirst($name) . 's';

        $stub = str_replace(
            '{{crudModelName}}', $plural, $stub
        );
        $stub = str_replace(
            '{{InputFields}}', $this->generateJSONEditInputFields($jsonObj), $stub
        );
        $stub = str_replace(
            '{{crudModelNameSing}}', lcfirst($name), $stub
        );

        $stub = str_replace(
            '{{listHeader}}', $this->buildListHeader($jsonObj), $stub
        );

        return $stub;

    }


    /**
     * Creates Edit View with JSON file
     *
     * @return void
     */
    protected function buildJSONShowView($path,$jsonObj)
    {

        $onlyName = $this->argument('name');
        $onlyName = lcfirst($onlyName);
        $tempStub = $this->files->get(base_path($this->showStub));
        $tempStub = $this->replaceShowItems($tempStub, $this->generateJSONShowItems($jsonObj));
        $fileName = "show.blade.stub";
        $finalPath = base_path($path . "/" . $fileName);
        $stub = $this->replaceStubItems($tempStub, $onlyName);

        $this->files->put($finalPath, $stub);

    }

    /**
     * Generates items in show.blade.stub
     *
     * @return string
     */
    protected function generateJSONShowItems($jsonObj)
    {
        $vars = $this->option('vars');
        $exploded = explode(',', trim($vars));
        $formattedVars = "";

        $template = "<div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> {{Name}} : {{(string)\${{crudModelNameSing}}->{{Value}} }}</h3>
                    </div>
                </div>";

        $variables = $jsonObj->variables;

        foreach ($variables as $item) {
            $temp = str_replace(
                "{{Name}}", ucfirst($item->name), $template
            );
            $formattedVars .= str_replace(
                "{{Value}}", $item->name, $temp
            );

        }


        return $formattedVars;

    }

    /**
     * Creates Index View from JSON file
     *
     * @return void
     */
    protected function buildJSONIndexView($path, $jsonObj)
    {

        $onlyName = $this->argument('name');
        $onlyName = lcfirst($onlyName);
        $tempStub = $this->files->get(base_path($this->indexStub));
        $tempStub = $this->replaceIndexInputItems($tempStub, $this->generateJSONIndexItems($jsonObj));
        $fileName = "index.blade.stub";
        $finalPath = $path . "/" . $fileName;
        $stub = $this->replaceStubItems($tempStub, $onlyName);
        $this->files->put(base_path($finalPath), $stub);

    }




    /**
     * Build List Items
     *
     * @return string
     */
    protected function buildListItems($jsonObj)
    {

        $vars = $jsonObj->variables;

       // <td style="text-align: left;"><img src = "{{asset("storage/I3N9c8B0mkwRkzciYzNDp5PSOnEiTEqX4Ruk88f0.jpg")}}" width="120px" hight="120px" /></td>
        $final="";

        foreach ($vars as $var) {
           // $final .= '<th scope="col">' . $var->name .'</th>';
            if($var->name == "filePath"){

                $final.='<td style="text-align: left;"><img src = "{{asset("storage/".'.'${{crudModelNameSing}}->'. $var->name .')}}" width="120px" hight="120px" /></td>';
            }else{

                $final.='<td style="text-align: left;">{{${{crudModelNameSing}}->'. $var->name .'}}</td>';
            }


        }

        return $final;

    }


    protected function buildListHeader($jsonObj)
    {

        $vars = $jsonObj->variables;
        $final="";
        foreach ($vars as $var) {
            $final .= '      <th><span>'.$var->name.'</span></th>';
        }

        return $final;
    }


    /**
     * Generates Controller Class
     * BAD
     * @return string
     */
    protected function replaceStubItems($stub, $name)
    {
        $jsonpath = './app/Console/crudDataFiles/';
        $jsonObj = $this->readJSON($jsonpath);

        $plural = lcfirst($name) . 's';

        $stub = str_replace(
            '{{listItems}}', $this->buildListItems($jsonObj), $stub
        );
        $stub = str_replace(
            '{{crudModelName}}', $plural, $stub
        );
        $stub = str_replace(
            '{{InputFields}}', $this->generateEditInputFields(), $stub
        );
        $stub = str_replace(
            '{{crudModelNameSing}}', lcfirst($name), $stub
        );
        $stub = str_replace(
            '{{listHeader}}', $this->buildListHeader($jsonObj), $stub
        );


        return $stub;

    }

    /**
     * Replaces input Fields
     * BAD
     * @return string
     */
    protected function replaceEditInputFields($stub, $inputFields)
    {

        $replacedStub = str_replace(
            ' {{InputFields}}', "wutwut", $stub
        );

        return $replacedStub;

    }

    protected function createViewDirectory($directory)
    {

        if (!file_exists(base_path($directory))) {

           mkdir(base_path($directory), 0775, true);
        //   chmod(base_path($directory),777);
            //exec("sudo mkdir ". $directory);
        }


    }

    /**
     * Creates Edit View
     *
     * @return void
     */
    protected function buildEditView($path)
    {

        $onlyName = $this->argument('name');
        $onlyName = lcfirst($onlyName);
        $tempStub = $this->files->get($this->editStub);
        $fileName = "edit.blade.stub";
        $finalPath = $path . "/" . $fileName;
        $stub = $this->replaceStubItems($tempStub, $onlyName);

        $this->files->put($finalPath, $stub);

    }

    /**
     * Creates Edit View
     *
     * @return void
     */
    protected function buildIndexView($path)
    {

        $onlyName = $this->argument('name');
        $onlyName = lcfirst($onlyName);
        $tempStub = $this->files->get($this->indexStub);
        $tempStub = $this->replaceIndexInputItems($tempStub, $this->generateIndexItems());
        $fileName = "index.blade.stub";
        $finalPath = $path . "/" . $fileName;
        $stub = $this->replaceStubItems($tempStub, $onlyName);
        $this->files->put($finalPath, $stub);

    }

    /**
     * Creates Edit View
     *
     * @return void
     */
    protected function buildShowView($path)
    {

        $onlyName = $this->argument('name');
        $onlyName = lcfirst($onlyName);
        $tempStub = $this->files->get($this->showStub);
        $tempStub = $this->replaceShowItems($tempStub, $this->generateShowItems());
        $fileName = "show.blade.stub";
        $finalPath = $path . "/" . $fileName;
        $stub = $this->replaceStubItems($tempStub, $onlyName);

        $this->files->put($finalPath, $stub);

    }

    protected function replaceShowItems($stub, $items)
    {
        $temp = str_replace(
            '{{ShowItems}}', $items, $stub
        );

        return $temp;
    }

    protected function replaceIndexInputItems($stub, $items)
    {
        $temp = str_replace(
            '{{Input Items}}', $items, $stub
        );

        return $temp;
    }

    /**
     * Generates items in show.blade.stub
     *
     * @return string
     */
    protected function generateShowItems()
    {
        $vars = $this->option('vars');
        $exploded = explode(',', trim($vars));
        $formattedVars = "";
        $template = "<div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> {{Name}} : @if(\${{crudModelNameSing}}->{{Value}} ) {{\${{crudModelNameSing}}->{{Value}}  }}@else NULL @endif</h3>
                    </div>
                </div>";
        foreach ($exploded as $item) {
            $temp = str_replace(
                "{{Name}}", ucfirst($item), $template
            );
            $formattedVars .= str_replace(
                "{{Value}}", $item, $temp
            );
        }
        return $formattedVars;

    }

    /**
     * Generates input items in index.blade.stub
     *
     * @return string
     */
    protected function generateIndexItems()
    {
        $vars = $this->option('vars');
        $exploded = explode(',', trim($vars));
        $formattedInputs = "";
        $template = "  <div class='input-group input-group-lg'><input name='{{Name}}' type='text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{Value}}'></div>";
        foreach ($exploded as $item) {
            $temp = str_replace(
                "{{Name}}", lcfirst($item), $template
            );
            $formattedInputs .= str_replace(
                "{{Value}}", ucfirst($item), $temp
            );
        }
        return $formattedInputs;
    }

    protected function generateEditInputFields(){

        $template="<input name='{{Name}}' type='text' id='form1Example1' class='form-control' value='{{\${{crudModelNameSing}}->{{Name}}}}'/>";
        $vars = $this->option('vars');
        $exploded = explode(',', trim($vars));
        $formattedInputs = "";
        foreach ($exploded as $item) {
            $formattedInputs .= str_replace(
                "{{Name}}", lcfirst($item), $template
            );
        }
        return $formattedInputs;
    }



    protected function getStub()
    {
        // TODO: Implement getStub() method.
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

