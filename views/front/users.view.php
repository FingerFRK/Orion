<?php

    $toto = Orion::getInstance()->getModel('User')->find(1);

?>
<section class="row">
    <div class="col-12 text-center mt-auto mb-auto">
        <h1 class="display-1"><?= $toto->abeudada ?></h1>
    </div>
</section>