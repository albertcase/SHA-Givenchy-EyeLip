<?php

require_once dirname(__FILE__) . "/conf/config.php";

        $data = array(
                'images' => array(
                        base64_encode(file_get_contents('/vagrant/video_server/demo/4.png')),
                        base64_encode(file_get_contents('/vagrant/video_server/demo/5.png')),
                        base64_encode(file_get_contents('/vagrant/video_server/demo/6.png')),
                        ),
                'video_tpl' => 'vone',
                'audio_tpl' => 'atwo',
                 );

$livav = new Libav($data['images'], $data['video_tpl'], $data['audio_tpl'], array('video_rate' => '600k', 'audio_rate' => '48k', 'scale' => '404:720'));
$video = $livav->makeVideo();

print json_encode(array('status' => 1, 'src' => $video));


?>