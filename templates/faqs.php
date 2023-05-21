<?php
    function outputFAQs($faqs, $role){
?>
        <main class="faqs">
            <p id="csrf" style="display: none;"><?=$_SESSION['csrf']?></p>
            <div class="title-new-faq">
                <h2>Frequently Asked Questions</h2>
<?php
                if($role != 'client'){
?>
                    <button type="button" id="new-faq-button">New FAQ</button>
<?php
                }
?>
            </div>
<?php
            foreach($faqs as $faq)
                outputFAQ($faq, $role);
?>
        </main>
<?php
    }

    function outputFAQ($faq, $role){
?>
        <div id="faq-<?=$faq['id']?>" class="faq">
            <p class="faq-id" style="display: none"><?=$faq['id']?></p>
            <div class="title-options">
                <h3 class="faq-question"><?=$faq['question']?></h3>
<?php
                if($role != 'client'){
?>
                <img class="faq-options" src="../icons/dots.png" alt="options"/>
<?php
                }
?>
            </div>
            <p class="faq-answer"><?=$faq['answer']?></p>
        </div>
<?php
    }
?>