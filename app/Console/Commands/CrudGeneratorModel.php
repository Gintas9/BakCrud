<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CrudGeneratorModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crudgen:model {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Model';

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
        return 0;
    }
}
