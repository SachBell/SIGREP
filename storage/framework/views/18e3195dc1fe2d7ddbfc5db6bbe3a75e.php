<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['url', 'color' => 'primary', 'align' => 'center']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['url', 'color' => 'primary', 'align' => 'center']); ?>
<?php foreach (array_filter((['url', 'color' => 'primary', 'align' => 'center']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title><?php echo e(config('app.name')); ?></title>
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
                                <a href="<?php echo e($url); ?>" target="_blank" rel="noopener noreferrer">
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
                                            <?php echo e(__('Estimado/a, ')); ?> <?php echo e($user); ?>

                                        </h1>

                                        <p>
                                            <?php echo \Illuminate\Mail\Markdown::parse($content); ?>

                                        </p>

                                        <table class="action" align="<?php echo e($align); ?>" width="100%" cellpadding="0"
                                            cellspacing="0" role="presentation">
                                            <tr>
                                                <td align="<?php echo e($align); ?>">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                        role="presentation">
                                                        <tr>
                                                            <td align="<?php echo e($align); ?>">
                                                                <table border="0" cellpadding="0" cellspacing="0"
                                                                    role="presentation">
                                                                    <tr>
                                                                        <td>
                                                                            <a href="<?php echo e($url); ?>"
                                                                                class="button button-<?php echo e($color); ?>"
                                                                                target="_blank"
                                                                                rel="noopener"><?php echo e($action); ?></a>
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
                                                        "<?php echo e($action); ?>", copie y pegue la siguiente URL en su
                                                        navegador web:
                                                        <?php echo e($url); ?>

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
                            &copy; <?php echo e(date('Y')); ?> Instituto Superior Universitario Sucre - Todos los derechos
                            reservados
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
<?php /**PATH C:\laragon\www\practicasisus\resources\views/mails/calls.blade.php ENDPATH**/ ?>