<?php

namespace Givenchy\EyelipBundle\Services\User;

use Givenchy\EyelipBundle\Entity\Info;
use Givenchy\EyelipBundle\Entity\Video;
use Givenchy\EyelipBundle\Entity\Likelog;

class UserService
{
    const ENTITY_NAME = 'GivenchyEyelipBundle:Info';

    private $em;
    private $requestStack;

    public function __construct($em, $requestStack)
    {
        $this->em = $em;
        $this->requestStack = $requestStack;
    }

    /** 
    * islogin
    *
    * check user islogin
    *
    * @access public
    * @since 1.0 
    * @return bool or uid
    */
    public function userIsLogin()
    {
        $session = $this->requestStack->getCurrentRequest()->getSession();
        $uid = $session->get('user');
        if($uid) {
            return $uid;
        }
        
        return NULL;
        
    }

    /** 
    * userLoad
    *
    * load user info
    *
    * @access public
    * @since 1.0 
    * @return $user
    */
    public function userLoad()
    {
        if($login = $this->userIsLogin()) {
            $user = $this->em->getRepository(self::ENTITY_NAME)
                ->findOneBy(array('id' => $login));
            return $user;
        }
        return NULL;
    }

    /** 
    * userLogin
    *
    * change user login status
    *
    * @access public
    * @param mixed name mobile 
    * @since 1.0 
    * @return $user
    */
    public function userLogin($name, $mobile)
    {
        $user = $this->findUserByMobile($mobile);
        $user = $user ? $user : $this->userRegister($name, $mobile);
        $session = $this->requestStack->getCurrentRequest()->getSession();
        $session->set('user', $user->getId());
        return $user;
        // $this->requestStack->getCurrentRequest()->cookies;
        // $cookie = new Cookie('openid', $openid, time() + 3600 * 24 * 7);
        // $response = new Response();
        // $response->headers->setCookie($cookie);
        // $response->send();
    }

    /** 
    * userRegister
    *
    * create a user
    *
    * @access public
    * @param mixed name mobile 
    * @since 1.0 
    * @return $user
    */
    public function userRegister($name, $mobile)
    {
        $user = new Info();
        $user->setName($name);
        $user->setMobile($mobile);
        $user->setCreated(time());
        $user->setLottery('');
        $user->setProvince('');
        $user->setCity('');
        $user->setStore('');
        $this->save($user);
        return $user;
    }

    /** 
    * saveVideo
    *
    * save user's video
    *
    * @access public
    * @param mixed object [name,email,cellphone,address] 
    * @since 1.0 
    * @return $user
    */
    public function saveVideo($image1, $image2, $image3, $style, $url)
    {
        if($info = $this->userLoad()) {
            $video = new Video();
            $video->setInfo($info);
            $video->setImage1($image1);
            $video->setImage2($image2);
            $video->setImage3($image3);
            $video->setStyle($style);
            $video->setUrl($url);
            $video->setBallot(0);
            $video->setCreated(time());
            $this->save($video);
            return $video->getId();
        }
        return FALSE;
    }

    /** 
    * userLoad
    *
    * load user info
    *
    * @access public
    * @since 1.0 
    * @return $user
    */
    public function getVideoById($id)
    {
        $video = $this->em->getRepository('GivenchyEyelipBundle:Video')
            ->findOneBy(array('id' => $id));
        return $video;
    }

    /** 
    * userLoad
    *
    * load user info
    *
    * @access public
    * @since 1.0 
    * @return $user
    */
    public function ballotVideoById($id)
    {
        if (!isset($_COOKIE['eyelip_uuid'])) {
            $uuid = md5(time());
            setcookie("eyelip_uuid", $uuid, time()+3600*24*7*30);
            $_COOKIE['eyelip_uuid'] = $uuid;
        }
        $log = $this->em->getRepository('GivenchyEyelipBundle:Likelog')
            ->findBy(array('uuid' => $_COOKIE['eyelip_uuid'], 'videoId' => $id, 'created' => date('Ymd')));
        if (count($log) >= 3) {
            return -1;
        }

        $likelog = new Likelog();
        $likelog->setUuid($_COOKIE['eyelip_uuid']);
        $likelog->setVideoId($id);
        $likelog->setCreated(date("Ymd"));
        $this->save($likelog);
        $video = $this->em->getRepository('GivenchyEyelipBundle:Video')
            ->findOneBy(array('id' => $id));
        $video->setBallot($video->getBallot() + 1);
        $this->save($video);
        return $video->getBallot();
    }

