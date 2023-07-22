<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Empleados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-table>

                <div class="px-6 py-4 border-b">
                    <a href="{{route('export')}}">
                        EXPORTAR
                    </a>
                </div>

                <div class="px-6 py-4 flex items-center">

                    <div class="flex items-center">
                        <span>Mostrar</span>

                        <select wire:model="cant" class="mr-3 ml-3 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>

                        <span>entradas</span>
                    </div>

                    <x-input type="text" class="flex-1 mr-3 ml-3" wire:model="search" />

                   @can('empleados.create')
                        @livewire('crear-empleado')
                   @endcan
                </div>

                @if($empleados->count())

                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th wire:click="order('id')" class="p-2 whitespace-nowrap cursor-pointer">
                                    <div class="font-semibold text-left">ID</div>
                                </th>
                                <th wire:click="order('nombre')" class="p-2 whitespace-nowrap cursor-pointer">
                                    <div class="font-semibold text-left">Nombre</div>
                                </th>
                                <th class="p-2 whitespace-nowrap cursor-pointer">
                                    <div class="font-semibold text-left">Imagen</div>
                                </th>
                                <th wire:click="order('email')" class="p-2 whitespace-nowrap cursor-pointer">
                                    <div class="font-semibold text-left">Email</div>
                                </th>
                                <th wire:click="order('cargo')" class="p-2 whitespace-nowrap cursor-pointer">
                                    <div class="font-semibold text-left">Cargo</div>
                                </th>
                                <th wire:click="order('fecha_contratacion')" class="p-2 whitespace-nowrap cursor-pointer">
                                    <div class="font-semibold text-left">Fecha de contratación</div>
                                </th>
                                <th class="p-2 whitespace-nowrap" colspan="2">
                                    <div class="font-semibold text-center"></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @foreach($empleados as $item)
                                <tr>
                                    <td class="p-2 whitespace-nowrap border-b">
                                        <div class="flex items-center">
                                            <div class="font-medium text-gray-800">{{$item->id}}</div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap border-b">
                                        <div class="text-left">{{$item->nombre}} {{$item->apellido}}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap border-b">
                                        <a href="{{asset('storage/' . $item->imagen)}}" target="_BLANK">
                                            <img src="{{asset('storage/' . $item->imagen)}}" class="w-12 h-12 object-cover object-center rounded-full">
                                        </a>
                                    </td>
                                    <td class="p-2 whitespace-nowrap border-b">
                                        <div class="text-left">{{$item->email}}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap border-b">
                                        <div class="text-left">{{$item->cargo}}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap border-b">
                                        <div class="text-left">{{$item->fecha_contratacion}}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap border-b">
                                        <div class="text-left">
                                            @can('empleados.edit')
                                                <a wire:click="edit({{$item}})" class="cursor-pointer">
                                                    Editar
                                                </a>
                                            @endcan
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap border-b">
                                        <div class="text-left">
                                            @can('empleados.delete')
                                                <a wire:click="$emit('eliminarEmpleado',{{$item->id}})" class="cursor-pointer">
                                                    Eliminar
                                                </a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @else

                    <div class="px-6 py-4">
                        No hay registros coincidentes
                    </div>

                @endif

                @if ($empleados->hasPages())
                    <div class="px-6 py-4">
                        {{$empleados->links()}}
                    </div>
                @endif
            </x-table>


        </div>
    </div>


    <x-dialog-modal wire:model="open_edit">

        <x-slot name="title">
            Actualizar empleado
        </x-slot>

        <x-slot name="content">

              @if ($imagen)
                  <img class="mb-4" src="{{$imagen->temporaryUrl()}}" alt="">
              @else 
                <img class="mb-4" src="{{asset('storage/' . $empleado->imagen)}}" alt="">
              @endif


            <div class="mb-4">
                <x-label value="Nombre del empleado:" />
                <x-input wire:model.defer="empleado.nombre" type="text" class="w-full" />

                <x-input-error for="empleado.nombre" />
            </div>

            <div class="mb-4">
                <x-label value="Apellido del empleado:" />
                <x-input wire:model.defer="empleado.apellido" type="text" class="w-full" />

                <x-input-error for="empleado.apellido" />
            </div>

            <div class="mb-4">
                <x-label value="Email del empleado:" />
                <x-input wire:model.defer="empleado.email" type="text" class="w-full" />

                <x-input-error for="empleado.email" />
            </div>

            <div class="mb-4">
                <x-label value="Fecha de contratación:" />
                <input wire:model.defer="empleado.fecha_contratacion" type="date" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">

                <x-input-error for="empleado.fecha_contratacion" />
            </div>

            <div class="mb-4">
                <x-label value="Cargo:" />
                <x-input wire:model.defer="empleado.cargo" type="text" class="w-full" />

                <x-input-error for="empleado.cargo" />
            </div>

            <div class="mb-4">
                <x-label value="Imagen:" />
                <input wire:model="imagen" type="file" id="{{$identificador}}">

                <x-input-error for="imagen" />
            </div>
        </x-slot>

        <x-slot name="footer">

            <x-secondary-button class="mr-3" wire:click="$set('open_edit', false)">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update,imagen" class="disabled:opacity-25">
                Actualizar
            </x-danger-button>

        </x-slot>
    </x-dialog-modal>
</div>
