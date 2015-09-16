<?php
namespace Givenchy\EyelipBundle\Services\Image;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class ImageService
{
    private $_container;
    private $_filedir;

    function __construct($container) {
        $this->_container = $container;
        $this->_filedir = $this->_container->getParameter('files_base_dir');
        //echo $this->_container->get('session')->get('aaa');exit;
    }

    /** 
    * ImageCreate
    *
    * create a picture for online
    *
    * @access public
    * @param mixed $name
    * @since 1.0 
    * @return $filename
    */
    public function createImage($filename)
    {      
        $image = str_replace(' ', '+', $filename);
        $image = base64_decode($image);
        if (empty($image)) {
            return  json_encode(array('code' => 3, 'msg' => '请上传图片'));
            
        }

        $fs = new Filesystem();
        if(!$fs->exists($this->_filedir . '/UploadPic'))
           $fs->mkdir($this->_filedir . '/UploadPic', 0700);
        $fileName = '/UploadPic/' . time() . rand(100,999) . '.png';
        $hechengImg = $this->_filedir . $fileName;

        $handle = fopen($hechengImg, 'w');
        fwrite($handle, $image);
        fclose($handle);
        return $result = $hechengImg;
    }

    /** 
    * ImageCreateForTel
    *
    * create a picture for video
    *
    * @access public
    * @param mixed $name
    * @since 1.0 
    * @return $filename
    */
    public function createImageForVideo($tpl_no, $pic_no, $img)
    {   
        //原图          
        $img1 = ImageCreateFromJpeg($img); 
        list($width,$height)=getimagesize($img);

        //空白背景
        $bg=ImageCreateFromJpeg("images/video/white.jpg");
        list($widthbg,$heightbg)=getimagesize("images/video/white.jpg");


        //原图合成到背景
        if ($tpl_no == 'one' && $pic_no == 1) {
            imagecopyresized($bg, $img1, 0, 0, 0, 0, $widthbg/2, $heightbg/2, $width, $height); 
            imagecopyresized($bg, $img1, $widthbg/2, 0, 0, 0, $widthbg/2, $heightbg/2, $width, $height); 
            imagecopyresized($bg, $img1, 0, $heightbg/2, 0, 0, $widthbg/2, $heightbg/2, $width, $height); 
            imagecopyresized($bg, $img1, $widthbg/2, $heightbg/2, 0, 0, $widthbg/2, $heightbg/2, $width, $height); 
        } else {
            imagecopyresized($bg, $img1, 0, 0, 0, 0, $widthbg, $heightbg, $width, $height); 
        }
        

        //相框
        $tpl = "images/video/" . $tpl_no . "/" . $pic_no . ".png";
        $bgtpl = ImageCreateFromPng($tpl);
        list($widthtpl,$heighttpl)=getimagesize($tpl);


        //相框合成到背景
        imagecopyresized($bg,$bgtpl,0,0,0,0,$widthbg,$heightbg,$widthtpl,$heighttpl); 

        //生成图片
        $fs = new Filesystem();
        if(!$fs->exists($this->_filedir . '/VideoPic'))
           $fs->mkdir($this->_filedir . '/VideoPic', 0700);
        $fileName = '/VideoPic/' . time() . rand(100,999) . '.png';
        $hechengImg = $this->_filedir . $fileName;
        ImagePng($bg,$hechengImg);
        return $hechengImg;
    }

    /** 
    * createVideo
    *
    * create a video
    *
    * @access public
    * @param mixed $img
    * @since 1.0 
    * @return $filename
    */
    public function createVideo($data)
    {
        $uri = $this->_container->getParameter('video_make_url');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $return = curl_exec($ch);
        curl_close($ch);
        return $return;
    }

     /** 
    * saveVideo
    *
    * create a video
    *
    * @access public
    * @param mixed $img
    * @since 1.0 
    * @return $filename
    */
    public function saveVideoToHost($video)
    {
        $uri = $video;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($ch);
        curl_close($ch);
        //生成视频
        $fs = new Filesystem();
        if(!$fs->exists($this->_filedir . '/Video'))
           $fs->mkdir($this->_filedir . '/Video', 0700);
        $fileName = '/Video/' . time() . rand(100,999) . '.mp4';
        $hechengImg = $this->_filedir . $fileName;
        $file = fopen($hechengImg,"w");//打开文件准备写入  
        fwrite($file,$return);//写入  
        fclose($file);//关闭  
        return $hechengImg;
    }

}