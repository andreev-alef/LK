<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <script type="text/javascript">
            $(document).ready(function () {
                var domainname = 'https://study.edu.tele-med.ai';
                var token = 'e34754ef2e1ce0df4c8ca95f96f040cf';
                var functionname = 'core_course_get_courses';
                var serverurl = domainname + '/webservice/rest/server.php';
                var data = {
                    wstoken: token,
                    wsfunction: functionname,
                    moodlewsrestformat: 'json',
                    //id: 73 //Retrieve results based on course Id 2
                }
                var response = $.ajax(
                        {type: 'GET',
                            data: data,
                            dataType: "json", // тип загружаемых данных
                            url: serverurl,
                            success: function (data, textStatus) {
                                var jsn = data;
                                if (typeof jsn.errorcode !== undefined) {
                                    //$('#data_out').html(JSON.stringify(jsn[1]));
                                    var N = jsn.length;
                                    for (i = 0; N > i; i++) {
                                        $('#data_out').append(jsn[i].id + ' ' + jsn[i].shortname + ' ' + jsn[i].fullname + '<hr />');
                                    }
                                } else {
                                    $('#data_out').html('<b>' + jsn.exception + '<br />'
                                            + jsn.errorcode + '<br />'
                                            + jsn.message + '<br /></b>');
                                }
                                console.log(jsn);
                                console.log(typeof jsn.errorcode);
                            }
                        }
                );
            }
            );
        </script>
    </head>
    <body class="d-flex flex-column h-100">
        <?php $this->beginBody() ?>

        <header>
            <?php
            NavBar::begin([
                'brandLabel' => 'Сервисы moodle :: НПКЦ ДиТТ ДЗМ',
//        'brandLabel' => Yii::$app->name,
                'brandUrl' => ['/moodle/index'], //Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav'],
                'items' => [
                    ['label' => 'Главная', 'url' => ['/moodle/index']],
                    ['label' => 'О нас…', 'url' => ['/moodle/about']],
                    ['label' => 'Контакты', 'url' => ['/site/contact']],
                    Yii::$app->user->isGuest ? (
                            ['label' => 'Вход', 'url' => ['/moodle/login']]
                            ) : (
                            '<li>'
                            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                            . Html::submitButton(
                                    'Logout (' . Yii::$app->user->identity->username . ')',
                                    ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm()
                            . '</li>'
                            )
                ],
            ]);
            NavBar::end();
            ?>
        </header>

        <main role="main" class="flex-shrink-0">
            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>

        <footer class="footer mt-auto py-3 text-muted">
            <div class="container">
                <p class="float-left">&copy; НПКЦ ДиТТ ДЗМ <?= date('Y') ?></p>
                <p class="float-right">Разработано alef</p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
