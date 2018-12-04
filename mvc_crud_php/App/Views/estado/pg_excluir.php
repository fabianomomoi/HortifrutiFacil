<div class="container">
    <div class="row">
<div class="col-md-12">
            <br><hr/><br><br>
        </div>
        <div class="col-md-12">

            <h3>Excluir Pessoa</h3>

            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/estado/excluir" method="get" id="form_cadastro">
                <input type="hidden" class="form-control" name="idestado" id="idcid" value="<?php echo $viewVar['estado']->getIdestado(); ?>">

                <div class="panel panel-danger">
                    <div class="panel-body">
                        Deseja realmente excluir o estado: <?php echo $viewVar['estado']->getNomestado(); ?> ?
                    </div>
                    <div class="panel-footer"> 
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        <a href="http://<?php echo APP_HOST; ?>/estado/consulta" class="btn btn-info btn-sm">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>
