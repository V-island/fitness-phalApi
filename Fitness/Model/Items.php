<?php
/**

CREATE TABLE `fitness_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL COMMENT '锻炼项目ID',
  `name` varchar(255) NOT NULL COMMENT '项目名称',
  `series` int(11) NOT NULL DEFAULT '3' COMMENT '组',
  `number` int(11) NOT NULL DEFAULT '0' COMMENT '次数',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `weight` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '权重',
  `status` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 */
class Model_Items extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'items';
    }

    public function getList($id) {
        return $this->getORM()
              ->select('id', 'p_id', 'name', 'series', 'number', 'remark')
              ->order('weight DESC')
              ->where('p_id', $id)
              ->fetchAll();
    }
}
