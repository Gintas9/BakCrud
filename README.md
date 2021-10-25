
php artisan crudgen:CRUD Gama
php artisan crudgen:model Alpha
php artisan crudgen:controller Gama --vars="title,body,age"
php artisan crudgen:migration Gama --schema="string:title,string:body,string:age"
php artisan crudgen:view Alpha --vars="title,body,age"

php artisan crudgen:json Alpha --vars="string:title,string:body,int:age" --validation="title,required|min:1-body,required|max:100-age,required" --keys="beta,references,OnSomething"

php artisan crudgen:migration Alpha --json="alphaJSON.json"



php artisan crudgen:controller Alpha --json=alphaJSON.json

php artisan crudgen:migration Alpha --json="alphaJSON.json"




php artisan crudgen:json Alpha --vars="string:title,string:body,integer:age" --validation="title,required|min:1-body,required|max:100-age,required"


php artisan crudgen:view Alpha --json="alphaJSON.json"
