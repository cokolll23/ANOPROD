<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */
/** @global \CUserTypeManager $USER_FIELD_MANAGER */

global $USER_FIELD_MANAGER, $USER;

use Bitrix\Bitrix24\Integrator;
use Bitrix\Intranet\Component\UserList;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Context;
use Bitrix\Main\Engine\UrlManager;
use Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Loader;
use Bitrix\Main\UserGroupTable;
use Bitrix\Main\UserTable;
use Bitrix\Main\UserUtils;
use Bitrix\Main\Web\Uri;
use Bitrix\UI\Buttons\JsHandler;

Loc::loadMessages(__FILE__);

function getDepartmentValue(array $params = [])
{
    static $departmentsData = null;

    $result = '';

    $userFields = (isset($params['FIELDS']) ? $params['FIELDS'] : []);
    $path = (isset($params['PATH']) ? $params['PATH'] : '');
    $exportMode = (isset($params['EXPORT_MODE']) && $params['EXPORT_MODE']);

    if (
        empty($userFields)
        || !isset($userFields['UF_DEPARTMENT'])
    )
    {
        return $result;
    }

    $departmentIdList = $userFields['UF_DEPARTMENT'];

    if ($departmentsData === null)
    {
        $structure = \CIntranetUtils::getStructure();
        $departmentsData = $structure['DATA'];
    }

    if (!is_array($departmentIdList))
    {
        $departmentIdList = [ $departmentIdList ];
    }

    $departmentNameList = [];

    foreach($departmentIdList as $departmentId)
    {
        if (
            !empty($departmentsData[$departmentId])
            && isset($departmentsData[$departmentId]['NAME'])
            && $departmentsData[$departmentId]['NAME'] <> ''
        )
        {
            $departmentName = ($exportMode ? $departmentsData[$departmentId]['NAME'] : htmlspecialcharsbx($departmentsData[$departmentId]['NAME']));
            $departmentNameList[] = (
            $path <> ''
            && !$exportMode
                ? '<a class="ui-link ui-link-primary" href="'.htmlspecialcharsbx(str_replace('#ID#', $departmentId, $path)).'">'.$departmentName.'</a>'
                : $departmentName
            );
        }
    }

    $result = implode(', ', $departmentNameList);

    return $result;
}

$adminsUserIdList = [];
$res = UserGroupTable::getList([
    'filter' => [
        '=GROUP_ID' => 1
    ],
    'select' => ['USER_ID']
]);
while ($userGroupFields = $res->fetch()) {
    $adminsUserIdList[] = $userGroupFields['USER_ID'];
}

$integratorsUserIdList = [];
if (Loader::includeModule('bitrix24')) {
    $integratorsUserIdList = Integrator::getIntegratorsId();
}

$gridColumns = $arResult['GRID_COLUMNS'];
$ufList = $USER_FIELD_MANAGER->getUserFields(UserTable::getUfId(), 0, LANGUAGE_ID, false);
$ufCodesList = array_keys($ufList);
$exportMode = (
    isset($arParams['EXPORT_MODE'])
    && $arParams['EXPORT_MODE'] == 'Y'
);

$personalBirthdayFormat = Context::getCurrent()->getCulture()->getLongDateFormat();
$personalBirthdayFormatWithoutYear = Context::getCurrent()->getCulture()->getDayMonthFormat();
$showYearValue = Option::get("intranet", "user_profile_show_year", "Y");
$currentUserId = $USER->GetID();

$extranetGroupId = (
isset($arResult['PROCESS_EXTRANET'])
&& $arResult['PROCESS_EXTRANET'] == 'Y'
&& Loader::includeModule('extranet')
    ? intval(\CExtranet::GetExtranetUserGroupID())
    : 0
);

$userIdList = [];
foreach ($arResult['ROWS'] as $key => $row) {
    if (isset($row['data']['USER_FIELDS']['ID'])) {
        $userIdList[] = intval($row['data']['USER_FIELDS']['ID']);
    }
}

