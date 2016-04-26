<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo csrf_token() ?>" />
        <title>Cuartel Militar 323-Batallon Camacaro.</title>
        
        {!! Html::style('libs/bootstrap/css/bootstrap.min.css') !!}
        {!! Html::style('libs/bootstrap/css/bootstrap-theme.min.css') !!}

        {!! Html::style('libs/DataTables/media/css/dataTables.bootstrap.min.css') !!}
        {!! Html::style('libs/formvalidation/css/formValidation.min.css') !!}
        {!! Html::style('libs/font-awesome/css/font-awesome.min.css') !!}
    
        <style type="text/css">
            body{background-color: #FCFCFC;}
            div.dataTables_wrapper{margin:0 auto;}
            form .form-group { margin-bottom: 5px; }
            .page-header{margin-top:-15px;}
            .tab-content .tab-pane { margin-top: 20px; }

            #formulario .form-control-feedback { right: 15px; }
            #formulario .selectContainer .form-control-feedback { right: 25px; }
            .yaRegistrado { display: none; font-size: 13px; }
            #div_otra_profesion_input { display: none; }

            .row.vdivide [class*='col-']:not(:last-child):after {
              background: #e0e0e0;
              width: 1px;
              content: "";
              display:block;
              position: absolute;
              top:0;
              bottom: 0;
              right: 0;
              min-height: 50px;
            }

            .bs-callout {
                padding: 20px;
                margin: 20px 0;
                border: 1px solid #eee;
                border-left-width: 5px;
                border-radius: 3px;
            }
            .bs-callout h4 {
                margin-top: 0;
                margin-bottom: 5px;
            }
            .bs-callout p:last-child {
                margin-bottom: 0;
            }
            .bs-callout code {
                border-radius: 3px;
            }
            .bs-callout+.bs-callout {
                margin-top: -5px;
            }
            .bs-callout-default {
                border-left-color: #777;
            }
            .bs-callout-default h5 {
                color: #777;
            }
            .bs-callout-primary {
                border-left-color: #428bca;
            }
            .bs-callout-primary h5 {
                color: #777;
            }
            .bs-callout-success {
                border-left-color: #5cb85c;
            }
            .bs-callout-success h4 {
                color: #5cb85c;
            }
            .bs-callout-danger {
                border-left-color: #d9534f;
            }
            .bs-callout-danger h4 {
                color: #d9534f;
            }
            .bs-callout-warning {
                border-left-color: #f0ad4e;
            }
            .bs-callout-warning h4 {
                color: #f0ad4e;
            }
            .bs-callout-info {
                border-left-color: #5bc0de;
            }
            .bs-callout-info h4 {
                color: #5bc0de;
            }
        </style>
    </head>
    <body>
        <div class="container">
            {!! Html::image('img/banner.jpg', 'FANB', array('width' => '100%' , 'class' => 'img-thumbnail')) !!}
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Inicio</a></li>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-bars" aria-hidden="true"></span> Administrar <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-header">Personal Civil</li>
                                    <li><a href="{{ url('/administrativos') }}"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> Administrativos</a></li>
                                    <li><a href="{{ route('medicos.index') }}"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Medicos</a></li>
                                    <li><a href="{{ route('obreros.index') }}"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Obreros</a></li>
                                    <li class="dropdown-header">Personal Militar</li>
                                    <li><a href="{{ route('profesionales.index') }}"><span class="glyphicon glyphicon-certificate" aria-hidden="true"></span> Profesionales</a></li>
                                    <li><a href="{{ route('noprofesionales.index') }}"><span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span> No Profesionales</a></li>
                                    <li class="dropdown-header">Otros</li>
                                    <li><a href="{{ url('/areas') }}"><span class="glyphicon glyphicon-tag" aria-hidden="true"></span> Areas</a></li>
                                    <li><a href="{{ url('/cargos') }}"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Cargos</a></li>
                                    <li><a href="{{ url('/dependencias') }}"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Dependencias</a></li>
                                    <li><a href="{{ url('/consultorios') }}"><span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span> Consultorios</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/asistencias') }}"><span class="" aria-hidden="true"></span> Asistencias</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>{{{ Auth::user()->name }}} <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/logout') }}"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Salir</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
                
            @yield('contenido')

            <br/><hr>
              
            <footer>
                <p>Copyright © Cuartel <strong>Antonio Jose de Sucre</strong> | <a href="">Politicas de privacidad</a> | <a href="">Terminos de uso</a></p>
            </footer>
        </div>
        
    {!! Html::script('libs/jquery.min.js') !!}
    {!! Html::script('libs/bootstrap/js/bootstrap.min.js') !!}
    
    {!! Html::script('libs/DataTables/media/js/jquery.dataTables.min.js') !!}
    {!! Html::script('libs/DataTables/media/js/dataTables.bootstrap.min.js') !!}

    {!! Html::script('libs/formvalidation/js/formValidation.min.js') !!}
    {!! Html::script('libs/formvalidation/js/framework/bootstrap.min.js') !!}

    {!! Html::script('libs/highcharts.js') !!}

    {!! Html::script('js/validaciones.js') !!}

    @yield('graficas')
  
    <script>
        $(document).ready(function() {
            // renderizar tablas
            $('#tablaAreas').DataTable({
                "language" : {
                    "url" : "{{ url('libs/DataTables/media/js/language/Spanish.json') }}"
                },
                //"scrollY" : 340,
                "scrollX": true,
                "columnDefs": [
                    { "width": "7%", "targets": 0 },
                ]
            });

            $('#tablaCargos').DataTable({
                "language" : {
                    "url" : "{{ url('libs/DataTables/media/js/language/Spanish.json') }}"
                },
                //"scrollY" : 340,
                "scrollX": true,
                "columnDefs": [
                    { "width": "7%", "targets": 0 },
                ]
            });

            $('#tablaDependencias').DataTable({
                "language" : {
                    "url" : "{{ url('libs/DataTables/media/js/language/Spanish.json') }}"
                },
                "columnDefs": [
                    { "width": "7%", "targets": 0 },
                ]
            });

            $('#tablaConsultorios').DataTable({
                "language" : {
                    "url" : "{{ url('libs/DataTables/media/js/language/Spanish.json') }}"
                },
                //"scrollY" : 340,
                "scrollX": true,
                "columnDefs": [
                    { "width": "7%", "targets": 0 },
                ]
            });

            $('#tablaAdministrativos').DataTable({
                "language" : {
                    "url" : "{{ url('libs/DataTables/media/js/language/Spanish.json') }}"
                },
                // "scrollY" : 340,
                "scrollX": true,
                "columnDefs": [
                    { "width": "9%", "targets": 0 },
                    { "width": "4%", "targets": 3 },
                    { "width": "12%", "targets": 4 },
                    { "width": "5%", "targets": 5 }
                ]
            });

            $('#historial_vacaciones').DataTable({
              "language" : {
                "url" : "{{ url('libs/DataTables/media/js/language/Spanish.json') }}"
              },
              "columnDefs": [
                { "orderable": false, "targets": 1 },
                { "orderable": false, "targets": 2 },
                { "orderable": false, "targets": 3 },
                { "orderable": false, "targets": 4 }
              ]
            });

            $('#historial_permisos').DataTable({
              "language" : {
                "url" : "{{ url('libs/DataTables/media/js/language/Spanish.json') }}"
              },
              "columnDefs": [
                { "orderable": false, "targets": 2 },
                { "orderable": false, "targets": 3 },
                { "orderable": false, "targets": 4 }
              ]
            });


            // tabla de permisos pendientes
            $('#permisosPendientes').DataTable({
              "language" : {
                "url" : "{{ url('libs/DataTables/media/js/language/Spanish.json') }}"
              }
            });

            $('#vacacionesPendientes').DataTable({
              "language" : {
                "url" : "{{ url('libs/DataTables/media/js/language/Spanish.json') }}"
              }
            });


            // validar datos de los formularios
            $('#formularioArea').formValidation({
              framework: 'bootstrap',
              icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                nombre: {
                  validators: {
                    notEmpty: {
                      message: 'Especifique el nombre del area.'
                    }
                  }
                }
              }
            });

            $('#formularioCargo').formValidation({
              framework: 'bootstrap',
              icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                tipo: {
                  validators: {
                    notEmpty: {
                      message: 'Falto el tipo de cargo'
                    }
                  }
                },
                descripcion: {
                  validators: {
                    notEmpty: {
                      message: 'Falto la descripcion del cargo'
                    }
                  }
                }
              }
            });

            $('#formularioDependencia').formValidation({
              framework: 'bootstrap',
              icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                nombre: {
                  validators: {
                    notEmpty: {
                      message: 'Falto el nombre de la Dependencia'
                    }
                  }
                },
                actividad: {
                  validators: {
                    notEmpty: {
                      message: 'Falto la acividad de la Dependencia'
                    }
                  }
                }
              }
            });

            $('#formularioConsultorio').formValidation({
              framework: 'bootstrap',
              icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                nombre: {
                  validators: {
                    notEmpty: {
                      message: 'Falto el nombre del consultorio'
                    }
                  }
                }
              }
            });

            $('#formulario').formValidation({
              framework: 'bootstrap',
              icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                cedula: {
                  validators: {
                    integer: {
                      message: 'Numero de cedula no valido'
                    },
                    stringLength: {
                      min: 7,
                      max: 8,
                      message: 'La cedula debe tener entre 7 y 8 numeros'
                    },
                    notEmpty: {
                      message: 'Falto la cedula'
                    }
                  }
                },
                nombre: {
                  validators: {
                    regexp: {
                      regexp: /^[a-zA-Z\s]+$/i,
                      message: 'Nombre no valido. Solo se esperan caracteres.'
                    },
                    stringLength: {
                      min: 3,
                      max: 30,
                      message: 'El nombre debe tener entre 3 y 30 caracteres'
                    },
                    notEmpty: {
                      message: 'Falto el nombre'
                    }
                  }
                },
                apellido: {
                  validators: {
                    regexp: {
                      regexp: /^[a-zA-Z\s]+$/i,
                      message: 'Apellido no valido. Solo se esperan caracteres.'
                    },
                    stringLength: {
                      min: 3,
                      max: 30,
                      message: 'El apellido debe tener entre 3 y 30 caracteres'
                    },
                    notEmpty: {
                      message: 'Falto el apellido'
                    }
                  }
                },
                fnacimiento: {
                  validators: {
                    notEmpty: {
                      message: 'Falto la fecha de nacimiento'
                    }
                  }
                },
                sexo: {
                  validators: {
                    notEmpty: {
                      message: 'Seleccione el sexo'
                    }
                  }
                },
                direccion: {
                  validators: {
                    notEmpty: {
                      message: 'Especifique la direccion'
                    }
                  }
                },
                telefono: {
                  validators: {
                    regexp: {
                      regexp: /^[0-9-\s]+$/i,
                      message: 'Formato correcto del numero telefonico, 0414-8370493'
                    },
                    notEmpty: {
                      message: 'Falto el numero de telefono'
                    }
                  }
                },
                fingreso: {
                  validators: {
                    notEmpty: {
                      message: 'Falto fecha de ingreso'
                    }
                  }
                },
                ecivil: {
                  validators: {
                    notEmpty: {
                      message: 'Seleccione el estado civil'
                    }
                  }
                },
                nhijos: {
                  validators: {
                    integer: {
                      message: 'Debe ser un valor entero numerico'
                    },
                    notEmpty: {
                      message: 'Falto el numero de hijos'
                    }
                  }
                },
                tobrero: {
                  validators: {
                    notEmpty: {
                      message: 'Falto el tipo de obrero'
                    }
                  }
                },
                ginstruccion : {
                  validators: {
                    notEmpty: {
                      message: 'Seleccione el grado de instruccion'
                    }
                  }
                },
                matricula: {
                  validators: {
                    notEmpty: {
                      message: 'Falto la matricula'
                    }
                  }
                },
                especialidad: {
                  validators: {
                    notEmpty: {
                      message: 'Seleccione la especialidad'
                    }
                  }
                },
                profesion: {
                  validators: {
                    notEmpty: {
                      message: 'Seleccione la profesion'
                    }
                  }
                },
                iproveniente: {
                  validators: {
                    notEmpty: {
                      message: 'Especifique la institucion proveniente'
                    }
                  }
                },
                jerarquia: {
                  validators: {
                    notEmpty: {
                      message: 'Seleccione la jerarquia'
                    }
                  }
                },
                fuascenso: {
                  validators: {
                    notEmpty: {
                      message: 'Falto la fecha del ultimo ascenso'
                    }
                  }
                },
                dtallas: {
                  validators: {
                    notEmpty: {
                      message: 'Falto especificar las tallas de los uniformes'
                    }
                  }
                },
                tmilitar: {
                  validators: {
                    notEmpty: {
                      message: 'Falto especificar el tipo de militar'
                    }
                  }
                },
                ncuenta: {
                  validators: {
                    notEmpty: {
                      message: 'Falto especificar el numero de cuenta'
                    }
                  }
                },
                contingente: {
                  validators: {
                    notEmpty: {
                      message: 'Falto especificar el contingente'
                    }
                  }
                },
                situacion: {
                  validators: {
                    notEmpty: {
                      message: 'Falto especificar la situacion'
                    }
                  }
                },
                nasignado: {
                  validators: {
                    integer: {
                      message: 'Debe ser un valor entero numerico'
                    },
                    notEmpty: {
                      message: 'Falto el numero asignado al militar'
                    }
                  }
                },
                area: {
                  validators: {
                    notEmpty: {
                      message: 'Seleccione el area'
                    }
                  }
                },
                cargo: {
                  validators: {
                    notEmpty: {
                      message: 'Seleccione el cargo'
                    }
                  }
                },
                dependencia: {
                  validators: {
                    notEmpty: {
                      message: 'Seleccione la dependencia'
                    }
                  }
                },
                consultorio: {
                  validators: {
                    notEmpty: {
                      message: 'Seleccione el consultorio'
                    }
                  }
                },
              }
            });

            $('#cedula').keydown(function(e) {
              $('.yaRegistrado').css('display', 'none');

              if($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                  return; }
              if((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
              }
            });

            $('#cedula').keypress(function (e) {
              if (event.which == 13) {
                $('.text-danger').hide();

                if ($("#cedula").val().length > 6 && $("#cedula").val().length < 9) {
                  e.preventDefault();

                  $.ajax({
                    headers: {
                      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('/administrativo/validarSiYaRegistrado') }}" + "/" + $('#cedula').val(),
                    type: 'GET',
                    dataType: 'json',
                  })
                  .done(
                  function(data) {
                    if(data.existe) {
                      $('#verificarcedula').select();
                      $('.yaRegistrado').css('display', 'block');
                    } 
                    else {
                      $('input, select, textarea, :submit').prop('disabled', false);
                      $('#cedula').prop('readonly', true);
                      $('#nombre').focus();
                    }
                  });
                }
                else {
                  return false;
                }
              }
            });

            $('#profesion').change(function() {
              var valor = $("#profesion option:selected").val();

              $('#div_profesion').hide();
              $('#div_otra_profesion_input').css('display', 'block');
              $('#div_otra_profesion_input').addClass('col-lg-4');

              $('#otra_profesion').tooltip({
                  placement: "bottom",
                  trigger: "focus"
              });
              
              $('#otra_profesion').focus();
            });

            $("#enviarSolicitudVacaciones").submit(function(e){
              var enviar = true;
              var fecha_salida = $("#fecha_salida").val();
              var fecha_ingreso = $("#fecha_ingreso").val();

              var d = new Date();
              var month = d.getMonth()+1;
              var day = d.getDate();

              var actual = d.getFullYear() + '/' + ((''+month).length<2 ? '0' : '') + month + '/' + ((''+day).length<2 ? '0' : '') + day;

              $('.text-danger').hide();

              if(new Date(fecha_salida) < new Date(actual)) {
                $("#fecha_salida").after('<span class="text-danger">La fecha de salida debe ser mayor a la fecha actual</span>');
                enviar = false;
              } else if(fecha_salida == "") {
                $("#fecha_salida").after('<span class="text-danger">Especifique la fecha de salida</span>');
                enviar = false;
              } else {
                $('#fecha_salida span').hide();
              }

              if(new Date(fecha_ingreso) <= new Date(fecha_salida)) {
                $("#fecha_ingreso").after('<span class="text-danger">La fecha de ingreso debe ser mayor a la fecha de salida</span>');
                enviar = false;
              } else if(fecha_ingreso == "") {
                $("#fecha_ingreso").after('<span class="text-danger">Especifique la fecha de ingreso</span>');
                enviar = false;
              } else {
                $('#fecha_ingreso span').hide();
              }

              if (!enviar) {
                return false;
              }
            });

            $("#enviarSolicitudPermiso").submit(function(e){
              var enviar = true;
              var permiso_tipo = $('#permiso_tipo').val();
              var permiso_fecha_salida = $('#permiso_fecha_salida').val();
              var permiso_fecha_ingreso = $('#permiso_fecha_ingreso').val();
              var permiso_descripcion = $('#permiso_descripcion').val();

              $('.text-danger').hide();

              var d = new Date();
              var month = d.getMonth()+1;
              var day = d.getDate();

              var actual = d.getFullYear() + '/' + ((''+month).length<2 ? '0' : '') + month + '/' + ((''+day).length<2 ? '0' : '') + day;

              if(permiso_tipo.trim() === '') {
                $("#permiso_tipo").after('<span class="text-danger">Especifique el tipo de permiso</span>');
                enviar = false;
              } else {
                $('#permiso_tipo span').hide();
              }

              if(new Date(permiso_fecha_salida) < new Date(actual)) {
                $("#permiso_fecha_salida").after('<span class="text-danger">La fecha de salida debe ser mayor a la fecha actual</span>');
                enviar = false;
              } else if(permiso_fecha_salida == "") {
                $("#permiso_fecha_salida").after('<span class="text-danger">Especifique la fecha de salida</span>');
                enviar = false;
              } else {
                $('#permiso_fecha_salida span').hide();
              }

              if(new Date(permiso_fecha_ingreso) < new Date(permiso_fecha_salida)) {
                $("#permiso_fecha_salida").after('<span class="text-danger">La fecha de ingreso debe ser mayor a la fecha de salida</span>');
                enviar = false;
              } else if(permiso_fecha_ingreso == "") {
                $("#permiso_fecha_ingreso").after('<span class="text-danger">Especifique la fecha de ingreso</span>');
                enviar = false;
              } else {
                $('#permiso_fecha_ingreso span').hide();
              }

              if(permiso_descripcion == '') {
                $("#permiso_descripcion").after('<span class="text-danger">Haga una descripcion del permiso</span>');
                enviar = false;
              } else {
                $('#permiso_descripcion span').hide();
              }

              var restaFechas = new Date(new Date(permiso_fecha_ingreso) - new Date(permiso_fecha_salida));
              var diferenciaDias = restaFechas / 1000 / 60 / 60 / 24;

              if(permiso_tipo == 1) {
                if(diferenciaDias > 3) {
                  $("#permiso_fecha_ingreso").after('<span class="text-danger">Los permisos personales deben ser maximo tres (3) dias.</span>');
                  enviar = false;
                } else {
                  $('#permiso_fecha_ingreso span').hide();
                }
              } else if(permiso_tipo == 3) {
                if(diferenciaDias > 15) {
                  $("#permiso_fecha_ingreso").after('<span class="text-danger">Los permisos por duelo deben ser maximo quince (15) dias.</span>');
                  enviar = false;
                } else {
                  $('#permiso_fecha_ingreso span').hide();
                }
              }

              if (!enviar) {
                return false;
              }
            });

            $('html, body').animate({
                scrollTop: ($('.page-header').first().offset().top)
            },500);

            window.setTimeout(function() {
                $("#mensajeBaseDatos").fadeTo(1500, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 5000);
        });
    </script>
  </body>
</html>