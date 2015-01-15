<?php

namespace WS\Tools\Events;
use Bitrix\Main\Event;
use Bitrix\Main\EventManager;

/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

class EventsManager {

    /**
     * @param EventType $eventType
     * @param $handler
     * @return int Handler Identifier
     */
    public function subscribe(EventType $eventType, $handler) {
        return $this->vendorManager()->addEventHandler($eventType->getModule(), $eventType->getSubject(), $handler);
    }

    /**
     * @param EventType $eventType
     * @param null $sender
     * @return Event
     */
    public function trigger(EventType $eventType, $sender = null) {
        $event = new Event($eventType->getModule(), $eventType->getSubject());
        $event->send($sender);
        return $event;
    }

    /**
     * @param EventType $eventType
     * @return array
     */
    public function getSubscribers(EventType $eventType) {
        return $this->vendorManager()->findEventHandlers($eventType->getModule(), $eventType->getSubject());
    }

    /**
     * @return EventManager
     */
    public function vendorManager() {
        return EventManager::getInstance();
    }
}