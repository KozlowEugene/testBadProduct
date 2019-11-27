<?php

namespace Sprint\Migration;


class Version20191125220743 extends Version
{
	protected $description = "Руководители";

	/**
	 * @throws Exceptions\HelperException
	 * @return bool|void
	 */
	public function up() {
		$helper = $this->getHelperManager();

		$helper->UserGroup()->saveGroup('executives', [
			'ACTIVE' => 'Y',
			'C_SORT' => '100',
			'ANONYMOUS' => 'N',
			'NAME' => 'Руководители',
			'DESCRIPTION' => 'Руководители',
			'SECURITY_POLICY' =>
				[
				],
		]);
	}

	public function down() {
		//your code ...
	}
}
