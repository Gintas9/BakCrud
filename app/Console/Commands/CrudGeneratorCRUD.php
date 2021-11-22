<?php

namespace App\Console\Commands;

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
                            {--schema= : type:name SINGULAR}'
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

    $this->runCommands();

    }

    protected function runCommands(){


        $jsonpath = './app/Console/crudDataFiles/';
        $name= ucfirst(strtolower($this->argument('name')));


        $schemaPlan = $this->option('schema');
        $vars = $this->option('vars');
        $json = $this->option('json') ;

        if($this->option('json')  !== null){

            if (!file_exists($jsonpath . $this->option("json")))
                throw new Exception('Path Not Present!');


           $this->call('crud:controller', ['name' => $name, '--json' => $json]);
           $this->call('crud:model', ['name' => $name]);
           $this->call('crud:view', ['name' => $name, '--json' => $json]);
           $this->call('crud:migration', ['name' => $name, '--json' => $json]);
           $this->info("Created CRUD!");

        }
        else if($vars !== null && $schemaPlan !== null && $name !== null ){

            $this->call('crud:controller', ['name' => $name, '--vars' => $vars]);
            $this->call('crud:model', ['name' => $name, '--vars' => $vars]);
            $this->call('crud:view', ['name' => $name, '--vars' => $vars]);
            $this->call('crud:migration', ['name' => $name, '--schema' => $schemaPlan]);
            $this->info("Created CRUD!");

    }   else{
            $this->info("Parameters missing!");
        }

    }








}
