

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form class="subViewApproveContainer"  action="" enctype="multipart/form-data" id="myForm" method="post">
<input type="hidden" name="equipment_ID" value="<?php echo $equipment_ID; ?>">
    <div class="viewInfoContainer" action="" method="">
        <div class="imageContainer4">
            <div class="subImageContainer5">
                <img class="subImageContainer5" src="<?php echo $imageURL; ?>" alt="Mountain Placeholder" onerror="this.onerror=null; this.src='../../assets/img/img_placeholder.jpg';">
            </div>

            <div class="equipNameContainer">
                <p><?php echo $article; ?></p>
            </div>
        </div>

        <div class="approveInfoContainer">

            <div class="subApproveInfoContainer">
                <div class="approveContainer">
                    <div class="labelContainer1">
                        <p>Article</p>
                    </div>

                    <div class="container4">
                        <input type="text" class="container4" name="article" value="<?php echo $article; ?>">
                    </div>
                </div>
            </div>

            <div class="subApproveInfoContainer">
                <div class="approveContainer">
                    <div class="labelContainer1">
                        <p>Deployment</p>
                    </div>

                    <div class="container4">
                        <input type="text" class="container4" name="deployment" value="<?php echo $deployment; ?>">
                    </div>
                </div>
            </div>

            <div class="subApproveInfoContainer1">
                <div class="approveContainer">
                    <div class="labelContainer1">
                        <p>Property number</p>
                    </div>

                    <div class="container4">
                        <input type="text" class="container4" id="text1" name="property_container" value="<?php echo $property_number; ?>">
                    </div>
                </div>

                    <div class="approveContainer">
                        <div class="labelContainer1">
                            <p>Account code</p>
                        </div>

                        <div class="container4">
                            <input type="text" class="container4" id="text1" name="account_code" value="<?php echo $account_code; ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="subApproveInfoContainer2">
            <div class="approveContainer">
                <div class="labelContainer1">
                    <p>Total unit</p>
                </div>

                <div class="container4" id="container4">
                    <p class="text1" id="text1"><?php echo $units; ?></p>
                </div>
            </div>

            <div class="approveContainer">
                <div class="labelContainer1">
                    <p>Unit value</p>
                </div>

                <div class="container4">
                    <input type="text" class="container4" name="unit_value" value="<?php echo $unit_value; ?>">
                </div>
            </div>

            <div class="approveContainer">
                <div class="labelContainer1">
                    <p>Total value</p>
                </div>

                <div class="container4">
                    <input type="text" class="container4" name="total_value" value="<?php echo $total_value; ?>">
                </div>
            </div>

            <div class="approveContainer">
                <div class="labelContainer1">
                    <p>Remarks</p>
                </div>

                <div class="container4">
                    <input type="text" class="container4" name="remarks" style="padding-left: 1rem;" value="<?php echo $remarks; ?>">
                </div>
            </div>
        </div>

        <div class="descriptionContainer">
            <div class="approveContainer1">
                <div class="labelContainer1">
                    <p>Description</p>
                </div>

                <div class="container5">
                    <input type="text" class="container5" name="description" style="padding-left: 1rem;" value="<?php echo $description; ?>">
                </div>
            </div>
        </div>

        <div class="descriptionContainer1">
            <div class="approveContainer1">
                <div class="labelContainer1">
                    <p>Instruction</p>
                </div>

                <div class="container5">
                    <input type="text" class="container5" name="instruction" style="padding-left: 1rem;" value="<?php echo $instruction; ?>">
                </div>
            </div>
        </div>
        <div class="buttonContainer2" id="buttonContainer2" style="margin-top: 1.5rem;">
            <input type="hidden" name="confirmSave" value="1">
            <button  class="button4" id="saveButton"onclick="changeToConfirmSubmit()">Submit</button>
            <button  class="button3" type="button" onclick="closeEditContent()">Cancel</button>
        </div>
    </div>
    
</form>


</body>
</html>

