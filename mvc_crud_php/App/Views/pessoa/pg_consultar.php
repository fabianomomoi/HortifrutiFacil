<div class="container">
    <div class="row">
        
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
            if (!count($viewVar['listaPessoas'])) {
                ?>
                <div class="alert alert-info" role="alert">Nenhum pessoa encontrada</div>
                <?php
            } else {
                ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td class="info">Nome</td>
                            <td class="info">Usuário</td>
                            <td class="info">Senha</td>
                            <td class="info">Email</td>
                            <td class="info">Cidade</td>
                            <td class="info">Estado</td>
                            <td class="info">Ações</td>
                        </tr>
                        <?php
                        foreach ($viewVar['listaPessoas'] as $pessoa) {
                            ?>
                            <tr>
                                <td><?php echo $pessoa->getNome(); ?></td>
                                <td><?php echo $pessoa->getUsuario(); ?></td>
                                <td><?php echo $pessoa->getSenha(); ?></td>
                                <td><?php echo $pessoa->getEmail(); ?></td>
                                <td><?php echo $pessoa->getIdcid()->getNomecid(); ?></td>
                                <td><?php echo $pessoa->getIdcid()->getIdestado()->getNomestado(); ?></td>
                                
                                
                                <td>
                                    <a href="http://<?php echo APP_HOST; ?>/pessoa/edicao/<?php echo $pessoa->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                                    <a href="http://<?php echo APP_HOST; ?>/pessoa/exclusao/<?php echo $pessoa->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
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