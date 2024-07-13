<div class="mt-3">
    @if ($errors->any())
        <ul class="alert">
            @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>


{{-- @if ($errors->any() || session('success') || session('error'))
    <div class="mt-5">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show"
                role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close"
                    data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @foreach (['success', 'error'] as $msg)
            @if (session($msg))
                <div
                    class="alert alert-{{ $msg == 'success' ? 'success' : 'danger' }}">
                    {{ session($msg) }}
                </div>
            @endif
        @endforeach
    </div>
@endif --}}
