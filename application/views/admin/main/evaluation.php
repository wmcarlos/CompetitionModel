<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h2><?= $instrument[0]->name ?></h2>
      </div>
      <div class="box-body">
        <h4>Periodo a Evaluar</h4>
        <hr/>
        <div class="form-group">
          <label for="startdate">Desde:</label>
          <input type="text" name="startdate" value="<?= $instrument[0]->startdate ?>" readonly="readonly" class="form-control" id="startdate">
        </div>
        <div class="form-group">
          <label for="enddate">Hasta:</label>
          <input type="text" name="enddate" value="<?= $instrument[0]->enddate ?>" readonly="readonly" class="form-control" id="enddate">
        </div>

        <h4>Datos del Evaluado</h4>
        <hr/>
        <div class="form-group">
          <label for="fullname">Nombre y Apellido:</label>
          <input type="text" name="fullname" value="<?= $user_evaluated[0]->name ?>" readonly="readonly" class="form-control" id="fullname">
        </div>
        <div class="form-group">
          <label for="value">Cedula:</label>
          <input type="text" name="value" readonly="readonly" value="<?= $user_evaluated[0]->value ?>" class="form-control" id="value">
        </div>
        <div class="form-group">
          <label for="charge">Cargo:</label>
          <input type="text" name="charge" value="<?= $user_evaluated[0]->charge ?>" readonly="readonly" class="form-control" id="charge">
        </div>
        <div class="form-group">
          <label for="timeinthecharge">Tiempo en el Cargo:</label>
          <input type="text" name="timeinthecharge" readonly="readonly" class="form-control" id="timeinthecharge">
        </div>

        <h4>Datos del Evaluador</h4>
        <hr/>
        <div class="form-group">
          <label for="efullname">Nombre y Apellido:</label>
          <input type="text" name="efullname" value="<?= $user_evaluator[0]->name ?>" readonly="readonly" class="form-control" id="efullname">
        </div>
        <div class="form-group">
          <label for="evalue">Cedula:</label>
          <input type="text" name="evalue" value="<?= $user_evaluator[0]->value ?>" readonly="readonly" class="form-control" id="evalue">
        </div>
        <div class="form-group">
          <label for="echarge">Cargo:</label>
          <input type="text" name="echarge" value="<?= $user_evaluator[0]->charge ?>" readonly="readonly" class="form-control" id="echarge">
        </div>
        <h4>Instrucciones</h4>
        <hr/>
        <div class="form-group">
          <textarea id="instructions" style="height: 120px;" readonly="readonly" name="instructions" class="form-control"><?= $instrument[0]->instructions ?></textarea>
        </div>
        <h4>Competencias</h4>
        <hr/>
        <table class="table table-bordered table-striped">
          <tbody>
          <?php foreach($competencies AS $competency){ ?>
            <tr>
              <td colspan="2"><b>Competencia:</b> <?= $competency->name ?></td>
              <td rowspan="2" colspan="5" align="center" valign="bottom">Nivel de Dominio</td>
            </tr>
            <tr>
              <td colspan="2"><b>Definicion:</b> <?= $competency->definition ?></td>
            </tr>
            <tr>
              <td colspan="2"><b><?= $competency->name ?></b></td>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>4</td>
              <td>Total</td>
            </tr>

              <?php $data = $this->Instrumentofevaluation->getBehaviorIndicators($competency->competency_id); ?>

              <?php for($i = 0; $i < count($data); $i++){ ?>

                  <tr>
                    <td><?= $data[$i]->level ?></td>
                    <td><?= $data[$i]->description ?></td>
                    <td><input name='<?= $data[0]->behavioral_indicator_id ?>_<?= $data[$i]->level ?>' type="radio"/></td>
                    <td><input name='<?= $data[0]->behavioral_indicator_id ?>_<?= $data[$i]->level ?>' type="radio"/></td>
                    <td><input name='<?= $data[0]->behavioral_indicator_id ?>_<?= $data[$i]->level ?>' type="radio"/></td>
                    <td><input name='<?= $data[0]->behavioral_indicator_id ?>_<?= $data[$i]->level ?>' type="radio"/></td>
                    <td></td>
                  </tr>

              <?php } ?>

          <?php } ?>
          </tbody>
        </table>

      </div>
    </div>
  </section>
</div>