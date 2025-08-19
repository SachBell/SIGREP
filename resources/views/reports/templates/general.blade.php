<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Informe General de Prácticas</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            margin: 30px;
        }

        header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        header h1 {
            margin: 0;
            font-size: 16px;
            text-transform: uppercase;
        }

        header h2 {
            margin: 0;
            font-size: 14px;
            font-weight: normal;
        }

        /* Opcional: logo institucional a la izquierda */
        /* header img {
            float: left;
            width: 70px;
            height: auto;
        } */

        table {
            width: 100%;
            border: 1px;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
            font-size: 10px;
            padding: 6px;
            border: 1px solid #000;
        }

        td {
            font-size: 10px;
            padding: 5px;
            border: 1px solid #000;
            text-align: center;
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

    <header>
        <!-- <img src="ruta/logo.png" alt="Logo Instituto"> -->
        <h1>Instituto Superior Universitario Sucre</h1>
        <p style="font-size: 13px; font-style:italic">"Informe General de Prácticas Preprofesionales"</p>
    </header>

    <table>
        <thead>
            <tr>
                <th style="background-color: #486ab4; color:#fff">Nombre</th>
                <th style="background-color: #486ab4; color:#fff">Cédula</th>
                <th style="background-color: #486ab4; color:#fff">Carrera</th>
                <th style="background-color: #486ab4; color:#fff">Modalidad</th>
                <th style="background-color: #486ab4; color:#fff">Entidad</th>
                <th style="background-color: #486ab4; color:#fff">Periodo</th>
                <th style="background-color: #486ab4; color:#fff">Estado</th>
                <th style="background-color: #486ab4; color:#fff">Tutor</th>
                <th style="background-color: #486ab4; color:#fff">Reporte Final</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->userData->profiles->name . ' ' . $item->userData->profiles->lastnames }}</td>
                    <td>{{ $item->userData->profiles->id_card }}</td>
                    <td>{{ $item->userData->careers->name }}</td>
                    <td>{{ ucfirst($item->userData->careers->is_dual ? 'Dual' : 'Convencional') }}</td>
                    <td>{{ $item->receivingEntities->name }}</td>
                    <td>{{ $item->applicationCalls->name }}</td>
                    <td>{{ $item->status_individual }}</td>
                    <td>
                        {{ $item->tutorStudent && $item->tutorStudent->profiles
                            ? $item->tutorStudent->profiles->name . ' ' . $item->tutorStudent->profiles->lastnames
                            : 'No hay docente asignado' }}
                    </td>
                    <td>{{ $item->tutorStudent->finalGrade->observations ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Informe generado automáticamente por el sistema {{ config('app.name') }} | {{ date('Y') }}
    </div>

</body>

</html>
