<div>
    <x-danger-button wire:click="$set('open', true)">
        Nuevo empleado
    </x-danger-button>

    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            Registrar empleado
        </x-slot>

        <x-slot name="content">

            <div wire:loading wire:target="imagen" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative w-full mb-4" role="alert">
                <strong class="font-bold">Subiendo imagen!</strong>
                <span class="block sm:inline">Espera un momento hasta que la imagen se haya procesado.</span>
                </span>
              </div>

              @if ($imagen)
                  <img class="mb-4" src="{{$imagen->temporaryUrl()}}" alt="">
              @endif


            <div class="mb-4">
                <x-label value="Nombre del empleado:" />
                <x-input wire:model.defer="nombre" type="text" class="w-full" />

                <x-input-error for="nombre" />
            </div>

            <div class="mb-4">
                <x-label value="Apellido del empleado:" />
                <x-input wire:model.defer="apellido" type="text" class="w-full" />

                <x-input-error for="apellido" />
            </div>

            <div class="mb-4">
                <x-label value="Email del empleado:" />
                <x-input wire:model.defer="email" type="text" class="w-full" />

                <x-input-error for="email" />
            </div>

            <div class="mb-4">
                <x-label value="Fecha de contratación:" />
                <input wire:model.defer="fecha_contratacion" type="date" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">

                <x-input-error for="fecha_contratacion" />
            </div>

            <div class="mb-4">
                <x-label value="Cargo:" />
                <x-input wire:model.defer="cargo" type="text" class="w-full" />

                <x-input-error for="cargo" />
            </div>

            <div class="mb-4">
                <x-label value="Imagen:" />
                <input wire:model="imagen" type="file" id="{{$identificador}}">

                <x-input-error for="imagen" />
            </div>
        </x-slot>

        <x-slot name="footer">

            <x-secondary-button class="mr-3" wire:click="$set('open', false)">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save,imagen" class="disabled:opacity-25">
                Registrar
            </x-danger-button>

        </x-slot>
    </x-dialog-modal>
</div>
