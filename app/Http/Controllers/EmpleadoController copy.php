<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Http;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     // // //Prueba conectar a Api y colocarla en index
    //     // // $url = 'https://api.exchangerate-api.com/v4/latest/USD';

    //     // // // Realizar la solicitud a la API y obtener la respuesta
    //     // // $response = file_get_contents($url);

    //     // // // Decodificar la respuesta JSON
    //     // // $data = json_decode($response);

    //     // // Pasar los datos a la vista
    //     // // return view('cambio-moneda', [
    //     // //     'rates' => $data->rates,
    //     // //     'base' => $data->base,

    //     // //---------------original--------
    //     // $datos['empleados']=Empleado::paginate(10);

    //     // return view('empleado.index', $datos);

    //     // //return view('empleado.index', $datos, ['rates' => $data->rates, 'base' => $data->base]);

    //     //----------------Prueba api clima

    //     $datos['empleados'] = Empleado::paginate(10);

    //     // Obtener datos del clima (ejemplo usando OpenWeatherMap)
    //     $apiKey = 'aa376e80dd3e83329d9e1de72aad8039';
    //     $city = 'Buenos Aires,AR';
    //     $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

    //     try {
    //         // Realizar la solicitud a la API
    //         $response = Http::get($url);

    //         // Obtener los datos de la respuesta JSON
    //         $data = $response->json();

    //         // Agregar los datos del clima al array $datos para pasar a la vista
    //         $datos['clima'] = [
    //             'ciudad' => $data['name'],
    //             'temperatura' => $data['main']['temp'],
    //             'descripcion' => $data['weather'][0]['description'],
    //         ];

    //     } catch (\Exception $e) {
    //         // Manejar errores aquí
    //         $datos['clima'] = null;
    //         // Opcional: registrar el error para depuración
    //         \Log::error('Error al obtener datos del clima: ' . $e->getMessage());
    //     }

    //     return view('empleado.index', $datos);
    // }
    public function index()
    {
        $datos['empleados'] = Empleado::paginate(10);

        // Obtener datos del clima usando OpenWeatherMap
        $apiKey = 'aa376e80dd3e83329d9e1de72aad8039';
        $city = 'Buenos Aires,AR';
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

        try {
            // Realizar la solicitud a la API
            $response = Http::get($url);
        
            // Obtener los datos de la respuesta JSON
            $data = $response->json();

            //dd($data);
        
            // Asignar los datos del clima al array $datos para pasar a la vista
            $datos['clima'] = [
                'ciudad' => $data['name'],
                'temperatura' => $data['main']['temp'],
                'descripcion' => $data['weather'][0]['description'],
            ];
        } catch (\Exception $e) {
            // Manejar errores aquí
            $datos['clima'] = null;
            // Opcional: registrar el error para depuración
            \Log::error('Error al obtener datos del clima: ' . $e->getMessage());
        }

        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Apellido'=>'required|string|max:100',
            'DNI'=>'required|integer',
            'Foto'=>'required|max:10000|mimes:jpg,png,jpeg,webp'
            // 'mail'=>'required|email'
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto es requerida'
        ];

        $this->validate($request,$campos,$mensaje);

        //
        $datoEmpleado=request()->except('_token');
        if ($request->hasFile('Foto')){
            $datoEmpleado['Foto']=$request->file('Foto')->store('uploads', 'public');
        }
        Empleado::insert($datoEmpleado);
        return redirect('empleado')->with('messaje','Empleado agregado');

    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $empleado=Empleado::findOrFail($id);
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
                //
                $campos=[
                    'Nombre'=>'required|string|max:100',
                    'Apellido'=>'required|string|max:100',
                    'DNI'=>'required|integer',
                    
                    // 'mail'=>'required|email'
                ];
        
                $mensaje=[
                    'required'=>'El :attribute es requerido',
                    
                ];

                if ($request->hasFile('Foto')){
                    $campos=['Foto'=>'required|max:10000|mimes:jpg,png,jpeg,webp'];
                    $mensaje=['Foto.required'=>'La foto es requerida'];
                };
        
                $this->validate($request,$campos,$mensaje);
        
                
        //
        $datoEmpleado=request()->except(['_token', '_method']);

        if ($request->hasFile('Foto')){
            $empleado=Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->Foto);
            $datoEmpleado['Foto']=$request->file('Foto')->store('uploads', 'public');
        }

        Empleado::where('id','=',$id)->update($datoEmpleado);
        return redirect('empleado')->with('messaje','Empleado actualizado');

        // $empleado=Empleado::findOrFail($id);
        // return view('empleado.edit', compact('empleado'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $empleado=Empleado::findOrFail($id);

        if (Storage::delete('public/'.$empleado->Foto)){
            Empleado::destroy($id);
        }
        
        return redirect('empleado')->with('messaje','Empleado borrado');
    }
}
