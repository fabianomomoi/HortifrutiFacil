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

            <form action="http://<?php echo APP_HOST; ?>/pessoa/editar" method="get" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['pessoa']->getId(); ?>">

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text"  class="form-control" name="nome" id="nome" placeholder="" value="<?php echo $viewVar['pessoa']->getNome(); ?>" required>
                </div>

                <div class="form-group">
                    <label for="usuario">Usuário</label>
                    <input type="text"  class="form-control"  name="usuario" id="usuario" placeholder="" value="<?php echo $viewVar['pessoa']->getUsuario(); ?>" required>
                </div>

                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="text"  class="form-control"  name="senha" id="senha" placeholder="" value="<?php echo $viewVar['pessoa']->getSenha(); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text"  class="form-control"  name="email" id="email" placeholder="" value="<?php echo $viewVar['pessoa']->getEmail(); ?>" required>
                </div>
                <label>Cidade</label>
                <select class="form-control" name="idcid" required>
                  <?php foreach ($viewVar['listaCidades'] as $Cidade):?>  
                            
                        <option value="<?php echo $Cidade->getIdcid(); ?>"
                            <?php echo($viewVar['pessoa']->getIdcid()->getIdcid() == $Cidade->getIdcid()) ? "selected" : ""; ?>>
                            <?php echo $Cidade->getNomecid();?>
                        </option>
                            <?php endforeach;?>
                        </select>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/pessoa/consulta" class="btn btn-info btn-sm">Voltar</a>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>
