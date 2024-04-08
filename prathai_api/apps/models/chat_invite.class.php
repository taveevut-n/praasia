<?php

final class ChatInvite extends DataModel {

    function __construct() {
        parent::__construct("config/configuration.xml", "chat_invite", array("room_id"));
    }

    /**
     * Set value to room_id
     * @param string $v
     * @param integer $cln
     * @return ChatInvite
     */
    public function setRoomId($v, $cln = S_CHARACTOR) {
        $this->setValue('room_id', $v, $cln);
        return $this;
    }

    /**
     * Get value from room_id
     * @return string
     */
    public function getRoomId() {
        return $this->getValue('room_id');
    }

    /**
     * Find value by field room_id
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByRoomId("one",array("key_field"=>"DESC|ASC");
     */
    public function findByRoomId($v, $a = array()) {
        $this->findBy("room_id='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to invite_date
     * @param string $v
     * @param integer $cln
     * @return ChatInvite
     */
    public function setInviteDate($v, $cln = S_CHARACTOR) {
        $this->setValue('invite_date', $v, $cln);
        return $this;
    }

    /**
     * Get value from invite_date
     * @return string
     */
    public function getInviteDate() {
        return $this->getValue('invite_date');
    }

    /**
     * Find value by field invite_date
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByInviteDate("one",array("key_field"=>"DESC|ASC");
     */
    public function findByInviteDate($v, $a = array()) {
        $this->findBy("invite_date='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to accept
     * @param string $v
     * @param integer $cln
     * @return ChatInvite
     */
    public function setAccept($v, $cln = S_CHARACTOR) {
        $this->setValue('accept', $v, $cln);
        return $this;
    }

    /**
     * Get value from accept
     * @return string
     */
    public function getAccept() {
        return $this->getValue('accept');
    }

    /**
     * Find value by field accept
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByAccept("one",array("key_field"=>"DESC|ASC");
     */
    public function findByAccept($v, $a = array()) {
        $this->findBy("accept='{$v}'", $a);
        return $this;
    }

}

?>