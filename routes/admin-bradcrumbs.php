<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push(__('Inicio'), route('admin.dashboard'));
});

Breadcrumbs::for('app-calls.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Convocatorias'));
    $trail->push(__('Listado'), route('app-calls.index'));
});

Breadcrumbs::for('student-posts.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Convocatorias'));
    $trail->push(__('Postulaciones'), route('student-posts.index'));
});

Breadcrumbs::for('convenants.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Convenios'));
    $trail->push(__('Listado'), route('convenants.index'));
});

Breadcrumbs::for('manage-users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Usuarios'));
    $trail->push(__('Administrador de Usuarios'), route('manage-users.index'));
});

Breadcrumbs::for('careers.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Gestor de Carreras'), route('careers.index'));
});

Breadcrumbs::for('settings.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Settings'), route('settings.index'));
});
