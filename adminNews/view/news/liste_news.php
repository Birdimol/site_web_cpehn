<div class="container" style="margin-top:20px;">
    <div style="text-align: right;margin-bottom: 10px;">
        <a href="index.php?ctrl=news&action=ajouter">
            <button class="btn btn-primary">Ajouter une news</button>
        </a>
    </div>
    <table class="table table-bordered table-hover">
        <thead>
            <th>Titre</th>
            <th>Date news</th>
            <th>Accueil</th>
            <th>Action</th>
        </thead>
        <tbody>
        <?php 
            foreach($news as $new){
                echo '<tr>'
                    . '<td>'.$new['titre'].'</td>'
                    . '<td>'.$new['date_news'].'</td>'
                    . '<td>';
                if($new['accueil']){
                    echo "oui";
                }else{
                    echo "non";
                }
                echo '</td>'
                    . '<td style="text-align:center;" >'
                        . '<a href="index.php?ctrl=news&action=modifier&id='.$new['id'].'"><i class="fas fa-edit"></i></a>'
                        . '&nbsp;'
                        . '<a href="index.php?ctrl=news&action=supprimer_action&id='.$new['id'].'"><i class="fas fa-trash"></i></a>'
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