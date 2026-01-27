<?php

namespace Sprint\Migration;


class Version20250121122558 extends Version
{
    protected $description = "Пользовательское поле UF_MANAGER";

    protected $moduleVersion = "4.6.2";

    public function up()
    {
        $iBlockId = \Bitrix\Intranet\Integration\Wizards\Portal\Ids::getIblockId('departments');
        if ($iBlockId) {
            $helper = $this->getHelperManager();
            $helper->UserTypeEntity()->saveUserTypeEntity([
                'ENTITY_ID' => 'USER',
                'FIELD_NAME' => 'UF_MANAGER',
                'USER_TYPE_ID' => 'iblock_section',
                'XML_ID' => 'UF_MANAGER',
                'SORT' => 500,
                'MULTIPLE' => 'N',
                'MANDATORY' => 'N',
                'SHOW_FILTER' => 'I',
                'SHOW_IN_LIST' => 'Y',
                'EDIT_IN_LIST' => 'Y',
                'IS_SEARCHABLE' => 'Y',
                'SETTINGS' => [
                    'DISPLAY' => 'LIST',
                    'LIST_HEIGHT' => '8',
                    'IBLOCK_ID' => $iBlockId,
                    'ACTIVE_FILTER' => 'Y'
                ],
                'EDIT_FORM_LABEL' =>
                    [
                        'en' => 'Manager',
                        'ru' => 'Руководитель',
                    ],
                'LIST_COLUMN_LABEL' =>
                    [
                        'en' => 'Manager',
                        'ru' => 'Руководитель',
                    ],
                'LIST_FILTER_LABEL' =>
                    [
                        'en' => 'Manager',
                        'ru' => 'Руководитель',
                    ],
                'ERROR_MESSAGE' =>
                    [
                        'en' => 'Manager',
                        'ru' => 'Руководитель',
                    ],
                'HELP_MESSAGE' =>
                    [
                        'en' => 'Manager',
                        'ru' => 'Руководитель',
                    ],
            ]);
        }
    }

    public function down()
    {
        $helper = $this->getHelperManager();
        $helper->UserTypeEntity()->deleteUserTypeEntity('USER','UF_MANAGER');
    }
}
