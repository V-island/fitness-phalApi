<?php
/**
 * 规则配置
 *
 *
 */

class Api_Rule extends PhalApi_Api {

	public function getRules() {
        return array(
        	'getList' => array(
        		'id'    => array('name' => 'id', 'type' => 'int', 'default' => 0, 'desc' => '项目ID'),
        	),
            'writeItems' => array(
            	'p_id'    => array('name' => 'parentId', 'type' => 'int', 'default' => 0, 'desc' => '父级ID(默认为0为根目录)'),
                'name'    => array('name' => 'name', 'type' => 'string', 'require' => true, 'desc' => '锻炼项目名称'),
                'series'  => array('name' => 'series', 'type' => 'int', 'default' => 3, 'desc' => '组'),
                'number'  => array('name' => 'number', 'type' => 'int', 'default' => 0, 'desc' => '每组次数'),
                'remark'  => array('name' => 'remark', 'type' => 'string', 'desc' => '备注'),
                'weight'  => array('name' => 'weight', 'type' => 'int', 'default' => 0, 'desc' => '权重'),
                'status'  => array('name' => 'status', 'type' => 'int', 'default' => 0, 'desc' => '状态')
            ),
            'editItems' => array(
            	'id'      => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '编辑项目ID'),
            	'p_id'    => array('name' => 'parentId', 'type' => 'int', 'default' => 0, 'desc' => '父级ID(默认为0为根目录)'),
                'name'    => array('name' => 'name', 'type' => 'string', 'require' => true, 'desc' => '锻炼项目名称'),
                'series'  => array('name' => 'series', 'type' => 'int', 'default' => 3, 'desc' => '组'),
                'number'  => array('name' => 'number', 'type' => 'int', 'default' => 0, 'desc' => '每组次数'),
                'remark'  => array('name' => 'remark', 'type' => 'string', 'desc' => '备注'),
                'weight'  => array('name' => 'weight', 'type' => 'int', 'default' => 0, 'desc' => '权重'),
                'status'  => array('name' => 'status', 'type' => 'int', 'default' => 0, 'desc' => '状态')
            ),
        );
	}

	/**
	 * 获取项目列表
	 *
	 * @desc 通过ID获取项目列表，默认为0即根目录，默认为权重(weight)越高优先级越高
	 * @return array  list  获取项目列表
	 */
	public function getList() {
		$rs = array('code' => 200, 'list' => array(), 'msg' => T('The request was successful'));

		$domain = new Domain_Rule();
		$list = $domain->getList($this->id);
		if (empty($list)) {
			$rs['code'] = 1;
			$rs['msg'] = T('There is no item with ID {id} in the database', array('id' => $this->id));
			return $rs;
		}
		foreach ($list as $key => $item) {
			$list[$key]['child'] = $domain->getList($item['id']);
		}
		$rs['list'] = $list;
		return $rs;
	}

	/**
	 * 锻炼项目录入
	 *
	 * @desc 单条锻炼项目录入
	 */
	public function writeItems() {
		$rs = array('code' => 200, 'msg' => T('Project entry is successful'));

		$domain = new Domain_Rule();
		$status = $domain->setItems(array(
            'p_id'       => $this->p_id,
            'name'       => $this->name,
            'series'     => $this->series,
            'number'     => $this->number,
            'remark'     => $this->remark,
            'weight'     => $this->weight,
            'status'     => $this->status,
        ));
		if (empty($status)) {
		    $rs['code'] = 0;
		    $rs['msg'] = T('atabase write failed');
		    return $rs;
		}
		return $rs;
	}

	/**
	 * 编辑项目
	 *
	 * @desc 通过项目ID编辑,编辑单条锻炼项目
	 */
	public function editItems() {
		$rs = array('code' => 200, 'msg' => T('The project is edited successfully'));

		$domain = new Domain_Rule();
		$check = $domain->checkItems($this->id);
		if (empty($check)) {
			$rs['code'] = 0;
			$rs['msg'] = T('There is no item with ID {id} in the database', array('id' => $this->id));
			return $rs;
		}
		$status = $domain->updateItems($this->id,
			array(
	            'p_id'       => $this->p_id,
	            'name'       => $this->name,
	            'series'     => $this->series,
	            'number'     => $this->number,
	            'remark'     => $this->remark,
	            'weight'     => $this->weight,
	            'status'     => $this->status,
        	)
        );
        if (empty($status)) {
        	$rs['code'] = 1;
        	$rs['msg'] = T('Item editing failed');
        	return $rs;
        }
        return $rs;
	}
}
