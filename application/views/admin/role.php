<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>


  <div class="row">
    <div class="col-lg-6">
      <?php echo form_error('role', '<div class="alert alert-danger" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>'); ?>

      <?php echo $this->session->flashdata('message'); ?>

      <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRolemodal"> Add New Role</a>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Role</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($role as $r) : ?>
              <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $r['role']; ?></td>
                <td>
                  <a href="<?php echo base_url('admin/roleaccess/') . $r['id'] ?>" class="badge badge-warning">Access</a>
                  <a href="<?php echo base_url('admin/update_role/') . $r['id'] ?>" class="badge badge-success" data-toggle="modal" data-target="#newEditRoleModal<?= $r['id'] ?>">Edit</a>
                  <a href="<?php echo base_url('admin/delete_role/') . $r['id'] ?>" class="badge badge-danger" data-toggle="modal" data-target="#hapusModal<?= $r['id'] ?>">Delete</a>
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

</div>
<!-- End of Main Content -->

<!-- Modal Insert-->
<div class="modal fade" id="newRolemodal" tabindex="-1" aria-labelledby="newRolemodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="<?php echo base_url('admin/role'); ?>" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="newRolemodalLabel">Add New Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body needs-validation">
          <div class="form-group">
            <input type="text" class="form-control" id="role" name="role" placeholder="Role Name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit-->
<?php foreach ($role as $r) : ?>
  <div class="modal fade" id="newEditRoleModal<?= $r['id'] ?>" tabindex="-1" aria-labelledby="newEditRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="<?php echo base_url('admin/update_role/'); ?>" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="newEditRoleModalLabel">Edit Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body needs-validation">
            <div class="form-group">
              <input type="hidden" class="form-control" id="id" name="id" placeholder="Role Name" value="<?php echo $r['id'] ?>">
              <input type="text" class="form-control" id="role" name="role" placeholder="Role Name" value="<?php echo $r['role'] ?>">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach ?>

<!-- Modal Hapus -->
<?php foreach ($role as $r) : ?>
  <div class="modal fade" id="hapusModal<?= $r['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <a class="btn btn-primary" href="<?php echo base_url('admin/delete_role/') . $r['id'] ?>">Ya</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?>