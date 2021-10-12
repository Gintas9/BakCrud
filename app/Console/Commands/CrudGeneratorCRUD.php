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
      //  $this->call('crud:model', ['name' => $modelName, '--fillable' => $fillable, '--table' => $tableName]);

        $this->info("Working!");
        $this->call();

    }




}
