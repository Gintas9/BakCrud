<?php

namespace App\Console\Commands;


use Illuminate\Console\GeneratorCommand;
use Illuminate\Http\File;
class CrudGeneratorView extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crudgen:view {name}
                            {--modelname:Name of the model}
                            {--vars=:[Items Array comma seperated]}';

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
     * edit.blade.php stub
     *
     * @var string
     */
    protected $editStub = "./stubs/view.edit.stub";

    /**
     * show.blade.php stub
     *
     * @var string
     */
    protected $showStub = "./stubs/view.show.stub";

    /**
     *
     * index.blade.php stub
     *
     * @var string
     */
    protected $indexStub = "./stubs/view.index.stub";

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
        return './resources/views/' . lcfirst($pluralname);
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
        // $stub = $this->files->get($this->getStub());
        // $onlyName = $this->argument('name');

        //$this->info($name);
        //return $this->replaceModelName($stub,$onlyName);

        // $stub = $this->files->get($this->getStub());
        $dir = $this->getDefaultNamespace("");
        $this->createViewDirectory($dir);
        $this->buildEditView($dir);
        $this->buildIndexView($dir);
        $this->buildShowView($dir);
        $this->info("works");
        $this->info($dir);

    }


    protected function replaceModelName(&$stub, $name)
    {

        $plural = lcfirst($name) . 's';

        $stub = str_replace(
            '{{crudModelName}}', $plural, $stub
        );

        $stub = str_replace(
            '{{crudModelNameSing}}', lcfirst($name), $stub
        );

        return $this;
    }

    /**
     * Generates Controller Class
     * BAD
     * @return string
     */
    protected function replaceStubItems($stub, $name)
    {


        $plural = lcfirst($name) . 's';

        $stub = str_replace(
            '{{crudModelName}}', $plural, $stub
        );
        $stub = str_replace(
            '{{InputFields}}', $this->generateEditInputFields(), $stub
        );
        $stub = str_replace(
            '{{crudModelNameSing}}', lcfirst($name), $stub
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

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
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
      //  $inputs=$this->generateEditInputFields();
       // $tempStub = $this->replaceIndexInputItems($tempStub,$inputs);
        $fileName = "edit.blade.php";
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
        $fileName = "index.blade.php";
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
        $fileName = "show.blade.php";
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
     * Generates items in show.blade.php
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
     * Generates input items in index.blade.php
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
}

