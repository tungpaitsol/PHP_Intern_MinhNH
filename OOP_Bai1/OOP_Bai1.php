<?php
include "Data.php";

class Employee
{
    private $_code;
    private $_full_name;
    private $_age;
    private $_gender;
    private $_marital_status;
    private $_total_work_time;
    private $_salary;
    private $_workdays;
    private $_start_work_time;
    private $_work_hour;
    private $_has_lunch_break;
    private $_total_salary;

    function __construct($code, $full_name, $age, $gender, $marital_status, $total_work_time, $salary, $workdays, $start_work_time,
                         $work_hour, $has_lunch_break)
    {
        $this->_code = $code;
        $this->_full_name = $full_name;
        $this->_age = $age;
        $this->_gender = $gender;
        $this->_marital_status = $marital_status;
        $this->_total_work_time = $total_work_time;
        $this->_salary = $salary;
        $this->_workdays = $workdays;
        $this->_start_work_time = $start_work_time;
        $this->_work_hour = $work_hour;
        $this->_has_lunch_break = $has_lunch_break;
    }

    function setTotalworktime($totalworktime)
    {
        $this->_total_work_time = $totalworktime;
    }

    function setSalary($salary)
    {
        $this->_salary = $salary;
    }

    function setWorkdays($workdays)
    {
        $this->_workdays = $workdays;
    }

    function setWorkhour($workhour)
    {
        $this->_work_hour = $workhour;
    }

    function setTotalSalary($totalsalary)
    {
        $this->_total_salary = $totalsalary;
    }

    function getCode()
    {
        return $this->_code;
    }

    function getTotalworktime()
    {
        return $this->_total_work_time;
    }

    function getSalary()
    {
        return $this->_salary;
    }

    function getWorkdays()
    {
        return $this->_workdays;
    }

    function getStartworktime()
    {
        return $this->_start_work_time;
    }

    function getWorkhour()
    {
        return $this->_work_hour;
    }

    function getHaslunchbreak()
    {
        return $this->_has_lunch_break;
    }
}

class ListWorkTime
{
    private $_membercode;
    private $_startdatetime;
    private $_enddatetime;

    function __construct($member_code, $start_datetime, $end_datetime)
    {
        $this->_membercode = $member_code;
        $this->_startdatetime = $start_datetime;
        $this->_enddatetime = $end_datetime;
    }

    function getMembercode()
    {
        return $this->_membercode;
    }

    function getStartDatetime()
    {
        return $this->_startdatetime;
    }

    function getEndDatetime()
    {
        return $this->_enddatetime;
    }
}

class Manage
{
    const listHoliday = array('2019-01-01', '2019-02-04', '2019-02-05', '2019-02-06', '2019-02-07', '2019-02-08',
        '2019-04-15', '2019-04-30', '2019-05-01', '2019-09-02');

    static function workDays($employee, $listWorkTime)
    {
        foreach ($employee as $item) {
            $workdays = 0;
            foreach ($listWorkTime as $item1) {
                $startWorkTimeRegistered = date('H:i:s', strtotime($item->getStartworktime()));
                $currentStartWorkTime = date('H:i:s', strtotime($item1->getStartDatetime()));
                $timeDo = strtotime($item1->getEndDatetime()) - strtotime($item1->getStartDatetime());
                if ($item->getCode() == $item1->getMembercode() && $item->getHaslunchbreak() == 1) {
                    $timeRegistered = 8 * 60 * 60;
                    if (strtotime($startWorkTimeRegistered) >= strtotime($currentStartWorkTime) && $timeDo >= $timeRegistered)
                        $workdays += 1;
                    else
                        $workdays += 0.5;
                } else {
                    $timeRegistered = 8 * 60 * 60 + 90 * 60;
                    if ($item->getCode() == $item1->getMembercode()) {
                        if (strtotime($startWorkTimeRegistered) >= strtotime($currentStartWorkTime) && $timeDo >= $timeRegistered)
                            $workdays += 1;
                        else
                            $workdays += 0.5;
                    }
                }
            }
            $item->setWorkdays($workdays);
        }
    }

