<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('dashboard.index', function (BreadcrumbTrail $trail) {
    $trail->push(__('Inicio'), route('dashboard.index'));
});

Breadcrumbs::for('applications.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push(__('Convocatorias'), route('applications.index'));
});

Breadcrumbs::for('progres.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push(__('Mi Progreso'), route('progres.index'));
});
