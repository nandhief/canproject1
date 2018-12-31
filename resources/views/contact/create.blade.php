@extends('layouts.lte')

@section('title')
	Tambah Kontak
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
					<h3>Tambah Kontak</h3>
				</div>
				<div class="box-body">
					<form method="POST" action="{{ route('contacts.store') }}">
					<div class="row">
						<div class="col-md-4">
							<label>Posisi *</label>
							<select name="posisi" id="" class="select2 form-control">
                                <option value="">Pilih Posisi</option>
                                <option value="pusat">Kantor Pusat</option>
                                <option value="cabang">Kantor Cabang</option>
                                <option value="kas">Kantor Kas</option>
                            </select>
						</div>
						<div class="col-md-8">
							<label>Nama *</label>
							<input type="text" class="form-control" name="name" placeholder="Nama Daerah">
                        </div>
                    </div>
                    <br>
                    <div class="row">
						<div class="col-md-6">
							<label>Nama Pimpinan *</label>
							<input type="text" class="form-control" name="kepala" placeholder="Nama Pimpinan Pusat/Cabang/Kas">
						</div>
						<div class="col-md-6">
							<label>Telephone *</label>
							<input type="text" class="form-control" name="telp" placeholder="Telephone">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							<label>Alamat *</label>
							<input type="text" class="form-control" name="alamat" placeholder="Alamat">
						</div>
					</div>
					<br>					
					<div class="row">
						<div class="col-md-6">
							<label>Latitude *</label>
							<input type="text" readonly="" class="form-control" name="latitude" placeholder="Latitude" id="latitude">
						</div>
						<div class="col-md-6">
							<label>Longtitude *</label>
							<input type="text" readonly="" class="form-control" name="longitude" placeholder="Longtitude" id="longitude">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
                            <div class="text-muted"><strong>Catatan:</strong> Untuk mendapatkan latitude dan longitude dengan klik area yang di pilih</div>
							<div id="map"></div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-6">
                            <a href="{{ url('contacts') }}" class="btn btn-success btn-flat"><i class="fa fa-reply"></i> Kembali</a>
                            <button class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
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
<script>
function initialize() {
  var propertiPeta = {
    center:new google.maps.LatLng(-6.9827737,110.3702682),
    zoom:15,
    zoomControl: false,
    scaleControl: true,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  
  var peta = new google.maps.Map(document.getElementById("map"), propertiPeta);
  
  // membuat Marker
  var marker=new google.maps.Marker({
      position: new google.maps.LatLng(-6.9827737,110.3702682),
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