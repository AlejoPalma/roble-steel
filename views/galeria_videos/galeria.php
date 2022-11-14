<!-- Galeria de videos -->
<div class="container mb-5">
    <section>
        <h2 class="text-center mb-4 pt-3">Galeria de videos</h2>
        <div class="row">
            <?php while ($video_galeria = $galeria->fetch_object()) : ?>
                <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                    <video class="w-100" controls>
                        <source src="<?= base_url ?>uploads/galeria_videos/<?= $video_galeria->video ?>" />
                    </video>
                    <p class="fw-bold text-center">
                        <?= $video_galeria->nombre ?>
                    </p>
                </div>
            <?php endwhile ?>
        </div>
    </section>
</div>