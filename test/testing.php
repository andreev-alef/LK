<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        
        <title></title>
    </head>
    <body>
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
        $params = ['ids'=>[73, 36]];
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
