<?php
/**

CREATE TABLE `fitness_items_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '锻炼项目',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `weight` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '权重',
  `status` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 */
class Model_ItemsRule extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'items_rule';
    }
}
