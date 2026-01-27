<?php

namespace Sprint\Migration;


class Version20250124173544 extends Version
{
    protected $description = "hide user fields";

    protected $moduleVersion = "4.6.2";

    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->UserTypeEntity()->updateUserTypeEntityIfExists('USER', 'UF_STATE_LAST', ['SHOW_IN_LIST' => 'N']);
        $helper->UserTypeEntity()->updateUserTypeEntityIfExists('USER', 'UF_STATE_FIRST', ['SHOW_IN_LIST' => 'N']);
        $helper->UserTypeEntity()->updateUserTypeEntityIfExists('USER', 'UF_SIMPLE_APPROVE', ['SHOW_IN_LIST' => 'N']);
        $helper->UserTypeEntity()->updateUserTypeEntityIfExists('USER', 'UF_DISABLE_RULE', ['SHOW_IN_LIST' => 'N']);
        $helper->UserTypeEntity()->updateUserTypeEntityIfExists('USER', 'UF_INN', ['SHOW_IN_LIST' => 'N']);

        $dbUF = \CUserTypeEntity::GetList(
            [],
            [
                'ENTITY_ID' => 'USER'
            ]
        );

        while ($uf = $dbUF->Fetch()) {
            if (str_contains($uf['FIELD_NAME'], 'UF_1C_PR')) {
                $helper->UserTypeEntity()->updateUserTypeEntityIfExists('USER', $uf['FIELD_NAME'], ['SHOW_IN_LIST' => 'N']);
            }
        }
    }

    public function down()
    {
        //your code ...
    }
}