    /** 
    * userLoad
    *
    * load user info
    *
    * @access public
    * @since 1.0 
    * @return $user
    */
    public function checkMobile($mobile)
    {
        return $this->findUserByMobile($mobile);
    }

    /** 
    * userLoad
    *
    * load user info
    *
    * @access public
    * @since 1.0 
    * @return $user
    */
    public function checkStatus($mobile)
    {
        $offline = $this->em->getRepository('GivenchyEyelipBundle:Offline')->findOneBy(array('mobile' => $mobile));
        if($offline)
            return 1;
        return 0;
    }

    /** 
    * userLoad
    *
    * load user info
    *
    * @access public
    * @since 1.0 
    * @return $user
    */
    public function getUserBallot($info)
    {
        $rs = $this->em->getRepository('GivenchyEyelipBundle:Video')->findBy(array('info' => $info));
        $count = 0;
        foreach ($rs as $key => $value) {
            $count += $value->getBallot();
        }
        return $count;
        //return $this->findUserByMobile($mobile);
    }

    /** 
    * userLoad
    *
    * load user info
    *
    * @access public
    * @since 1.0 
    * @return $user
    */
    public function checkLottery()
    {
        if($info = $this->userLoad()) {
            if ($info->getProvince() != '') {
                return 1;
            }
            return 0;
        }
        return FALSE;
    }

    /** 
    * userLoad
    *
    * load user info
    *
    * @access public
    * @since 1.0 
    * @return $user
    */
    public function lottery($lottery)
    {
        if($info = $this->userLoad()) {
            $info->setLottery($lottery);
            $this->save($info);
            return $info;
        }
        return FALSE;
    }
    
    /** 
    * userLoad
    *
    * load user info
    *
    * @access public
    * @since 1.0 
    * @return $user
    */
    public function chooseStore($province, $city, $store)
    {
        if($info = $this->userLoad()) {
            //$info->setLottery($lottery);
            $info->setProvince($province);
            $info->setCity($city);
            $info->setStore($store);
            $this->save($info);
            return $info;
        }
        return FALSE;
    }

    /** 
    * dreamLike
    *
    * ballot user's dream
    *
    * @access public
    * @param mixed userdream
    * @since 1.0 
    * @return $dreamlike
    */
    public function dreamLike(UserDream $userdream)
    {
        if($user = $this->userLoad()) {
            $dreamlike = new DreamLike();
            $dreamlike->setUser($user);
            $dreamlike->setUserdream($userdream);
            $dreamlike->setCreated(time());
            $this->save($dreamlike);
            return $dreamlike;
        }
        return FALSE;
    }

    /** 
    * dreamView
    *
    * user's dream
    *
    * @access public
    * @param mixed userdream
    * @since 1.0 
    * @return $dreamview
    */
    public function dreamView(UserDream $userdream)
    {
        if($user = $this->userLoad()) {
            if($user->getId() != $userdream->getUser()->getId()) {
                $dreamview = new DreamView();
                $dreamview->setUser($user);
                $dreamview->setUserdream($userdream);
                $dreamview->setCreated(time());
                $this->save($dreamview);
                return $dreamview;        
            }

        }
        return FALSE;
    }

