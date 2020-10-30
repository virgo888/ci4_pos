            
<form method="POST" action="<?php echo site_url(ADMIN_PATH.'/users/add_post'); ?>">
    <div class="card mt-3">
        <div class="card-header">
            <h4><?=$content_title?></h4>
        </div>
        <div class="card-body">
            <!-- cek validasi -->
            <?php
                $inputs  = session()->getFlashdata('inputs');
                $errors  = session()->getFlashdata('errors');
                $success = session()->getFlashdata('success');

                if(!empty($errors))
                { 
            ?>
                <div class="alert alert-danger" role="alert">
                    Terjadi kesalahan pada input data :
                    <ul>
                        <?php foreach ($errors->messages as $error) : ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php
                }
            ?>
            <div class="form-group">
                <label for="owner">Username</label>
                <input type="text" class="form-control form-control-sm" name="username" id="username" placeholder="USERNAME" value="<?= !empty($inputs) ? $inputs['username'] : ""; ?>">
            </div>
            <div class="form-group">
                <label for="owner">Email</label>
                <input type="text" class="form-control form-control-sm" name="email" id="email" placeholder="EMAIL" value="<?= !empty($inputs) ? $inputs['email'] : ""; ?>">
            </div>
            <div class="form-group">
                <label for="owner">No. HP</label>
                <input type="text" class="form-control form-control-sm" name="phone" id="phone" placeholder="NOMOR HP" value="<?= !empty($inputs) ? $inputs['phone'] : ""; ?>">
            </div>
            <div class="form-group">
                <label for="name">Password</label>
                <input type="password" class="form-control form-control-sm" name="password" id="password" placeholder="PASSWORD">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="save btn btn-success">Simpan</button>
            <button type="button" class="back btn btn-warning float-right">Kembali</button>
        </div>
    </div>
</form>