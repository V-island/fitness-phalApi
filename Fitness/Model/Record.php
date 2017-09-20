<?php
/**

CREATE TABLE `fitness_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `sign` int(5) unsigned DEFAULT '0' COMMENT '连续签到次数',
  `duration` int(10) unsigned DEFAULT '0' COMMENT '锻炼时长',
  `content` varchar(1500) DEFAULT '' COMMENT '锻炼内容',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `endtime` int(10) unsigned DEFAULT '0' COMMENT '结束时间',
  `updatetime` int(10) unsigned DEFAULT '0' COMMENT '更新时间',
  `status` int(5) unsigned DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 */
class Model_Record extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'record';
    }
    public function getByFetch($userId) {
        return $this->getORM()
            ->select('*')
            ->order('createtime DESC')
            ->where('user_id', $userId)
            ->fetchOne();
    }
    public function getByAllFetch($userId) {
        return $this->getORM()
            ->select('*')
            ->order('createtime DESC')
            ->where('user_id', $userId)
            ->fetchAll();
    }
    public function getTimeFetch($userId, $star, $end)
    {
        return $this->getORM()
            ->select('*')
            ->order('createtime DESC')
            ->where('(updatetime >= ?  AND updatetime <= ?)', array($star, $end))
            ->and('user_id = ?', $userId)
            ->fetchAll();
    }
}
