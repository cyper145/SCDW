<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>jQuery UI Autocomplete - Default functionality</title>
    
    <link href="{{asset('/js/jquery-ui/jquery-ui.css')}}" rel="stylesheet">
    
    <script src="{{asset('/js/jquery-1.11.1.min.js')}}"></script>
    
    <script src="{{asset('/js/jquery-ui/jquery-ui.js')}}"></script>
    
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">

</head>
<body>

<div class="container">
    <h2>test</h2>


    {{ Form::open(array('url' => '', 'files'=> true)) }}

    <div class="form-group">
        <label for="">Find a color</label>
        <input type="text" class="form-control input-sm" name="auto" id="auto">
    </div>

    <div class="form-group">
        <label for="">Response</label>
        <input type="text" class="form-control input-sm" name="response" id="response" disabled>
    </div>

    {{Form::close()}}

    <script>
        $(function() {
            $("#auto").autocomplete({
                source: "getdata",
                minLength: 1,
                select: function( event, ui ) {
                    $('#response').val(ui.item.id);
                }
            });
        });
    </script>

</body>
</html>