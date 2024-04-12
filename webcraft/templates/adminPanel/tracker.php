<style>
    .unitInputContainer p{
        font-weight: lighter;
    }
</style>
   
   
   <div class="trackUnitContainer">
        <div class="subTrackUnitContainer">
            <div class="trackNameContainer">
                <div class="subTrackNameContainer">
                    <p>TRACKER</p>
                </div>
            </div>

            <div class="unitInfoContainer">
                <div class="subUnitInfoContainer">
                    <div class="infoContainer1">
                        <div class="imageContainer1">
                            <div class="subImageContainer1">
                                <img class="image12"  id="imageDisplay" src="" alt="Equipment Image">
                            </div>

                            <div class="equipNameContainer">
                                <p id="equipmentNameDisplay"></p>
                                <p id="unitIDDisplay"></p>
                            </div>
                        </div>

                        <div class="subInfoContainer1" id="unitDetails">
                            <div class="unitIDContainer">
                                <div class="unitID">
                                    <p>Property number</p>

                                    <div class="unitInputContainer" >
                                        <p id="propertyNumberDisplay"></p>
                                        <!-- <p id="userDisplay"></p> -->
                                    </div>
                                </div>

                                <div class="unitID">
                                    <p>Account code</p>

                                    <div class="unitInputContainer">
                                        <p id="accountCodeDisplay"></p>
                                        <!-- <p id="deploymentDisplay"></p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="unitIDContainer">
                                <div class="unitID">
                                    <p>Unit value</p>

                                    <div class="unitInputContainer">
                                        <p id="unitValueDisplay"></p>
                                    </div>
                                </div>

                                <div class="unitID">
                                    <p>Year released</p>

                                    <div class="unitInputContainer">
                                        <p id="yearReceivedDisplay"></p>
                                    </div>
                                </div>

                                <div class="unitID">
                                    <p>Remarks</p>

                                    <div class="unitInputContainer">
                                        <p id="remarksDisplay"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="unitIDContainer">
                                <div class="unitID" id="unitDesc">
                                    <label>Warranty</label>

                                    <div class="unitInputContainer" style="overflow: auto;">
                                        <p id="warrantyEndDisplay" style="text-align: justify; width: 95%; font-weight: lighter;"></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    <div>
                        <div class="oldUserContainer" >
                            <div class="oldUserTextContainer">
                                <p>CURRENT END USER</p>
                            </div>

                            <div class="unitIDContainer">
                                <div class="unitID" id="yearTransferred" >
                                    <p>Year:</p>
                                    <div class="unitInputContainer">
                                        <p id="unitYearReceivedDisplay" style="margin-bottom: 0.5rem; font-weight: 600;"></p>
                                    </div>
                                </div>
                            </div>


                            <div class="unitIDContainer">
                                <div class="unitID">
                                    <p>First name</p>

                                    <div class="unitInputContainer">
                                        <p id="user_IDDisplay" style="display: none;"></p>
                                        <p id="firstNameDisplay"></p>
                                    </div>
                                </div>

                                <div class="unitID">
                                    <p>Last name</p>

                                    <div class="unitInputContainer">
                                        <p id="lastNameDisplay"></p>
                                    </div>
                                </div>

                                <div class="unitID" id="username">
                                    <p>User name</p>

                                    <div class="unitInputContainer">
                                        <p id="userNameDisplay"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="unitIDContainer">
                                <div class="unitID">
                                    <p>Designation</p>

                                    <div class="unitInputContainer">
                                        <p id="designationDisplay"></p>
                                    </div>
                                </div>

                                <div class="unitID">
                                    <p>Department</p>

                                    <div class="unitInputContainer">
                                        <p id="departmentDisplay"></p>
                                    </div>
                                </div>

                                <div class="unitID">
                                    <p>Email</p>

                                    <div class="unitInputContainer">
                                        <p id="emailDisplay"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="oldUserContainer" id="oldUserContainer">
                            <div class="oldUserTextContainer">
                                <p>OLD END USER</p>
                            </div>

                            <div class="unitIDContainer">
                                <div class="unitID" id="yearTransferred">
                                    <p>Year:</p>
                                    <div class="unitInputContainer">
                                        <p id="" style="margin-bottom: 0.5rem; font-weight: 600;"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="unitIDContainer">
                                <div class="unitID">
                                    <p>First name</p>

                                    <div class="unitInputContainer">
                                        <p id="oldEndUserFirstNameDisplay"></p>
                                    </div>
                                </div>

                                <div class="unitID">
                                    <p>Last name</p>

                                    <div class="unitInputContainer">
                                        <p id="oldEndUserLastNameDisplay"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="oldUserContainer">
                            <div class="oldUserTextContainer">
                                <p>OLD END USER</p>
                            </div>

                            <div class="unitIDContainer">
                                <div class="unitID">
                                    <p>First name</p>

                                    <div class="unitInputContainer">
                                        <p id="oldEndUserFirstNameDisplay"></p>
                                    </div>
                                </div>

                                <div class="unitID">
                                    <p>Last name</p>

                                    <div class="unitInputContainer">
                                        <p id="oldEndUserLastNameDisplay"></p>
                                    </div>
                                </div>

                                <div class="unitID" id="username">
                                    <p>User name</p>

                                    <div class="unitInputContainer">

                                    </div>
                                </div>
                            </div> -->

                            <!-- <div class="unitIDContainer">
                                <div class="unitID">
                                    <p>Designation</p>

                                    <div class="unitInputContainer">

                                    </div>
                                </div>

                                <div class="unitID">
                                    <p>E-mail</p>

                                    <div class="unitInputContainer">

                                    </div>
                                </div>

                                <div class="unitID" id="username">
                                    <p>Year handled</p>

                                    <div class="unitInputContainer">

                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="oldUserContainer" id="unitHistory">
                            <div class="oldUserTextContainer">
                                <p>UNIT HISTORY</p>
                            </div>

                            <div class="unitIDContainer" style="width: 70%; margin: auto;">
                                <div class="unitID">
                                    <p>Unit issue</p>

                                    <div class="unitInputContainer">
                                        <p id="reportIssueDisplay"></p>
                                    </div>
                                </div>

                                <div class="unitID">
                                    <p>Date</p>

                                    <div class="unitInputContainer">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="buttonContainer3">
                <button  onclick="closePopup()" class="button5">Close</button>
            </div>
        </div>
    </div>