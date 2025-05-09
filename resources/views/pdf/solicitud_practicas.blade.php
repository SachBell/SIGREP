<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Prácticas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

        .content {
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <table style="width:100%; border-collapse: collapse; margin-bottom: 20px;">
        <thead>
            <tr style="border: 1px solid;">
                <!-- Logo -->
                <th style="width: 20%; text-align: center; border: 1px solid; padding: 10px;">
                    <img src="{{ public_path('img/logo.png') }}" style="width: 150px; height: auto;">
                </th>

                <!-- Título y subtítulo con línea divisoria -->
                <th style="width: 35%; text-align: center; border: 1px solid; padding: 10px 0;">
                    <div style="border-bottom: .6px solid black; padding-bottom: 10px;">
                        <span style="font-weight: normal;">SOLICITUD DE PRÁCTICAS LABORALES EN CONTEXTO REAL</span>
                    </div>
                    <div style="border-top: .6px solid black; padding-top: 10px;">
                        <span style="font-weight: normal;">Coordinación de Prácticas Laborales en Contexto Real</span>
                    </div>
                </th>

                <!-- Datos de código, fecha, versión y página -->
                <th style="width: 25%; font-size: 11px; text-align: left; border: 1px solid; padding: 10px;">
                    <p style="margin: 2px 0; font-weight: normal;"><strong>Código:</strong> ISUS-PLR-PD-001-A01</p>
                    <p style="margin: 2px 0; font-weight: normal;"><strong>Fecha:</strong>
                        {{ __(now()->isoFormat('DD' . '-' . 'MM' . '-' . 'YYYY')) }}</p>
                    <p style="margin: 2px 0; font-weight: normal;"><strong>Versión:</strong> v3.1.2</p>
                    <p style="margin: 2px 0; font-weight: normal;"><strong>Página:</strong> </p>
                </th>
            </tr>
        </thead>
    </table>

    <br>
    <br>

    <p>Quito, {{ __(now()->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}</p>

    <p>Ing. Robinson Campaña</p>
    <p><strong>REPRESENTANTE DE PRÁCTICAS LABORALES EN CONTEXTO REAL DE LA CARRERA DE DESARROLLO DE SOFTWARE</strong>
    </p>

    <br>
    <p>Presente.</p>

    <div class="content">
        <br>
        <p>
            Yo, <strong>{{ $usuario->userData->name }} {{ $usuario->userData->lastname }}</strong> con número de cédula
            <strong>{{ $usuario->userData->id_card ?? 'No Registrada' }}</strong>, estudiante de
            <strong style="text-transform: uppercase">{{ $usuario->semestre_ordinal }}</strong> semestre,
            de la carrera <strong>DESARROLLO DE SOFTWARE</strong> sección
            <strong style="text-transform: uppercase">{{ $usuario->userData->daytrip }}</strong> periodo académico
            2025-I
            me dirijo a usted muy comedidamente, para solicitarle se emita el oficio correspondiente para iniciar las
            prácticas laborales en contexto real para lo cual solicito los códigos y adjunto los siguientes datos:
        </p>
        <p>
            <strong>Nombre de la institutción:</strong>
            {{ optional($usuario->first()->institutes)->name ?? 'Sin Asignar' }}
            <br>
            <strong>Dirección:</strong>
            {{ optional($usuario->first()->institutes)->address ?? 'Sin Asignar' }}<br>
            <strong>Cargo:</strong>
            Analista de Infraestructura, Seguridad y Soporte<br>
            <strong>Email:</strong>
            {{ $usuario->userData->user->email ?? 'No registrado' }}<br>
            <strong>Teléfono:</strong>
            {{ $usuario->userData->phone_number }}<br>
            <strong>Código Oficio:</strong>
            ISUS-AAP-CDS-034-O<br>
            <strong>Código Check list:</strong>
            ISUS-ACA-CVS-CDS-PLR-2025-050
        </p>
        <br>
        <p>Esperando contar con la gentil atención a la presente, anticipo mis debidos agradecimentos.</p>
        <br>
        <p>Atentamente,</p>
    </div>

    <table style="width: 100%; margin-top: 200px;">
        <tr>
            <td style="width: 50%; text-align: center; vertical-align: top;">
                <p>____________________________</p>
                <p>{{ $usuario->userData->name }} {{ $usuario->userData->lastname }}</p>
                <p>C.I: {{ $usuario->userData->id_card ?? 'No registrada' }}</p>
            </td>
            <td style="width: 50%; text-align: center; vertical-align: top;">
                <p>____________________________</p>
                <p><strong>AUTORIZADO POR:</strong></p>
                <p>Campaña Obando Robinson Raul</p>
                <p style="padding: 0 50px">
                    <strong>
                        Representante de Prácticas Laborales en Contexto Real<br>de la Carrera de Desarrollo de Software
                    </strong>
                </p>
            </td>
        </tr>
    </table>

</body>

</html>
