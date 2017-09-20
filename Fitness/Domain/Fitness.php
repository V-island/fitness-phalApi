<?php

class Domain_Fitness {
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
    public function getUserInfo($userId) {
        $modelRecord = new Model_Record();
        $fetch = $modelRecord->getByFetch($userId);
        if (empty($fetch)) {
            $fetch = $modelRecord->insert(array(
                'user_id'   => $userId,
                'sign'      => 0,
                'duration'  => 0,
                'content'   => null,
                'createtime'=> $_SERVER['REQUEST_TIME'],
                'updatetime'=> $_SERVER['REQUEST_TIME'],
            ));
            return $fetch;
        }
        return $fetch;
    }
    public function getRecord($userId, $star, $end)
    {
        $modelRecord = new Model_Record();
        if ($star == 0 && $end == 0) {
            $fetch = $modelRecord->getByFetch($userId);
            return $fetch;
        }
        $fetch = $modelRecord->getTimeFetch($userId['id'], $star, $end);
        return $fetch;
    }
    public function userRecord($userId, $sign, $duration, $content)
    {
        $modelRecord = new Model_Record();
        $fetch = $modelRecord->getByFetch($userId);
        if (!empty($fetch)) {
            $update = date('y-m-d', $fetch['createtime']);
            $current = date('y-m-d');
            if ($update == $current) {
                $userRecord = $modelRecord->update($fetch['id'],array(
                    'sign'      => $sign,
                    'duration'  => $duration,
                    'content'   => $content,
                    'updatetime'=> $_SERVER['REQUEST_TIME'],
                ));
                return $userRecord;
            }
        }
        $userRecord = $modelRecord->insert(array(
            'user_id'   => $userId,
            'sign'      => $sign,
            'duration'  => $duration,
            'content'   => $content,
            'createtime'=> $_SERVER['REQUEST_TIME'],
            'updatetime'=> $_SERVER['REQUEST_TIME'],
        ));
        return $userRecord;
    }

}
