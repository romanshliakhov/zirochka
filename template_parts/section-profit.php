<?php
$shower       = get_sub_field('shower');
$editor_top   = get_sub_field('editor_top');
$editor_bot   = get_sub_field('editor_bot');

$timeline_top = get_sub_field('timeline_top');
if ($timeline_top) {
    $tml_top_start = $timeline_top['tml_top_start'] ?? '';
    $tml_top_end   = $timeline_top['tml_top_end'] ?? '';
}

$timeline_bot = get_sub_field('timeline_bot');
if ($timeline_bot) {
    $tml_bot_start = $timeline_bot['tml_bot_start'] ?? '';
    $tml_bot_step1 = $timeline_bot['tml_bot_step1'] ?? '';
    $tml_bot_step2 = $timeline_bot['tml_bot_step2'] ?? '';
    $tml_bot_step3 = $timeline_bot['tml_bot_step3'] ?? '';
    $tml_bot_end   = $timeline_bot['tml_bot_end'] ?? '';
}
?>

<?php if (!$shower) : ?>
<section class="section-profit">
    <div class="container">
        <div class="section-profit__wrapp">
            <div class="section-profit__box">
                <?php if (!empty($editor_top)) : ?>
                    <div class="editor">
                        <?= $editor_top; ?>
                    </div>
                <?php endif; ?>

                <div class="section-profit__timeline">
                    <div class="profit-start">
                        <span class="profit-label">Metal</span>
                        <div class="profit-bubble"><?= $tml_top_start; ?></div>
                    </div>

                    <div class="profit-step">
                        <span class="price">0$</span>
                        <span class="icon"><?php sprite(32, 32, 'HouseLine') ?></span>
                        <span class="label">Replace</span>
                    </div>
                    <div class="profit-step">
                        <span class="price">0$</span>
                        <span class="icon"><?php sprite(32, 32, 'HouseLine') ?></span>
                        <span class="label">Replace</span>
                    </div>
                    <div class="profit-step">
                        <span class="price">0$</span>
                        <span class="icon"><?php sprite(32, 32, 'HouseLine') ?></span>
                        <span class="label">Replace</span>
                    </div>

                    <div class="profit-end">
                        <span class="profit-label">After 50 years</span>
                        <div class="profit-bubble"><?= $tml_top_end; ?></div>
                    </div>
                </div>
            </div>

            <div class="section-profit__box">
                <?php if (!empty($editor_bot)) : ?>
                    <div class="editor">
                        <?= $editor_bot; ?>
                    </div>
                <?php endif; ?>

                <div class="section-profit__timeline">
                    <div class="profit-start">
                        <span class="profit-label">No metal</span>
                        <div class="profit-bubble"><?= $tml_bot_start; ?></div>
                    </div>

                    <div class="profit-step">
                        <span class="price"><?= $tml_bot_step1; ?></span>
                        <span class="icon"><?php sprite(32, 32, 'HouseLine') ?></span>
                        <span class="label">Replace</span>
                    </div>
                    <div class="profit-step">
                        <span class="price"><?= $tml_bot_step2; ?></span>
                        <span class="icon"><?php sprite(32, 32, 'HouseLine') ?></span>
                        <span class="label">Replace</span>
                    </div>
                    <div class="profit-step">
                        <span class="price"><?= $tml_bot_step3; ?></span>
                        <span class="icon"><?php sprite(32, 32, 'HouseLine') ?></span>
                        <span class="label">Replace</span>
                    </div>

                    <div class="profit-end">
                        <span class="profit-label">After 50 years</span>
                        <div class="profit-bubble"><?= $tml_bot_end; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
