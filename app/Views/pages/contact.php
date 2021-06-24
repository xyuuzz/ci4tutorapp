<?=$this->extend("layouts/template")?>

<?=$this->section("content")?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h2>Contact Us!</h2>
            <ul class="list-group">
                <?php foreach ($alamat as $a): ?>
                <li class="list-group-items"><?=$a["tipe"]?></li>
                <li class="list-group-items"><?=$a["alamat"]?></li>
                <li class="list-group-items mb-3"><?=$a["kota"]?></li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</div>
<?=$this->endSection()?>