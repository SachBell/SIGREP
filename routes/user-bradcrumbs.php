<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('user.dashboard.index', function (BreadcrumbTrail $trail) {
    $trail->push(__('Inicio'), route('user.dashboard.index'));
});

Breadcrumbs::for('user.dashboard.forms.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user.dashboard.index');
    $trail->push(__('Postulaciones'), route('user.dashboard.forms.index'));
});


Breadcrumbs::for('user.dashboard.profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('user.dashboard.index');
    $trail->push(__('Perfil'), route('user.dashboard.profile.edit'));
});
