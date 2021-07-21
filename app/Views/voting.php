<div class="container">
    <div class="row">
          <?php if (!empty(session()->getFlashdata('success'))) : ?>
              <div class="alert alert-success" role="alert">
                  <?php echo session()->getFlashdata('success'); ?>
              </div>
          <?php endif; ?>
          <h1 style="text-align : center">Voting Calon</h1>
          <?php 
          $no = 1;
          foreach ($voting as $vot){ ?>
            <div class="col-lg-4 col-md-6 col-sm-12 card">
                <a href="voting/profil/<?=$vot['id_calon']?>" class="btn btn-info" style="width : 100%">Profil</a>
                <img src="<?=base_url();?>/uploads/foto/<?=$vot['foto']?>" class="img-fluid">
                <div class="card-body">
                    <h5 class="card-title"><?=$vot['nama']?></h5>
                    <p class="card-text"><?=$vot['motto']?></p>
                    <?php if($jumlah_voting == 0){?>
                      <a href="voting/<?=$vot['id_calon']?>" class="btn btn-primary" style="width : 100%">Voting</a>
                    <?php }else{ ?>
                      <a href="#" class="btn btn-secondary" style="width : 100%">Voting</a>
                    <?php } ?>
                </div>
            </div>
          <?php
          $no++; 
          } ?>
    </div>
  </div>