<?php

/**
 * @author Rewat Boonsit
 * ravatna@gmail.com
 */
class MainControls extends AControl {

    public static $ALL_PRODUCT = 0;
    public static $NEW_PRODUCT = 1;
    public static $RECOMMENT_PRODUCT = 2;
    public static $ALL_SHOP = 3;
    public static $NEW_SHOP = 4;
    public static $RECOMMENT_SHOP = 5;
    public static $NEW_PRODUCT_AFTER2530 = 6;
    public static $NEW_PRODUCT_BEFORE2530 = 7;
    public static $PRODUCT_HAS_CERTIFICATE = 8;
    public static $OTHER_PRODUCT = 9;

    /**
     *
     * @var ProjectConfig $mProjectConfig
     */
    private $mProjectConfig;
    private $mCurrentUpdate = null;
    private $mLang;

    function __construct() {
        parent::__construct();
        $this->mCurrentUpdate = date("Y-m-d H:i:s");
        $this->mLang = new Language("default");
        $this->mProjectConfig = new ProjectConfig("config/configuration.xml");
        switch (HttpParams::varRequest('action')) {


            case 'checkauthen':
                $u = HttpParams::varRequest("u");
                $p = HttpParams::varRequest("p");
                //md5(base64_encode(md5(md5($p))));
                echo $this->actionCheckAuthen($u, md5(base64_encode(md5(md5($p)))));
                break;

            case 'memberproducts':
                $shop_id = HttpParams::varRequest("shop_id", -1);
                echo $this->getMemberProducts($shop_id);
                break;

            case 'products':
                echo $this->getProducts();
                break;

            case 'memberprofile':
                $id = HttpParams::varRequest("member_id", -1);
                echo $this->getMemberProfile($id);
                break;

            case 'memberprofiles':

                echo $this->getMemberProfiles();
                break;

            case 'messagefromroom':

                echo $this->getMessageFromRoom(HttpParams::varRequest("room_id"));
                break;

            case 'createchatroom':
                echo $this->findMessageRoom(HttpParams::varRequest("whocreateid"), HttpParams::varRequest("talkwithid"));
                break;
            
            case 'appendmessage':
                echo $this->appendMessage(HttpParams::varRequest("roomid"),HttpParams::varRequest("whosayid"), HttpParams::varRequest("msg"));
                break;

            // use with admin user
            case 'getinvitelist':
                echo $this->getInviteList();
                break;

            
            case 'getroomlist':
                echo $this->getRoomList(HttpParams::varRequest("whocreateid",0));
                break;
            
            case 'genpassword':
                echo md5(base64_encode(md5(md5(HttpParams::varRequest("p")))));
                break;
        }
    }

