<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pestaña</title>
    {!! Html::style('libs/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('libs/bootstrap/css/bootstrap-theme.min.css') !!}
    
    @yield('styles')
  </head>
  <body>
  	 
    <div id="container">
    @yield('contenido')
    </div>

  	{!! Html::script('libs/jquery.min.js') !!}
  	{!! Html::script('libs/bootstrap/js/bootstrap.min.js') !!}
  </body>
</html>