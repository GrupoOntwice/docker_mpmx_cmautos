<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MPMX CMAUTOS</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container" style="margin-top: 100px;">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">MPMX CMAUTOS - Importar archivo Excel</div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ( \Session::has('status') )
                            <div class="alert {{ (\Session::get('error') == true) ? 'alert-danger' : 'alert-success' }}">
                                <ul>
                                        <li>{{ \Session::get('status') }}</li>
                                </ul>
                            </div>
                        @endif

                        <div class="card-body">
                            <form action="{{ route('import-mpmx') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="offset-1">
                                        <input type="file" name="archivo_excel" id="archivo_excel" required>
                                    </div>
                                    <div class="offset-3">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </div>
                            </form>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
