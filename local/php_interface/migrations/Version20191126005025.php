<?php

namespace Sprint\Migration;


class Version20191126005025 extends Version
{
    protected $description = "";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Event()->saveEventType('BAD_PRODUCT', array (
  'LID' => 'ru',
  'EVENT_TYPE' => 'email',
  'NAME' => 'Отчёт о плохо продаваемых товарах',
  'DESCRIPTION' => '',
  'SORT' => '150',
));
        $helper->Event()->saveEventType('BAD_PRODUCT', array (
  'LID' => 'en',
  'EVENT_TYPE' => 'email',
  'NAME' => '',
  'DESCRIPTION' => '',
  'SORT' => '150',
));
        $helper->Event()->saveEventMessage('BAD_PRODUCT', array (
  'LID' => 
  array (
    0 => 's1',
  ),
  'ACTIVE' => 'Y',
  'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
  'EMAIL_TO' => '#EMAIL_TO#',
  'SUBJECT' => 'Отчёт о плохо продаваемых товарах',
  'MESSAGE' => '#TEXT#',
  'BODY_TYPE' => 'text',
  'BCC' => '',
  'REPLY_TO' => '',
  'CC' => '',
  'IN_REPLY_TO' => '',
  'PRIORITY' => '',
  'FIELD1_NAME' => '',
  'FIELD1_VALUE' => '',
  'FIELD2_NAME' => '',
  'FIELD2_VALUE' => '',
  'SITE_TEMPLATE_ID' => '',
  'ADDITIONAL_FIELD' => 
  array (
  ),
  'LANGUAGE_ID' => '',
  'EVENT_TYPE' => '[ BAD_PRODUCT ] Отчёт о плохо продаваемых товарах',
));
    }

    public function down()
    {
        //your code ...
    }
}
