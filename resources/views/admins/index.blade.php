@extends('dashboard')

@section('content')

    <div class="container  ">
        <div class="d-flex justify-content-center">

            <h1>Administration Panel</h1>

        </div>

        <div class="d-flex justify-content-center">

            <h3>Create new CRUD Item</h3>

        </div>

        <div class="d-flex  justify-content-center">

            <form method="POST" enctype="multipart/form-data" action="{{route('admins.store')}}" onsubmit="return confirm('Do you really want to create the item?');">
                {{csrf_field()}}
                <div class="row">

                    <div class="col-12 ">

                        <div class='input-group input-group-lg'>
                            <label for="baseName">Database Name</label>
                            <input  name='baseName' id='baseName' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='' placeholder='baseName'></div>
                        <div class='input-group input-group-lg'>
                            <label for="vars">Variables</label>
                            <input readonly name='vars' id='vars' type='Text' class='form-control varFRM' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='' placeholder='Variables'>
                        </div>

                    </div>

                    <div class="col-12">
                        <div class='input-group input-group-lg'>
                            <label for="validation">Validation</label>
                            <input readonly name='validation' id='validation' type='Text' class='form-control valFRM' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='' placeholder='validation'></div>
                        <div class='input-group input-group-lg'>
                            <label for="inputs">Inputs</label>
                            <input readonly name='inputs' id='inputs' type='Text' class='form-control inputFRM' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='' placeholder='inputs'></div>



                    </div>
                <div class='input-group input-group-lg'>
                    <label for="foreignKey">Foreign Key</label>
                    <input readonly name='foreignKey' id='foreignKey' type='Text' class='form-control inputKEY' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='' placeholder='Foreign Key'></div>

                </div>

                    <div class="d-flex  justify-content-center">
                        <input type="submit" value="Submit" class="btn btn-primary" href=""></input>
                    </div>

                </div>


                @if(count($errors))
                    <div class="form-group">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </form>


        </div>

        @if (!empty($success))
            <br>
            <div class="d-flex justify-content-center">
                <div class="alert alert-success" role="alert">
                    {{$success}}
                </div>
            </div>
        @endif

        <br>

        <ul class="list-group">


            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Create Variables</button>

            <!-- Modal -->
            <div id="myModal" class="modal " role="dialog">
                <div class="modal-dialog ">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">

                            <h1 class="modal-title">Add Variables</h1>
                        </div>
                        <div class="modal-body">
                            <b>Vars</b>
                            <input id='demo' class="demo list-group-item varsInp" disabled>
                            <input placeholder="Input Variables" type="text" value="name" class="form-control varsTXT" href="">
                            <select class="form-control form-select varsSEL" aria-label="Default select example">
                            
                                <option selected value="string">String</option>
                                <option value="bigInteger">Big Integer</option>
                                <option value="unsignedBigInteger">Unsigned Big Integer</option>
                                <option value="boolean">Boolean</option>
                                <option value="char">Char</option>
                                <option value="date">Date</option>
                                <option value="float">Float</option>
                                <option value="longText">Long Text</option>
                                <option value="timestamps">timestamps</option>

                            </select>
                            <hr>
                            <b>Validations</b>
                            <input id='demo' class="demo list-group-item valFRM" disabled>
                            <div class=" justify-content-center row validationMOD">
                                <div class=" col-lg-6 form-check form-switch">
                                    <h5><b><u>Name</u>  </b> </h5>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Required</label>
                                    <input checked disabled class="form-check-input form-check-inputREQ" type="checkbox" id="flexSwitchCheckDefault">
                                    <br>


                                    <label class="form-check-label" for="flexSwitchCheckDefault">Max</label>
                                    <input class="form-check-input form-check-inputMAX" type="checkbox" id="flexSwitchCheckDefault">
                                    <input placeholder="" type="number" value="0" class="form-control valsMAX" href="">

                                    <label class="form-check-label" for="flexSwitchCheckDefault">Min</label>
                                    <input class="form-check-input form-check-inputMIN" type="checkbox" id="flexSwitchCheckDefault">
                                    <input placeholder="" type="number" value="0" class="form-control valsMIN" href="">

                                    <label class="form-check-label" for="flexSwitchCheckDefault">Email</label>
                                    <input class="form-check-input form-check-inputEMA" type="checkbox" id="flexSwitchCheckDefault">
                                </div>

                            </div>

                            <hr>
                            <b>Input Type</b>
                            <input id='demo' class="demo list-group-item inputFRM" disabled>
                            <select class="form-control form-select inputsSEL" aria-label="Default select example">

                                <option selected value="text">Text</option>
                                <option value="textarea">Text Area</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="email">email</option>
                                <option value="number">Number</option>
                                <option value="select">Select</option>
                                <option value="radio">Radio</option>
                                <option value="file">Photo</option>


                            </select>
                            <input placeholder="Selection Item Variables {item1:item2:item3}" type="text" value="" class="form-control inputsTXT" href="">
                            <hr>

                            <b>Foreign Key</b>
                            <br>
                            <br>
                            <label class="form-check-label" for="references">Column</label>
                            <input placeholder="References" type="text" value="" class="form-control inputsREF" href="" id="references">
                            <label class="form-check-label" for="onkey">OnReferences</label>
                            <input placeholder="On" type="text" value="" class="form-control inputsON" href="" id="onkey">
                            <label class="form-check-label" for="columnss">On</label>
                            <input id="columnss" placeholder="Column" type="text" value="" class="form-control inputsCOLU" href="">
                            <hr>
                            <br>
                            <button onclick="main()" id="btn1" class="varsBTN btn btn-primary">Add Var</button>
                            <button onclick="reset()" id="btn1" class="resetBTN btn btn-danger">reset</button>



                        </div>





                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>






        </ul>

        <script>

            var reg = /^(\w|)+(?::[A-Za-z0-9]+)*$/;
            var namereg=/^[A-Za-z]+$/;
            var nameVal= $('.varsTXT').val().toLowerCase();

            if(/^\s*$/.test(nameVal) == true ) {
                $(".varsBTN").prop("disabled", true);
            }
            $('.varsTXT').on('keyup', function() {
                let inputVal= $('.inputsTXT').val();
                let nameVal= $('.varsTXT').val().toLowerCase();

                if(reg.test(inputVal) != true || namereg.test(nameVal) != true) {
                    $(".varsBTN").prop("disabled", true);
                    $('.varsTXT').css('border-color', 'red');

                }else{

                    $(".varsBTN").removeAttr('disabled');

                    $('.varsTXT').css('border-color', '');
                }

            });


            $('.inputsTXT').on('keyup', function() {
                let inputVal= $('.inputsTXT').val();
                let nameVal= $('.varsTXT').val().toLowerCase();

                if(reg.test(inputVal) != true ) {
                    $(".varsBTN").prop("disabled", true);
                    $('.inputsTXT').css('border-color', 'red');

                }else{


                    if(namereg.test(nameVal) == true) {
                        $(".varsBTN").removeAttr('disabled');
                    }
                    $('.inputsTXT').css('border-color', '');
                }

            });


        </script>

    <script>

        var namereg=/^[A-Za-z]+$/;



        $('.inputsREF').on('keyup', function() {
            let inputREF=( $('.inputsREF').val());
            let nameON= $('.inputsON').val();
            let nameCOLU= $('.inputsCOLU').val();
            let inputVal= $('.inputsTXT').val();
            let nameVal= $('.varsTXT').val().toLowerCase();

            if(/^\s*$/.test(inputREF) == true &&/^\s*$/.test(nameON) == true && /^\s*$/.test(nameCOLU) == true ) {
                $('.inputsON').css('border-color', '');
                $('.inputsCOLU').css('border-color', '');
                $('.inputsREF').css('border-color', '');
            }

            if(namereg.test(inputREF) == true){
                $('.inputsREF').css('border-color', '');
            }
            if(namereg.test(nameON) == true){
                $('.inputsON').css('border-color', '');
            }
            if(namereg.test(nameCOLU) == true){
                $('.inputsCOLU').css('border-color', '');
            }
            if(namereg.test(inputREF) != true || namereg.test(nameON) != true || namereg.test(nameCOLU) != true) {
                $(".varsBTN").prop("disabled", true);

                if(namereg.test(inputREF) != true && /^\s*$/.test(inputREF) != true){
                    $('.inputsREF').css('border-color', 'red');
                }
                if(namereg.test(nameON) != true && /^\s*$/.test(nameON) != true){
                    $('.inputsON').css('border-color', 'red');
                }
                if(namereg.test(nameCOLU) != true && /^\s*$/.test(nameCOLU) != true){
                    $('.inputsCOLU').css('border-color', 'red');
                }



            }else{


                if(namereg.test(nameVal) == true && reg.test(inputVal) == true) {
                    $(".varsBTN").removeAttr('disabled');
                }



            }

        });

        $('.inputsON').on('keyup', function() {
            let inputREF= $('.inputsREF').val();
            let nameON= $('.inputsON').val();
            let nameCOLU= $('.inputsCOLU').val();
            let inputVal= $('.inputsTXT').val();
            if(namereg.test(inputREF) == true || /^\s*$/.test(inputREF) == true ){
                $('.inputsREF').css('border-color', '');
            }
            if(namereg.test(nameON) == true || /^\s*$/.test(nameON) == true){
                $('.inputsON').css('border-color', '');
            }
            if(namereg.test(nameCOLU) == true ||   /^\s*$/.test(nameCOLU) == true){
                $('.inputsCOLU').css('border-color', '');
            }

            if(namereg.test(inputREF) == true){
                $('.inputsREF').css('border-color', '');
            }
            if(namereg.test(nameON) == true){
                $('.inputsON').css('border-color', '');
            }
            if(namereg.test(nameCOLU) == true){
                $('.inputsCOLU').css('border-color', '');
            }
            if(namereg.test(inputREF) != true || namereg.test(nameON) != true || namereg.test(nameCOLU) != true) {
                $(".varsBTN").prop("disabled", true);

                if(namereg.test(inputREF) != true && /^\s*$/.test(inputREF) != true){
                    $('.inputsREF').css('border-color', 'red');
                }
                if(namereg.test(nameON) != true && /^\s*$/.test(nameON) != true){
                    $('.inputsON').css('border-color', 'red');
                }
                if(namereg.test(nameCOLU) != true && /^\s*$/.test(nameCOLU) != true){
                    $('.inputsCOLU').css('border-color', 'red');
                }



            }else{


                if(namereg.test(nameVal) == true && reg.test(inputVal) == true) {
                    $(".varsBTN").removeAttr('disabled');
                }


                if(namereg.test(inputREF) == true || /^\s*$/.test(inputREF) == true ){
                    $('.inputsREF').css('border-color', '');
                }
                if(namereg.test(nameON) == true || /^\s*$/.test(nameON) == true){
                    $('.inputsON').css('border-color', '');
                }
                if(namereg.test(nameCOLU) == true ||   /^\s*$/.test(nameCOLU) == true){
                    $('.inputsCOLU').css('border-color', '');
                }
            }

        });


        $('.inputsCOLU').on('keyup', function() {
            let inputREF= $('.inputsREF').val();
            let nameON= $('.inputsON').val();
            let nameCOLU= $('.inputsCOLU').val();
            let inputVal= $('.inputsTXT').val();
            if(/^\s*$/.test(inputREF) == true &&/^\s*$/.test(nameON) == true && /^\s*$/.test(nameCOLU) == true ) {
                $('.inputsON').css('border-color', '');
                $('.inputsCOLU').css('border-color', '');
                $('.inputsREF').css('border-color', '');
            }

            if(namereg.test(inputREF) == true){
                $('.inputsREF').css('border-color', '');
            }
            if(namereg.test(nameON) == true){
                $('.inputsON').css('border-color', '');
            }
            if(namereg.test(nameCOLU) == true){
                $('.inputsCOLU').css('border-color', '');
            }
            if(namereg.test(inputREF) != true || namereg.test(nameON) != true || namereg.test(nameCOLU) != true) {
                $(".varsBTN").prop("disabled", true);


                if(namereg.test(inputREF) != true && /^\s*$/.test(inputREF) != true){
                    $('.inputsREF').css('border-color', 'red');
                }
                if(namereg.test(nameON) != true && /^\s*$/.test(nameON) != true){
                    $('.inputsON').css('border-color', 'red');
                }
                if(namereg.test(nameCOLU) != true && /^\s*$/.test(nameCOLU) != true){
                    $('.inputsCOLU').css('border-color', 'red');
                }



            }else{


                if(namereg.test(nameVal) == true && reg.test(inputVal) == true) {
                    $(".varsBTN").removeAttr('disabled');
                }



                if(namereg.test(nameCOLU) == true){
                    $('.inputsCOLU').css('border-color', '');
                }
            }

        });
    </script>


        <script>

        let varStr="";
        let validationComplete="";
        let inputComplete="";
        let isFirst=true;
        let validationIsFirst=true;
        let inputIsFirst=true;

        let varNames=[];
        let validationNames=[];
        let inputNames=[];
           // document.getElementById("demo").innerHTML = "Paragraph changed.";

      reset()


        function buildValidation(name){

            let checkedValueREQ = $('.form-check-inputREQ:checked').val();
            let checkedValueUNI = $('.form-check-inputUNI:checked').val();
            let checkedValueMAX = $('.form-check-inputMAX:checked').val();
            let checkedValueMIN = $('.form-check-inputMIN:checked').val();
            let checkedValueEMA = $('.form-check-inputEMA:checked').val();


            let validationMAX = $('.valsMAX').val();
            let validationMIN = $('.valsMIN').val();

            let valItems='';

            let isReq=false;

            let isMAX=false;
            let isMIN=false




            if(validationIsFirst){
            valItems=name+',';
            }
            else{
                valItems='-'+name+',';
            }


            if(checkedValueREQ == 'on'){
                valItems+='required';
                isReq=true;
            }

            if(checkedValueMAX == 'on'){
                if(isReq || isUni){
                    valItems+='|max:'+validationMAX;
                }else{
                    valItems+='max:'+validationMAX;
                }
                let isMAX=true;

            } if(checkedValueMIN == 'on'){
                if(isReq || isUni || isMAX){
                    valItems+='|min:'+validationMIN;
                }else{
                    valItems+='min:'+validationMIN;
                }
                isMIN=true;

            }

            if(checkedValueMIN == 'on'){
                if(isReq || isUni || isMAX || isMIN){
                    valItems+='|email';
                }else{
                    valItems+='email';
                }


            }

validationIsFirst=false;

return valItems;
        }


        function buildInput(name) {

            var inputsSEL = $('.inputsSEL').val();
            var inputsTXT = $('.inputsTXT').val();

           // gender,select,male:female-
            let valItems='';

//if name exists
            if(inputIsFirst){
                valItems=name+',';
            }
            else{
                valItems='-'+name+',';
            }

            valItems+=inputsSEL;

            if(inputsSEL == 'select' || inputsSEL == 'checkbox' || inputsSEL == 'radio' ){

                valItems+=','+inputsTXT;

            }


inputIsFirst=false;
return valItems;
        }
        function main(){

            //required|max:1|min:1
            //baseName,required-
            let inputREF= $('.inputsREF').val();
            let nameON= $('.inputsON').val();
            let nameCOLU= $('.inputsCOLU').val();
            let name = $(".varsTXT").val().toLowerCase();
            let inputsSEL = $(".inputsSEL").val();



            if(/^\s*$/.test(name) == false) {
                if(inputsSEL == 'file'){
                    name='filePath'
                }
                validationComplete += buildValidation(name.toLowerCase());
                inputComplete += buildInput(name.toLowerCase());
                if (checkIfInputNAmeExists(name) == true || checkIfNameExists(name) == true || checkIfvalidationNAmeExists(name) == true || name == "") {
                } else {

                    addVar();
                    $('.valFRM').val(validationComplete);
                    $('.inputFRM').val(inputComplete);
                    if( /^[A-Za-z]+$/.test(inputREF) == true &&/^[A-Za-z]+$/.test(nameON) == true &&/^[A-Za-z]+$/.test(nameCOLU) == true ){

                       let foreignFormat = inputREF +"," + nameON+ ","+nameCOLU;
                        $('.inputKEY').val(foreignFormat);
                    }
                }
            }
        }

        function reset(){
            $('.valFRM').val("");
            $('.inputFRM').val("");
            $('.varFRM').val("");
            $('.inputTXT').val("");
            $('.varsTXT').val("");
            $('.inputKEY').val("");
            varStr="";
            validationComplete="";
            inputComplete="";
             varNames=[];
             validationNames=[];
             inputNames=[];
            isFirst=true;
            validationIsFirst=true;
           inputIsFirst=true;

        }


           function addVar(){

              let varsSel=$(".varsSEL").val();
              let completeVar="";

              if( varsSel != "Variable types") {
                  if ($(".varsTXT").val() == "") {
                      alert("Variable name field empty");

                  } else {
                      let varInput = $(".varsTXT").val();

                      if(checkIfNameExists(varInput) ==false){
                          console.log(checkIfNameExists(varInput))
                      if (isFirst != true) {

                          completeVar = ',' + varsSel + ':' + varInput
                          varNames.push(varInput);
                      } else {
                          completeVar = varsSel + ':' + varInput
                          isFirst = false;
                          varNames.push(varInput);
                      }
                      varStr += completeVar;

                      $(".varsInp").append(completeVar);
                      $(".varsTXT").val("");
                      $('.varFRM').val(varStr);

                  }else{
                         alert('(Variable with name of:' + varInput+' already exists');
                      }
                  }

              }else{
                   alert("No selected variable type!");
               }
           }

        function checkIfNameExists(name){
            let exists =false;
            varNames.forEach((element)=>{

            if(element==name){
                console.log('(Variable with name of:' + element+' already exists');
               exists=true;
            }

            });

            return exists;
        }

        function checkIfvalidationNAmeExists(name){
            let exists =false;
            validationNames.forEach((element)=>{

                if(element==name){
                   alert('(validation with name of:' + element+' already exists');
                    exists=true;
                }

            });
            if(name == ""){
                exists=true;
            }
return exists;
        }
        function checkIfInputNAmeExists(name){
            let exists =false;
            inputNames.forEach((element)=>{

                if(element==name){
                    alert('(Innput with name of:' + element+' already exists');
                    exists=true;
                }

            });

            if(name == ""){
                exists=true;
            }
return exists;
        }






        $('#exampleModal').modal()





        </script>

        <style>
            body{margin-top:20px;}


            /* USER LIST TABLE */
            .user-list tbody td > img {
                position: relative;
                max-width: 50px;
                float: left;
                margin-right: 15px;
            }
            .user-list tbody td .user-link {
                display: block;
                font-size: 1.25em;
                padding-top: 3px;
                margin-left: 60px;
            }
            .user-list tbody td .user-subhead {
                font-size: 0.875em;
                font-style: italic;
            }

            /* TABLES */
            .table {
                border-collapse: separate;
            }
            .table-hover > tbody > tr:hover > td,
            .table-hover > tbody > tr:hover > th {
                background-color: #eee;
            }
            .table thead > tr > th {
                border-bottom: 1px solid #C2C2C2;
                padding-bottom: 0;
            }
            .table tbody > tr > td {
                font-size: 0.875em;
                background: #f5f5f5;
                border-top: 10px solid #fff;
                vertical-align: middle;
                padding: 12px 8px;
            }
            .table tbody > tr > td:first-child,
            .table thead > tr > th:first-child {
                padding-left: 20px;
            }
            .table thead > tr > th span {
                border-bottom: 2px solid #C2C2C2;
                display: inline-block;
                padding: 0 5px;
                padding-bottom: 5px;
                font-weight: normal;
            }
            .table thead > tr > th > a span {
                color: #344644;
            }
            .table thead > tr > th > a span:after {
                content: "\f0dc";
                font-family: FontAwesome;
                font-style: normal;
                font-weight: normal;
                text-decoration: inherit;
                margin-left: 5px;
                font-size: 0.75em;
            }
            .table thead > tr > th > a.asc span:after {
                content: "\f0dd";
            }
            .table thead > tr > th > a.desc span:after {
                content: "\f0de";
            }
            .table thead > tr > th > a:hover span {
                text-decoration: none;
                color: #2bb6a3;
                border-color: #2bb6a3;
            }
            .table.table-hover tbody > tr > td {
                -webkit-transition: background-color 0.15s ease-in-out 0s;
                transition: background-color 0.15s ease-in-out 0s;
            }
            .table tbody tr td .call-type {
                display: block;
                font-size: 0.75em;
                text-align: left;
            }
            .table tbody tr td .first-line {
                line-height: 1.5;
                font-weight: 400;
                font-size: 1.125em;
                text-align: left;
            }
            .table tbody tr td .first-line span {
                font-size: 0.875em;
                color: #969696;
                font-weight: 300;
            }
            .table tbody tr td .second-line {
                font-size: 0.875em;
                line-height: 1.2;
                text-align: left;
            }
            .table tbody tr td .second-line {
                font-size: 0.875em;
                line-height: 1.2;
                text-align: left;
            }
            .table a.table-link {
                margin: 0 5px;
                font-size: 1.125em;
            }
            .table a.table-link:hover {
                text-decoration: none;
                color: #2aa493;
            }
            .table a.table-link.danger {
                color: #fe635f;
            }
            .table a.table-link.danger:hover {
                color: #dd504c;
            }

            .table-products tbody > tr > td {
                background: none;
                border: none;
                border-bottom: 1px solid #ebebeb;
                -webkit-transition: background-color 0.15s ease-in-out 0s;
                transition: background-color 0.15s ease-in-out 0s;
                position: relative;
            }
            .table-products tbody > tr:hover > td {
                text-decoration: none;
                background-color: #f6f6f6;
            }
            .table-products .name {
                display: block;
                font-weight: 600;
                padding-bottom: 7px;
            }
            .table-products .price {
                display: block;
                text-decoration: none;
                width: 50%;
                float: left;
                font-size: 0.875em;
            }
            .table-products .price > i {
                color: #8dc859;
            }
            .table-products .warranty {
                display: block;
                text-decoration: none;
                width: 50%;
                float: left;
                font-size: 0.875em;
            }
            .table-products .warranty > i {
                color: #f1c40f;
            }
            .table tbody > tr.table-line-fb > td {
                background-color: #9daccb;
                color: #262525;
            }
            .table tbody > tr.table-line-twitter > td {
                background-color: #9fccff;
                color: #262525;
            }
            .table tbody > tr.table-line-plus > td {
                background-color: #eea59c;
                color: #262525;
            }
            .table-stats .status-social-icon {
                font-size: 1.9em;
                vertical-align: bottom;
            }
            .table-stats .table-line-fb .status-social-icon {
                color: #556484;
            }
            .table-stats .table-line-twitter .status-social-icon {
                color: #5885b8;
            }
            .table-stats .table-line-plus .status-social-icon {
                color: #a75d54;
            }
        </style>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box clearfix">
                        <div class="table-responsive">
                            <table class="table ">
                                <thead>



                                <tr>
                                    <th><span>#</span></th>
                                    <th><span>Database Name</span></th>
                                    <th class="text-center"><span>Variables</span></th>
                                    <th><span>Validation</span></th>
                                    <th><span>Inputs</span></th>
                                    <th><span>Foreign Key</span></th>

                                    <th><span>Actions</span></th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($admins as $admin)

                                    <tr>
                                    <td style="text-align: left;">
                                        {{$admin->id}}

                                    </td>
                                        <td style="text-align: left;">
                                            {{$admin->baseName}}

                                        </td>
                                    <td style="text-align: left;">
                                        {{$admin->vars}}
                                    </td>
                                    <td class="" style="text-align: left;">
                                       {{$admin->validation}}
                                    </td>
                                    <td style="text-align: left;">
                                       {{$admin->inputs}}
                                    </td>
                                        <td style="text-align: left;">
                                       {{$admin->foreignKey}}
                                    </td>



                                    <td style="width: 20%;">
                                        <a href="{{route('admins.show',$admin)}}" class="table-link">
									<span class="fa-stack">
										<i class="fa fa-square fa-stack-2x"></i>
										<i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
									</span>
                                        </a>
                                        <a href="{{route("admins.edit",$admin)}}" class="table-link">
									<span class="fa-stack">
										<i class="fa fa-square fa-stack-2x"></i>
										<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
									</span>
                                        </a>

                                        <span class="table-link">
										<form onsubmit="return confirm('Do you really want to delete the item?');"
                                                                                  action="{{route('admins.destroy',$admin)}}" method="POST" class="fa-stack">
                                                            @method('DELETE')
                                                @csrf
                                            <button type="submit" value=""   class="btn-danger" style="border-radius: 20%;"><i class="glyphicon glyphicon-trash"></i></button>


                                                        </form>
                                        </span>



                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>












    </div>

@endsection
