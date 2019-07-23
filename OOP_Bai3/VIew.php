<?php
include 'OOP_Bai3.php';

foreach ($allBill as $bill) {
    echo "---------------------------------" . "  Bill Details:" . $bill->getCode() . "------------------------------" . "<br>";
    echo "* List Food and Drink *: " . "<br>";
    foreach ($allBillFoodInfo as $billFoodInfo) {
        foreach ($allFoodAndDrink as $foodAndDrink) {
            if ($bill->getCode() != $billFoodInfo->getBillCode())
                continue;
            if ($billFoodInfo->getFoodCode() != $foodAndDrink->getCode())
                continue;
            echo "Name :" . $foodAndDrink->getName() . " -- ";
            echo "Quantity : " . $billFoodInfo->getQuantity() . " -- ";
            echo "Price : " . $billFoodInfo->getPrice() . " -- ";
            echo "Surcharge : " . $billFoodInfo->getSurcharge() . "%" . "<br>";

        }
        echo "</table>";
    }
    echo "* List Employee *:" . "<br>";
    foreach ($allBillStaffInfo as $billStaffInfo) {
        foreach ($allMember as $member) {
            $serviceMoney = 0;
            if ($bill->getCode() != $billStaffInfo->getBillCode())
                continue;
            if ($member->getCode() != $billStaffInfo->getMemberCode())
                continue;
            $serviceMoney += $billStaffInfo->getServiceMoney();
            echo "Full Name: " . $member->getFullName() . " -- ";
            echo "Start Working : " . $billStaffInfo->getStartDateTime() . " -- ";
            echo "End Working : " . $billStaffInfo->getEndDateTime() . " -- ";
            echo "Service Money : " . number_format($serviceMoney) . " ¥" . "<br>";

        }
    }
    echo "Tax : " . $bill->getTax() . " %" . "<br>";
    echo "Voucher :" . $bill->getVoucher() . " %" . "<br>";
    echo "Total Food Money = " . number_format($bill->getTotalFoodMoney()) . " ¥" . "<br>";
    echo "Total Service Money = " . number_format($bill->getTotalServiceMoney()) . " ¥" . "<br>";
    echo "Total = " . number_format($bill->getTotalMoney()) . " ¥" . "<br>" . "<br>";
}
echo "=========================Salary Employee In Month=======================" . "<br>";
foreach ($allMember as $member) {
    echo "Full Name : " . $member->getFullName() . "<br>";
    echo "Salary : " . number_format($member->getSalary(),3,',','.')." ¥" . "<br>";
}
