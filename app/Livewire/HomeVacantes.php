<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class HomeVacantes extends Component
{
    // Terminos de busqueda para poder usarlos en el render
    public $termino;
    public $categoria;
    public $salario;
    // Escucha por terminosBusqueda y cuando escuche llame a buscar
    protected $listeners = ['terminosBusqueda' => 'buscar'];

    public function buscar($termino, $categoria, $salario)
    {
        $this->termino = $termino;
        $this->categoria = $categoria;
        $this->salario = $salario;
    }

    public function render()
    {
        
        // Mandamos a llamar todos los datos del modelo de vacantes y se almacenan en $vacantes
        // $vacantes = Vacante::all();
        // Con % le decimos si el termino esta al inicio o al final no importa mientras tenga el termino de busqueda lo va a encontrar
        // when se ejecuta solo si hay un termino escrito function(query) es el callback
        $vacantes = Vacante::when($this->termino, function($query) {
            $query->where('titulo', 'LIKE', "%" . $this->termino . "%");
        })
        ->when($this->termino, function($query) {
            $query->orWhere('empresa', 'LIKE', "%" . $this->termino . "%");
        })
        ->when($this->categoria, function($query) {
            $query->where('categoria_id', $this->categoria);
        })
        ->when($this->salario, function($query) {
            $query->where('salario_id', $this->salario);
        })->paginate(15);

        // Con el arreglo le mandamos a la vista para que pueda acceder
        return view('livewire.home-vacantes',[
            'vacantes' => $vacantes
        ]);
    }
}
