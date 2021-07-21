<div class="container">
    <div class="row">
      <div class="col-md-12 mb-2 card">
        <div class="card-body">
          <?php if (!empty(session()->getFlashdata('success'))) : ?>
              <div class="alert alert-success" role="alert">
                  <?php echo session()->getFlashdata('success'); ?>
              </div>
          <?php endif; ?>
          <h1>Pemilih</h1>
          <a href="<?=base_url();?>/admin/pemilih/tambah" class="btn btn-primary">Register</a>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>NIK</th>
                <th>Nama</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($pemilih as $pem){ ?>
                <tr>
                  <th><?=$no?></th>
                  <td><?=$pem['nik']?></td>
                  <td><?=$pem['nama']?></td>
                </tr>
                <h5 class="h5">
              <?php
              $no++; 
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>