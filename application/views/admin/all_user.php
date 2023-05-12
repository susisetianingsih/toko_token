<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"><?php echo $title; ?></h1>
  <p class="mb-4">Semua data user ada ditanganmu!</p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <?php echo form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

      <?php echo $this->session->flashdata('message'); ?>

      <?php
      if ($user['role_id'] == 1) {
        // masuk admin
        echo "<a href='' class='btn btn-primary mb-3' data-toggle='modal' data-target='#newList'> Add New User</a>";
      } else {
        // masuk member
        echo "<h6 class='m-0 font-weight-bold text-primary'>Tabel E-data</h6>";
      }


      ?>

    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Date Created</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($list as $l) : ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $l['name']; ?></td>
                <td><?php echo $l['email']; ?></td>
                <td><?php echo $l['role']; ?></td>
                <td><?php echo $l['date_created']; ?></td>
                <td>
                  <a href="<?php echo base_url('admin/update_user/') . $l['id'] ?>" class="badge badge-success" data-toggle="modal" data-target="#newEditListModal<?= $l['id'] ?>">Edit</a>
                  <a href="<?php echo base_url('admin/delete_user/') . $l['id'] ?>" class="badge badge-danger" data-toggle="modal" data-target="#hapusModal<?= $l['id'] ?>">Delete</a>
                </td>
              </tr>
              <?php $i++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

<!-- Modal Insert -->
<div class="modal fade" id="newList" tabindex="-1" aria-labelledby="newListLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <?php echo form_open_multipart('admin/all_user') ?>
      <div class="modal-header">
        <h5 class="modal-title" id="newListLabel">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
          <?php echo form_error('name', '<small class="text-danger pl-3">', '</small>');
          ?>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="email" name="email" placeholder="Email">
          <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>');
          ?>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="password1" name="password1" placeholder="Password">
          <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>');
          ?>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="password2" name="password2" placeholder="Repeat Password">
          <?php echo form_error('password2', '<small class="text-danger pl-3">', '</small>');
          ?>
        </div>
        <div class="form-group">
          <select name="role_id" id="role_id" class="form-control">
            <option value="">Select Role</option>
            <?php foreach ($role as $sc) : ?>
              <option value="<?php echo $sc['id']; ?>"><?php echo $sc['role']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" value="submit" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<?php foreach ($list as $l) : ?>
  <div class="modal fade" id="newEditListModal<?= $l['id'] ?>" tabindex="-1" aria-labelledby="newEditListLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newListLabel">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php echo form_open_multipart('admin/update_user') ?>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id" name="id" placeholder="Submenu title" value="<?php echo $l['id'] ?>">
            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="<?php echo $l['name'] ?>">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $l['email'] ?>" readonly>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="password1" name="password1" placeholder="Password" value="<?php echo $l['password'] ?>">
            <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="form-group">
            <select name="role_id" id="role_id" class="form-control">
              <option value="">Select Role</option>
              <?php foreach ($role as $sc) : ?>
                <option value="<?php echo $sc['id']; ?>"><?php echo $sc['role']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" value="submit" class="btn btn-primary">Edit</button>
        </div>
        </form>
      </div>
    </div>
  </div>

<?php endforeach ?>

<!-- Modal Hapus -->
<?php foreach ($list as $l) : ?>
  <div class="modal fade" id="hapusModal<?= $l['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin ingin mengapus baris ini?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Item yang telah terhapus tidak dapat dikembalikan.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
          <a class="btn btn-primary" href="<?php echo base_url('admin/delete_user/') . $l['id'] ?>">Ya</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?>