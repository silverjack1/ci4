<?= $this->extend('templates/admin_template') ?>

<?= $this->section('content') ?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h1 class="m-0"><?= $title ?></h1>
        <a href="<?= base_url() ?>/komik/create" class="btn btn-primary">Tambah</a>
        <?php if (session()->getFlashdata('pesan')) : ?>
          <div class="mt-1 alert alert-warning alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('pesan') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>
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
    <div class="row">
      <div class="col card">
        <table class="table">
          <thead>
            <tr>

              <th scope="col">#</th>
              <th scope="col">Sampul</th>
              <th scope="col">Judul</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php $i = 1; ?>
              <?php foreach ($komik as $k) : ?>
                <th scope="row"><?= $i++ ?></th>
                <td><img src="<?= base_url() ?>/public/img/<?= $k['sampul'] ?>" class="sampul"></td>
                <td><?= $k['judul'] ?></td>
                <td><a href="<?= base_url() ?>/komik/<?= $k['slug'] ?>" class="btn btn-success">Detail</a></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<?= $this->endSection() ?>