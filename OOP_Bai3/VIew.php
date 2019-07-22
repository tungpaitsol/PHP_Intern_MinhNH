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
            if ($bill->getCode() != $billStaffInfo->getBillCode())
                continue;
            if ($member->getCode() != $billStaffInfo->getMemberCode())
                continue;
            echo "Full Name: " . $member->getFullName() . " -- ";
            echo "Start Working : " . $billStaffInfo->getStartDateTime() . " -- ";
            echo "End Working : " . $billStaffInfo->getEndDateTime() . "<br>";

        }
    }
    echo "Tax : " . $bill->getTax() . " %" . "<br>";
    echo "Voucher :" . $bill->getVoucher() . " %" . "<br>";
    echo "Total Food Money = " . $bill->getTotalFoodMoney() . "<br>";
    echo "Total Service Money = " . $bill->getTotalServiceMoney() . "<br>";
    echo "Total = " . $bill->getTotalMoney() . "<br>" . "<br>";
}
