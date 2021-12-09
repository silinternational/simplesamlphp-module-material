<?php

use common\helpers\MySqlDateTime;
use yii\db\Migration;

class m991231_235959_insert_mfa_test_users extends Migration
{

    public function safeUp()
    {
        $this->batchInsert('{{user}}',
            ['id','uuid'                                ,'employee_id','first_name','last_name','username'       ,'email'                      ,'active','locked','last_changed_utc'   ,'last_synced_utc'    ,'require_mfa','review_profile_after'             ,'nag_for_mfa_after'                ,'nag_for_method_after'             ,'manager_email'  ],[
            [ 1  ,'2b2d424e-8cb0-49c7-8c0b-7f660340f5fa','11111'      ,'No'        ,'Mfas'     ,'nag_for_mfa'    ,'nag_for_mfa@example.org'    ,'yes'   ,'no'    , MySqlDateTime::now(), MySqlDateTime::now(),'no'         , MySqlDateTime::today()            , MySqlDateTime::relative('-1 days'), MySqlDateTime::today()            ,'mgr@example.org'],
            [ 2  ,'ef960c92-09fc-44f4-aadf-2d3aea6e0dbd','22222'      ,'Must'      ,'Have'     ,'must_set_up_mfa','must_set_up_mfa@example.org','yes'   ,'no'    , MySqlDateTime::now(), MySqlDateTime::now(),'yes'        , MySqlDateTime::today()            , MySqlDateTime::today()            , MySqlDateTime::today()            ,'mgr@example.org'],
            [ 3  ,'a42317a0-9a43-4da0-9921-50f004e011c0','33333'      ,'Has'       ,'Backup'   ,'has_backupcode' ,'has_backupcode@example.org' ,'yes'   ,'no'    , MySqlDateTime::now(), MySqlDateTime::now(),'no'         , MySqlDateTime::today()            , MySqlDateTime::today()            , MySqlDateTime::today()            ,'mgr@example.org'],
            [ 4  ,'7bab90d3-9f54-4187-804d-7f6400021789','44444'      ,'Has'       ,'Totp'     ,'has_totp'       ,'has_totp@example.org'       ,'yes'   ,'no'    , MySqlDateTime::now(), MySqlDateTime::now(),'no'         , MySqlDateTime::today()            , MySqlDateTime::today()            , MySqlDateTime::today()            ,'mgr@example.org'],
            [ 5  ,'6b614606-bbe8-4793-b0db-ca862295c661','55555'      ,'Has'       ,'U2f'      ,'has_u2f'        ,'has_u2f@example.org'        ,'yes'   ,'no'    , MySqlDateTime::now(), MySqlDateTime::now(),'no'         , MySqlDateTime::today()            , MySqlDateTime::today()            , MySqlDateTime::today()            ,'mgr@example.org'],
            [ 6  ,'7c695eac-dbca-45d0-b3dc-2df2e1d2294c','77777'      ,'Has'       ,'All'      ,'has_all_legacy' ,'has_all_legacy@example.org' ,'yes'   ,'no'    , MySqlDateTime::now(), MySqlDateTime::now(),'no'         , MySqlDateTime::today()            , MySqlDateTime::today()            , MySqlDateTime::today()            ,'mgr@example.org'],
            [ 7  ,'7c695eac-dbca-45d0-b3dc-123jkhf23bql','88888'      ,'Review'    ,'Needed'   ,'needs_review'   ,'needs_review@example.org'   ,'yes'   ,'no'    , MySqlDateTime::now(), MySqlDateTime::now(),'no'         , MySqlDateTime::relative('-3 days'), MySqlDateTime::today()            , MySqlDateTime::today()            ,'mgr@example.org'],
            [ 8  ,'7c695eac-dbca-45d0-b3dc-123jkhf23bbq','99999'      ,'No'        ,'Methods'  ,'nag_for_method' ,'nag_for_method@example.org' ,'yes'   ,'no'    , MySqlDateTime::now(), MySqlDateTime::now(),'no'         , MySqlDateTime::today()            , MySqlDateTime::today()            , MySqlDateTime::relative('-1 days'),'mgr@example.org'],
            [ 9  ,'c818d44a-a322-45f4-a1d0-6afc3c2a54e9','66666'      ,'Has'       ,'WebAuthn' ,'has_webauthn'   ,'has_webauthn@example.org'   ,'yes'   ,'no'    , MySqlDateTime::now(), MySqlDateTime::now(),'no'         , MySqlDateTime::today()            , MySqlDateTime::today()            , MySqlDateTime::today()            ,'mgr@example.org'],
            [ 10 ,'9272ae4c-4489-4509-94f3-dae81175e213','77778'      ,'Has'       ,'All'      ,'has_all'        ,'has_all@example.org'        ,'yes'   ,'no'    , MySqlDateTime::now(), MySqlDateTime::now(),'no'         , MySqlDateTime::today()            , MySqlDateTime::today()            , MySqlDateTime::today()            ,'mgr@example.org'],
        ]);

        $this->batchInsert('{{password}}',
            ['id','user_id','hash'                                                        ,'created_utc'        ,'expires_on'                       ,'grace_period_ends_on'             ],[
            [ 1  , 1       ,'$2y$10$rKbAp0M8gewGpQKhD.U6qOSGDlMqKFkxK9tQZ15SZoieqYHYNsD/y', MySqlDateTime::now(), MySqlDateTime::relative('+1 year'), MySqlDateTime::relative('+1 year')],
            [ 2  , 2       ,'$2y$10$rKbAp0M8gewGpQKhD.U6qOSGDlMqKFkxK9tQZ15SZoieqYHYNsD/y', MySqlDateTime::now(), MySqlDateTime::relative('+1 year'), MySqlDateTime::relative('+1 year')],
            [ 3  , 3       ,'$2y$10$rKbAp0M8gewGpQKhD.U6qOSGDlMqKFkxK9tQZ15SZoieqYHYNsD/y', MySqlDateTime::now(), MySqlDateTime::relative('+1 year'), MySqlDateTime::relative('+1 year')],
            [ 4  , 4       ,'$2y$10$rKbAp0M8gewGpQKhD.U6qOSGDlMqKFkxK9tQZ15SZoieqYHYNsD/y', MySqlDateTime::now(), MySqlDateTime::relative('+1 year'), MySqlDateTime::relative('+1 year')],
            [ 5  , 5       ,'$2y$10$rKbAp0M8gewGpQKhD.U6qOSGDlMqKFkxK9tQZ15SZoieqYHYNsD/y', MySqlDateTime::now(), MySqlDateTime::relative('+1 year'), MySqlDateTime::relative('+1 year')],
            [ 6  , 6       ,'$2y$10$rKbAp0M8gewGpQKhD.U6qOSGDlMqKFkxK9tQZ15SZoieqYHYNsD/y', MySqlDateTime::now(), MySqlDateTime::relative('+1 year'), MySqlDateTime::relative('+1 year')],
            [ 7  , 7       ,'$2y$10$rKbAp0M8gewGpQKhD.U6qOSGDlMqKFkxK9tQZ15SZoieqYHYNsD/y', MySqlDateTime::now(), MySqlDateTime::relative('+1 year'), MySqlDateTime::relative('+1 year')],
            [ 8  , 8       ,'$2y$10$rKbAp0M8gewGpQKhD.U6qOSGDlMqKFkxK9tQZ15SZoieqYHYNsD/y', MySqlDateTime::now(), MySqlDateTime::relative('+1 year'), MySqlDateTime::relative('+1 year')],
            [ 9  , 9       ,'$2y$10$rKbAp0M8gewGpQKhD.U6qOSGDlMqKFkxK9tQZ15SZoieqYHYNsD/y', MySqlDateTime::now(), MySqlDateTime::relative('+1 year'), MySqlDateTime::relative('+1 year')],
            [ 10 , 10      ,'$2y$10$rKbAp0M8gewGpQKhD.U6qOSGDlMqKFkxK9tQZ15SZoieqYHYNsD/y', MySqlDateTime::now(), MySqlDateTime::relative('+1 year'), MySqlDateTime::relative('+1 year')],
        ]);

        $this->update('{{user}}', ['current_password_id' => 1 ], 'id=1' );
        $this->update('{{user}}', ['current_password_id' => 2 ], 'id=2' );
        $this->update('{{user}}', ['current_password_id' => 3 ], 'id=3' );
        $this->update('{{user}}', ['current_password_id' => 4 ], 'id=4' );
        $this->update('{{user}}', ['current_password_id' => 5 ], 'id=5' );
        $this->update('{{user}}', ['current_password_id' => 6 ], 'id=6' );
        $this->update('{{user}}', ['current_password_id' => 7 ], 'id=7' );
        $this->update('{{user}}', ['current_password_id' => 8 ], 'id=8' );
        $this->update('{{user}}', ['current_password_id' => 9 ], 'id=9' );
        $this->update('{{user}}', ['current_password_id' => 10], 'id=10');

        //TODO: unfortunately, a real uuid that's been verified is required for testing at this time ...will discuss decoupling 2-factor config with authentication.
        $this->batchInsert('{{mfa}}',
            ['id','user_id','type'      ,'external_uuid'                       ,'label'             ,'verified','created_utc'        ],[
            [ 1  , 3       ,'backupcode',NULL                                  ,'Printable Codes'   , 1        , MySqlDateTime::now()],
            [ 2  , 4       ,'totp'      ,'38764a89-b904-404e-a195-1ad2bcfabf75','Smartphone App'    , 1        , MySqlDateTime::now()], // JVRXKYTMPBEVKXLS
            [ 3  , 5       ,'webauthn'  ,'6092a08c-b271-4971-996a-6577333a7b6d','Security Key (U2F)', 1        , MySqlDateTime::now()],
            [ 4  , 6       ,'backupcode',NULL                                  ,'Printable Codes'   , 1        , MySqlDateTime::now()],
            [ 5  , 6       ,'totp'      ,'38764a89-b904-404e-a195-1ad2bcfabf75','Smartphone App'    , 1        , MySqlDateTime::now()], // JVRXKYTMPBEVKXLS
            [ 6  , 6       ,'webauthn'  ,'6092a08c-b271-4971-996a-6577333a7b6d','Security Key (U2F)', 1        , MySqlDateTime::now()],
            [ 7  , 7       ,'backupcode',NULL                                  ,'Printable Codes'   , 1        , MySqlDateTime::now()],
            [ 8  , 7       ,'totp'      ,'38764a89-b904-404e-a195-1ad2bcfabf75','Smartphone App'    , 1        , MySqlDateTime::now()], // JVRXKYTMPBEVKXLS
            [ 9  , 7       ,'webauthn'  ,'6092a08c-b271-4971-996a-6577333a7b6d','Security Key (U2F)', 1        , MySqlDateTime::now()],
            [ 10 , 8       ,'backupcode',NULL                                  ,'Printable Codes'   , 1        , MySqlDateTime::now()],
            [ 11 , 9       ,'webauthn'  ,'11111111-1111-4111-1111-111111111111','Security Key'      , 1        , MySqlDateTime::now()],
            [ 12 , 10      ,'backupcode',NULL                                  ,'Printable Codes'   , 1        , MySqlDateTime::now()],
            [ 13 , 10      ,'totp'      ,'38764a89-b904-404e-a195-1ad2bcfabf75','Smartphone App'    , 1        , MySqlDateTime::now()], // JVRXKYTMPBEVKXLS
            [ 14 , 10      ,'webauthn'  ,'11111111-1111-4111-1111-111111111111','Security Key'      , 1        , MySqlDateTime::now()],
        ]);

        $this->batchInsert('{{mfa_backupcode}}',
            ['id','mfa_id','value'                                                       ,'created_utc'        ],[
            [ 1  , 1      ,'$2y$10$j/V6zcotFES8MkVmgRaiMe2E6DV1qjmO8UhUoJQD0/.p6LhZddGn2', MySqlDateTime::now()], // 94923279
            [ 2  , 1      ,'$2y$10$If6srqyKGBag/x.nPDBeau9bjNR1RZgxqRVKhdRhJk2PkbOn5rKNS', MySqlDateTime::now()], // 82743523
            [ 3  , 1      ,'$2y$10$rA5MdrbEcmbCiqtAgPXnYeBCEKc.AnylPArnamyu.x4DS/A0/0/4i', MySqlDateTime::now()], // 77802769
            [ 4  , 1      ,'$2y$10$JsiRI/W/FLfZzJLPj8umKeXP.rvsOW4aYQO5mOEOwGkBPpKhKWT2K', MySqlDateTime::now()], // 01970541
            [ 5  , 1      ,'$2y$10$NWw0.DPBSm.bjQoSck8xbeqJgENUhE/WazmHmsEtWoxs/UKaIdkUq', MySqlDateTime::now()], // 37771076
            [ 6  , 4      ,'$2y$10$j/V6zcotFES8MkVmgRaiMe2E6DV1qjmO8UhUoJQD0/.p6LhZddGn2', MySqlDateTime::now()], // 94923279
            [ 7  , 4      ,'$2y$10$If6srqyKGBag/x.nPDBeau9bjNR1RZgxqRVKhdRhJk2PkbOn5rKNS', MySqlDateTime::now()], // 82743523
            [ 8  , 4      ,'$2y$10$rA5MdrbEcmbCiqtAgPXnYeBCEKc.AnylPArnamyu.x4DS/A0/0/4i', MySqlDateTime::now()], // 77802769
            [ 9  , 4      ,'$2y$10$JsiRI/W/FLfZzJLPj8umKeXP.rvsOW4aYQO5mOEOwGkBPpKhKWT2K', MySqlDateTime::now()], // 01970541
            [ 10 , 4      ,'$2y$10$NWw0.DPBSm.bjQoSck8xbeqJgENUhE/WazmHmsEtWoxs/UKaIdkUq', MySqlDateTime::now()], // 37771076
            [ 11 , 7      ,'$2y$10$j/V6zcotFES8MkVmgRaiMe2E6DV1qjmO8UhUoJQD0/.p6LhZddGn2', MySqlDateTime::now()], // 94923279
            [ 12 , 7      ,'$2y$10$If6srqyKGBag/x.nPDBeau9bjNR1RZgxqRVKhdRhJk2PkbOn5rKNS', MySqlDateTime::now()], // 82743523
            [ 13 , 7      ,'$2y$10$rA5MdrbEcmbCiqtAgPXnYeBCEKc.AnylPArnamyu.x4DS/A0/0/4i', MySqlDateTime::now()], // 77802769
            [ 14 , 7      ,'$2y$10$JsiRI/W/FLfZzJLPj8umKeXP.rvsOW4aYQO5mOEOwGkBPpKhKWT2K', MySqlDateTime::now()], // 01970541
            [ 15 , 7      ,'$2y$10$NWw0.DPBSm.bjQoSck8xbeqJgENUhE/WazmHmsEtWoxs/UKaIdkUq', MySqlDateTime::now()], // 37771076
            [ 16 , 10     ,'$2y$10$j/V6zcotFES8MkVmgRaiMe2E6DV1qjmO8UhUoJQD0/.p6LhZddGn2', MySqlDateTime::now()], // 94923279
            [ 17 , 10     ,'$2y$10$If6srqyKGBag/x.nPDBeau9bjNR1RZgxqRVKhdRhJk2PkbOn5rKNS', MySqlDateTime::now()], // 82743523
            [ 18 , 10     ,'$2y$10$rA5MdrbEcmbCiqtAgPXnYeBCEKc.AnylPArnamyu.x4DS/A0/0/4i', MySqlDateTime::now()], // 77802769
            [ 19 , 10     ,'$2y$10$JsiRI/W/FLfZzJLPj8umKeXP.rvsOW4aYQO5mOEOwGkBPpKhKWT2K', MySqlDateTime::now()], // 01970541
            [ 20 , 10     ,'$2y$10$NWw0.DPBSm.bjQoSck8xbeqJgENUhE/WazmHmsEtWoxs/UKaIdkUq', MySqlDateTime::now()], // 37771076
            [ 21 , 12     ,'$2y$10$j/V6zcotFES8MkVmgRaiMe2E6DV1qjmO8UhUoJQD0/.p6LhZddGn2', MySqlDateTime::now()], // 94923279
            [ 22 , 12     ,'$2y$10$If6srqyKGBag/x.nPDBeau9bjNR1RZgxqRVKhdRhJk2PkbOn5rKNS', MySqlDateTime::now()], // 82743523
            [ 23 , 12     ,'$2y$10$rA5MdrbEcmbCiqtAgPXnYeBCEKc.AnylPArnamyu.x4DS/A0/0/4i', MySqlDateTime::now()], // 77802769
            [ 24 , 12     ,'$2y$10$JsiRI/W/FLfZzJLPj8umKeXP.rvsOW4aYQO5mOEOwGkBPpKhKWT2K', MySqlDateTime::now()], // 01970541
            [ 25 , 12     ,'$2y$10$NWw0.DPBSm.bjQoSck8xbeqJgENUhE/WazmHmsEtWoxs/UKaIdkUq', MySqlDateTime::now()], // 37771076
        ]);

        $this->batchInsert('{{method}}',
            ['id','uid','user_id','value'               ,'verified','created'            ],[
            [ 1  , 1234, 7       ,'personal1.example.org', 1        , MySqlDateTime::now()],
            [ 2  , 1235, 7       ,'personal2.example.org', 0        , MySqlDateTime::now()],
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{mfa_backupcode}}', [
            'mfa_id' => [1, 4, 7]
        ]);

        $this->delete('{{mfa}}', [
            'user_id' => [3, 4, 5, 6, 7]
        ]);

        $this->delete('{{password}}', [
            'user_id' => [1, 2, 3, 4, 5, 6, 7, 8]
        ]);

        $this->delete('{{method}}', [
            'user_id' => [7]
        ]);

        $this->delete('{{user}}', [
            'id' => [1, 2, 3, 4, 5, 6, 7, 8]
        ]);
    }
}
