<!-- Modal -->
<div class="modal fade" id="setModalStateOf_<?php echo $producto['Id_Articulo']?>" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: #FF0032">
                <h5 class="modal-title text-white my-1" id="exampleModalLabel">Desactivar Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4 my-2">
                <h4 class="text-center">¿Deseas realmente <span class="text-danger">desactivar</span> a
                    <?=$producto['NombreA']?>
                    <?=$producto['NombreP']?>
                    <?=$producto['NombreD']?>?</h4>
            </div>
            <div class="modal-footer">
                <form role="form" method="post" action="<?=PATH?>Articles/Operations/<?=$producto['Id_Articulo']?>">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger" id="Desactivar" name="Desactivar">Desactivar</button>
                </form>
            </div>
        </div>
    </div>
</div>