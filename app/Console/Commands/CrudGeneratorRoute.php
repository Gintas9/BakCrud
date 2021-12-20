<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class CrudGeneratorRoute extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crudgen:route {name}
                            {--delete}
                            {--create}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Check if route exists
     *
     * @return int
     */
    public function checkIfRoutePresent($name)
    {

        $webURL=base_path("/routes/web.php");
        $controllerName=ucfirst(strtolower($name));
        $plurName=strtolower($name) . 's';
        $web = $this->files->get($webURL);
        $template = "Route::resource('{{Name}}','App\Http\Controllers\{{ControllerName}}Controller');";
        $temp1 = str_replace(
            '{{ControllerName}}', $controllerName, $template
        );
        $temp2 = str_replace(
            '{{Name}}', $plurName, $temp1
        );
        if(strpos($web,$temp2) == false){

                return false;
        }else{


            return true;
        }


    }

    /**
     * Create Route
     *
     * @return int
     */
    public function createRoute($name)
    {

        $webURL="./routes/web.php";
        $controllerName=ucfirst(strtolower($name));
        $plurName=strtolower($name) . 's';
        $web = $this->files->get($webURL);
        $template = "Route::resource('{{Name}}','App\Http\Controllers\{{ControllerName}}Controller');";
        $temp1 = str_replace(
            '{{ControllerName}}', $controllerName, $template
        );
        $temp2 = str_replace(
            '{{Name}}', $plurName, $temp1
        );
        if(strpos($web,$temp2) == false){
            $fp= fopen($webURL, 'a');
            fwrite($fp,PHP_EOL.$temp2);
             fclose($fp);
              $this->info('Created Resource Route!');

        }else{
            $this->info('Route already present!');

        }


    }

    /**
     * Delete Route
     *
     * @return int
     */
    public function deleteRoute($name)
    {

        $webURL=base_path("/routes/web.php");
        $controllerName=ucfirst(strtolower($name));
        $plurName=strtolower($name) . 's';
        $web = $this->files->get($webURL);
        $template = "Route::resource('{{Name}}','App\Http\Controllers\{{ControllerName}}Controller');";
        $temp1 = str_replace(
            '{{ControllerName}}', $controllerName, $template
        );
        $temp2 = str_replace(
            '{{Name}}', $plurName, $temp1
        );
        if(strpos($web,$temp2) == false){

            $this->info('Route Not Present!');

        }else{

            $web = str_replace(
                $temp2, "", $web
            );
            $this->info('Route Deleted!');

            $this->files->put($webURL, $web);
        }


    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        $regName = "/^[A-Za-z]+$/";

        if(preg_match($regName, $this->argument('name')) ==0)
        {
            throw new Exception('Wrong Name Convention. Can only be string letters, no numbers or special characters.');


        }


        if($this->checkIfRoutePresent( $this->argument('name')) == true ) {
            $this->info("true");
        }else{
            $this->info("");
        }
        if($this->option('delete')  != null && $this->option('create')  != null){
            $this->warn('CAnt use both create and delete parameters!');
        }else {
            if ($this->option('delete') != null) {

                    $this->deleteRoute($this->argument('name'));
            }
            if ($this->option('create') != null) {

                $this->createRoute($this->argument('name'));

            }
        }
    }

    protected function getStub()
    {
        // TODO: Implement getStub() method.
    }
}
