@if(session()->has('message'))
<div class="container">
    <div class="row">
        <div class="col">
            <div class="alert alert-dismissible alert-success mb-4">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                {{ session('message') }}
            </div>
        </div>
    </div>
</div>
@endif
