<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br><hr/><br><br>
        </div>
        <div class="col-md-12">
            <h3>Cadastro de Cidade</h3>

            <?php if ($Sessao::retornaErro()) { ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/cidade/inserir" method="get" id="form_cadastro">
                <div class="form-group">

                    <label for="nome">Cidade</label>
                    <input type="text" class="form-control"  name="nomecid" placeholder="Digite o nome" value="<?php echo $Sessao::retornaValorFormulario('nomecid'); ?>" required>

                    <label for="idestado">Estado</label>
                    <select class="form-control" name="idestado" required>
                        <?php foreach ($viewVar['listaEstados'] as $estado): ?>  

                            <option value="<?php echo $estado->getIdestado(); ?>"
                                    <?php echo($Sessao::retornaValorFormulario('idestado') == $estado->getIdestado()) ? "selected" : ""; ?>>
                                        <?php echo $estado->getNomestado(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <br/>

                    <button type="submit" class="btn btn-success btn-sm">Inserir</button>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>