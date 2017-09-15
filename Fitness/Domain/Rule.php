<?php

class Domain_Rule {
    public function getUserId($openId)
    {
        $modelUser = new Model_User();
        $userId = $modelUser->getByUserId($openId);

        if (empty($userId)) {
            $userId = $modelUser->insert(array(
                'wx_openid'       => $openId,
                'reg_time'        => $_SERVER['REQUEST_TIME'],
            ));
            return $userId;
        }
        return $userId;
    }

}
