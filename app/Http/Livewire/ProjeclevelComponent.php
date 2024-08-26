<?php

namespace App\Http\Livewire;
use App\Models\ProjectUser;
use App\Models\User;
use App\Models\Level;

use Livewire\Component;

class ProjeclevelComponent extends Component
{

    public $selectProject = null, $selectNivel = null;
    public $proyectos = null, $niveles = null;

    public function render()
    {
        return view('livewire.select-anidado', [
            "proyectos" => ProjectUser::all()
            //"leves" => Level::all()
        ]);  
    }
}
