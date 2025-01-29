<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push(__('Inicio'), route('admin.dashboard'));
});

Breadcrumbs::for('admin.application-calls.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Postulaciones'), route('admin.application-calls.index'));
});

Breadcrumbs::for('admin.registros.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Registros'), route('admin.registros.index'));
});

Breadcrumbs::for('admin.institutes.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Institutos'), route('admin.institutes.index'));
});

Breadcrumbs::for('admin.user-manager.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Usuarios'), route('admin.user-manager.index'));
});

Breadcrumbs::for('admin.profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Perfil'), route('admin.profile.edit'));
});
