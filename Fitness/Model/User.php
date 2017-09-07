<?php
/**

CREATE TABLE `fitness_user` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `wx_openid` varchar(28) DEFAULT '' COMMENT '微信OPENID',
  `wx_token` varchar(150) DEFAULT '' COMMENT '微信TOKEN',
  `wx_expires_in` int(10) DEFAULT '0' COMMENT '微信失效时间',
  `user_id` bigint(10) DEFAULT '0' COMMENT '绑定的用户ID',
  `reg_time` int(11) DEFAULT '0' COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 */
class Model_User extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'user';
    }

    public function getByUserId($userId) {
        return $this->getORM()
            ->select('*')
            ->where('id = ?', $userId)
            ->fetch();
    }
}
