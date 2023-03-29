<?php
require_once __DIR__ . "/../../config/config.php";

if(isset($_GET['filial'])){
    $filialD = $mysqli->query("SELECT * FROM filial WHERE barbearia = '" . $_SESSION["barbearia_id"] . "' AND id = '" . $_GET['filial'] . "' ORDER BY id ASC");
    $filialD = $filialD->fetch_assoc();

    if(isset($_GET['acao']) && $_GET['acao'] === 'inativar'){
        $mysqli->query("UPDATE filial SET `status` = 'I' WHERE id = '{$filialD['id']}'");
        echo "<script>Swal.fire({title: 'Sucesso', html: 'Filial inativada com sucesso.', icon: 'success'});</script>";
    }
    if(isset($_GET['acao']) && $_GET['acao'] === 'ativar'){
        $mysqli->query("UPDATE filial SET `status` = 'A' WHERE id = '{$filialD['id']}'");
        echo "<script>Swal.fire({title: 'Sucesso', html: 'Filial ativada com sucesso.', icon: 'success'});</script>";
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = @$_POST['id'];
    $nome = $_POST['nome'];
    $cep = $_POST['cep'] ;
    $rua = $_POST['rua'] ;
    $cidade = $_POST['cidade'] ;
    $bairro = $_POST['bairro'] ;
    $estado = $_POST['estado'] ;
    $numero = $_POST['numero'] ;
    $telefone = $_POST['telefone'];
    
    if($id !== ''){
        $mysqli->query("UPDATE filial SET nome='{$nome}',cep='{$cep}',rua='{$rua}',cidade='{$cidade}',bairro='{$bairro}',estado='{$estado}',numero='{$numero}',telefone='{$telefone}' WHERE id='{$id}'");
        echo "<script>Swal.fire({title: 'Sucesso', html: 'Filial editada com sucesso.', icon: 'success'});</script>";
    } else {
        $mysqli->query(
            "INSERT INTO filial (`barbearia`, `nome`, `rua`, `cep`, `bairro`, `numero`, `cidade`, `estado`, `telefone`) 
            VALUES 
            ('{$_SESSION['barbearia_id']}', '{$nome}', '{$rua}', '{$cep}', '{$bairro}', '{$numero}', '{$cidade}', '{$estado}', '{$telefone}')");
        echo "<script>Swal.fire({title: 'Sucesso', html: 'Filial adicionada com sucesso.', icon: 'success'});</script>";
    }

}

?>


 <!-- Cadastrar Serviço -->
 <div class="row" style="margin-right: 0px;margin-left: 0px;">
    <div class="col-md-12 mt-5">
            <div class="profile-header">
                <h4 class="ml-3 pt-1">
                <i class="fas fa-plus"></i> Cadastrar Filial
                </h4>
            </div>
            <div class="profile-a ">
                <form class="example-form" method="POST" action="cadastrarFilial" style="text-align: left;">
                <input type="hidden" name="id" value="<?=@$filialD['id']?>" />
                    <div class="row">
                        <div class="col-md-6">
                            <label>
                                Nome da Filial:
                            </label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="nome"
                                value="<?=@$filialD['nome']?>" required
                            >
                        </div>

                        <div class="col-md-6">
                            <label>
                                CEP
                            </label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="cep" id="cep"
                                value="<?=@$filialD['cep']?>" required
                            >
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>
                                Endereço
                            </label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="rua" id="rua"
                                value="<?=@$filialD['rua']?>" required
                            >
                        </div>

                        <div class="col-md-6">
                            <label>
                                Bairro
                            </label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="bairro" id="bairro"
                                value="<?=@$filialD['bairro']?>" required
                            >
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>
                                Cidade:
                            </label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="cidade" id="cidade"
                                value="<?=@$filialD['cidade']?>" required
                            >
                        </div>

                        <div class="col-md-6">
                            <label>
                                Estado
                            </label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="estado" id="estado"
                                value="<?=@$filialD["estado"]?>" required
                            >
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>
                                Nº
                            </label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="numero" id="numero"
                                value="<?=@$filialD["numero"]?>" required
                            >
                        </div>

                        <div class="col-md-6">
                            <label>
                                Telefone
                            </label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="telefone" id="telefone"
                                value="<?=@$filialD["telefone"]?>" required
                            >
                        </div>
                        
                    </div>
                    <?php if(isset($filialD["id"])): ?>
                    <a href="cadastrarFilial" target="_self"
                        class="btn btn-danger mt-4"
                        name="adicionar_servico"
                    >
                        <i class="fas fa-plus mr-1"></i> 
                        <span>Cancelar</span>
                            </a>
                    <?php endif; ?>
                    <button 
                        class="btn btn-primary mt-4"
                        name="adicionar_servico"
                    >
                        <i class="fas fa-plus mr-1"></i> 
                        <span>Salvar</span>
                    </button>
                </form>
            </div>
        </div>
</div>

<div class="row" style="margin-right: 0px;margin-left: 0px;">
    <!-- Filiais cadastrados -->
    <div class="col-md-12 mt-4 mb-4">
        <div class="profile-header">
            <h4 class="ml-3 pt-1"> 
            <i class="fas fa-cut"></i> Filiais cadastradas
            </h4>
        </div>
        <div class="profile-a">
            <div class="table-responsive-sm">
                <table class="table table-striped tabelaCustom">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">CEP</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">Bairro</th>
                            <th scope="col">Cidade</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Nº</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    
                    <tbody>

                        <?php 
                            include "../config/config.php";

                            $filiais = $mysqli->query("SELECT * FROM filial WHERE barbearia = '" . $_SESSION["barbearia_id"] . "' ORDER BY id ASC");
                            //$filiais = $filiais->fetch_array(MYSQLI_ASSOC);
                            if($filiais->num_rows > 0){

                                while($filial = $filiais->fetch_assoc()){
      
                                    echo "
                                        <tr>
                                            <th scope='row'>{$filial["id"]}</th>
                                            <td>{$filial["nome"]}</th>
                                            <td>{$filial["cep"]}</th>
                                            <td>{$filial["rua"]}</th>
                                            <td>{$filial["bairro"]}</th>
                                            <td>{$filial["cidade"]}</th>
                                            <td>{$filial["estado"]}</th>
                                            <td>{$filial["numero"]}</th>
                                            <td>{$filial["telefone"]}</th>
                                            <td>{$filial["status"]}</th>
                                            <td>
                                                
                                                <a 
                                                    href='?filial={$filial["id"]}' 
                                                    class='btn btn-sm btn-primary inativar-filial'
                                                    title='Editar'
                                                    filial='{$filial["id"]}'
                                                >
                                                    <i class='fa fa-edit'></i>
                                                </a>";

                                                if($filial["status"] === "I"):
                                                    echo "<a 
                                                    href='?acao=ativar&filial={$filial['id']}' 
                                                    class='btn btn-sm btn-success inativar-filial'
                                                    title='Ativar Filial'
                                                  >
                                                <i class='fa fa-lock-open'></i></a>
                                                ";
                                                else:
                                                    echo "

                                                <a 
                                                    href='?acao=inativar&filial={$filial['id']}' 
                                                    class='btn btn-sm btn-warning inativar-filial'
                                                    title='Inativar Filial'
                                                >
                                                    <i class='fa fa-lock'></i>
                                                </a>
                                                ";
                                                endif;
                                                echo "
                                            </td>
                                        </tr>
                                    
                                    ";
                                }

                            } else {
                                echo "<h5 class='sb-txt-primary sb-w-500 mb-3'>Não há filiais cadastradas</h5>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>    
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>

        $(document).ready(function() {


            $('#cep').mask('99999-999');
            $('#telefone').mask('(99) 99999-9999');

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#estado").val("");
                $("#numero").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#estado").val("...");
                        //$("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#estado").val(dados.uf);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });


        });

</script>

