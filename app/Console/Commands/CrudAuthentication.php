<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class CrudAuthentication extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crudgen:auth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $this->createAuthFiles();
    }

    /**
     * Create Dashboard
     *
     * @return int
     */
    public function createAuthFiles()
    {

        $jsonpath = './resources/views/';
        if (file_exists($jsonpath . "dashboard.blade.php")){
            $this->info($jsonpath . "dashboard.blade.php" . " ALREADY EXISTS!");
        }else{

            $this->buildResource($jsonpath . "dashboard.blade.php" ,"dashboard.stub");
        }

        //Create login register views
        $viewPath = './resources/views/auth/';

        if (!file_exists($viewPath)) {
            mkdir($viewPath, 0777, true);
        }


        if (file_exists($viewPath . "login.blade.php")){
            $this->info($viewPath . "login.blade.php" . " ALREADY EXISTS!");
        }else{

            $this->buildResource($viewPath . "login.blade.php" ,"login.stub");
        }

        if (file_exists($viewPath . "registration.blade.php")){
            $this->info($viewPath . "registration.blade.php" . " ALREADY EXISTS!");
        }else{
            $this->buildResource($viewPath . "registration.blade.php" ,"registration.stub");
        }

        $controllerPath = './app/Http/Controllers/';

        if (file_exists($controllerPath . "CustomAuthController.php")){
            $this->info($controllerPath . "CustomAuthController.php" . " ALREADY EXISTS!");
        }else{
            $this->buildResource($controllerPath . "CustomAuthController.php" ,"controller.stub");
        }

        $modelPath = './app/Models/';

        if (file_exists($modelPath . "User.php")){
            $this->info($modelPath . "User.php" . " ALREADY EXISTS!");
        }else{
            $this->buildResource($modelPath . "User.php" ,"user.stub");
        }

        $jsonPath = './app/Console/crudDataFiles/';

        if (file_exists($jsonPath . "registrationJSON.json")){
            $this->info($jsonPath . "registrationJSON.json" . " ALREADY EXISTS!");
        }else{
            $this->buildResource($jsonPath . "registrationJSON.json" ,"json.stub");
        }
        $this->call('crudgen:migration', ['name' => "User", '--json' => "registrationJSON.json"]);


        if (file_exists($jsonPath . "banJSON.json")){
            $this->info($jsonPath . "banJSON.json" . " ALREADY EXISTS!");
        }else{
            $this->buildResource($jsonPath . "banJSON.json" ,"banjson.stub");
        }


        $this->call('crudgen:Crud', ['name' => "Ban", '--json' => "banJSON.json"]);






        $viewPath = './resources/views/moderators/';

        if (!file_exists($viewPath)) {
            mkdir($viewPath, 0777, true);
        }


        if (file_exists($viewPath . "index.blade.php")){
            $this->info($viewPath . "index.blade.php" . " ALREADY EXISTS!");
        }else{

            $this->buildResource($viewPath . "index.blade.php" ,"moderatorIndex.stub");
        }


    }

    /**
     * Build auth resource
     *
     * @return void
     */
    protected function buildResource($path,$stub)
    {
        $showStub = "./stubs/auth/" . $stub;
        $tempStub = $this->files->get($showStub);
        $this->files->put($path, $tempStub);

    }

    protected function getStub()
    {
        // TODO: Implement getStub() method.
    }
}
