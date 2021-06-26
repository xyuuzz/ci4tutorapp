<?php $this->extend("layouts/template")?>

<?php $this->section("content")?>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-9">
            <div class="card mb-5">
                <div class="card-header">
                    <h4 class="d-inline">List Siswa</h4>
                    <form class="form-inline my-2 my-lg-0 float-right">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search"  aria-label="Search">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
                <div class="card-body">

                    <?php if (!session("view")): ?>
                    <button class="btn btn-outline-success mb-3 float-right tambah">Tambah Siswa</button>
                    <?php else: ?>
                    <a href="/siswa" class="btn btn-outline-secondary mb-3 float-right tambah d-block">List Siswa</a>
                    <?php endif;?>

                    <?php if (session("success")): ?>
                    <div class="alert alert-success mt-5" role="alert">
                        <?=session("success")?>
                    </div>
                    <?php endif;?>

                    <?php if (!session("view")): ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Foreach data listSiswa yang dikirmkan -->
                                <?php foreach ($listSiswa as $siswa): ?>
                                <!-- variable index for numbering row table -->
                                <tr class="text-center">
                                    <th scope="row"><?=$index++?></th>
                                    <td><img src="/images/<?=$siswa["image"]?>" alt="foto siswa"
                                            class="rounded-circle sampul">
                                    </td>
                                    <td><?=$siswa["name"]?></td>
                                    <td><?=$siswa["class"]?></td>
                                    <td><?=$siswa["jenis_kelamin"]?></td>
                                    <td class="text-center">
                                        <a href="/siswa/<?=$siswa["slug"]?>"
                                            class="btn badge badge-secondary mr-2">Detail</a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="paginate-el">
                        <!-- MEMANGGIL PAGE PAGINATE CUSTOM -->
                        <?= $pager->links("users", "custom_pagination") ?> 
                    </div>
                    <?php endif;?>

                    <form class="<?=session("view") ? "mt-5" : "d-none"?>" method="POST" action="/siswa/buat"
                        enctype="multipart/form-data">
                        <?=csrf_field()?>
                        <div class="form-group">
                            <label for="foto_siswa">
                                Foto Siswa
                            </label>
                            <div class="d-flex">
                                <div class="col-sm-2">
                                    <img src="/images/default.png" class="img-thumbnail img-preview">
                                </div>

                                <input id="foto_siswa" name="image" type="file" 
                                class="form-control col-lg-8
                                <?=($validation->hasError('image')) ? 'is-invalid' : ""?>" onchange="previewImage()">
                            </div>
                            <div id="imageFeedback" class="invalid-feedback">
                                <?=$validation->getError("image")?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_siswa">
                                Nama Siswa
                            </label>
                            <input value="<?=old("name")?>" id="nama_siswa" name="name" type="text"
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
                            <input value="<?=old("ttl")?>" id="ttl" name="ttl" type="date"
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
                                <option selected value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="class">
                                Kelas
                            </label>
                            <input value="<?=old("class")?>" id="class" name="class" type="text" class="form-control <?=($validation->hasError('class')) ? 'is-invalid' : ''?>"
                            aria-describedby="classFeedback">
                            <div id="classFeedback" class="invalid-feedback">
                                <?=$validation->getError("class")?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_absen">
                                No Absen Siswa
                            </label>
                            <input value="<?=old("no_absen")?>" id="no_absen" name="no_absen" type="number" class="form-control
                            <?=($validation->hasError('no_absen')) ? 'is-invalid' : ''?>"
                            aria-describedby="noAbsenFeedback">
                            <div id="noAbsenFeedback" class="invalid-feedback">
                                <?=$validation->getError("no_absen")?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection()?>