    /** 
    * dreamView
    *
    * user's dream
    *
    * @access public
    * @param mixed userdream
    * @since 1.0 
    * @return $dreamview
    */
    public function retrieveDreamInfoByDreamId($dream_id)
    {
        $user = $this->userLoad();

        $dream = $this->em->getRepository('LVFondationBundle:UserDream')->findOneBy(array('id' => $dream_id));

        $this->dreamView($dream);

        $dreamcount = $this->em->getRepository('LVFondationBundle:UserDream')->retrieveDreamCount();
        $dream_id = $dream->getId();
        $nickname = $dream->getNickname();
        $content = $dream->getContent();
        $hasuserinfo = $user->getUserinfo() ? 1 : 0;

        if($dream->getUser()->getId() == $user->getId()){
            $dreaminfo = array(
                'dreamcount' => $dreamcount,
                'dream_id' => $dream_id,
                'nickname' => $nickname,
                'content' => $content,
                'ismyself' => 1,
                'hasuserinfo' => $hasuserinfo,
            );
        } else {

            $liked = $this->em->getRepository('LVFondationBundle:DreamLike')->findOneBy(array('user' => $user->getId(), 'userdream' => $dream->getId()));
            $isliked = $liked ? 1 : 0;
            if($mydream = $user->getUserdream())
                $myself_dream_id = $mydream->getId();
            else
                $myself_dream_id= 0;

            $dreaminfo = array(
                'dreamcount' => $dreamcount,
                'dream_id' => $dream_id,
                'nickname' => $nickname,
                'content' => $content,
                'isliked' => $isliked,
                'myself_dream_id' => $myself_dream_id,
                'ismyself' => 0,
            );            
        }

        return $dreaminfo;

    }

    public function retrieveJourneyDreamInfoByDreamId($dream_id)
    {
        if($user = $this->userLoad()) {

            $dream = $this->em->getRepository('LVFondationBundle:UserDream')->findOneBy(array('id' => $dream_id));

            $this->dreamView($dream);

            // $dreamcount = $dream->getId();
            $nickname = $dream->getNickname();
            $content = $dream->getContent();
            $days = ceil((time() - $dream->getCreated()) / (3600 * 24));
            $views = $this->em->getRepository('LVFondationBundle:DreamView')->retrieveViewCount($dream_id);
            $liked = $this->em->getRepository('LVFondationBundle:DreamLike')->retrieveLikedCount($dream_id);

            $views = $views + 100;
            $liked = $liked + 20;

            if($dream->getUser()->getId() == $user->getId()){
                $call = '您';
                $who = 'myself';
            } else {
                $call = '他(她)';
                $who = 'others';
            }

            $dreaminfo = array(
                'dreamcount' => $dream_id,
                'dream_id' => $dream_id,
                'nickname' => $nickname,
                'content' => $content,
                'call' => $call,
                'days' => $days,
                'views' => $views,
                'liked' => $liked,
                'who' => $who,
                );
            return $dreaminfo;
        }
        return FALSE;
    }

    /** 
    * createFakeUserDream
    *
    * create user's dream fake
    *
    * @access public
    * @param mixed nickname
    * @param mixed content
    * @since 1.0 
    */
    public function createFakeUserDream($nickname, $content)
    {
        $dream = $this->em->getRepository('LVFondationBundle:UserDream')->findOneBy(array('nickname' => $nickname, 'content' => $content));
        if(!$dream) {
            $user = new User();
            $user->setOpenid($nickname);
            $user->setRole('onlinefake');
            $user->setCreated(time());
            $this->save($user);

            $dream = new UserDream();
            $dream->setUser($user);
            $dream->setNickname($nickname);
            $dream->setContent($content);
            $dream->setStatus('1');
            $dream->setCreated(time());
            $dream->setUpdated(time());
            $this->save($dream);
        }
    }

