<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class CrudGeneratorDeleteController extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crudgen:delController {name}          
                             {--delete : deletes controller}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';



    /**
     * Deletes Controller
     *
     * @return void
     */
    protected function deleteController($name)
    {

        $controllerName=ucfirst(strtolower($name)).'Controller.php';
        $directory=base_path('app/Http/Controllers/'.$controllerName);
        if (file_exists($directory)) {

            $this->warn("exists");

            $this->warn('app/Http/Controllers/'.$controllerName);

            chmod($directory,0777);
            unlink('app/Http/Controllers/'.$controllerName);
            //$this->files->delete($directory);
        }else{
            $this->warn($directory);
            $this->warn("not exists");
        }


    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        if($this->option('delete') != null){

            $this->deleteController($this->argument('name'));

        }


    }

    protected function getStub()
    {
        // TODO: Implement getStub() method.
    }
}
