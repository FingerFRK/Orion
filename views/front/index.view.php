<section class="row">
    <div class="col-12 text-center mt-auto mb-auto">
        <h1 class="display-1">Orion</h1>
        <p>
            <a href="https://github.com/FingerFRK/Orion">GitHub</a>
            <a href="https://www.orion.com/docs">Docs</a>
        </p>
    </div>
</section>

<section class="row">

    <div class="col-12 card">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pseudonyme</th>
                    <th scope="col">Date d'inscription</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($users as $user): ?>
                <tr>
                    <th scope="row"><?= $user->id ?></th>
                    <td><?= $user->username ?></td>
                    <td><?= $user->created_at ?></td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>    

</section>