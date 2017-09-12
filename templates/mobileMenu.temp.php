<div class="mobile-menu">
    <div class="option"><a href="/dolphin/">תוכן</a></div>
    <div class="option"><a href="/dolphin/editors">עורכים</a></div>
    <div class="option"><a href="/dolphin/about">אודות</a></div>
    <?php if(isset($_COOKIE['username'])) : ?>
        <div class="option"><a href="/dolphin/logout">התנתק</a></div>
    <?php endif; ?>
</div>