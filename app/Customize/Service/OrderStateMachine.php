<?php

namespace Customize\Service;

use Eccube\Repository\BaseInfoRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\Event;

class OrderStateMachine implements EventSubscriberInterface
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var BaseInfoRepository
     */
    private $baseInfoRepository;

    public function __construct(\Swift_Mailer $mailer, BaseInfoRepository $baseInfoRepository)
    {
        $this->mailer = $mailer;
        $this->baseInfoRepository = $baseInfoRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            'workflow.order.transition.in_wrapping' => ['inWrapping'],
        ];
    }

    public function inWrapping(Event $event)
    {
        $BaseInfo = $this->baseInfoRepository->get();
        $Order = $event->getSubject()->getOrder();
        $subject = '['.$BaseInfo->getShopName().'] ラッピング中です。';
        $body = 'ラッピング中です。';

        $message = (new \Swift_Message())
            ->setSubject($subject)
            ->setFrom([$BaseInfo->getEmail01() => $BaseInfo->getShopName()])
            ->setTo([$Order->getEmail()])
            ->setBcc($BaseInfo->getEmail01())
            ->setReplyTo($BaseInfo->getEmail03())
            ->setReturnPath($BaseInfo->getEmail04());
        $message->setBody($body);
        $this->mailer->send($message);
    }
} 