// Узнаем доп.свойства
$userProps = [];
if (!empty($userIdList)) {
    $res = UserTable::getList([
        'filter' => [
            '@ID' => $userIdList,
        ],
        'select' => [
            'ID',
            'UF_MOB_PHONE_PER_ACT',
            'UF_HIDE_PERSONAL_PHONE'
        ]
    ]);
    while ($userFields = $res->fetch()) {
        $userProps[$userFields['ID']] = $userFields;
    }
}

if (
    $extranetGroupId
    && !empty($userIdList)
) {
    $realExtranetUserIdList = [];
    $res = UserTable::getList([
        'filter' => [
            '@ID' => $userIdList,
            '=GROUPS.GROUP_ID' => $extranetGroupId
        ],
        'select' => ['ID']
    ]);
    while ($userFields = $res->fetch()) {
        $realExtranetUserIdList[] = $userFields['ID'];
    }

    foreach ($arResult['ROWS'] as $key => $row) {
        if (
            !empty($row['columnClasses'])
            && !empty($row['columnClasses']['FULL_NAME'])
            && $row['columnClasses']['FULL_NAME'] == 'intranet-user-list-full-name-extranet'
            && !in_array($row['id'], $realExtranetUserIdList)
        ) {
            $arResult['ROWS'][$key]['columnClasses']['FULL_NAME'] .= ' intranet-user-list-full-name-visitor';
            if (is_array($row['actions'])) {
                array_walk($row['actions'], function (&$item) {
                    switch ($item) {
                        case 'deactivate':
                            $item = 'delete';
                            break;
                        default:
                    }
                });
                $row['actions'] = array_filter($row['actions'], function (&$item) {
                    return !in_array($item, ['add_task', 'message', 'message_history']);
                });
                $arResult['ROWS'][$key]['actions'] = $row['actions'];
            }
        }
    }
}

