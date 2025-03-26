<?php

namespace App\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    use WithFileUploads;
    public $cv;
    public $vacante;

    // Validaciones
    protected $rules = [
        'cv' => 'required|mimes:pdf',
    ];

    // Mostrar en editar
    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    public function postularme()
    {
        // Llamar las reglas de validacion en $rules definidas arriba
        $datos = $this->validate();
        // Almacenar PDF o CV metodo store de livewire para almacenar
        // $imagen almacenara la ubicacion de imagen storage/app/public/vacantes/cvname.PDF para activar usar php artisan storage:link
        $cv = $this->cv->store('cv', 'public');
        // solo nos interesa el nombre del archivo.pdf para ello le quitamos las ruta y solo nos quedamos con el nombre del archivo
        $datos['cv'] = str_replace('cv/', '', $cv);

        // Guardar/ Crear candidato a la vacante
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv' => $datos['cv']
        ]);

        // Crear noti y enviar email
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id ));
        
        // Crear un mensaje y redireccionar
        session()->flash('mensaje', 'Se envio tu curriculum correctamente, Mucha suerte!');
        return redirect()->back();


    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
