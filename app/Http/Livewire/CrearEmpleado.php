<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Empleado;
use Livewire\WithFileUploads;

class CrearEmpleado extends Component
{
    use WithFileUploads;

    public $nombre,$apellido,$email,$fecha_contratacion,$cargo,$imagen;

    public $open = false;
    public $identificador;

    protected $rules = [
        'nombre' => 'required',
        'apellido' => 'required',
        'email' => 'required|email',
        'fecha_contratacion' => 'required',
        'cargo' => 'required',
        'imagen' => 'required|image|max:2048',
    ];

    public function mount()
    {
        $this->identificador = rand();
    }

    public function render()
    {
        return view('livewire.crear-empleado');
    }

    public function save()
    {
        $this->validate();

        $imagen = $this->imagen->store('empleados');

        Empleado::create([
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'email' => $this->email,
            'fecha_contratacion' => $this->fecha_contratacion,
            'cargo' => $this->cargo,
            'imagen' => $imagen,
        ]);

        $this->reset('nombre','apellido','email','fecha_contratacion','cargo','imagen');
        $this->identificador = rand();
        $this->open = false;

        $this->emitTo('mostrar-empleados','render');
        $this->emit('alert','Empleado registrado satisfactoriamente');
    }

    public function updatingOpen()
    {
        if($this->open == false){
            $this->reset('nombre','apellido','email','fecha_contratacion','cargo','imagen');
            $this->identificador = rand();
        }
    }
}
