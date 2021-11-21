<?= $this->extend('templates/admin_template')?>

<?= $this->section('content')?>

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $title?></h1>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Komik</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card mb-3" style="max-width: 640px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="<?= base_url()?>/public/img/<?=$komik['sampul']?>" class="my-2 mx-2 komiku">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?=$komik['judul']?></h5>
        <p class="card-text"><b>Penulis: </b><?=$komik['penulis']?></p>
        <p class="card-text"><b>Penerbit: </b><?=$komik['penerbit']?></p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        <a href="" class="btn btn-warning">Edit</a>
        <a href="" class="btn btn-danger">Hapus</a>
        <br>
        <a href="<?= base_url()?>/komik" class="btn-primary">Kembali ke daftar komik</a>
    </div>
    </div>
  </div>
</div>
      </div><!-- /.container-fluid -->
    </section>

<?= $this->endSection()?>
