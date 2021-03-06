<?php $this->override('template'); ?>

<?php $this->block('title'); ?>
    404 Not Found
<?php $this->endblock('title'); ?>

<?php $this->block('body'); ?>
    <main class="container">

        <section class="row">
            <div class="col-12 text-center mt-auto mb-auto">
                <h1 class="display-1">Error 404</h1>
                <p class="">Page not found :(</p>
                <p>
                    <a href="https://github.com/FingerFRK/Orion">GitHub</a>
                    <a href="https://www.orion.com/docs">Docs</a>
                </p>
            </div>
        </section>

    </main>
<?php $this->endblock('body'); ?>