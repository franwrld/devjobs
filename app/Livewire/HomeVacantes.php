<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class HomeVacantes extends Component
{
    public function render()
    {
        // Mandamos a llamar todos los datos del modelo de vacantes y se almacenan en $vacantes
        $vacantes = Vacante::all();
        // Con el arreglo le mandamos a la vista para que pueda acceder
        return view('livewire.home-vacantes',[
            'vacantes' => $vacantes
        ]);
    }
}
