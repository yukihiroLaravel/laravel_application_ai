@if ($errors->any())
    <ul class="alert alert-danger ps-4" role="alert">
        @foreach ($errors->all() as $error)
            <li class="ms-2">{{ $error }}</li>
        @endforeach
    </ul>
@endif