foreach ($arResult['ROWS'] as $key => $row) {
    $userFields = $row['data']['USER_FIELDS'];
    foreach ($gridColumns as $column) {
        switch ($column) {
            case 'ID':
                $arResult['ROWS'][$key]['data'][$column] = intval($userFields[$column]);
                break;
            case 'GENDER':
                $arResult['ROWS'][$key]['data'][$column] = (
                !empty($userFields['PERSONAL_GENDER'])
                    ? Loc::getMessage('INTRANET_USER_LIST_GENDER_' . $userFields['PERSONAL_GENDER'])
                    : ''
                );
                break;
            case 'DATE_REGISTER':
                $arResult['ROWS'][$key]['data'][$column] = $userFields['DATE_REGISTER'];
                break;
            case 'BIRTHDAY':
                $birthdayFormat = $personalBirthdayFormat;
                if (
                    $showYearValue == 'N'
                    || (
                        $userFields['PERSONAL_GENDER'] == 'F'
                        && $showYearValue == 'M'
                    )
                ) {
                    $birthdayFormat = $personalBirthdayFormatWithoutYear;
                }
                $arResult['ROWS'][$key]['data'][$column] = ($userFields['PERSONAL_BIRTHDAY'] ? FormatDate($birthdayFormat,
                    $userFields['PERSONAL_BIRTHDAY']->getTimestamp()) : '');
                break;
            case 'EMAIL':
                $arResult['ROWS'][$key]['data'][$column] = (
                $exportMode
                    ? $userFields[$column]
                    : '<a class="ui-link ui-link-primary" href="mailto:' . htmlspecialcharsbx($userFields['EMAIL']) . '">' . htmlspecialcharsEx(
                        $userFields[$column]
                    ) . '</a>'
                );
                break;
            case 'PHONE':
                if (
                    $userProps[$userFields['ID']]['UF_HIDE_PERSONAL_PHONE'] == 1 &&
                    $currentUserId != $userFields['ID'] &&
                    !in_array($currentUserId, $adminsUserIdList)
                ) {
                    $arResult['ROWS'][$key]['data'][$column] = '';
                } else {
                    $arResult['ROWS'][$key]['data'][$column] = (
                    $exportMode
                        ? $userFields['PERSONAL_PHONE']
                        : '<a class="ui-link ui-link-primary" href="callto:' . htmlspecialcharsbx(
                            $userFields['PERSONAL_PHONE']
                        ) . '">' . htmlspecialcharsEx($userFields['PERSONAL_PHONE']) . '</a>'
                    );
                }
                break;
            case 'PHONE_MOBILE':
                $arResult['ROWS'][$key]['data'][$column] = (
                $exportMode
                    ? $userFields['PERSONAL_MOBILE']
                    : '<a class="ui-link ui-link-primary" href="callto:' . htmlspecialcharsbx(
                        $userFields['PERSONAL_MOBILE']
                    ) . '">' . htmlspecialcharsbx($userFields['PERSONAL_MOBILE']) . '</a>'
                );
                break;
            case 'WWW':
                $arResult['ROWS'][$key]['data'][$column] = (
                $exportMode
                    ? $userFields['PERSONAL_WWW']
                    : '<a class="ui-link ui-link-primary" href=":' . htmlspecialcharsbx($userFields['PERSONAL_WWW']) . '">' . htmlspecialcharsbx($userFields['PERSONAL_WWW']) . '</a>'
                );
                break;
            case 'UF_MOB_PHONE_PER':
                if ($userProps[$userFields['ID']]['UF_MOB_PHONE_PER_ACT'] == 1) {
                    $arResult['ROWS'][$key]['data'][$column] = $userFields['UF_MOB_PHONE_PER'];
                } else {
                    $arResult['ROWS'][$key]['data'][$column] = '';
                }

                break;
            case 'UF_AVAILABILITY':
                $absence = $arResult['SCHEDULE_USER_ABSENCES'][$userFields['ID']];
                if (!empty($absence)) {
                    $str = '';
                    foreach ($absence as $value) {
                        $str .= '<p>' . $value['type']
                            . '<br>'
                            . Loc::getMessage('INTRANET_USER_LIST_ABSENCE', [
                                '#dateStart#' => $value['dateStart'],
                                '#dateEnd#' => $value['dateEnd'],
                            ])
                            . '</p>';
                    }

                    $str .= '<p>' . $userFields['UF_AVAILABILITY'] . '</p>';
                    $arResult['ROWS'][$key]['data'][$column] = $str;
                } else {
                    $arResult['ROWS'][$key]['data'][$column] = $userFields['UF_AVAILABILITY'];
                }

                break;
            case 'PROFESSION':
                $arResult['ROWS'][$key]['data'][$column] = ($exportMode ? $userFields['PERSONAL_PROFESSION'] : htmlspecialcharsEx($userFields['PERSONAL_PROFESSION']));
                break;
            case 'DEPARTMENT':
                $arResult['ROWS'][$key]['data'][$column] = getDepartmentValue([
                    'FIELDS' => $userFields,
                    'PATH' => ($arResult["EXTRANET_SITE"] != "Y" ? $arParams['PATH_TO_DEPARTMENT'] : ''),
                    'EXPORT_MODE' => $exportMode
                ]);
                break;
            case 'FULL_NAME':
                $arResult['ROWS'][$key]['data'][$column] = UserList::getNameFormattedValue([
                    'FIELDS' => $userFields,
                    'PATH' => $arParams['PATH_TO_USER'],
                    'EXPORT_MODE' => $exportMode,
                    'ADDITIONAL_DATA' => [
                        'IS_ADMIN' => in_array($userFields['ID'], $adminsUserIdList),
                        'IS_INTEGRATOR' => in_array($userFields['ID'], $integratorsUserIdList)
                    ]
                ]);
                break;
            case 'PHOTO':
                $arResult['ROWS'][$key]['data'][$column] = ($exportMode ? '' : UserList::getPhotoValue([
                    'FIELDS' => $userFields,
                    'PATH' => $arParams['PATH_TO_USER']
                ]));
                break;
            case 'PERSONAL_COUNTRY':
            case 'WORK_COUNTRY':
                $arResult['ROWS'][$key]['data'][$column] = UserUtils::getCountryValue([
                    'VALUE' => $userFields[$column]
                ]);
                break;
            case 'POSITION':
                $arResult['ROWS'][$key]['data'][$column] = ($exportMode ? $userFields['WORK_POSITION'] : htmlspecialcharsEx($userFields['WORK_POSITION']));
                break;
            case 'COMPANY':
                $arResult['ROWS'][$key]['data'][$column] = ($exportMode ? $userFields['WORK_COMPANY'] : htmlspecialcharsEx($userFields['WORK_COMPANY']));
                break;
            case 'TAGS':
                $arResult['ROWS'][$key]['data'][$column] = implode(', ', array_map(
                    function ($val) use ($arParams) {
                        $uri = new Uri($arParams['LIST_URL']);

                        $uri->addParams([
                            'apply_filter' => 'Y',
                            'TAGS' => $val
                        ]);

                        return
                            $arParams['EXPORT_MODE'] == 'Y'
                                ? $val
                                : '<a class="ui-link ui-link-dark" href="' . $uri->getUri() . '" rel="nofollow" bx-tag-value="' . htmlspecialcharsBx($val) . '">' . htmlspecialcharsEx($val) . '</a>';
                    },
                    $userFields['TAGS']->getNameList()
                ));
                break;
            default:
                if (in_array($column, $ufCodesList)) {
                    ob_start();

                    $arUserField = $ufList[$column];
                    $arUserField['VALUE'] = $userFields[$column];

                    $APPLICATION->includeComponent(
                        "bitrix:system.field.view",
                        $ufList[$column]['USER_TYPE']['USER_TYPE_ID'],
                        [
                            "arUserField" => $arUserField,
                            "TEMPLATE" => '',
                            "LAZYLOAD" => 'N',
                        ],
                        null,
                        ['HIDE_ICONS' => 'Y']
                    );

                    $value = ob_get_clean();
                    if ($exportMode) {
                        $value = \CTextParser::clearAllTags($value);
                    }
                    $arResult['ROWS'][$key]['data'][$column] = $value;
                } else {
                    $arResult['ROWS'][$key]['data'][$column] = ($exportMode ? $userFields[$column] : htmlspecialcharsEx($userFields[$column]));
                }
        }
    }

    $actions = $row['actions'];
    $arResult['ROWS'][$key]['actions'] = [];

    if (in_array('view_profile', $actions)) {
        $arResult['ROWS'][$key]['actions'][] = [
            'TITLE' => Loc::getMessage('INTRANET_USER_LIST_ACTION_VIEW_TITLE'),
            'TEXT' => Loc::getMessage('INTRANET_USER_LIST_ACTION_VIEW'),
            'HREF' => htmlspecialcharsbx(str_replace(['#ID#', '#USER_ID#'], $userFields['ID'], $arParams['PATH_TO_USER'])),
            'DEFAULT' => true,
        ];
    }

    if (in_array('add_task', $actions)) {
        $arResult['ROWS'][$key]['actions'][] = [
            'TITLE' => Loc::getMessage('INTRANET_USER_LIST_ACTION_TASK_TITLE'),
            'TEXT' => Loc::getMessage('INTRANET_USER_LIST_ACTION_TASK'),
            'ONCLICK' => 'jsBXIUL.addTask(' . $userFields['ID'] . ')'
        ];
    }

    if (in_array('message', $actions)) {
        $arResult['ROWS'][$key]['actions'][] = [
            'TITLE' => Loc::getMessage('INTRANET_USER_LIST_ACTION_MESSAGE_TITLE'),
            'TEXT' => Loc::getMessage('INTRANET_USER_LIST_ACTION_MESSAGE'),
            'ONCLICK' => 'jsBXIUL.sendMessage(' . $userFields['ID'] . ')'
        ];
    }

    if (in_array('message_history', $actions)) {
        $arResult['ROWS'][$key]['actions'][] = [
            'TITLE' => Loc::getMessage('INTRANET_USER_LIST_ACTION_MESSAGE_HISTORY_TITLE'),
            'TEXT' => Loc::getMessage('INTRANET_USER_LIST_ACTION_MESSAGE_HISTORY'),
            'ONCLICK' => 'jsBXIUL.viewMessageHistory(' . $userFields['ID'] . ')'
        ];
    }

    if (in_array('reinvite', $actions)) {
        $arResult['ROWS'][$key]['actions'][] = [
            'TITLE' => Loc::getMessage('INTRANET_USER_LIST_ACTION_REINVITE_TITLE'),
            'TEXT' => Loc::getMessage('INTRANET_USER_LIST_ACTION_REINVITE'),
            'ONCLICK' => 'jsBXIUL.reinvite(' . $userFields["ID"] . ', ' . ($userFields['USER_TYPE'] == 'extranet' ? 'true' : 'false') . ', this.currentTarget)'
        ];
    }

    if (in_array('restore', $actions)) {
        $arResult['ROWS'][$key]['actions'][] = [
            'TITLE' => Loc::getMessage('INTRANET_USER_LIST_ACTION_RESTORE_TITLE'),
            'TEXT' => Loc::getMessage('INTRANET_USER_LIST_ACTION_RESTORE'),
            'ONCLICK' => 'jsBXIUL.activityAction("restore", ' . $userFields["ID"] . ')'
        ];
    }

    if (in_array('delete', $actions)) {
        $arResult['ROWS'][$key]['actions'][] = [
            'TITLE' => Loc::getMessage('INTRANET_USER_LIST_ACTION_DELETE_TITLE'),
            'TEXT' => Loc::getMessage('INTRANET_USER_LIST_ACTION_DELETE'),
            'ONCLICK' => 'jsBXIUL.activityAction("delete", ' . $userFields["ID"] . ')'
        ];
    }

    if (in_array('deactivate', $actions)) {
        $deactivateTitle = Loc::getMessage('INTRANET_USER_LIST_ACTION_DEACTIVATE_TITLE');
        $deactivateOnclick = 'jsBXIUL.activityAction("deactivate", ' . $userFields["ID"] . ')';

        if (
            Loader::includeModule("bitrix24")
            && !Bitrix\Bitrix24\Feature::isFeatureEnabled("user_dismissal")
            && !Integrator::isIntegrator($userFields["ID"])
        ) {
            $deactivateTitle .= "<span class='intranet-user-list-lock-icon'></span>";
            $deactivateOnclick = "top.BX.UI.InfoHelper.show('limit_dismiss');";
        }

        $arResult['ROWS'][$key]['actions'][] = [
            'TITLE' => Loc::getMessage('INTRANET_USER_LIST_ACTION_DEACTIVATE_TITLE'),
            'TEXT' => $deactivateTitle,
            'ONCLICK' => $deactivateOnclick
        ];
    }

    unset($arResult['ROWS'][$key]['data']['USER_FIELDS']);
}

