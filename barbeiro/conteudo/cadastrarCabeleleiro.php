<?php
require_once __DIR__ . "/../../config/config.php";

if(isset($_GET['cabeleleiro'])){
    $cab = $mysqli->query("SELECT * FROM cabeleleiros WHERE barbearia = '" . $_SESSION["barbearia_id"] . "' AND id = '{$_GET['cabeleleiro']}' ORDER BY id ASC");
    $cab = $cab->fetch_assoc();


    if(isset($_GET['acao']) && $_GET['acao'] === 'inativar'){
        $mysqli->query("UPDATE cabeleleiros SET `status` = 'I' WHERE id = '{$cab['id']}'");
        $cab = null;
        echo "<script>Swal.fire({title: 'Sucesso', html: 'Cabeleleiro inativado com sucesso.', icon: 'success'});</script>";
    }
    if(isset($_GET['acao']) && $_GET['acao'] === 'ativar'){
        $mysqli->query("UPDATE cabeleleiros SET `status` = 'A' WHERE id = '{$cab['id']}'");
        $cab = null;
        echo "<script>Swal.fire({title: 'Sucesso', html: 'Cabeleleiro ativado com sucesso.', icon: 'success'});</script>";
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = @$_POST['id'];
    $nome = $_POST['nome'];
    $filiais = $_POST['filiais'];
    
    if($id !== ''){
        $mysqli->query("UPDATE cabeleleiros SET nome='{$nome}', filiais='{$filiais}' WHERE id='{$id}'");
        echo "<script>Swal.fire({title: 'Sucesso', html: 'Filial editada com sucesso.', icon: 'success'});</script>";
    } else {
        $mysqli->query(
            "INSERT INTO cabeleleiros (`nome`, `filiais`, `barbearia`) 
            VALUES 
            ('{$nome}', '{$filiais}', '{$_SESSION['barbearia_id']}')");
        echo "<script>Swal.fire({title: 'Sucesso', html: 'Cabeleleiro adicionado com sucesso.', icon: 'success'});</script>";
    }

}

    $filiais = $mysqli->query("SELECT * FROM filial WHERE barbearia = '" . $_SESSION["barbearia_id"] . "'");
    if($filiais)
    $filiais = $filiais->fetch_all(MYSQLI_ASSOC);

?>

<div class="row pt-5" style="margin-right: 0px;margin-left: 0px;">
    <!-- Filiais cadastrados -->
    <div class="col-md-8 mt-5 mb-5">
        <div class="profile-header">
            <h4 class="ml-3 pt-1"> 
            <i class="fas fa-cut"></i> Cabeleleiros Cadastrados 
            </h4>
        </div>
        <div class="profile-a">
            <div class="table-responsive-sm">
                <table class="table table-striped tabelaCustom">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Filial</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    
                    <tbody>

                        <?php 
                            include "../config/config.php";

                            $cabeleleiros = $mysqli->query("SELECT * FROM cabeleleiros WHERE barbearia = '" . $_SESSION["barbearia_id"] . "' ORDER BY id ASC");
                            //$filiais = $filiais->fetch_array(MYSQLI_ASSOC);
                            if($cabeleleiros->num_rows > 0){

                                while($cabel = $cabeleleiros->fetch_assoc()){
      
                                    echo "
                                        <tr>
                                            <th scope='row'>{$cabel["id"]}</th>
                                            <td>{$cabel["nome"]}</th>
                                            <td>{$cabel["filiais"]}</th>
                                            <td>{$cabel["status"]}</th>
                                            <td>
                                                
                                                <a 
                                                    href='?cabeleleiro={$cabel["id"]}'
                                                    class='btn btn-sm btn-primary inativar-filial'
                                                    title='Editar'
                                                    filial='{$cabel["id"]}'
                                                >
                                                    <i class='fa fa-edit'></i>
                                                </a>";

                                                if($cabel["status"] === "I"):
                                                    echo "<a 
                                                    href='?acao=ativar&cabeleleiro={$cabel['id']}' 
                                                    class='btn btn-sm btn-success inativar-filial'
                                                    title='Ativar Cabeleleiro'
                                                  >
                                                <i class='fa fa-lock-open'></i>
                                                </a>
                                          
                                                ";
                                                else:
                                                    echo "

                                                <a 
                                                    href='?acao=inativar&cabeleleiro={$cabel['id']}' 
                                                    class='btn btn-sm btn-warning inativar-filial'
                                                    title='Inativar Cabeleleiro'
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
                                echo "<h5 class='sb-txt-primary sb-w-500 mb-3'>Não há cabeleleiros cadastrados</h5>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>    
        </div>
    </div>

    <!-- Cadastrar Serviço -->
    <div class="col-md-4 mt-5 mb-5">
        <div class="profile-header">
            <h4 class="ml-3 pt-1">
            <i class="fas fa-plus"></i> Cadastrar Cabeleleiro
            </h4>
        </div>
        <div class="profile-a ">
            <form class="example-form" method="POST" action="cadastrarCabeleleiro" style="text-align: left;">
            <input type="hidden" name="id" value="<?=@$cab['id']?>" />
                <div class="row">
                    <div class="col-md-12">
                        <label>
                            Nome do Cabeleleiro
                        </label>
                        <input 
                            type="text" 
                            class="form-control"
                            name="nome"
                            value="<?=@$cab['nome']?>" required
                        >
                    </div>

                    
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label>
                            Filial
                        </label>
                        <select name="filiais" id="filiais" class="form-control" required>
                            <option value="">Selecione uma filial</option>
                            <?php
                                if($filiais)
                                    foreach($filiais as $k => $filial){
                                        $selected = @$cab['filiais'] == $filial["id"] ? ' selected' : '';
                                        echo "<option value='{$filial["id"]}' {$selected}>{$filial["id"]} - {$filial["nome"]}</option>";
                                    }
                            ?>
                        </select>
                    </div>
                    
                </div>
                <?php if(isset($cab["id"]) && !isset($_GET['acao'])): ?>
                <a href="cadastrarCabeleleiro" target="_self"
                    class="btn btn-danger mt-4"
                    name="adicionar_servico"
                >
                    <i class="fas fa-plus mr-1"></i> 
                    <span>Cancelar</span>
                        </a>
                <?php endif; ?>
                <button 
                    class="btn btn-primary mt-4"
                    name="adicionar_cabeleleiro"
                >
                    <i class="fas fa-plus mr-1"></i> 
                    <span>Salvar</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>

        $(document).ready(function() {


            

        });

</script>

