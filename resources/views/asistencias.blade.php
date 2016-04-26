<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cuartel Militar 323-Batallon Camacaro.</title>
    {!! Html::style('libs/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('libs/bootstrap/css/bootstrap-theme.min.css') !!}

    {!! Html::style('libs/DataTables/media/css/dataTables.bootstrap.min.css') !!}

    {!! Html::style('libs/formvalidation/css/formValidation.min.css') !!}
    
    <style type="text/css">
      body { background-color: #FCFCFC; }
      .oculto { display: none; }
    </style>
  </head>
  <body>

  <div class="container">
    @yield('contenido')
  </div>

    {!! Html::script('libs/jquery.min.js') !!}
    {!! Html::script('libs/bootstrap/js/bootstrap.min.js') !!} 

    {!! Html::script('libs/DataTables/media/js/jquery.dataTables.min.js') !!}
    {!! Html::script('libs/DataTables/media/js/dataTables.bootstrap.min.js') !!}

    {!! Html::script('libs/formvalidation/js/formValidation.min.js') !!}
    {!! Html::script('libs/formvalidation/js/framework/bootstrap.min.js') !!}

    @yield('scripts')
  </body>
</html>