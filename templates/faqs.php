<?php
    function outputFAQs($faqs){
?>
        <main class="faqs">
            <h2>Frequently Asked Questions</h2>
<?php
            foreach($faqs as $faq)
                outputFAQ($faq);
?>
        </main>
<?php
    }

    function outputFAQ($faq){
?>
        <div class="faq">
            <h3><?=$faq['question']?></h3>
            <p><?=$faq['answer']?></p>
        </div>
<?php
    }
?>