<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */
?>
<div class="site-contact">
    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>

    <?php else: ?>

        <div class="row">
            <div class="col-md-8">
                <div class="jumbotron">
                    <h2>Pendaftaran Diskusi Online</h2>
                    <form role="form">
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control" id="nama" placeholder="Masukkan nama" required="required">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Masukkan email" required="required">
                        </div>
                        <div class="form-group">
                            <label for="lineID">Line ID:</label>
                            <input type="text" class="form-control" id="lineID" placeholder="Masukkan Line ID" required="required">
                        </div>
                        <div class="form-group">
                            <label for="tlp">Nomor Telepon:</label>
                            <input type="text" class="form-control" id="tlp" placeholder="Masukkan nomor telepon" required="required">
                        </div>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jumbotron">
                    <h2>Kontak Kami:</h2>

                    Kevin<br>
                    No Telepon: +6285695095093<br>
                    Email: kevintanunpar@yahoo.co.id<br>
                </div>
            </div>
        </div>

    <?php endif; ?>
</div>
