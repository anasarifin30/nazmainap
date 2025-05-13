<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAZMAINAP - Penginapan Desa di Pacitan</title>
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
                    <svg class="shrink-0 w-5 h-5 text-blue-700 transition duration-75 group-hover:text-blue-900" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <!-- SVG content -->
                    </svg>
                    <span class="self-center text-2xl font-semibold whitespace-nowrap">NAZMAINAP</span>
                </a>
        
                <!-- Tombol hamburger untuk tampilan mobile -->
                <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
        
                <!-- Bagian menu yang bisa collapse -->
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                    <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
                        <li>
                            <a href="/" class="block py-2 px-3 rounded-sm md:p-0 {{ Request::is('/') ? 'text-white bg-orange-500 md:bg-transparent md:text-orange-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-orange-500' }}">
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
        
                        <!-- Tambahkan tombol Masuk ke dalam navbar -->
                        @if (!Auth::check())
                        <li>
                            <a href="{{ route('login.guest') }}" class="block py-2 px-3 text-sm text-white bg-blue-700 rounded-md md:bg-transparent md:text-blue-700 md:hover:text-blue-800 hover:bg-blue-800 md:p-0">
                                Masuk
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
        
                <!-- Dropdown profil user tetap di kanan atas -->
                @if (Auth::check())
                <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                    <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : '/docs/images/people/profile-picture-3.jpg' }}" alt="user photo">
                    </button>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm" id="user-dropdown">
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900">{{ Auth::user()->name }}</span>
                            <span class="block text-sm text-gray-500 truncate">{{ Auth::user()->email }}</span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li><a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a></li>
                            <li class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <form method="POST" action="{{ route('logout') }}">@csrf
                                    <button type="submit">Sign out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </nav>
          
    </header>
</body>
</html>

<x-notif></x-notif>