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

    function setWorkDays($workdays)
    {
        $this->_workdays = $workdays;
    }

    function setTotalSalary($totalSalary)
    {
        $this->_total_salary = $totalSalary;
    }

    function getCode()
    {
        return $this->_code;
    }

    function getSalary()
    {
        return $this->_salary;
    }

    function getWorkdays()
    {
        return $this->_workdays;
    }

    function getStartWorkTime()
    {
        return $this->_start_work_time;
    }

    function getWorkHour()
    {
        return $this->_work_hour;
    }

    function getHasLunchBreak()
    {
        return $this->_has_lunch_break;
    }
}

class ListWorkTime
{
    private $_memberCode;
    private $_startDateTime;
    private $_endDateTime;

    function __construct($member_code, $start_datetime, $end_datetime)
    {
        $this->_memberCode = $member_code;
        $this->_startDateTime = $start_datetime;
        $this->_endDateTime = $end_datetime;
    }

    function getMemberCode()
    {
        return $this->_memberCode;
    }

    function getStartDatetime()
    {
        return $this->_startDateTime;
    }

    function getEndDatetime()
    {
        return $this->_endDateTime;
    }
}

class Manage
{
    const listHoliday = array(
        '2019-01-01',
        '2019-02-04',
        '2019-02-05',
        '2019-02-06',
        '2019-02-07',
        '2019-02-08',
        '2019-04-15',
        '2019-04-30',
        '2019-05-01',
        '2019-09-02');

    static function setWorkDay($employee, $listWorkTime)
    {
        foreach ($employee as $member) {
            $workDays = 0;
            foreach ($listWorkTime as $workTime) {
                $startWorkTimeRegistered = date('H:i:s', strtotime($member->getStartworktime()));
                $currentStartWorkTime = date('H:i:s', strtotime($workTime->getStartDatetime()));
                $currentEndWorkTime = date('H:i:s', strtotime($workTime->getEndDatetime()));
                $timeDo = strtotime($currentEndWorkTime) - strtotime($startWorkTimeRegistered);
                if ($member->getCode() == $workTime->getMemberCode() && $member->getHasLunchBreak() == true) {
                    $timeRegistered = $member->getWorkHour() * 60 * 60;
                    if (strtotime($startWorkTimeRegistered) >= strtotime($currentStartWorkTime) && $timeDo >= $timeRegistered)
                        $workDays += 1;
                    else
                        $workDays += 0.5;
                }
                if ($member->getCode() == $workTime->getMemberCode() && $member->getHasLunchBreak() == false) {
                    $timeRegistered = $member->getWorkHour() * 60 * 60 + 90 * 60;
                    if (strtotime($startWorkTimeRegistered) >= strtotime($currentStartWorkTime) && $timeDo >= $timeRegistered)
                        $workDays += 1;
                    else
                        $workDays += 0.5;
                }
            }
            $member->setWorkDays($workDays);
        }
    }

    static function getDaysInMonth($month, $year): int
    {
        $daysInMonth = date('t', strtotime("$year-$month"));
        return $daysInMonth;
    }

    static function getDaysOff($month, $year): int
    {
        $dayOff = 0;
        for ($i = 1; $i <= self::getDaysInMonth($month, $year); $i++) {
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

    static function setTotalSalaryInMonth($employee, $month, $year)
    {
        foreach ($employee as $member) {
            $currentWorkDays = self::getDaysInMonth($month, $year) - self::getDaysOff($month, $year);
            $member->setTotalSalary($member->getWorkdays() / $currentWorkDays * $member->getSalary());
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

Manage::setWorkDay($employeeFullTime, $workTime);
Manage::setWorkDay($employeePartTime, $workTime);
Manage::setTotalSalaryInMonth($employeeFullTime, 06, 2019);
Manage::setTotalSalaryInMonth($employeePartTime, 06, 2019);

print_r($employeeFullTime);
print_r($employeePartTime);
