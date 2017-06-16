<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h1><?= $title ?></h1>
      </div>
      <div class="box-body">

        <?php if( $this->session->flashdata('msj') ){ ?>
          <script type="text/javascript"> isalert('<?= $this->session->flashdata('msj') ?>'); </script>
        <?php } ?>

        <a href="<?= base_url() ?>index.php/Users/create" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> New User</a>
        <br />
        <br />
        <table class="datatable display responsive no-wrap" cellspacing="0" width="100%">
          <thead>
            <th>ID</th>
            <th>Company</th>
            <th>Role</th>
            <th>Value</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
          </thead>
          <tbody>
            <?php foreach($items as $item){ ?>
              <tr>
                <td><?= $item->user_id ?></td>
                <td><?= $item->company ?></td>
                <td><?= $item->role ?></td>
                <td><?= $item->value ?></td>
                <td><?= $item->name ?></td>
                <td><?= $item->email ?></td>
                <td>
                    <?php if($item->isactive == 'Y'){ ?>
                      <a href='<?= base_url() ?>index.php/Users/edit/<?= $item->user_id ?>' class="btn btn-info"><i class='fa fa-pencil'></i> Edit</a>
                      <a href='#' onclick='isconfirm("Estas seguro de Desactivar este Usuario?","<?= base_url() ?>/index.php/Users/inactive/<?= $item->user_id ?>");' class="btn btn-danger"><i class='fa fa-times'></i> Inactive</a>
                    <?php }else{ ?>
                      <a href='#' onclick='isconfirm("Estas seguro de Activar este Usuario?","<?= base_url() ?>index.php/Users/active/<?= $item->user_id ?>");' class="btn btn-success"><i class="fa fa-check"></i> Active</a>
                    <?php } ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>