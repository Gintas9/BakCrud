<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Schema;

class CrudGeneratorUtils extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crudgen:utils {name}
                             {--item= : define item controller or table}       
                             {--delete : deletes controller}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    protected function deleteController($name)
    {

        $controllerName=ucfirst(strtolower($name)).'Controller.php';
        $directory=base_path('app/Http/Controllers/'.$controllerName);
        if (file_exists($directory)) {
            chmod($directory,0777);
            unlink(app_path("Http/Controllers/").$controllerName);
            $this->warn("Controller \$controllerName deleted.");
            //$this->files->delete($directory);
        }else{

            $this->warn("Controller \$controllerName does not exists");
        }


    }


    /**
     * Drops table
     *
     *
     */
    protected function dropTable($name)
    {
        $namePlural=strtolower($name) . 's';

        Schema::dropIfExists($namePlural);
        $this->warn("Table" . $namePlural);

    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        if($this->option('delete') != null &&  $this->option('item') == 'controller'){

            $this->deleteController($this->argument('name'));

        }else if($this->option('delete') != null &&  $this->option('item') == 'table') {

            $this->dropTable($this->argument('name'));

    }else{

            $this->warn("Parameters not right!");

    }


    }

    protected function getStub()
    {
        // TODO: Implement getStub() method.
    }
}
