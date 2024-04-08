<?php

final class ChatRoomDetail extends DataModel {

    function __construct() {
        parent::__construct("config/configuration.xml", "room_chat_detail", array("room_id"));
    }

    /**
     * Set value to msg
     * @param string $v
     * @param integer $cln
     * @return ChatRoomDetail
     */
    public function setMsg($v, $cln = S_CHARACTOR) {
        $this->setValue('msg', $v, $cln);
        return $this;
    }

    /**
     * Get value from msg
     * @return string
     */
    public function getMsg() {
        return $this->getValue('msg');
    }

    /**
     * Find value by field msg
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByMsg("one",array("key_field"=>"DESC|ASC");
     */
    public function findByMsg($v, $a = array()) {
        $this->findBy("msg='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to msg_trans
     * @param string $v
     * @param integer $cln
     * @return ChatRoomDetail
     */
    public function setMsgTrans($v, $cln = S_CHARACTOR) {
        $this->setValue('msg_trans', $v, $cln);
        return $this;
    }

    /**
     * Get value from msg_trans
     * @return string
     */
    public function getMsgTrans() {
        return $this->getValue('msg_trans');
    }

    /**
     * Find value by field msg_trans
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByMsgTrans("one",array("key_field"=>"DESC|ASC");
     */
    public function findByMsgTrans($v, $a = array()) {
        $this->findBy("msg_trans='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to send_date
     * @param string $v
     * @param integer $cln
     * @return ChatRoomDetail
     */
    public function setSendDate($v, $cln = S_CHARACTOR) {
        $this->setValue('send_date', $v, $cln);
        return $this;
    }

    /**
     * Get value from send_date
     * @return string
     */
    public function getSendDate() {
        return $this->getValue('send_date');
    }

    /**
     * Find value by field send_date
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findBySendDate("one",array("key_field"=>"DESC|ASC");
     */
    public function findBySendDate($v, $a = array()) {
        $this->findBy("send_date='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to receive_date
     * @param string $v
     * @param integer $cln
     * @return ChatRoomDetail
     */
    public function setReceiveDate($v, $cln = S_CHARACTOR) {
        $this->setValue('receive_date', $v, $cln);
        return $this;
    }

    /**
     * Get value from receive_date
     * @return string
     */
    public function getReceiveDate() {
        return $this->getValue('receive_date');
    }

    /**
     * Find value by field receive_date
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByReceiveDate("one",array("key_field"=>"DESC|ASC");
     */
    public function findByReceiveDate($v, $a = array()) {
        $this->findBy("receive_date='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to from_member
     * @param string $v
     * @param integer $cln
     * @return ChatRoomDetail
     */
    public function setFromMember($v, $cln = S_CHARACTOR) {
        $this->setValue('from_member', $v, $cln);
        return $this;
    }

    /**
     * Get value from from_member
     * @return string
     */
    public function getFromMember() {
        return $this->getValue('from_member');
    }

    /**
     * Find value by field from_member
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByFromMember("one",array("key_field"=>"DESC|ASC");
     */
    public function findByFromMember($v, $a = array()) {
        $this->findBy("from_member='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to to_member
     * @param string $v
     * @param integer $cln
     * @return ChatRoomDetail
     */
    public function setToMember($v, $cln = S_CHARACTOR) {
        $this->setValue('to_member', $v, $cln);
        return $this;
    }

    /**
     * Get value from to_member
     * @return string
     */
    public function getToMember() {
        return $this->getValue('to_member');
    }

    /**
     * Find value by field to_member
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByToMember("one",array("key_field"=>"DESC|ASC");
     */
    public function findByToMember($v, $a = array()) {
        $this->findBy("to_member='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to room_id
     * @param string $v
     * @param integer $cln
     * @return ChatRoomDetail
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

}

?>