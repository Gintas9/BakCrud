JEI 404 not found - php artisan route:clear

pridejau ivairius input type for HTML
Jsonui sukuria HTML inputu aprasymus
  


php artisan crudgen:CRUD Gama --vars="name,body,age" --schema="string:title,string:body,string:age"
php artisan crudgen:model Alpha

php artisan crudgen:view Beta --json="alphaJSON.json"
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


php artisan crudgen:view Gama --json="gamaJSON.json"
php artisan crudgen:controller Gama --json="gamaJSON.json"
php artisan crudgen:migration Gama --json="gamaJSON.json"
php artisan crudgen:model Gama

without option
php artisan crudgen:json Gama --vars="string:name,string:lastName,string:description,int:age,string:email,char:letter" --validation="name,required|max:100-lastName,required-age,required-description,required-email,email-letter,required|max:1|min:1" --inputs="name,text-lastName,text-age,number-description,textarea-email,email-letter,text"

WITH OPTION####################################
php artisan crudgen:json Zetta --vars="string:gender,string:name,string:lastName" --validation="gender,required|min:1-name,required|max:100-lastName,required" --inputs="gender,select,male:female-name,text-lastName,text"


php artisan crudgen:view Zetta --json="zettaJSON.json"
php artisan crudgen:controller Zetta --json="zettaJSON.json"
php artisan crudgen:migration Zetta --json="zettaJSON.json"
php artisan crudgen:model Zetta

BOOLOEAN######
php artisan crudgen:json Delta --vars="boolean:married,string:name,string:lastName" --validation="married,required-name,required|max:100-lastName,required" --inputs="married,select,True:False-name,text-lastName,text"
php artisan crudgen:view Delta --json="deltaJSON.json"
php artisan crudgen:controller Delta --json="deltaJSON.json"
php artisan crudgen:migration Delta --json="deltaJSON.json"
php artisan crudgen:model Delta



File upload #########

php artisan crudgen:json Omega --vars="string:name,string:lastName,string:filePath" --validation="name,required|max:100-lastName,required-filePath,min:1" --inputs="name,text-lastName,text-filePath,file"
php artisan crudgen:view Omega --json="omegaJSON.json"
php artisan crudgen:controller Omega --json="omegaJSON.json"
php artisan crudgen:migration Omega --json="omegaJSON.json"
php artisan crudgen:model Omega


###########moderator
php artisan crudgen:json Moderator --vars="string:gender,string:name,string:lastName" --validation="gender,required|min:1-name,required|max:100-lastName,required" --inputs="gender,select,male:female-name,text-lastName,text"
php artisan crudgen:view Moderator --json="moderatorJSON.json"
php artisan crudgen:controller Moderator --json="moderatorJSON.json"
php artisan crudgen:migration Moderator --json="moderatorJSON.json"
php artisan crudgen:model Moderator



###########admin panel
php artisan crudgen:json Admin --vars="string:baseName,string:vars,string:validation,string:inputs" --validation="baseName,required-vars,required-validation,required-inputs,required" --inputs="baseName,text-vars,text-validation,text-inputs,text"
php artisan crudgen:view Admin --json="adminJSON.json"
php artisan crudgen:controller Admin --json="adminJSON.json"
php artisan crudgen:migration Admin --json="adminJSON.json"
php artisan crudgen:model Admin


############Lambda
php artisan crudgen:CRUD Lambda --json="deltaJSON.json"
