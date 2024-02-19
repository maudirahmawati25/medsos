<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <title>Feed Video</title>
    <style>
        h2 {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="container text-center">
        <h2 class="text-center">Feed</h2>
        @foreach ($feed as $feeds)
            <div class="position-relative d-inline-block">
                <video width="640" height="360" controls class="card-img-top">
                    <source src="{{ asset('/storage/'.$feeds->video)}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <form action="{{ route('feed.destroy',$feeds->id) }}" method="POST" class="position-absolute" style="top: 5px; right: 5px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin video ini?')">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>
            </div>
            <div class="text-left mt-3"> <!-- Mengubah class menjadi text-left -->
                <div class="text-left"> <!-- Tetapkan class text-left -->
                    <div>{{ $feeds->caption }}</div>
                    <div>{{ $feeds->created_at->format('d F Y')}}</div>
                </div>
            </div>    
            <br>
        @endforeach
        {{ $feed->links('pagination::bootstrap-4') }}
            <a class="btn btn-warning" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <a class="btn btn-success" href="{{ route('feed.create') }}">Add</a>
        </div>
    </div>
</body>
</html>



