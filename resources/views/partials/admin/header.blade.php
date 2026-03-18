 <div class="header">
     <div class="main-header">

         <!-- Logo -->
         <div class="header-left active ">
             <a href="/" class="logo logo-normal">
                  <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
             </a>
             <a href="/" class="logo logo-white">
                  <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
             </a>
             {{-- <a href="index.html" class="logo-small">
                 <img src="dashboard_assets/img/logo-small.png" alt="Img">
             </a> --}}
         </div>
         <!-- /Logo -->

         <a id="mobile_btn" class="mobile_btn" href="#sidebar">
             <span class="bar-icon">
                 <span></span>
                 <span></span>
                 <span></span>
             </span>
         </a>

         <!-- Header Menu -->
         <ul class="nav user-menu">

             <!-- Search -->
             <li class="nav-item nav-searchinputs">
                 <div class="top-nav-search">
                     <a href="javascript:void(0);" class="responsive-search">
                         <i class="fa fa-search"></i>
                     </a>
                     <form action="#" class="dropdown">
                         <div class="searchinputs input-group dropdown-toggle" id="dropdownMenuClickable"
                             data-bs-toggle="dropdown" data-bs-auto-close="outside">
                             <input type="text" placeholder="Search">
                             <div class="search-addon">
                                 <span><i class="ti ti-search"></i></span>
                             </div>

                         </div>
                     </form>
                 </div>
             </li>
             <!-- /Search -->

             <li class="nav-item nav-item-box">
                 <a href="javascript:void(0);" id="btnFullscreen">
                     <i class="ti ti-maximize"></i>
                 </a>
             </li>



             <li class="nav-item dropdown has-arrow main-drop profile-nav">
                 <a href="javascript:void(0);" class="nav-link userset" data-bs-toggle="dropdown">
                     <span class="user-info p-0">
                         <span class="user-letter" style="overflow: hidden; border-radius: 1px;">
                             <img src="{{ asset('dashboard_assets/img/user-icon.jpg') }}" style="width: 100%; height: 100%; object-fit: cover;" alt="Img" class="img-fluid">
                         </span>
                     </span>
                 </a>
                 <div class="dropdown-menu menu-drop-user">
                     <div class="profileset d-flex align-items-center">

                         <div>
                             <h6 class="fw-medium">{{ auth()->user()->name }}</h6>
                             <p>{{ ucfirst(auth()->user()->role) }}</p>
                         </div>
                     </div>
                     <a class="dropdown-item" href="{{ route('admin.profile.index') }}">
                         <i class="ti ti-user-circle me-2"></i>
                         MyProfile
                     </a>
                    
                     <hr class="my-2">
                     <a class="dropdown-item logout pb-0" href="javascript:void(0)"
                         onclick="document.getElementById('logout-form').submit();"><i
                             class="ti ti-logout me-2"></i>Logout</a>
                     <form action="{{ route('logout') }}" method="POST" id="logout-form">
                         @csrf
                     </form>
                 </div>
             </li>
         </ul>
         <!-- /Header Menu -->


         <!-- Mobile Menu -->
         <div class="dropdown mobile-user-menu">
             <a href="javascript:void(0);" class="nav-link userset" data-bs-toggle="dropdown" aria-expanded="false" style="margin-top: 12px;">
                 <span class="user-info p-0">
                     <span class="user-letter" style="overflow: hidden; border-radius: 1px;">
                         <img src="{{ asset('dashboard_assets/img/user-icon.jpg') }}" style="width: 100%; height: 100%; object-fit: cover; " alt="Profile"
                             class="img-fluid rounded-circle">
                     </span>
                 </span>
             </a>
             <div class="dropdown-menu dropdown-menu-right">
                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item text-white" href="javascript:void(0)"
                     onclick="document.getElementById('logout-form').submit();">
                     <i class="fas fa-sign-out-alt me-2"></i>Logout
                 </a>
             </div>
         </div>
     </div>
 </div>


