@props(['url', 'color' => 'primary', 'align' => 'center'])
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>{{ config('app.name') }}</title>
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td class="header">
                            <h1 style="text-align: center !important">
                                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer">
                                    ISUS SGPP
                                </a>
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0"
                            style="border: hidden !important;">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0"
                                role="presentation">
                                <tr>
                                    <td class="content-cell">
                                        <h1>
                                            {{ __('Estimado/a, ') }} {{ $user }}
                                        </h1>

                                        <p>
                                            {!! \Illuminate\Mail\Markdown::parse($content) !!}
                                        </p>

                                        <table class="action" align="{{ $align }}" width="100%" cellpadding="0"
                                            cellspacing="0" role="presentation">
                                            <tr>
                                                <td align="{{ $align }}">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                        role="presentation">
                                                        <tr>
                                                            <td align="{{ $align }}">
                                                                <table border="0" cellpadding="0" cellspacing="0"
                                                                    role="presentation">
                                                                    <tr>
                                                                        <td>
                                                                            <a href="{{ $url }}"
                                                                                class="button button-{{ $color }}"
                                                                                target="_blank"
                                                                                rel="noopener">{{ $action }}</a>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>

                                        <table class="action" width="100%" cellpadding="0" cellspacing="0"
                                            role="presentation">
                                            <tr>
                                                <td>
                                                    <p>
                                                        Agradecemos tu atención.<br><br>
                                                        Saludos cordiales,<br>
                                                        <strong>Coordinación de Prácticas Preprofesionales</strong><br>
                                                        Instituto Superior Universitario Sucre
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>


                                        <table class="subcopy" width="100%" cellpadding="0" cellspacing="0"
                                            role="presentation">
                                            <tr>
                                                <td>
                                                    <p>
                                                        Si tiene problemas para hacer clic en el botón
                                                        "{{ $action }}", copie y pegue la siguiente URL en su
                                                        navegador web:
                                                        {{ $url }}
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td class="content-cell" align="center">
                            &copy; {{ date('Y') }} Instituto Superior Universitario Sucre - Todos los derechos
                            reservados
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
