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
                                        Ir a catalogos
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
                                            @foreach ($allTables as $key => $table)
                                                <tr class="text-xs">
                                                    <td>{{ $key }}</td>
                                                    <td>{{ $table['origen'] }}</td>
                                                    <td>{{ number_format($table['reg_o'])  }}</td>

                                                    <td>
                                                        @if( $table['reg_o'] === $table['reg_d'] )
                                                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">100%</span>
                                                        @else
                                                            <form action="{{ route('migrations.update',$key) }}" method="POST">
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
                            <div  class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    ✅
                                </div>

                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">MIGRACIONES</h2>

                                    <div style="color: blue; padding: 10px;" > base de datos origen: {{ $databaseName }} </div>
                                    <div style="color: green; padding: 10px;" > base de datos destino: siemp </div>
                                   
                                </div>

                            </div>

                            <div  class="flex items-start gap-4 rounded-lg bg-white p-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    💥
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
                                        <h2>STATUS</h2>
                                    </div>
                                @endif

                                
                            </div>

                            <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    💢
                                </div>

                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">PENDIENTES</h2>

                                    <p class="mt-4 text-sm/relaxed">rg_rod13 </p>
                                    <p class="mt-4 text-sm/relaxed">r_rg_cg11 </p>
                                    <p class="mt-4 text-sm/relaxed">r_ro_cg12: [u_operador_id] </p>
                                    <p class="mt-4 text-sm/relaxed">t_num_tickets: [t_boleta_id, c_status_boleta_id]</p>
                                    <p class="mt-4 text-sm/relaxed">t_descuentos: [t_boleta_id, u_operador_id, c_status, c_status_operacion_id]</p>
                                    <p class="mt-4 text-sm/relaxed">t_control_interno_cancelado: [t_boleta_id] </p>
                                    <p class="mt-4 text-sm/relaxed">t_boleta_cancelado: [t_boleta_id, u_operador_id, c_status_empenio_id, c_tipo_operacion_id, u_pignorante_id, c_tipo_producto_id].</p>

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
