<?php

final class ChatRoom extends DataModel {

    /**
     *
     * @var ChatRoomDetail
     */
    private $chatRoomDetail;

    function __construct() {
        parent::__construct("config/configuration.xml", "chat_room", array("room_id"));
        // $this->addRelative(new ChatRoomDetail(), $this->chatRoomDetail, array("room_id" => "room_id"));
    }

    /**
     * return chat room detail object
     * @return ChatRoomDetail
     */
    public function getChatRoomDetail() {
        return $this->chatRoomDetail;
    }

    /**
     * Set value to room_id
     * @param string $v
     * @param integer $cln
     * @return ChatRoom
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
     * Set value to room_date
     * @param string $v
     * @param integer $cln
     * @return ChatRoom
     */
    public function setRoomDate($v, $cln = S_CHARACTOR) {
        $this->setValue('room_date', $v, $cln);
        return $this;
    }

    /**
     * Get value from room_date
     * @return string
     */
    public function getRoomDate() {
        return $this->getValue('room_date');
    }

    /**
     * Find value by field room_date
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByRoomDate("one",array("key_field"=>"DESC|ASC");
     */
    public function findByRoomDate($v, $a = array()) {
        $this->findBy("room_date='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to invite_admin
     * @param string $v
     * @param integer $cln
     * @return ChatRoom
     */
    public function setInviteAdmin($v, $cln = S_CHARACTOR) {
        $this->setValue('invite_admin', $v, $cln);
        return $this;
    }

    /**
     * Get value from invite_admin
     * @return string
     */
    public function getInviteAdmin() {
        return $this->getValue('invite_admin');
    }

    /**
     * Find value by field invite_admin
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByInviteAdmin("one",array("key_field"=>"DESC|ASC");
     */
    public function findByInviteAdmin($v, $a = array()) {
        $this->findBy("invite_admin='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to who_create_id
     * @param string $v
     * @param integer $cln
     * @return ChatRoom
     */
    public function setWhoCreateId($v, $cln = S_CHARACTOR) {
        $this->setValue('who_create_id', $v, $cln);
        return $this;
    }

    /**
     * Get value from who_create_id
     * @return string
     */
    public function getWhoCreateId() {
        return $this->getValue('who_create_id');
    }

    /**
     * Find value by field who_create_id
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByWhoCreateId("one",array("key_field"=>"DESC|ASC");
     */
    public function findByWhoCreateId($v, $a = array()) {
        $this->findBy("who_create_id='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to talk_with_id
     * @param string $v
     * @param integer $cln
     * @return ChatRoom
     */
    public function setTalkWithId($v, $cln = S_CHARACTOR) {
        $this->setValue('talk_with_id', $v, $cln);
        return $this;
    }

    /**
     * Get value from talk_with_id
     * @return string
     */
    public function getTalkWithId() {
        return $this->getValue('talk_with_id');
    }

    /**
     * Find value by field talk_with_id
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByTalkWithId("one",array("key_field"=>"DESC|ASC");
     */
    public function findByTalkWithId($v, $a = array()) {
        $this->findBy("talk_with_id='{$v}'", $a);
        return $this;
    }
    
    /**
     * Find value by field who_create_id or talk_with_id
     * @param type $v
     * @param type $vv
     * @return ChatRoom
     */
    public function findByWhoCreateIdAndTalkWithId($v,$vv){
        $this->findBy("(who_create_id = {$v} and talk_with_id={$vv}) or (who_create_id = {$vv} and talk_with_id={$v})");
        return $this;
    }
    
    /**
     * Find value by field who_create_id or talk_with_id
     * @param type $v
     * @return ChatRoom
     */
    public function findByRelativeChat($v){
        $this->findBy("(who_create_id = {$v} or talk_with_id={$v})");
        return $this;
    }
    
    

}

?>