<!doctype html>
<html class="no-js h-100" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name')}}</title>
    <meta name="description" content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="{{ asset('shards_template/styles/shards-dashboards.1.1.0.min.css') }}">
    <link rel="stylesheet" href="{{ asset('shards_template/styles/extras.1.1.0.min.css') }}">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</head>

<body class="h-100">
    
    <div class="container-fluid">
        <div class="row">
            
            <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
                <div class="main-navbar sticky-top bg-white">
                </div>
                
                <br>
                <br>
                <br>
                
                <div class="main-content-container container-fluid px-4">
                    <div class="page-header row no-gutters py-4">
                        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                            <span class="text-uppercase page-subtitle">{{ config('app.name')}}</span>
                            <h3 class="page-title">LOGIN PAGE</h3>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        
                        <div class="col-lg-3 col-md-12 col-sm-12 mb-4" hidden>
                            <div class="card card-small">
                                <div class="card-header border-bottom">
                                    <h6 class="m-0">Active Users on System</h6>
                                </div>
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-small list-group-flush">
                                        <li class="list-group-item d-flex px-3">
                                            <span class="text-semibold text-fiord-blue">ROYETH</span>
                                            <span class="ml-auto text-right text-semibold text-reagent-gray">ON COMPOSING SYSTEM</span>
                                        </li>
                                        <li class="list-group-item d-flex px-3">
                                            <span class="text-semibold text-fiord-blue">JUNIE</span>
                                            <span class="ml-auto text-right text-semibold text-reagent-gray">ON SMD SYSTEM</span>
                                        </li>
                                        <li class="list-group-item d-flex px-3">
                                            <span class="text-semibold text-fiord-blue">SIR NOEL</span>
                                            <span class="ml-auto text-right text-semibold text-reagent-gray">ON USER MANAGEMENT</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer border-top">
                                    <div class="row">
                                        <div class="col">
                                            {{-- <select class="custom-select custom-select-sm">
                                                <option selected="">Last Week</option>
                                                <option value="1">Today</option>
                                                <option value="2">Last Month</option>
                                                <option value="3">Last Year</option>
                                            </select> --}}
                                        </div>
                                        <div class="col text-right view-report">
                                            {{-- <a href="#">Full report →</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                
                                <div class="card card-small mb-4">
                                    <div class="card-header border-bottom">
                                        <h6 class="m-0">Enter your Credentials</h6>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-3">
                                            <form>
                                                
                                                <div class="input-group mb-3">
                                                    <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email here" value="{{ old('email') }}" required autofocus>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">@npo.org</span>
                                                    </div>
                                                    
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    
                                                </div>
                                                
                                                <div class="input-group mb-3">
                                                    <div class="input-group input-group-seamless">
                                                        <input id="password" name="password" type="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Enter Password here" required>
                                                        <span class="input-group-append"> 
                                                            <span class="input-group-text">
                                                                <i class="material-icons">lock</i>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                
                                                <div class="custom-control custom-checkbox mb-1">
                                                    <input type="checkbox" class="custom-control-input" id="formsCheckboxChecked" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="formsCheckboxChecked">Remember Me</label>
                                                </div>                                            
                                                
                                            </form>
                                        </li>
                                        <li class="list-group-item px-3">
                                            <button type="submit" class="btn btn-accent btn-block">Login</button>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                    
                    
                </div>
                
            </main>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <script src="{{ asset('shards_template/scripts/extras.1.1.0.min.js') }}"></script>
    <script src="{{ asset('shards_template/scripts/shards-dashboards.1.1.0.min.js') }}"></script>
    <script src="{{ asset('shards_template/scripts/app/app-blog-overview.1.1.0.js') }}"></script>
</body>
</html>