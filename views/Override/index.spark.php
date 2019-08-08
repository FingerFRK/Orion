<?php $this->override('template'); ?>

<?php $this->block('title'); ?>
    Default page
<?php $this->endblock('title'); ?>

<?php $this->block('body'); ?>
    <main class="container">
        <section class="row">
            <div class="col-12 text-center mt-auto mb-auto">
                <h1 class="display-1"><?= $title ?></h1>
                <h5 class="text-black-50"><?= $subtitle ?></h5>
                <hr class="w-25">
                <p>
                    <a href="https://github.com/FingerFRK/Orion">GitHub</a>
                    <a href="https://www.orion.com/docs">Docs</a>
                </p>
            </div>
        </section>
    </main>
<?php $this->endblock('body'); ?>