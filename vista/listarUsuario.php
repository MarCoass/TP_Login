<?php include_once('common/header.php') 
    
?>

<div class="container-md my-4 mt-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Usuario</th>
                <th scope="col">Rol</th>
            </tr>
        </thead>
        
            <?php
            $i = 0;
            while ($i < $cantUsuarios) {
            ?>
                <tbody>
                    <tr>
                        <th>Usuario</th>
                        <td>Rol</td>
                    </tr>
                </tbody>
            <?php
                $i++;
            }
            ?>
        

    </table>
</div>

<?php include_once('common/footer.php') ?>