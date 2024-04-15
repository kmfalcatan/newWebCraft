<?php
 include "../../dbConfig/dbconnect.php";
 include "../../functions/equip_info.php";

 
$equipmentID = isset($_GET['equipment_ID']) ? $_GET['equipment_ID'] : null;
?>
<div class="equipContainer">
    <div class="filterContainer1" style="width: 100%; margin-top: 0rem;">
        <div class="inventoryNameContainer">
            <p>EDIT EQUIPMENT DETAILS</p>
        </div>

        <div class="subFilterContainer1">
            <div class="trackContainer">
                <button class="trackButton1" type="button"  onclick="showWarrantyContainer()">Check warranty</button>
            </div>
        </div>
    </div>

        <form class="subViewApproveContainer" action="../../functions/edit_equipment.php" enctype="multipart/form-data" method="post">
            <div class="viewInfoContainer" id="viewInfoContainer">
                <div class="imageContainer4" >
                    <div class="equipImage" >
                        <?php if (!empty($imageURL)): ?>
                            <img class="equipImage2" id="image3" src="../../uploads/<?php echo $imageURL; ?>" alt="">
                        <?php else: ?>
                            <img class="equipImage2" id="image3" src="../../assets/img/img_placeholder.jpg" alt="">
                        <?php endif; ?>
                    </div>

                    <div class="uploadButtonContainer1">
                        <label class="uploadButton1" type="button">
                            <img class="uploadIcon1" src="../../assets/img/upload.png" alt="Upload Icon" class="uploadIcon">
                            upload
                            <input id="image" name="image" type="file" style="display: none;">
                        </label>
                    </div>
                </div>

                <div class="approveInfoContainer">
                    <div class="subApproveInfoContainer">
                        <div class="approveContainer">
                            <div class="labelContainer1">
                                <p>Article</p>
                            </div>

                            <input class="container4" type="text" name="article" value="<?php echo $article; ?>">
                        </div>
                    </div>

                    <div class="subApproveInfoContainer">
                        <div class="approveContainer">
                            <div class="labelContainer1">
                                <p>Deployment</p>
                            </div>

                            <input class="container4" type="text" name="deployment" value="<?php echo $deployment; ?>">
                        </div>
                    </div>

                    <div class="subApproveInfoContainer1">
                        <div class="approveContainer">
                            <div class="labelContainer1">
                                <p>Property number</p>
                            </div>

                            <input class="container4" type="text" name="property_number" value="<?php echo $propertyNumber; ?>">
                        </div>

                        <div class="approveContainer">
                            <div class="labelContainer1">
                                <p>Account code</p>
                            </div>

                            <input class="container4" type="text" name="account_code" value="<?php echo $accountCode; ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="viewInfoContainer" id="viewInfoContainer1">

                <div class="approveInfoContainer">
                    
                    <div class="subApproveInfoContainer1" id="subApproveInfoContainer1">
                        <div class="approveContainer" id="approveContainer">
                            <div class="labelContainer1">
                                <p>Total unit </p>
                            </div>

                            <input class="container4" type="number" name="total_unit" value="<?php echo $units; ?>">
                        </div>

                        <div class="approveContainer" id="approveContainer">
                            <div class="labelContainer1">
                                <p>Total value</p>
                            </div>

                            <input class="container4" type="text" name="total_value" value="<?php echo $totalValue; ?>">
                        </div>

                        <div class="approveContainer" id="approveContainer">
                            <div class="labelContainer1">
                                <p>Year released</p>
                            </div>

                            <input class="container4" type="number" name="year_received" value="<?php echo $yearReceived; ?>">
                        </div>

                        <div class="approveContainer">
                            <div class="labelContainer1">
                                <p>Remarks</p>
                            </div>

                            <input class="container4" type="text" name="remarks" value="<?php echo $remarks; ?>">
                        </div>
                    </div>

                    <div class="subApproveInfoContainer1" id="subApproveInfoContainer">

                        <div class="approveContainer">
                            <div class="labelContainer1">
                                <p>Description</p>
                            </div>

                            <input class="container4" type="text" name="description" style="width: 98%;"  value="<?php echo $description; ?>">
                        </div>
                    </div>

                    <div class="subApproveInfoContainer1" id="subApproveInfoContainer">
                        <div class="approveContainer" id="instruction">
                            <div class="labelContainer1">
                                <p>Instruction</p>
                            </div>

                            <input class="container4" type="text" name="instruction" style="width: 98%;" value="<?php echo $instruction; ?>">
                        </div>
                    </div>

                </div>
            </div>

            <div class="buttonContainer2" id="buttonContainer2" style="margin-top: 1.5rem;">
                <button  class="button4" id="confirm-submit" type="button" onclick="openModal()">Save changes</button>
                <button  class="button3" type="button" onclick="closeEditContent()">Cancel</button>
            </div>

            <div id="sweetalert" class="sweetalert" style="display: none;">
                <div class="alertModal">
                    <div class="alertContent">
                        <div class="alertIcon">
                            <div class="iconBorder">
                                <img src="../../assets/img/alert.png" alt="">  
                            </div>
                        </div>
                        <div class="alertMsg">
                            <h2>Are you sure you want to save changes?</h2>
                        </div>
                        <div class="alertBtn" id="alertBtn">
                            <button class="button4" type="submit">Yes, I'm sure</button>
                            <button class="button3" id="btn" type="button" onclick="closeModal()">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
            