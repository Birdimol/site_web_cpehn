<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ega0969x7db93gxcfpcqm0gmovn014d5345i92jqankvajd6"></script>
<script>tinymce.init({ selector:'textarea', language: 'fr_FR', language_url : 'public/js/langs/fr_FR.js'});</script>
<div class="container" style="margin-top:20px;">
    <form action="index.php?ctrl=image&action=ajouter_action" method="post" enctype="multipart/form-data">
        <br>
        <div class="form-group">
            <input type="file" class="form-control-file" id="image" name="image">
            <small class="form-text text-muted"></small>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Ajouter cette image</button>
    </form>
</div>
<style>
    i{
        cursor:pointer;
    }
</style>