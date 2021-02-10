<!-- Modal registrar Usuario-->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="edit1">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="row justify-content-md-center">
        <div class="form-group col-lg-7">
          <div class="error" ></div>
          <h5  >¿Confirmas guardar los siguientes datos?</h5>
          <form id="formRU">
            <div class="row">
              <div class="form-group col-md-7">
              <label for="nombrec">Nombre Cliente: </label>
                <input  type="text" class="form-control" id="nombrec" name="nombre"  readonly required>
              </div>
              <div class="form-group col-lg-7">
              <label for="porcentajec">Porcentaje de semanas para renovación: </label>
                <input  type="text" class="form-control" id="porcentajec" name="porcentaje" readonly required>
              </div>
              <div class="form-group col-md-7">
              <label for="inicioc">De: </label>
                <input  type="text" class="form-control" id="inicioc" name="inicio" readonly required>
              </div>
              <div class="form-group col-md-7">
              <label for="terminoc">A: </label>
                <input  type="text" class="form-control" id="terminoc" name="termino" readonly required>
              </div>
              <div class="form-group col-md-7">
              <label for="semanasc">Número de semanas del periodo: </label>
                <input  type="text" class="form-control" id="semanasc" name="semanas" readonly required>
              </div>
              <div class="form-group col-md-7">
              <label for="renovacionc">Fecha de renovación: </label>
                <input  type="text" class="form-control" id="renovacionc" name="renovacion" readonly required>
              </div>
              <div class="form-group col-md-7">
                <button type="submit" class="btn btn-success" id="btnRU" name="btnRU" >Confirmar</button>
              </div>
            </div>
          </form>
          <div class="error" ></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin modal -->