    /**
     * ตรวจสอบสิทการเข้าใช้งานระบบ
     * @param type $u
     * @param type $p
     * @return string
     */
    private function actionCheckAuthen($u, $p) {
        header(HttpHeader::$TEXT_JSON_UTF8);
        $_ = new Member();

        $_a = array();
        $_a['status'] = "fail";
        $_a['message'] = "login fail";
        $_a['head']['items'] = 0;
        $_a['data'][0] = array('member_id' => "",
            'adminshop_id' => "",
            'nameshop' => "");

        $_->findBy("username='" . $u . "' AND password='" . $p . "' AND active= '2' ");
        if ($_->moveNextRecord()) {
            $_a['head']['items'] = $_->countRecord();
            $_a['status'] = "success";
            $_a['message'] = "user and password is valid";
            $_a['data'][0] = array(
                'id' => $_->getId(),
                'contact' => $_->getContact(),
                'shop_id' => $_->getShopId(),
                'type' => $_->getType(),
                'username' => $_->getUsername(),
                'password' => $_->getPassword(),
                'email' => $_->getEmail(),
                'name' => $_->getName(),
                'tel' => $_->getTel(),
                'mobile' => $_->getMobile(),
                //'paypal' => $_->getPaypal(),
                'shopname' => $_->getShopname(),
                'date_add' => $_->getDateAdd(),
                'date_extend' => $_->getDateExtend(),
                'date_expire' => $_->getDateExpire(),
                'package_id' => $_->getPackageId(),
                'active' => $_->getActive(),
                'confirmed' => $_->getConfirmed(),
                'score' => $_->getScore(),
                'commentscore' => $_->getCommentscore(),
                'online' => $_->getOnline(),
                'warranty' => $_->getWarranty(),
                //'bankinfo' => $_->getBankinfo(),
                'welcome' => $_->getWelcome(),
                'address' => $_->getAddress(),
                'amphur' => $_->getAmphur(),
                'province' => $_->getProvince(),
                'country' => $_->getCountry(),
                'postcode' => $_->getPostcode(),
                'detail' => $_->getDetail(),
                //'package' => $_->getPackage(),
                //'view_num' => $_->getViewNum(),
                'head2' => $_->getHead2(),
                'head1' => $_->getHead1(),
                //'file1' => $_->getFile1(),
                //'file2' => $_->getFile2(),
                //'file_check' => $_->getFileCheck(),
                //'paydetail' => $_->getPaydetail(),
                'hot' => $_->getHot(),
                //'warranty2' => $_->getWarranty2(),
                //'warranty3' => $_->getWarranty3(),
                //'warranty4' => $_->getWarranty4(),
                //'warranty5' => $_->getWarranty5(),
                //'warranty6' => $_->getWarranty6(),
                //'warrantydetail1' => $_->getWarrantydetail1(),
                //'warrantydetail2' => $_->getWarrantydetail2(),
                //'warrantydetail3' => $_->getWarrantydetail3(),
                //'warrantydetail4' => $_->getWarrantydetail4(),
                //'bankname1' => $_->getBankname1(),
                //'bankbranch1' => $_->getBankbranch1(),
                //'bankacc1' => $_->getBankacc1(),
                //'bankid1' => $_->getBankid1(),
                //'banktype1' => $_->getBanktype1(),
                'shop_date' => $_->getShopDate(),
                    //'shop_date_piece' => $_->getShopDatePiece()
            );
        }

        return json_encode($_a);
    }

    /**
     * ขอข้อมูลสมาชิก
     * @param type $member_id
     * @return string
     */
    private function getMemberProfile($member_id) {
        header(HttpHeader::$TEXT_JSON_UTF8);
        $_ = new Member();

        $_a = array();
        $_a['status'] = "fail";
        $_a['message'] = "get data member was not success";
        $_a['head']['items'] = 0;
        $_a['data'][0] = array();

        $_->findById($member_id);
        if ($_->moveNextRecord()) {

            $_a['head']['items'] = $_->countRecord();
            $_a['status'] = "success";
            $_a['message'] = "get data member was success";
            $_a['data'][0] = array(
                'id' => $_->getId(),
                'contact' => $_->getContact(),
                'shop_id' => $_->getShopId(),
                'type' => $_->getType(),
                'username' => $_->getUsername(),
                'password' => $_->getPassword(),
                'email' => $_->getEmail(),
                'name' => $_->getName(),
                'tel' => $_->getTel(),
                'mobile' => $_->getMobile(),
                //'paypal' => $_->getPaypal(),
                'shopname' => $_->getShopname(),
                'date_add' => $_->getDateAdd(),
                'date_extend' => $_->getDateExtend(),
                'date_expire' => $_->getDateExpire(),
                'package_id' => $_->getPackageId(),
                'active' => $_->getActive(),
                'confirmed' => $_->getConfirmed(),
                'score' => $_->getScore(),
                'commentscore' => $_->getCommentscore(),
                'online' => $_->getOnline(),
                'warranty' => $_->getWarranty(),
                //'bankinfo' => $_->getBankinfo(),
                'welcome' => $_->getWelcome(),
                'address' => $_->getAddress(),
                'amphur' => $_->getAmphur(),
                'province' => $_->getProvince(),
                'country' => $_->getCountry(),
                'postcode' => $_->getPostcode(),
                'detail' => $_->getDetail(),
                //'package' => $_->getPackage(),
                //'view_num' => $_->getViewNum(),
                'head2' => $_->getHead2(),
                'head1' => $_->getHead1(),
                //'file1' => $_->getFile1(),
                //'file2' => $_->getFile2(),
                //'file_check' => $_->getFileCheck(),
                //'paydetail' => $_->getPaydetail(),
                'hot' => $_->getHot(),
                //'warranty2' => $_->getWarranty2(),
                //'warranty3' => $_->getWarranty3(),
                //'warranty4' => $_->getWarranty4(),
                //'warranty5' => $_->getWarranty5(),
                //'warranty6' => $_->getWarranty6(),
                //'warrantydetail1' => $_->getWarrantydetail1(),
                //'warrantydetail2' => $_->getWarrantydetail2(),
                //'warrantydetail3' => $_->getWarrantydetail3(),
                //'warrantydetail4' => $_->getWarrantydetail4(),
                //'bankname1' => $_->getBankname1(),
                //'bankbranch1' => $_->getBankbranch1(),
                //'bankacc1' => $_->getBankacc1(),
                //'bankid1' => $_->getBankid1(),
                //'banktype1' => $_->getBanktype1(),
                'shop_date' => $_->getShopDate(),
                    //'shop_date_piece' => $_->getShopDatePiece()
            );
        }

        return json_encode($_a);
    }

