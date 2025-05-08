<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAZMAINAP - Penginapan Desa di Pacitan</title>
    {{-- @vite(['resources/css/header.css']) --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400" rel="stylesheet" />
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.0/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</head>
<body>
    <!-- Header -->
    <header class="header">
        

<nav class="bg-white border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
      <svg class="shrink-0 w-5 h-5 text-blue-700 transition duration-75 group-hover:text-blue-900" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><defs><path id="solarHomeBold0" fill="currentColor" d="M10.75 9.5a1.25 1.25 0 1 1 2.5 0a1.25 1.25 0 0 1-2.5 0"/></defs><path fill="currentColor" d="M18.5 3H16a.5.5 0 0 0-.5.5v.059l3.5 2.8V3.5a.5.5 0 0 0-.5-.5"/><use href="#solarHomeBold0" fill-rule="evenodd" clip-rule="evenodd"/>
        <path fill="currentColor" fill-rule="evenodd" d="m20.75 10.96l.782.626a.75.75 0 0 0 .936-1.172l-8.125-6.5a3.75 3.75 0 0 0-4.686 0l-8.125 6.5a.75.75 0 0 0 .937 1.172l.781-.626v10.29H2a.75.75 0 0 0 0 1.5h20a.75.75 0 0 0 0-1.5h-1.25zM9.25 9.5a2.75 2.75 0 1 1 5.5 0a2.75 2.75 0 0 1-5.5 0m2.8 3.75c.664 0 1.237 0 1.696.062c.492.066.963.215 1.345.597s.531.853.597 1.345c.058.43.062.96.062 1.573v4.423h-1.5V17c0-.728-.002-1.2-.048-1.546c-.044-.325-.114-.427-.172-.484s-.159-.128-.484-.172c-.347-.046-.818-.048-1.546-.048s-1.2.002-1.546.048c-.325.044-.427.115-.484.172s-.128.159-.172.484c-.046.347-.048.818-.048 1.546v4.25h-1.5v-4.3c0-.664 0-1.237.062-1.696c.066-.492.215-.963.597-1.345s.854-.531 1.345-.597c.459-.062 1.032-.062 1.697-.062z" clip-rule="evenodd"/><use href="#solarHomeBold0" fill-rule="evenodd" clip-rule="evenodd"/>
        </svg>
      <span class="self-center text-2xl font-semibold whitespace-nowrap">NAZMAINAP</span>
    </a>
    <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
        @if (Auth::check())
            <!-- Jika pengguna sudah login -->
            <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : '/docs/images/people/profile-picture-3.jpg' }}" alt="user photo">
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm" id="user-dropdown">
                <div class="px-4 py-3">
                    <span class="block text-sm text-gray-900">{{ Auth::user()->name }}</span>
                    <span class="block text-sm text-gray-500 truncate">{{ Auth::user()->email }}</span>
                </div>
                <ul class="py-2" aria-labelledby="user-menu-button">
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                    </li>
                    <li class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" >Sign out</button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <!-- Jika pengguna belum login -->
            <a href="{{ route('login') }}" class="text-sm bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                Masuk
            </a>
        @endif
    </div>
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
      <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
        <li>
            <a href="/" class="block py-2 px-3 rounded-sm md:p-0 {{ Request::is('/') ? 'text-white bg-orange-500 md:bg-transparent md:text-orange-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-orange-500' }}" aria-current="page">
            Beranda
            </a>
        </li>
        <li>
            <a href="/kataloghomestay" class="block py-2 px-3 rounded-sm md:p-0 {{ Request::is('kataloghomestay') ? 'text-white bg-orange-500 md:bg-transparent md:text-orange-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-orange-500' }}">
            Penginapan
            </a>
        </li>
        <li>
            <a href="/pemesanan" class="block py-2 px-3 rounded-sm md:p-0 {{ Request::is('pemesanan') ? 'text-white bg-orange-500 md:bg-transparent md:text-orange-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-orange-500' }}">
            Pemesanan
            </a>
        </li>
    </ul>
    </div>
    </div>
  </nav>
  
    </header>
</body>
</html>