<div class="container">
    <div class="row">
       <div class="col-md-12">
            <br><hr/><br><br>
        </div>
        <div class="col-md-12">
            <h3>Cadastro de Estado</h3>
            
            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/estado/inserir" method="get" id="form_cadastro">
                <div class="form-group">
                    <label for="nomestado">Estado</label>
                    <input type="text" class="form-control"  name="nomeestado" placeholder="Digite o nome" value="<?php echo $Sessao::retornaValorFormulario('nomeestado'); ?>" required>
<br/>
                                <button type="submit" class="btn btn-success btn-sm">Inserir</button>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>