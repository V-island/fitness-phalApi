<?php
/**

CREATE TABLE `fitness_user` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `wx_openid` varchar(28) DEFAULT '' COMMENT '微信OPENID',
  `reg_time` int(11) DEFAULT '0' COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 */
class Model_User extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'user';
    }

    public function getByUserId($opeId) {
        return $this->getORM()
            ->select('id')
            ->where('wx_openid', $opeId)
            ->fetch();
    }
}
