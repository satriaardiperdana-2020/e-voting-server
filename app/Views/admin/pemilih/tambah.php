<div class="container">
    <div class="row">
      <div class="col-md-12 mb-2 card">
        <div class="card-body">
          <?php if (!empty(session()->getFlashdata('error'))) : ?>
              <div class="alert alert-danger" role="alert">
                  <?php echo session()->getFlashdata('error'); ?>
              </div>
          <?php endif; ?>
          <h1>Register Pemilih</h1>
          <form method="post" action="<?=base_url();?>/admin/pemilih/save" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">NIK</label>
                <input type="text" name="nik" class="form-control" value="<?=old('nik');?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?=old('nama');?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>