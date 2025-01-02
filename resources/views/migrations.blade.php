<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Migrations</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" alt="Laravel background" />
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                            
                            <img src="storage/img/logo_MP_p0.png" alt="logo_MP" class="h-20 w-auto">
                        </div>
                            <nav class="-mx-3 flex flex-1 justify-end">
                                
                                    <a href="{{ url('/') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        {{$databaseName}}
                                    </a>
                                

                                    <a href="{{ route('catalogs.index') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        ir a catalogs
                                    </a>
                               
                            </nav>
                    </header>

                    <main class="mt-6">
                        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                            <div id="docs-card" class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">
                                    <table>
                                        <thead>
                                            <tr class="text-xs">
                                                <th class="p-1">ID</th>
                                                <th class="p-1">Origen</th>
                                                <th class="p-1">#reg</th>
                                                <th class="p-1">Migration</th>
                                                <th class="p-1">Destino</th>
                                                <th class="p-1">#reg</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allTables as $table)
                                                <tr class="text-xs">
                                                    <td>{{ $table['id'] }}</td>
                                                    <td>{{ $table['origen'] }}</td>
                                                    <td>{{ number_format($table['reg_o'])  }}</td>

                                                    <td>
                                                        @if( $table['reg_o'] === $table['reg_d'] )
                                                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">100%</span>
                                                        @else
                                                            <form action="{{ route('migrations.update',$table['id']) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="bg-blue-400 text-white px-1 rounded-md hover:bg-red-400">{{ $table['avance'] }}%</button>
                                                            </form>    
                                                        @endif
                                                    </td>
                                                    <td>{{ $table['destino'] }}</td>
                                                    <td>{{ number_format($table['reg_d']) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5">Total de registros: </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                </div>

                                <div class="relative flex items-center gap-6 lg:items-end">
                                    

                                </div>
                            </div>

                            <div  class="flex items-start gap-4 rounded-lg bg-white p-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    ✅
                                </div>

                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success text-center">
                                        <h2>{{ $message }}</h2>
                                    </div>
                                @elseif ($message = Session::get('error'))
                                    <div class="alert alert-warning text-center">
                                        <h2>{{ $message }}</h2>
                                    </div>
                                @else
                                    <div class="alert alert-danger text-center">
                                        <h2>SIN ACCIONES</h2>
                                    </div>
                                @endif

                                ➡
                            </div>

                            <a href="https://laravel-news.com" class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    💢
                                </div>

                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">News</h2>

                                    <p class="mt-4 text-sm/relaxed">...</p>
                                    <p class="mt-4 text-sm/relaxed">...</p>
                                    <p class="mt-4 text-sm/relaxed">...</p>
                                    <p class="mt-4 text-sm/relaxed">...</p>
                                    <p class="mt-4 text-sm/relaxed">...</p>
                                </div>

                                <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                            </a>

                            <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    ⛔
                                </div>

                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">Vibrant Ecosystem</h2>

                                    <p class="mt-4 text-sm/relaxed">and more.</p>
                                    <p class="mt-4 text-sm/relaxed">and more.</p>
                                    <p class="mt-4 text-sm/relaxed">and more.</p>
                                </div>
                            </div>
                        </div>
                    </main>

                    <footer class="py-16 text-center text-xl text-black dark:text-white/70">
                        {{$databaseName}}
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
