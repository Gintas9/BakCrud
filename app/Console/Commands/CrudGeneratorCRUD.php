<?php

namespace App\Console\Commands;

use App\Http\Controllers\AdminController;
use Illuminate\Console\Command;

class CrudGeneratorCRUD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crudgen:CRUD {name}
                            {--json= : JSON path}
                            {--vars= : Variables for Model name:type}
                            {--schema= : type:name SINGULAR}
                            {--delete : Deletes whole object}
                            {--keys= : Variable,references,on}
                            
                            '

                            ;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if($this->option('delete')  != null){
            $this->deleteCRUD($this->argument('name'));

        }else {
            $this->info("delet missing");
    $this->runCommands();}

    }

    protected function runCommands(){


        $jsonpath = './app/Console/crudDataFiles/';
        $name= ucfirst(strtolower($this->argument('name')));


        $schemaPlan = $this->option('schema');
        $vars = $this->option('vars');
        $json = $this->option('json') ;
        $keys = $this->option('keys') ;



            if ($this->option('json') !== null) {

                if (!file_exists(base_path($jsonpath . $this->option("json"))))
                    throw new Exception('Path Not Present!');


                $this->call('crudgen:controller', ['name' => $name, '--json' => $json]);
                $this->call('crudgen:model', ['name' => $name]);
                $this->call('crudgen:view', ['name' => $name, '--json' => $json]);

                if ($this->option('keys') !== null) {
                    $this->call('crudgen:migration', ['name' => $name, '--json' => $json, '--keys' => $keys]);
                }else{

                    $this->call('crudgen:migration', ['name' => $name, '--json' => $json]);
                }

                $this->info("Created CRUD!");

            } else if ($vars !== null && $schemaPlan !== null && $name !== null) {



            } else {
                $this->info("Parameters missing!");
            }

    }



    public function deleteCRUD($name)
    {
        $this->call('crudgen:utils', ['name' => $name, '--item' => 'controller','--delete'=>true]);
        $this->call('crudgen:utils', ['name' => $name, '--item' => 'table','--delete'=>true]);
        $this->call('crudgen:view', ['name' => $name,'--delete'=>true]);
        $this->call('crudgen:route', ['name' => $name,'--delete'=>true]);

    }


}
