<?php $this->extend("layouts/template")?>

<?php $this->section("content")?>

<div class="container mt-5">
    <div class="card mb-3 <?=!session("update") ? "mt-5" : "d-none"?>" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="/images/<?=$student["image"]?>" alt="student image"
                    class="rounded-circle image-detail mt-3 ml-2 mr-2">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Detail Siswa <?=$student["name"]?></h5>
                    <p class="card-text">Nama : <?=$student["name"]?></p>
                    <p class="card-text">Tempat, Tanggal Lahir : <?=$student["ttl"]?></p>
                    <p class="card-text">Jenis Kelamin : <?=$student["jenis_kelamin"]?></p>
                    <p class="card-text">Kelas : <?=$student["class"]?></p>
                    <p class="card-text">No Absen : <?=$student["no_absen"]?></p>
                    <p class="card-text"><small class="text-muted">Last updated </small></p>
                    <div class="d-block">
                        <div class="d-flex">
                            <button class="btn btn-sm btn-outline-primary mr-2 editButton">Edit</button>
                            <form action="/siswa/<?=$student["id"]?>" method="post">
                                <?=csrf_field()?>
                                <input required type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                            </form>
                        </div>
                    </div>
                    <a href="/siswa" class="btn btn-sm btn-secondary float-right mb-2">Kembali</a>
                </div>
            </div>
        </div>

    </div>

    <form class="<?=session("update") ? "mt-5" : "d-none"?> updateFrom" method="POST" 
    action="/siswa/<?= $student["id"] ?>" enctype="multipart/form-data">
        <?=csrf_field()?>
        <input type="hidden" name="_method" value="PATCH">
        <button type="button" class="btn btn-sm btn-outline-primary editButton mb-3">Detail Siswa</button>
        <h3 class="mb-3">Ubah Data Siswa</h3>
        <div class="form-group">
            <label for="foto_siswa">
                Foto Siswa
            </label>
            <img src="/images/<?=$student["image"]?>" alt="student image"
                    class="rounded-circle image-detail mt-3 ml-2 mr-2 d-block mb-2">
            <input disabled id="foto_siswa" name="image" type="file" class="form-control col-lg-4">
        </div>
        <div class="form-group">
            <label for="nama_siswa">
                Nama Siswa
            </label>
            <input required value="<?=old("name") ?? $student["name"]?>" id="nama_siswa" name="name" type="text"
                class="form-control <?=($validation->hasError('name')) ? 'is-invalid' : ""?>"
                aria-describedby="nameFeedback">
            <div id="nameFeedback" class="invalid-feedback">
                <?=$validation->getError("name")?>
            </div>
        </div>
        <div class="form-group">
            <label for="ttl">
                Tempat, Tangal Lahir
            </label>
            <input required value="<?=old("ttl") ?? $student["ttl"]?>" id="ttl" name="ttl" type="date"
                class="form-control <?=($validation->hasError('ttl')) ? 'is-invalid' : ''?>"
                aria-describedby="ttlFeedback">
            <div id="ttlFeedback" class="invalid-feedback">
                <?=$validation->getError("ttl")?>
            </div>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">
                Jenis Kelamin
            </label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="custom-select">
                <?php if($student["jenis_kelamin"] === "Laki-Laki") : ?>
                    <option selected value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                <?php else : ?>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option selected value="Perempuan">Perempuan</option>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="class">
                Kelas
            </label>
            <input required value="<?=old("class") ?? $student["class"]?>" id="class" name="class" type="text"
                class="form-control <?=($validation->hasError('class')) ? 'is-invalid' : ''?>"
                aria-describedby="classFeedback">
            <div id="classFeedback" class="invalid-feedback">
                <?=$validation->getError("class")?>
            </div>
        </div>
        <div class="form-group">
            <label for="no_absen">
                No Absen Siswa
            </label>
            <input required value="<?=old("no_absen") ?? $student["no_absen"]?>" id="no_absen" name="no_absen" type="number" class="form-control
                            <?=($validation->hasError('no_absen')) ? 'is-invalid' : ''?>"
                aria-describedby="noAbsenFeedback">
            <div id="noAbsenFeedback" class="invalid-feedback">
                <?=$validation->getError("no_absen")?>
            </div>
        </div>

        <button type="submit" class="btn btn-outline-success">Edit</button>
    </form>
</div>

<?php $this->endSection()?>