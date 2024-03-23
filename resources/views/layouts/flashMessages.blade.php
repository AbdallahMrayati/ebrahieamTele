@if (session('success'))
    <div class="alert alert-success m-2">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger m-2">
        {{ session('error') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger m-2">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