    /**
     * ขอข้อมูลสมาชิก
     * @return string
     */
    private function getMemberProfiles() {
        header(HttpHeader::$TEXT_JSON_UTF8);
        $_ = new Member();

        $_a = array();
        $_a['status'] = "fail";
        $_a['message'] = "get data member was not success";
        $_a['head']['items'] = 0;
        $_a['data'][0] = array();

        $_->findBy("shop_id <> 0 and active='2'", array("shop_id" => "DESC"), 0, 50);
        //echo $_->getQueryCommand();

        if ($_->countRecord() > 0) {
            $_a['head']['items'] = $_->countRecord();
            $_a['status'] = "success";
            $_a['message'] = "get data member was success";


            $_i = 0;
            while ($_->moveNextRecord()) {


                $_a['data'][$_i++] = array(
                    'id' => $_->getId(),
                    'contact' => $_->getContact(),
                    'shop_id' => $_->getShopId(),
                    'type' => $_->getType(),
                    //'username' => $_->getUsername(),
                    //'password' => $_->getPassword(),
                    'email' => $_->getEmail(),
                    'name' => $_->getName(),
                    'tel' => $_->getTel(),
                    'mobile' => $_->getMobile(),
                    //'paypal' => $_->getPaypal(),
                    'shopname' => $_->getShopname(),
                    'date_add' => $_->getDateAdd(),
                    'date_extend' => $_->getDateExtend(),
                    'date_expire' => $_->getDateExpire(),
                    'package_id' => $_->getPackageId(),
                    'active' => $_->getActive(),
                    'confirmed' => $_->getConfirmed(),
                    'score' => $_->getScore(),
                    'commentscore' => $_->getCommentscore(),
                    'online' => $_->getOnline(),
                    'warranty' => $_->getWarranty(),
                    //'bankinfo' => $_->getBankinfo(),
                    'welcome' => $_->getWelcome(),
                    'address' => $_->getAddress(),
                    'amphur' => $_->getAmphur(),
                    'province' => $_->getProvince(),
                    'country' => $_->getCountry(),
                    'postcode' => $_->getPostcode(),
                    'detail' => $_->getDetail(),
                    //'package' => $_->getPackage(),
                    //'view_num' => $_->getViewNum(),
                    'head2' => $_->getHead2(),
                    'head1' => $_->getHead1(),
                    //'file1' => $_->getFile1(),
                    //'file2' => $_->getFile2(),
                    //'file_check' => $_->getFileCheck(),
                    //'paydetail' => $_->getPaydetail(),
                    'hot' => $_->getHot(),
                    //'warranty2' => $_->getWarranty2(),
                    //'warranty3' => $_->getWarranty3(),
                    //'warranty4' => $_->getWarranty4(),
                    //'warranty5' => $_->getWarranty5(),
                    //'warranty6' => $_->getWarranty6(),
                    //'warrantydetail1' => $_->getWarrantydetail1(),
                    //'warrantydetail2' => $_->getWarrantydetail2(),
                    //'warrantydetail3' => $_->getWarrantydetail3(),
                    //'warrantydetail4' => $_->getWarrantydetail4(),
                    //'bankname1' => $_->getBankname1(),
                    //'bankbranch1' => $_->getBankbranch1(),
                    //'bankacc1' => $_->getBankacc1(),
                    //'bankid1' => $_->getBankid1(),
                    //'banktype1' => $_->getBanktype1(),
                    'shop_date' => $_->getShopDate(),
                        //'shop_date_piece' => $_->getShopDatePiece()
                );
            }
        }

        return json_encode($_a);
    }

