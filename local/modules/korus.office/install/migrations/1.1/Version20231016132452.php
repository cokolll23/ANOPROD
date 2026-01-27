<?php

namespace Sprint\Migration;


class Version20231016132452 extends Version
{
    protected $description = "";
    protected $moduleVersion = "4.3.2";

    /**
     * @return bool|void
     * @throws Exceptions\RestartException
     * @throws Exceptions\HelperException
     * @throws Exceptions\MigrationException
     */
    public function up()
    {
        $this->getExchangeManager()
            ->HlblockElementsImport()
            ->setExchangeResource('hlblock_elements.xml')
            ->setLimit(20)
            ->execute(function ($item) {
                $this->getHelperManager()
                    ->Hlblock()
                    ->addElement(
                        $item['hlblock_id'],
                        $item['fields']
                    );
            });
    }

    /**
     * @return bool|void
     * @throws Exceptions\RestartException
     * @throws Exceptions\HelperException
     * @throws Exceptions\MigrationException
     */
    public function down()
    {
    }


}
