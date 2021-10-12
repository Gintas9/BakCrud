<?php

namespace App\Console\Commands;


use Illuminate\Console\GeneratorCommand;
class CrudGeneratorController extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crudgen:controller {name}
                            {--modelname:Name of the model}
                            {--vars=:[Items Array comma seperated ]}';

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
    protected $type = 'Controller';



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
        $onlyName = $this->argument('name');
        //return  database_path('/migrations/') . $datePrefix . '_create_' . $migrationName . '_table.php';
        return app_path('/Http/Controllers/' . ucfirst($onlyName) . 'Controller.php');
    }


    /**
     * Build the model class with the given name.
     *
     * @param  string  $name
     *
     * @return string
     */


    // TODO : add route generating

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());
        $onlyName = $this->argument('name');
        $controllerName = $name. $this->type;
        $this->info('/Http/Controllers/' . ucfirst($name) . 'Controller.php');
        $this->buildRoute($onlyName);


        return $this->replaceRequestItems($stub)
             ->replaceModelName($stub,$onlyName)
            -> replaceStoreValidation($stub,$this
                ->generateStoreValidation())
             ->replaceNamespace($stub,$name)
             ->replaceClass($stub, $controllerName);
    }

    /**
     * Generates Controller Class
     * BAD
     * @return string
     */
    protected function getStub()
    {
        $path = "./stubs/controller.stub";

        return $path;

    }

    protected function replaceModelName(&$stub, $name)
    {
        $uppercase=ucfirst($name);

        $stub = str_replace(
            '{{ModelName}}', $uppercase, $stub
        );

        $plural = lcfirst($name) . 's';

        $stub = str_replace(
            '{{crudModelName}}', $plural, $stub
        );

        $stub = str_replace(
            '{{crudModelNameSing}}', lcfirst($name), $stub
        );

        return $this;
    }

    protected function replaceModelNameSingular(&$stub, $name)
    {
        $stub = str_replace(
            '{{crudModelNameSing}}', $name, $stub
        );

        return $this;
    }

    protected function generateStoreValidation(){

        $template = "        '{{Name}}' => 'required|max:100|min:5', \n";
        $vars = $this->option('vars');
        $exploded = explode(',',trim($vars));
        $formattedVarsValidations = "";

        foreach ($exploded as $item) {
            $temp = str_replace(
                '{{Name}}', $item, $template
            );

            $formattedVarsValidations .= $temp;

        }

        return $formattedVarsValidations;
    }

    protected function replaceStoreValidation(&$stub, $validations)
    {
        $stub = str_replace(
            '{{Validation Items}}', $validations, $stub
        );
        return $this;
    }


    protected function replaceRequestItems(&$stub)
    {

        $template = "        \${{crudModelNameSing}}->{{Name}} = \$request->{{Name}}; \n";
        $vars = $this->option('vars');
        $exploded = explode(',',trim($vars));
        $requestItems ="";

        foreach ($exploded as $item) {
            $temp = str_replace(
                '{{Name}}', $item, $template
            );

            $requestItems .= $temp;

        }

        $stub = str_replace(
            '{{Request Items}}', $requestItems, $stub
        );
        return $this;
    }

    protected function buildRoute($name){

        $webURL="./routes/web.php";
        $controllerName=ucfirst($name);
        $plurName=lcfirst($name) . 's';
        $web = $this->files->get($webURL);
        $template = "Route::resource('{{Name}}','App\Http\Controllers\{{ControllerName}}Controller');";

        $temp1 = str_replace(
            '{{ControllerName}}', $controllerName, $template
        );
        $temp2 = str_replace(
            '{{Name}}', $plurName, $temp1
        );
        if(strpos($web,$temp2) == false){
            $fp= fopen($webURL, 'a');
          fwrite($fp,PHP_EOL.$temp2);

           fclose($fp);
           // $web .= $temp2;
            //$this->files->put($webURL,$web);
            $this->info('Created Resource Route!');

        }else{
            $this->info('Route already present!');
        }





    }




}
