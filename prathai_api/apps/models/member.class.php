<?php

final class Member extends DataModel {

    function __construct() {
        parent::__construct("config/configuration.xml", "member", array("id"));
    }

    /**
     * Set value to id
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setId($v, $cln = S_CHARACTOR) {
        $this->setValue('id', $v, $cln);
        return $this;
    }

    /**
     * Get value from id
     * @return string
     */
    public function getId() {
        return $this->getValue('id');
    }

    /**
     * Find value by field id
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findById("one",array("key_field"=>"DESC|ASC");
     */
    public function findById($v, $a = array()) {
        $this->findBy("id='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to contact
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setContact($v, $cln = S_CHARACTOR) {
        $this->setValue('contact', $v, $cln);
        return $this;
    }

    /**
     * Get value from contact
     * @return string
     */
    public function getContact() {
        return $this->getValue('contact');
    }

    /**
     * Find value by field contact
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByContact("one",array("key_field"=>"DESC|ASC");
     */
    public function findByContact($v, $a = array()) {
        $this->findBy("contact='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to shop_id
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setShopId($v, $cln = S_CHARACTOR) {
        $this->setValue('shop_id', $v, $cln);
        return $this;
    }

    /**
     * Get value from shop_id
     * @return string
     */
    public function getShopId() {
        return $this->getValue('shop_id');
    }

    /**
     * Find value by field shop_id
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByShopId("one",array("key_field"=>"DESC|ASC");
     */
    public function findByShopId($v, $a = array()) {
        $this->findBy("shop_id='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to type
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setType($v, $cln = S_CHARACTOR) {
        $this->setValue('type', $v, $cln);
        return $this;
    }

    /**
     * Get value from type
     * @return string
     */
    public function getType() {
        return $this->getValue('type');
    }

    /**
     * Find value by field type
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByType("one",array("key_field"=>"DESC|ASC");
     */
    public function findByType($v, $a = array()) {
        $this->findBy("type='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to username
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setUsername($v, $cln = S_CHARACTOR) {
        $this->setValue('username', $v, $cln);
        return $this;
    }

    /**
     * Get value from username
     * @return string
     */
    public function getUsername() {
        return $this->getValue('username');
    }

    /**
     * Find value by field username
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByUsername("one",array("key_field"=>"DESC|ASC");
     */
    public function findByUsername($v, $a = array()) {
        $this->findBy("username='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to password
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setPassword($v, $cln = S_CHARACTOR) {
        $this->setValue('password', $v, $cln);
        return $this;
    }

    /**
     * Get value from password
     * @return string
     */
    public function getPassword() {
        return $this->getValue('password');
    }

    /**
     * Find value by field password
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByPassword("one",array("key_field"=>"DESC|ASC");
     */
    public function findByPassword($v, $a = array()) {
        $this->findBy("password='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to email
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setEmail($v, $cln = S_CHARACTOR) {
        $this->setValue('email', $v, $cln);
        return $this;
    }

    /**
     * Get value from email
     * @return string
     */
    public function getEmail() {
        return $this->getValue('email');
    }

    /**
     * Find value by field email
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByEmail("one",array("key_field"=>"DESC|ASC");
     */
    public function findByEmail($v, $a = array()) {
        $this->findBy("email='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to name
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setName($v, $cln = S_CHARACTOR) {
        $this->setValue('name', $v, $cln);
        return $this;
    }

    /**
     * Get value from name
     * @return string
     */
    public function getName() {
        return $this->getValue('name');
    }

    /**
     * Find value by field name
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByName("one",array("key_field"=>"DESC|ASC");
     */
    public function findByName($v, $a = array()) {
        $this->findBy("name='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to tel
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setTel($v, $cln = S_CHARACTOR) {
        $this->setValue('tel', $v, $cln);
        return $this;
    }

    /**
     * Get value from tel
     * @return string
     */
    public function getTel() {
        return $this->getValue('tel');
    }

    /**
     * Find value by field tel
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByTel("one",array("key_field"=>"DESC|ASC");
     */
    public function findByTel($v, $a = array()) {
        $this->findBy("tel='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to mobile
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setMobile($v, $cln = S_CHARACTOR) {
        $this->setValue('mobile', $v, $cln);
        return $this;
    }

    /**
     * Get value from mobile
     * @return string
     */
    public function getMobile() {
        return $this->getValue('mobile');
    }

    /**
     * Find value by field mobile
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByMobile("one",array("key_field"=>"DESC|ASC");
     */
    public function findByMobile($v, $a = array()) {
        $this->findBy("mobile='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to paypal
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setPaypal($v, $cln = S_CHARACTOR) {
        $this->setValue('paypal', $v, $cln);
        return $this;
    }

    /**
     * Get value from paypal
     * @return string
     */
    public function getPaypal() {
        return $this->getValue('paypal');
    }

    /**
     * Find value by field paypal
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByPaypal("one",array("key_field"=>"DESC|ASC");
     */
    public function findByPaypal($v, $a = array()) {
        $this->findBy("paypal='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to shopname
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setShopname($v, $cln = S_CHARACTOR) {
        $this->setValue('shopname', $v, $cln);
        return $this;
    }

    /**
     * Get value from shopname
     * @return string
     */
    public function getShopname() {
        return $this->getValue('shopname');
    }

    /**
     * Find value by field shopname
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByShopname("one",array("key_field"=>"DESC|ASC");
     */
    public function findByShopname($v, $a = array()) {
        $this->findBy("shopname='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to date_add
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setDateAdd($v, $cln = S_CHARACTOR) {
        $this->setValue('date_add', $v, $cln);
        return $this;
    }

    /**
     * Get value from date_add
     * @return string
     */
    public function getDateAdd() {
        return $this->getValue('date_add');
    }

    /**
     * Find value by field date_add
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByDateAdd("one",array("key_field"=>"DESC|ASC");
     */
    public function findByDateAdd($v, $a = array()) {
        $this->findBy("date_add='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to date_extend
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setDateExtend($v, $cln = S_CHARACTOR) {
        $this->setValue('date_extend', $v, $cln);
        return $this;
    }

    /**
     * Get value from date_extend
     * @return string
     */
    public function getDateExtend() {
        return $this->getValue('date_extend');
    }

    /**
     * Find value by field date_extend
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByDateExtend("one",array("key_field"=>"DESC|ASC");
     */
    public function findByDateExtend($v, $a = array()) {
        $this->findBy("date_extend='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to date_expire
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setDateExpire($v, $cln = S_CHARACTOR) {
        $this->setValue('date_expire', $v, $cln);
        return $this;
    }

    /**
     * Get value from date_expire
     * @return string
     */
    public function getDateExpire() {
        return $this->getValue('date_expire');
    }

    /**
     * Find value by field date_expire
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByDateExpire("one",array("key_field"=>"DESC|ASC");
     */
    public function findByDateExpire($v, $a = array()) {
        $this->findBy("date_expire='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to package_id
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setPackageId($v, $cln = S_CHARACTOR) {
        $this->setValue('package_id', $v, $cln);
        return $this;
    }

    /**
     * Get value from package_id
     * @return string
     */
    public function getPackageId() {
        return $this->getValue('package_id');
    }

    /**
     * Find value by field package_id
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByPackageId("one",array("key_field"=>"DESC|ASC");
     */
    public function findByPackageId($v, $a = array()) {
        $this->findBy("package_id='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to active
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setActive($v, $cln = S_CHARACTOR) {
        $this->setValue('active', $v, $cln);
        return $this;
    }

    /**
     * Get value from active
     * @return string
     */
    public function getActive() {
        return $this->getValue('active');
    }

    /**
     * Find value by field active
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByActive("one",array("key_field"=>"DESC|ASC");
     */
    public function findByActive($v, $a = array()) {
        $this->findBy("active='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to confirmed
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setConfirmed($v, $cln = S_CHARACTOR) {
        $this->setValue('confirmed', $v, $cln);
        return $this;
    }

    /**
     * Get value from confirmed
     * @return string
     */
    public function getConfirmed() {
        return $this->getValue('confirmed');
    }

    /**
     * Find value by field confirmed
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByConfirmed("one",array("key_field"=>"DESC|ASC");
     */
    public function findByConfirmed($v, $a = array()) {
        $this->findBy("confirmed='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to score
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setScore($v, $cln = S_CHARACTOR) {
        $this->setValue('score', $v, $cln);
        return $this;
    }

    /**
     * Get value from score
     * @return string
     */
    public function getScore() {
        return $this->getValue('score');
    }

    /**
     * Find value by field score
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByScore("one",array("key_field"=>"DESC|ASC");
     */
    public function findByScore($v, $a = array()) {
        $this->findBy("score='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to commentscore
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setCommentscore($v, $cln = S_CHARACTOR) {
        $this->setValue('commentscore', $v, $cln);
        return $this;
    }

    /**
     * Get value from commentscore
     * @return string
     */
    public function getCommentscore() {
        return $this->getValue('commentscore');
    }

    /**
     * Find value by field commentscore
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByCommentscore("one",array("key_field"=>"DESC|ASC");
     */
    public function findByCommentscore($v, $a = array()) {
        $this->findBy("commentscore='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to online
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setOnline($v, $cln = S_CHARACTOR) {
        $this->setValue('online', $v, $cln);
        return $this;
    }

    /**
     * Get value from online
     * @return string
     */
    public function getOnline() {
        return $this->getValue('online');
    }

    /**
     * Find value by field online
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByOnline("one",array("key_field"=>"DESC|ASC");
     */
    public function findByOnline($v, $a = array()) {
        $this->findBy("online='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to warranty
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setWarranty($v, $cln = S_CHARACTOR) {
        $this->setValue('warranty', $v, $cln);
        return $this;
    }

    /**
     * Get value from warranty
     * @return string
     */
    public function getWarranty() {
        return $this->getValue('warranty');
    }

    /**
     * Find value by field warranty
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByWarranty("one",array("key_field"=>"DESC|ASC");
     */
    public function findByWarranty($v, $a = array()) {
        $this->findBy("warranty='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to bankinfo
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setBankinfo($v, $cln = S_CHARACTOR) {
        $this->setValue('bankinfo', $v, $cln);
        return $this;
    }

    /**
     * Get value from bankinfo
     * @return string
     */
    public function getBankinfo() {
        return $this->getValue('bankinfo');
    }

    /**
     * Find value by field bankinfo
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByBankinfo("one",array("key_field"=>"DESC|ASC");
     */
    public function findByBankinfo($v, $a = array()) {
        $this->findBy("bankinfo='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to welcome
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setWelcome($v, $cln = S_CHARACTOR) {
        $this->setValue('welcome', $v, $cln);
        return $this;
    }

    /**
     * Get value from welcome
     * @return string
     */
    public function getWelcome() {
        return $this->getValue('welcome');
    }

    /**
     * Find value by field welcome
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByWelcome("one",array("key_field"=>"DESC|ASC");
     */
    public function findByWelcome($v, $a = array()) {
        $this->findBy("welcome='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to address
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setAddress($v, $cln = S_CHARACTOR) {
        $this->setValue('address', $v, $cln);
        return $this;
    }

    /**
     * Get value from address
     * @return string
     */
    public function getAddress() {
        return $this->getValue('address');
    }

    /**
     * Find value by field address
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByAddress("one",array("key_field"=>"DESC|ASC");
     */
    public function findByAddress($v, $a = array()) {
        $this->findBy("address='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to amphur
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setAmphur($v, $cln = S_CHARACTOR) {
        $this->setValue('amphur', $v, $cln);
        return $this;
    }

    /**
     * Get value from amphur
     * @return string
     */
    public function getAmphur() {
        return $this->getValue('amphur');
    }

    /**
     * Find value by field amphur
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByAmphur("one",array("key_field"=>"DESC|ASC");
     */
    public function findByAmphur($v, $a = array()) {
        $this->findBy("amphur='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to province
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setProvince($v, $cln = S_CHARACTOR) {
        $this->setValue('province', $v, $cln);
        return $this;
    }

    /**
     * Get value from province
     * @return string
     */
    public function getProvince() {
        return $this->getValue('province');
    }

    /**
     * Find value by field province
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByProvince("one",array("key_field"=>"DESC|ASC");
     */
    public function findByProvince($v, $a = array()) {
        $this->findBy("province='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to country
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setCountry($v, $cln = S_CHARACTOR) {
        $this->setValue('country', $v, $cln);
        return $this;
    }

    /**
     * Get value from country
     * @return string
     */
    public function getCountry() {
        return $this->getValue('country');
    }

    /**
     * Find value by field country
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByCountry("one",array("key_field"=>"DESC|ASC");
     */
    public function findByCountry($v, $a = array()) {
        $this->findBy("country='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to postcode
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setPostcode($v, $cln = S_CHARACTOR) {
        $this->setValue('postcode', $v, $cln);
        return $this;
    }

    /**
     * Get value from postcode
     * @return string
     */
    public function getPostcode() {
        return $this->getValue('postcode');
    }

    /**
     * Find value by field postcode
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByPostcode("one",array("key_field"=>"DESC|ASC");
     */
    public function findByPostcode($v, $a = array()) {
        $this->findBy("postcode='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to detail
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setDetail($v, $cln = S_CHARACTOR) {
        $this->setValue('detail', $v, $cln);
        return $this;
    }

    /**
     * Get value from detail
     * @return string
     */
    public function getDetail() {
        return $this->getValue('detail');
    }

    /**
     * Find value by field detail
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByDetail("one",array("key_field"=>"DESC|ASC");
     */
    public function findByDetail($v, $a = array()) {
        $this->findBy("detail='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to package
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setPackage($v, $cln = S_CHARACTOR) {
        $this->setValue('package', $v, $cln);
        return $this;
    }

    /**
     * Get value from package
     * @return string
     */
    public function getPackage() {
        return $this->getValue('package');
    }

    /**
     * Find value by field package
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByPackage("one",array("key_field"=>"DESC|ASC");
     */
    public function findByPackage($v, $a = array()) {
        $this->findBy("package='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to view_num
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setViewNum($v, $cln = S_CHARACTOR) {
        $this->setValue('view_num', $v, $cln);
        return $this;
    }

    /**
     * Get value from view_num
     * @return string
     */
    public function getViewNum() {
        return $this->getValue('view_num');
    }

    /**
     * Find value by field view_num
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByViewNum("one",array("key_field"=>"DESC|ASC");
     */
    public function findByViewNum($v, $a = array()) {
        $this->findBy("view_num='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to head2
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setHead2($v, $cln = S_CHARACTOR) {
        $this->setValue('head2', $v, $cln);
        return $this;
    }

    /**
     * Get value from head2
     * @return string
     */
    public function getHead2() {
        return $this->getValue('head2');
    }

    /**
     * Find value by field head2
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByHead2("one",array("key_field"=>"DESC|ASC");
     */
    public function findByHead2($v, $a = array()) {
        $this->findBy("head2='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to head1
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setHead1($v, $cln = S_CHARACTOR) {
        $this->setValue('head1', $v, $cln);
        return $this;
    }

    /**
     * Get value from head1
     * @return string
     */
    public function getHead1() {
        return $this->getValue('head1');
    }

    /**
     * Find value by field head1
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByHead1("one",array("key_field"=>"DESC|ASC");
     */
    public function findByHead1($v, $a = array()) {
        $this->findBy("head1='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to file1
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setFile1($v, $cln = S_CHARACTOR) {
        $this->setValue('file1', $v, $cln);
        return $this;
    }

    /**
     * Get value from file1
     * @return string
     */
    public function getFile1() {
        return $this->getValue('file1');
    }

    /**
     * Find value by field file1
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByFile1("one",array("key_field"=>"DESC|ASC");
     */
    public function findByFile1($v, $a = array()) {
        $this->findBy("file1='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to file2
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setFile2($v, $cln = S_CHARACTOR) {
        $this->setValue('file2', $v, $cln);
        return $this;
    }

    /**
     * Get value from file2
     * @return string
     */
    public function getFile2() {
        return $this->getValue('file2');
    }

    /**
     * Find value by field file2
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByFile2("one",array("key_field"=>"DESC|ASC");
     */
    public function findByFile2($v, $a = array()) {
        $this->findBy("file2='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to file_check
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setFileCheck($v, $cln = S_CHARACTOR) {
        $this->setValue('file_check', $v, $cln);
        return $this;
    }

    /**
     * Get value from file_check
     * @return string
     */
    public function getFileCheck() {
        return $this->getValue('file_check');
    }

    /**
     * Find value by field file_check
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByFileCheck("one",array("key_field"=>"DESC|ASC");
     */
    public function findByFileCheck($v, $a = array()) {
        $this->findBy("file_check='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to paydetail
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setPaydetail($v, $cln = S_CHARACTOR) {
        $this->setValue('paydetail', $v, $cln);
        return $this;
    }

    /**
     * Get value from paydetail
     * @return string
     */
    public function getPaydetail() {
        return $this->getValue('paydetail');
    }

    /**
     * Find value by field paydetail
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByPaydetail("one",array("key_field"=>"DESC|ASC");
     */
    public function findByPaydetail($v, $a = array()) {
        $this->findBy("paydetail='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to hot
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setHot($v, $cln = S_CHARACTOR) {
        $this->setValue('hot', $v, $cln);
        return $this;
    }

    /**
     * Get value from hot
     * @return string
     */
    public function getHot() {
        return $this->getValue('hot');
    }

    /**
     * Find value by field hot
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByHot("one",array("key_field"=>"DESC|ASC");
     */
    public function findByHot($v, $a = array()) {
        $this->findBy("hot='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to warranty2
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setWarranty2($v, $cln = S_CHARACTOR) {
        $this->setValue('warranty2', $v, $cln);
        return $this;
    }

    /**
     * Get value from warranty2
     * @return string
     */
    public function getWarranty2() {
        return $this->getValue('warranty2');
    }

    /**
     * Find value by field warranty2
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByWarranty2("one",array("key_field"=>"DESC|ASC");
     */
    public function findByWarranty2($v, $a = array()) {
        $this->findBy("warranty2='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to warranty3
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setWarranty3($v, $cln = S_CHARACTOR) {
        $this->setValue('warranty3', $v, $cln);
        return $this;
    }

    /**
     * Get value from warranty3
     * @return string
     */
    public function getWarranty3() {
        return $this->getValue('warranty3');
    }

    /**
     * Find value by field warranty3
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByWarranty3("one",array("key_field"=>"DESC|ASC");
     */
    public function findByWarranty3($v, $a = array()) {
        $this->findBy("warranty3='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to warranty4
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setWarranty4($v, $cln = S_CHARACTOR) {
        $this->setValue('warranty4', $v, $cln);
        return $this;
    }

    /**
     * Get value from warranty4
     * @return string
     */
    public function getWarranty4() {
        return $this->getValue('warranty4');
    }

    /**
     * Find value by field warranty4
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByWarranty4("one",array("key_field"=>"DESC|ASC");
     */
    public function findByWarranty4($v, $a = array()) {
        $this->findBy("warranty4='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to warranty5
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setWarranty5($v, $cln = S_CHARACTOR) {
        $this->setValue('warranty5', $v, $cln);
        return $this;
    }

    /**
     * Get value from warranty5
     * @return string
     */
    public function getWarranty5() {
        return $this->getValue('warranty5');
    }

    /**
     * Find value by field warranty5
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByWarranty5("one",array("key_field"=>"DESC|ASC");
     */
    public function findByWarranty5($v, $a = array()) {
        $this->findBy("warranty5='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to warranty6
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setWarranty6($v, $cln = S_CHARACTOR) {
        $this->setValue('warranty6', $v, $cln);
        return $this;
    }

    /**
     * Get value from warranty6
     * @return string
     */
    public function getWarranty6() {
        return $this->getValue('warranty6');
    }

    /**
     * Find value by field warranty6
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByWarranty6("one",array("key_field"=>"DESC|ASC");
     */
    public function findByWarranty6($v, $a = array()) {
        $this->findBy("warranty6='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to warrantydetail1
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setWarrantydetail1($v, $cln = S_CHARACTOR) {
        $this->setValue('warrantydetail1', $v, $cln);
        return $this;
    }

    /**
     * Get value from warrantydetail1
     * @return string
     */
    public function getWarrantydetail1() {
        return $this->getValue('warrantydetail1');
    }

    /**
     * Find value by field warrantydetail1
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByWarrantydetail1("one",array("key_field"=>"DESC|ASC");
     */
    public function findByWarrantydetail1($v, $a = array()) {
        $this->findBy("warrantydetail1='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to warrantydetail2
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setWarrantydetail2($v, $cln = S_CHARACTOR) {
        $this->setValue('warrantydetail2', $v, $cln);
        return $this;
    }

    /**
     * Get value from warrantydetail2
     * @return string
     */
    public function getWarrantydetail2() {
        return $this->getValue('warrantydetail2');
    }

    /**
     * Find value by field warrantydetail2
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByWarrantydetail2("one",array("key_field"=>"DESC|ASC");
     */
    public function findByWarrantydetail2($v, $a = array()) {
        $this->findBy("warrantydetail2='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to warrantydetail3
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setWarrantydetail3($v, $cln = S_CHARACTOR) {
        $this->setValue('warrantydetail3', $v, $cln);
        return $this;
    }

    /**
     * Get value from warrantydetail3
     * @return string
     */
    public function getWarrantydetail3() {
        return $this->getValue('warrantydetail3');
    }

    /**
     * Find value by field warrantydetail3
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByWarrantydetail3("one",array("key_field"=>"DESC|ASC");
     */
    public function findByWarrantydetail3($v, $a = array()) {
        $this->findBy("warrantydetail3='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to warrantydetail4
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setWarrantydetail4($v, $cln = S_CHARACTOR) {
        $this->setValue('warrantydetail4', $v, $cln);
        return $this;
    }

    /**
     * Get value from warrantydetail4
     * @return string
     */
    public function getWarrantydetail4() {
        return $this->getValue('warrantydetail4');
    }

    /**
     * Find value by field warrantydetail4
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByWarrantydetail4("one",array("key_field"=>"DESC|ASC");
     */
    public function findByWarrantydetail4($v, $a = array()) {
        $this->findBy("warrantydetail4='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to bankname1
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setBankname1($v, $cln = S_CHARACTOR) {
        $this->setValue('bankname1', $v, $cln);
        return $this;
    }

    /**
     * Get value from bankname1
     * @return string
     */
    public function getBankname1() {
        return $this->getValue('bankname1');
    }

    /**
     * Find value by field bankname1
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByBankname1("one",array("key_field"=>"DESC|ASC");
     */
    public function findByBankname1($v, $a = array()) {
        $this->findBy("bankname1='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to bankbranch1
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setBankbranch1($v, $cln = S_CHARACTOR) {
        $this->setValue('bankbranch1', $v, $cln);
        return $this;
    }

    /**
     * Get value from bankbranch1
     * @return string
     */
    public function getBankbranch1() {
        return $this->getValue('bankbranch1');
    }

    /**
     * Find value by field bankbranch1
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByBankbranch1("one",array("key_field"=>"DESC|ASC");
     */
    public function findByBankbranch1($v, $a = array()) {
        $this->findBy("bankbranch1='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to bankacc1
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setBankacc1($v, $cln = S_CHARACTOR) {
        $this->setValue('bankacc1', $v, $cln);
        return $this;
    }

    /**
     * Get value from bankacc1
     * @return string
     */
    public function getBankacc1() {
        return $this->getValue('bankacc1');
    }

    /**
     * Find value by field bankacc1
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByBankacc1("one",array("key_field"=>"DESC|ASC");
     */
    public function findByBankacc1($v, $a = array()) {
        $this->findBy("bankacc1='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to bankid1
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setBankid1($v, $cln = S_CHARACTOR) {
        $this->setValue('bankid1', $v, $cln);
        return $this;
    }

    /**
     * Get value from bankid1
     * @return string
     */
    public function getBankid1() {
        return $this->getValue('bankid1');
    }

    /**
     * Find value by field bankid1
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByBankid1("one",array("key_field"=>"DESC|ASC");
     */
    public function findByBankid1($v, $a = array()) {
        $this->findBy("bankid1='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to banktype1
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setBanktype1($v, $cln = S_CHARACTOR) {
        $this->setValue('banktype1', $v, $cln);
        return $this;
    }

    /**
     * Get value from banktype1
     * @return string
     */
    public function getBanktype1() {
        return $this->getValue('banktype1');
    }

    /**
     * Find value by field banktype1
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByBanktype1("one",array("key_field"=>"DESC|ASC");
     */
    public function findByBanktype1($v, $a = array()) {
        $this->findBy("banktype1='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to shop_date
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setShopDate($v, $cln = S_CHARACTOR) {
        $this->setValue('shop_date', $v, $cln);
        return $this;
    }

    /**
     * Get value from shop_date
     * @return string
     */
    public function getShopDate() {
        return $this->getValue('shop_date');
    }

    /**
     * Find value by field shop_date
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByShopDate("one",array("key_field"=>"DESC|ASC");
     */
    public function findByShopDate($v, $a = array()) {
        $this->findBy("shop_date='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to shop_date_piece
     * @param string $v
     * @param integer $cln
     * @return Member
     */
    public function setShopDatePiece($v, $cln = S_CHARACTOR) {
        $this->setValue('shop_date_piece', $v, $cln);
        return $this;
    }

    /**
     * Get value from shop_date_piece
     * @return string
     */
    public function getShopDatePiece() {
        return $this->getValue('shop_date_piece');
    }

    /**
     * Find value by field shop_date_piece
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByShopDatePiece("one",array("key_field"=>"DESC|ASC");
     */
    public function findByShopDatePiece($v, $a = array()) {
        $this->findBy("shop_date_piece='{$v}'", $a);
        return $this;
    }

}

?>