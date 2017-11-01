<?php

use common\helpers\MySqlDateTime;
use yii\db\Migration;

class m991231_235959_insert_mfa_test_users extends Migration
{

    public function safeUp()
    {
        $this->batchInsert('{{user}}',
            ['id','uuid'                                ,'employee_id','first_name','last_name','username'       ,'email'                      ,'active','locked','last_changed_utc'   ,'last_synced_utc'    ,'require_mfa','nag_for_mfa_after'    ],[
            [ 1  ,'2b2d424e-8cb0-49c7-8c0b-7f660340f5fa','11111'      ,'Not'       ,'Needed'   ,'no_mfa_needed'  ,'no_mfa_needed@example.org'  ,'yes'   ,'no'    , MySqlDateTime::now(), MySqlDateTime::now(),'no'         , MySqlDateTime::today()],
            [ 2  ,'ef960c92-09fc-44f4-aadf-2d3aea6e0dbd','22222'      ,'Must'      ,'Have'     ,'must_set_up_mfa','must_set_up_mfa@example.org','yes'   ,'no'    , MySqlDateTime::now(), MySqlDateTime::now(),'yes'        , MySqlDateTime::today()],
            [ 3  ,'a42317a0-9a43-4da0-9921-50f004e011c0','33333'      ,'Has'       ,'Backup'   ,'has_backupcode' ,'has_backupcode@example.org' ,'yes'   ,'no'    , MySqlDateTime::now(), MySqlDateTime::now(),'no'         , MySqlDateTime::today()],
            [ 4  ,'7bab90d3-9f54-4187-804d-7f6400021789','44444'      ,'Has'       ,'Totp'     ,'has_totp'       ,'has_totp@example.org'       ,'yes'   ,'no'    , MySqlDateTime::now(), MySqlDateTime::now(),'no'         , MySqlDateTime::today()],
            [ 5  ,'6b614606-bbe8-4793-b0db-ca862295c661','55555'      ,'Has'       ,'U2f'      ,'has_u2f'        ,'has_u2f@example.org'        ,'yes'   ,'no'    , MySqlDateTime::now(), MySqlDateTime::now(),'no'         , MySqlDateTime::today()],
            [ 6  ,'7c695eac-dbca-45d0-b3dc-2df2e1d2294c','77777'      ,'Has'       ,'All'      ,'has_all'        ,'has_all@example.org'        ,'yes'   ,'no'    , MySqlDateTime::now(), MySqlDateTime::now(),'no'         , MySqlDateTime::today()],
        ]);

        $this->batchInsert('{{password}}',
            ['id','user_id','hash'                                                        ,'created_utc'        ,'expires_on'                       ,'grace_period_ends_on'             ],[
            [ 1  , 1       ,'$2y$10$rKbAp0M8gewGpQKhD.U6qOSGDlMqKFkxK9tQZ15SZoieqYHYNsD/y', MySqlDateTime::now(), MySqlDateTime::relative('+1 year'), MySqlDateTime::relative('+1 year')],
            [ 2  , 2       ,'$2y$10$rKbAp0M8gewGpQKhD.U6qOSGDlMqKFkxK9tQZ15SZoieqYHYNsD/y', MySqlDateTime::now(), MySqlDateTime::relative('+1 year'), MySqlDateTime::relative('+1 year')],
            [ 3  , 3       ,'$2y$10$rKbAp0M8gewGpQKhD.U6qOSGDlMqKFkxK9tQZ15SZoieqYHYNsD/y', MySqlDateTime::now(), MySqlDateTime::relative('+1 year'), MySqlDateTime::relative('+1 year')],
            [ 4  , 4       ,'$2y$10$rKbAp0M8gewGpQKhD.U6qOSGDlMqKFkxK9tQZ15SZoieqYHYNsD/y', MySqlDateTime::now(), MySqlDateTime::relative('+1 year'), MySqlDateTime::relative('+1 year')],
            [ 5  , 5       ,'$2y$10$rKbAp0M8gewGpQKhD.U6qOSGDlMqKFkxK9tQZ15SZoieqYHYNsD/y', MySqlDateTime::now(), MySqlDateTime::relative('+1 year'), MySqlDateTime::relative('+1 year')],
            [ 6  , 6       ,'$2y$10$rKbAp0M8gewGpQKhD.U6qOSGDlMqKFkxK9tQZ15SZoieqYHYNsD/y', MySqlDateTime::now(), MySqlDateTime::relative('+1 year'), MySqlDateTime::relative('+1 year')],
        ]);

        $this->update('{{user}}', ['current_password_id' => 1], 'id=1');
        $this->update('{{user}}', ['current_password_id' => 2], 'id=2');
        $this->update('{{user}}', ['current_password_id' => 3], 'id=3');
        $this->update('{{user}}', ['current_password_id' => 4], 'id=4');
        $this->update('{{user}}', ['current_password_id' => 5], 'id=5');
        $this->update('{{user}}', ['current_password_id' => 6], 'id=6');

        //TODO: at this time unfortunately, a real uuid that's been verified is required for testing...will discuss decoupling 2-factor config with authentication.
        $this->batchInsert('{{mfa}}',
            ['id','user_id','type'      ,'external_uuid'                       ,'verified','created_utc'        ],[
            [ 1  , 3       ,'backupcode',NULL                                  , 1        , MySqlDateTime::now()],
            [ 2  , 4       ,'totp'      ,'2f062961-00af-4abf-a7ad-5986778789c1', 1        , MySqlDateTime::now()], // GFDHSMZ6EVBFGRB4
            [ 3  , 5       ,'u2f'       ,'c4f7d437-ad38-4393-a226-22f35cb1bcce', 1        , MySqlDateTime::now()],
            [ 4  , 6       ,'backupcode',NULL                                  , 1        , MySqlDateTime::now()],
            [ 5  , 6       ,'totp'      ,'2f062961-00af-4abf-a7ad-5986778789c1', 1        , MySqlDateTime::now()], // GFDHSMZ6EVBFGRB4
            [ 6  , 6       ,'u2f'       ,'c4f7d437-ad38-4393-a226-22f35cb1bcce', 1        , MySqlDateTime::now()],
        ]);

        $this->batchInsert('{{mfa_backupcode}}',
            ['id','mfa_id','value'                                                       ,'created_utc'        ],[
            [ 1  , 1      ,'$2y$10$j/V6zcotFES8MkVmgRaiMe2E6DV1qjmO8UhUoJQD0/.p6LhZddGn2', MySqlDateTime::now()], // 94923279
            [ 2  , 1      ,'$2y$10$If6srqyKGBag/x.nPDBeau9bjNR1RZgxqRVKhdRhJk2PkbOn5rKNS', MySqlDateTime::now()], // 82743523
            [ 3  , 1      ,'$2y$10$rA5MdrbEcmbCiqtAgPXnYeBCEKc.AnylPArnamyu.x4DS/A0/0/4i', MySqlDateTime::now()], // 77802769
            [ 4  , 1      ,'$2y$10$JsiRI/W/FLfZzJLPj8umKeXP.rvsOW4aYQO5mOEOwGkBPpKhKWT2K', MySqlDateTime::now()], // 01970541
            [ 5  , 1      ,'$2y$10$NWw0.DPBSm.bjQoSck8xbeqJgENUhE/WazmHmsEtWoxs/UKaIdkUq', MySqlDateTime::now()], // 37771076
            [ 6  , 1      ,'$2y$10$KE2849CaFCh4FNy61QfZfO5.3KIakJ0Ri.diDYrTA6DY5FUcUkiTS', MySqlDateTime::now()], // 39178450
            [ 7  , 1      ,'$2y$10$RqIdEzZ0t9dN6XEbCv9saeR91jmhhnAU0IygG2vbkToJtnjVvPOA.', MySqlDateTime::now()], // 01813404
            [ 8  , 1      ,'$2y$10$iiokti/0BscHBdId9GMDeeycdJUbhu3CySBptid4WjlT3ByYSITkq', MySqlDateTime::now()], // 00416843
            [ 9  , 1      ,'$2y$10$cICT0MhQ81/dEWYK/kY/LO2VMYvkoqd1/euP5OG7u5V6FRrSBEY6i', MySqlDateTime::now()], // 90068701
            [ 10 , 1      ,'$2y$10$OzQeTZlUGLOa0Q6Wm2zViuqV4CLzlkJxu8Sjli/v.JI0oYzj.B7um', MySqlDateTime::now()], // 35775442
            [ 11 , 4      ,'$2y$10$j/V6zcotFES8MkVmgRaiMe2E6DV1qjmO8UhUoJQD0/.p6LhZddGn2', MySqlDateTime::now()], // 94923279
            [ 12 , 4      ,'$2y$10$If6srqyKGBag/x.nPDBeau9bjNR1RZgxqRVKhdRhJk2PkbOn5rKNS', MySqlDateTime::now()], // 82743523
            [ 13 , 4      ,'$2y$10$rA5MdrbEcmbCiqtAgPXnYeBCEKc.AnylPArnamyu.x4DS/A0/0/4i', MySqlDateTime::now()], // 77802769
            [ 14 , 4      ,'$2y$10$JsiRI/W/FLfZzJLPj8umKeXP.rvsOW4aYQO5mOEOwGkBPpKhKWT2K', MySqlDateTime::now()], // 01970541
            [ 15 , 4      ,'$2y$10$NWw0.DPBSm.bjQoSck8xbeqJgENUhE/WazmHmsEtWoxs/UKaIdkUq', MySqlDateTime::now()], // 37771076
            [ 16 , 4      ,'$2y$10$KE2849CaFCh4FNy61QfZfO5.3KIakJ0Ri.diDYrTA6DY5FUcUkiTS', MySqlDateTime::now()], // 39178450
            [ 17 , 4      ,'$2y$10$RqIdEzZ0t9dN6XEbCv9saeR91jmhhnAU0IygG2vbkToJtnjVvPOA.', MySqlDateTime::now()], // 01813404
            [ 18 , 4      ,'$2y$10$iiokti/0BscHBdId9GMDeeycdJUbhu3CySBptid4WjlT3ByYSITkq', MySqlDateTime::now()], // 00416843
            [ 19 , 4      ,'$2y$10$cICT0MhQ81/dEWYK/kY/LO2VMYvkoqd1/euP5OG7u5V6FRrSBEY6i', MySqlDateTime::now()], // 90068701
            [ 20 , 4      ,'$2y$10$OzQeTZlUGLOa0Q6Wm2zViuqV4CLzlkJxu8Sjli/v.JI0oYzj.B7um', MySqlDateTime::now()], // 35775442
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{mfa_backupcode}}', [
            'mfa_id' => [1, 4]
        ]);
        $this->delete('{{mfa}}', [
            'user_id' => [3, 4, 5, 6]
        ]);
        $this->delete('{{password}}', [
            'user_id' => [1, 2, 3, 4, 5, 6]
        ]);

        $this->delete('{{user}}', [
            'id' => [1, 2, 3, 4, 5, 6]
        ]);
    }
}
