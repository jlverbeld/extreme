<?php 

    include '../../globalConfig.php';
    include '../../class/clsConnectDB.php';
    include '../../class/clsDashboard.php';
    $Dashboard = new Dashboard();
    $listClients = $Dashboard->listadoClientes();
    $listPQRs = $Dashboard->listPQR();
    include '../header.php';
    include '../../class/PHPExcel/PHPExcel.php';
    include '../../class/PHPExcel/PHPExcel/IOFactory.php';
?>

<link rel="stylesheet" href="../../assets/css/styles/dashboard.scss">

<?php
    if($_SESSION['rol'] == 'Administrador'){
?>

    <div class="h-100 p-3  flex-column">
            
        <div class="row">
            <div class="col-md-12">
                <h3>Listado De PQRs</h3>
            </div>
            <div class="col-md-12">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre Completo</th>
                            <th scope="col">Tipo de PQR</th>
                            <th scope="col">Asunto</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha de Creación</th>
                            <th scope="col">Fecha Límite</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php

                        if(isset($listPQRs['ErrorStatus']) && $listPQRs['ErrorStatus'] ==  1){
                            ?>
                        <tr>
                            <td colspan="4">No Existe ningún PQR</td>
                        </tr>
                        <?php
                        }else{
                            foreach($listPQRs as $l){
                                ?> 
                                <td>
                                    <?= $l['id']?>
                                </td>
                                <td>
                                    <?= ucwords( $l['firstname'] .' '. $l['lastname'] )?>
                                </td>
                                <td class="tipodepqr">
                                    <?= $l['tipo_pqr']?>
                                </td>
                                <td style=" width: 400px; text-align: justify">
                                    <?= $l['asunto_pqr']?>
                                </td>
                                <td>
                                    <?php 
                                        if($l['estado'] == 'Nuevo'){
                                            ?>
                                                <span class="estadoPqr nuevo">
                                                    <?=$l['estado'] ?>
                                                </span>
                                            <?php
                                        }else if($l['estado'] == 'En ejecución'){
                                            ?>
                                                <span class="estadoPqr enejecucion">
                                                    <?=$l['estado'] ?>
                                                </span>
                                            <?php
                                        }else if($l['estado'] == 'Cerrado'){
                                            ?>
                                                <span class="estadoPqr cerrado">
                                                    <?=$l['estado'] ?>
                                                </span>
                                            <?php
                                        }else if($l['estado'] == 'Vencida'){
                                            ?>
                                                <span class="estadoPqr vencida">
                                                    <?=$l['estado'] ?>
                                                </span>
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?= $l['fecha_creacion']?>
                                </td>
                                <td>
                                    <?= $l['fecha_limite']?>
                                </td>
                                <td>
                                    <?php 
                                        if($l['estado'] != 'Cerrado'){
                                            if($l['estado'] != 'Vencida'){
                                                ?>
                                                <button class="btn btn-warning" 
                                                    onClick="cargarPQR(<?= $l['id']?>)" 
                                                    data-toggle="modal" data-target="#pqr">
                                                    <span class="fa fa-edit"></span>
                                                </button>
                                                <?php
                                            }
                                        }
                                        
                                    ?>
                                    
                                </td>
                                <td>
                                    <button class="btn btn-danger " 
                                        onClick="eliminarPQR(<?= $l['id']?>)">
                                        <span class="fa fa-trash"></span>
                                    </button>
                                </td>
                            </tr>
                                <?php
                            }
                    
                        }
                        ?>
                    
                    
                    </tbody>
                </table>
            </div>
        </div>



        <div class="row">
            <div class="col-md-12">
                <h3>Listado De Usuarios</h3>
            </div>
            <div class="col-md-9">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">ROL</th>
                            <th scope="col">PQR</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if(isset($listClients['ErrorStatus']) && $listClients['ErrorStatus'] ==  1){
                            ?>
                        <tr>
                            <td colspan="4">No hay datos</td>
                        </tr>
                        <?php
                        }else{
                            foreach($listClients as $client){ ?>
                        <tr>
                            <td><?=$client['id']?></td>
                            <td><?= ucwords($client['firstname'])?></td>
                            <td><?= ucwords($client['lastname'])?></td>
                            <td><?=$client['email']?></td>
                            <td><?=$client['phone']?></td>
                            <?php
                                if($client['rol'] == 'Administrador'){
                                    ?>
                            <td class="admin"><?=$client['rol']?></td>
                            <?php
                                }else if($client['rol'] == 'Usuario'){
                                    ?>
                            <td class="user"><?=$client['rol']?></td>
                            <?php
                                }
                            ?>
                            <td>
                                <?php 
                                    if($client['rol'] == 'Usuario'){
                                        ?>
                                        <button class="btn btn-info" onClick="cargarUsuarioPQR(<?= $client['id']?>)"
                                            data-toggle="modal" data-target="#pqr">
                                            <span class="fa fa-plus"></span>
                                        </button>
                                        <?php
                                    }
                                ?>
                            
                            </td>
                            <td >
                                <button class="btn btn-warning" onClick="editarCliente(<?= $client['id']?>)">
                                    <span class="fa fa-edit"></span>
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-danger " onClick="eliminarCliente(<?= $client['id']?>)">
                                    <span class="fa fa-trash"></span>
                                </button>
                            </td>
                        </tr>
                        <?php
                            }
                        } ?>
                    </tbody>
                </table>
            </div>


            <div class="col-md-3">

                <form class="formulario">
                    <div class="form-group">
                        <div class="iconoClients">
                            <i class="fa fa-users" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" placeholder="idCliente" class="form-control" id="idCliente">
                    </div>

                    <div class="form-group">
                        <input type="text" placeholder="Usuario" class="form-control" 
                        id="usuario">
                    </div>

                    <div class="form-group">
                        <input type="password" placeholder="Contraseña" class="form-control" 
                        id="password">
                    </div>


                    <div class="form-group">
                        <input type="text" placeholder="Nombre" class="form-control" id="nombre" >
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="apellido" class="form-control" id="apellido">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="E-mail" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Teléfono" class="form-control" id="telefono">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="comentario" placeholder="Comentario"></textarea>
                    </div>

                    <button type="button" onclick="guardarDatos()" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>

        <a class="btn btn-success" style="color:#fff" onClick="generarExcel()" >
            Generar Excel
        </a>

        <footer class="mastfoot mt-auto">
            <div class="inner">
                <p>Created By - Jorge luis verbel diaz.</p>
            </div>
        </footer>

    </div>
<?php 
    }else if($_SESSION['rol'] == 'Usuario'){
?>

    <div class="h-100 p-3 flex-column">
        <div class="row">
            <div class="col-md-12">
                <h3>Listado De PQRs</h3>
            </div>
            <div class="col-md-12">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tipo de PQR</th>
                            <th scope="col">Asunto</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha de Creación</th>
                            <th scope="col">Fecha Límite</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php

                        if(isset($listPQRs['ErrorStatus']) && $listPQRs['ErrorStatus'] ==  1){
                            ?>
                        <tr>
                            <td colspan="4">No Existe ningún PQR</td>
                        </tr>
                        <?php
                        }else{
                            foreach($listPQRs as $l){
                                if($l['id_usuario'] == $_SESSION['idUsuario']){
                                    ?> 
                                    <td>
                                        <?= $l['id']?>
                                    </td>
                                    
                                    <td class="tipodepqr">
                                        <?= $l['tipo_pqr']?>
                                    </td>
                                    <td style=" width: 400px; text-align: justify">
                                        <?= $l['asunto_pqr']?>
                                    </td>
                                    <td>
                                        <?php 
                                            if($l['estado'] == 'Nuevo'){
                                                ?>
                                                    <span class="estadoPqr nuevo">
                                                        <?=$l['estado'] ?>
                                                    </span>
                                                <?php
                                            }else if($l['estado'] == 'En ejecución'){
                                                ?>
                                                    <span class="estadoPqr enejecucion">
                                                        <?=$l['estado'] ?>
                                                    </span>
                                                <?php
                                            }else if($l['estado'] == 'Cerrado'){
                                                ?>
                                                    <span class="estadoPqr cerrado">
                                                        <?=$l['estado'] ?>
                                                    </span>
                                                <?php
                                            }else if($l['estado'] == 'Vencida'){
                                                ?>
                                                    <span class="estadoPqr vencida">
                                                        <?=$l['estado'] ?>
                                                    </span>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?= $l['fecha_creacion']?>
                                    </td>
                                    <td>
                                        <?= $l['fecha_limite']?>
                                    </td>
                                </tr>
                                    <?php
                                }
                              
                            }
                    
                        }
                        ?>
                    
                    
                    </tbody>
                </table>
            </div>
        </div>

    </div>
<?php
    }
?>

<!-- Modal -->
<div class="modal fade" id="pqr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloPqr"  > </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">



                <div class="form-group">
                    <input type="hidden" id="idPQR" placeholder="idpqr">
                </div>
                <div class="form-group">
                    <input type="hidden" placeholder="idUsuario" class="form-control" id="idUsuario">
                </div>
                <div class="form-group">
                    <select class="form-control" name="tipo_pqr" id="tipo_pqr">
                        <option value="">Seleccionar Tipo de PQR</option>
                        <option value="Petición">Petición</option>
                        <option value="Queja">Queja</option>
                        <option value="Reclamo">Reclamo</option>
                    </select>
                </div>

                <div class="form-group">
                    <textarea class="form-control" id="asunto_pqr" placeholder="Asunto PQR"></textarea>
                </div>

                <div class="form-group" id="estadosPQR">
                    <select class="form-control" name="estado_pqr" id="estado_pqr">
                        <option value="">Estado PQR</option>
                        <option value="Nuevo">Nuevo</option>
                        <option value="En ejecución">En ejecución</option>
                        <option value="Cerrado">Cerrado</option>
                    </select>
                </div>


             
        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="accionBtnPqr"
                class="btn btn-primary" onclick="guardarPQR()">Crear</button>
            </div>
        </div>
    </div>
</div>

<script src="../../assets/plugins/jquery/jquery.js"></script>
<script src="dashboard.js"></script>
<?php include '../footer.php';  