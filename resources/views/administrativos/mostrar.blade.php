@extends('plantilla')

@section('contenido')
<div class="page-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
    <li><a href="{{ url('/administrativos') }}"><i class="glyphicon glyphicon-bookmark"></i> Administrativos</a></li>
      <li class="active"><i class="glyphicon glyphicon-folder-open"></i> Mostrar</li>
  </ol>
  <h3>Personal Civil Administrativo <small>/ ver informacion</small></h3>
</div>

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#informacion">Informacion</a></li>
  <li><a data-toggle="tab" href="#empleado">Datos del empleado</a></li>
  <li><a data-toggle="tab" href="#permisos">Permisos</a></li>
  <li><a data-toggle="tab" href="#vacaciones">Vacaciones</a></li>
</ul>


<div class="tab-content">
  <div id="informacion" class="tab-pane active">
    <div class="row">
      <div class="col-lg-3">
        {!! Html::image('img/profile.png', 'Image de perfil', array('width' => '100%' , 'class' => 'img-thumbnail')) !!}
      </div>

      <div class="col-lg-9">
        <form class="form-horizontal">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="form-group">
                <label class="col-lg-3 control-label">Cedula</label>
                <div class="col-lg-9">
                  <p class="form-control-static">{{ $personal->cedula }}</p>
                  <input type="hidden" id="cedula" name="cedula" value="{{ $personal->cedula }}"></input>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Nombre completo</label>
                <div class="col-lg-9">
                  <p class="form-control-static">{{ $personal->nombre }} {{ $personal->apellido }}</p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Edad</label>
                <div class="col-lg-9">
                  <p class="form-control-static">{{ $personal->edad }}</p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Sexo</label>
                <div class="col-lg-9">
                  <p class="form-control-static">{{ $personal->sexo }}</p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Estado civil</label>
                <div class="col-lg-9">
                  <p class="form-control-static">{{ $personal->ecivil }}</p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Numero de hijos</label>
                <div class="col-lg-9">
                  <p class="form-control-static">{{ $personal->nhijos }}</p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Direccion</label>
                <div class="col-lg-9">
                  <p class="form-control-static">{{ $personal->direccion }}</p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Telefono</label>
                <div class="col-lg-9">
                  <p class="form-control-static">{{ $personal->telefono }}</p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Fecha de nacimiento</label>
                <div class="col-lg-9">
                  <p class="form-control-static">{{ \Carbon\Carbon::parse($personal->fnacimiento)->format('d/m/Y') }}</p>
                </div>
              </div>
            </div>
          </div>
        </form>
        
        <strong>Creado el</strong>: {{ $administrativo->created_at->format('d/m/Y') }} / <strong>Ultima actualizacion:</strong> {{ $administrativo->updated_at->format('d/m/Y h:i:s A') }}
        <div class="pull-right">
          <a href="{{ url('/administrativos') }}" type="button" class="btn btn-default"><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span> Atras</a>
          <a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ventanaEliminar"><span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span> Desactivar</a>
          <a href="{{ url('/administrativos/editar', $personal->cedula) }}" type="button" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Actualizar</a>
        </div>
      </div>
    </div>
  </div>

  <div id="empleado" class="tab-pane">
    <div class="row">
      <div class="col-lg-3">
        {!! Html::image('img/profile.png', 'Image de perfil', array('width' => '100%' , 'class' => 'img-thumbnail')) !!}
      </div>

      <div class="col-lg-9">
        <form class="form-horizontal">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="form-group">
                <label class="col-lg-3 control-label">Tipo</label>
                <div class="col-lg-9">
                  <p class="form-control-static">{{ $personal->tpersonal }}</p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Fecha de ingreso</label>
                <div class="col-lg-9">
                  <p class="form-control-static">{{ \Carbon\Carbon::parse($personal->fingreso)->format('d/m/Y') }}</p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Profesion</label>
                <div class="col-lg-9">
                  <p class="form-control-static">{{ $profesion->nombre }}</p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Dependencia</label>
                <div class="col-lg-9">
                  <p class="form-control-static"><a href="{{ url('/dependencias', $dependencia->codigo) }}">{{ $dependencia->nombre }}</a></p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Cargo</label>
                <div class="col-lg-9">
                  <p class="form-control-static"><a href="{{ url('/cargos', $cargo->codigo) }}">{{ $cargo->tipo }}</a></p>
                </div>
              </div>
            </div>
          </div>
        </form>
            
        <strong>Creado el</strong>: {{ $administrativo->created_at->format('d/m/Y') }} / <strong>Ultima actualizacion:</strong> {{ $administrativo->updated_at->format('d/m/Y h:i:s A') }}
        <div class="pull-right">
          <a href="{{ url('/administrativos') }}" type="button" class="btn btn-default"><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span> Atras</a>
          <a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ventanaEliminar"><span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span> Desactivar</a>
          <a href="{{ url('/administrativos/editar', $personal->cedula) }}" type="button" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Actualizar</a>
        </div>
      </div>
    </div>
  </div>


  <div id="permisos" class="tab-pane">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-lg-4">
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-primary">
              <div class="panel-heading" role="tab" id="headingOne">
                <h6 class="panel-title">
                  <small>Numero de solicitudes de permisos (mes actual)</small>
                  <div class="pull-right">
                    <a role="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <span class="glyphicon glyphicon-resize-full" aria-hidden="true"></span>
                    </a>
                  </div>
                </h6>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                  <ul class="list-group">
                    <li class="list-group-item">
                      <strong>Personales</strong> <span class="badge"><small>{{ $permisosMesActual['personales'] }}</small></span>
                    </li>
                    <li class="list-group-item">
                      <strong>Medicos</strong> <span class="badge"><small>{{ $permisosMesActual['medicos'] }}</small></span>
                    </li>
                    <li class="list-group-item">
                      <strong>Duelo</strong> <span class="badge"><small>{{ $permisosMesActual['duelo'] }}</small></span>
                    </li>
                  </ul>

                  <br/>

                  <button class="btn btn-default btn-block" {{ $botonSolicitud["reciente"] }} data-toggle="modal" data-target="#solicitarPermiso"><span class="glyphicon glyphicon-level-up"></span> Solicitar permiso</button>
                </div>
              </div>
            </div>
            <div class="panel panel-primary">
              <div class="panel-heading" role="tab" id="headingTwo">
                <h6 class="panel-title">
                  <small>Personalizar indicadores</small>
                  <div class="pull-right">
                    <a role="button" class="collapsed btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      <span class="glyphicon glyphicon-resize-full" aria-hidden="true"></span>
                    </a>
                  </div>
                </h6>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                      {!! Form::open(['autocomplete' => 'off', 'method' => 'post', 'role' => 'form']) !!}
                      
                      <div class="form-group form-group-sm">
                        {!! Form::label('tipoGrafica', 'Tipo de grafica', array('class' => 'control-label')) !!}
                        {!! Form::select('tipoGrafica', array('1' => 'Areas apiladas', '2' => 'Columnas', '3' => 'Columnas apiladas'), 3, array('class' => 'form-control', 'tabindex' => '1')) !!}
                      </div>

                      <div class="form-group form-group-sm">
                        {!! Form::label('solicitudes', 'Registro de permisos', array('class' => 'control-label')) !!}
                        {!! Form::select('solicitudes', array('1' => 'Todos los registros', '2' => 'Cumplidos', '3' => 'No respondidos'), null, array('class' => 'form-control', 'tabindex' => '1')) !!}
                      </div>

                      <div class="form-group form-group-sm">
                        {!! Form::label('anio', 'Año', array('class' => 'control-label')) !!}
                        {!! Form::select('anio', array('1' => 'Actual', '2' => 'Pasado', '3' => 'Antepasado'), null, array('class' => 'form-control', 'tabindex' => '2')) !!}
                      </div>

                      <div class="form-group form-group-sm">
                        {!! Form::label('periodo', 'Periodo/Meses', array('class' => 'control-label')) !!}
                        {!! Form::select('periodo', array('1' => 'Hasta el mes actual', '2' => 'Todos los meses'), null, array('class' => 'form-control', 'tabindex' => '2')) !!}
                      </div>

                      {!! Form::close() !!}
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div id="grafica" style="width: 720px; height: 350px; margin: 0 auto;"></div>
        </div>
      </div>
    </div>

    <hr>

    <div class="panel panel-default">
      <div class="panel-body">
        <table id="historial_permisos" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Tipo de permiso</th>
              <th>Desripcion</th>
              <th>Fec. permiso</th>
              <th>Fec. ingreso</th>
              <th>Estatus</th>
            </tr>
          </thead>
          <tbody>
          @foreach($historialPermisos as $historial)
            <tr>
              <td>
              @if($historial->tipo == 1)
                <strong>Personal</strong>
              @elseif($historial->tipo == 2)
                <strong>Medico</strong>
              @elseif($historial->tipo == 3)
                <strong>Duelo</strong>
              @endif
              </td>
              <td>{{ $historial->descripcion }}</td>
              <td>{{ \Carbon\Carbon::parse($historial->fecha_permiso)->format('d/m/Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($historial->fecha_ingreso)->format('d/m/Y') }}</td>
              <td>
              @if($historial->estatus == 0)
                <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#aprobarPermiso"><span class="glyphicon glyphicon-ok"></span> en espera</button>
              @elseif($historial->estatus == 1)
                <span class="label label-success"><small>aprobado</small></span>
              @elseif($historial->estatus == 2)
                <span class="label label-warning"><small>de permiso</small></span>
              @elseif($historial->estatus == 3)
                <span class="label label-info"><small>cumplido</small></span>
              @elseif($historial->estatus == 4)
                <span class="label label-danger"><small>cancelado</small></span>
              @endif
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div id="vacaciones" class="tab-pane">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-lg-4">
          <ul class="list-group">
            <li class="list-group-item active"><small>Estatus de vacaciones</small></li>
            <li class="list-group-item">
              <strong>Total acumuladas</strong>  
              <span class="label label-{{ $labelVacaciones['label1'] }} pull-right">
                {{ $estatusVacaciones['vacacionesTotales'] }}&nbsp;dias
              </span> 
            </li>
            <li class="list-group-item">
              <strong>Del año {{ \Carbon\Carbon::now()->year }}</strong>
              <span class="label label-{{ $labelVacaciones['label2'] }} pull-right">
                {{ $estatusVacaciones['vacacionesAnioActual'] }}&nbsp;dias
              </span>
            </li>
            <li class="list-group-item"><strong>Año de ingreso al Cuartel</strong> 
              <small class="pull-right">{{ \Carbon\Carbon::parse($personal->fingreso)->format('d/m/Y') }}</small>
            </li>
            <li class="list-group-item"><strong>Tiempo de servicio</strong> 
              <small class="pull-right">{{ $administrativo->tiempo_servicio }}</small>
            </li>
            <li class="list-group-item"><br/><br/><br/></li>
          </ul>

          <button class="btn btn-default btn-block" {{ $botonSolicitud["reciente"] }} {{ $botonSolicitud["tieneVacaciones"] }} data-toggle="modal" data-target="#solicitarVacaciones"><span class="glyphicon glyphicon-level-up"></span> Solicitar vacaciones</button>
        </div>

        <div class="col-lg-8">
          <div id="graficaMesesVacaciones" style="min-width: 720px; height: 350px; margin: 0 auto"></div>          
        </div>
      </div>
    </div>

    <hr>

    <div class="panel panel-default">
      <div class="panel-body">
        <table id="historial_vacaciones" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Dependencia</th>
              <th>Fec. salida</th>
              <th>Fec. ingreso</th>
              <th>Fec. solicitud</th>
              <th>Estatus</th>
            </tr>
          </thead>
          <tbody>
          @foreach($historialVacaciones as $historial)
            <tr>
              <td>{{ $historial->dependencia }}</a></td>
              <td>{{ \Carbon\Carbon::parse($historial->fecha_salida)->format('d/m/Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($historial->fecha_ingreso)->format('d/m/Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($historial->created_at)->format('d/m/Y') }}</td>
              <td>
              @if($historial->estatus == 0)
                <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#aprobarVacaciones"><span class="glyphicon glyphicon-ok"></span> en espera</button>
              @elseif($historial->estatus == 1)
                <span class="label label-success"><small>aprobada</small></span>
              @elseif($historial->estatus == 2)
                <span class="label label-warning"><small>de vacaciones</small></span>
              @elseif($historial->estatus == 3)
                <span class="label label-info"><small>cumplida</small></span>
              @elseif($historial->estatus == 4)
                <span class="label label-danger"><small>cancelada</small></span>
              @endif
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@include('administrativos.ventana_eliminar')
@include('administrativos.aprobar_permiso')
@include('administrativos.aprobar_vacaciones')
@include('administrativos.formulario_permisos')
@include('administrativos.formulario_vacaciones')

@stop

@section('graficas')
<script>
  $(document).ready(function() {
    $.get("{{ url('/permisos/registros', $personal->cedula) }}", { solicitudes : $('#solicitudes').val(), anio : $('#anio').val(), periodo : $('#anio').val() }, function(data) {
      graficaColumnasApiladas(data['periodos'], data['personal'], data['medico'], data['duelo']);
    });

    $('select').change(function(){
      $('#grafica').empty();

      if ($('#tipoGrafica').val() == 1){
        $.get("{{ url('/permisos/registros', $personal->cedula) }}", { solicitudes : $('#solicitudes').val(), anio : $('#anio').val(), periodo : $('#periodo').val() }, function(data) {
            graficaAreaApilada(data['periodos'], data['personal'], data['medico'], data['duelo']);
        });
      }
      else if ($('#tipoGrafica').val() == 2) {
        $.get("{{ url('/permisos/registros', $personal->cedula) }}", { solicitudes : $('#solicitudes').val(), anio : $('#anio').val(), periodo : $('#periodo').val() }, function(data) {
            graficaColumnas(data['periodos'], data['personal'], data['medico'], data['duelo']);
        });
      }
      else if ($('#tipoGrafica').val() == 3){
        $.get("{{ url('/permisos/registros', $personal->cedula) }}", { solicitudes : $('#solicitudes').val(), anio : $('#anio').val(), periodo : $('#periodo').val() }, function(data) {
            graficaColumnasApiladas(data['periodos'], data['personal'], data['medico'], data['duelo']);
        });
      }
    });

    function graficaColumnas(periodos, personal, medico, duelo) 
    {
      $('#grafica').highcharts({
          chart: {
              type: 'column'
          },
          title: {
              text: 'Grafica de columnas simple'
          },
          subtitle: {
              text: 'Registro de solicitudes de permisos'
          },
          xAxis: {
              categories: periodos,
              crosshair: true
          },
          yAxis: {
              allowDecimals: false,
              min: 0,
              title: {
                  text: 'Numero de permisos'
              }
          },
          tooltip: {
              headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
              pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y}</b></td></tr>',
              footerFormat: '</table>',
              shared: true,
              useHTML: true
          },
          plotOptions: {
              column: {
                  pointPadding: 0.2,
                  borderWidth: 0
              },
              series: {
                animation: false
              }
          },
          series: [personal, medico, duelo]
      });
    }

    function graficaColumnasApiladas(periodos, personal, medico, duelo)
    {
      $('#grafica').highcharts({
          chart: {
              type: 'column'
          },
          title: {
              text: 'Grafica de columnas apiladas'
          },
          xAxis: {
              categories: periodos
          },
          yAxis: {
              allowDecimals: false,
              min: 0,
              title: {
                  text: 'Numero de permisos'
              },
              stackLabels: {
                  enabled: true,
                  style: {
                      fontWeight: 'bold',
                      color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                  }
              }
          },
          legend: {
              align: 'right',
              x: -30,
              verticalAlign: 'top',
              y: 25,
              floating: true,
              backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
              borderColor: '#CCC',
              borderWidth: 1,
              shadow: false
          },
          tooltip: {
              headerFormat: '<b>{point.x}</b><br/>',
              pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
          },
          plotOptions: {
              series: {
                animation: false
              },
              column: {
                  stacking: 'normal',
                  dataLabels: {
                      enabled: true,
                      color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                      style: {
                          textShadow: '0 0 3px black'
                      }
                  }
              }
          },
          series: [personal, medico, duelo]
      });
    }

    function graficaAreaApilada(periodos, personal, medico, duelo) 
    {
      $('#grafica').highcharts({
          chart: {
              type: 'area'
          },
          title: {
              text: 'Grafica de areas apiladas'
          },
          subtitle: {
              text: 'Registros de solicitudes de permisos'
          },
          xAxis: {
              categories: periodos,
              tickmarkPlacement: 'on',
              title: {
                  enabled: false
              }
          },
          yAxis: {
              allowDecimals: false,
              title: {
                  text: 'Cantidad de permisos'
              },
              //labels: {}
          },
          tooltip: {
              shared: true,
              //valueSuffix: ' millions'
          },
          plotOptions: {
              series: {
                animation: false
              },
              area: {
                  stacking: 'normal',
                  lineColor: '#666666',
                  lineWidth: 1,
                  marker: {
                      lineWidth: 1,
                      lineColor: '#666666'
                  }
              }
          },
          series: [personal, medico, duelo]
      });
    }

    $.get("{{ url('/vacaciones/registros', $personal->cedula) }}", function(data) {
      graficaCircularVacaciones(data);
    });

    function graficaCircularVacaciones(data) {
      $('#graficaMesesVacaciones').highcharts({
          chart: {
              type: 'column'
          },
          title: {
              text: 'Grafica de columnas'
          },
          subtitle: {
              text: 'Numero total de solicitudes de vacaciones por mes'
          },
          xAxis: {
              type: 'category',
              labels: {
                  rotation: -45,
                  style: {
                      fontSize: '13px',
                      fontFamily: 'Verdana, sans-serif'
                  }
              }
          },
          yAxis: {
              allowDecimals: false,
              min: 0,
              title: {
                  text: 'Cantidad de vacaciones'
              }
          },
          legend: {
              enabled: false
          },
          tooltip: {
              pointFormat: '<b>{point.y}</b>'
          },
          series: [{
              name: 'Vacaciones',
              data: [
                  data['meses'][0], 
                  data['meses'][1], 
                  data['meses'][2], 
                  data['meses'][3], 
                  data['meses'][4], 
                  data['meses'][5], 
                  data['meses'][6], 
                  data['meses'][7], 
                  data['meses'][8], 
                  data['meses'][9], 
                  data['meses'][10], 
                  data['meses'][11], 
                  data['meses'][12] 
              ],
              dataLabels: {
                  enabled: true,
                  rotation: -90,
                  color: '#FFFFFF',
                  align: 'right',
                  format: '{point.y}', // one decimal
                  y: 10, // 10 pixels down from the top
                  style: {
                      fontSize: '13px',
                      fontFamily: 'Verdana, sans-serif'
                  }
              }
          }]
      });
    }
  });
</script>
@endsection