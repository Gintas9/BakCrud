
php artisan crudgen:CRUD Gama --vars="name,body,age" --schema="string:title,string:body,string:age"
php artisan crudgen:model Alpha

php artisan crudgen:view Registration --json="alphaJSON.json"
php artisan crudgen:view Alpha --vars="title,body,age"

php artisan crudgen:json Registration --vars="string:name,string:email,string:password" --validation="name,required|min:1|unique-email,required|min:1|unique|email-password,required" --keys="beta,references,OnSomething"



php artisan crudgen:migration Alpha --json="alphaJSON.json"

php artisan crudgen:json Alpha --vars="string:title,string:body,integer:age" --validation="title,required|min:1-body,required|max:100-age,required"

php artisan crudgen:json Testeryzas --vars="string:gender,string:name,string:lastName" --validation="gender,required|min:1-name,required|max:100-lastName,required" --inputs="gender,select,male:female-name,text-lastName,text"




php artisan crudgen:controller Gama --vars="title,body,age"
php artisan crudgen:controller Alpha --json=alphaJSON.json
php artisan crudgen:controller Registration --json="alphaJSON.json"

php artisan crudgen:migration Gama --schema="string:title,string:body,string:age"
php artisan crudgen:migration Alpha --json="alphaJSON.json"


php artisan crudgen:auth



