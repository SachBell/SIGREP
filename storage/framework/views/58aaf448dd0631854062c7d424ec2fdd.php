<aside id="multilevel-with-separator"
    class="bg-gray-800 overlay lg:shadow-none overlay-open:translate-x-0 drawer drawer-start hidden max-w-64 lg:flex lg:translate-x-0 lg:z-0"
    tabindex="-1">

    <div class="drawer-header">
        <div class="flex items-center gap-3">
            <h3 class="text-white text-xl font-semibold">SIGREP ISUS</h3>
        </div>
    </div>

    <div class="drawer-body px-2 pt-4">
        <ul class="bg-transparent menu space-y-0.5 [&_.nested-collapse-wrapper]:space-y-0.5 [&_ul]:space-y-0.5 p-0">
            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                <li>
                    <a class="text-white sidebar-link" href="<?php echo e(route('admin.dashboard')); ?>">
                        <span class="icon-[tabler--home] size-5"></span>
                        <?php echo e(__('Panel')); ?>

                    </a>
                </li>
                <li class="text-white space-y-0.5">
                    <a class="sidebar-link collapse-toggle collapse-open:bg-base-content/10 open" id="menu-app"
                        data-collapse="#menu-app-collapse">
                        <span class="icon-[tabler--users] size-5"></span>
                        <?php echo e(__('Usuarios')); ?>

                        <span
                            class="icon-[tabler--chevron-down] collapse-open:rotate-180 size-4 transition-all duration-300"></span>
                    </a>
                    <ul id="menu-app-collapse" class="collapse w-auto overflow-hidden transition-[height] duration-300 open"
                        aria-labelledby="menu-app">
                        <li>
                            <a class="sidebar-link text-white" href="<?php echo e(route('manage-users.index')); ?>">
                                <span class="icon-[tabler--user-cog] size-5"></span>
                                User Manager
                            </a>
                        </li>
                        <li>
                            <a class="sidebar-link text-white" href="">
                                <span class="icon-[tabler--shield-check] size-5"></span>
                                Roles & Permissions
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="text-white space-y-0.5">
                    <a class="sidebar-link collapse-toggle collapse-open:bg-base-content/10" id="calls-menu"
                        data-collapse="#calls-menu-collapse">
                        <span class="icon-[tabler--speakerphone] size-5"></span>
                        <?php echo e(__('Convocatorias')); ?>

                        <span
                            class="icon-[tabler--chevron-down] collapse-open:rotate-180 size-4 transition-all duration-300"></span>
                    </a>
                    <ul id="calls-menu-collapse"
                        class="collapse w-auto overflow-hidden transition-[height] duration-300 hidden"
                        aria-labelledby="calls-menu">
                        <li>
                            <a class="sidebar-link text-white" href="<?php echo e(route('app-calls.index')); ?>">
                                <span class="icon-[tabler--list-details] size-5"></span>
                                <?php echo e(__('Listado')); ?>

                            </a>
                        </li>
                        <li>
                            <a class="sidebar-link text-white" href="<?php echo e(route('student-posts.index')); ?>">
                                <span class="icon-[tabler--users-group] size-5"></span>
                                <?php echo e(__('Postulantes')); ?>

                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo e(route('careers.index')); ?>" class="text-white sidebar-link">
                        <span class="icon-[tabler--books] size-5"></span>
                        <?php echo e(__('Carreras')); ?>

                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('convenants.index')); ?>" class="text-white sidebar-link">
                        <span class="icon-[tabler--file-certificate] size-5"></span>
                        <?php echo e(__('Convenios')); ?>

                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('tutor-student.index')); ?>" class="text-white sidebar-link">
                        <span class="icon-[tabler--file-certificate] size-5"></span>
                        <?php echo e(__('Tutores')); ?>

                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('settings.index')); ?>" class="text-white sidebar-link">
                        <span class="icon-[tabler--settings] size-5"></span>
                        <?php echo e(__('Configuraciones')); ?>

                    </a>
                </li>
                <div class="text-white divider py-6 divider-neutral">Account</div>
                <li>
                    <a class="text-white" href="<?php echo e(route('profile.edit')); ?>">
                        <span class="icon-[tabler--user] size-5"></span>
                        <?php echo e(__('Perfil')); ?>

                    </a>
                </li>
                <li>
                    <form class="hidden" id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                    </form>
                    <a class="text-white" href=""
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="icon-[tabler--logout-2] size-5"></span>
                        <?php echo e(__('Sign Out')); ?>

                    </a>
                </li>
                <?php elseif (\Illuminate\Support\Facades\Blade::check('role', 'gestor-teacher')): ?>
                <li>
                    <a class="text-white sidebar-link" href="<?php echo e(route('admin.dashboard')); ?>">
                        <span class="icon-[tabler--home] size-5"></span>
                        <?php echo e(__('Panel')); ?>

                    </a>
                </li>
                <div class="text-white divider py-6 divider-neutral">Gestión Académica</div>
                <li class="text-white space-y-0.5">
                    <a class="sidebar-link collapse-toggle collapse-open:bg-base-content/10 open" id="calls-menu"
                        data-collapse="#calls-menu-collapse">
                        <span class="icon-[tabler--speakerphone] size-5"></span>
                        <?php echo e(__('Convocatorias')); ?>

                        <span
                            class="icon-[tabler--chevron-down] collapse-open:rotate-180 size-4 transition-all duration-300"></span>
                    </a>
                    <ul id="calls-menu-collapse"
                        class="collapse w-auto overflow-hidden transition-[height] duration-300 open"
                        aria-labelledby="calls-menu">
                        <li>
                            <a class="sidebar-link text-white" href="<?php echo e(route('app-calls.index')); ?>">
                                <span class="icon-[tabler--list-details] size-5"></span>
                                <?php echo e(__('Listado')); ?>

                            </a>
                        </li>
                        <li>
                            <a class="sidebar-link text-white" href="<?php echo e(route('student-posts.index')); ?>">
                                <span class="icon-[tabler--users-group] size-5"></span>
                                <?php echo e(__('Postulantes')); ?>

                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo e(route('convenants.index')); ?>" class="text-white sidebar-link">
                        <span class="icon-[tabler--file-certificate] size-5"></span>
                        <?php echo e(__('Convenios')); ?>

                    </a>
                </li>
                <div class="text-white divider py-6 divider-neutral">Estudiantes</div>
                <li>
                    <a href="<?php echo e(route('tutor-student.index')); ?>" class="text-white sidebar-link">
                        <span class="icon-[tabler--file-certificate] size-5"></span>
                        <?php echo e(__('Tutores')); ?>

                    </a>
                </li>
                <div class="text-white divider py-6 divider-neutral">Account</div>
                <li>
                    <a class="text-white" href="<?php echo e(route('profile.edit')); ?>">
                        <span class="icon-[tabler--user] size-5"></span>
                        <?php echo e(__('Perfil')); ?>

                    </a>
                </li>
                <li>
                    <form class="hidden" id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                    </form>
                    <a class="text-white" href=""
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="icon-[tabler--logout-2] size-5"></span>
                        <?php echo e(__('Sign Out')); ?>

                    </a>
                </li>
                <div class="text-white divider py-6 divider-neutral">Miscellaneous</div>
                <li>
                    <a class="text-white" href="#">
                        <span class="icon-[tabler--users-group] size-5"></span>
                        Support
                    </a>
                </li>
                <?php elseif (\Illuminate\Support\Facades\Blade::check('role', 'tutor')): ?>
                <li>
                    <a class="text-white sidebar-link" href="<?php echo e(route('admin.dashboard')); ?>">
                        <span class="icon-[tabler--home] size-5"></span>
                        <?php echo e(__('Panel')); ?>

                    </a>
                </li>
                <div class="text-white divider py-6 divider-neutral">Estudiantes</div>
                <li>
                    <a class="text-white sidebar-link" href="<?php echo e(route('tutor-student.index')); ?>">
                        <span class="icon-[tabler--calendar] size-5"></span>
                        <?php echo e(__('Seguimiento')); ?>

                    </a>
                </li>
                <li>
                    <a class="text-white sidebar-link" href="">
                        <span class="icon-[tabler--file-check] size-5"></span>
                        <?php echo e(__('Calificación')); ?>

                    </a>
                </li>
                <div class="text-white divider py-6 divider-neutral">Account</div>
                <li>
                    <a class="text-white" href="<?php echo e(route('profile.edit')); ?>">
                        <span class="icon-[tabler--user] size-5"></span>
                        <?php echo e(__('Perfil')); ?>

                    </a>
                </li>
                <li>
                    <form class="hidden" id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                    </form>
                    <a class="text-white" href=""
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="icon-[tabler--logout-2] size-5"></span>
                        <?php echo e(__('Sign Out')); ?>

                    </a>
                </li>
                <div class="text-white divider py-6 divider-neutral">Miscellaneous</div>
                <li>
                    <a class="text-white" href="#">
                        <span class="icon-[tabler--users-group] size-5"></span>
                        Support
                    </a>
                </li>
                <?php elseif (\Illuminate\Support\Facades\Blade::check('role', 'student')): ?>
                <li>
                    <a class="text-white sidebar-link" href="<?php echo e(route('dashboard.index')); ?>">
                        <span class="icon-[tabler--home] size-5"></span>
                        <?php echo e(__('Panel')); ?>

                    </a>
                </li>
                <div class="text-white divider py-6 divider-neutral">Mi Gestión</div>
                <?php if(isset($tutor)): ?>
                    <li>
                        <a href="" class="text-white sidebar-link">
                            <span class="icon-[tabler--school] size-5"></span>
                            <?php echo e(__('Mi Tutor')); ?>

                        </a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="<?php echo e(route('progres.index')); ?>" class="text-white sidebar-link">
                        <span class="icon-[tabler--hourglass] size-5"></span>
                        <?php echo e(__('Mi Progreso')); ?>

                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('applications.index')); ?>" class="text-white sidebar-link">
                        <span class="icon-[tabler--speakerphone] size-5"></span>
                        <?php echo e(__('Convocatorias')); ?>

                    </a>
                </li>
                <li>
                    <a href="" class="text-white sidebar-link">
                        <span class="icon-[tabler--writing] size-5"></span>
                        <?php echo e(__('Enviar Solicitud')); ?>

                    </a>
                </li>
                <div class="text-white divider py-6 divider-neutral">Account</div>
                <li>
                    <a class="text-white" href="<?php echo e(route('profile.edit')); ?>">
                        <span class="icon-[tabler--user] size-5"></span>
                        <?php echo e(__('Perfil')); ?>

                    </a>
                </li>
                <li class="text-white">
                    <form class="flex items-center w-full" id="logout-form" action="<?php echo e(route('logout')); ?>"
                        method="POST">
                        <?php echo csrf_field(); ?>
                        <a class="flex items-center gap-2" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="icon-[tabler--logout-2] size-5"></span>
                            <?php echo e(__('Sign Out')); ?>

                        </a>
                    </form>
                </li>
                <div class="text-white divider py-6 divider-neutral">Miscellaneous</div>
                <li class="text-white">
                    <a href="#">
                        <span class="icon-[tabler--users-group] size-5"></span>
                        Support
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="divider divider-neutral"></div>
    <div class="drawer-footer">
        <div class="w-full flex flex-col items-center">
            <span class="-ms-1 text-white/50 text-sm font-medium">Desarrollado por <a href=""
                    class="nav-link text-white hover:text-white/75 transition-colors">YggdrasilCode</a></span>
        </div>
    </div>
</aside>
<?php /**PATH C:\laragon\www\practicasisus\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>