<?php

namespace Sprint\Migration;


class Version20191126004623 extends Version
{
    protected $description = "";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Agent()->saveAgent(array (
  'MODULE_ID' => 'main',
  'USER_ID' => NULL,
  'SORT' => '0',
  'NAME' => 'BadProduct::sendToMail();',
  'ACTIVE' => 'Y',
  'NEXT_EXEC' => '27.11.2019 00:42:28',
  'AGENT_INTERVAL' => '86400',
  'IS_PERIOD' => 'N',
));
    }

    public function down()
    {
        //your code ...
    }
}
