<?php
$this->assign('title', 'Apply to launch IDO');
echo $this->Html->css(['/v1/style'], ['block' => 'css']); ?>

<div class="container d-flex align-items-center min-vh-100">
    <div class="row g-0 justify-content-center">
        <!-- TITLE -->
        <div class="col-lg-4 offset-lg-1 mx-0 px-0">
            <div id="title-container">
                <img class="covid-image" src="<?php echo SITEURL; ?>v1/ido-logo.jpeg">

                <h3>IDO Application</h3>
                <br>
                <p>Welcome to the future of decentralised fundraising on SuperPAD. Our mission is to bring the highest quality projects together with investors to enable the launch of innovative startups and technology. With this goal, it is the responsibility of the SuperPAD Council to act as a governance board to ensure quality and due diligence for the projects we launch.</p>
            </div>
        </div>
        <!-- FORMS -->
        <div class="col-lg-7 mx-0 px-0">
            <div class="progress">
                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: 0%"></div>
            </div>
            <div id="qbox-container">
                <?php echo $this->Form->create(null, [
                    'url' => ['controller' => 'users', 'action' => 'new_project'], 'autocomplete' => 'off',
                    'id' => 'form-wrapper', 'class' => 'needs-validation', 'validate' => true
                ]);  ?>
                <div id="steps-container">
                    <div class="step">
                        <h4>Provide us with your personal information</h4>
                        <div class="mt-1">
                            <label class="form-label">Complete Name:</label>
                            <input class="form-control" id="full_name" name="full_name" type="text" required>
                        </div>
                        <div class="mt-2">
                            <label class="form-label">Complete Address:</label>
                            <input class="form-control" id="address" name="address" type="text" required>
                        </div>
                        <div class="mt-2">
                            <label class="form-label">Email:</label>
                            <input class="form-control" id="email" name="email" type="email" required>
                        </div>
                        <div class="mt-2">
                            <label class="form-label">Phone / Mobile Number:</label>
                            <input class="form-control" id="phone" name="phone" type="text">
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-2 col-md-2 col-3">
                                <label class="form-label">Age:</label>
                                <div class="input-container">
                                    <input class="form-control" id="age" name="age" type="text">
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div id="input-container">
                                    <input class="form-check-input" name="gender" type="radio" value="male">
                                    <label class="form-check-label radio-lb">Male</label>
                                    <input class="form-check-input" name="gender" type="radio" value="female">
                                    <label class="form-check-label radio-lb">Female</label>
                                    <input checked class="form-check-input" name="gender" type="radio" value="undefined">
                                    <label class="form-check-label radio-lb">Rather not say</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="step">
                        <h4>Have you recently been in close contact with someone who has COVID-19?</h4>
                        <div class="form-check ps-0 q-box">
                            <div class="q-box__question">
                                <input class="form-check-input question__input" id="q_1_yes" name="q_1" type="radio" value="Yes">
                                <label class="form-check-label question__label" for="q_1_yes">Yes</label>
                            </div>
                            <div class="q-box__question">
                                <input checked class="form-check-input question__input" id="q_1_no" name="q_1" type="radio" value="No">
                                <label class="form-check-label question__label" for="q_1_no">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="step">
                        <h4>Are you experiencing a high fever, dry cough, tiredness and loss of taste or smell?</h4>
                        <div class="form-check ps-0 q-box">
                            <div class="q-box__question">
                                <input class="form-check-input question__input" id="q_2_yes" name="q_2" type="radio" value="Yes">
                                <label class="form-check-label question__label" for="q_2_yes">Yes</label>
                            </div>
                            <div class="q-box__question">
                                <input checked class="form-check-input question__input" id="q_2_no" name="q_2" type="radio" value="No">
                                <label class="form-check-label question__label" for="q_2_no">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="step">
                        <h4>Are you having diarrhoea, stomach pain, conjunctivitis, vomiting and headache?</h4>
                        <div class="form-check ps-0 q-box">
                            <div class="q-box__question">
                                <input class="form-check-input question__input" id="q_3_yes" name="q_3" type="radio" value="Yes">
                                <label class="form-check-label question__label" for="q_3_yes">Yes</label>
                            </div>
                            <div class="q-box__question">
                                <input checked class="form-check-input question__input" id="q_3_no" name="q_3" type="radio" value="No">
                                <label class="form-check-label question__label" for="q_3_no">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="step">
                        <h4>Have you traveled to any of these countries with the highest number of COVID-19 cases in the world for the past 2 weeks?</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-check ps-0 q-box">
                                    <div class="q-box__question">
                                        <input class="form-check-input question__input q-checkbox" id="q_4_uk" name="q_4" type="checkbox" value="uk">
                                        <label class="form-check-label question__label" for="q_4_uk">UK</label>
                                    </div>
                                </div>
                                <div class="form-check ps-0 q-box">
                                    <div class="q-box__question">
                                        <input class="form-check-input question__input" id="q_4_us" name="q_4" type="checkbox" value="us">
                                        <label class="form-check-label question__label" for="q_4_us">US</label>
                                    </div>
                                </div>
                                <div class="form-check ps-0 q-box">
                                    <div class="q-box__question">
                                        <input class="form-check-input question__input" id="q_4_br" name="q_3" type="checkbox" value="br">
                                        <label class="form-check-label question__label" for="q_4_br">Brazil</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check ps-0 q-box">
                                    <div class="q-box__question">
                                        <input class="form-check-input question__input" id="q_4_de" name="q_4" type="checkbox" value="de">
                                        <label class="form-check-label question__label" for="q_4_de">Germany</label>
                                    </div>
                                </div>
                                <div class="form-check ps-0 q-box">
                                    <div class="q-box__question">
                                        <input class="form-check-input question__input" id="q_4_in" name="q_4" type="checkbox" value="in">
                                        <label class="form-check-label question__label" for="q_4_in">India</label>
                                    </div>
                                </div>
                                <div class="form-check ps-0 q-box">
                                    <div class="q-box__question">
                                        <input class="form-check-input question__input" id="q_4_eu" name="q_4" type="checkbox" value="eu">
                                        <label class="form-check-label question__label" for="q_4_eu">Europe</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-check ps-0 q-box">
                                    <div class="q-box__question">
                                        <input class="form-check-input question__input" id="q_4_none" name="q_4" type="checkbox" value="none">
                                        <label class="form-check-label question__label" for="q_4_none">I did not travelled to any of these countries</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="step">
                        <h4>Are you experiencing any of these serious symptoms of COVID-19 below?</h4>
                        <div class="row">
                            <div class="form-check ps-0 q-box">
                                <div class="q-box__question">
                                    <input class="form-check-input question__input" id="q_5_breathing" name="q_5_breathing" type="checkbox" value="breathing">
                                    <label class="form-check-label question__label" for="q_5_breathing">Difficulty breathing or shortness of breath</label>
                                </div>
                            </div>
                            <div class="form-check ps-0 q-box">
                                <div class="q-box__question">
                                    <input class="form-check-input question__input" id="q_5_chest" name="q_5_chest" type="checkbox" value="chest pain">
                                    <label class="form-check-label question__label" for="q_5_chest">Chest pain or pressure</label>
                                </div>
                            </div>
                            <div class="form-check ps-0 q-box">
                                <div class="q-box__question">
                                    <input class="form-check-input question__input" id="q_5_speech" name="q_5_speech" type="checkbox" value="speech problem">
                                    <label class="form-check-label question__label" for="q_5_speech">Loss of speech or movement</label>
                                </div>
                            </div>
                            <div class="form-check ps-0 q-box">
                                <div class="q-box__question">
                                    <input class="form-check-input question__input" id="q_5_pale" name="q_5_pale" type="checkbox" value="pale">
                                    <label class="form-check-label question__label" for="q_5_pale">Pale, gray or blue-colored skin, lips or nail beds</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="step">
                        <div class="mt-1">
                            <div class="closing-text">
                                <h4>That's about it! Stay healthy!</h4>
                                <p>We will assess your information and will let you know soon if you need to get tested for COVID-19.</p>
                                <p>Click on the submit button to continue.</p>
                            </div>
                        </div>
                    </div>
                    <div id="success">
                        <div class="mt-5">
                            <h4>Success! We'll get back to you ASAP!</h4>
                            <p>Meanwhile, clean your hands often, use soap and water, or an alcohol-based hand rub, maintain a safe distance from anyone who is coughing or sneezing and always wear a mask when physical distancing is not possible.</p>
                            <a class="back-link" href="">Go back from the beginning ➜</a>
                        </div>
                    </div>
                </div>
                <div id="q-box__buttons">
                    <button id="prev-btn" type="button">Previous</button>
                    <button id="next-btn" type="button">Next</button>
                    <button id="submit-btn" type="submit">Submit</button>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div><!-- PRELOADER -->
<div id="preloader-wrapper">
    <div id="preloader"></div>
    <div class="preloader-section section-left"></div>
    <div class="preloader-section section-right"></div>
</div>

<?php echo $this->Html->script(['/v1/script.js?v='.rand(123,987), 'https://static.app/js/static-forms.js'], ['block' => 'scriptBottom']); ?>