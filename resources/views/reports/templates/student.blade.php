<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Informe de Estudiante</title>
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
            padding: 5px;
        }

        th {
            background-color: #ddd;
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
                <th style="background-color: #486ab4; color:#fff">Estudiante</th>
                <th style="background-color: #486ab4; color:#fff">Cédula</th>
                <th style="background-color: #486ab4; color:#fff">Carrera</th>
                <th style="background-color: #486ab4; color:#fff">Modalidad</th>
                <th style="background-color: #486ab4; color:#fff">Entidad</th>
                <th style="background-color: #486ab4; color:#fff">Fecha Visita</th>
                <th style="background-color: #486ab4; color:#fff">Observación</th>
                <th style="background-color: #486ab4; color:#fff">Tutor Visitante</th>
                <th style="background-color: #486ab4; color:#fff">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->profiles->tutorStudents as $tutorStudent)
                @foreach ($tutorStudent->visits as $visit)
                    <tr>
                        <td>{{ $data->profiles->name . ' ' . $data->profiles->lastnames ?? 'N/A' }}</td>
                        <td>{{ $data->profiles->id_card ?? 'N/A' }}</td>
                        <td>{{ $data->profiles->userData->careers->name ?? 'N/A' }}</td>
                        <td>{{ ucfirst($data->profiles->userData->careers->is_dual ? 'Dual' : 'Convencional') }}</td>
                        <td>{{ $data->profiles->userData->applicationDetail->receivingEntities->name ?? 'N/A' }}</td>
                        <td>{{ $visit->date ?? 'N/A' }}</td>
                        <td>{{ $visit->observation ?? 'Sin observación' }}</td>
                        <td>{{ $tutorStudent->profiles->name . ' ' . $tutorStudent->profiles->lastnames ?? 'N/A' }}</td>
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
