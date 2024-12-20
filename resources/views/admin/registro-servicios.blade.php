<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Servicios</title>
    <!-- Incluye Tailwind CSS desde CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Incluye SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Registro de Servicios') }}
            </h2>
        </x-slot>

        <div class="py-12 flex justify-center">
            <div class="max-w-lg w-full sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form id="serviceForm" method="POST" action="{{ route('admin.registro-servicios') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Agregar imagen del servicio -->
                        <div>
                            <x-input-label for="imagen" :value="__('Imagen del servicio*')" />
                            <input id="imagen" class="block mt-1 w-full" type="file" name="imagen"
                                accept="image/*" autofocus autocomplete="imagen" />
                            <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
                        </div>
                        <!-- Nombre del servicio -->
                        <div>
                            <x-input-label for="nombre" :value="__('Nombre del servicio*')" />
                            <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre"
                                :value="old('nombre')" required autofocus autocomplete="nombre" />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>

                        <!-- Descripción -->
                        <div class="mt-4">
                            <x-input-label for="descripcion" :value="__('Descripción')" />
                            <textarea id="descripcion" class="block mt-1 w-full" name="descripcion" autocomplete="descripcion">{{ old('descripcion') }}</textarea>
                            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                        </div>

                        <!-- Precio -->
                        <div class="mt-4">
                            <x-input-label for="precio" :value="__('Precio en pesos mexicanos*')" />
                            <x-text-input id="precio" class="block mt-1 w-full" type="text" name="precio"
                                :value="old('precio')" required autocomplete="precio" />
                            <x-input-error :messages="$errors->get('precio')" class="mt-2" />
                        </div>

                        <!-- Médicos que ofrecen dicho servicio -->
                        <div class="mt-4">
                            <x-input-label for="medico_id" :value="__('Médico que puede ofrecer este servicio*')" />
                            <select id="medico_id" class="block mt-1 w-full" name="medico_id" required>
                                <option value="">Seleccione un médico</option>
                                @foreach ($medicos as $medico)
                                    <option value="{{ $medico->id }}"
                                        {{ old('medico_id') == $medico->id ? 'selected' : '' }}>
                                        {{ $medico->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('medico_id')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-center mt-4">
                            <x-primary-button type="submit" class="ms-4">
                                {{ __('Registrar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Script para mostrar el mensaje de éxito -->
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: "¡Registro Completado!",
                        text: "{{ session('success') }}",
                        icon: "success"
                    });
                });
            </script>
        @endif
    </x-app-layout>
</body>

</html>