    /**
     * ขอรายการสินค้าที่เกี่ยวข้องกับ รหัสของสมาชิก
     * @param type $shop_id
     * @return string
     */
    private function getMemberProducts($shop_id) {
        header(HttpHeader::$TEXT_JSON_UTF8);
        $_ = new Product();

        $_a = array();
        $_a['status'] = "fail";
        $_a['message'] = "get data product was not success";
        $_a['head']['items'] = 0;
        $_a['data'][0] = array();

        $_->findById($member_id);
        if ($_->moveNextRecord()) {
            $_a['head']['items'] = $_->countRecord();
            $_a['status'] = "success";
            $_a['message'] = "get data Product was success";
            $_a['data'][0] = array(
                'product_id' => $_->getProductId(),
                'member_id'=>$member_id,
                'shop_id' => $_->getShopId(),
                'catalog_id' => $_->getCatalogId(),
                'catalogpra_id' => $_->getCatalogpraId(),
                'name' => $_->getName(),
                'price' => $_->getPrice(),
                'status' => $_->getStatus(),
                'hot' => $_->getHot(),
                'prarelease' => $_->getPrarelease(),
                'active' => $_->getActive(),
                'recommend' => $_->getRecommend(),
                'slide' => $_->getSlide(),
                'warning' => $_->getWarning(),
                'certificate' => $_->getCertificate(),
                'other' => $_->getOther(),
                'watprice' => $_->getWatprice(),
                'detail' => $_->getDetail(),
                'tag' => $_->getTag(),
                'score' => $_->getScore(),
                'pic1' => $_->getPic1(),
                'pic2' => $_->getPic2(),
                'pic3' => $_->getPic3(),
                'pic4' => $_->getPic4(),
                'view_num' => $_->getViewNum(),
                'date_add' => $_->getDateAdd(),
                'hotdate' => $_->getHotdate(),
                'certificatedate' => $_->getCertificatedate(),
                'order_num' => $_->getOrderNum(),
                'detailcn1' => $_->getDetailcn1(),
                'detailcn2' => $_->getDetailcn2(),
                'detailcn3' => $_->getDetailcn3(),
                'detailcn4' => $_->getDetailcn4(),
                'detailcn5' => $_->getDetailcn5(),
                'detailcn6' => $_->getDetailcn6(),
                'detailcn7' => $_->getDetailcn7(),
                'detailcn8' => $_->getDetailcn8(),
                'detailcn9' => $_->getDetailcn9(),
                'detailcn10' => $_->getDetailcn10(),
                'detailcn11' => $_->getDetailcn11(),
                'detailcn12' => $_->getDetailcn12());
        }

        return json_encode($_a);
    }

