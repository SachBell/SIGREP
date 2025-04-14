<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.dashboard.', function (BreadcrumbTrail $trail) {
    $trail->push(__('Inicio'), route('admin.dashboard.'));
});

Breadcrumbs::for('admin.dashboard.applications.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.');
    $trail->push(__('Postulaciones'), route('admin.dashboard.applications.index'));
});

Breadcrumbs::for('admin.dashboard.registers.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.');
    $trail->push(__('Registros'), route('admin.dashboard.registers.index'));
});

Breadcrumbs::for('admin.dashboard.institutes.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.');
    $trail->push(__('Institutos'), route('admin.dashboard.institutes.index'));
});

Breadcrumbs::for('admin.dashboard.user-manager.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.');
    $trail->push(__('Usuarios'), route('admin.dashboard.user-manager.index'));
});

Breadcrumbs::for('admin.dashboard.profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.');
    $trail->push(__('Perfil'), route('admin.dashboard.profile.edit'));
});

Breadcrumbs::for('admin.dashboard.user-manager.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.user-manager.index');
    $trail->push(__('Editar Usuario'), route('admin.dashboard.user-manager.index'));
});

Breadcrumbs::for('admin.dashboard.user-manager.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.user-manager.index');
    $trail->push(__('Nuevo Usuario'), route('admin.dashboard.user-manager.index'));
});

Breadcrumbs::for('admin.dashboard.rolespermissions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.user-manager.index');
    $trail->push(__('Roles y Permisos'), route('admin.dashboard.rolespermissions.index'));
});

Breadcrumbs::for('admin.dashboard.institutes.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.institutes.index');
    $trail->push(__('Editar Instituto'), route('admin.dashboard.institutes.index'));
});

Breadcrumbs::for('admin.dashboard.institutes.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.institutes.index');
    $trail->push(__('Nueva Institución'), route('admin.dashboard.institutes.index'));
});

Breadcrumbs::for('admin.dashboard.registers.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.registers.index');
    $trail->push(__('Editar Registro'), route('admin.dashboard.registers.index'));
});

Breadcrumbs::for('admin.dashboard.registers.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.registers.index');
    $trail->push(__('Nuevo Registro'), route('admin.dashboard.registers.index'));
});

Breadcrumbs::for('admin.dashboard.applications.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.applications.index');
    $trail->push(__('Editar Postulación'), route('admin.dashboard.applications.index'));
});

Breadcrumbs::for('admin.dashboard.applications.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.applications.index');
    $trail->push(__('Nueva Postulación'), route('admin.dashboard.applications.index'));
});
