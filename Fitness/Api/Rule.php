<?php
/**
 * 规则配置
 *
 *
 */

class Api_Rule extends PhalApi_Api {

	public function getRules() {
        return array(
            'writeItems' => array(
                'username' 	=> array('name' => 'username', 'default' => 'PHPer'),
            ),
        );
	}

	public function getItems() {

	}

	public function writeItems(){

	}
}
