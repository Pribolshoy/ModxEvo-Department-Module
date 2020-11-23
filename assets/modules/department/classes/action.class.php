<?php

class DepartmentAction {
	private $Department = null;
	private $modx = null;

    function __construct($Department, $modx) {
    	$this->Department = &$Department;
    	$this->modx = &$modx;
    }

    function handlePostback() {
    	switch($_POST['tabAction']) {
    		case 'refreshScheme4':
    			echo $this->Department->getScheme4($_POST['employees_count']);
    			break;
			case 'refreshScheme5':
				echo $this->Department->getScheme5($_POST['salary_count']);
				break;
    	}
    }
}
?>
