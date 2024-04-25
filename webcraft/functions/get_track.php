<?php
    
    if (isset($_POST['unitID'])) {
        $unitIDInput = $_POST['unitID'];
    
        $unitID = intval(substr($unitIDInput, 5));
        $sql = "SELECT * FROM units WHERE unit_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $unitID);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_ID = $row['user_ID']; 
            $unitDetails = array(
                'unitID' => $unitIDInput,
                'user_ID' => $row['user_ID'],
                'equipmentName' => $row['equipment_name']
            );
    
            $unitID = intval(substr($unitIDInput, 5));
            $unitSql = "SELECT year_received FROM units WHERE unit_ID = ?";
            $unitStmt = $conn->prepare($unitSql);
            $unitStmt->bind_param("i", $unitID);
            $unitStmt->execute();
            $unitResult = $unitStmt->get_result();
    
            if ($unitResult->num_rows > 0) {
                $unitRow = $unitResult->fetch_assoc();
                $unitDetails['unitYearReceived'] = $unitRow['year_received'];
            }
    
            $user_ID = $row['user_ID'];
            $userSql = "SELECT first_name, middle_initial, last_name, username, rank, designation, department, email FROM users WHERE user_ID = ?";
            $userStmt = $conn->prepare($userSql);
            $userStmt->bind_param("i", $user_ID);
            $userStmt->execute();
            $userResult = $userStmt->get_result();
    
            if ($userResult->num_rows > 0) {
                $userRow = $userResult->fetch_assoc();
                $unitDetails['firstName'] = $userRow['first_name'];
                $unitDetails['middleInitial'] = $userRow['middle_initial'];
                $unitDetails['lastName'] = $userRow['last_name'];
                $unitDetails['userName'] = $userRow['username'];
                $unitDetails['rank'] = $userRow['rank'];
                $unitDetails['designation'] = $userRow['designation'];
                $unitDetails['department'] = $userRow['department'];
                $unitDetails['email'] = $userRow['email'];
            }
    
            $equipmentName = $row['equipment_name'];
            $equipmentSql = "SELECT description, account_code, property_number, unit_value, year_received, remarks, warranty_end, image FROM equipment WHERE article = ?";
            $equipmentStmt = $conn->prepare($equipmentSql);
            $equipmentStmt->bind_param("s", $equipmentName);
            $equipmentStmt->execute();
            $equipmentResult = $equipmentStmt->get_result();
    
            if ($equipmentResult->num_rows > 0) {
                $equipmentRow = $equipmentResult->fetch_assoc();
                $unitDetails['description'] = $equipmentRow['description'];
                $unitDetails['accountCode'] = $equipmentRow['account_code'];
                $unitDetails['propertyNumber'] = $equipmentRow['property_number'];
                $unitDetails['unitValue'] = $equipmentRow['unit_value'];
                $unitDetails['remarks'] = $equipmentRow['remarks'];
                $unitDetails['yearReceived'] = $equipmentRow['year_received'];
                $unitDetails['warrantyEnd'] = $equipmentRow['warranty_end'];
                $unitDetails['image'] = "../../uploads/" . $equipmentRow['image'];
            }
        
            $unitTransferSql = "SELECT old_end_user_first_name, old_end_user_last_name, old_end_userID, year_transfer, timestamp FROM unit_transfer WHERE unit_ID = ?";
            $unitTransferStmt = $conn->prepare($unitTransferSql);
            $unitTransferStmt->bind_param("s", $unitIDInput);
            $unitTransferStmt->execute();
            $unitTransferResult = $unitTransferStmt->get_result();
    
            if ($unitTransferResult->num_rows > 0) {
                $unitDetails['oldEndUserNames'] = array();
    
            while ($unitTransferRow = $unitTransferResult->fetch_assoc()) {
                $oldEndUser = array(
                    'firstName' => $unitTransferRow['old_end_user_first_name'],
                    'lastName' => $unitTransferRow['old_end_user_last_name'],
                    'year_transfer' => $unitTransferRow['year_transfer'],
                    'timestamp' => $unitTransferRow['timestamp']
                );
    
            $oldEndUserID = $unitTransferRow['old_end_userID'];
            $userSql = "SELECT middle_initial, username, email, rank, designation, department FROM users WHERE user_ID = ?";
            $userStmt = $conn->prepare($userSql);
            $userStmt->bind_param("s", $oldEndUserID);
            $userStmt->execute();
            $userResult = $userStmt->get_result();
    
                if ($userResult->num_rows > 0) {
                    $userRow = $userResult->fetch_assoc();
                    $oldEndUser['middleInitial'] = $userRow['middle_initial'];
                    $oldEndUser['username'] = $userRow['username'];
                    $oldEndUser['email'] = $userRow['email'];
                    $oldEndUser['rank'] = $userRow['rank'];
                    $oldEndUser['designation'] = $userRow['designation'];
                    $oldEndUser['department'] = $userRow['department'];
                }
    
                $unitDetails['oldEndUserNames'][] = $oldEndUser;
            }
        }
    
            $issueSql = "SELECT report_issue, timestamp FROM unit_history WHERE unit_ID = ?";
            $issueStmt = $conn->prepare($issueSql);
            $issueStmt->bind_param("s", $unitIDInput);
            $issueStmt->execute();
            $issueResult = $issueStmt->get_result();
            
            if ($issueResult->num_rows > 0) {
                $unitDetails['unitIssues'] = array();
            
                while ($issueRow = $issueResult->fetch_assoc()) {
                    $unitIssue = array(
                        'reportIssue' => $issueRow['report_issue'],
                        'timestamp' => $issueRow['timestamp']
                    );
                    $unitDetails['unitIssues'][] = $unitIssue;
                }
            }
            
    
            echo json_encode($unitDetails);
            exit;
        } else {
            echo "not_exists";
            exit;
        }
    }
?>

<!-- *Copyright  © 2024 WebCraft - All Rights Reserved*
        *Administartive Office Facility Reservation and Management System*
        *IT 132 - Software Engineering *
        *(WebCraft) Members:
            Falcatan, Khriz Marr
            Gabotero, Rogie
            Taborada, John Mark
            Tingkasan, Padwa 
            Villares, Arp-J* -->