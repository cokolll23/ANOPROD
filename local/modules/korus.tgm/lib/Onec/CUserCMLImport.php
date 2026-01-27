<?php

namespace Korus\Tgm\Onec;

use Bitrix\Main\UserTable;

class CUserCMLImport extends \CUserCMLImport
{
    function LoadUser($arXMLElement, &$counter)
    {
        $start_time = microtime(true);
        static $USER_COUNTER = null;

        static $property_state_final = 0;

        if (!is_array($property_state_final)) {
            $property_state_final = array();
            $property_state = \CIBlockPropertyEnum::GetList(
                array(),
                array(
                    "IBLOCK_ID" => $this->STATE_HISTORY_IBLOCK_ID,
                    "CODE" => "STATE"
                )
            );
            while ($property_state_enum = $property_state->GetNext()) {
                $property_state_final[mb_strtolower($property_state_enum["VALUE"])] = $property_state_enum["ID"];
            }
        }

        $obUser = &$this->__user;

        // this counter'll be used for generating users login name
        if (null == $USER_COUNTER) {
            $dbRes = $GLOBALS['DB']->Query('SELECT MAX(ID) M FROM b_user');
            $ar = $dbRes->Fetch();
            $USER_COUNTER = $ar['M'];
        }

        $CURRENT_USER = false;

        // check user existence
        if (is_array($arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_CONTACTS')])) {
            foreach ($arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_CONTACTS')] as $arContactsField) {
                if (!isset($arContactsField[GetMessage('IBLOCK_XML2_USER_TAG_TYPE')], $arContactsField[GetMessage('IBLOCK_XML2_USER_TAG_VALUE')])) {
                    continue;
                }

                $type = $arContactsField[GetMessage('IBLOCK_XML2_USER_TAG_TYPE')];
                $value = $arContactsField[GetMessage('IBLOCK_XML2_USER_TAG_VALUE')];
                if ($type == GetMessage('IBLOCK_XML2_USER_VALUE_EMAIL')){
                    $emailUser = $value;
                    break;
                }

            }
        }

        if ($arCurrentUser = $this->GetUserByEmail($emailUser))
            $CURRENT_USER = $arCurrentUser['ID'];

        // common user data
        $arFields = array(
            'ACTIVE' => $arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_STATUS')] == GetMessage('IBLOCK_XML2_USER_VALUE_DELETED') ? 'N' : 'Y',
            'UF_1C' => 'Y',
            'XML_ID' => $arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_ID')],
            'LID' => $this->arParams['SITE_ID'],
            'LAST_NAME' => $arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_LAST_NAME')],
            'NAME' => $arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_FIRST_NAME')],
            'SECOND_NAME' => $arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_SECOND_NAME')],
            'PERSONAL_BIRTHDAY' => !empty($arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_BIRTH_DATE')]) ? ConvertTimeStamp(MakeTimeStamp($arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_BIRTH_DATE')], 'YYYY-MM-DD')) : '',
            'PERSONAL_GENDER' => $arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_GENDER')] == GetMessage('IBLOCK_XML2_USER_VALUE_FEMALE') ? 'F' : 'M',
            'UF_INN' => $arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_INN')],
            'WORK_POSITION' => $arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_POST')],
            'PERSONAL_PROFESSION' => $arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_POST')],
            'UF_VACATION_DAYS' => $arXMLElement[GetMessage('IBLOCK_XML2_USER_VACATION_DAYS')],
        );
        if (array_key_exists(GetMessage('IBLOCK_XML2_USER_DEPARTMENT_MANAGER'), $arXMLElement)){
            if ($CURRENT_USER) {
                $rsDepartment = \CIBlockSection::GetList(
                    [],
                    [
                        'ACTIVE' => 'Y',
                        'UF_HEAD' => $CURRENT_USER,
                        'IBLOCK_ID' => \Bitrix\Intranet\Integration\Wizards\Portal\Ids::getIblockId('departments')
                    ],
                    false,
                    ['ID', 'UF_HEAD']);
                while ($arDepartment = $rsDepartment->Fetch()) {
                    $departmentRepository = \Bitrix\Intranet\Service\ServiceContainer::getInstance()
                        ->departmentRepository();
                    $departmentRepository->unsetHead($arDepartment['ID']);
                }
            }
        }
        if (isset($arXMLElement[GetMessage('IBLOCK_XML2_USER_DEPARTMENT_MANAGER')])
            && $arXMLElement[GetMessage('IBLOCK_XML2_USER_DEPARTMENT_MANAGER')]) {
            if ($departmentId = $this->GetSectionByXML_ID($this->DEPARTMENTS_IBLOCK_ID, $arXMLElement[GetMessage('IBLOCK_XML2_USER_DEPARTMENT_MANAGER')])) {
                $arFields['UF_MANAGER'] = $departmentId;
            }
        } elseif (array_key_exists(GetMessage('IBLOCK_XML2_USER_DEPARTMENT_MANAGER'), $arXMLElement)) {
            $arFields['UF_MANAGER'] = null;
        }

        if (array_key_exists(GetMessage('IBLOCK_XML2_USER_TAG_PHOTO'), $arXMLElement)) {
            if ($arCurrentUser['PERSONAL_PHOTO'] > 0) {
                \CFile::Delete($arCurrentUser['PERSONAL_PHOTO']);
            }

            if ($arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_PHOTO')] <> '') {
                $arFields['PERSONAL_PHOTO'] = $this->MakeFileArray($arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_PHOTO')]);
            }
        }

        // address fields
        if (is_array($arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_ADDRESS')])) {
            foreach ($arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_ADDRESS')] as $key => $arAddressField) {
                if (GetMessage('IBLOCK_XML2_USER_TAG_FULLADDRESS') == $key) {
                    $arFields['PERSONAL_STREET'] = $arAddressField;
                } elseif (isset($arAddressField[GetMessage('IBLOCK_XML2_USER_TAG_TYPE')], $arAddressField[GetMessage('IBLOCK_XML2_USER_TAG_VALUE')])) {
                    $type = $arAddressField[GetMessage('IBLOCK_XML2_USER_TAG_TYPE')];
                    $value = $arAddressField[GetMessage('IBLOCK_XML2_USER_TAG_VALUE')];
                    switch ($type) {
                        case GetMessage('IBLOCK_XML2_USER_VALUE_ZIP'):
                            $arFields['PERSONAL_ZIP'] = $value;
                            break;
                        case GetMessage('IBLOCK_XML2_USER_VALUE_STATE'):
                            $arFields['PERSONAL_STATE'] = $value;
                            break;
                        case GetMessage('IBLOCK_XML2_USER_VALUE_DISTRICT'):
                            $arFields['UF_DISTRICT'] = $value;
                            break;
                        case GetMessage('IBLOCK_XML2_USER_VALUE_CITY1'):
                        case GetMessage('IBLOCK_XML2_USER_VALUE_CITY2'):
                            if ($arFields['PERSONAL_CITY'])
                                $arFields['PERSONAL_CITY'] .= ', ';
                            $arFields['PERSONAL_CITY'] .= $value;
                            break;
                        default:
                            break;
                    }
                }
            }
        }

        // contact fields
        if (is_array($arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_CONTACTS')])) {
            foreach ($arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_CONTACTS')] as $arContactsField) {
                if (!isset($arContactsField[GetMessage('IBLOCK_XML2_USER_TAG_TYPE')], $arContactsField[GetMessage('IBLOCK_XML2_USER_TAG_VALUE')])) {
                    continue;
                }

                $type = $arContactsField[GetMessage('IBLOCK_XML2_USER_TAG_TYPE')];
                $value = $arContactsField[GetMessage('IBLOCK_XML2_USER_TAG_VALUE')];
                switch ($type) {
                    case GetMessage('IBLOCK_XML2_USER_VALUE_PHONE_INNER'):
                        $arFields['UF_PHONE_INNER'] = $value;
                        break;
                    case GetMessage('IBLOCK_XML2_USER_VALUE_PHONE_WORK'):
                        $arFields['WORK_PHONE'] = $value;
                        break;
                    case GetMessage('IBLOCK_XML2_USER_VALUE_PHONE_MOBILE'):
                        $arFields['PERSONAL_MOBILE'] = $value;
                        break;
                    case GetMessage('IBLOCK_XML2_USER_VALUE_PHONE_PERSONAL'):
                        $arFields['PERSONAL_PHONE'] = $value;
                        break;
                    case GetMessage('IBLOCK_XML2_USER_VALUE_PAGER'):
                        $arFields['PERSONAL_PAGER'] = $value;
                        break;
                    case GetMessage('IBLOCK_XML2_USER_VALUE_FAX'):
                        $arFields['PERSONAL_FAX'] = $value;
                        break;
                    case GetMessage('IBLOCK_XML2_USER_VALUE_EMAIL'):
                        $arFields['EMAIL'] = $value; // b_user.EMAIL
                        break;
                    case GetMessage('IBLOCK_XML2_USER_VALUE_ICQ'):
                        $arFields['PERSONAL_ICQ'] = $value;
                        break;
                    case GetMessage('IBLOCK_XML2_USER_VALUE_WWW'):
                        $arFields['PERSONAL_WWW'] = $value;
                        break;
                    default:
                        break;
                }
            }
        }

        //departments data
        $arFields['UF_DEPARTMENT'] = array();
        if (is_array($arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_DEPARTMENTS')])) {
            foreach ($arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_DEPARTMENTS')] as $DEPT_XML_ID) {
                if ($DEPT_ID = $this->GetSectionByXML_ID($this->DEPARTMENTS_IBLOCK_ID, $DEPT_XML_ID)) {
                    $arFields['UF_DEPARTMENT'][] = $DEPT_ID;
                }
            }
        }

        // state history
        if (is_array($arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_STATE_HISTORY')])) {
            $last_state_date = 0;
            $first_state_date = 1767132000; //strtotime('2025-12-31')
            $arStateHistory = array();

            foreach ($arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_STATE_HISTORY')] as $arState) {
                $state = $arState[GetMessage('IBLOCK_XML2_USER_TAG_VALUE')];

                $date = intval(MakeTimeStamp($arState[GetMessage('IBLOCK_XML2_USER_TAG_DATE')], 'YYYY-MM-DD'));
                while (is_array($arStateHistory[$date]))
                    $date++;

                if (!$last_state_date || doubleval($last_state_date) < doubleval($date))
                    $last_state_date = $date;
                if (doubleval($first_state_date) > doubleval($date))
                    $first_state_date = $date;

                $DEPARTMENT_ID = $this->GetSectionByXML_ID($this->DEPARTMENTS_IBLOCK_ID, $arState[GetMessage('IBLOCK_XML2_USER_TAG_DEPARTMENT')]);

                $arStateHistory[$date] = array(
                    'STATE' => $state,
                    'POST' => $arState[GetMessage('IBLOCK_XML2_USER_TAG_POST')],
                    'DEPARTMENT' => $DEPARTMENT_ID,
                );
            }

            ksort($arStateHistory);

            // if person's last state is "Fired" - deactivate him.
            if (GetMessage('IBLOCK_XML2_USER_VALUE_FIRED') == $arStateHistory[$last_state_date]['STATE'])
                $arFields['ACTIVE'] = 'N';
            // save data serialized
            //$arFields['UF_1C_STATE_HISTORY'] = serialize($arStateHistory);
        } else {
            $arStateHistory = array();
            $last_state_date = null;
            $first_state_date = null;
        }

        // properties data
        if (is_array($arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_PROPERTY_VALUES')])) {
            foreach ($arXMLElement[GetMessage('IBLOCK_XML2_USER_TAG_PROPERTY_VALUES')] as $arPropertyData) {
                $PROP_XML_ID = $arPropertyData[GetMessage('IBLOCK_XML2_USER_TAG_ID')];
                $PROP_VALUE = $arPropertyData[GetMessage('IBLOCK_XML2_USER_TAG_VALUE')];
                $arFields[$this->CalcPropertyFieldName($PROP_XML_ID)] = $PROP_VALUE;
            }
        }

        if (!$arFields['EMAIL'] && $this->arParams['EMAIL_PROPERTY_XML_ID']) {
            $arFields['EMAIL'] = $arFields[$this->CalcPropertyFieldName($this->arParams['EMAIL_PROPERTY_XML_ID'])];
        }

        $bEmailExists = true;
        if (!$arFields['EMAIL'] && $this->arParams['DEFAULT_EMAIL']) {
            $bEmailExists = false;
            $arFields['EMAIL'] = $this->arParams['DEFAULT_EMAIL'];
        }

        if (!$arFields['EMAIL']) {
            $bEmailExists = false;
            $arFields['EMAIL'] = COption::GetOptionString('main', 'email_from', "admin@" . $_SERVER['SERVER_NAME']);
        }

        // EMAIL, LOGIN and PASSWORD fields
        if (!$CURRENT_USER) {
            // for a new user
            $USER_COUNTER++;

            $arFields['LOGIN'] = '';
            if ($this->arParams['LDAP_ID_PROPERTY_XML_ID'] && $this->arParams['LDAP_SERVER']) {
                if ($arFields['LOGIN'] = $arFields[$this->CalcPropertyFieldName($this->arParams['LDAP_ID_PROPERTY_XML_ID'])]) {
                    $arFields['EXTERNAL_AUTH_ID'] = 'LDAP#' . $this->arParams['LDAP_SERVER'];
                }
            }

            if (!$arFields['LOGIN'] && $this->arParams['LOGIN_PROPERTY_XML_ID'])
                $arFields['LOGIN'] = $arFields[$this->CalcPropertyFieldName($this->arParams['LOGIN_PROPERTY_XML_ID'])];
            if (!$arFields['LOGIN'] && $this->arParams['LOGIN_TEMPLATE'])
                $arFields['LOGIN'] = str_replace('#', $USER_COUNTER, $this->arParams['LOGIN_TEMPLATE']);
            if (!$arFields['LOGIN']) $arFields['LOGIN'] = 'user_' . $USER_COUNTER;

            if (!$arFields['EXTERNAL_AUTH_ID']) {
                if ($this->arParams['PASSWORD_PROPERTY_XML_ID'])
                    $arFields['PASSWORD'] = $arFields['CONFIRM_PASSWORD'] =
                        $arFields[$this->CalcPropertyFieldName($this->arParams['PASSWORD_PROPERTY_XML_ID'])];

                if (!$arFields['PASSWORD'])
                    $arFields['PASSWORD'] = $arFields['CONFIRM_PASSWORD'] =
                        RandString($this->arParams['PASSWORD_LENGTH'] ? $this->arParams['PASSWORD_LENGTH'] : 7);
            }

            if (!$bEmailExists && $arFields['EMAIL'] && $this->arParams['UNIQUE_EMAIL'] != 'N')
                $arFields['EMAIL'] = preg_replace('/@/', '_' . $USER_COUNTER . '@', $arFields['EMAIL'], 1);

            // set user groups list to default from main module setting
            if (is_array($this->arUserGroups))
                $arFields['GROUP_ID'] = $this->arUserGroups;
        } else {
            // for an existing user
            if ($this->arParams['UPDATE_LOGIN']) {
                $arFields['LOGIN'] = $arFields[$this->CalcPropertyFieldName($this->arParams['LOGIN_PROPERTY_XML_ID'])];
                if ($arFields['LOGIN'] == '') unset($arFields['LOGIN']);
            }

            if ($this->arParams['UPDATE_PASSWORD']) {
                $arFields['PASSWORD'] = $arFields['CONFIRM_PASSWORD'] = $arFields[$this->CalcPropertyFieldName($this->arParams['PASSWORD_PROPERTY_XML_ID'])];
                if ($arFields['PASSWORD'] == '') {
                    unset($arFields['PASSWORD']);
                    unset($arFields['CONFIRM_PASSWORD']);
                }
            }

            if (!$this->arParams['UPDATE_EMAIL'] || $arFields['EMAIL'] == '') unset($arFields['EMAIL']);
        }

        $bNew = $CURRENT_USER <= 0;

        if (!$bNew) {
            foreach ($arFields as $key => $value) {
                if ($key !== 'ACTIVE' && !in_array($key, $this->arParams['UPDATE_PROPERTIES']))
                    unset($arFields[$key]);
            }

            // update existing user
            if ($res = $obUser->Update($CURRENT_USER, $arFields))
                $counter[$arFields['ACTIVE'] == 'Y' ? 'UPD' : 'DEA']++;
        } else {
            $group_id = $arFields['GROUP_ID'];
            unset($arFields['GROUP_ID']);
            // create new user
            if ($CURRENT_USER = $obUser->Add($arFields)) {
                $counter['ADD']++;

                \CUser::SetUserGroup($CURRENT_USER, $group_id);

                if (isset($this->next_step['_TEMPORARY']['DEPARTMENT_HEADS'][$arFields['XML_ID']])) {
                    $departmentRepository = \Bitrix\Intranet\Service\ServiceContainer::getInstance()
                        ->departmentRepository();
                    foreach ($this->next_step['_TEMPORARY']['DEPARTMENT_HEADS'][$arFields['XML_ID']] as $dpt) {
                        $departmentRepository->setHead((int)$dpt, (int)$CURRENT_USER);
                    }
                }

                if ($this->arParams['EMAIL_NOTIFY'] == 'Y' || ($this->arParams['EMAIL_NOTIFY'] == 'E') && $bEmailExists) {
                    $arFields['ID'] = $CURRENT_USER;

                    //$this->__event->Send("USER_INFO", SITE_ID, $arFields);
                    //echo CEvent::Send("USER_INFO", 's1', $arFields);

                    $this->__user->SendUserInfo(
                        $CURRENT_USER,
                        $this->arParams['SITE_ID'],
                        '',
                        $this->arParams['EMAIL_NOTIFY_IMMEDIATELY'] == 'Y'
                    );
                }
            }

            if (!$res = ($CURRENT_USER > 0)) {
                $USER_COUNTER--;
            }
        }

        if (!$res) {
            $counter['ERR']++;
            $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/intranet/cml2-import-user.log', 'a');
            fwrite($fp, "==============================================================\r\n");
            fwrite($fp, $obUser->LAST_ERROR . "\r\n");
            fwrite($fp, print_r($arFields, true));
            fwrite($fp, "==============================================================\r\n");
            fclose($fp);
        } elseif (is_array($arStateHistory) && count($arStateHistory) > 0) {
            if (null == $this->__ib)
                $this->__ib = new \CIBlockElement();

            if (!$bNew) {
                $dbRes = $this->__ib->GetList(
                    array(),
                    array(
                        'PROPERTY_USER' => $CURRENT_USER,
                        'IBLOCK_ID' => $this->STATE_HISTORY_IBLOCK_ID
                    ),
                    false,
                    false,
                    array('ID', 'IBLOCK_ID')
                );
                while ($arRes = $dbRes->Fetch()) {
                    $this->__ib->Delete($arRes['ID']);
                }
            }

            foreach ($arStateHistory as $date => $arState) {
                $arStateFields = array(
                    'IBLOCK_SECTION' => false,
                    'IBLOCK_ID' => $this->STATE_HISTORY_IBLOCK_ID,
                    'DATE_ACTIVE_FROM' => ConvertTimeStamp($date, 'SHORT'),
                    'ACTIVE' => 'Y',
                    'NAME' => $arState['STATE'] . ' - ' . $arFields['LAST_NAME'] . ' ' . $arFields['NAME'],
                    'PREVIEW_TEXT' => $arState['STATE'],
                    'PROPERTY_VALUES' => array(
                        'POST' => $arState['POST'],
                        'USER' => $CURRENT_USER,
                        'DEPARTMENT' => $arState['DEPARTMENT'],
                        'STATE' => array("VALUE" => $property_state_final[mb_strtolower($arState['STATE'])])
                    ),
                );

                if (!$this->__ib->Add($arStateFields, false, false)) {
                    $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/intranet/cml2-import-state.log', 'a');
                    fwrite($fp, "==============================================================\r\n");
                    fwrite($fp, $this->__ib->LAST_ERROR . "\r\n");
                    fwrite($fp, print_r($arStateFields, true));
                    fwrite($fp, "==============================================================\r\n");
                    fclose($fp);
                }
            }
        }

        return $CURRENT_USER;
    }

    public function GetHeads(): array
    {
        $heads = [];

        try {
            $dbUsers = UserTable::getList([
                'select' => ['ID', 'UF_MANAGER'],
                'filter' => [
                    'ACTIVE' => 'Y',
                    '!UF_MANAGER' => NULL,
                ]
            ]);

            while ($user = $dbUsers->fetch()) {
                $heads[$user['UF_MANAGER']] = $user['ID'];
            }

        } catch (\Exception) {
            return [];
        }

        return $heads;
    }

    public function UpdateDepartmentsHead()
    {
        $heads = $this->GetHeads();

        if (!empty($heads)) {
            foreach ($heads as $departmentId => $headId) {
                $departmentRepository = \Bitrix\Intranet\Service\ServiceContainer::getInstance()
                    ->departmentRepository();
                $departmentRepository->setHead($departmentId, $headId);
            }
        }
    }

    function GetUserByEmail($email){
        if (empty($email))
            return false;
        $dbRes = \CUser::GetList("ID", "ASC", ["EMAIL" => $email]);
        return $dbRes->Fetch();
    }
}
