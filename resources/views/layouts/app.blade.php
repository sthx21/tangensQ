<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'jlh') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sc.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="{{asset('css/fullCal.min.css')}}" />

    {{--MATERIAL  DESIGN FOR BOOTSTRAP  --}}
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    {{--MATERIAL  DESIGN FOR BOOTSTRAP  --}}

    <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/googlefontscss2.css') }}" rel="stylesheet">

    <link href="{{asset('css/shdw-main.css')}}" rel="stylesheet">
    <link href="{{asset('css/shdw-tabs.css')}}" rel="stylesheet">

    @livewireStyles


{{--    <script src="{{ asset('js/moment-with-locales.js') }}"></script>--}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-toggle.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{asset('js/fullCal.min.js')}}"></script>
    <script src='https://cdn.jsdelivr.net/npm/moment@2.27.0/min/moment.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/moment@5.5.0/main.global.min.js'></script>
    <script src="{{asset('js/calender.locals.de.js')}}"></script>



    <script src="{{ asset('js/select2.full.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
{{--    <script src="{{ asset('js/vfs_fonts.js') }}"></script>--}}
{{--    <script src="{{ asset('js/shdw/swal.confirmDelete.js') }}"></script>--}}
    @livewire('livewire-ui-modal')
    @bukStyles

</head>
<body class="font-sans antialiased">
@include('layouts.navigation')
<livewire:workshops.cancel-workshop/>
<livewire:workshops.reactivate-workshop/>
<livewire:events.create-event/>


<!-- Page Heading -->
    <header class="bg-dark shadow pt-md-2 d-flex justify-content-end align-items-start" style="height: 160px; z-index: 9999;">
        <button name="createReminder" class="createReminderButton" onclick="Livewire.emit('openModal', 'reminders.create-reminder')"> Neue Errinerung</button>
<livewire:reminders.show-reminders/>
        {{ $header }}


    </header>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>


@bukScripts
@include('sweetalert::alert')
<script src="{{ asset('js/mdb.min.js') }}"></script>

<script>
    window.addEventListener('swal',function(e){
        Swal.fire(e.detail);
    });


</script>
@livewireScripts
@livewireCalendarScripts
</body>

</html>
