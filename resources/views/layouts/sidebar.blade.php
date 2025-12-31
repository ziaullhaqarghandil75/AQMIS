   <!-- Main sidebar -->
   <div class="sidebar sidebar-light sidebar-main sidebar-expand-md">
       <!-- Sidebar content -->
       <div class="sidebar-content">
           <!-- Main navigation -->
           <div class="card card-sidebar-mobile">
               <ul class="nav nav-sidebar" data-nav-type="accordion">
                   <!-- Main -->
                   <li class="nav-item">
                       <a href="/" class="nav-link active">
                           <i class="icon-home4"></i>
                           <span>
                               دشبورد
                           </span>
                       </a>
                   </li>
                   <li class="nav-item nav-item-submenu">
                       @can('user_settings')
                       <li class="nav-item nav-item-submenu">
                           <a href="#" class="nav-link">
                               <i class="fas fa-user-cog"></i>
                               <span>پروژها</span>
                           </a>
                           <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                               @can('view_user')
                                   <li class="nav-item">
                                       <a href="{{ route('projects.create') }}" class="nav-link active">
                                           <i class="fas fa-user"></i> اضافه کردن پروژها
                                       </a>
                                   </li>
                               @endcan
                               @can('view_role')
                                   <li class="nav-item">
                                       <a href="{{ route('projects.index') }}" class="nav-link">
                                           <i class="fas fa-users-cog"></i> لیست پروژها
                                       </a>
                                   </li>
                               @endcan
                           </ul>
                       </li>
                   @endcan
                   @can('user_settings')
                       <li class="nav-item nav-item-submenu">
                           <a href="#" class="nav-link">
                               <i class="fas fa-user-cog"></i>
                               <span>تنظیمات کاربران</span>
                           </a>
                           <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                               @can('view_user')
                                   <li class="nav-item">
                                       <a href="{{ route('users.index') }}" class="nav-link active">
                                           <i class="fas fa-user"></i> کاربران
                                       </a>
                                   </li>
                               @endcan
                               @can('view_role')
                                   <li class="nav-item">
                                       <a href="{{ route('roles.index') }}" class="nav-link">
                                           <i class="fas fa-users-cog"></i> سطح دسترسی
                                       </a>
                                   </li>
                               @endcan
                               @can('view_permissions')
                                   <li class="nav-item">
                                       <a href="{{ route('permissions.index') }}" class="nav-link">
                                           <i class="fas fa-eye"></i> سطوح دسترسی
                                       </a>
                                   </li>
                               @endcan
                           </ul>
                       </li>
                   @endcan
               </ul>
           </div>


       </div>
       <!-- /sidebar content -->

   </div>
   <!-- /main sidebar -->
