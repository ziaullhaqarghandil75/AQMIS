   <!-- Main sidebar -->
   <div class="sidebar sidebar-light sidebar-main sidebar-expand-md">
       <!-- Sidebar content -->
       <div class="sidebar-content">
           <!-- Main navigation -->
           <div class="card card-sidebar-mobile">
               <ul class="nav nav-sidebar" data-nav-type="accordion">
                   <!-- Main -->
                   <li class="nav-item">
                       <a href="/" class="nav-link {{ menuActive('dashboard') }}">
                           <i class="icon-home4"></i>
                           <span>
                               دشبورد
                           </span>
                       </a>
                   </li>
                   <li class="nav-item nav-item-submenu">
                       @can('user_settings')
                       <li class="nav-item nav-item-submenu {{ menuOpen(['users.*', 'roles.*', 'permissions.*']) }}">

                           <a href="#" class="nav-link">
                               <i class="fas fa-user-cog"></i>
                               <span>تنظیمات کاربران</span>
                           </a>

                           <ul class="nav nav-group-sub"
                               style="{{ menuOpen(['users.*', 'roles.*', 'permissions.*']) ? 'display:block;' : '' }}">

                               @can('view_user')
                                   <li class="nav-item">
                                       <a href="{{ route('users.index') }}" class="nav-link {{ menuActive('users.*') }}">
                                           <i class="fas fa-user"></i> کاربران
                                       </a>
                                   </li>
                               @endcan

                               @can('view_role')
                                   <li class="nav-item">
                                       <a href="{{ route('roles.index') }}" class="nav-link {{ menuActive('roles.*') }}">
                                           <i class="fas fa-users-cog"></i> سطح دسترسی
                                       </a>
                                   </li>
                               @endcan

                               @can('view_permissions')
                                   <li class="nav-item">
                                       <a href="{{ route('permissions.index') }}"
                                           class="nav-link {{ menuActive('permissions.*') }}">
                                           <i class="fas fa-eye"></i> سطوح دسترسی
                                       </a>
                                   </li>
                               @endcan

                           </ul>
                       </li>
                   @endcan

                   @can('systems_settings')
                       <li class="nav-item nav-item-submenu {{ menuOpen(['guzar.*', 'block.*', 'zone.*', 'land_category.*']) }}">

                           <a href="#" class="nav-link">
                               <i class="fas fa-cogs"></i>
                               <span>سیستم</span>
                           </a>

                           <ul class="nav nav-group-sub"
                               style="{{ menuOpen(['guzar.*', 'block.*', 'zone.*', 'land_category.*']) ? 'display:block;' : '' }}">

                               @can('view_guzar')
                                   <li class="nav-item">
                                       <a href="{{ route('guzar.index') }}" class="nav-link {{ menuActive('guzar.*') }}">
                                           <i class="fas fa-road"></i> گذر
                                       </a>
                                   </li>
                               @endcan

                               @can('view_block')
                                   <li class="nav-item">
                                       <a href="{{ route('block.index') }}" class="nav-link {{ menuActive('block.*') }}">
                                           <i class="fas fa-th-large"></i> بلاک
                                       </a>
                                   </li>
                               @endcan

                               @can('view_zone')
                                   <li class="nav-item">
                                       <a href="{{ route('zone.index') }}" class="nav-link {{ menuActive('zone.*') }}">
                                           <i class="fas fa-map-marked-alt"></i> زون
                                       </a>
                                   </li>
                               @endcan
                               @can('view_land_category')
                                   <li class="nav-item">
                                       <a href="{{ route('land_category.index') }}"
                                           class="nav-link {{ menuActive('land_category.*') }}">
                                           <i class="fas fa-file-invoice-dollar"></i> کتگوری زمین
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
