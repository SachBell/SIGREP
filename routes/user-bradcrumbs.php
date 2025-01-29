<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('user.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push(__('Inicio'), route('user.dashboard'));
});

Breadcrumbs::for('user.form-register.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user.dashboard');
    $trail->push(__('Postulaciones'), route('user.form-register.index'));
});


Breadcrumbs::for('user.profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('user.dashboard');
    $trail->push(__('Perfil'), route('user.profile.edit'));
});
