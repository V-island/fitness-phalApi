<?php

class Domain_Fitness {

    public function getUserInfo($openId) {
        $modelUser = new Model_User();
        $userId = $modelUser->getByUserId($openId);

        if (empty($userId)) {
            $userId = $modelUser->insert(array(
                'wx_openid'       => $wx_check['openid'],
                'reg_time'        => $_SERVER['REQUEST_TIME'],
            ));
            return T('New user is successful');
        }
        $modelRecord = new Model_Record();
        $fetch = $modelRecord->getByFetch($openId);
        if (empty($fetch)) {
            return T('Old user, no history');
        }
        return $fetch;
    }

}
