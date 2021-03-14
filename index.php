<?php
require_once 'App/Helpme.php';
require_once 'Report.php';

use App\Helpme;
if($_POST){
    $pars = [];
    $start = 0;
    foreach ($_POST['age'] as $isi){
        $pars[] = ['age'=>$_POST['age'][$start], 'year'=>$_POST['year'][$start]];
        $start+=1;
    }

    $init = new Report($pars);
    $ave = $init->getAveragePeople();
    if($ave){
        die(json_encode(['status'=>true, 'msg' => 'Data Ok', 'data'=>['average'=>$ave]]));
    }else{
        die(json_encode(['status'=>false, 'msg' => 'Data Salah, Silahkan dicek kembali.']));
    }
    // Helpme::dd($init->getAveragePeople());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Ari Wahyu Nahar</title>
</head>
<body>
<h1 style="margin-bottom: 20px;">Ari Wahyu Nahar</h1>

<form id="id_form" class="row g-3 needs-validation">
    <div class="row">
        <div class="col-md-3">
            <button class="btn btn-primary" onclick="addRow(event)">
                Add Person
            </button>
        </div>
    </div>
    <div id="elment">
        <div class="row">
            <div class="col-md-6">
                <label>Person 1</label>
                <div class="input-group">
                    <span class="input-group-text">Age Of Death</span>
                    <input name="age[]" type="text" aria-label="Age" min="1" max="1000" class="form-control" required>
                    <span class="input-group-text">Year Of Death: </span>
                    <input name="year[]" type="text" aria-label="Last name" min="1" max="1000" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>Person 2</label>
                <div class="input-group">
                    <span class="input-group-text">Age Of Death</span>
                    <input name="age[]" type="text" aria-label="Age" min="1" max="1000" class="form-control" required>
                    <span class="input-group-text">Year Of Death: </span>
                    <input name="year[]" type="text" aria-label="Last name" min="1" max="1000" class="form-control" required>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>&nbsp;</label>
            <div class="input-group">
                <button type="submit" class="btn btn-primary mb-3">Calculate!</button>
                <input id="hasil" type="text" readonly class="form-control">
            </div>
        </div>
    </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
    var st = 3;
    $('#id_form').on('submit',function(e) {
        $('#hasil').val('');
        $.ajax({
            data: new FormData(this),
            type:'POST',
            dataType:"json",
            contentType: false,
            cache: false,
            processData:false,
            success:function(data){
                if(data.status){
                    $('#hasil').val(data.data.average);
                }else{
                    alert(data.msg);
                }
            },
            error:function(data){
                alert('Please Try Again.');
            }
        });
        e.preventDefault();
    });

    function addRow(e) {
        e.preventDefault();
        $('#elment').append('<div class="row">\n' +
            '        <div class="col-md-6">\n' +
            '            <label>Person '+ (st++) +'</label>\n' +
            '            <div class="input-group">\n' +
            '                <span class="input-group-text">Age Of Death</span>\n' +
            '                <input name="age[]" type="text" aria-label="Age" min="1" max="1000" class="form-control" required>\n' +
            '                <span class="input-group-text">Year Of Death: </span>\n' +
            '                <input name="year[]" type="text" aria-label="Last name" min="1" max="1000" class="form-control" required>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>');
    }

</script>
</body>
</html>
