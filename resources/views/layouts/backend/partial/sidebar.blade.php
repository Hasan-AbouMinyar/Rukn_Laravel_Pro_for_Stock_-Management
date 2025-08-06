<aside class="main-sidebar elevation-4" style="background-color:#EBEDEF;">
    <!-- Brand Logo -->
    <div class="brand-link d-flex align-items-center justify-content-start" style="height:80px; padding-left:20px;">
      <span class="d-flex align-items-center justify-content-center" style="width:54px;height:54px;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72" style="width:44px;height:44px;display:block;fill:#2874A6;">
          <g>
            <path d="M18.65 57.6c-.82 0-1.52-.59-1.66-1.39L9.6 7.69A2.04 2.04 0 008.2 6.1l-3.26-1.01A1.96 1.96 0 016.1.2c.02 0 .04.01.06.02l3.26 1.01a5.43 5.43 0 013.74 4.25l7.3 41.58c.16.92-.45 1.8-1.37 1.96-.1.02-.2.03-.3.03zm8.04 5.63c-.93 0-1.68-.75-1.68-1.68 0-.82.59-1.52 1.39-1.66l30.04-5.29c1.12-.19 1.87-1.25 1.68-2.37-.19-1.12-1.25-1.87-2.37-1.68-.01 0-.02 0-.03.01l-25.8 4.55c-2.96.52-5.78-1.46-6.3-4.42l-4.55-25.8c-.52-2.96 1.46-5.78 4.42-6.3l25.8-4.55c2.96-.52 5.78 1.46 6.3 4.42l4.21 23.94c.17.93-.45 1.8-1.37 1.96-.9.15-1.75-.45-1.92-1.34l-4.21-23.94c-.19-1.12-1.25-1.87-2.37-1.68l-25.8 4.55c-1.12.19-1.87 1.25-1.68 2.37l4.55 25.8c.19 1.12 1.25 1.87 2.37 1.68h.01l25.8-4.55c2.95-.57 5.81 1.39 6.38 4.34.57 2.95-1.39 5.81-4.34 6.38-.06.01-.12.02-.18.03l-30.04 5.29c-.1.02-.2.03-.3.03z" style="fill:#2874A6;"/>
            <path d="M36.1 25.8c-.93 0-1.68-.75-1.68-1.68 0-.82.59-1.52 1.39-1.66l9.8-1.73c.92-.16 1.8.45 1.96 1.37.16.92-.45 1.8-1.37 1.96l-9.8 1.73c-.1.02-.2.03-.3.03z" style="fill:#2874A6;"/>
            <path d="M24.3 65.1c-3.74 0-6.77-3.03-6.77-6.77s3.03-6.77 6.77-6.77 6.77 3.03 6.77 6.77c0 3.28-2.41 6.09-5.71 6.67-.4.07-.8.1-1.21.1zm.02-10.12c-.2 0-.4.02-.59.05-1.82.32-3.03 2.06-2.71 3.88.32 1.82 2.06 3.03 3.88 2.71 1.82-.32 3.03-2.06 2.71-3.88a3.36 3.36 0 00-3.29-2.76z" style="fill:#2874A6;"/>
          </g>
        </svg>
      </span>
      <a href="#" class="brand-text font-weight-light ms-2 nav-link" style="font-size:1.7rem; background: transparent; border: none; cursor: pointer;">Rkun | رُكن</a>
    </div>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./img/image.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <router-link to="/profile" class="d-block">{{ Auth::user()->name }} </router-link>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">
          <i class="fa-solid fa-square-poll-horizontal fa-2xl" style="color: #2874A6;  "></i> <!-- dashboard  -->
          <p>
              Dashboard
              </p>
            </router-link>
          </li>

        <li class="nav-item">
          <router-link to="/supplier" class="nav-link">
          <i class="fa-solid fa-boxes-packing fa-xl" style="color: #2874A6;  "></i> <!-- supplier  -->
          <p>
                Supplier
            </p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/customer" class="nav-link">
          <i class="fa-solid fa-people-group fa-xl" style="color: #2874A6;  "></i> <!-- customer  -->
            <p>
                Customer
            </p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/category" class="nav-link">
          <i class="fa-solid fa-layer-group fa-xl" style="color: #2874A6;  "></i> <!-- category  -->
            <p>
                Category
            </p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/product" class="nav-link">
          <i class="fa-solid fa-box-open fa-xl" style="color: #2874A6;  "></i> <!-- product  -->
            <p>
                Product
            </p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/purchase" class="nav-link">
          <i class="fa-solid fa-warehouse fa-xl" style="color: #2874A6;  "></i> <!-- stock  -->
            <p>
                Purchase || Stock
            </p>
          </router-link>
        </li>

        <li class="nav-item">
          <router-link to="/sales" class="nav-link">
          <i class="fa-solid fa-money-check-dollar fa-xl" style="color: #2874A6;  "></i> <!-- sale  -->
              <p>
                  Sales
              </p>
          </router-link>
      </li>

      <li class="nav-header">SETTINGS</li>

      @isset(Auth::user()->is_admin)
        @if(Auth::user()->is_admin)
          <li class="nav-item">
            <router-link to="/user" class="nav-link">
              <i class="fa-solid fa-user fa-xl" style="color: #2874A6;  "></i> <!-- user  -->
              <p>
                  All Admin
              </p>
            </router-link>
          </li>
        @endif
      @endisset

      <li class="nav-item ">
        <a class="nav-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
              <i style="color:#2874A6; " class="fa-solid fa-arrow-right-from-bracket fa-xl"></i>
            <p>Log Out</p>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

