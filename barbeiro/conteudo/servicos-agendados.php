<?php
$conn = mysqli_connect("localhost", "root", "", "dbtcc");
$select = ("CALL PROC_AGENDAMENTOS_BARBEARIA('{$_SESSION['barbearia_id']}')");
$query = $conn->query($select);
?>
<div class="container-fluid pt-5 pb-5">
    <div class="profile-header">
        <h2>
            <fa-icon [icon]="faClock"></fa-icon> Serviços Agendados
        </h2>
    </div>
    <div class="profile-a" style="display: block; overflow: auto;">
        <table style="text-align: center;" id="tabela_servicos_agendados" class="display">
            <div>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Data agendamento</th>
                        <th>Horario agendamento</th>
                        <th>Serviços solicitados</th>
                        <th>Nome do cliente</th>
                        <th>Valor T.</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
            </div>
            <tbody id="agend">
                <?php
                while ($dados = mysqli_fetch_assoc($query)) {
<<<<<<< HEAD
=======
                    
                    $cab = null;
                    $filial = $null;

                    if($dados["cabeleleiro"] != null){
                        $cab = $mysqli->query("SELECT * FROM cabeleleiros WHERE id = {$dados["cabeleleiro"]}");
                        if($cab !== false)
                            $cab = $cab->fetch_assoc();
                    }

                    if($dados["filial"] != null){
                        $filial = $mysqli->query("SELECT * FROM filial WHERE id = {$dados["filial"]}");
                        if($filial !== false)
                            $filial = $filial->fetch_assoc();
                    }

>>>>>>> 02e9dcea34cb572a047bc63c5684a7f218fe9d0e
                ?>
                    <tr>
                        <td><?php echo $dados['id_agendamento'] ?></td>
                        <td><?php echo date('d/m/Y', strtotime($dados['data_agendamento'])) ?></td>
                        <td><?php echo $dados['horario_agendamento'] ?></td>
                        <td><?php echo $dados['nome_servico'] ?></td>
                        <td><?php echo $dados['nome_usuario'] ?></td>
                        <td>R$ <?php echo $dados['valor_total']?></td>
                        <?php if (strtolower($dados['status']) == 'p') {
                        ?>
                            <td>Pendente</td>
                            <td><button data-toggle="modal" data-target="#modal<?php echo $dados['id_agendamento'] ?>" class="btn btn-success">
                                    <i class="fas fa-check"></i></button></td>
                        <?php
                        } elseif (strtolower($dados['status']) == 'f') {
                        ?>
                            <td>Concluído</td>
                            <td>#</td>
                        <?php
                        } else {
                            echo ('<td>Cancelado</td>');
                            echo ('<td>#</td>');
                        } ?>
                    </tr>

                <?php

                }
                $conn->next_result();
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$select = ("SELECT id_agendamento from agendamento WHERE barbearia='$_SESSION[barbearia_id]'");
$query = $conn->query($select);
while ($dados = mysqli_fetch_assoc($query)) {
?>
    <div class="modal fade" id="modal<?php echo $dados['id_agendamento'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deseja finalizar o serviço?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <form method="post" action="./servicos-agendados">
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button name="gg" value="<?php echo $dados['id_agendamento'] ?>" type="submit" class="btn btn-success">Finalizar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
<?php
    #print_r($dados);
    #echo ('<br>');
}
?>