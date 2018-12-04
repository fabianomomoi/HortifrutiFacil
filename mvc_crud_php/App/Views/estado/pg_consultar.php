<div class="container">
    <div class="row">
        <br>
        <div class="col-md-12">
            <br><hr/><br><br>
        </div>
        <div class="col-md-12">
            <?php if ($Sessao::retornaMensagem()) { ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $Sessao::retornaMensagem(); ?>
                </div>
            <?php } ?>

            <?php
            if (!count($viewVar['listaEstados'])) {
                ?>
                <div class="alert alert-info" role="alert">Nenhum estado encontrado</div>
                <?php
            } else {
                ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td class="info">Nome</td>
                            <td class="info">Ações</td>

                        </tr>
                        <?php
                        foreach ($viewVar['listaEstados'] as $Estado) {
                            ?>
                            <tr>
                                <td><?php echo $Estado->getNomestado(); ?></td>
                                <td>
                                    <a href="http://<?php echo APP_HOST; ?>/estado/edicao/<?php echo $Estado->getIdestado(); ?>" class="btn btn-info btn-sm">Editar</a>
                                    <a href="http://<?php echo APP_HOST; ?>/estado/exclusao/<?php echo $Estado->getIdestado(); ?>" class="btn btn-danger btn-sm">Excluir</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>