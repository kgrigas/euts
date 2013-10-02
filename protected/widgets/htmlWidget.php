<?php
class htmlWidget extends CWidget {
	public $file;
	public $vars;
	
	public function init() {
		if ($this->getViewFile($this->file)) {
			$this->render($this->file, $this->vars);
		}
	}
}
		
			