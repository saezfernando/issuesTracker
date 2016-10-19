@if (Session::has('message'))

    <div class="alert alert-success fade in">
        <button type="button" class="close close-sm" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        {{ session('message') }}
    </div>

@endif

@if (Session::has('error'))

    <div class="alert alert-danger fade in">
        <button type="button" class="close close-sm" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        {{ session('error') }}
    </div>

@endif