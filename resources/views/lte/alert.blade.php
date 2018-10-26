@if (session()->has('success'))
	<div class="alert alert-success fade in alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Berhasil!</h4>
		{{ session()->get('success') }}
	</div>
@endif
@if ($errors->count() > 0)
	<div class="alert alert-danger fade in alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-warning"></i> Gagal!</h4>
        <ul class="list-unstyled">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
	</div>
@endif