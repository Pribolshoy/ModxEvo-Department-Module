<?php

class Department{

    protected $modx = null;

    public $lang;
    public $theme = '';
    public $ph = array();

    function __construct($modx){
        $this->modx = $modx;
        $lang = $modx->config['manager_language'];

        if (file_exists( dirname(__FILE__) .  '/../lang/'.$lang.'.php')){
            require_once(__DIR__ .  '/../lang/'.$lang.'.php');
        } else {
            require_once(__DIR__ .  '/../lang/english.php');
        }
        $this->ph = array_merge($this->ph, $_lang);

        $theme = $this->modx->db->select('setting_value', $this->modx->getFullTableName('system_settings'), "setting_name='manager_theme'");
        if ($theme = $this->modx->db->getValue($theme)) {
            $this->theme = ($theme <> '') ? '/' . $theme : '';
        } else {
            $this->theme = '';
        }
        $this->ph['theme'] = $this->theme;

        $this->ph['employees_count'] = $employees_count = 30;
        $this->ph['salary_count'] = $salary_count = 1000000000;

        $this->ph['scheme1_content'] = $this->getScheme1();
        $this->ph['scheme2_content'] = $this->getScheme2();
        $this->ph['scheme3_content'] = $this->getScheme3();
        $this->ph['scheme4_content'] = $this->getScheme4($employees_count);
        $this->ph['scheme5_content'] = $this->getScheme5($salary_count);
    }

    function getTpl($file) {
        ob_start();
        include(dirname(__FILE__) . '/../templates/' . $file);
        $tpl = ob_get_contents();
        ob_end_clean();
        return $tpl;
    }

    static function parseTemplate($tpl, $field) {
        foreach($field as $key=>$value)  $tpl = str_replace('[+'.$key.'+]',$value,$tpl);
        return $tpl;
    }

