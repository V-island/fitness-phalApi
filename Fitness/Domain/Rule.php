<?php

class Domain_Rule {
    public function setItems($data)
    {
        $modelItems = new Model_Items();
        return $modelItems->insert($data);
    }
    public function checkItems($id)
    {
    	$model = new Model_Items();
    	return $model->get($id);
    }
    public function updateItems($id, $data)
    {
    	$model = new Model_Items();
    	return $model->update($id, $data);
    }
    public function getList($id)
    {
    	$model = new Model_Items();
    	return $model->getList($id);
    }
}
