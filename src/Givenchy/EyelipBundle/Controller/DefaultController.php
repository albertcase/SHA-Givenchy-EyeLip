<?php

namespace Givenchy\EyelipBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Givenchy\EyelipBundle\Entity\Offline;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GivenchyEyelipBundle:Default:index.html.twig', array('name' => $name));
    }
    

    public function testAction()
    {
  		//检查
  		echo 1;die;
  		$csv = 'files/mobile.csv';
		$handle = fopen($csv,"r");
		$total=0;
		$ok=0;
		$doctrine = $this->getDoctrine()->getManager();
		while(!feof($handle)){
			$line = fgets($handle,4096);
			if($line==''){
				continue;
			}
			$total++;
			$line = str_replace("\r\n","", $line);
			$line = str_replace("\r","", $line);
			$line = str_replace("\n","", $line);
			echo $line;exit;
			$offline = new Offline();
			$offline->setMobile($line);
			$offline->setStatus(0);
			$offline->setCreated(date('Ymd'));
			$doctrine->persist($offline);
            $doctrine->flush();
			$ok++;
		}
		fclose($handle);
		echo $total . "--" . $ok;
		exit;
		// $uri = "http://127.0.0.1:8080/index.php";
		// $data = array(
  //               'images' => array(
  //                       base64_encode(file_get_contents('/vagrant/web/4.png')),
  //                       base64_encode(file_get_contents('/vagrant/web/5.png')),
  //                       base64_encode(file_get_contents('/vagrant/web/6.png')),
  //                       ),
  //               'video_tpl' => 'vone',
  //               'audio_tpl' => 'aone',
  //                );
		 
		// $ch = curl_init ();
		// curl_setopt ( $ch, CURLOPT_URL, $uri);
		// curl_setopt ( $ch, CURLOPT_POST, 1 );
		// curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		// curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		// curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query($data) );
		// echo $return = curl_exec ( $ch );
		// curl_close ( $ch );
  //   	exit;
  //   	$uri = "http://sms.bechtech.cn/Api/send/data/json";
		// $data = array(
		//      'accesskey' => '3619' ,
		//      'secretkey' => 'a8040842375976cd4009452c8348609a6151ff41' ,
		//      'mobile' => '13524703157' ,
		//      'content' => urlencode('亲，您之前参与的纪梵希魅影朱唇活动，请猛戳测试英文test测试中文符！@＃¥％……&＊（）发送进行集赞数兑换！退订回复TD【纪梵希】') 
		// );
		 
		// $ch = curl_init ();
		// curl_setopt ( $ch, CURLOPT_URL, $uri . "?" . http_build_query($data) );
		// curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		// $return = curl_exec ( $ch );
		// curl_close ( $ch );
		// var_dump($return);
        exit;
    }
}
