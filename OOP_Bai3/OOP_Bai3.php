<?php

require 'BillFoodInfo.php';
require 'FoodAndDrink.php';
require 'FoodCategory.php';
require 'Member.php';
require 'BillStaffInfo.php';
require 'Tables.php';
require 'Bill.php';
require 'Data.php';

class Manage
{
    private $_tip = array(
        1 => array(
            1 => 100000,
            2 => 80000,
            3 => 50000
        ),
        2 => array(
            1 => 80000,
            2 => 60000,
            3 => 40000
        )
    );

    /**
     * @param array $listBill
     * @param array $listStaffInfo
     * @param array $listMember
     */
    public function setNumberOfEmployeeServicedInBill($listBill, $listStaffInfo, $listMember)
    {
        foreach ($listBill as $bill) {
            $numberOfEmployeeServicedInBill = 0;
            foreach ($listStaffInfo as $billStaffInfo) {
                if ($billStaffInfo->getBillCode() !== $bill->getCode())
                    continue;
                foreach ($listMember as $member) {
                    if ($member->getCode() !== $billStaffInfo->getMemberCode())
                        continue;
                    $numberOfEmployeeServicedInBill++;
                }
            }
            $bill->setNumberOfEmployeeService($numberOfEmployeeServicedInBill);
        }
    }

    /**
     * @param array $listBill
     * @param array $listBillFoodInfo
     * @param array $listFoodAndDrink
     */
    public function setTotalFoodMoney($listBill, $listBillFoodInfo, $listFoodAndDrink)
    {
        foreach ($listBill as $bill) {
            $totalFoodMoneyByBill = 0;
            foreach ($listBillFoodInfo as $billFoodInfo) {
                $foodMoney = 0;
                if ($bill->getCode() !== $billFoodInfo->getBillCode())
                    continue;
                foreach ($listFoodAndDrink as $foodAndDrink) {
                    if ($billFoodInfo->getFoodCode() !== $foodAndDrink->getCode())
                        continue;
                    if ($foodAndDrink->getAlcohol())
                        $foodMoney = $billFoodInfo->getQuantity() * $billFoodInfo->getPrice()
                            + ($billFoodInfo->getQuantity() * $billFoodInfo->getPrice()) * $billFoodInfo->getSurcharge() / 100;
                    else
                        $foodMoney = $billFoodInfo->getQuantity() * $billFoodInfo->getPrice();
                }
                $billFoodInfo->setTotalFoodMoney($foodMoney);
                $totalFoodMoneyByBill += $billFoodInfo->getTotalFoodMoney();
            }
            $bill->setTotalFoodMoney($totalFoodMoneyByBill);
        }
    }

    /**
     * @param array $listBill
     * @param array $listBillStaffInfo
     */
    public function setServiceMoneyByBillStaffInfo($listBill, $listBillStaffInfo)
    {
        foreach ($listBill as $bill) {
            $dateCheckInByBill = $bill->getDateCheckIn();
            $dateCheckOutByBill = $bill->getDateCheckOut();
            $currentWorkingTime = 0;
            for ($i = $dateCheckInByBill; $i < $dateCheckOutByBill; $i++) {
                $contents = [];
                foreach ($listBillStaffInfo as $billStaffInfo) {
                    if ($bill->getCode() != $billStaffInfo->getBillCode())
                        continue;
                    if ($billStaffInfo->getStartDateTime() <= $i && $billStaffInfo->getEndDateTime() > $i) {
                        $contents[] = array(
                            'bill_staff_info_code' => $billStaffInfo->getCode(),
                            'bill_code' => $bill->getCode(),
                            'member_code' => $billStaffInfo->getMemberCode(),
                        );
                    }
                }
                $currentWorkingTime++;
                $currentMember = count($contents);
                $key = min($currentMember, count($this->_tip));
                $value = min($currentWorkingTime, count($this->_tip[1]));
                foreach ($listBillStaffInfo as $billStaffInfo) {
                    foreach ($contents as $content) {
                        if ($content['bill_staff_info_code'] != $billStaffInfo->getCode())
                            continue;
                        $serviceMoney = $billStaffInfo->getServiceMoney();
                        $billStaffInfo->setServiceMoney($serviceMoney + $this->_tip[$key][$value]);
                    }
                }
            }
        }
    }

    /**
     * @param array $listBill
     * @param array $listBillStaffInfo
     */
    public function setTotalServiceMoney($listBill, $listBillStaffInfo)
    {
        foreach ($listBill as $bill) {
            $totalServiceMoney = 0;
            foreach ($listBillStaffInfo as $billStaffInfo) {
                if ($bill->getCode() !== $billStaffInfo->getBillCode())
                    continue;
                $totalServiceMoney += $billStaffInfo->getServiceMoney();
            }
            $bill->setTotalServiceMoney($totalServiceMoney);
        }
    }

    /**
     * @param array $listBill
     */
    public function setTotalMoneyInBill($listBill)
    {
        foreach ($listBill as $bill) {
            $totalServiceMoney = $bill->getTotalServiceMoney();
            $totalFoodMoney = $bill->getTotalFoodMoney();
            $tax = $bill->getTax();
            $voucher = $bill->getVoucher();
            $totalMoney = ($totalServiceMoney + $totalFoodMoney) - ($totalServiceMoney + $totalFoodMoney) * ($voucher / 100);
            $bill->setTotalMoney($totalMoney + ($totalMoney * $tax / 100));
        }
    }

    /**
     * @param array $listBill
     * @param array $listStaffInfo
     * @param array $listMember
     */
    public function setSalaryEmployeeInMonth($listBill, $listStaffInfo, $listMember)
    {
        foreach ($listMember as $member) {
            $salary = 0;
            $bonusMoney = 0;
            $listSalary = [];
            foreach ($listStaffInfo as $billStaffInfo) {
                if ($member->getCode() != $billStaffInfo->getMemberCode())
                    continue;
                foreach ($listBill as $bill) {
                    if ($bill->getCode() != $billStaffInfo->getBillCode())
                        continue;
                    if ($billStaffInfo->getMemberType()) {
                        $bonusMoney += $bill->getTotalMoney() * 1.5 / 100;
                    } else {
                        $bonusMoney += $bill->getTotalMoney() * 1 / 100;
                    }
                    $tip = $billStaffInfo->getServiceMoney() * 40 / 100;
                    $salary = $bonusMoney + $tip;
                }
                $listSalary[] = $salary;
            }
            $totalSalary = array_sum($listSalary);
            $member->setSalary($totalSalary);
        }
    }
}

//echo "<pre>";
$a = new Manage();
$a->setNumberOfEmployeeServicedInBill($allBill, $allBillStaffInfo, $allMember);
$a->setTotalFoodMoney($allBill, $allBillFoodInfo, $allFoodAndDrink);
$a->setServiceMoneyByBillStaffInfo($allBill, $allBillStaffInfo);
$a->setTotalServiceMoney($allBill, $allBillStaffInfo);
$a->setTotalMoneyInBill($allBill);
$a->setSalaryEmployeeInMonth($allBill, $allBillStaffInfo, $allMember);

//print_r($allBillFoodInfo);
//print_r($allBillStaffInfo);
//print_r($allTable);
//print_r($allFoodCategory);
//print_r($allFoodAndDrink);
//print_r($allBill);
//print_r($allMember);

