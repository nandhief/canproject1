@extends('layouts.lte')

@section('title')
	Edit Kontak
@endsection

@section('css_up')
	<style type="text/css">
		#gmb {
			display: flex;
			flex-direction: column;
		}
		#map {
			width: 100%;
			height: 300px;
		}
	</style>
@endsection

@section('content-header')
	<h1>
		Kontak
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
                    <h3>Edit Kontak</h3>
				</div>
				<div class="box-body">
					<form method="POST" action="{{ route('contacts.update', $data->id) }}">
					<div class="row">
						<div class="col-md-2">
							<label>Posisi *</label>
							<select name="posisi" id="" class="select2 form-control">
                                <option value="">Pilih Posisi</option>
                                <option value="pusat" {{ $data->posisi == 'PUSAT' ? 'selected' : '' }}>Kantor Pusat</option>
                                <option value="cabang" {{ $data->posisi == 'CABANG' ? 'selected' : '' }}>Kantor Cabang</option>
                                <option value="kas" {{ $data->posisi == 'KAS' ? 'selected' : '' }}>Kantor Kas</option>
                            </select>
						</div>
						<div class="col-md-5">
							<label>Nama *</label>
							<input type="text" class="form-control" name="name" value="{{ $data->name }}">
						</div>
						<div class="col-md-5">
							<label>telp *</label>
							<input type="text" class="form-control" name="telp" value="{{ $data->telp }}">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							<label>Alamat *</label>
							<input type="text" class="form-control" name="alamat" value="{{ $data->alamat }}">
						</div>
					</div>
					<br>					
					<div class="row">
						<div class="col-md-6">
							<label>Latitude *</label>
							<input type="text" readonly="" class="form-control" name="latitude" placeholder="Latitude" id="latitude" value="{{ $data->latitude }}">
						</div>
						<div class="col-md-6">
							<label>Longtitude *</label>
							<input type="text" readonly="" class="form-control" name="longitude" placeholder="Longtitude" id="longitude" value="{{ $data->longitude }}">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							<div id="map"></div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-6">
                            <a href="{{ url('contacts') }}" class="btn btn-success btn-flat"><i class="fa fa-reply"></i> Kembali</a>
                            <button type="submit" class="btn btn-flat btn-primary"><i class="fa fa-save"></i> Update</button>
      						<input type="hidden" name="_method" value="PUT">
      						{{ csrf_field() }}
						</div>	
					</div>
					<br>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
<script type="text/javascript">
function initialize() {
  var propertiPeta = {
    center:new google.maps.LatLng({{ $data->latitude }}, {{ $data->longitude }}),
    zoom:15,
    zoomControl: false,
    scaleControl: true,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  
  var peta = new google.maps.Map(document.getElementById("map"), propertiPeta);
  
  // membuat Marker
  var marker=new google.maps.Marker({
      position: new google.maps.LatLng({{ $data->latitude }}, {{ $data->longitude }}),
      map: peta
  });

  var marker;
  function taruhMarker(peta, posisiTitik){
    
    if( marker ){
      // pindahkan marker
      marker.setPosition(posisiTitik);
    } else {
      // buat marker baru
      marker = new google.maps.Marker({
        position: posisiTitik,
        map: peta
      });
    }

    // isi nilai koordinat ke form
    document.getElementById("latitude").value = posisiTitik.lat();
    document.getElementById("longitude").value = posisiTitik.lng();
    
  }

  google.maps.event.addListener(peta, 'click', function(event) {
    taruhMarker(this, event.latLng);
  });

}


</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5PFwjCKMLJR-uSQ9Ijg8LLgBKteINOqE&callback=initialize">
</script>
@endsection