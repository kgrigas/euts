<?php

class RunCommand extends CConsoleCommand
{

	/**
	 * Usage: /home/{REPLACE}/public_html/admin/cron.php run type(e.g. baySoft)
	 * @param array $args
	 * @return int|void
	 */

	public function run($args) {
		foreach ($args as $arg) {
			switch($arg){

				case 'baySoft':
					$baySoft = new BaySoft;
					$baySoft->getData();
					break;
			}
		}
	}
}