<navbar>
    <div class="navbar bg-base-200">
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
              <li><a class="no-underline">Data Access</a></li>
              <li><a class="no-underline">Labs</a></li>
              <li><a class="no-underline">Data Repositories</a></li>          
              <li>
                <details>
                  <summary>How to contribute</summary>
                  <ul class="bg-base-100 rounded-t-none p-2 z-20">
                    <li><a class="no-underline">As a researcher</a></li>
                    <li><a class="no-underline">As a repository</a></li>
                  </ul>
                </details>
              </li>
              <li><a class="no-underline">About MSL</a></li>
              <li><a class="no-underline">EPOS central data portal</a></li>
            </ul>
          </div>
          <a href="{{ route('index') }}" class="btn btn-ghost" 
          >
            <img 
            src= {{ asset('images/logos/MSL-logo-data-catalogue_1.png') }}
            alt="multi-scale-laboratories-logo"
            class="object-contain h-12">
          </a>
        </div>
        <div class="navbar-end hidden lg:flex w-full">
          <ul class="menu menu-horizontal px-1 z-10">
            <li><a class="no-underline" href="{{ route('data-access') }}">Data Access</a></li>
            <li><a class="no-underline" href="{{ route('labs-map') }}">Labs</a></li>
            <li><a class="no-underline" href="{{ route('data-repositories') }}">Data Repositories</a></li>
            <li>
              <details>
                <summary>How to contribute</summary>
                <ul class="bg-base-100 rounded-t-none p-2 z-20">
                  <li><a class="no-underline" href="{{ route('contribute-researcher') }}">As a researcher</a></li>
                  <li><a class="no-underline" href="{{ route('contribute-repository') }}">As a repository</a></li>
                </ul>
              </details>
            </li>
            <li>
              <details>
                <summary>Vocabularies</summary>
                <ul class="bg-base-100 rounded-t-none p-2 z-20">
                  <li><a class="no-underline" href="{{ route('keyword-selector') }}">Keyword selector</a></li>
                </ul>
              </details>
            </li>
            <li><a class="no-underline" href="{{ route('about') }}">About MSL</a></li>
            <li><a class="no-underline">EPOS central data portal</a></li>
          </ul>
        </div>
      </div>
</navbar>