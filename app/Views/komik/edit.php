<?= $this->extend('templates/admin_template') ?>

<?= $this->section('content') ?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><?= $title ?></h1>

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
    <!-- awal container -->

    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <form action="<?= base_url() ?>/komik/update/<?= $komik['id'] ?>" method="post">
              <?= csrf_field() ?>
              <input type="hidden" name="slug" value="<?= $komik['slug'] ?>" />
              <div class="form-group row">
                <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control <?= ($validation->hasError('judul'))
                                                            ? 'is-invalid' : '' ?>" id="judul" name="judul" name="judul" placeholder="Judul komik" autofocus autocomplete="off" value="<?= $komik['judul'] ?>">
                  <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= $validation->getError('judul') ?>

                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="penulis" class="col-sm-3 col-form-label">Penulis</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Nama penulis" autocomplete="off" value="<?= $komik['penulis'] ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="penerbit" class="col-sm-3 col-form-label">Penerbit</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Penerbit" autocomplete="off" value="<?= $komik['penerbit'] ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="sampul" class="col-sm-3 col-form-label">Sampul</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="sampul" name="sampul" placeholder="Sampul" autocomplete="off" value="<?= $komik['sampul'] ?>">
                </div>
                <button class="btn btn-primary" type="submit">Edit Data</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      

    </div><!-- /.container-fluid -->
</section>

<?= $this->endSection() ?>