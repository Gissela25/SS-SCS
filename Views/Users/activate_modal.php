<!-- Modal -->
<div class="modal fade" id="setModalStateOn_<?php echo $empleado['Id_Usuario']?>" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: #FF0032">
                <h5 class="modal-title text-white my-1" id="exampleModalLabel">Activar Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4 my-2">
                <h4 class="text-center">¿Deseas realmente <span class="text-success">activar</span> a
                    <?=$empleado['Nombre']?>
                    <?=$empleado['Apellido']?>?</h4>
            </div>
            <div class="modal-footer">
                <form role="form" method="post" action="<?=PATH?>Users/Operations/<?=$empleado['Id_Usuario']?>">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger" id="Activar" name="Activar">Activar</button>
                </form>
            </div>
        </div>
    </div>
</div>