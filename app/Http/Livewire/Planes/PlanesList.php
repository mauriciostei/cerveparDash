<?php

namespace App\Http\Livewire\Planes;

use App\Models\Planes;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class PlanesList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
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
            'planes' => Planes::orderBy('planes.fecha', 'desc')->paginate(10),
            'files' => $files
        ]);
    }

    public function download(){
        return Storage::disk('local')->download('planes/'.$this->file);
    }
}
