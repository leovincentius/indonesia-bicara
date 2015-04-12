<?php
$this->title = "Hasil Diskusi";
?>
<h1>Hasil Diskusi</h1>
<?php
foreach($model as $key => $news){
    ?>
    <div class="jumbotron">
        <h2><?= $news->title ?></h2>
        <?= $news->content ?>
    </div>
    <?php
}
?>
