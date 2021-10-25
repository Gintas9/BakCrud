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
                            {--vars= : Variables for Model name:type}
                            {--schema=: type:name SINGULAR}
                            ';

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



        $name= ucfirst(strtolower($this->argument('name')));


        $schemaPlan = $this->option('schema');
        $vars = $this->option('vars');


        if($vars !== null && $schemaPlan !== null && $name !== null ){

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
