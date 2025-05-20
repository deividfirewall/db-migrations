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
                                                <th class="p-1">DUMP</th>
                                                <th class="p-1">Destino</th>
                                                <th class="p-1">Tamaño</th>
                                                <th class="p-1">DOWNLOAD</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $peso_total = 0;
                                            @endphp
                                            @foreach ($allTables as $key => $table)
                                                <tr class="text-xs">
                                                    <td>{{ $key }}</td>
                                                    <td>{{ $table['origen'] }}</td>
                                                    <td>
                                                        @if( $table['avance'] == 100 )
                                                            <a href="{{ route('backup.table', $table['destino']) }}" class="bg-green-500 p-1 rounded-md hover:bg-red-400">
                                                                🔋 100 % 🗜
                                                            </a>
                                                        @else    
                                                            <span class="bg-red-300 me-2 p-1 py-0.5 rounded dark:bg-red-900">🕜 {{ $table['avance'] }} %</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $table['destino'] }}</td>
                                                    <td>@php
                                                            $file_size = round($table['file_size'] / 1024, 1);
                                                            $KB_MB = 'KB';
                                                            if($file_size > 1024){
                                                                $file_size = round($file_size / 1024, 1);
                                                                $KB_MB = ' MB';
                                                            }
                                                        @endphp
                                                        
                                                         {{ $file_size }} {{ $KB_MB }}
                                                    </td>
                                                    <td>
                                                        @if( $table['descarga'] === 1 )
                                                            <a href="{{ route('backup.download',$table['destino']) }}" class="bg-blue-400 p-1 rounded-md hover:bg-red-400">👉💾</a>
                                                        @else    
                                                            <span class="bg-red-100 me-2 px-2.5 py-0.5 rounded dark:bg-red-900">🚫</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @php
                                                    $peso_total += round($table['file_size'] / 1024 /1024, 1);
                                                @endphp
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr> 
                                                <td colspan="4">Tamaño Total de respaldos: </td> 
                                                <td colspan="2"> {{ $peso_total }} MB</td> 
                                            </tr>
                                        </tfoot>
                                    </table>                                    
                                </div>
                            </div>

                            <div  class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    💥
                                </div>

                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">BACKUPS</h2>

                                    <div style="color: blue; padding: 10px;" > base de datos origen: {{ $databaseName }} </div>
                                    <div style="color: green; padding: 10px;" > base de datos destino: siemp </div>
                                </div>
                            </div>

                            <div  class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    🛑
                                </div>

                                
                                @if ($message = Session::get('success'))            {{-- forma 1 de accesder a la session --}}
                                <div class="alert alert-success text-center">
                                    <div style="color: green; border: 1px solid green; padding: 10px;">
                                        <h2>{{ $message }}</h2>

                                    </div>
                                </div>                                
                                @elseif (session('error'))              {{-- forma 2 de acceder a la session --}}
                                    <div class="alert alert-warning text-center">
                                        <div style="color: red; border: 1px solid red; padding: 10px;">
                                            <h2>{{ session('error') }}</h2>                                            
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-danger text-center">
                                        <h2 class="text-xl font-semibold text-black dark:text-white">STATUS</h2>
                                    </div>
                                @endif
                                
                            </div>

                            <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    💾
                                </div>

                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">DOWNLOADS</h2>                                    
                                    Grupo 1:
                                    @if( $grupos[1]['backup'] === 1 )
                                        <a href="{{ route('backup.table','pignorantes pignorante_solidarios t_compradors') }}" class="mt-4 text-sm/relaxed text-blue-700 underline">Dump 🗜 </a>,
                                        @if( $grupos[1]['descarga'] === 1 )
                                            <a href="{{ route('backup.download','grupo1') }}" class="mt-4 text-sm/relaxed text-blue-700 underline">Download {{$grupos[1]['file_size']}}</a>
                                        @endif
                                    @endif                                    
                                    <p class="mb-4 text-sm/relaxed"> 1:pignorantes, 2:pignorante_solidarios, 3:t_compradores, 4:, </p>

                                    Grupo 2: 
                                    @if( $grupos[2]['backup'] === 1 )
                                        <a href="{{ route('backup.table','t_boletas t_empenios t_emp_bol_relations t_empenio_metals t_empenio_products t_reposicions t_concentrados') }}" class="mt-4 text-sm/relaxed text-blue-700 underline">Dump 🗜 </a>,
                                        @if( $grupos[2]['descarga'] === 1 )
                                            <a href="{{ route('backup.download','grupo2') }}" class="mt-4 text-sm/relaxed text-blue-700 underline">Download {{$grupos[2]['file_size']}} </a>
                                        @endif
                                    @endif                                    
                                    <p class="mb-4 text-sm/relaxed"> 1:t_boletas, 2:t_empenios, 3:t_empenio_metals, 4:t_empenio_products, 5:t_emp_bol_relations, 6:t_reposicions, 7:t_concentrados </p>

                                    Grupo 3:
                                    @if( $grupos[3]['backup'] === 1 )
                                        <a href="{{ route('backup.table','t_sol_dias_gracias t_sol_almonedas t_sol_subastas t_subastas t_retasas t_vitrina_ventas t_vitrina_compras t_demasias_pagadas t_suspencion_dias') }}" class="mt-4 text-sm/relaxed text-blue-700 underline">Dump 🗜 </a>,
                                        @if( $grupos[3]['descarga'] === 1 )
                                            <a href="{{ route('backup.download','grupo3') }}" class="mt-4 text-sm/relaxed text-blue-700 underline">Download {{$grupos[3]['file_size']}} </a>
                                        @endif
                                    @endif
                                    <p class="mb-4 text-sm/relaxed"> 1:t_sol_dias_gracias, 2:t_sol_almonedas, 3:t_sol_subastas, 4:t_subastas, 5:t_retasas, 6:t_vitrina_ventas, 7:t_vitrina_compras, 8:t_demasias_pagadas, 9:t_suspencion_dias  </p>

                                    Grupo 4:
                                    @if( $grupos[4]['backup'] === 1 )
                                        <a href="{{ route('backup.table','t_descuentos t_num_tickets rg_rod13 r_rg_cg11 r_ro_cg12 t_boleta_cancelado t_control_interno_cancelado') }}" class="mt-4 text-sm/relaxed text-blue-700 underline">Dump 🗜</a>,
                                        @if( $grupos[4]['descarga'] === 1 )
                                            <a href="{{ route('backup.download','grupo4') }}" class="mt-4 text-sm/relaxed text-blue-700 underline">Download {{$grupos[4]['file_size']}} 💾</a>
                                        @endif
                                    @endif
                                    <p class="mb-4 text-sm/relaxed"> 1:t_descuentos, 2:t_num_tickets, 3:rg_rod13, 4:r_rg_cg11, 5:r_ro_cg12, 6:t_boleta_cancelado, 7:t_control_interno_cancelado </p>
                                    Grupo 5:
                                    @if( $grupos[5]['backup'] === 1 )
                                        <a href="{{ route('backup.table','t_boleta_pagos t_cajas h_boletas t_ctrl_internos') }}" class="mt-4 text-sm/relaxed text-blue-700 underline">Dump 🗜 </a>,
                                        @if( $grupos[5]['descarga'] === 1 )
                                            <a href="{{ route('backup.download','grupo5') }}" class="mt-4 text-sm/relaxed text-blue-700 underline">Download {{$grupos[5]['file_size']}} 💾</a>
                                        @endif
                                    @endif
                                    <p class="mb-4 text-sm/relaxed"> Toda la base (solo para sucursales chicas o medianas) </p>
                                    
                                    
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