    /**
     * ขอรายการสินค้าทั้งหมด
     * @return string
     */
    private function getProducts($citiria_type = "") {
        header(HttpHeader::$TEXT_JSON_UTF8);
        $_ = new Product();
        $_m = new Member();

        $_whare_case = "";
        switch ($citiria_type) {
            case self::$ALL_PRODUCT:
                $_->findAll(array("product_id" => "DESC"), 0, 50);
                break;
            case self::$NEW_PRODUCT:
                $_->findByRecommend('1', array("product_id" => "ASC"));
                break;
            case self::$RECOMMENT_PRODUCT:
                $_->findByHot('1', array("product_id" => "ASC"));
                break;
            default:
                $_->findAll(array("product_id" => "DESC"), 0, 50);
        }

        $_a = array();
        $_a['status'] = "fail";
        $_a['message'] = "get data product was not success";
        $_a['head']['items'] = 0;
        $_a['data'][0] = array();

        $i = 0;
        while ($_->moveNextRecord()) {
            $_m->findById($_->getShopId())->moveNextRecord();
            $_a['head']['items'] = $_->countRecord();
            $_a['status'] = "success";
            $_a['message'] = "get data Product was success";
            $_a['data'][$i++] = array(
                'product_id' => $_->getProductId(),
                'member_id'=>$_m->getId(),
                'shop_id' => $_->getShopId(),
                'shop_name' => $_m->getShopname(),
                'shop_tel' => $_m->getTel(),
                'catalog_id' => $_->getCatalogId(),
                'catalogpra_id' => $_->getCatalogpraId(),
                'name' => $_->getName(),
                'price' => $_->getPrice(),
                'status' => $_->getStatus(),
                'hot' => $_->getHot(),
                'prarelease' => $_->getPrarelease(),
                'active' => $_->getActive(),
                'recommend' => $_->getRecommend(),
                'slide' => $_->getSlide(),
                'warning' => $_->getWarning(),
                'certificate' => $_->getCertificate(),
                'other' => $_->getOther(),
                'watprice' => $_->getWatprice(),
                'detail' => iconv("utf-8", "tis-620", $_->getDetail()),
                'tag' => $_->getTag(),
                'score' => $_->getScore(),
                'pic1' => $_->getPic1(),
                'pic2' => $_->getPic2(),
                'pic3' => $_->getPic3(),
                'pic4' => $_->getPic4(),
                'view_num' => $_->getViewNum(),
                'date_add' => $_->getDateAdd(),
                'hotdate' => $_->getHotdate(),
                'certificatedate' => $_->getCertificatedate(),
                'order_num' => $_->getOrderNum(),
                'detailcn1' => $_->getDetailcn1(),
                'detailcn2' => $_->getDetailcn2(),
                'detailcn3' => $_->getDetailcn3(),
                'detailcn4' => $_->getDetailcn4(),
                'detailcn5' => $_->getDetailcn5(),
                'detailcn6' => $_->getDetailcn6(),
                'detailcn7' => $_->getDetailcn7(),
                'detailcn8' => $_->getDetailcn8(),
                'detailcn9' => $_->getDetailcn9(),
                'detailcn10' => $_->getDetailcn10(),
                'detailcn11' => $_->getDetailcn11(),
                'detailcn12' => $_->getDetailcn12());
        }

        return json_encode($_a);
    }

    // message process

    private function findMessageRoom($whoCreateId, $talkWithId) {
        header(HttpHeader::$TEXT_JSON_UTF8);
        
                $_a = array();
        $_a['status'] = "success";
        $_a['message'] = "get data product was success";
        
        

        
        $_ = new ChatRoom();
        $_roomId = "";
        $_->findByWhoCreateIdAndTalkWithId($whoCreateId, $talkWithId);
        if ($_->moveNextRecord()) {
            $_roomId = $_->getRoomId();
        } else {
            $_roomId = $this->createMessageRoom($whoCreateId, $talkWithId);
        }
        
        $_a['room_id'] = $_roomId;
        
        return json_encode($_a);
    }

    
//    private function findMessageRoom($whoCreateId, $talkWithId) {
//        $_ = new ChatRoom();
//        $_roomId = "";
//        $_->findByWhoCreateIdAndTalkWithId($whoCreateId, $talkWithId);
//        if ($_->moveNextRecord()) {
//            $_roomId = $_->getRoomId();
//        } else {
//            $_roomId = $this->createMessageRoom($whoCreateId, $talkWithId);
//        }
//        
//        return $this->getMessageFromRoom($_roomId);
//    }
    
    /**
     * create new room for chat
     * @param string $whoCreateId
     * @param string $talkWithId
     * @return int
     */
    private function createMessageRoom($whoCreateId, $talkWithId) {
        $_ = new ChatRoom();
        $_roomId = $this->newChatRoomId();
        $_->newRecord();
        $_->setRoomId($_roomId);
        $_->setTalkWithId($talkWithId);
        $_->setWhoCreateId($whoCreateId);
        $_->setInviteAdmin('n');
        $_->setRoomDate($this->mCurrentUpdate);
        $_->saveRecord();
        return $_roomId;
    }

    private function newChatRoomId() {
        $_ = new ChatRoom ();
        $_->findLast();
        $_->moveNextRecord();
        return intval(($_->getRoomId() != "") ? $_->getRoomId() : 0 ) + 1;
    }