    static function checkDaysInMonth($month, $year): int
    {
        if ($month == '01' || $month == '03' || $month == '05' || $month == '07' || $month == '08' || $month == '10' || $month == '12')
            return $dayOfMonth = 31;
        if ($month == '04' || $month == '06' || $month == '09' || $month == '11')
            return $dayOfMonth = 30;
        if ($month == '02' && $year % 100 != 0 && $year % 4 == 0) {
            return $dayOfMonth = 29;
        } else
            return $dayOfMonth = 28;
    }

    static function checkDaysOff($listWorkTime): int
    {
        $dayOff = 0;
        for ($i = 0; $i < count($listWorkTime); $i++) {
            $month = date('m', strtotime($listWorkTime[$i]->getStartDatetime()));
            $year = date('Y', strtotime($listWorkTime[$i]->getStartDatetime()));
        }
        for ($i = 1; $i <= self::checkDaysInMonth($month, $year); $i++) {
            $dateTime = $year . "-" . $month . "-" . $i;
            $day = date('D', strtotime($dateTime));
            if ($day == 'Sat' || $day == 'Sun') {
                $dayOff++;
            }
        }
        for ($i = 0; $i < count(self::listHoliday); $i++) {
            if ($dateTime == self::listHoliday[$i]) {
                $dayOff++;
            }
        }
        return $dayOff;
    }

    static function totalSalary($employee, $listWorkTime)
    {
        foreach ($employee as $item) {
            foreach ($listWorkTime as $item1) {
                $month = date('m', strtotime($item1->getStartDatetime()));
                $year = date('Y', strtotime($item1->getStartDatetime()));
            }
            $currentWorkDays = self::checkDaysInMonth($month, $year) - self::checkDaysOff($listWorkTime);
            $item->setTotalSalary($item->getWorkdays() / $currentWorkDays * $item->getSalary());
        }
    }
}

$employeeFullTime = [];
for ($i = 0; $i < count($listMemberFullTime); $i++) {
    $employeeFullTime[$i] = new Employee($listMemberFullTime[$i]['code'], $listMemberFullTime[$i]['full_name'], $listMemberFullTime[$i]['age'],
        $listMemberFullTime[$i]['gender'], $listMemberFullTime[$i]['marital_status'], $listMemberFullTime[$i]['total_work_time'],
        $listMemberFullTime[$i]['salary'], $listMemberFullTime[$i]['workdays'], $listMemberFullTime[$i]['start_work_time'],
        $listMemberFullTime[$i]['work_hour'], $listMemberFullTime[$i]['has_lunch_break']);
}
$employeePartTime = [];
for ($i = 0; $i < count($listMemberPartTime); $i++) {
    $employeePartTime[$i] = new Employee($listMemberPartTime[$i]['code'], $listMemberPartTime[$i]['full_name'], $listMemberPartTime[$i]['age'],
        $listMemberPartTime[$i]['gender'], $listMemberPartTime[$i]['marital_status'], $listMemberPartTime[$i]['total_work_time'],
        $listMemberPartTime[$i]['salary'], $listMemberPartTime[$i]['workdays'], $listMemberPartTime[$i]['start_work_time'],
        $listMemberPartTime[$i]['work_hour'], $listMemberPartTime[$i]['has_lunch_break']);
}
$workTime = [];
for ($i = 0; $i < count($listWorkTime); $i++) {
    $workTime[$i] = new ListWorkTime($listWorkTime[$i]['member_code'], $listWorkTime[$i]['start_datetime'], $listWorkTime[$i]['end_datetime']);
}

Manage::workDays($employeeFullTime, $workTime);
Manage::workDays($employeePartTime, $workTime);
Manage::totalSalary($employeeFullTime, $workTime);
Manage::totalSalary($employeePartTime, $workTime);

print_r($employeeFullTime);
print_r($employeePartTime);

