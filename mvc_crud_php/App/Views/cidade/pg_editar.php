<div class="container">
    <div class="row">
           <div class="col-md-12">
            <br><hr/><br><br>
        </div>
        <div class="col-md-12">

            <h3>Editar Pessoa</h3>

            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/cidade/editar" method="get" id="form_cadastro">
                <input type="hidden" class="form-control" name="idcid" id="idcid" value="<?php echo $viewVar['cidade']->getIdcid(); ?>">

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text"  class="form-control" name="nomecid" id="nomecid" placeholder="" value="<?php echo $viewVar['cidade']->getNomecid(); ?>" required>
                </div>


                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/cidade/consulta" class="btn btn-info btn-sm">Voltar</a>
            </form>
        </div>
        
    </div>
</div>
