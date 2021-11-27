<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Tutorial membuat Pagination Sederhana Menggunakan Codeigniter 4@RumahCode.Org</title>
<script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script defer src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script defer src="http://localhost/ci41/vendor/fontawesome5/svg-with-js/js/fontawesome-all.min.js"></script>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script>
function getfpage(){	
	$("#isi").html('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>');
    $.get("user/hal", function(data, status){
      $("#isi").html(data);
    });
}
function goto(hal){	
	$("#isi").html('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>');
    $.get(hal, function(data, status){
      $("#isi").html(data);
    });
}
function detail(id,hal){
	$("#modaleditisi").html('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>');
	$("#modaleditjdl").html('<input type="hidden" id="st" name="st" value="0">Edit User ID '+id);
    $.get("user/detail?user="+id+"&hal="+hal, function(data, status){
      $("#modaleditisi").html(data);
	  
    });	
}	
function modal(id,hal)
{
	$('#modaledit').modal('show');
	if (id != '')
	{
		detail(id,hal);
	}else
	{
		$("#modaleditjdl").html('Tambah User<input type="hidden" id="st" name="st" value="1">');
		$("#modaleditisi").html('<div class="form-group row"><label for="user_id" class="col-sm-2 col-form-label">User ID</label><div class="col-sm-10"><input type="text" class="form-control" id="user_id"></div></div><div class="form-group row"><label for="email" class="col-sm-2 col-form-label">Email</label><div class="col-sm-10"><input type="email" class="form-control" id="email"><input type="hidden" id="hal" name="hal" value="'+hal+'"></div></div><div class="form-group row"><label for="alias" class="col-sm-2 col-form-label">Alias</label><div class="col-sm-10"><input type="text" class="form-control" id="alias"></div></div><div class="form-row"><div class="form-group col-md-6"><label for="password">Password</label><input type="password" class="form-control" id="password"></div><div class="form-group col-md-6"><label for="password1">Konfirmasi Password</label><input type="password" class="form-control" id="password1"></div></div>');
	}
}
function hapus(id,hal)
{	$('#modalhapus').modal('show');
	$("#modalhapusjdl").html('Hapus User ID '+id+'<input type="hidden" id="hal" name="hal" value="'+hal+'"><input type="hidden" id="id" name="id" value="'+id+'">');
	$("#modalhapusisi").html('Apakah anda yakin?');
	
}
function dohapus()
{
	var id = $("#id").val();
	var hal = $("#hal").val();	
    $.get("user/hapus?id="+id, function(data, status){});
		alert('Hapus data berhasil');
		$('#modalhapus').modal('hide');
		goto('user/hal?page_jq='+hal);	
  
}
function simpan()
{
	var userid = $("#user_id").val();
	var email = $("#email").val();
	var alias = $("#alias").val();
	var password = $("#password").val();
	var password1 = $("#password1").val();
	var hal = $("#hal").val();
	var st = $("#st").val();
		if (userid == ''){alert('Semua field harus diisi');return false;}
		if (email == ''){alert('Semua field harus diisi');return false;}
		if (alias == ''){alert('Semua field harus diisi');return false;}		
	if (st != '1')
	{	var act = 'update';
	}else
	{
		var act = 'insert';	
		if (password != '')
		{
			if (password != password1){alert('Password & Konfirmasi tidak sama');return false;}
		}else{
			alert('Password Tidak Boleh Kosong');
			return false;
			}

	}
		if (password != '')
		{
			//tidak kosong
			if (password != password1)
			{
				alert('Password & Konfirmasi Password tidak sama');
				return false;
			}
		}
			//password Kosong
				$.post( "user/"+act, { user_id: userid,email: email,alias: alias,password: password }).done(function( data ) {
					if (data == 1)
					{	
						alert (act+' Data Berhasil');
						$('#modaledit').modal('hide');
						goto('user/hal?page_jq='+hal);
					}
					else
					{
						alert (act+' Data Gagal');
					}
				});				
}
</script>  
</head>
<body onload="getfpage();">
<div class="container" id="isi">

</div> 
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modaleditjdl" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaleditjdl">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="modaleditisi">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" OnClick="simpan();">Simpan</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalhapus" tabindex="-1" role="dialog" aria-labelledby="modalhapusjdl" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalhapusjdl">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="modalhapusisi">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" OnClick="dohapus()">Hapus</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>