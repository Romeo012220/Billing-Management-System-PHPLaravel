<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Billing System') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
      <aside class="w-64 bg-white shadow border-r border-gray-200">
    <div class="p-6 border-b">
        <h1 class="text-xl font-bold text-gray-800">
            Billing System
        </h1>
    </div>

    <nav class="p-4 space-y-2">

        <!-- Dashboard -->
        <a href="#"
            class="block px-4 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-100">
            Dashboard
        </a>

        <!-- Transactions -->
        <div>
            <h3 class="px-4 py-2 text-xs font-bold text-gray-400 uppercase tracking-wider">
                Transactions
            </h3>

           <a href="{{ route('payment') }}"
    class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
    Payment
</a>

            <a href="#"
                class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                Payment History
            </a>
        </div>

        <!-- Menu Management -->
        <div>
            <h3 class="px-4 py-2 text-xs font-bold text-gray-400 uppercase tracking-wider">
                Menu Management
            </h3>

            <a href="{{ route('menu-items.list') }}"
                class="block px-4 py-2 rounded-lg
                {{ request()->routeIs('menu-items.list') ? 'bg-green-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                Menu List
            </a>

       
        </div>

        <!-- User Management -->
        <div>
            <h3 class="px-4 py-2 text-xs font-bold text-gray-400 uppercase tracking-wider">
                User Management
            </h3>

            <a href="#"
                class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                User List
            </a>

        </div>

    </nav>
</aside>

        <!-- Main Content -->
        <main class="flex-1">
            {{ $slot ?? '' }}

            @yield('content')
        </main>

    </div>

    @livewireScripts
</body>
</html>