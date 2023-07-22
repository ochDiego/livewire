<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Empleado;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class MostrarEmpleados extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $empleado,$imagen;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '5';
    public $open_edit = false;
    public $identificador;

    protected $listeners = ['render','delete'];

    protected $queryString = [
        'cant' => ['except' => '5'],
        'search' => ['except' => ''],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc']
    ];

    protected $rules = [
        'empleado.nombre' => 'required',
        'empleado.apellido' => 'required',
        'empleado.email' => 'required|email',
        'empleado.fecha_contratacion' => 'required',
        'empleado.cargo' => 'required',
        'imagen' => 'required|image|max:2048',
    ];

    public function mount()
    {
        $this->empleado = new Empleado;
        $this->identificador = rand();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $empleados = Empleado::where('nombre','like','%'. $this->search . '%')
                                ->orWhere('apellido','like','%'. $this->search . '%')
                                ->orWhere('email','like','%'. $this->search . '%')
                                ->orWhere('fecha_contratacion','like','%'. $this->search . '%')
                                ->orWhere('cargo','like','%'. $this->search . '%')
                                ->orderBy($this->sort,$this->direction)
                                ->paginate($this->cant);

        return view('livewire.mostrar-empleados',compact('empleados'));
    }
    
    public function order($sort)
    {
        if($this->sort == $sort){
            if($this->direction == 'desc'){
                $this->direction = 'asc';
            }else{
                $this->direction = 'desc';
            }
        }else{
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function edit(Empleado $empleado)
    {
        $this->empleado = $empleado;
        $this->open_edit = true;
    }

    public function update()
    {
        $this->validate();

        if($this->imagen){
            Storage::delete([$this->empleado->imagen]);
            $this->empleado->imagen = $this->imagen->store('empleados');
        }

        $this->empleado->save();

        $this->reset('open_edit');
        $this->identificador = rand();
        $this->open_edit = false;

        $this->emit('alert','Empleado actualizado satisfactoriamente');
    }

    public function delete(Empleado $empleado)
    {
        Storage::delete([$empleado->imagen]);
        $empleado->delete();
    }
}
