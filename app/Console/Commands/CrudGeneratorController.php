<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
class CrudGeneratorController extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crudgen:controller {name}';

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
     * Execute the console command.
     *
     * @return void
     */
   // public function handle()
   // {
     //   $name = $this->argument('name');

      //  $this->info(__DIR__);





     //   $this->generateController();
    //}

    /**
     * Generates Controller Class
     *
     * @return string
     */
    public function generateController(){

        $stubfile = $this->files->get($this->getStub());
        return $this;
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
        $stub = $this->files->get($this->getStub());

        $this->files->put("./app/Http/Controllers/somegintas.php", $stub);

       // return $this->replaceNamespace($stub, $name);
    }

    /**
     * Generates Controller Class
     *
     * @return string
     */
    protected function getStub()
    {
        $path = "./stubs/controller.stub";

        return $path;

    }
}