    /** 
    * setTemplateMessageStatus
    *
    * set the template message status
    *
    * @access public
    * @param array
    * @since 1.0 
    * @return $dream
    */
    public function setTemplateMessageStatus($wechat, $input) 
    {
        if($user = $this->userLoad()) {
            if(!$user->getTemplatemessage()) {
                $data = array();
                $data['first']['value'] = $input['first'];
                $data['first']['color'] = '#000000';
                $data['keyword1']['value'] = $input['second'];
                $data['keyword1']['color'] = '#000000';
                $data['keyword2']['value'] = date("Y-m-d");
                $data['keyword2']['color'] = '#000000';
                $data['remark']['value'] = $input['third'];
                $data['remark']['color'] = '#000000';
                $template_id = 'boicCRp5adiZr2AoXgGCX-xV7DE1oVhrqbE0RwEx3UY';
                $url = $input['url'];
                $topcolor = '#000000';
                $openid = $user->getOpenid();
                $issend = $wechat->sendTemplate($template_id, $url, $topcolor, $data, $openid);

                if($issend) {
                    $this->setUserPhotoCode($input['code']);
                    $message = new TemplateMessage();
                    $message->setUser($user);
                    $message->setIssendPhoto('0');
                    $message->setCreated(time());
                    $this->save($message);
                    return $message;
                }
              
            }

        }
        return FALSE;
    }

    /** 
    * setTemplateMessagePhoto
    *
    * set the template message status
    *
    * @access public
    * @param array
    * @since 1.0 
    * @return $dream
    */
    public function setTemplateMessagePhoto($template, $wechat, $input) 
    {
            $data = array();
            $data['first']['value'] = $input['first'];
            $data['first']['color'] = '#000000';
            $data['keyword1']['value'] = $input['second'];
            $data['keyword1']['color'] = '#000000';
            $data['keyword2']['value'] = date("Y-m-d");
            $data['keyword2']['color'] = '#000000';
            $data['remark']['value'] = $input['third'];
            $data['remark']['color'] = '#000000';
            $template_id = 'boicCRp5adiZr2AoXgGCX-xV7DE1oVhrqbE0RwEx3UY';
            $url = $input['url'];
            $topcolor = '#000000';
            $openid = $template->getUser()->getOpenid();
            $issend = $wechat->sendTemplate($template_id, $url, $topcolor, $data, $openid);
            if($issend) {
                $template->setIssendPhoto('1');
                $this->save($template);
                return $template;
            }    
        return FALSE;
    }

    /** 
    * getTemplates
    *
    * @access public
    * @param mixed code
    * @since 1.0 
    * @return $userphotocode
    */
    public function getTemplates() 
    {
        $templates =  $this->em->getRepository('LVFondationBundle:TemplateMessage')->findBy(array('issend_photo' => 0));
        return $templates;
    }

    /** 
    * setIbeaconRecord
    *
    * @access public
    * @param mixed ibeacon_id
    * @since 1.0 
    * @return $user
    */
    public function setIbeaconRecord($ibeacon_id) 
    {
        $record = new IbeaconRecord();
        $record->setIbeaconId($ibeacon_id);
        $record->setCreated(time());
        $this->save($record);
        return $record;
    }

    /** 
    * setUserPhotoCode
    *
    * @access public
    * @param mixed code
    * @since 1.0 
    * @return $userphotocode
    */
    public function setUserPhotoCode($code) 
    {
        if($user = $this->userLoad()) {
            $userphotocode = new UserPhotoCode();
            $userphotocode->setCode($code);
            $userphotocode->setUser($user);
            $userphotocode->setCreated(time());
            $this->save($userphotocode);
            return $userphotocode;
        }
        return FALSE;
    }

    /** 
    * findUserByMobile
    *
    * @access public
    * @param mixed mobile
    * @since 1.0 
    * @return $user
    */
    public function findUserByMobile($mobile)
    {
        $user = $this->em->getRepository(self::ENTITY_NAME)->findOneBy(array('mobile' => $mobile));
        if($user)
            return $user;
        return NULL;
    }

    public function findAll()
    {
        return $this->em->getRepository(self::ENTITY_NAME)->findAll();
    }

    public function save($entity)
    {
        $this->em->persist($entity);
        $this->em->flush($entity);
    }
}