    private function getMessageFromRoom($roomId) {
        header(HttpHeader::$TEXT_JSON_UTF8);
        $_ = new ChatRoom();
        $_m = new Member();
        $_mm = new Member();

        $_a = array();
        $_a['status'] = "fail";
        $_a['message'] = "get data was not success";
        $_a['head']['items'] = 0;
        $_a['room'] = array();

        $_->findByRoomId($roomId);
        if ($_->moveNextRecord()) {

            $_chatDetail = new ChatRoomDetail();
            $_chatDetail->findByRoomId($roomId);

            $_m->findById($_->getTalkWithId())->moveNextRecord();
            
            $_a['head']['items'] = $_chatDetail->countRecord();
            $_a['status'] = "success";
            $_a['message'] = "get data was success";
            $_a['room'] = array(
                'room_id' => $_->getRoomId(),
                'room_date' => $_->getRoomDate(),
                'who_create_id'=>$_->getWhoCreateId(),
                'talk_with_id'=>$_->getTalkWithId(),
                'talk_with_pic' =>$_m->getHead1(),
                'talk_with_name'=>$_m->getName(),
                'invite_admin' => $_->getInviteAdmin()
            );

            $i = 0;

            while ($_chatDetail->moveNextRecord()) {

                $_mm ->findById($_chatDetail->getFromMember())->moveNextRecord();
                
                $_a['messages'][$i++] = array(
                    'msg' => $_chatDetail->getMsg(),
                    'msg_trans' => $_chatDetail->getMsgTrans(),
                    'send_date' => $_chatDetail->getSendDate(),
                    'receive_date' => $_chatDetail->getReceiveDate(),
                    'from_member' => $_chatDetail->getFromMember(),
                    'from_member_pic' => $_mm->getHead1(),
                    'to_member' => $_chatDetail->getToMember(),
                    'room_id' => $_chatDetail->getRoomId()
                );
            }
        }

        return json_encode($_a);
    }

    private function getRoomList($whoCreateId) {
        header(HttpHeader::$TEXT_JSON_UTF8);
        $_ = new ChatRoom();
        $_m = new Member();

        $_a = array();
        $_a['status'] = "fail";
        $_a['message'] = "get data was not success";
        $_a['head']['items'] = 0;
        $_a['room'] = array();

        $_->findByRelativeChat($whoCreateId);
        if ($_->countRecord()) {
            $_a['head']['items'] = $_->countRecord();
            $_a['status'] = "success";
            $_a['message'] = "get data was success";
            
            $i = 0;
            while ($_->moveNextRecord()) {
                if($_->getWhoCreateId() == $whoCreateId ){
                    $_m->findById($_->getTalkWithId())->moveNextRecord();
                }
                else
                {
                    $_m->findById($_->getWhoCreateId())->moveNextRecord();
                }
               
                $_a['room'] [$i++]= array(
                    'room_id' => $_->getRoomId(),
                    'room_date' => $_->getRoomDate(),
                    'who_create_id'=>$_->getWhoCreateId(),
                    'talk_with_id'=>$_->getTalkWithId(),
                    'talk_with_pic' =>$_m->getHead1(),
                    'talk_with_name'=>$_m->getName(),
                    'invite_admin' => $_->getInviteAdmin()
                );
            }
        }

        return json_encode($_a);
    }
    
    
    
    private function appendMessage($room_id, $whosayid, $msg) {
        header(HttpHeader::$TEXT_JSON_UTF8);
        $_a = array();
        $_a['status'] = "fail";
        $_a['message'] = "get data was fail";
        $_ = new ChatRoomDetail ();
        $_->newRecord();
        $_->setRoomId($room_id);
        $_->setFromMember($whosayid);
        $_->setToMember("");
        $_->setMsg($msg);
        $_->setSendDate($this->mCurrentUpdate);
        if ($_->saveRecord()) {
            $_a = array();
            $_a['status'] = "success";
            $_a['message'] = "get data was success";
        }
        return json_encode($_a);
    }

    
    
    private function getInviteList() {
        header(HttpHeader::$TEXT_JSON_UTF8);
        $_ = new ChatInvite();

        $_a = array();
        $_a['head']['items'] = $_->countRecord();
        $_a['status'] = "fail";
        $_a['message'] = "get data ChatInvite was fail";
        $_a['data'] = array();

        $_->findAll(array("invite_date" => "desc"));
        if ($_->countRecord() > 0) {

            $_a['head']['items'] = $_->countRecord();
            $_a['status'] = "success";
            $_a['message'] = "get data ChatInvite was success";

            $i = 0;

            while ($_->moveNextRecord()) {

                $_a['data'][$i++] = array('room_id' => $_->getRoomId(), 'invite_date' => $_->getInviteDate(),
                    'accept' => $_->getAccept());
            }
        }

        return json_encode($_a);
    }

}

?>