if (!$exportMode) {
    unset($arResult['GRID_COLUMNS']);
}

$arResult['TOOLBAR_MENU'] = [
    [
        'TYPE' => 'EXPORT_EXCEL',
        'TITLE' => Loc::getMessage('INTRANET_USER_LIST_MENU_EXPORT_EXCEL_TITLE'),
        'LINK' => UrlManager::getInstance()->createByBitrixComponent($this->getComponent(), 'export',
            ['type' => 'excel'])
    ],
    [
        'TYPE' => 'SYNC_OUTLOOK',
        'TITLE' => Loc::getMessage('INTRANET_USER_LIST_MENU_SYNC_OUTLOOK_TITLE'),
        'LINK' => 'javascript:' . \CIntranetUtils::getStsSyncURL(
                [
                    'LINK_URL' => $APPLICATION->GetCurPage()
                ], 'contacts', ($arResult["EXTRANET_SITE"] != "Y")
            )
    ],
    [
        'TYPE' => 'SYNC_CARDDAV',
        'TITLE' => Loc::getMessage('INTRANET_USER_LIST_MENU_SYNC_CARDDAV_TITLE'),
        'LINK' => 'javascript:' . $APPLICATION->getPopupLink(
                [
                    "URL" => "/bitrix/groupdav.php?lang=" . LANGUAGE_ID . "&help=Y&dialog=Y",
                ]
            )
    ],
];

$arResult['TOOLBAR_BUTTONS'] = [];

$excludedHeaders = ['PERSONAL_ZIP', 'PERSONAL_STREET'];
foreach ($arResult['HEADERS'] as $key => $header) {
    if (in_array($header['id'], $excludedHeaders)) {
        unset($arResult['HEADERS'][$key]);
    }
}
