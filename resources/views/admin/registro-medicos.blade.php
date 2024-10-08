<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Medicos</title>
    <!-- Incluye Tailwind CSS desde CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Incluye SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800  leading-tight">
                {{ __('Registro Médicos') }}
            </h2>
        </x-slot>

        <div class="py-12 flex justify-center">
            <div class="max-w-lg w-full sm:px-6 lg:px-8">
                <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form method="POST" action="{{ route('admin.registro-medicos') }}">
                        @csrf
                        <!-- Nombre -->
                        <div>
                            <x-input-label for="nombre" :value="__('Nombre(s)*')" />
                            <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre"
                                :value="old('nombre')" required autofocus autocomplete="nombre" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Apellidos -->
                        <div class="mt-4">
                            <x-input-label for="apellido" :value="__('Apellidos*')" />
                            <x-text-input id="apellido" class="block mt-1 w-full" type="text" name="apellido"
                                :value="old('apellidos')" required autocomplete="apellido" />
                            <x-input-error :messages="$errors->get('apellidos')" class="mt-2" />
                        </div>

                        <!-- Fecha de nacimiento -->
                        <div class="mt-4">
                            <x-input-label for="fecha_nacimiento" :value="__('Fecha de nacimiento*')" />
                            <x-text-input id="fecha_nacimiento" class="block mt-1 w-full" type="date"
                                name="fecha_nacimiento" :value="old('fecha_nacimiento')" required autocomplete="fecha_nacimiento" />
                            <x-input-error :messages="$errors->get('fecha_nacimiento')" class="mt-2" />
                        </div>

                        <!-- Teléfono -->
                        <div class="mt-4">
                            <x-input-label for="telefono" :value="__('Teléfono*')" />
                            <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono"
                                :value="old('telefono')" required autocomplete="telefono" />
                            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email*')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Contraseña')" />

                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Rol -->
                        <div class="mt-4">
                            <x-input-label for="role" :value="__('Rol*')" />
                            <select id="role" name="role"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-white text-gray-900">
                                <option value="Médico">{{ __('Médico') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <!-- Profesión -->
                        <div class="mt-4">
                            <x-input-label for="profesion" :value="__('Profesión*')" />
                            <x-text-input id="profesion" class="block mt-1 w-full" type="text" name="profesion"
                                :value="old('profesion')" required autocomplete="profesion" />
                            <x-input-error :messages="$errors->get('profesion')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-center mt-4">
                            <x-primary-button type="submit">
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
