<div class="content-wrapper">
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h1><?= $title ?></h1>
      </div>
      <div class="box-body">
      <?= form_open_multipart("Developmentlevels/$action",array('autocomplete' => 'off')) ?>

      <div class='form-group'>
        <label for="txtcompany_id">Company:</label>
        <input type="hidden" name="txtdevelopment_level_id" value="<?= $item[0]->development_level_id ?>" id="txtdevelopment_level_id">
        <select class="form-control textuppercase" name="txtcompany_id" id="txtcompany_id">
            <option value="">Seleccione</option>
            <?= $companies ?>
        </select>
      </div>
      <div class='form-group'>
        <label for="txtname">Name:</label>
        <input type="text" class="form-control textuppercase" value="<?= $item[0]->name ?>" name="txtname" id="txtname">
      </div>
      <div class='form-group'>
        <label for="txtposition">Position:</label>
        <input type="text" class="form-control textuppercase" value="<?= $item[0]->position ?>" name="txtposition" id="txtposition">
      </div>
      <div class='form-group'>
        <label for="txtvalue">Value:</label>
        <input type="text" class="form-control textuppercase" value="<?= $item[0]->value ?>" name="txtvalue" id="txtvalue">
      </div>
      <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
      <a class="btn btn-danger" href="<?= base_url() ?>index.php/Developmentlevels"><i class="fa fa-times" aria-hidden="true"></i> Cancel</a>

      <?= form_close() ?>
      </div>
    </div>
  </section>
</div>