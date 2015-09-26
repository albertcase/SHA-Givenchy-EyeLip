<?php

namespace Givenchy\EyelipBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Hello World command for demo purposes.
 *
 * You could also extend from Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand
 * to get access to the container via $this->getContainer().
 *
 * @author Tobias Schultze <http://tobion.de>
 */
class SendMsgCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('givenchy:send:message')
            ->setDescription('Send Wechat Template Message')
            ->addArgument('who', InputArgument::OPTIONAL, 'Who to greet.', 'World')
            ->setHelp(<<<EOF
The <info>%command.name%</info> command greets somebody or everybody:

<info>php %command.full_name%</info>

The optional argument specifies who to greet:

<info>php %command.full_name%</info> Fabien
EOF
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $repository = $this->getContainer()->get('doctrine')->getRepository('GivenchyEyelipBundle:Send');
        $send = $repository->findByStatus(0);
        for ($i=0; $i < count($send); $i++) { 
            $user = $send[$i];
            $ws = "http://webservice.smsadmin.cn/SGIP/SGIPService.php?wsdl";
            //接口地址 
            $client = new \SoapClient($ws);
            //远程调用
            $uid = '众异市场';
            $pwd = 'samesame123';
            $msg = "恭喜您的纪梵希彩妆大片已集满".$user->getBallot()."颗爱心！凭此短信代码：DD1509，10月11日之前至纪梵希化妆品专柜购买任意正装产品，就可点亮爱心，兑换专属礼品啦！查看门店详情请关注微信“纪梵希美妆”服务号。如您已成功购买，请耐心等待短信通知，届时填写有效信息，即可选取心仪礼品！此短信转发无效。退订回复TD【纪梵希美妆】";
            $lindid = "Givenchy".date("YmdHis").$user->getId();
            $dtime = '';
            $char = 'utf-8';
            $uid = urlencode($uid);
            $msg = urlencode($msg);
            $select_db_rs = $client->sendSms($uid, $pwd, $user->getMobile(), $msg, $lindid, $dtime, $char);
            $user->setStatus(1);
            $user->setResult($select_db_rs);
            $doctrine = $this->getContainer()->get('doctrine')->getManager();
            $doctrine->persist($user);
            $doctrine->flush();
            $output->writeln(sprintf('Create Successful <comment>%s</comment>!', $user->getId()));
        }

    }
}
