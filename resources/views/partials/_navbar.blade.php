<navbar>
    <div class="navbar bg-base-100">
        <div class="navbar-start">
          <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h8m-8 6h16" />
              </svg>
            </div>
            <ul
              tabindex="0"
              class="menu menu-sm dropdown-content bg-base-100 rounded-box mt-3 w-52 p-2 shadow z-10">
              <li><a>Data Access</a></li>
              <li><a>Labs</a></li>
              <li><a>Data Repositories</a></li>          
              <li>
                <details>
                  <summary>How to contribute</summary>
                  <ul class="bg-base-100 rounded-t-none p-2">
                    <li><a>As a researcher</a></li>
                    <li><a>As a repository</a></li>
                  </ul>
                </details>
              </li>
              <li><a>About MSL</a></li>
              <li><a>EPOS central data portal</a></li>
            </ul>
          </div>
          <a href="{{ route('index') }}" class="btn btn-ghost" 
          >
            <img 
            src= {{ asset('images/logos/multi-scale-laboratories-logo.png') }}
            alt="multi-scale-laboratories-logo"
            class="object-contain h-12">
          </a>
        </div>
        <div class="navbar-end hidden lg:flex">
          <ul class="menu menu-horizontal px-1 z-10">
            <li><a href="{{ route('data-access') }}">Data Access</a></li>
            <li><a href="{{ route('labs') }}">Labs</a></li>
            <li><a href="{{ route('data-repositories') }}">Data Repositories</a></li>
            <li>
              <details>
                <summary>How to contribute</summary>
                <ul class="bg-base-100 rounded-t-none p-2">
                  <li><a href="{{ route('contribute-researcher') }}">As a researcher</a></li>
                  <li><a href="{{ route('contribute-repository') }}">As a repository</a></li>
                </ul>
              </details>
            </li>
            <li><a href="{{ route('about') }}">About MSL</a></li>
            <li><a>EPOS central data portal</a></li>
          </ul>
        </div>
      </div>
</navbar>