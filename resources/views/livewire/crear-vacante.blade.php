<form action="" class="md:w-1/2 space-y-5" enctype="multipart/form-data" wire:submit.prevent='crearVacante'>
    <!--  -->
    <div>
        <x-input-label for="titulo" :value="__('Titulo Vacante')" />
        <x-text-input id="titulo" class="block mt-1 w-full" type="text" wire:model="titulo" :value="old('titulo')" placeholder="Escribe el nombre de la vacante"/>
        <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
    </div>
    <!--  -->
    <div>
        <x-input-label for="salario" :value="__('Salario')" />
        <select wire:model="salario" id="salario" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
            <option value="">-- Seleccione --</option>
            @foreach ($salarios as $salario)
                <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('salario')" class="mt-2" />
    </div>
    <!--  -->
    <div>
        <x-input-label for="categoria" :value="__('Categoria')" />
        <select wire:model="categoria" id="categoria" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
            <option value="">-- Seleccione --</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
    </div>
    <!--  -->
    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa" :value="old('empresa')" placeholder="Escribe el nombre de la empresa"/>
        <x-input-error :messages="$errors->get('empresa')" class="mt-2" />
    </div>

    <!--  -->
    <div>
        <x-input-label for="ultimo_dia" :value="__('Ultimo Dia para postularse')" />
        <x-text-input id="ultimo_dia" class="block mt-1 w-full" type="date" wire:model="ultimo_dia" :value="old('ultimo_dia')" />
        <x-input-error :messages="$errors->get('ultimo_dia')" class="mt-2" />
    </div>

    <!--  -->
    <div>
        <x-input-label for="descripcion" :value="__('Descripcion del puesto')" />
        <textarea wire:model="descripcion" id="descripcion" cols="30" rows="10" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">

        </textarea>
        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
    </div>
    <!--  -->
    <div>
        <x-input-label for="imagen" :value="__('Imagen')" />
        <x-text-input id="imagen" class="block mt-1 w-full" type="file" wire:model="imagen" accept="image/*"/>
        {{-- two way data binding / envias datos al servidor y recibir respuesta en el frontend soportado por livewire --}}
        <div class="my-5 w-80">
            @if ($imagen)
                Imagen:
                <img src="{{ $imagen->temporaryUrl() }}" alt="">
            @endif
        </div>
        <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
    </div>

    <x-primary-button class="w-full justify-center">
        {{ __('Crear Vacante') }}
    </x-primary-button>
</form>