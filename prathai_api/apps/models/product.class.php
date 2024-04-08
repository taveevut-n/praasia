<?php

final class Product extends DataModel {

    function __construct() {
        parent::__construct("config/configuration.xml", "product", array("person_id"));
    }

    /**
     * Set value to product_id
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setProductId($v, $cln = S_CHARACTOR) {
        $this->setValue('product_id', $v, $cln);
        return $this;
    }

    /**
     * Get value from product_id
     * @return string
     */
    public function getProductId() {
        return $this->getValue('product_id');
    }

    /**
     * Find value by field product_id
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByProductId("one",array("key_field"=>"DESC|ASC");
     */
    public function findByProductId($v, $a = array()) {
        $this->findBy("product_id='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to shop_id
     * @param string $v
     * @param integer $cln
     * @return Product
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
     * Set value to catalog_id
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setCatalogId($v, $cln = S_CHARACTOR) {
        $this->setValue('catalog_id', $v, $cln);
        return $this;
    }

    /**
     * Get value from catalog_id
     * @return string
     */
    public function getCatalogId() {
        return $this->getValue('catalog_id');
    }

    /**
     * Find value by field catalog_id
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByCatalogId("one",array("key_field"=>"DESC|ASC");
     */
    public function findByCatalogId($v, $a = array()) {
        $this->findBy("catalog_id='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to catalogpra_id
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setCatalogpraId($v, $cln = S_CHARACTOR) {
        $this->setValue('catalogpra_id', $v, $cln);
        return $this;
    }

    /**
     * Get value from catalogpra_id
     * @return string
     */
    public function getCatalogpraId() {
        return $this->getValue('catalogpra_id');
    }

    /**
     * Find value by field catalogpra_id
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByCatalogpraId("one",array("key_field"=>"DESC|ASC");
     */
    public function findByCatalogpraId($v, $a = array()) {
        $this->findBy("catalogpra_id='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to name
     * @param string $v
     * @param integer $cln
     * @return Product
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
     * Set value to price
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setPrice($v, $cln = S_CHARACTOR) {
        $this->setValue('price', $v, $cln);
        return $this;
    }

    /**
     * Get value from price
     * @return string
     */
    public function getPrice() {
        return $this->getValue('price');
    }

    /**
     * Find value by field price
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByPrice("one",array("key_field"=>"DESC|ASC");
     */
    public function findByPrice($v, $a = array()) {
        $this->findBy("price='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to status
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setStatus($v, $cln = S_CHARACTOR) {
        $this->setValue('status', $v, $cln);
        return $this;
    }

    /**
     * Get value from status
     * @return string
     */
    public function getStatus() {
        return $this->getValue('status');
    }

    /**
     * Find value by field status
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByStatus("one",array("key_field"=>"DESC|ASC");
     */
    public function findByStatus($v, $a = array()) {
        $this->findBy("status='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to hot
     * @param string $v
     * @param integer $cln
     * @return Product
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
     * Set value to prarelease
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setPrarelease($v, $cln = S_CHARACTOR) {
        $this->setValue('prarelease', $v, $cln);
        return $this;
    }

    /**
     * Get value from prarelease
     * @return string
     */
    public function getPrarelease() {
        return $this->getValue('prarelease');
    }

    /**
     * Find value by field prarelease
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByPrarelease("one",array("key_field"=>"DESC|ASC");
     */
    public function findByPrarelease($v, $a = array()) {
        $this->findBy("prarelease='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to active
     * @param string $v
     * @param integer $cln
     * @return Product
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
     * Set value to recommend
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setRecommend($v, $cln = S_CHARACTOR) {
        $this->setValue('recommend', $v, $cln);
        return $this;
    }

    /**
     * Get value from recommend
     * @return string
     */
    public function getRecommend() {
        return $this->getValue('recommend');
    }

    /**
     * Find value by field recommend
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByRecommend("one",array("key_field"=>"DESC|ASC");
     */
    public function findByRecommend($v, $a = array()) {
        $this->findBy("recommend='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to slide
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setSlide($v, $cln = S_CHARACTOR) {
        $this->setValue('slide', $v, $cln);
        return $this;
    }

    /**
     * Get value from slide
     * @return string
     */
    public function getSlide() {
        return $this->getValue('slide');
    }

    /**
     * Find value by field slide
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findBySlide("one",array("key_field"=>"DESC|ASC");
     */
    public function findBySlide($v, $a = array()) {
        $this->findBy("slide='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to warning
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setWarning($v, $cln = S_CHARACTOR) {
        $this->setValue('warning', $v, $cln);
        return $this;
    }

    /**
     * Get value from warning
     * @return string
     */
    public function getWarning() {
        return $this->getValue('warning');
    }

    /**
     * Find value by field warning
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByWarning("one",array("key_field"=>"DESC|ASC");
     */
    public function findByWarning($v, $a = array()) {
        $this->findBy("warning='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to certificate
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setCertificate($v, $cln = S_CHARACTOR) {
        $this->setValue('certificate', $v, $cln);
        return $this;
    }

    /**
     * Get value from certificate
     * @return string
     */
    public function getCertificate() {
        return $this->getValue('certificate');
    }

    /**
     * Find value by field certificate
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByCertificate("one",array("key_field"=>"DESC|ASC");
     */
    public function findByCertificate($v, $a = array()) {
        $this->findBy("certificate='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to other
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setOther($v, $cln = S_CHARACTOR) {
        $this->setValue('other', $v, $cln);
        return $this;
    }

    /**
     * Get value from other
     * @return string
     */
    public function getOther() {
        return $this->getValue('other');
    }

    /**
     * Find value by field other
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByOther("one",array("key_field"=>"DESC|ASC");
     */
    public function findByOther($v, $a = array()) {
        $this->findBy("other='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to watprice
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setWatprice($v, $cln = S_CHARACTOR) {
        $this->setValue('watprice', $v, $cln);
        return $this;
    }

    /**
     * Get value from watprice
     * @return string
     */
    public function getWatprice() {
        return $this->getValue('watprice');
    }

    /**
     * Find value by field watprice
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByWatprice("one",array("key_field"=>"DESC|ASC");
     */
    public function findByWatprice($v, $a = array()) {
        $this->findBy("watprice='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to detail
     * @param string $v
     * @param integer $cln
     * @return Product
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
     * Set value to tag
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setTag($v, $cln = S_CHARACTOR) {
        $this->setValue('tag', $v, $cln);
        return $this;
    }

    /**
     * Get value from tag
     * @return string
     */
    public function getTag() {
        return $this->getValue('tag');
    }

    /**
     * Find value by field tag
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByTag("one",array("key_field"=>"DESC|ASC");
     */
    public function findByTag($v, $a = array()) {
        $this->findBy("tag='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to score
     * @param string $v
     * @param integer $cln
     * @return Product
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
     * Set value to pic1
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setPic1($v, $cln = S_CHARACTOR) {
        $this->setValue('pic1', $v, $cln);
        return $this;
    }

    /**
     * Get value from pic1
     * @return string
     */
    public function getPic1() {
        return $this->getValue('pic1');
    }

    /**
     * Find value by field pic1
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByPic1("one",array("key_field"=>"DESC|ASC");
     */
    public function findByPic1($v, $a = array()) {
        $this->findBy("pic1='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to pic2
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setPic2($v, $cln = S_CHARACTOR) {
        $this->setValue('pic2', $v, $cln);
        return $this;
    }

    /**
     * Get value from pic2
     * @return string
     */
    public function getPic2() {
        return $this->getValue('pic2');
    }

    /**
     * Find value by field pic2
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByPic2("one",array("key_field"=>"DESC|ASC");
     */
    public function findByPic2($v, $a = array()) {
        $this->findBy("pic2='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to pic3
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setPic3($v, $cln = S_CHARACTOR) {
        $this->setValue('pic3', $v, $cln);
        return $this;
    }

    /**
     * Get value from pic3
     * @return string
     */
    public function getPic3() {
        return $this->getValue('pic3');
    }

    /**
     * Find value by field pic3
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByPic3("one",array("key_field"=>"DESC|ASC");
     */
    public function findByPic3($v, $a = array()) {
        $this->findBy("pic3='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to pic4
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setPic4($v, $cln = S_CHARACTOR) {
        $this->setValue('pic4', $v, $cln);
        return $this;
    }

    /**
     * Get value from pic4
     * @return string
     */
    public function getPic4() {
        return $this->getValue('pic4');
    }

    /**
     * Find value by field pic4
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByPic4("one",array("key_field"=>"DESC|ASC");
     */
    public function findByPic4($v, $a = array()) {
        $this->findBy("pic4='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to view_num
     * @param string $v
     * @param integer $cln
     * @return Product
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
     * Set value to date_add
     * @param string $v
     * @param integer $cln
     * @return Product
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
     * Set value to hotdate
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setHotdate($v, $cln = S_CHARACTOR) {
        $this->setValue('hotdate', $v, $cln);
        return $this;
    }

    /**
     * Get value from hotdate
     * @return string
     */
    public function getHotdate() {
        return $this->getValue('hotdate');
    }

    /**
     * Find value by field hotdate
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByHotdate("one",array("key_field"=>"DESC|ASC");
     */
    public function findByHotdate($v, $a = array()) {
        $this->findBy("hotdate='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to certificatedate
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setCertificatedate($v, $cln = S_CHARACTOR) {
        $this->setValue('certificatedate', $v, $cln);
        return $this;
    }

    /**
     * Get value from certificatedate
     * @return string
     */
    public function getCertificatedate() {
        return $this->getValue('certificatedate');
    }

    /**
     * Find value by field certificatedate
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByCertificatedate("one",array("key_field"=>"DESC|ASC");
     */
    public function findByCertificatedate($v, $a = array()) {
        $this->findBy("certificatedate='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to order_num
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setOrderNum($v, $cln = S_CHARACTOR) {
        $this->setValue('order_num', $v, $cln);
        return $this;
    }

    /**
     * Get value from order_num
     * @return string
     */
    public function getOrderNum() {
        return $this->getValue('order_num');
    }

    /**
     * Find value by field order_num
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByOrderNum("one",array("key_field"=>"DESC|ASC");
     */
    public function findByOrderNum($v, $a = array()) {
        $this->findBy("order_num='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to detailcn1
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setDetailcn1($v, $cln = S_CHARACTOR) {
        $this->setValue('detailcn1', $v, $cln);
        return $this;
    }

    /**
     * Get value from detailcn1
     * @return string
     */
    public function getDetailcn1() {
        return $this->getValue('detailcn1');
    }

    /**
     * Find value by field detailcn1
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByDetailcn1("one",array("key_field"=>"DESC|ASC");
     */
    public function findByDetailcn1($v, $a = array()) {
        $this->findBy("detailcn1='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to detailcn2
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setDetailcn2($v, $cln = S_CHARACTOR) {
        $this->setValue('detailcn2', $v, $cln);
        return $this;
    }

    /**
     * Get value from detailcn2
     * @return string
     */
    public function getDetailcn2() {
        return $this->getValue('detailcn2');
    }

    /**
     * Find value by field detailcn2
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByDetailcn2("one",array("key_field"=>"DESC|ASC");
     */
    public function findByDetailcn2($v, $a = array()) {
        $this->findBy("detailcn2='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to detailcn3
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setDetailcn3($v, $cln = S_CHARACTOR) {
        $this->setValue('detailcn3', $v, $cln);
        return $this;
    }

    /**
     * Get value from detailcn3
     * @return string
     */
    public function getDetailcn3() {
        return $this->getValue('detailcn3');
    }

    /**
     * Find value by field detailcn3
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByDetailcn3("one",array("key_field"=>"DESC|ASC");
     */
    public function findByDetailcn3($v, $a = array()) {
        $this->findBy("detailcn3='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to detailcn4
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setDetailcn4($v, $cln = S_CHARACTOR) {
        $this->setValue('detailcn4', $v, $cln);
        return $this;
    }

    /**
     * Get value from detailcn4
     * @return string
     */
    public function getDetailcn4() {
        return $this->getValue('detailcn4');
    }

    /**
     * Find value by field detailcn4
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByDetailcn4("one",array("key_field"=>"DESC|ASC");
     */
    public function findByDetailcn4($v, $a = array()) {
        $this->findBy("detailcn4='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to detailcn5
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setDetailcn5($v, $cln = S_CHARACTOR) {
        $this->setValue('detailcn5', $v, $cln);
        return $this;
    }

    /**
     * Get value from detailcn5
     * @return string
     */
    public function getDetailcn5() {
        return $this->getValue('detailcn5');
    }

    /**
     * Find value by field detailcn5
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByDetailcn5("one",array("key_field"=>"DESC|ASC");
     */
    public function findByDetailcn5($v, $a = array()) {
        $this->findBy("detailcn5='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to detailcn6
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setDetailcn6($v, $cln = S_CHARACTOR) {
        $this->setValue('detailcn6', $v, $cln);
        return $this;
    }

    /**
     * Get value from detailcn6
     * @return string
     */
    public function getDetailcn6() {
        return $this->getValue('detailcn6');
    }

    /**
     * Find value by field detailcn6
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByDetailcn6("one",array("key_field"=>"DESC|ASC");
     */
    public function findByDetailcn6($v, $a = array()) {
        $this->findBy("detailcn6='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to detailcn7
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setDetailcn7($v, $cln = S_CHARACTOR) {
        $this->setValue('detailcn7', $v, $cln);
        return $this;
    }

    /**
     * Get value from detailcn7
     * @return string
     */
    public function getDetailcn7() {
        return $this->getValue('detailcn7');
    }

    /**
     * Find value by field detailcn7
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByDetailcn7("one",array("key_field"=>"DESC|ASC");
     */
    public function findByDetailcn7($v, $a = array()) {
        $this->findBy("detailcn7='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to detailcn8
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setDetailcn8($v, $cln = S_CHARACTOR) {
        $this->setValue('detailcn8', $v, $cln);
        return $this;
    }

    /**
     * Get value from detailcn8
     * @return string
     */
    public function getDetailcn8() {
        return $this->getValue('detailcn8');
    }

    /**
     * Find value by field detailcn8
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByDetailcn8("one",array("key_field"=>"DESC|ASC");
     */
    public function findByDetailcn8($v, $a = array()) {
        $this->findBy("detailcn8='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to detailcn9
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setDetailcn9($v, $cln = S_CHARACTOR) {
        $this->setValue('detailcn9', $v, $cln);
        return $this;
    }

    /**
     * Get value from detailcn9
     * @return string
     */
    public function getDetailcn9() {
        return $this->getValue('detailcn9');
    }

    /**
     * Find value by field detailcn9
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByDetailcn9("one",array("key_field"=>"DESC|ASC");
     */
    public function findByDetailcn9($v, $a = array()) {
        $this->findBy("detailcn9='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to detailcn10
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setDetailcn10($v, $cln = S_CHARACTOR) {
        $this->setValue('detailcn10', $v, $cln);
        return $this;
    }

    /**
     * Get value from detailcn10
     * @return string
     */
    public function getDetailcn10() {
        return $this->getValue('detailcn10');
    }

    /**
     * Find value by field detailcn10
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByDetailcn10("one",array("key_field"=>"DESC|ASC");
     */
    public function findByDetailcn10($v, $a = array()) {
        $this->findBy("detailcn10='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to detailcn11
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setDetailcn11($v, $cln = S_CHARACTOR) {
        $this->setValue('detailcn11', $v, $cln);
        return $this;
    }

    /**
     * Get value from detailcn11
     * @return string
     */
    public function getDetailcn11() {
        return $this->getValue('detailcn11');
    }

    /**
     * Find value by field detailcn11
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByDetailcn11("one",array("key_field"=>"DESC|ASC");
     */
    public function findByDetailcn11($v, $a = array()) {
        $this->findBy("detailcn11='{$v}'", $a);
        return $this;
    }

    /**
     * Set value to detailcn12
     * @param string $v
     * @param integer $cln
     * @return Product
     */
    public function setDetailcn12($v, $cln = S_CHARACTOR) {
        $this->setValue('detailcn12', $v, $cln);
        return $this;
    }

    /**
     * Get value from detailcn12
     * @return string
     */
    public function getDetailcn12() {
        return $this->getValue('detailcn12');
    }

    /**
     * Find value by field detailcn12
     * @param string $v field name
     * @param array $a field => DESC|ASC
     * @return self
     * @Example $this->findByDetailcn12("one",array("key_field"=>"DESC|ASC");
     */
    public function findByDetailcn12($v, $a = array()) {
        $this->findBy("detailcn12='{$v}'", $a);
        return $this;
    }

}

?>