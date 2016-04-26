<?php

function devolverGenero() 
{
    if(array_rand(array('m', 'f')) == 0) { return 'MASCULINO'; } 
    else { return 'FEMENINO'; }
}
function devolverEstadoCivil() 
{
    if(array_rand(array('Soltero', 'Casado')) == 0) { return 'SOLTERO'; }
    else { return 'CASADO'; }
}
function devolverGradoInstruccion() 
{
    $grado_instr = array_rand(array('no_instr', 'basica', 'bachiller', 'tecnico', 'universitario'));

    if($grado_instr == 0) { return 'SIN INSTRUCCION'; }
    else if($grado_instr == 1) { return 'BASICA'; }
    else if($grado_instr == 2) { return 'BACHILLER'; }
    else if($grado_instr == 3) { return 'TECNICO MEDIO'; }
    else if($grado_instr == 4) { return 'UNIVERSITARIO'; }
}

$factory->define(App\Area::class, function (Faker\Generator $faker) {
    return [
        'nombre' => strtoupper($faker->sentence($nbWords = 3, $variableNbWords = true)),
    ];
});

$factory->define(App\Cargo::class, function (Faker\Generator $faker) {
    return [
        'tipo' => strtoupper($faker->sentence($nbWords = 3, $variableNbWords = true)),
        'descripcion' => strtoupper($faker->text($maxNbChars = 80)),
    ];
});

$factory->define(App\Dependencia::class, function (Faker\Generator $faker) {
    return [
        'nombre' => strtoupper($faker->sentence($nbWords = 2, $variableNbWords = true)),
        'actividad' => strtoupper($faker->text($maxNbChars = 50)),
    ];
});

$factory->define(App\Consultorio::class, function (Faker\Generator $faker) {
    return [
        'nombre' => strtoupper($faker->sentence($nbWords = 3, $variableNbWords = true)),
    ];
});

$factory->define(App\Personal::class, function (Faker\Generator $faker) {
    return [
        'cedula'      => $faker->numberBetween($min = 10000000, $max = 25000000),
        'nombre'      => strtoupper($faker->firstName($gender = null | 'male' | 'female')),
        'apellido'    => strtoupper($faker->lastName),
        'fnacimiento' => $faker->date($format = 'Y-m-d', $max = '1996-01-01'),
        'sexo'        => devolverGenero(),
        'direccion'   => strtoupper($faker->address),
        'telefono'    => $faker->phoneNumber,
        'fingreso'    => $faker->date($format = 'Y-m-d', $max = 'now'),
        'ecivil'      => devolverEstadoCivil(),
        'nhijos'      => mt_rand(0, 3),
        //'tpersonal'   => 'PERSONAL OBRERO',
        //'tpersonal'   => 'PERSONAL MEDICO',
        //'tpersonal'   => 'PERSONAL ADMINISTRATIVO',
        'tpersonal'   => 'PERSONAL MILITAR',
    ];
});

$factory->define(App\Obrero::class, function (Faker\Generator $faker) {
    $personal_obrero = DB::table('personal')->where('tpersonal', '=', 'PERSONAL OBRERO')->pluck('cedula');

    return [
        'cpersonal'    => $faker->unique()->randomElement($personal_obrero),
        'ginstruccion' => devolverGradoInstruccion(),
        'tobrero'      => $faker->randomElement(['CALIFICADO', 'NO CALIFICADO']),
        'area'         => mt_rand(1, 10),
    ];
});

$factory->define(App\Medico::class, function (Faker\Generator $faker) {
    $personal_medico        = DB::table('personal')->where('tpersonal', '=', 'PERSONAL MEDICO')->pluck('cedula');
    $especialidades_medicas = DB::table('especialidades_medicas')->pluck('codigo'); 

    return [
        'cpersonal'    => $faker->unique()->randomElement($personal_medico),
        'matricula'    => $faker->swiftBicNumber,
        'especialidad' => $faker->randomElement($especialidades_medicas),
        'consultorio'  => 1,
    ];
});

$factory->define(App\Administrativo::class, function (Faker\Generator $faker) {
    $personal_administrativo = DB::table('personal')->where('tpersonal', '=', 'PERSONAL ADMINISTRATIVO')->pluck('cedula');
    $profesiones    = DB::table('profesiones')->pluck('codigo');

    return [
        'cpersonal'   => $faker->unique()->randomElement($personal_administrativo),
        'profesion'   => $faker->randomElement($profesiones),
        'cargo'       => mt_rand(1, 15),
        'dependencia' => mt_rand(1, 5),
    ];
});

$factory->define(App\Profesional::class, function (Faker\Generator $faker) {
    $personal_militar = DB::table('personal')->where('tpersonal', '=', 'PERSONAL MILITAR')->pluck('cedula');
    $jerarquias       = DB::table('jerarquias')->pluck('codigo');
    $especialidades   = DB::table('especialidades')->pluck('codigo');

    return [
        'cpersonal'    => $faker->unique()->randomElement($personal_militar),
        'tmilitar'     => strtoupper('profesional'),
        'jerarquia'    => $faker->randomElement($jerarquias),
        'matricula'    => $faker->swiftBicNumber,
        'especialidad' => $faker->randomElement($especialidades),
        'dtallas'      => strtoupper($faker->text($maxNbChars = 50)),
        'iproveniente' => strtoupper($faker->country),
        'fuascenso'    => $faker->date($format = 'Y-m-d', $max = 'now'),
        'cargo'        => mt_rand(1, 15),
        'dependencia'  => mt_rand(1, 5),
    ];
});

$factory->define(App\NoProfesional::class, function (Faker\Generator $faker) {
    $personal_militar = DB::table('personal')->where('tpersonal', '=', 'PERSONAL MILITAR')->pluck('cedula');
    $jerarquias       = DB::table('jerarquias')->pluck('codigo');

    return [
        'cpersonal'   => $faker->unique()->randomElement($personal_militar),
        'tmilitar'    => strtoupper('no profesional'),
        'jerarquia'   => $faker->randomElement($jerarquias),
        'ncuenta'     => strtoupper($faker->creditCardNumber),
        'contingente' => strtoupper($faker->word),
        'situacion'   => strtoupper($faker->text($maxNbChars = 30)),
        'dtallas'     => strtoupper($faker->sentence($nbWords = 3, $variableNbWords = true)),
        'nasignado'   => $faker->randomDigit,
    ];
});
