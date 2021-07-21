<div class="container">
    <div class="row">
      <div class="col-md-12 mb-2 card">
        <div class="card-body">
          <?php if (!empty(session()->getFlashdata('success'))) : ?>
              <div class="alert alert-success" role="alert">
                  <?php echo session()->getFlashdata('success'); ?>
              </div>
          <?php endif; ?>
          <h1>Laporan</h1>
          <a href="<?=base_url();?>/admin/laporan/export" class="btn btn-primary">Export</a>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tempat/Tanggal Lahir</th>
                <th>Foto</th>
                <th>Jumlah Suara</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              usort($laporan, function($a, $b) {
                return $b['voting'] <=> $a['voting'];
              });
              foreach ($laporan as $lap){ ?>
                <tr>
                  <th><?=$no?></th>
                  <td><?=$lap['nik']?></td>
                  <td><?=$lap['nama']?></td>
                  <td><?=$lap['jenis_kelamin']?></td>
                  <td><?=$lap['tempat_lahir']?>/<?=$lap['tanggal_lahir']?></td>
                  <td><img src="<?=base_url();?>/uploads/foto/<?=$lap['foto']?>" class="img-fluid" style="max-height:50px"></td>
                  <td><?=$lap['voting']?></td>
                </tr>
              <?php
              $no++; 
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>