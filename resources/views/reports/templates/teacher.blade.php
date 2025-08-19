<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Informe de Tutor</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 2cm;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 16px;
            margin: 0;
        }

        .header p {
            font-size: 12px;
            margin: 0;
        }

        h2 {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border: 1;
            border-collapse: collapse;
            font-size: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px 4px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            position: fixed;
            bottom: 1cm;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #555;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>INSTITUTO SUPERIOR UNIVERSITARIO SUCRE</h1>
        <p style="font-size: 13px; font-style:italic">"Informe de Seguimiento de Tutorías"</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="background-color: #486ab4; color:#fff">Tutor</th>
                <th style="background-color: #486ab4; color:#fff">Estudiante</th>
                <th style="background-color: #486ab4; color:#fff">Entidad Receptora</th>
                <th style="background-color: #486ab4; color:#fff">Modalidad</th>
                <th style="background-color: #486ab4; color:#fff">Periodo</th>
                <th style="background-color: #486ab4; color:#fff">Fecha de Visita</th>
                <th style="background-color: #486ab4; color:#fff">Observación</th>
                <th style="background-color: #486ab4; color:#fff">Estado de Visita</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->tutor as $student)
                @foreach ($student->visits as $visit)
                    <tr>
                        <td>{{ $data->name . ' ' . $data->lastnames }}</td>
                        <td>{{ $student->userData->name . ' ' . $student->userData->lastnames }}</td>
                        <td>{{ $student->userData->userData->applicationDetail->receivingEntities->name ?? '' }}</td>
                        <td>{{ ucfirst($student->userData->userData->careers->is_dual ? 'Dual' : 'Convencional') }}</td>
                        <td>{{ $student->userData->userData->applicationDetail->applicationCalls->name }}</td>
                        <td>{{ $visit->date }}</td>
                        <td>{{ $visit->observation ?? 'Sin observación' }}</td>
                        <td>{{ $visit->is_complete ? 'Completada' : 'Pendiente' }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Informe generado automáticamente por el sistema {{ config('app.name') }} | {{ date('Y') }}
    </div>

</body>

</html>
