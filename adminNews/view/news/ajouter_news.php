<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ega0969x7db93gxcfpcqm0gmovn014d5345i92jqankvajd6"></script>
<script>
    tinymce.init({ 
        selector:'textarea', 
        menubar: false,
        language: 'fr_FR', 
        language_url : 'fr_FR.js',
        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'insertdatetime media table contextmenu paste help wordcount'
          ],
        image_list: [
            <?php 
                foreach($images as $image){
                    echo "{title: '".$image['path']."', value: '../images/".$image['path']."'},";
                }
            ?>
        ],        
        toolbar: 'insert | undo redo |  formatselect | bold italic underline strikethrough forecolor backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | table | help',
    });
</script>
<div class="container" style="margin-top:20px;">
    <form action="index.php?ctrl=news&action=ajouter_action" method="post">
        <div class="form-group">
            <label for="titre">Titre de la news :</label>
            <input class="form-control" type="text" value="" name="titre" id="titre">
        </div>
        <br>
        <div class="form-check">
            <label class="form-check-label">
                <input name="accueil" id="accueil" type="checkbox" class="form-check-input">
                Afficher en page d'accueil
            </label>
        </div>
        <br>
        <div class="form-group">
            <label for="date_news">Date de la news :</label>
            <input class="form-control" type="date" value="" name="date_news" id="date_news">
        </div>
        <div class="form-group">
            <label for="contenu">Contenu de la news :</label>
            <textarea name="contenu" class="form-control" id="contenu" rows="3" style="height:500px;"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter cette news</button>
    </form>
</div>
<style>
    i{
        cursor:pointer;
    }
</style>