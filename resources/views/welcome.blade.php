<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>

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
                            <img src="storage/img/logo_MP_p0.png" alt="logo_MP"  class="h-20 w-auto">
                        </div>
                        <nav class="-mx-3 flex flex-1 justify-end">
                            <a href="{{ url('/') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                {{$databaseName}}
                            </a>
                            <a href="{{ route('catalogs.index') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                ir a Catalogos
                            </a>
                            <a href="{{ route('migrations.index') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                ir a Migraciones
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
                                                <th class="p-1">DUMP</th>
                                                <th class="p-1">Destino</th>
                                                <th class="p-1">#reg</th>
                                                <th class="p-1">DOWNLOAD</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allTables as $table)
                                                <tr class="text-xs">
                                                    <td>{{ $table['id'] }}</td>
                                                    <td>{{ $table['origen'] }}</td>
                                                    <td>{{ $table['reg_o'] }}</td>
                                                    <td>
                                                        @if( $table['reg_o'] === $table['reg_d'] )
                                                            <a href="{{ route('backup.table', $table['destino']) }}" class="bg-green-500 p-1 rounded-md hover:bg-red-400">
                                                                -⚙-
                                                            </a>
                                                        @else    
                                                            <span class="bg-red-300 me-2 p-1 py-0.5 rounded dark:bg-red-900">..🕜..</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $table['destino'] }}</td>
                                                    <td>{{ $table['reg_d'] }}</td>
                                                    <td>
                                                        @if( $table['descarga'] === 1 )
                                                            <a href="{{ route('backup.download',$table['destino']) }}" class="bg-blue-400 p-1 rounded-md hover:bg-red-400">👉💾</a>
                                                        @else    
                                                            <span class="bg-red-100 me-2 px-2.5 py-0.5 rounded dark:bg-red-900">🚫</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr> <td colspan="5">Total de registros: </td> </tr>
                                            <tr> <td colspan="5">- - - - - - - - - - </td> </tr>
                                        </tfoot>
                                    </table>
                                    <div class="absolute -bottom-16 -left-16 h-36 w-[calc(100%+8rem)] bg-gradient-to-b from-transparent via-white to-red-300 dark:via-zinc-900 dark:to-zinc-900"></div>
                                </div>
                            </div>

                            <div  class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    💥
                                </div>

                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">RESPALDOS</h2>

                                    <div style="color: blue; padding: 10px;" > base de datos origen: {{ $databaseName }} </div>
                                    <div style="color: green; padding: 10px;" > base de datos destino: siemp </div>
                                   
                                </div>

                            </div>

                            <div  class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    🛑
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
                                    <h2 class="text-xl font-semibold text-black dark:text-white">STATUS</h2>
                                    </div>
                                @endif
                                
                            </div>

                            <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    ✅
                                </div>

                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">RESUMEN</h2>

                                    @if(session('success'))
                                        <div style="color: green; border: 1px solid green; padding: 10px;">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <p>  -  </p>
                                    @if(session('error'))
                                        <div style="color: red; border: 1px solid red; padding: 10px;">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <p class="mt-4 text-sm/relaxed">-                                    </p>
                                    <p class="mt-4 text-sm/relaxed">-                                    </p>
                                    <p class="mt-4 text-sm/relaxed">-                                    </p>
                                    <p class="mt-4 text-sm/relaxed">-                                    </p>
                                    <p class="mt-4 text-sm/relaxed">-                                    </p>
                                    <p class="mt-4 text-sm/relaxed">-                                    </p>
                                    <p class="mt-4 text-sm/relaxed">-                                    </p>
                                </div>
                            </div>
                        </div>
                    </main>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
