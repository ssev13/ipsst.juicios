<html lang="es">
<head>
    <title></title>  
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>      
</head>
<body>
<div class="container">
    <div class="content">

        <div class="form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="date">{{ $fecha_titulo }}</label>
                        <input class="form-control" type="text" id="{{ $fecha_var }}" name="{{ $fecha_var }}" value="{{ $fecha_base }}"/>
                    </div>
                </div>
        </div>
    </div>
</div>


<script>
    $('#{{ $fecha_var }}').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss'
    });
</script>

</body>
</html>