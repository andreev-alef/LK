<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <style type="text/css">
            body{
                font-family:'Verdana', monospace;
                font-size: 10pt;
            }
        </style>
        <script type="text/javascript" src="./jquery-3.6.0.min.js" ></script>
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
            });
        </script>
        <title></title>
    </head>
    <body>
        <div id="data_out">

        </div>
        <?php
        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        $token = 'e34754ef2e1ce0df4c8ca95f96f040cf';
        //$restformat = 'xml';
        $restformat = 'json';
        $functionname = 'core_course_get_courses';
        $domainname = 'https://study.edu.tele-med.ai';
        $course_info = new \stdClass;
        //$course_info->id = 73;
        $params = array('courses' => array($course_info));
        $params = ['ids' => [73, 36]];
/// REST CALL
//header('Content-Type: text/plain');
        $serverurl = $domainname . '/webservice/rest/server.php'
                . '?wstoken=' . $token
                . '&wsfunction=' . $functionname;

        require_once('./curl.php');
//        $curl = new \curl();
//если формат == 'xml', тогда не добавляем параметр для обратной совместимости с Moodle < 2.2
        $restformat = ($restformat == 'json') ? '&moodlewsrestformat=' . $restformat : '';
        //      $resp = $curl->post($serverurl . $restformat, $params);
        ?>
        <?= $serverurl . $restformat ?>
        <p>
        <p>
    </body>
</html>
