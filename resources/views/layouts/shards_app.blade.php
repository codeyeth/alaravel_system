<!doctype html>
<html class="no-js h-100" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name')}}</title>
    <meta name="description" content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    {{-- CDN --}}
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    {{-- <link href="{{ asset('shards_template/from_cdn/fontawesome_all.css') }}" rel="stylesheet"> --}}
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- <link href="{{ asset('shards_template/from_cdn/material_icons.css') }}" rel="stylesheet"> --}}
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="{{ asset('shards_template/from_cdn/bootstrap.min.css') }}" > --}}
    
    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="{{ asset('shards_template/styles/shards-dashboards.1.1.0.min.css') }}">
    <link rel="stylesheet" href="{{ asset('shards_template/styles/extras.1.1.0.min.css') }}">
    
    {{-- CDN --}}
    {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}
    
    
    {{-- DATE PICKER FILES --}}
    <script src="{{ asset ('shards_template/scripts/ajax_jquery.min.js') }}"></script>
    
    <link href="{{ asset('shards_template/bootstrap_datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" media="screen">
    <script type="text/javascript" src="{{ asset('shards_template/bootstrap_datepicker/js/bootstrap-datepicker.js') }}"></script>
    
    @livewireStyles
</head>

<body class="h-100">
    {{-- @include('inc.floating_settings') --}}
    
    <div class="container-fluid">
        <div class="row">
            @include('inc.sidebar')
            
            <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
                <div class="main-navbar sticky-top bg-white">
                    @include('inc.navbar')
                </div>
                
                @include('inc.message')
                
                <div class="main-content-container container-fluid px-4">
                    
                    @include('inc.page_header')
                    
                    <style scoped>
                        .requiredTag{
                            color: red;
                        }
                        @media (min-width: 768px) {
                            .modal-xl {
                                width: 90%;
                                max-width:1200px;
                            }
                        }
                        hr.hr_dashed {
                            /* border-top: 3px dashed #007bff; */
                            border-top: 3px dashed #868e96;
                        }
                        hr.hr_thick {
                            border: 1px solid #868e96;
                        }
                        
                        input { 
                            text-transform: uppercase;
                        }
                        ::-webkit-input-placeholder { /* WebKit browsers */
                            text-transform: none;
                        }
                        
                    </style>
                    
                    @yield('content')
                </div>
                
                @include('inc.footer')
            </main>
        </div>
    </div>
    
    {{-- @include('inc.footer_popup') --}}
    @livewireScripts
    
    {{-- USER MANAGEMENT --}}
    @include('livewire.rr-livewire-script.rr-user-management-script')
    
    {{-- COMPOSING SYSTEM --}}
    @include('livewire.rr-livewire-script.rr-composing-system-script')
    
    {{-- SMD SYSTEM --}}
    @include('livewire.rr-livewire-script.rr-smd-system-script')
    
    {{-- BALLOT TRACKING--}}
    @include('livewire.rr-livewire-script.rr-ballot-tracking-script-reprints-module')
    @if ( $sidebar == 'Ballot Tracking')
    @include('livewire.rr-livewire-script.rr-ballot-tracking-clear-search-script')
    @endif    
    
    {{-- CDN --}}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('shards_template/from_cdn/jquery-3.3.1.min.js') }}"></script> --}}
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('shards_template/from_cdn/popper.min.js') }}"></script> --}}
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('shards_template/from_cdn/bootstrap.min.js') }}"></script> --}}
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    {{-- <script src="{{ asset('shards_template/from_cdn/Chart.min.js') }}"></script> --}}
    
    {{-- <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script> --}}
    <script src="{{ asset('shards_template/from_cdn/shards.min.js') }}"></script>
    
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script> --}}
    <script src="{{ asset('shards_template/from_cdn/jquery.sharrre.min.js') }}"></script>
    
    <script src="{{ asset('shards_template/scripts/extras.1.1.0.min.js') }}"></script>
    <script src="{{ asset('shards_template/scripts/shards-dashboards.1.1.0.min.js') }}"></script>
    {{-- <script src="{{ asset('shards_template/scripts/app/app-blog-overview.1.1.0.js') }}"></script> --}}
    
</body>
</html>
