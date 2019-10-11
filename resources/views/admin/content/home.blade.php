@extends('layouts.app')

@section('content')
<body>
    <main>
        <div class="section">
        <div class="container">
            <div class="row">
            <div class="col-md-6 col-md-offset-3 bg-white p-30 box">
                <div class="text-center">
                <h1 class="text-green mb-30"><b>Level 8 Challenge</b></h1>
                </div>
                <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name"
                    value="{{ old('name') ?? (Auth::user()->name ?? old('name')) }}">
                    @error('name')
                        <p class="small text-danger mt-5">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title"
                    value="{{ old('title') }}">
                    @error('title')
                        <p class="small text-danger mt-5">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Body</label>
                    <textarea rows="5" class="form-control" 
                    name="body">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="small text-danger mt-5">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Choose image from your computer :</label>
                    <div class="input-group">
                    <input type="text" class="form-control upload-form" value="No file chosen" readonly>
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                        <i class="fa fa-folder-open"></i>&nbsp;Browse 
                        <input type="file" name="image" multiple>
                        </span>
                    </span>
                    </div>
                    @error('image')
                    <p class="small text-danger mt-5">{{ $message }}</p>
                    @enderror
                </div>
                @guest
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" 
                        class="form-control" name="password">
                        @error('password')
                            <p class="small text-danger mt-5">{{ $message }}</p>
                        @enderror
                    </div>
                @endguest
                <div class="text-center mt-30 mb-30">
                    <button class="btn btn-primary">Submit</button>
                </div>
                </form>
                <hr>
                @foreach($boards as $board)
                <div class="post">
                    <div class="clearfix">
                    <div class="pull-left">
                        <h2 class="mb-5 text-green"><b>{{ $board->title }}</b></h2>
                    </div>
                    <div class="pull-right text-right">
                        <p class="text-lgray">{{ date('d-m-Y', strtotime($board->created_at)) }}<br/>
                        <span class="small">{{ date('H:i', strtotime($board->created_at)) }}</span></p>
                    </div>
                    </div>
                    <h4 class="mb-20"> 
                        @if(is_null($board->name)) 
                            No Name
                        @else 
                            {{$board->name}}
                        @endif
                    <span class="text-id">
                        @if($board->user_id) 
                            [ID:{{$board->user_id}}]
                        @endif
                    </span></h4>
                    <p>
                    {!! nl2br(e($board->message)) !!}
                    </p>
                    <div class="img-box my-10">
                    @if (!is_null($board->image) && 
                         file_exists('storage/image/board/thumbnail/' . $board->image))
                        <img class="img-responsive" 
                        src="{{ url('storage/image/board/thumbnail/' . $board->image) }}" alt="image">
                    @else
                        <img class="img-responsive" 
                        src="{{ url('storage/image/image-not-available.jpg') }}" alt="image">
                    @endif
                    </div>
                    <form class="form-inline mt-50 form-manage" method="post">
                        @csrf
                        @guest
                            @if(!$board->user_id)
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="inputPassword2" class="sr-only">Password</label>
                                    <input type="password" class="form-control" 
                                    name="submitPass" placeholder="Password">
                                </div> 
                                <button formaction="{{ route('edit', $board->id)}}"
                                class="btn btn-default mb-2 edit-board-btn">
                                    <i class="fa fa-pencil p-3"></i>
                                </button>
                                <button formaction="{{ route('delete', $board->id)}}"
                                class="btn btn-danger mb-2 delete-board-btn">
                                    <i class="fa fa-trash p-3"></i>
                                </button> 
                            @endif
                        @endguest
                        @if((Auth::id() === $board->user_id) && !is_null($board->user_id))
                            <button formaction="{{ route('edit', $board->id)}}"
                            class="btn btn-default mb-2">
                                <i class="fa fa-pencil p-3"></i>
                            </button>
                            <button formaction="{{ route('delete', $board->id)}}" 
                            class="btn btn-danger mb-2 delete-board-btn">
                                <i class="fa fa-trash p-3"></i>
                            </button>
                        @endif
                    </form>
                </div>
                @endforeach
                <div class="text-center mt-30">
                    {{ $boards->links() }}
                </div>
            </div>
            </div>
        </div>
        </div>
    </main>  
</body>
@endsection

@section('modal')
    @if(Session::has('modal'))
        @if(Session::get('modal') === 'edit')
            @if(is_null(Session::get('passErr')))
                @include('modal/edit-modal')
            @else
                @include('modal/wrong-edit-modal')
            @endif
            <script>
                $('#modal').modal('show');
            </script>
        @endif
        @if(Session::get('modal') === 'delete')
            @if(is_null(Session::get('passErr')))
                @include('modal/delete-modal')
            @else
                @include('modal/wrong-delete-modal')
            @endif
            <script>
                $('#modal').modal('show');
            </script>
        @endif
    @endif

    @if($errors->has('errorModal'))
        @if(strpos($errors->first('errorModal'), 'update'))
            @include('modal/edit-modal')
        @endif
        <script>
            $('#modal').modal('show');
        </script>
    @endif
@endsection

@section('style')
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tmdrPreset.css') }}">
    <!-- CSS End -->
@endsection

@section('script')
    <!-- Javascript -->
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Javascript End -->
@endsection

@section('title')
    <title>Timedoor Challenge - Level 8</title>
@endsection

@section('header')
    <header>
        <nav class="navbar navbar-default" role="navigation">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" 
              data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <h2 class="font16 text-green mt-15"><b>Timedoor 30 Challenge Programmer</b></h2>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
              @guest
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
              @else
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </li>
              @endguest
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>
@endsection

@section('footer')
    <footer>
        <p class="font12">Copyright &copy; 
        <script>document.write(new Date().getFullYear());</script> by 
        <a href="https://timedoor.net" class="text-green">PT. TIMEDOOR INDONESIA</a></p>
    </footer>
@endsection

@section('footer-script')
    @if (session('error'))
        <script>
            alert("{{ session('error')}}");
        </script>
    @endif
    <script>
        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        $(document).ready( function() {
            $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
                var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;

                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) alert(log);
                }
            });
        });
    </script>
@endsection