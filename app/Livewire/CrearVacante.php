<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CrearVacante extends Component
{
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    // Permitir subida de archivos featured de livewire
    use WithFileUploads;

    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:2048'
    ];

    public function crearVacante() {
        $datos = $this->validate();
        // Almacenar imagen metodo store de livewire para almacenar en alguna ruta
        // $imagen almacenara la ubicacion de imagen storage/app/public/vacantes/1ie91e1e1rfrrfr3r2rdsgdsdg.png para activar usar php artisan storage:link
        $imagen = $this->imagen->store('vacantes', 'public');
        // solo nos interesa el nombre del archivo.png para ello le quitamos las ruta y solo nos quedamos con el nombre de la imagen
        $datos['imagen'] = str_replace('vacantes/', '', $imagen);

        // dd($imagen);
        // Crear Vacante llamar al modelo
        Vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id' => $datos['salario'],
            'categoria_id' => $datos['categoria'],
            'empresa' => $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $datos['imagen'],
            'user_id' => auth()->user()->id
        ]);
        // Crear un mensaje
        session()->flash('mensaje', 'La Vacante se publico correctamente');
        // Redireccionar al usuario
        return redirect()->route('vacantes.index');
    }


    public function render()
    {
        // Consultar BD
        $salarios = Salario::all();
        $categorias = Categoria::all();
        return view('livewire.crear-vacante', [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
