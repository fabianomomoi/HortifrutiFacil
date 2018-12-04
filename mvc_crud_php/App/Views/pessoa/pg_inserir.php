<!DOCTYPE html>
<html>
<head>
	<title>Inserir</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br><hr/><br><br>
        </div>
        <div class="col-md-12">
            <h3>Cadastro de Pessoas</h3>

            <?php if ($Sessao::retornaErro()) { ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/pessoa/inserir" method="get" id="form_cadastro">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control"  name="nome" placeholder="Digite o nome" value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>" required>

                </div>
                <div class="form-group">
                    <label for="usuario">Usuário</label>
                    <input type="text" class="form-control" name="usuario" placeholder="Digite o usuário" value="<?php echo $Sessao::retornaValorFormulario('usuario'); ?>" required>

                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" name="senha" placeholder="Digite a senha" value="<?php echo $Sessao::retornaValorFormulario('senha'); ?>" required>

                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Digite seu email" value="<?php echo $Sessao::retornaValorFormulario('email'); ?>" required>

                </div>
                <div class="form-group">
                    <label for="nomestado">Estado</label>
                    <select class="form-control" name="idestado" required>
                        <?php foreach ($viewVar['listaEstados'] as $Estado): ?>  

                            <option value="<?php echo $Estado->getIdestado(); ?>"
                                    <?php echo($Sessao::retornaValorFormulario('idestado') == $Estado->getIdestado()) ? "selected" : ""; ?>>
                                        <?php echo $Estado->getNomestado(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nomecid">Cidade</label>
                    <select class="form-control" name="idcid" required>
                        <?php foreach ($viewVar['listaCidades'] as $Cidade): ?>  

                            <option value="<?php echo $Cidade->getIdcid(); ?>"
                                    <?php echo($Sessao::retornaValorFormulario('idcid') == $Cidade->getIdcid()) ? "selected" : ""; ?>>
                                        <?php echo $Cidade->getNomecid(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
<br/>
                <button type="submit" class="btn btn-success btn-sm">Inserir</button>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>
</body>
</html>