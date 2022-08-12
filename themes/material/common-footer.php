
<footer class="footer">
    <section>
        <!--   TODO: add help center link -->
        <a class="help footer" href="/">Want help?</a>
    </section>
    <?= $this->t('{material:footer:copyright}') ?>
</footer>

<style>
    a.help {
        color: hsla(210, 100%, 36%, 1);
        text-decoration: none;
    }
    .footer {
        color: hsla(0, 0%, 40%, 1);
        text-align: center;
        margin: 1rem;
    }
</style>