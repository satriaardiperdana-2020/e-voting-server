  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-2 card">
        <div class="card-body">
          <?php if (!empty(session()->getFlashdata('success'))) : ?>
              <div class="alert alert-success" role="alert">
                  <?php echo session()->getFlashdata('success'); ?>
              </div>
          <?php endif; ?>
          <h1>Calon</h1>
          <a href="<?=base_url();?>/admin/calon/tambah" class="btn btn-primary">Tambah</a>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tempat/Tanggal Lahir</th>
                <th>Foto</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($calon as $cal){ ?>
                <tr>
                  <th><?=$no?></th>
                  <td><?=$cal['nik']?></td>
                  <td><?=$cal['nama']?></td>
                  <td><?=$cal['jenis_kelamin']?></td>
                  <td><?=$cal['tempat_lahir']?>/<?=$cal['tanggal_lahir']?></td>
                  <td><img src="<?=base_url();?>/uploads/foto/<?=$cal['foto']?>" class="img-fluid" style="max-height:50px"></td>
                  <td>
                    <a class="btn btn-warning" href="<?=base_url('admin/calon/edit/'.$cal['id_calon']);?>">Edit</a>
                    <a class="btn btn-danger" href="#" data-href="<?= base_url('admin/calon/delete/'.$cal['id_calon']) ?>" onclick="confirmToDelete(this)">Delete</a>
                  </td>
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

  <div id="confirm-dialog" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h2 class="h2">Hapus Data ?</h2>
        </div>
        <div class="modal-footer">
          <a href="#" role="button" id="delete-button" class="btn btn-danger">Delete</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

<script>
function confirmToDelete(el){
    $("#delete-button").attr("href", el.dataset.href);
    $("#confirm-dialog").modal('show');
}
</script>