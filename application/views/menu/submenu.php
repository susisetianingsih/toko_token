<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>


  <div class="row">
    <div class="col-lg">

      <?php echo form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

      <?php echo $this->session->flashdata('message'); ?>

      <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubmenu"> Add New Submenu</a>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Title</th>
              <th scope="col">Menu</th>
              <th scope="col">Url</th>
              <th scope="col">Icon</th>
              <th scope="col">Active</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($subMenu as $sm) : ?>
              <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $sm['title']; ?></td>
                <td><?php echo $sm['menu']; ?></td>
                <td><?php echo $sm['url']; ?></td>
                <td><?php echo $sm['icon']; ?></td>
                <td><?php echo $sm['is_active']; ?></td>
                <td>
                  <a href="<?php echo base_url('menu/update_sub_menu/') . $sm['id'] ?>" class="badge badge-success" data-toggle="modal" data-target="#newEditSubmenuModal<?= $sm['id'] ?>">Edit</a>
                  <a href="<?php echo base_url('menu/delete_sub_menu/') . $sm['id'] ?>" class="badge badge-danger" data-toggle="modal" data-target="#hapusModal<?= $sm['id'] ?>">Delete</a>
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

<!-- Modal Insert -->
<div class="modal fade" id="newSubmenu" tabindex="-1" aria-labelledby="newSubmenuLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubmenuLabel">Add New Submenu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('menu/submenu'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title">
          </div>
          <div class="form-group">
            <select name="menu_id" id="menu_id" class="form-control">
              <option value="">Select Menu</option>
              <?php foreach ($menu as $m) : ?>
                <option value="<?php echo $m['id']; ?>"><?php echo $m['menu']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
              <label class="form-check-label" for="flexCheckDefault">
                Active?
              </label>
            </div>
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
<?php foreach ($subMenu as $sm) : ?>
  <div class="modal fade" id="newEditSubmenuModal<?= $sm['id'] ?>" tabindex="-1" aria-labelledby="newSubmenuLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="<?php echo base_url('menu/update_sub_menu/'); ?>" method="post">
          <div class="modal-header">
            <h5 class="modal-title" id="newSubmenuLabel">Edit Submenu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" class="form-control" id="id" name="id" placeholder="Submenu title" value="<?php echo $sm['id'] ?>">
              <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title" value="<?php echo $sm['title'] ?>">
            </div>
            <div class="form-group">
              <select name="menu_id" id="menu_id" class="form-control">
                <option value="">Select Menu</option>
                <?php foreach ($menu as $m) : ?>
                  <option value="<?php echo $m['id']; ?>"><?php echo $m['menu']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url" value="<?php echo $sm['url'] ?>">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon" value="<?php echo $sm['icon'] ?>">
            </div>
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                <label class="form-check-label" for="flexCheckDefault">
                  Active?
                </label>
              </div>
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
<?php foreach ($subMenu as $sm) : ?>
  <div class="modal fade" id="hapusModal<?= $sm['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <a class="btn btn-primary" href="<?php echo base_url('menu/delete_sub_menu/') . $sm['id'] ?>">Ya</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?>