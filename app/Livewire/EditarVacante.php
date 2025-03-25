<?php

namespace App\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Vacante;
use Illuminate\Support\Carbon;

class EditarVacante extends Component
{
    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    // Validaciones
    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required'
    ];

    // Mostrar en editar
    public function mount(Vacante $vacante)
    {
        // id es reservada para livewire por lo tanto renombrar el id
        // INTERNO - BASE DE DATOS
        $this->vacante_id = $vacante->id;
        // string
        $this->titulo = $vacante->titulo;
        //Select
        $this->salario = $vacante->salario_id;
        // Select
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;
        // Fecha Formateando con Carbon
        $this->ultimo_dia = Carbon::parse( $vacante->ultimo_dia )->format('Y-m-d');
        // string
        $this->descripcion = $vacante->descripcion;
        // imagen
        $this->imagen = $vacante->imagen;
    }

    

    public function editarVacante()
    {
        $datos = $this->validate();

        // Si hay nueva imagen

        // Encontrar la vacante a editar
        $vacante = Vacante::find($this->vacante_id);

        // Asignar valores reescribiendo datos
        // BD - Datos
        $vacante->titulo = $datos['titulo'];
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
        $vacante->ultimo_dia = $datos['ultimo_dia'];
        $vacante->descripcion = $datos['descripcion'];
        // Guardar vacante
        $vacante->save();
        // Redireccionar y crear mensaje
        session()->flash('mensaje', 'La Vacante se actualizo correctamente');
        return redirect()->route('vacantes.index');
    }

    public function render()
    {
        // Consultar BD
        $salarios = Salario::all();
        $categorias = Categoria::all();
        return view('livewire.editar-vacante', [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