    function getScheme1() {
        // больше чем у начальника
        $query = $this->modx->db->query("SELECT e1.id, e1.name, e1.salary 
        FROM employee as e1 
        JOIN employee as e2 ON(e2.id = e1.boss_id) 
        WHERE e1.salary > e2.salary
        ORDER BY e1.id ASC
		");

        $content = '';

        $content .= '<table class="grid">';
        $content .= '<thead>';
        $content .= '<tr>';
        $content .= '<td>ID</td>';
        $content .= '<td>Имя</td>';
        $content .= '<td>Зарплата</td>';
        $content .= '</tr>';
        $content .= '</thead>';

        $content .= '<tbody>';
        while ($result = $this->modx->db->getRow($query)) {
            $content .= '<tr>';
                $content .= '<td>';
                $content .= $result['id'];
                $content .= '</td>';
                $content .= '<td>';
                $content .= $result['name'];
                $content .= '</td>';
                $content .= '<td>';
                $content .= $result['salary'];
                $content .= '</td>';
            $content .= '</tr>';
        }
        $content .= '</tbody>';
        $content .= '</table>';

        return $content;
    }

    function getScheme2() {
        // самая большая зп в отделе
        $query = $this->modx->db->query("SELECT e1.id, e1.name, e1.department, e1.salary, d1.name as departmnet_name FROM 
        (SELECT MAX(salary) as max_salary FROM employee GROUP BY department) AS e2,  
        employee AS e1
        LEFT JOIN department as d1 ON (d1.id = e1.department)
        WHERE e1.salary = e2.max_salary
        ORDER BY e1.department ASC
		");

        $content = '';

        $content .= '<table class="grid">';
        $content .= '<thead>';
        $content .= '<tr>';
        $content .= '<td>ID</td>';
        $content .= '<td>Имя</td>';
        $content .= '<td>Департамент</td>';
        $content .= '<td>Зарплата</td>';
        $content .= '</tr>';
        $content .= '</thead>';

        $content .= '<tbody>';
        while ($result = $this->modx->db->getRow($query)) {
            $content .= '<tr>';
                $content .= '<td>';
                $content .= $result['id'];
                $content .= '</td>';
                $content .= '<td>';
                $content .= $result['name'];
                $content .= '</td>';
                $content .= '<td>';
                $content .= $result['departmnet_name'];
                $content .= '</td>';
                $content .= '<td>';
                $content .= $result['salary'];
                $content .= '</td>';
            $content .= '</tr>';
        }
        $content .= '</tbody>';
        $content .= '</table>';

        return $content;
    }

    function getScheme3() {
        // самая большая зп в отделе исключая руководителей
        $query = $this->modx->db->query("SELECT e1.id, e1.name, e1.department, e1.salary, d1.name as departmnet_name FROM 
        (SELECT MAX(salary) as max_salary FROM employee WHERE id NOT IN 
            (SELECT boss_id FROM employee WHERE boss_id IS NOT NULL GROUP BY boss_id) 
        GROUP BY department) AS e2,
        employee AS e1
        LEFT JOIN department as d1 ON (d1.id = e1.department)
        WHERE e1.salary = e2.max_salary
        ORDER BY e1.department ASC
		");

        $content = '';

        $content .= '<table class="grid">';
        $content .= '<thead>';
        $content .= '<tr>';
        $content .= '<td>ID</td>';
        $content .= '<td>Имя</td>';
        $content .= '<td>Департамент</td>';
        $content .= '<td>Зарплата</td>';
        $content .= '</tr>';
        $content .= '</thead>';

        $content .= '<tbody>';
        while ($result = $this->modx->db->getRow($query)) {
            $content .= '<tr>';
                $content .= '<td>';
                $content .= $result['id'];
                $content .= '</td>';
                $content .= '<td>';
                $content .= $result['name'];
                $content .= '</td>';
                $content .= '<td>';
                $content .= $result['departmnet_name'];
                $content .= '</td>';
                $content .= '<td>';
                $content .= $result['salary'];
                $content .= '</td>';
            $content .= '</tr>';
        }
        $content .= '</tbody>';
        $content .= '</table>';

        return $content;
    }

    function getScheme4($employees_count = 30) {
        // самая большая зп в отделе исключая руководителей
        $query = $this->modx->db->query("SELECT d1.id, d1.name, d2.cnt FROM 
		(SELECT department, COUNT(*) AS cnt FROM employee GROUP BY department) AS d2,
		department AS d1
		WHERE d1.id IN (d2.department) and
		d2.cnt < $employees_count
		");

        $content = '';

        $content .= '<table class="grid">';
        $content .= '<thead>';
        $content .= '<tr>';
            $content .= '<td>ID</td>';
            $content .= '<td>Имя</td>';
            $content .= '<td>Количество сотрудников</td>';
        $content .= '</tr>';
        $content .= '</thead>';

        $content .= '<tbody>';
        while ($result = $this->modx->db->getRow($query)) {
            $content .= '<tr>';
                $content .= '<td>';
                $content .= $result['id'];
                $content .= '</td>';
                $content .= '<td>';
                $content .= $result['name'];
                $content .= '</td>';
                $content .= '<td>';
                $content .= $result['cnt'];
                $content .= '</td>';
            $content .= '</tr>';
        }
        $content .= '</tbody>';
        $content .= '</table>';

        return $content;
    }

    function getScheme5($salary_count = 1000000000) {
        // Список отделов с максимальным расходом на зарплату
        $query = $this->modx->db->query("SELECT d1.id, d1.name, d2.sum FROM 
        (SELECT department, SUM(salary) AS sum FROM employee GROUP BY department) AS d2,
        department AS d1
        WHERE d1.id IN (d2.department) and
        d2.sum > $salary_count
		");

        $content = '';

        $content .= '<table class="grid">';
        $content .= '<thead>';
        $content .= '<tr>';
            $content .= '<td>ID</td>';
            $content .= '<td>Имя</td>';
            $content .= '<td>Расходы</td>';
        $content .= '</tr>';
        $content .= '</thead>';

        $content .= '<tbody>';
        while ($result = $this->modx->db->getRow($query)) {
            $content .= '<tr>';
                $content .= '<td>';
                $content .= $result['id'];
                $content .= '</td>';
                $content .= '<td>';
                $content .= $result['name'];
                $content .= '</td>';
                $content .= '<td>';
                $content .= $result['sum'];
                $content .= '</td>';
            $content .= '</tr>';
        }
        $content .= '</tbody>';
        $content .= '</table>';

        return $content;
    }

}
