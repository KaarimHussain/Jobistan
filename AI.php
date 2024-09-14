<!-- Button to Open the AI ChatBot Panel -->
<link rel="stylesheet" href="./Styles/chatbot.css?v=<?php echo time(); ?>">
<div class="position-fixed z-3 bottom-0 end-0 pb-4 pe-4">
    <div class="position-fixed top-50 end-0 translate-middle-y pe-4">
        <div class="chatbot-container position-relative">
            <div class="chatbot-header">
                <span class="fw-light fs-3">JET BOT</span>
            </div>
            <div class="chatbot-body position-relative" id="response-box">
                <!-- <div class="row">
                        <div class="col-md-6 col-12 mb-4">
                            <div class="quick-ans-box">
                                <div class="quick-icon1">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-4">
                            <div class="quick-ans-box">

                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-4">
                            <div class="quick-ans-box">

                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-4">
                            <div class="quick-ans-box">

                            </div>
                        </div>
                    </div> -->
            </div>
            <div class="position-absolute bottom-0 pb-2 w-100">
                <div class="d-flex justify-content-center gap-2 w-100 px-2">
                    <input type="text" id="ai-input-field" class="input-primary position-relative w-100"
                        placeholder="Ask Anything...">
                    <button class="small-primary-btn" id="ai-input-button"><i class="bi bi-send-fill"></i></button>
                </div>
            </div>
        </div>
    </div>
    <button class="primary-btn " id="enableChatBot" data-bs-title="AI Assistant" data-bs-toggle="tooltip">
        <i class="bi bi-robot fs-4"></i>
    </button>
</div>
<!--  -->