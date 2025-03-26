<div class="p-10">
    <div class="mb-5">

        <h3 class="font-bold text-3xl text-gray-800 my-3">
            {{ $vacante->titulo }}
        </h3>
        {{-- grid-cols-2 para crear 2 espacios o columnas y si hay mas se colocan abajo --}}
        <div class="md:grid md:grid-cols-2 bg-gray-50 p-4">
            <p class="font-bold text-sm uppercase text-gray-800 my-3">
                Empresa: <span class="normal-case font-normal">{{ $vacante->empresa }}</span>
            </p>
            {{-- toFormattedDateString para mostrar fecha formateada asi: Apr 5, 2025 --}}
            <p class="font-bold text-sm uppercase text-gray-800 my-3">
                Ultimo dia para postularse: <span class="normal-case font-normal">{{ $vacante->ultimo_dia->toFormattedDateString() }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">
                {{-- $variable -> tabla en BD -> nombre de la columna desde Modelo Vacante --}}
                Categoria: <span class="normal-case font-normal">{{ $vacante->categoria->categoria }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">
                {{-- $variable -> tabla en BD -> nombre de la columna desde Modelo Vacante --}}
                Salario: <span class="normal-case font-normal">{{ $vacante->salario->salario }}</span>
            </p>
        </div>

    </div>
    {{-- IMAGEN y DESCRIPCION --}}
    {{-- cols-6 para crear 6 columnas --}}
    <div class="md:grid md:grid-cols-6 gap-6">
        {{-- span para que tome 2 espacios/columnas de 6 que asignamos arriba --}}
        <div class="md:col-span-2">
            <img src="{{ asset('storage/vacantes/' . $vacante->imagen) }}" alt="{{ 'Imagen Vacante' . $vacante->titulo }}">
        </div>
        {{-- span para que tome 4 espacios/columnas para completar los 6 espacios o columnas del div padre --}}
        <div class="md:col-span-4">
            <h2 class="text-2xl font-bold mb-5">
                Descripción del Puesto
            </h2>
            <p>
                {{ $vacante->descripcion }}
            </p>
        </div>
    </div>

    {{-- Usuarios no autenticados --}}
    @guest
        <div class="mt-5 bg-gray-50 border border-dashed p-5 text-center">
            <p>
                ¿Deseas aplicar a esta vacante? <a class="font-bold text-indigo-600" href="{{ route('register') }}">Obten una cuenta y aplica a esta y otras vacantes</a>
            </p>
        </div>
    @endguest
    
</div>
