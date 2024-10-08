<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <!-- Incluye Tailwind CSS desde CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800  leading-tight">
                @if ($servicio)
                    <div>
                        <p class="text-gray-800 ">
                            {{ __('Crear una nueva cita ') }}
                            <strong>{{ 'de ' }}{{ $servicio }}</strong>
                        </p>
                    </div>
                @endif
            </h2>
        </x-slot>

        @include('fullcalendar.master')
    </x-app-layout>
</body>

</html>
