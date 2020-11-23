<?
require_once('classes/department.class.php');
require_once('classes/action.class.php');

$Department = new Department($modx);
$Action = new DepartmentAction($Department, $modx);

if (isset($_POST['tabAction'])) {
    $Action->handlePostback();
} else {
    print Department::parseTemplate($Department->getTpl('main.tpl'), $Department->ph);
}



