<?php
$listMemberFullTime = array(
    array(
        'code' => '001',
        'full_name' => 'Nguyen Van A',
        'age' => 25,
        'gender' => 0,
        'marital_status' => 0,
        'total_work_time' => 0,
        'salary' => 15000000,
        'workdays' => 0,
        'start_work_time' => '08:00:00',
        'work_hour' => 8,
        'has_lunch_break' => 1
    ),
    array(
        'code' => '002',
        'full_name' => 'Nguyen Thi B',
        'age' => 30,
        'gender' => 1,
        'marital_status' => 1,
        'total_work_time' => 0,
        'salary' => 10000000,
        'workdays' => 0,
        'start_work_time' => '08:30:00',
        'work_hour' => 8,
        'has_lunch_break' => 1
    ),
    array(
        'code' => '003',
        'full_name' => 'Nguyen Van C',
        'age' => 28,
        'gender' => 0,
        'marital_status' => 1,
        'total_work_time' => 0,
        'salary' => 20000000,
        'workdays' => 0,
        'start_work_time' => '09:00:00',
        'work_hour' => 8,
        'has_lunch_break' => 1
    )
);
echo "<pre>";
$listMemberPartTime = array(
    array(
        'code' => '004',
        'full_name' => 'Nguyen Xuan P',
        'age' => 22,
        'gender' => 0,
        'marital_status' => 0,
        'total_work_time' => 0,
        'salary' => 4000000,
        'workdays' => 0,
        'start_work_time' => '09:00:00',
        'work_hour' => 4,
        'has_lunch_break' => 0
    ),
    array(
        'code' => '005',
        'full_name' => 'Nguyen Ngoc T',
        'age' => 21,
        'gender' => 1,
        'marital_status' => 0,
        'total_work_time' => 0,
        'salary' => 3500000,
        'workdays' => 0,
        'start_work_time' => '08:30:00',
        'work_hour' => 3,
        'has_lunch_break' => 1
    )
);

$listWorkTime = array(
    array(
        'member_code' => '001',
        'start_datetime' => '2019-06-01 08:00:00',
        'end_datetime' => '2019-06-01 19:00:00'
    ),
    array(
        'member_code' => '001',
        'start_datetime' => '2019-06-02 08:10:00',
        'end_datetime' => '2019-06-02 19:00:00'
    ),
    array(
        'member_code' => '001',
        'start_datetime' => '2019-06-03 08:00:00',
        'end_datetime' => '2019-06-03 18:00:00'
    ),
    array(
        'member_code' => '001',
        'start_datetime' => '2019-06-04 08:20:00',
        'end_datetime' => '2019-06-04 18:20:00'
    ),
    array(
        'member_code' => '001',
        'start_datetime' => '2019-06-05 09:02:00',
        'end_datetime' => '2019-06-05 19:40:00'
    ),
    array(
        'member_code' => '002',
        'start_datetime' => '2019-06-06 08:20:00',
        'end_datetime' => '2019-06-06 18:30:00'
    ),
    array(
        'member_code' => '002',
        'start_datetime' => '2019-06-01 08:00:00',
        'end_datetime' => '2019-06-01 19:00:00'
    ),
    array(
        'member_code' => '002',
        'start_datetime' => '2019-06-02 08:10:00',
        'end_datetime' => '2019-06-02 17:00:00'
    ),
    array(
        'member_code' => '002',
        'start_datetime' => '2019-06-03 08:50:00',
        'end_datetime' => '2019-06-03 18:00:00'
    ),
    array(
        'member_code' => '002',
        'start_datetime' => '2019-06-04 08:20:00',
        'end_datetime' => '2019-06-04 18:20:00'
    ),
    array(
        'member_code' => '002',
        'start_datetime' => '2019-06-05 09:02:00',
        'end_datetime' => '2019-06-05 17:40:00'
    ),
    array(
        'member_code' => '002',
        'start_datetime' => '2019-06-06 08:20:00',
        'end_datetime' => '2019-06-06 18:30:00'
    ),

    array(
        'member_code' => '003',
        'start_datetime' => '2019-06-01 08:00:00',
        'end_datetime' => '2019-06-01 19:00:00'
    ),
    array(
        'member_code' => '003',
        'start_datetime' => '2019-06-02 08:10:00',
        'end_datetime' => '2019-06-02 17:00:00'
    ),
    array(
        'member_code' => '003',
        'start_datetime' => '2019-06-03 08:50:00',
        'end_datetime' => '2019-06-03 18:00:00'
    ),
    array(
        'member_code' => '003',
        'start_datetime' => '2019-06-04 08:20:00',
        'end_datetime' => '2019-06-04 18:20:00'
    ),
    array(
        'member_code' => '003',
        'start_datetime' => '2019-06-05 09:02:00',
        'end_datetime' => '2019-06-05 17:40:00'
    ),
    array(
        'member_code' => '003',
        'start_datetime' => '2019-06-06 08:20:00',
        'end_datetime' => '2019-06-06 18:30:00'
    ),

    array(
        'member_code' => '004',
        'start_datetime' => '2019-06-01 08:00:00',
        'end_datetime' => '2019-06-01 12:00:00'
    ),
    array(
        'member_code' => '004',
        'start_datetime' => '2019-06-02 08:10:00',
        'end_datetime' => '2019-06-02 11:30:00'
    ),
    array(
        'member_code' => '004',
        'start_datetime' => '2019-06-03 08:50:00',
        'end_datetime' => '2019-06-03 11:40:00'
    ),
    array(
        'member_code' => '004',
        'start_datetime' => '2019-06-04 08:20:00',
        'end_datetime' => '2019-06-04 12:30:00'
    ),
    array(
        'member_code' => '004',
        'start_datetime' => '2019-06-05 09:02:00',
        'end_datetime' => '2019-06-05 13:45:00'
    ),
    array(
        'member_code' => '004',
        'start_datetime' => '2019-06-06 08:20:00',
        'end_datetime' => '2019-06-06 12:30:00'
    ),

    array(
        'member_code' => '005',
        'start_datetime' => '2019-06-01 08:00:00',
        'end_datetime' => '2019-06-01 12:00:00'
    ),
    array(
        'member_code' => '005',
        'start_datetime' => '2019-06-02 08:10:00',
        'end_datetime' => '2019-06-02 11:30:00'
    ),
    array(
        'member_code' => '005',
        'start_datetime' => '2019-06-03 08:50:00',
        'end_datetime' => '2019-06-03 11:40:00'
    ),
    array(
        'member_code' => '005',
        'start_datetime' => '2019-06-03 08:50:00',
        'end_datetime' => '2019-06-03 11:40:00'
    ),
    array(
        'member_code' => '005',
        'start_datetime' => '2019-06-04 08:20:00',
        'end_datetime' => '2019-06-04 12:10:00'
    ),
    array(
        'member_code' => '005',
        'start_datetime' => '2019-06-05 09:02:00',
        'end_datetime' => '2019-06-05 11:45:00'
    ),
    array(
        'member_code' => '005',
        'start_datetime' => '2019-06-06 08:20:00',
        'end_datetime' => '2019-06-06 12:30:00'
    ),

);