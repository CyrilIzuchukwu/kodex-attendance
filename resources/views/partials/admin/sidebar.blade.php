  <div class="sidebar" id="sidebar">
      <!-- Logo -->
      <div class="sidebar-logo">
          <a href="/" class="logo logo-normal">
              <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
          </a>
          <a href="/" class="logo logo-white">
              <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
          </a>



          <a id="toggle_btn" href="javascript:void(0);">
              <i data-feather="chevrons-left" class="feather-16"></i>
          </a>
      </div>
      <!-- /Logo -->



      <div class="sidebar-inner slimscroll">
          <div id="sidebar-menu" class="sidebar-menu">
              <ul>
                  <li class="submenu-open">
                      <h6 class="submenu-hdr">Main</h6>
                      <ul>
                          <li class="mb-1 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                              <a href="{{ route('admin.dashboard') }}" class="">
                                  <i class="ti ti-layout-grid fs-16 me-2">
                                  </i><span>Dashboard</span>
                              </a>
                          </li>

                          <li class="mb-1 ">
                              <a href="">
                                  <i class="ti ti-users fs-16 me-2"></i>
                                  <span>Users</span>
                              </a>
                          </li>


                      </ul>
                  </li>

                  <li class="submenu-open">
                      <h6 class="submenu-hdr">Attendance</h6>
                      <ul>
                          <li class="submenu">
                              <a href="javascript:void(0);" class="{{ request()->routeIs('admin.attendance.student', 'admin.qr.student') ? 'active' : '' }}">
                                  <i class="ti ti-school fs-16 me-2"></i>
                                  <span>Students</span>
                                  <span class="menu-arrow"></span>
                              </a>
                              <ul>
                                  <li class="mb-1 {{ request()->routeIs('admin.attendance.student') ? 'active' : '' }}">
                                      <a href="{{ route('admin.attendance.student') }}">Records</a>
                                  </li>
                                  <li class="{{ request()->routeIs('admin.qr.student') ? 'active' : '' }}">
                                      <a href="{{ route('admin.qr.student') }}">QR Code</a>
                                  </li>
                              </ul>
                          </li>

                          <li class="submenu">
                              <a href="javascript:void(0);" class="{{ request()->routeIs('admin.attendance.staff', 'admin.qr.staff') ? 'active' : '' }}">
                                  <i class="ti ti-briefcase fs-16 me-2"></i>
                                  <span>Staff</span>
                                  <span class="menu-arrow"></span>
                              </a>
                              <ul>
                                   <li class=" mb-1{{ request()->routeIs('admin.attendance.staff') ? 'active' : '' }}">
                                      <a href="{{ route('admin.attendance.staff') }}">Records</a>
                                  </li>
                                  <li class="{{ request()->routeIs('admin.qr.staff') ? 'active' : '' }}">
                                      <a href="{{ route('admin.qr.staff') }}">QR Code</a>
                                  </li>
                              </ul>
                          </li>
                      </ul>
                  </li>




                  <li class="submenu-open">
                      <h6 class="submenu-hdr">Profile</h6>
                      <ul>
                          <li class="mb-1 {{ request()->routeIs('admin.profile.index') ? 'active' : '' }} ">
                              <a href="{{ route('admin.profile.index') }}"><i class="ti ti-user fs-16 me-2"></i><span>Profile</span></a>
                          </li>
                      </ul>
                  </li>



                  <li class="submenu-open">
                      <h6 class="submenu-hdr">System Settings</h6>
                      <ul>



                          <li class="mb-1 {{ request()->routeIs('admin.maintenance.*') ? 'active' : '' }}">
                              <a href="{{ route('admin.maintenance.index') }}">
                                  <i class="ti ti-alert-triangle fs-16 me-2"></i>
                                  <span>Maintenance</span>
                              </a>
                          </li>



                          <li class="mb-1">
                              <a href="javascript:void(0)" onclick="document.getElementById('logout-form').submit();">
                                  <i class="ti ti-logout fs-16 me-2"></i>
                                  <span>Logout</span>
                              </a>
                          </li>

                          <form action="{{ route('logout') }}" method="POST" id="logout-form">
                              @csrf
                          </form>

                      </ul>
                  </li>

              </ul>
          </div>
      </div>
  </div>
