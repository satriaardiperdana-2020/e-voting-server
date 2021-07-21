<div class="container">
    <div class="row">
          <?php if (!empty(session()->getFlashdata('success'))) : ?>
              <div class="alert alert-success" role="alert">
                  <?php echo session()->getFlashdata('success'); ?>
              </div>
          <?php endif; ?>
          <h1 style="text-align : center">Profil Calon</h1>
          <div class="col-12 card" style="padding:20px">
            <img src="<?=base_url();?>/uploads/foto/<?=$calon['foto']?>" style="max-width:200px" class="img-fluid">
            <div class="card-body">
              <h5 class="card-title"><?=$calon['nama']?></h5>
              <p class="card-text"><?=$calon['motto']?></p>
              <p class="card-text"><?=$calon['alamat']?></p>
              <p class="card-text"><?=$calon['jenis_kelamin']?></p>
              <p class="card-text"><?=$calon['tempat_lahir']?></p>
              <p class="card-text"><?=$calon['tanggal_lahir']?></p>
          </div>
    </div>
  </div>