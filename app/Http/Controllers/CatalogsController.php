<?php

namespace App\Http\Controllers;

use App\Models\Catalogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogsController extends Controller
{
    public $allCatalogs;
    public $Catalogs;

    public function __construct()
    {
        $this->Catalogs = Catalogs::all();

        $this->allCatalogs = [
            10 =>['origen'=>'c_estados', 'reg_o'=>DB::connection('sucursal')->table('c_estados')->count()
                      ,'destino'=>'cat_loc_estados','reg_d'=>DB::table('cat_loc_estados')->count()
                      ,'avance'=>'0'],
            11 =>['origen'=>'c_municipios', 'reg_o'=>DB::connection('sucursal')->table('c_municipios')->count()
                      ,'destino'=>'cat_loc_municipios','reg_d'=>DB::table('cat_loc_municipios')->count()
                      ,'avance'=>'0'],
            12 =>['origen'  =>'c_tipo_metal', 'reg_o'=>DB::connection('sucursal')->table('c_tipo_metal')->count()
                      ,'destino' =>'cat_metal_tipos','reg_d'=>DB::table('cat_metal_tipos')->count()
                      ,'avance'=>'0'],
            13 =>['origen'=>'c_precio_metal', 'reg_o'=>DB::connection('sucursal')->table('c_precio_metal')->count()
                      ,'destino'=>'cat_metal_precios','reg_d'=>DB::table('cat_metal_precios')->count()
                      ,'avance'=>'0'],
            14 =>['origen'=>'c_cotiza_metales', 'reg_o'=>DB::connection('sucursal')->table('c_cotiza_metales')->count()
                      ,'destino'=>'cat_metal_cotizas','reg_d'=>DB::table('cat_metal_cotizas')->count()
                      ,'avance'=>'0'],
            15 =>['origen'=>'c_tipo_producto', 'reg_o'=>DB::connection('sucursal')->table('c_tipo_producto')->count()
                      ,'destino'=>'cat_product_tipos','reg_d'=>DB::table('cat_product_tipos')->count()
                      ,'avance'=>'0'],
            16 =>['origen'=>'c_productos', 'reg_o'=>DB::connection('sucursal')->table('c_productos')->count()
                      ,'destino'=>'cat_productos','reg_d'=>DB::table('cat_productos')->count()
                      ,'avance'=>'0'],
            17 =>['origen'=>'c_sub_productos', 'reg_o'=>DB::connection('sucursal')->table('c_sub_productos')->count()
                      ,'destino'=>'cat_product_subs','reg_d'=>DB::table('cat_product_subs')->count()
                      ,'avance'=>'0'],
            18 =>['origen'=>'c_cotiza_producto', 'reg_o'=>DB::connection('sucursal')->table('c_cotiza_producto')->count()
                      ,'destino'=>'cat_product_cotizas','reg_d'=>DB::table('cat_product_cotizas')->count()
                      ,'avance'=>'0'],
            19 =>['origen'=>'c_tipo_prestamo', 'reg_o'=>DB::connection('sucursal')->table('c_tipo_prestamo')->count()
                      ,'destino'=>'cat_prestamo_tipos','reg_d'=>DB::table('cat_prestamo_tipos')->count()
                      ,'avance'=>'0'],
            20 =>['origen'=>'c_tipo_prestamo_sucursal', 'reg_o'=>DB::connection('sucursal')->table('c_tipo_prestamo_sucursal')->count()
                      ,'destino'=>'cat_prestamo_tipo_sedes','reg_d'=>DB::table('cat_prestamo_tipo_sedes')->count()
                      ,'avance'=>'0'],
            21 =>['origen'=>'c_status_empenio', 'reg_o'=>DB::connection('sucursal')->table('c_status_empenio')->count()
                      ,'destino'=>'cat_status_empenios','reg_d'=>DB::table('cat_status_empenios')->count()
                      ,'avance'=>'0'],
            22 =>['origen'=>'c_tipo_operacion', 'reg_o'=>DB::connection('sucursal')->table('c_tipo_operacion')->count()
                    ,'destino'=>'cat_operacion_tipos','reg_d'=>DB::table('cat_operacion_tipos')->count()
                    ,'avance'=>'0'],
            23 =>['origen'=>'c_status_demasia', 'reg_o'=>DB::connection('sucursal')->table('c_status_demasia')->count()
                    ,'destino'=>'cat_status_demasias','reg_d'=>DB::table('cat_status_demasias')->count()
                    ,'avance'=>'0'],
            24 =>['origen'=>'c_status_subasta', 'reg_o'=>DB::connection('sucursal')->table('c_status_subasta')->count()
                        ,'destino'=>'cat_status_subastas','reg_d'=>DB::table('cat_status_subastas')->count()
                        ,'avance'=>'0'],
        ];

        //falta: c_intereses, c_status_usuario, c_sucursal
        //  c_tipo_prestamo_sucursal, no es un catalogo, es una tabla operativa
        //  c_intereses, esta en desuso
        //  c_status_usuario, no fue utilizado
    }

    public function index()
    {

        $databaseName = DB::connection('sucursal')->getDatabaseName();

        $allCatalogs = $this->allCatalogs;
        $Catalogs = $this->Catalogs;

        return view('catalogs', compact(
            'allCatalogs',
            'Catalogs',
            'databaseName'
        ));


        /*
            SELECT * FROM `c_municipios` WHERE nombre LIKE "%Ã©%";  equivale a la é
            
            UPDATE `c_municipios` SET nombre = REPLACE(nombre, 'Ã¡', 'á');  equivale a la á
            UPDATE `c_municipios` SET nombre = REPLACE(nombre, 'Ã©', 'é');  equivale a la é
            UPDATE `c_municipios` SET nombre = REPLACE(nombre, 'Ã³', 'ó');  equivale a la ó
            UPDATE `c_municipios` SET nombre = REPLACE(nombre, 'Ãº', 'ú');  equivale a la ú
            UPDATE `c_municipios` SET nombre = REPLACE(nombre, 'Ã±', 'ñ');  equivale a la ñ
            UPDATE `c_municipios` SET nombre = REPLACE(nombre, 'Ã', 'í');  equivale a la í

            UPDATE `c_municipios` SET `sigla` = 'ACÑ' WHERE id = 34; 
         */
        /**
          UPDATE `cat_metal_precios` SET `precio_gramo_venta` = '1760',  `precio_gramo` = '1760'  WHERE `cat_metal_precios`.`id` = 1; 
          UPDATE `cat_metal_precios` SET `precio_gramo_venta` = '26.43', `precio_gramo` = '26.43' WHERE `cat_metal_precios`.`id` = 2;
         */

    }

    public function update($catalogoId)
    {
        switch ($catalogoId)
        {
            case 10:    $this->compareEstados($catalogoId);               break;
            case 11:    $this->compareMunicipios($catalogoId);            break;
            case 12:    $this->compareTiposMetal($catalogoId);            break;
            case 13:    $this->comparePreciosMetal($catalogoId);          break;
            case 14:    $this->compareCotizaMetales($catalogoId);         break;
            case 15:    $this->compareTiposProducto($catalogoId);         break;
            case 16:    $this->compareProductos($catalogoId);             break;
            case 17:    $this->compareSubProductos($catalogoId);          break;
            case 18:    $this->compareCotizaProductos($catalogoId);       break;
            case 19:    $this->compareTiposPrestamo($catalogoId);         break;
            case 20:    $this->compareTiposPrestamoSucursal($catalogoId); break;
            case 21:    $this->compareStatusEmpenio($catalogoId);         break;
        }

        return redirect()->route('catalogs.index');
    }

    private function compareEstados($cat_id)
    {
        $count_diferences = 0;
        $cat_SUCURSAL = DB::connection('sucursal')->table($this->allCatalogs[$cat_id]['origen'])->get();
        $num_reg_SUCURSAL = count($cat_SUCURSAL);

        $cat_SIEMP = DB::table($this->allCatalogs[$cat_id]['destino'])->get();
        $num_reg_SIEMP = count($cat_SIEMP);

        $reg_mayor = ($num_reg_SUCURSAL > $num_reg_SIEMP) ? $num_reg_SUCURSAL : $num_reg_SIEMP;
        
        Catalogs::where('catalog_id', 10)->delete();

        for ($i = 0; $i < $reg_mayor; $i++)
        {
            if ($i > $num_reg_SUCURSAL-1)
            {
                $cat_SUCURSAL[$i] = (object) [
                    'id' => 'nulo',
                    'clave' => '-',
                    'nombre' => '-',
                    'abrev' => '-'
                ];
            }

            if ($i > $num_reg_SIEMP-1)
            {
                $registroSIEMP = (object) [
                    'id' => 'nulo',
                    'clave' => '-',
                    'estado' => '-',
                    'abrev' => '-'
                ];
            }

            if($cat_SUCURSAL[$i]->clave != $cat_SIEMP[$i]->clave)
            {
                Catalogs::create([
                    'catalog' => 'cat_loc_estados',
                    'catalog_id' => '10',
                    'diference' => $cat_SUCURSAL[$i]->clave.'}≠{'.$cat_SIEMP[$i]->clave,
                    'register_sucur_id' => $i,
                    'register_siemp_id' => $i,
                    'fixed' => 'clave'
                ]);           
            }
        }

        if($count_diferences == 0)
        {
            
            Catalogs::create([
                'catalog' => 'cat_loc_estados',
                'catalog_id' => '10',
                'diference' => 'Ninguna',
                'register_sucur_id' => null,
                'register_siemp_id' => null,
                'fixed' => 'SINCRONIZADO'

            ]);
        }
    }
    private function compareMunicipios($cat_id)
    {
        $count_diferences = 0;

        $cat_SUCURSAL = DB::connection('sucursal')->table($this->allCatalogs[$cat_id]['origen'])->get();
        $num_reg_SUCURSAL = count($cat_SUCURSAL);

        $cat_SIEMP = DB::table($this->allCatalogs[$cat_id]['destino'])->get();
        $num_reg_SIEMP = count($cat_SIEMP);

        $reg_mayor = ($num_reg_SUCURSAL > $num_reg_SIEMP) ? $num_reg_SUCURSAL : $num_reg_SIEMP;

        Catalogs::where('catalog_id', 11)->delete();

        for ($i = 0; $i < $reg_mayor; $i++)
        {
            if ($i > $num_reg_SUCURSAL-1)
            {
                $cat_SUCURSAL[$i] = (object) [
                    'id' => 'nulo',
                    'clave' => '-',
                    'nombre' => '-',
                    'sigla' => '-',
                    'c_estados_id' => '-'
                ];
            }

            if ($i > $num_reg_SIEMP-1)
            {
                $cat_SIEMP[$i] = (object) [
                    'id' => 'nulo',
                    'clave' => '-',
                    'municipio' => '-',
                    'sigla' => '-',
                    'cat_loc_estado_id' => '-'
                ];
            }

            if($cat_SUCURSAL[$i]->clave != $cat_SIEMP[$i]->clave)
            {
                Catalogs::create([
                    'catalog' => 'cat_loc_municipios',
                    'catalog_id' => '11',
                    'diference' => $cat_SUCURSAL[$i]->clave.' ≠ '.$cat_SIEMP[$i]->clave,
                    'register_sucur_id' => $cat_SUCURSAL[$i]->id,
                    'register_siemp_id' => $cat_SIEMP[$i]->id,
                    'fixed' => 'clave'
                ]);
                $count_diferences++;
            }
            if($cat_SUCURSAL[$i]->c_estados_id != $cat_SIEMP[$i]->cat_loc_estado_id)
            {
                Catalogs::create([
                    'catalog' => 'cat_loc_municipios',
                    'catalog_id' => '11',
                    'diference' => $cat_SUCURSAL[$i]->c_estados_id.' ≠ '.$cat_SIEMP[$i]->cat_loc_estado_id,
                    'register_sucur_id' => $cat_SUCURSAL[$i]->id,
                    'register_siemp_id' => $cat_SIEMP[$i]->id,
                    'fixed' => 'cat_loc_estado_id'
                ]);
                $count_diferences++;
            }
            if($cat_SUCURSAL[$i]->sigla != $cat_SIEMP[$i]->sigla)
            {
                Catalogs::create([
                    'catalog' => 'cat_loc_municipios',
                    'catalog_id' => '11',
                    'diference' => $cat_SUCURSAL[$i]->sigla.' ≠ '.$cat_SIEMP[$i]->sigla,
                    'register_sucur_id' => $cat_SUCURSAL[$i]->id,
                    'register_siemp_id' => $cat_SIEMP[$i]->id,
                    'fixed' => 'sigla'
                ]);
                $count_diferences++;
            }
        }

        if($count_diferences == 0)
        {
            Catalogs::create([
                'catalog' => 'cat_loc_municipios',
                'catalog_id' => '11',
                'diference' => 'Ninguna',
                'register_sucur_id' => null,
                'register_siemp_id' => null,
                'fixed' => 'SINCRONIZADO'
            ]);
        }
     }
    private function compareTiposMetal($cat_id)
    {    }
    private function comparePreciosMetal($cat_id)
    {
        $count_diferences = 0;

        $cat_SUCURSAL = DB::connection('sucursal')->table($this->allCatalogs[$cat_id]['origen'])->get();
        $num_reg_SUCURSAL = count($cat_SUCURSAL);

        $cat_SIEMP = DB::table($this->allCatalogs[$cat_id]['destino'])->get();
        $num_reg_SIEMP = count($cat_SIEMP);

        $reg_mayor = ($num_reg_SUCURSAL > $num_reg_SIEMP) ? $num_reg_SUCURSAL : $num_reg_SIEMP;

        Catalogs::where('catalog_id', 13)->delete();

        for ($i = 0; $i < $reg_mayor; $i++)
        {
            if ($i > $num_reg_SUCURSAL-1)
            {
                $cat_SUCURSAL[$i] = (object) [
                    'clave' => 'nulo',
                    'base' => '-',
                    'gramos' => '-',
                    'precio_compra' => '-',
                    'precio_venta' => '-',
                    'precio_gramo' => '-',
                    'precio_gramo_venta' => '-',
                    'c_metal_id' => '-',
                ];
            }

            if ($i > $num_reg_SIEMP-1)
            {
                $cat_SIEMP[$i] = (object) [
                    'id' => 'nulo',
                    'base' => '-',
                    'gramos' => '-',
                    'precio_compra' => '-',
                    'precio_venta' => '-',
                    'precio_gramo_venta' => '-',
                    'precio_gramo' => '-',
                    'cat_metal_tipo_id' => '-',
                ];
            }

            if($cat_SUCURSAL[$i]->precio_gramo != $cat_SIEMP[$i]->precio_gramo)
            {
                Catalogs::create([
                    'catalog' => 'cat_metal_precios',
                    'catalog_id' => '13',
                    'diference' => $cat_SUCURSAL[$i]->precio_gramo.' ≠ '.$cat_SIEMP[$i]->precio_gramo,
                    'register_sucur_id' => $cat_SUCURSAL[$i]->clave,
                    'register_siemp_id' => $cat_SIEMP[$i]->id,
                    'fixed' => 'precio_gramo'
                ]);         
                $count_diferences++;           
            }
        }

        if($count_diferences == 0)
        {
            Catalogs::create([
                'catalog' => 'cat_metal_precios',
                'catalog_id' => '13',
                'diference' => 'Ninguna',
                'register_sucur_id' => null,
                'register_siemp_id' => null,
                'fixed' => 'SINCRONIZADO'
            ]);
        }
    }
    private function compareCotizaMetales($cat_id)
    {
        $count_diferences = 0;

        $cat_SUCURSAL = DB::connection('sucursal')->table($this->allCatalogs[$cat_id]['origen'])->get();
        $num_reg_SUCURSAL = count($cat_SUCURSAL);

        $cat_SIEMP = DB::table($this->allCatalogs[$cat_id]['destino'])->get();
        $num_reg_SIEMP = count($cat_SIEMP);

        $reg_mayor = ($num_reg_SUCURSAL > $num_reg_SIEMP) ? $num_reg_SUCURSAL : $num_reg_SIEMP;

        Catalogs::where('catalog_id', 14)->delete();

        for ($i = 0; $i < $reg_mayor; $i++)
        {
            if ($i > $num_reg_SUCURSAL-1)
            {
                $cat_SUCURSAL[$i] = (object) [
                    'id' => 'nulo',
                    'ref' => '-',
                    'nombre' => '-',
                    'kilates' => '-',
                    'eq_oro' => '-',
                    'por_vc' => '-',
                    'por_cv' => '-',
                    'por_aval' => '-',
                    'c_tipo_metal_id' => '-',
                ];
            }

            if ($i > $num_reg_SIEMP-1)
            {
                $cat_SIEMP[$i] = (object) [
                    'id' => 'nulo',
                    'ref' => '-',
                    'nombre' => '-',
                    'kilates' => '-',
                    'eq_oro' => '-',
                    'por_vc' => '-',
                    'por_cv' => '-',
                    'por_aval' => '-',
                    'cat_metal_tipo_id' => '-',
                ];
            }

            if($cat_SUCURSAL[$i]->ref != $cat_SIEMP[$i]->ref)
            {
                Catalogs::create([
                    'catalog' => 'cat_metal_cotizas',
                    'catalog_id' => '14',
                    'diference' => $cat_SUCURSAL[$i]->ref.' ≠ '.$cat_SIEMP[$i]->ref,
                    'register_sucur_id' => $cat_SUCURSAL[$i]->id,
                    'register_siemp_id' => $cat_SIEMP[$i]->id,
                    'fixed' => 'ref'
                ]);
                $count_diferences++;
            }
        }
        if($count_diferences == 0)
        {
            Catalogs::create([
                'catalog' => 'cat_metal_cotizas',
                'catalog_id' => '14',
                'diference' => 'Ninguna',
                'register_sucur_id' => null,
                'register_siemp_id' => null,
                'fixed' => 'SINCRONIZADO'
            ]);
        }
    }
    private function compareTiposProducto($cat_id)
    {
        $count_diferences = 0;

        $cat_SUCURSAL = DB::connection('sucursal')->table($this->allCatalogs[$cat_id]['origen'])->get();
        $num_reg_SUCURSAL = count($cat_SUCURSAL);

        $cat_SIEMP = DB::table($this->allCatalogs[$cat_id]['destino'])->get();
        $num_reg_SIEMP = count($cat_SIEMP);

        $reg_mayor = ($num_reg_SUCURSAL > $num_reg_SIEMP) ? $num_reg_SUCURSAL : $num_reg_SIEMP;

        Catalogs::where('catalog_id', 15)->delete();
            
        for ($i = 0; $i < $reg_mayor; $i++)
        {
            if ($i > $num_reg_SUCURSAL-1)
            {
                $cat_SUCURSAL[$i] = (object) [
                    'id' => '-1',
                    'tipo' => '-',
                ];
            }

            if ($i > $num_reg_SIEMP-1)
            {
                $cat_SIEMP[$i] = (object) [
                    'id' => '-1',
                    'tipo' => '-',
                ];
            }

            if($cat_SUCURSAL[$i]->tipo != $cat_SIEMP[$i]->tipo)
            {
                Catalogs::create([
                    'catalog' => 'cat_product_tipos',
                    'catalog_id' => '15',
                    'diference' => $cat_SUCURSAL[$i]->tipo.' ≠ '.$cat_SIEMP[$i]->tipo,
                    'register_sucur_id' => $cat_SUCURSAL[$i]->id,
                    'register_siemp_id' => $cat_SIEMP[$i]->id,
                    'fixed' => 'tipo'
                ]);
                $count_diferences++;
            }
        }
        if($count_diferences == 0)
        {
            Catalogs::create([
                'catalog' => 'cat_product_tipos',
                'catalog_id' => '15',
                'diference' => 'Ninguna',
                'register_sucur_id' => null,
                'register_siemp_id' => null,
                'fixed' => 'SINCRONIZADO'
            ]);
        }
    }
    private function compareProductos($cat_id)
    {
        $count_diferences = 0;

        $cat_SUCURSAL = DB::connection('sucursal')->table($this->allCatalogs[$cat_id]['origen'])->get();
        $num_reg_SUCURSAL = count($cat_SUCURSAL);

        $cat_SIEMP = DB::table($this->allCatalogs[$cat_id]['destino'])->get();
        $num_reg_SIEMP = count($cat_SIEMP);

        $reg_mayor = ($num_reg_SUCURSAL > $num_reg_SIEMP) ? $num_reg_SUCURSAL : $num_reg_SIEMP;

        Catalogs::where('catalog_id', 16)->delete();

        for ($i = 0; $i < $reg_mayor; $i++)
        {
            if ($i > $num_reg_SUCURSAL-1)
            {
                $cat_SUCURSAL[$i] = (object) [
                    'id' => '-1',
                    'nombre' => '-',
                    'c_tipo_producto_id' => '-',
                ];
            }

            if ($i > $num_reg_SIEMP-1)
            {
                $cat_SIEMP[$i] = (object) [
                    'id' => '-1',
                    'producto' => '-',
                    'cat_product_tipo_id' => '-',
                ];
            }
            if($cat_SUCURSAL[$i]->nombre != $cat_SIEMP[$i]->producto)
            {
                Catalogs::create([
                    'catalog' => 'cat_productos',
                    'catalog_id' => '16',
                    'diference' => $cat_SUCURSAL[$i]->nombre.' ≠ '.$cat_SIEMP[$i]->producto,
                    'register_sucur_id' => $cat_SUCURSAL[$i]->id,
                    'register_siemp_id' => $cat_SIEMP[$i]->id,
                    'fixed' => 'producto'
                ]);
                $count_diferences++;
            }
            if($cat_SUCURSAL[$i]->c_tipo_producto_id != $cat_SIEMP[$i]->cat_product_tipo_id)
            {
                Catalogs::create([
                    'catalog' => 'cat_productos',
                    'catalog_id' => '16',
                    'diference' => $cat_SUCURSAL[$i]->c_tipo_producto_id.' ≠ '.$cat_SIEMP[$i]->cat_product_tipo_id,
                    'register_sucur_id' => $cat_SUCURSAL[$i]->id,
                    'register_siemp_id' => $cat_SIEMP[$i]->id,
                    'fixed' => 'cat_product_tipo_id'
                ]);
                $count_diferences++;
            }
        }
        if($count_diferences == 0)
        {
            Catalogs::create([
                'catalog' => 'cat_productos',
                'catalog_id' => '16',
                'diference' => 'Ninguna',
                'register_sucur_id' => null,
                'register_siemp_id' => null,
                'fixed' => 'SINCRONIZADO'
            ]);
        }
    }
    private function compareSubProductos($cat_id)
    {
        $count_diferences = 0;

        $cat_SUCURSAL = DB::connection('sucursal')->table($this->allCatalogs[$cat_id]['origen'])->get();
        $num_reg_SUCURSAL = count($cat_SUCURSAL);

        $cat_SIEMP = DB::table($this->allCatalogs[$cat_id]['destino'])->get();
        $num_reg_SIEMP = count($cat_SIEMP);

        $reg_mayor = ($num_reg_SUCURSAL > $num_reg_SIEMP) ? $num_reg_SUCURSAL : $num_reg_SIEMP;

        Catalogs::where('catalog_id', 17)->delete();


        foreach($cat_SUCURSAL as $registroSUC)
        {
            $registroSIEMP = $cat_SIEMP->where('id', $registroSUC->id)->first();

            if($registroSIEMP == null)
            {
                Catalogs::create([
                    'catalog' => 'cat_product_subs',
                    'catalog_id' => '17',
                    'diference' => 'Registro no encontrado en SIEMP',
                    'register_sucur_id' => $registroSUC->id,
                    'register_siemp_id' => null,
                    'fixed' => 'id'
                ]);
                $count_diferences++;
            }else{
                if($registroSUC->subproducto != $registroSIEMP->subproducto)
                {
                    Catalogs::create([
                        'catalog' => 'cat_product_subs',
                        'catalog_id' => '17',
                        'diference' => $registroSUC->subproducto.' ≠ '.$registroSIEMP->subproducto,
                        'register_sucur_id' => $registroSUC->id,
                        'register_siemp_id' => $registroSIEMP->id,
                        'fixed' => 'subproducto'
                    ]);
                    $count_diferences++;
                }
                if($registroSUC->c_producto_id != $registroSIEMP->cat_producto_id)
                {
                    Catalogs::create([
                        'catalog' => 'cat_product_subs',
                        'catalog_id' => '17',
                        'diference' => $registroSUC->c_producto_id.' ≠ '.$registroSIEMP->cat_producto_id,
                        'register_sucur_id' => $registroSUC->id,
                        'register_siemp_id' => $registroSIEMP->id,
                        'fixed' => 'cat_producto_id'
                    ]);
                    $count_diferences++;
                }
            }
        }

        if($count_diferences == 0)
        {
            Catalogs::create([
                'catalog' => 'cat_product_subs',
                'catalog_id' => '17',
                'diference' => 'Ninguna',
                'register_sucur_id' => null,
                'register_siemp_id' => null,
                'fixed' => 'SINCRONIZADO'
            ]);
        }
    }
    private function compareCotizaProductos($cat_id)
    {
        $count_diferences = 0;

        $cat_SUCURSAL = DB::connection('sucursal')->table($this->allCatalogs[$cat_id]['origen'])->get();
        $num_reg_SUCURSAL = count($cat_SUCURSAL);

        $cat_SIEMP = DB::table($this->allCatalogs[$cat_id]['destino'])->get();
        $num_reg_SIEMP = count($cat_SIEMP);

        $reg_mayor = ($num_reg_SUCURSAL > $num_reg_SIEMP) ? $num_reg_SUCURSAL : $num_reg_SIEMP;

        Catalogs::where('catalog_id', 18)->delete();


        foreach($cat_SUCURSAL as $registroSUC)
        {
            $registroSIEMP = $cat_SIEMP->where('id', $registroSUC->id)->first();

            if($registroSIEMP == null)
            {
                Catalogs::create([
                    'catalog' => 'cat_product_cotizas',
                    'catalog_id' => '18',
                    'diference' => 'Registro '.$registroSUC->id.' no encontrado en BASE SIEMP',
                    'register_sucur_id' => $registroSUC->id,
                    'register_siemp_id' => null,
                    'fixed' => 'id'
                ]);
                $count_diferences++;
            }else{
                if($registroSUC->precio_minimo != $registroSIEMP->precio_min)
                {
                    Catalogs::create([
                        'catalog' => 'cat_product_cotizas',
                        'catalog_id' => '18',
                        'diference' => $registroSUC->precio_minimo.' ≠ '.$registroSIEMP->precio_min,
                        'register_sucur_id' => $registroSUC->id,
                        'register_siemp_id' => $registroSIEMP->id,
                        'fixed' => 'precio_minimo'
                    ]);
                    $count_diferences++;
                }            
                if($registroSUC->precio_maximo != $registroSIEMP->precio_max)
                {
                    Catalogs::create([
                        'catalog' => 'cat_product_cotizas',
                        'catalog_id' => '18',
                        'diference' => $registroSUC->precio_maximo.' ≠ '.$registroSIEMP->precio_max,
                        'register_sucur_id' => $registroSUC->id,
                        'register_siemp_id' => $registroSIEMP->id,
                        'fixed' => 'precio_maximo'
                    ]);
                    $count_diferences++;
                }
                if($registroSUC->c_sub_productos_id != $registroSIEMP->cat_product_sub_id)
                {
                    Catalogs::create([
                        'catalog' => 'cat_product_cotizas',
                        'catalog_id' => '18',
                        'diference' => $registroSUC->c_sub_productos_id.' ≠ '.$registroSIEMP->cat_product_sub_id,
                        'register_sucur_id' => $registroSUC->id,
                        'register_siemp_id' => $registroSIEMP->id,
                        'fixed' => 'c_sub_productos_id'
                    ]);
                    $count_diferences++;
                }
            }
        }
        
        if($count_diferences == 0)
        {
            Catalogs::create([
                'catalog' => 'cat_product_cotizas',
                'catalog_id' => '18',
                'diference' => 'Ninguna',
                'register_sucur_id' => null,
                'register_siemp_id' => null,
                'fixed' => 'SINCRONIZADO'
            ]);
        }
    }
    private function compareTiposPrestamo($cat_id){
        $count_diferences = 0;

        $cat_SUCURSAL = DB::connection('sucursal')->table($this->allCatalogs[$cat_id]['origen'])->get();
        $num_reg_SUCURSAL = count($cat_SUCURSAL);

        $cat_SIEMP = DB::table($this->allCatalogs[$cat_id]['destino'])->get();
        $num_reg_SIEMP = count($cat_SIEMP);

        $reg_mayor = ($num_reg_SUCURSAL > $num_reg_SIEMP) ? $num_reg_SUCURSAL : $num_reg_SIEMP;

        Catalogs::where('catalog_id', 19)->delete();

        foreach($cat_SUCURSAL as $registroSUC)
        {
            $registroSIEMP = $cat_SIEMP->where('id', $registroSUC->clave)->first();

            if($registroSIEMP == null)
            {
                Catalogs::create([
                    'catalog' => 'cat_prestamo_tipos',
                    'catalog_id' => '19',
                    'diference' => 'Registro '.$registroSUC->clave.' no encontrado en BASE SIEMP',
                    'register_sucur_id' => $registroSUC->clave,
                    'register_siemp_id' => null,
                    'fixed' => 'id'
                ]);
                $count_diferences++;
            }else{
                if($registroSUC->ref != $registroSIEMP->ref)
                {
                    Catalogs::create([
                        'catalog' => 'cat_prestamo_tipos',
                        'catalog_id' => '19',
                        'diference' => $registroSUC->ref.' ≠ '.$registroSIEMP->ref,
                        'register_sucur_id' => $registroSUC->clave,
                        'register_siemp_id' => $registroSIEMP->id,
                        'fixed' => 'ref'
                    ]);
                    $count_diferences++;
                }
                if($registroSUC->nombre != $registroSIEMP->nombre)
                {
                    Catalogs::create([
                        'catalog' => 'cat_prestamo_tipos',
                        'catalog_id' => '19',
                        'diference' => $registroSUC->nombre.' ≠ '.$registroSIEMP->nombre,
                        'register_sucur_id' => $registroSUC->clave,
                        'register_siemp_id' => $registroSIEMP->id,
                        'fixed' => 'nombre'
                    ]);
                    $count_diferences++;
                }
                if($registroSUC->c_tipo_producto != $registroSIEMP->tipo_empenio)
                {
                    Catalogs::create([
                        'catalog' => 'cat_prestamo_tipos',
                        'catalog_id' => '19',
                        'diference' => $registroSUC->c_tipo_producto.' ≠ '.$registroSIEMP->tipo_empenio,
                        'register_sucur_id' => $registroSUC->clave,
                        'register_siemp_id' => $registroSIEMP->id,
                        'fixed' => 'c_tipo_producto'
                    ]);
                    $count_diferences++;
                }
                if($registroSUC->interes_semanal != $registroSIEMP->interes_semanal)
                {
                    Catalogs::create([
                        'catalog' => 'cat_prestamo_tipos',
                        'catalog_id' => '19',
                        'diference' => $registroSUC->interes_semanal.' ≠ '.$registroSIEMP->interes_semanal,
                        'register_sucur_id' => $registroSUC->clave,
                        'register_siemp_id' => $registroSIEMP->id,
                        'fixed' => 'interes_semanal'
                    ]);
                    $count_diferences++;
                }
                if($registroSUC->plazos != $registroSIEMP->plazos)
                {
                    Catalogs::create([
                        'catalog' => 'cat_prestamo_tipos',
                        'catalog_id' => '19',
                        'diference' => $registroSUC->plazos.' ≠ '.$registroSIEMP->plazos,
                        'register_sucur_id' => $registroSUC->clave,
                        'register_siemp_id' => $registroSIEMP->id,
                        'fixed' => 'plazos'
                    ]);
                    $count_diferences++;
                }
                if($registroSUC->dias_plazos != $registroSIEMP->dias_plazos)
                {
                    Catalogs::create([
                        'catalog' => 'cat_prestamo_tipos',
                        'catalog_id' => '19',
                        'diference' => $registroSUC->dias_plazos.' ≠ '.$registroSIEMP->dias_plazos,
                        'register_sucur_id' => $registroSUC->clave,
                        'register_siemp_id' => $registroSIEMP->id,
                        'fixed' => 'dias_plazos'
                    ]);
                    $count_diferences++;
                }
                if($registroSUC->dias_gracia != $registroSIEMP->dias_gracia)
                {
                    Catalogs::create([
                        'catalog' => 'cat_prestamo_tipos',
                        'catalog_id' => '19',
                        'diference' => $registroSUC->dias_gracia.' ≠ '.$registroSIEMP->dias_gracia,
                        'register_sucur_id' => $registroSUC->clave,
                        'register_siemp_id' => $registroSIEMP->id,
                        'fixed' => 'dias_gracia'
                    ]);
                    $count_diferences++;
                }
                if($registroSUC->porcentaje_min != $registroSIEMP->porcentaje_min)
                {
                    Catalogs::create([
                        'catalog' => 'cat_prestamo_tipos',
                        'catalog_id' => '19',
                        'diference' => $registroSUC->porcentaje_min.' ≠ '.$registroSIEMP->porcentaje_min,
                        'register_sucur_id' => $registroSUC->clave,
                        'register_siemp_id' => $registroSIEMP->id,
                        'fixed' => 'porcentaje_min'
                    ]);
                    $count_diferences++;
                }
                if($registroSUC->porcentaje_max != $registroSIEMP->porcentaje_max)
                {
                    Catalogs::create([
                        'catalog' => 'cat_prestamo_tipos',
                        'catalog_id' => '19',
                        'diference' => $registroSUC->porcentaje_max.' ≠ '.$registroSIEMP->porcentaje_max,
                        'register_sucur_id' => $registroSUC->clave,
                        'register_siemp_id' => $registroSIEMP->id,
                        'fixed' => 'porcentaje_max'
                    ]);
                    $count_diferences++;
                }
                if($registroSUC->resguardo != $registroSIEMP->resguardo)
                {
                    Catalogs::create([
                        'catalog' => 'cat_prestamo_tipos',
                        'catalog_id' => '19',
                        'diference' => $registroSUC->resguardo.' ≠ '.$registroSIEMP->resguardo,
                        'register_sucur_id' => $registroSUC->clave,
                        'register_siemp_id' => $registroSIEMP->id,
                        'fixed' => 'resguardo'
                    ]);
                    $count_diferences++;
                }
            }
        }
       
        if($count_diferences == 0)
        {
            Catalogs::create([
                'catalog' => 'cat_prestamo_tipos',
                'catalog_id' => '19',
                'diference' => 'Ninguna',
                'register_sucur_id' => null,
                'register_siemp_id' => null,
                'fixed' => 'SINCRONIZADO'
            ]);
        }
    }
    private function compareTiposPrestamoSucursal($cat_id){
        $count_diferences = 0;

        $cat_SUCURSAL = DB::connection('sucursal')->table($this->allCatalogs[$cat_id]['origen'])->get();
        $num_reg_SUCURSAL = count($cat_SUCURSAL);

        $cat_SIEMP = DB::table($this->allCatalogs[$cat_id]['destino'])->get();
        $num_reg_SIEMP = count($cat_SIEMP);

        $reg_mayor = ($num_reg_SUCURSAL > $num_reg_SIEMP) ? $num_reg_SUCURSAL : $num_reg_SIEMP;

        Catalogs::where('catalog_id', 20)->delete();

        foreach($cat_SUCURSAL as $registroSUC)
        {
            $registroSIEMP = $cat_SIEMP->where('id', $registroSUC->id)->first();

            if($registroSIEMP == null)
            {
                Catalogs::create([
                    'catalog' => 'c_tipo_prestamo_sucursal',
                    'catalog_id' => '20',
                    'diference' => 'Registro '.$registroSUC->id.' no encontrado en BASE SIEMP',
                    'register_sucur_id' => $registroSUC->id,
                    'register_siemp_id' => null,
                    'fixed' => 'id'
                ]);
                $count_diferences++;
            }else{
                if($registroSUC->c_tipo_prestamo != $registroSIEMP->cat_prestamo_tipo_id)
                {
                    Catalogs::create([
                        'catalog' => 'c_tipo_prestamo_sucursal',
                        'catalog_id' => '20',
                        'diference' => $registroSUC->c_tipo_prestamo.' ≠ '.$registroSIEMP->cat_prestamo_tipo_id,
                        'register_sucur_id' => $registroSUC->id,
                        'register_siemp_id' => $registroSIEMP->id,
                        'fixed' => 'cat_prestamo_tipo_id'
                    ]);
                    $count_diferences++;
                }
                if($registroSUC->c_sucursal_id != $registroSIEMP->adm_sede_id)
                {
                    Catalogs::create([
                        'catalog' => 'c_tipo_prestamo_sucursal',
                        'catalog_id' => '20',
                        'diference' => $registroSUC->c_sucursal_id.' ≠ '.$registroSIEMP->adm_sede_id,
                        'register_sucur_id' => $registroSUC->id,
                        'register_siemp_id' => $registroSIEMP->id,
                        'fixed' => 'adm_sede_id'
                    ]);
                    $count_diferences++;
                }
            }
        }

        if($count_diferences == 0)
        {
            Catalogs::create([
                'catalog' => 'c_tipo_prestamo_sucursal',
                'catalog_id' => '20',
                'diference' => 'Ninguna',
                'register_sucur_id' => null,
                'register_siemp_id' => null,
                'fixed' => 'SINCRONIZADO'
            ]);
        }

    }
    private function compareStatusEmpenio($cat_id){}
}
