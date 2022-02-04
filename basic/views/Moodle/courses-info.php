<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'НПКЦ ДиТТ ДЗМ :: Сервисы Moodle';
?>
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
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Категории и курсы</h1>

        <!-- <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua.</p> -->

        <!-- <p><a class="btn btn-lg btn-success" href="#">Lorem ipsum dolor</a></p> -->
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-8">
                <h2>Информация о курсах</h2>

                <p id="data_out"></p>

                <p><a class="btn btn-outline-secondary" href="<?= Url::to(['moodle/index']) ?>">
                        <?= Url::to(['moodle/index']) ?>
                    </a></p>
            </div>
            <!--
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="#">Lorem ipsum dolor</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="#">Lorem ipsum dolor</a></p>
            </div>
            -->
        </div>

    </div>
</div>
