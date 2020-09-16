<?php
/**
 * Created by PhpStorm.
 * User: Phi
 * Date: 3/6/2020
 * Time: 10:41 AM
 */

namespace App\Commons;


final class ConstantService
{
    const CREDO_STATUS = ['無効', '有効'];
    const CREDO_STATUS_OFF = 0;
    const CREDO_STATUS_ON = 1;
    const CREDO_TYPE = [null, 'クレド', 'VISION'];
    const CREDO_TYPE_ONE = 1;
    const CREDO_TYPE_TWO = 2;

    const BASE_STATUS = ['無効', '有効'];
    const BASE_STATUS_OFF = 0;
    const BASE_STATUS_ON = 1;

    const BASE_TYPE = ['選択してください','ASP', 'UISM'];
    const BASE_TYPE_ASP = 1;
    const BASE_TYPE_UISM = 2;

    const PREFECTURE = ['全て', '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'];

    const USER_TYPE_ADMIN = 1;
    const USER_TYPE_GUEST = 2;
    const USER_TYPE_MEMBER = 3;
    const USER_TYPE_MEMBER_APP = 4;

    const ORGS = [
            '選択してください',
            'BAT',
            'DAG',
            'ASP統括',
            'UISM統括',
            'ASP事務局責任者',
            'UISM事務局責任者',
            'ASPスタッフ',
            'UISMスタッフ'
        ];
    const ORG_1 = 1;
    const ORG_2 = 2;
    const ORG_3 = 3;
    const ORG_4 = 4;
    const ORG_5 = 5;
    const ORG_6 = 6;
    const ORG_7 = 7;
    const ORG_8 = 8;
    const LIST_ORG_GUEST_3_SHOW = [self::ORG_3,self::ORG_5,self::ORG_7];
    const LIST_ORG_GUEST_4_SHOW = [self::ORG_4,self::ORG_6,self::ORG_8];
    const LIST_ORG_MEMBER_5_SHOW = [self::ORG_5,self::ORG_7];
    const LIST_ORG_MEMBER_6_SHOW = [self::ORG_6,self::ORG_8];
    const LIST_MEMBER_TYPE_SHOW = [self::USER_TYPE_MEMBER, self::USER_TYPE_MEMBER_APP];

    const ASP_ORGS = [
            '選択してください',
            '',
            '',
            'ASP統括',
            '',
            'ASP事務局責任者',
            '',
            'ASPスタッフ',
            ''
        ];
    const UISM_ORGS = [
            '選択してください',
            '',
            '',
            '',
            'UISM統括',
            '',
            'UISM事務局責任者',
            '',
            'UISMスタッフ'
        ];
    const MEMBER_ORGS = [
            '選択してください',
            '',
            '',
            '',
            '',
            'ASP事務局責任者',
            '',
            'ASPスタッフ',
            ''
        ];
    const MEMBER_ORGS_5 = [
            '選択してください',
            '',
            '',
            '',
            '',
            'ASP事務局責任者',
            '',
            'ASPスタッフ',
            ''
        ];
    const MEMBER_ORGS_6 = [
            '選択してください',
            '',
            '',
            '',
            '',
            '',
            'UISM事務局責任者',
            '',
            'UISMスタッフ'
        ];
    const ORG_TEXT = [
        ['',''],
        ['BAT',''],
        ['DAG', ''],
        ['ASP','統括'],
        ['UISM','統括'],
        ['ASP','事務局責任者'],
        ['UISM','事務局責任者'],
        ['ASP','スタッフ'],
        ['UISM','スタッフ']
    ];

    const EXAM_PASSED = ['null' => '未受験', '0' => '不合格', '1' => '合格'];

    const INFO_TYPE = ['全体', 'ASP', 'UISM'];
    const INFO_STATUS = ['all' => '全て', '0' => '非公開', '1' => '公開中'];

    const EXAM_STATUS = ['0' => '非公開', '1' => '公開'];
}
