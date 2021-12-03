<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Console\GeneratorCommand;
use Roland\Crud\Commands\CrudControllerCommand;

class CrudGeneratorModel extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crudgen:model 
                            {name : The name of the model.}
                            {--vars= : Variables for Model name:type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that creates model';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * The name of model path being used.
     *
     * @var string
     */
    protected $modelPath = "/app/Models/";

   /**
     * The name of stub path being used.
     *
     * @var string
     */
    protected $stub = "/stubs/model.stub";


    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Models';
    }

    /**
     * Build the model class with the given name.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function buildClass($name)
    {
        $this->info($name);
        $stub = $this->files->get(base_path($this->getStub()));



        return $this->replaceNamespace($stub,$name)
            ->replaceClass($stub, $name);


    }

    /**
     * Build Model class path
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function buildModelPath($name)
    {
        $uppname = ucfirst($name);
        return $this->modelPath . $uppname;

    }

    /**
     * Sets up Variables for model.
     *
     * @param  string  $vars
     *
     * @return string
     */

    protected function getStub()
    {
        return $this->stub;
    }

    /**
     * Replace the variables in the stub.
     *
     * @param  string  $stub
     * @param  string  $validationRules
     *
     * @return $this
     */

}
