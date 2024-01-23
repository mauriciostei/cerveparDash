<?php

namespace App\Http\Livewire\Planes;

use App\Models\Planes;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class PlanesList extends Component
{
    public $file;

    protected function rules(){
        return ['planificaciones_file' => ''];
    }

    public function render()
    {
        $files = scandir(storage_path('app/planes'));
        array_shift($files);
        array_shift($files);

        return view('livewire.planes.planes-list', [
            'planes' => Planes::orderBy('planes.fecha', 'desc')->limit(10)->get(),
            'files' => $files
        ]);
    }

    public function download(){
        return Storage::disk('local')->download('planes/'.$this->file);
    }
}
