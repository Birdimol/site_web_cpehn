<div class="container" style="margin-top:20px;">
    <div style="text-align: right;margin-bottom: 10px;">
        <a href="index.php?ctrl=image&action=ajouter">
            <button class="btn btn-primary">Ajouter une image</button>
        </a>
    </div>
    <div style="text-align:center;"><?php if(isset($message)){echo $message.'<br><br>';} ?></div>
    <table class="table table-bordered table-hover">
        <thead>
            <th>Nom</th>
            <th>Aperçu</th>
            <th>Action</th>
        </thead>
        <tbody>
        <?php 
            foreach($images as $image){
                echo '<tr>'
                    . '<td style="vertical-align:middle;" >'.$image['path'].'</td>'
                    . '<td style="text-align:center;vertical-align:middle;" ><img style="height:50px;" src="../images/'.$image['path'].'" /></td>'
                    . '<td style="text-align:center;vertical-align:middle;" >'
                        . '<a href="index.php?ctrl=image&action=supprimer_action&path='.$image['path'].'"><i class="fas fa-trash"></i></a>'
                    . '</td>'
                . '</tr>';
            }
        ?>
        </tbody>
    </table>
</div>
<style>
    i{
        cursor:pointer;
    }
</style>